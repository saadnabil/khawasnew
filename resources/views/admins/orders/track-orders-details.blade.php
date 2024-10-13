@extends('layout.AdminMaster')

@section('content')

@php
$status_arr = [
'pending' => 'text-warning',
'canceled' => 'text-danger',
'delivered' => 'text-success',
];
@endphp

<div class="row">

    <div class="col-8">
        <div class="card">
            <div class="card-body">

                <!-- Invoice Logo-->
                <div class="clearfix">
                    <div class="float-start mb-3">
                        <img src="{{asset('assets/images/tree logo.png')}}" alt="dark logo" height="40">
                    </div>
                    <div class="float-end">
                        <h4 class="m-0 d-print-none">{{(__('translation.Order Bills'))}}</h4>
                    </div>
                </div>

                <!-- Invoice Detail-->
                <div class="row">
                    <div class="col-sm-6">
                        <div class="float-end mt-3">
                            <p><b>Hello, {{ $order->user->name }}</b></p>
                            <p class="text-muted fs-13">{{(__('translation.Please find below a cost-breakdown for the recent work completed. Please make payment at your earliest convenience, and do not hesitate to contact me with any questions'))}}.</p>
                        </div>

                    </div><!-- end col -->
                    <div class="col-sm-4 offset-sm-2">
                        <div class="mt-3 float-sm-end">
                            <p class="fs-13"><strong>{{(__('translation.Order Date'))}}: </strong>
                                &nbsp;&nbsp;&nbsp; {{Carbon\Carbon::parse($order->created_at)->format('Y M d, H:i a')  }}</p>
                            <p class="fs-13"><strong>{{(__('translation.Order Status'))}}: </strong>
                                <span class="{{ isset($status_arr[$order->status]) ? $status_arr[$order->status] : 'text-success' }}">{{ $order->status }}</span>
                            </p>
                            <p class="fs-13"><strong>{{(__('translation.Order ID'))}}: </strong> <span class="float-end">#<strong>{{ $order->order_id }}</strong></span></p>
                        </div>
                    </div><!-- end col -->
                </div>
                <!-- end row -->

                <div class="row mt-4">
                    <div class="col-6">
                        <h6 class="fs-14">{{(__('translation.Company Info'))}}</h6>
                        <address>
                            Elkhawas Trade<br>
                            Germeny, Germeny<br>
                            germeny 847.<br>
                            Phone: 0599094210
                        </address>
                    </div> <!-- end col-->

                    <div class="col-6">
                        <h6 class="fs-14">{{(__('translation.Order To'))}}</h6>
                        <address>
                            {{ $order->user->name }}<br>
                            {{ $order->address->address }}, {{ $order->address->city  }}<br>
                            {{ $order->address->state  }}.<br>
                            {{(__('translation.PHONE NUMBER'))}}: {{ $order->user->phone  }}
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
                                        <th>{{(__('translation.Item'))}}</th>
                                        <th>{{(__('translation.Unit Price'))}}</th>
                                        <th>{{(__('translation.Quantity'))}}</th>
                                        <th class="text-end">{{(__('translation.Total'))}}</th>
                                    </tr>
                                </thead>
                                <tbody>


                                    @php
                                    $counter = 1;
                                    @endphp

                                    @foreach($order->order_details as $key => $orderdetail)
                                    <tr>
                                        <td class="">{{ $counter }}</td>
                                        <td class="table-user">
                                            <img src="{{ $orderdetail->item->image != null ? url('storage/' . $orderdetail->item->image) : url('item.png') }}" alt="table-user" class="me-2 rounded-circle">
                                            {{ $orderdetail->item->title[app()->getLocale()] }}
                                        </td>
                                        <td>{{ $orderdetail->item->unit_price }}</td>
                                        <th>{{ $orderdetail->quantity }}</th>
                                        <td class="text-end">
                                            {{ number_format($orderdetail->item->total_price, 2, ',', '.') }} €
                                        </td>
                                    </tr>

                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <!-- end table-responsive-->
                    </div> <!-- end col -->
                </div>
                <!-- end row -->
                <div class="row">
                    <div class="col-sm-6">

                    </div> <!-- end col -->
                    <div class="col-sm-6">
                        <div class="float-end mt-3 mt-sm-0">
                            <p><b>{{__("translation.Sub Total")}}:</b> <span class="float-end">${{ $order->subtotal }}</span></p>
                            <p style="color: red;"><b>{{__('translation.Discount')}}:</b> <span class="float-end">(-) ${{ $order->coupon ? $order->coupon->discount : 0 }}</span></p>
                            <p><b>{{__('translation.VAT')}} ( 7 %):</b> <span class="float-end">$0.00</span></p>
                            <h3><b>{{__("translation.Total")}}:</b> {{ number_format($order->total_price, 2, ',', '.') }} € </h3>
                        </div>
                        <div class="clearfix"></div>
                    </div> <!-- end col -->
                </div>
                <!-- end row-->

                <div class="d-print-none mt-4">
                    <div class="text-end">
                        <div class="btn-group">
                            <a href="{{route('admin.orders.index')}}" class="btn btn-secondary">
                                {{__('translation.Back')}} </a>



                            @can('order-send-invoice')

                            <div class="dropdown">
                                <button class="btn  btn-primary dropdown-toggle" type="button" role="button"
                                 id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true"
                                  aria-expanded="false">
                                    {{ __('translation.Send Invoice') }}
                                </button>

                                <div class="dropdown-menu p-3" aria-labelledby="dropdownMenuLink">
                                    <form id="sendInvoiceForm" method="post" action="{{ route('admin.orders.sendinvoice') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="user">Choose a user to send the invoice:</label>
                                            <select id="user" name="email" class="form-control select2" style="width:max-content" required>
                                                <option value="">Select a user</option>
                                                @foreach($users as $user)
                                                <option value="{{ $user->email }}">{{ $user->name }} ({{ $user->email }})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <input type="hidden" name="order_id" value="{{ $order->id }}" />
                                        <button type="submit" class="btn btn-primary mt-2">{{ __('translation.Send Invoice') }}</button>
                                    </form>
                                </div>
                            </div>


                            @endcan
                        </div>

                    </div>
                </div>
                <!-- end buttons -->

            </div> <!-- end card-body-->
        </div> <!-- end card -->
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h2 class="h4 mb-3">{{__('translation.Order Status')}}</h2>
                <form method="post" action="{{ route('admin.orders.updatestatus') }}">
                    @csrf
                    <input type="hidden" name="order_id" value="{{ $order->id }}" />
                    <div class="mb-3">
                        <select name="status" class="form-control">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>{{__('translation.Pending')}}</option>
                            <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>{{__('translation.Shipped')}}</option>
                            <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>{{__('translation.Delivered')}}</option>
                            <option value="canceled" {{ $order->status == 'canceled' ? 'selected' : '' }}>{{__('translation.Cancelled')}}</option>
                        </select>
                        @error('status')
                        <div class="mt-1" style="font-size: 12px;color:red;font-weight:bold;">
                            {{ $message }}</div>
                        @enderror
                    </div>
                    @php
                    $statusdates = [
                    'pending' => $order->pending_date,
                    'shipped' => $order->pending_date,
                    'delivered' => $order->pending_date,
                    'canceled' => $order->canceled_date,
                    ];
                    @endphp


                    <input type="date" name="date" value="{{ $statusdates[$order->status] }}" class="form-control">
                    @error('date')
                    <div class="mt-1" style="font-size: 12px;color:red;font-weight:bold;">
                        {{ $message }}</div>
                    @enderror
                    <br>
                    <div class="mb-3">
                        <button class="btn btn-primary" type="submit">{{__('translation.Update')}}</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<!-- Include the Select2 library if not already included -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('.select2').select2({
            width: '100%',
            dropdownParent: $('.dropdown-menu') // Ensures the dropdown menu is within the parent dropdown
        });
    });
</script>


@endsection
