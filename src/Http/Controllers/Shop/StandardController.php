<?php

namespace Webkul\DeliveryTimeSlot\Http\Controllers\Shop;

use Webkul\Checkout\Facades\Cart;
use Webkul\Paypal\Helpers\Ipn;
use Webkul\DeliveryTimeSlot\Http\Controllers\Controller;
use Webkul\DeliveryTimeSlot\Repositories\OrderRepository as TimeSlotOrderRepository;

class StandardController extends Controller
{
    /**
     * OrderRepository object
     *
     * @var array
     */
    protected $orderRepository;

    /**
     * TimeSlotOrderRepository object
     *
     * @var array
     */
    protected $timeSlotOrderRepository;

    /**
     * Ipn object
     *
     * @var array
     */
    protected $ipnHelper;

    /**
     * Create a new controller instance.
     *
     * @param  \Webkul\DeliveryTimeSlot\Repositories\OrderRepository  $timeSlotOrderRepository
     * @return void
     */
    public function __construct(
        TimeSlotOrderRepository $timeSlotOrderRepository,
        Ipn $ipnHelper
    )
    {
        $this->timeSlotOrderRepository = $timeSlotOrderRepository;

        $this->ipnHelper = $ipnHelper;
    }

    /**
     * Redirects to the paypal.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirect()
    {
        return view('paypal::standard-redirect');
    }

    /**
     * Cancel payment from paypal.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancel()
    {
        session()->flash('error', 'Paypal payment has been canceled.');

        return redirect()->route('shop.checkout.cart.index');
    }

    /**
     * Success payment
     *
     * @return \Illuminate\Http\Response
     */
    public function success()
    {
        $order = $this->timeSlotOrderRepository->create(Cart::prepareDataForOrder());

        Cart::deActivateCart();

        session()->flash('order', $order);

        return redirect()->route('shop.checkout.success');
    }

    /**
     * Paypal Ipn listener
     *
     * @return \Illuminate\Http\Response
     */
    public function ipn()
    {
        $this->ipnHelper->processIpn(request()->all());
    }
}