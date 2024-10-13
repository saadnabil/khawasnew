@extends('layout.UserMatser')

@section('content')



<div class="row">

    @php
    $cartitems = App\Models\Cart::with('item')->where('user_id', auth()->user()->id)->get();
    $result = 0;
    $user = auth()->user()->load('appliedcoupon');
    @endphp


    @if(count($cartitems) > 0)



    <div class="col-md-8 " >
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">{{__('translation.Cart Details')}}</h6>
                <hr>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>{{__('translation.Item')}}</th>
                                <th>{{__('translation.Price')}}</th>
                                <th>{{__('translation.Quantity')}}</th>
                                <th>{{__('translation.Total')}}</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($cartitems as $cartitem)
                            <tr>
                                <td>
                                    <img src="{{ url('storage/' . $cartitem->item->image) }}" alt="not found" width="60" height="60">
                                    {{ $cartitem->item->title[app()->getLocale()] }}
                                </td>
                                <td><span class="mt-2" style="color: #77819A;display:inline-block;"> {{ $cartitem->quantity }} x
                                                       </span>
                                    <span>
                                                         {{ $cartitem->item->total_price }}
                                                        €
                                                    </span></td>
                                <td>
                                    <div class="input-group quantity mx-auto" style="">
                                        <div class="buttondiv">
                                            <button data-route="{{ route('carts.minus', ['id' => $cartitem->id, 'route' => 'cartpagedetails']) }}"
                                             type="button" class="btn btn-success btn-sm  minus-quantity">
                                                <i class="ri bi-dash-circle-fill"></i>
                                            </button>
                                            <button data-route="{{ route('carts.plus', ['id' => $cartitem->id, 'route' => 'cartpagedetails']) }}"
                                             type="button" class="btn btn-success btn-sm plus-quantity">
                                                <i class="ri bi-plus-circle-fill"></i>
                                            </button>
                                            <button data-route="{{ route('carts.remove', ['id' => $cartitem->id, 'route' => 'cartpagedetails']) }}"
                                             type="button" class="btn btn-danger btn-sm delete-item">
                                                <i class="ri bi-trash-fill"></i>
                                            </button>

                                        </div>
                                    </div>
                                </td>
                                <td> {{ number_format($cartitem->quantity * $cartitem->item->total_price,2) }}€</td>

                            </tr>

                            @php
                            $result += $cartitem->quantity * $cartitem->item->total_price;
                            @endphp
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="sub-title">
                    <h2 class="mb-0">{{__('translation.Cart Summary')}}</h2>
                </div>
                <hr>

                <div class="d-flex justify-content-between pb-2">
                    <div><strong>{{__('translation.Sub Total')}}</strong></div>
                    <div><strong>{{ $result }}€</strong></div>
                </div>


              @if($user->appliedcoupon == null)
    <div class="input-group apply-coupan mt-4">
        <form id="applycoupon" autocomplete="">
            @csrf
            <div class="input-group">
                <input required type="text" name="code" placeholder="Coupon Code" class="form-control coupon-input">
                <button class="btn btn-primary applycoupon coupon-button" type="button" id="button-addon2">{{__('translation.Apply Coupon')}}</button>
            </div>
            <br>
            <div class="address-errors mt-2"></div>
        </form>
    </div>
@else
    <div class="d-flex justify-content-between pb-2 text-danger">
        <div>{{ __('translation.Discount') }}</div>
        @if($user->appliedcoupon->type == 'percent')
            <div>{{ $user->appliedcoupon->discount }}%</div>
        @else
            <div>{{ $user->appliedcoupon->discount }}€</div>
        @endif
    </div>
    <div class="d-flex justify-content-between pb-2">
        <div>{{ __('translation.Total') }}</div>
        @if($user->appliedcoupon->type == 'percent')
            <div>{{ $result - ($result * $user->appliedcoupon->discount / 100) }}€</div>
        @else
            <div>{{ $result - $user->appliedcoupon->discount }}€</div>
        @endif
    </div>
    <br>
    <div class="row">
        <div class="col-10">
            <div class="coupon">
                {{$user->appliedcoupon->code }}
            </div>
        </div>
        <div class="col-2">
            <a href="#" data-route="{{ route('carts.disapplycoupon') }}" style="cursor:pointer;" class="disapplycoupon">
                <i class="ri bi-trash-fill" style="font-size: 24px"></i>
            </a>
        </div>
    </div>
@endif



            </div>

            <div class="card-footer">
                <a href="{{route('user.checkout.index')}}" class="btn btn-primary btn-block">{{ __('translation.Proceed to Checkout') }}</a>
            </div>
        </div>
    </div>

    @else
    <div style="text-align:center;">
        <img style="width:50%;" src="{{asset('assets/images/emptycart.png')}}" />
        </br>
        <a class="btn btn-primary btn-block" href="{{ route('user.items.index') }}">{{ __('translation.Continue Shopping') }}</a>
    </div>
    @endif



</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        function showError(message) {
            $('.address-errors').html(`<div class="alert alert-danger" role="alert">${message}</div>`);
        }

        $(document).on('click', 'button.applycoupon', function(e) {
            e.preventDefault();
            if ($('.coupon-input').val() == '') {
                showError('{{ __('translation.Please enter coupon code') }}');
                return;
            } else {
                $('.address-errors').html('');
            }
            let form = $('#applycoupon')[0];
            let data = new FormData(form);
            let url = "{{ route('carts.applycoupon') }}";
            $.ajax({
                url: url,
                method: 'POST',
                data: data,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#cartcomponentsection').html(response);
                    location.reload();
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON.errors;
                    let errorresult = '';
                    $.each(errors, function(key, value) {
                        errorresult += `<div class="alert alert-danger" role="alert">${value}</div>`;
                    });
                    $('.address-errors').html(errorresult);
                }
            });
        });

        $(document).on('submit', '#applycoupon', function(e) {
            e.preventDefault();
            if ($('.coupon-input').val() == '') {
                showError('{{ __('translation.Please enter coupon code') }}');
                return;
            } else {
                $('.address-errors').html('');
            }
            let form = $('#applycoupon')[0];
            let data = new FormData(form);
            let url = "{{ route('carts.applycoupon') }}";
            $.ajax({
                url: url,
                method: 'POST',
                data: data,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#cartcomponentsection').html(response);
                    location.reload();
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON.errors;
                    let errorresult = '';
                    $.each(errors, function(key, value) {
                        errorresult += `<div class="alert alert-danger" role="alert">${value}</div>`;
                    });
                    $('.address-errors').html(errorresult);
                }
            });
        });

        $(document).on('click', '.disapplycoupon', function(e) {
            e.preventDefault();
            let url = $(this).data('route');
            $.ajax({
                url: url,
                method: 'GET',
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#cartcomponentsection').html(response);
                    location.reload();
                },
                error: function(response) {
                    alert('error');
                }
            });
        });
    });
</script>


@endsection
