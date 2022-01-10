<div class="sidebar left">
        <?php
            $customer = auth('customer')->user();
        ?>

        @if ( isset($customer->id))
            <div class="customer-sidebar row no-margin no-padding">
                <div class="account-details col-12">
                    <div class="customer-name col-12 text-uppercase">
                        {{ substr(auth('customer')->user()->first_name, 0, 1) }}
                    </div>

                    <div class="col-12 customer-name-text text-capitalize text-break">{{ auth('customer')->user()->first_name . ' ' . auth('customer')->user()->last_name}}</div>
                    <div class="customer-email col-12 text-break">{{ auth('customer')->user()->email }}</div>
                </div>

                @foreach ($menu->items as $menuItem)
                    <div class="menu-block-title">
                            {{ trans($menuItem['name']) }}
                    </div>

                    <ul type="none" class="navigation">

                        @if ($menuItem['key'] != 'marketplace')
                            @foreach ($menuItem['children'] as $index => $subMenuItem)
                                <li class="{{ $menu->getActive($subMenuItem) }}">
                                    <a class="unset fw6 full-width" href="{{ $subMenuItem['url'] }}">
                                        <i class="icon {{ $index }} text-down-3"></i>
                                        <span>{{ trans($subMenuItem['name']) }}</span>
                                        <i class="rango-arrow-right pull-right text-down-3"></i>
                                    </a>

                                </li>
                            @endforeach
                        @else
                            @if (app('Webkul\Marketplace\Repositories\SellerRepository')->isSeller(auth()->guard('customer')->user()->id))

                                @foreach ($menuItem['children'] as $index => $subMenuItem)
                                    <li class="{{ $menu->getActive($subMenuItem) }}">
                                        <a class="unset fw6 full-width" href="{{ $subMenuItem['url'] }}">
                                            <i class="icon {{ $index }} text-down-3"></i>
                                            <span>{{ trans($subMenuItem['name']) }}</span>
                                            <i class="rango-arrow-right pull-right text-down-3"></i>
                                        </a>

                                    </li>
                                @endforeach

                            @else

                                <li class="menu-item {{ request()->route()->getName() == 'marketplace.account.seller.create' ? 'active' : '' }}">
                                    <a href="{{ route('marketplace.account.seller.create') }}">
                                        {{ __('marketplace::app.shop.layouts.become-seller') }}
                                    </a>

                                    <i class="icon angle-right-icon"></i>
                                </li>

                            @endif
                        @endif
                    </ul>
                @endforeach
            </div>
        @endif
    </div>


    @push('css')
        <style type="text/css">
            .main-content-wrapper {
                margin-bottom: 0px;
                min-height: 100vh;
            }
        </style>
    @endpush