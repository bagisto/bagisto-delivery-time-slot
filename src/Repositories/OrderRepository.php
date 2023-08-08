<?php

namespace Webkul\DeliveryTimeSlot\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Event;
use Illuminate\Container\Container as App;
use Webkul\Sales\Contracts\Order;
use Webkul\Core\Eloquent\Repository;
use Webkul\Sales\Generators\OrderSequencer;
use Webkul\Sales\Repositories\OrderItemRepository;
use Webkul\Sales\Repositories\DownloadableLinkPurchasedRepository;
use Webkul\DeliveryTimeSlot\Repositories\DeliveryTimeSlotsOrdersRepository;

class OrderRepository extends Repository
{
    /**
     * Order item repository instance.
     *
     * @var \Webkul\Sales\Repositories\OrderItemRepository
     */
    protected $orderItemRepository;

    /**
     * Downloadable link purchased repository instance.
     *
     * @var \Webkul\Sales\Repositories\DownloadableLinkPurchasedRepository
     */
    protected $downloadableLinkPurchasedRepository;

    /**
     * DeliveryTimeSlotsOrdersRepository Instance Object
     *
     * @var \Webkul\DeliveryTimeSlot\Repositories\DeliveryTimeSlotsOrdersRepository
     */
    protected $deliveryTimeSlotsOrdersRepository;

    /**
     * Create a new repository instance.
     *
     * @param  \Webkul\Sales\Repositories\OrderItemRepository  $orderItemRepository
     * @param  \Webkul\Sales\Repositories\DownloadableLinkPurchasedRepository  $downloadableLinkPurchasedRepository
     * @param  \Webkul\DeliveryTimeSlot\Repositories\DeliveryTimeSlotsOrdersRepository  $deliveryTimeSlotsOrdersRepository
     * @param  \Illuminate\Container\Container  $app
     * @return void
     */
    public function __construct(
        OrderItemRepository $orderItemRepository,
        DownloadableLinkPurchasedRepository $downloadableLinkPurchasedRepository,
        DeliveryTimeSlotsOrdersRepository $deliveryTimeSlotsOrdersRepository,
        App $app
    ) {
        $this->orderItemRepository = $orderItemRepository;

        $this->downloadableLinkPurchasedRepository = $downloadableLinkPurchasedRepository;

        $this->deliveryTimeSlotsOrdersRepository = $deliveryTimeSlotsOrdersRepository;

        parent::__construct($app);
    }

    /**
     * Specify model class name.
     *
     * @return string
     */
    public function model()
    {
        return Order::class;
    }

    /**
     * This method will try attempt to a create order.
     *
     * @return \Webkul\Sales\Contracts\Order
     */
    public function createOrderIfNotThenRetry(array $data)
    {
        DB::beginTransaction();

        try {
            Event::dispatch('checkout.order.save.before', [$data]);

            if (
                isset($data['customer']) &&
                $data['customer']
            ) {
                $data['customer_id'] = $data['customer']->id;
                $data['customer_type'] = get_class($data['customer']);
            } else {
                unset($data['customer']);
            }

            if (
                isset($data['channel']) &&
                $data['channel']
            ) {
                $data['channel_id'] = $data['channel']->id;
                $data['channel_type'] = get_class($data['channel']);
                $data['channel_name'] = $data['channel']->name;
            } else {
                unset($data['channel']);
            }

            $data['status'] = 'pending';

            $order = $this->model->create(array_merge($data, ['increment_id' => $this->generateIncrementId()]));

            // Delivery Time Slot Start
            if (core()->getConfigData('delivery_time_slot.settings.general.status')) {
                $this->createDeliveryTimeSlotOrder($order);
            }// Delivery Time Slot End

            $order->payment()->create($data['payment']);

            if (isset($data['shipping_address'])) {
                $order->addresses()->create($data['shipping_address']);
            }

            $order->addresses()->create($data['billing_address']);

            foreach ($data['items'] as $item) {
                Event::dispatch('checkout.order.orderitem.save.before', $data);

                $orderItem = $this->orderItemRepository->create(array_merge($item, ['order_id' => $order->id]));

                if (
                    isset($item['children']) &&
                    $item['children']
                ) {
                    foreach ($item['children'] as $child) {
                        $this->orderItemRepository->create(array_merge($child, ['order_id' => $order->id, 'parent_id' => $orderItem->id]));
                    }
                }

                $this->orderItemRepository->manageInventory($orderItem);

                $this->downloadableLinkPurchasedRepository->saveLinks($orderItem, 'available');

                Event::dispatch('checkout.order.orderitem.save.after', $data);
            }

            Event::dispatch('checkout.order.save.after', $order);
        } catch (\Exception $e) {
            /* rolling back first */
            DB::rollBack();

            /* storing log for errors */
            Log::error(
                'OrderRepository:createOrderIfNotThenRetry: ' . $e->getMessage(),
                ['data' => $data]
            );

            /* recalling */
            $this->createOrderIfNotThenRetry($data);
        } finally {
            /* commit in each case */
            DB::commit();
        }

        return $order;
    }

    /**
     * Create order.
     *
     * @param  array  $data
     * @return \Webkul\Sales\Contracts\Order
     */
    public function create(array $data)
    {
        return $this->createOrderIfNotThenRetry($data);
    }

    /**
     * Generate increment id.
     *
     * @return int
     */
    public function generateIncrementId()
    {
        return app(OrderSequencer::class)->resolveGeneratorClass();
    }

    /**
     * Create DeliveryTimeSlot Order.
     * 
     * @param  \Webkul\Sales\Contracts\Order    $order
     * @return \Webkul\DeliveryTimeSlot\Contracts\DeliveryTimeSlotsOrders
     */
    public function createDeliveryTimeSlotOrder($order)
    {
        if (! isset($timeSlot['selected_delivery_slot'])) {
            $timeSlot = session()->get('selected_delivery_slot');
        }

        if (
            $order &&
            isset($timeSlot) &&
            $timeSlot
        ) {
            foreach ($timeSlot as $key => $slot) {
                $sellerId = NULL;
                if (
                    isset($slot[1]) &&
                    $slot[1]
                ) {
                    $sellerId = (int) $slot[1];
                }
                
                $deliverySlotData = [
                    'time_slot_id'          => $slot[0],
                    'order_id'              => $order->id,
                    'marketplace_seller_id' => $sellerId,
                    'delivery_date'         => $slot[2] . ',' . $slot[3] . ',' . $slot[4],
                    'customer_id'           => $order->customer_id
                ];

                $this->deliveryTimeSlotsOrdersRepository->create($deliverySlotData);
            }
        }
    }
}
