<!-- cart -->
@php

$cartitems = App\Models\Cart::with('item')->where('user_id', auth()->user()->id)->get();
 
 $result = 0;
@endphp
<li class="dropdown notification-list">
    <a class="nav-link dropdown-toggle arrow-none" href="#">
        <i data-bs-toggle="offcanvas" data-bs-target="#cartSideNav" id="secondButton" class="ri-shopping-cart-line fs-22 opencartsidebar"></i>
@if ($cartitems)
    <span class="noti-icon-badge badge text-bg-danger">{{ count($cartitems) }}</span>
@else
    <!-- Handle case where $cartitems is null or empty -->
    <!-- For example: -->
    <span class="noti-icon-badge badge text-bg-danger">0</span>
@endif
    </a>
</li>

<div class="offcanvas offcanvas-end" tabindex="-1" id="cartSideNav" aria-labelledby="cartSideNavLabel">
    <div class="offcanvas-header">
        <h4 class="offcanvas-title" id="cartSideNavLabel">{{__('translation.Shopping Cart')}}</h4>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        @if(count($cartitems) > 0)
            <div class="items col-12 clearfix">
                <div class="info-block block-info clearfix">
                    <div class="items col-12 clearfix">
                        @foreach ($cartitems as $key => $cartitem)
                            <div class="row mb-4 container" style="border-right: 4px solid #5E72E4;">
                                <div class="col-5">
                                    <div class="image-cart-container"
                                        style="width: 100%;height:140px;background-image:url({{ url('storage/' . $cartitem->item->image) }});background-repeat:no-repeat;background-position:center;background-size:cover;">
                                    </div>
                                </div>
                                <div class="col-7">
                                    <ul class="list-unstyled">
                                        <li style="">
                                            <p style="font-size:17px;">
                                                {{ $cartitem->item->title[app()->getLocale()] }}
                                                <br />
                                                <span class="mt-2" style="color: #77819A;display:inline-block;"> {{ $cartitem->quantity }} x
                                                   </span>
                                                <span>
                                                     {{ $cartitem->item->total_price }}
                                                    €
                                                </span>
                                            </p>
                                        </li>
                                    </ul>
                                    <div class="buttondiv mt-3" style="">
                                        <button
                                            data-route="{{ route('carts.minus', ['id' => $cartitem->id, 'route' => 'cartsidebar']) }}"
                                           type="button" class="btn btn-success btn-sm cartbutton minus-quantity">
                                            <i class="ri bi-dash-circle-fill"></i>
                                        </button>
                                        <button
                                            data-route="{{ route('carts.plus', ['id' => $cartitem->id, 'route' => 'cartsidebar']) }}"
                                            type="button" class="btn btn-success btn-sm cartbutton plus-quantity">
                                            <i class="ri bi-plus-circle-fill"></i>
                                        </button>
                                        <button
                                            data-route="{{ route('carts.remove', ['id' => $cartitem->id, 'route' => 'cartsidebar']) }}"
                                           type="button" class="btn btn-danger btn-sm cartbutton delete-item">
                                             <i class="ri bi-trash-fill"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @php
                                $result += $cartitem->quantity * $cartitem->item->total_price;
                            @endphp
                        @endforeach
                        <hr>
                        <!-- Add more items here -->
                        <div id="totalPrices">
                            <div class="card mb-4 mb-xl-0">
                                <div class="card-body"style="background-color:#fff;color:#525f7f;border:1px solid #cacaca33;border-radius:4px;">
                                    <div class="row">
                                        <div class="col" style="font-size: 18px;">
                                            <span><strong style="">{{__('translation.Sub Total')}}:</strong></span>
                                            <span class="ammount"><strong>€{{ number_format($result, 2, ',', '.') }}</strong></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div>
                                <a href="{{ route('user.cart.index') }}" class="btn btn-primary btn-block"
                                    style="width:100%;font-size:20px;">{{ __('translation.Check Out') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="empty-cart-message text-center">
                <i class="ri-shopping-cart-line fs-72 text-muted"></i>
                <h5 class="mt-3 text-muted">{{__('translation.Your Cart is Empty')}}</h5>
                <p class="text-muted">{{__('translation.Looks like you havent added anything to your cart yet')}}.</p>
                <a href="{{ route('user.items.index') }}" class="btn btn-primary mt-3">{{__('translation.Start Shopping')}}</a>
            </div>
        @endif
    </div>
</div>

<style>
    .empty-cart-message {
        padding: 50px 20px;
    }
    .empty-cart-message i {
        font-size: 72px;
    }
    .empty-cart-message h5 {
        margin-top: 20px;
        font-size: 24px;
    }
    .empty-cart-message p {
        font-size: 16px;
        color: #6c757d;
    }
    .empty-cart-message a.btn {
        font-size: 18px;
    }
</style>
