@extends('layout.UserMatser')

@section('content')

<div class="row">

    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <!-- Invoice Logo-->
                <div class="clearfix">
                    <div class="float-start mb-3">
                        <img src="{{asset('assets/images/tree logo.png')}}" alt="dark logo" height="40">
                    </div>
                    <div class="float-end">
                        <h4 class="m-0 d-print-none">{{__('translation.Order Bills')}}</h4>
                    </div>
                </div>

                <!-- Invoice Detail-->
                <div class="row">
                    <div class="col-sm-6">
                        <div class="float-end mt-3">
                            <p><b>Hello, {{ $order->user->name }}</b></p>
                            <p class="text-muted fs-13">{{__('translation.Please find below a cost-breakdown for the recent work completed. Please make payment at your earliest convenience, and do not hesitate to contact me with any questions')}}.</p>
                        </div>

                    </div><!-- end col -->
                    <div class="col-sm-4 offset-sm-2">
                        <div class="mt-3 float-sm-end">
                            <p class="fs-13"><strong>{{__('translation.Order Date')}}: </strong>
                                {{($order->created_at->diffForHumans()) }}</p>
                            <p class="fs-13"><strong>{{__('translation.Order ID')}}: </strong> <span class="float-end">#<strong>{{ $order->order_id }}</strong></span></p>
                        </div>
                    </div><!-- end col -->
                </div>
                <!-- end row -->

                <div class="row mt-4">
                    <div class="col-6">
                        <h6 class="fs-14">{{__('translation.Company Info')}}</h6>
                        <address>
                            Elkhawas Trade<br>
                            Great Russell St, London<br>
                            WC1B 3NA.<br>
                            Phone: (123) 456-7890
                        </address>
                    </div> <!-- end col-->

                    <div class="col-6">
                        <h6 class="fs-14">{{__('translation.Order To')}}</h6>
                        <address>
                            {{ $order->user->name }}<br>
                            {{ $order->user->addresses->first() ? $order->user->addresses->first()->city->name : 'Unknown' }}<br>
                           {{ $order->user->addresses->first() ? $order->user->addresses->first()->state->name : 'Unknown' }}.<br>
                            {{__('translation.PHONE NUMBER')}}: {{ $order->user->phone  }}
                        </address>
                    </div> <!-- end col-->
                </div>
                
                <!-- end row -->
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-sm table-centered">
                                <thead class="border-top border-bottom bg-light-subtle border-light">
                                    <tr>
                                        <th>#</th>
                                        <th>{{__('translation.Item')}}</th>
                                        <th>{{__('translation.Unit Price')}}</th>
                                        <th>{{__('translation.Quantity')}}</th>
                                        <th class="text-end">{{__('translation.Total')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $counter = 1;
                                    @endphp
                                    @foreach($order->order_details as $key => $orderdetail)


                                    <tr>
                                        <td class="">{{$counter}}</td>
                                        <td class="table-user">
                                            <img src="{{ $orderdetail->item->image != null ? url('storage/' . $orderdetail->item->image) : url('item.png') }}" alt="table-user" class="me-2 rounded-circle">
                                            {{$orderdetail->item->title[app()->getLocale()]}}
                                        </td>
                                        <td>${{ $orderdetail->item->unit_price }}</td>
                                        <th>{{ $orderdetail->quantity }}</th>
                                        <td class="text-end">$ {{ $orderdetail->item->total_price }}</td>
                                    </tr>

                                    @php
                                    $counter ++;
                                    @endphp
                                    @endforeach


                                </tbody>
                            </table>
                        </div> <!-- end table-responsive-->
                    </div> <!-- end col -->
                </div>
                <!-- end row -->
                <div class="row">
                    <div class="col-sm-6">

                    </div> <!-- end col -->
                    <div class="col-sm-6">
                        <div class="float-end mt-3 mt-sm-0">
                            <p><b>{{__('translation.Sub Total')}}:</b> <span class="float-end">${{ $order->subtotal }}</span></p>
                            <p style="color: red;"><b>{{__('translation.Discount')}}:</b> <span class="float-end">(-) ${{ $order->coupon ? $order->coupon->discount : 0 }}</span></p>
                            <p><b>{{__('translation.VAT')}} ( 0 %):</b> <span class="float-end">$0.00</span></p>
                            <h3><b>{{__('translation.Total')}}:</b>${{ $order->total_price }} </h3>
                        </div>
                        <div class="clearfix"></div>
                    </div> <!-- end col -->
                </div>
                <!-- end row-->

                <div class="d-print-none mt-4">
                    <div class="text-end">
                        <div class="btn-group">
                            <a href="javascript:window.print()" class="btn btn-soft-primary"><i class="mdi mdi-printer-outline lh-sm"></i> {{__('translation.Print')}}</a>

                        </div>


                    </div>
                    @if($order->status == 'pending')
                    <a href="#" onclick="confirmCancel(event, {{ $order->id }});" class="btn btn-outline-danger float-end mt-4">
                        <i class="ri-close-line"></i> {{__('translation.Cancelled')}}
                    </a>
                    <form id="cancel-order-form-{{ $order->id }}" action="{{ route('user.orders.cancel', $order) }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    @endif

                </div>
                <!-- end buttons -->

            </div> <!-- end card-body-->
        </div> <!-- end card -->
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    function confirmCancel(event, orderId) {
        event.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: 'You are sure to cancel this order!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, cancel it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('cancel-order-form-' + orderId).submit();
            }
        });
    }
</script>

@endsection
