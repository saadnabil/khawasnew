@extends('layout.AdminMaster')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <!-- Invoice Logo-->
                <div class="clearfix">
                    <div class="float-start mb-3">
                        <img src="{{ asset('assets/images/tree logo.png') }}" alt="dark logo" height="40">
                    </div>
                    <div class="float-end">
                        <h4 class="m-0 d-print-none">{{ __('translation.Order Bills') }}</h4>
                    </div>
                </div>

                <!-- Invoice Detail-->
                <div class="row">
                    <div class="col-sm-6">
                        <div class="float-end mt-3">
                            <p><b>Hello, {{ $order->user->name }}</b></p>
                            <p class="text-muted fs-13">
                                {{ __('translation.Please find below a cost-breakdown for the recent work completed. Please make payment at your earliest convenience, and do not hesitate to contact me with any questions') }}.
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-4 offset-sm-2">
                        <div class="mt-3 float-sm-end">
                            <p class="fs-13"><strong>{{ __('translation.Order Date') }}: </strong> &nbsp;&nbsp;&nbsp;
                                {{ Carbon\Carbon::parse($order->created_at)->format('Y M d, H:i a') }}</p>
                            <p class="fs-13"><strong>{{ __('translation.Order ID') }}: </strong>
                                <span class="float-end">#<strong>{{ $order->order_id }}</strong></span></p>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-6">
                        <h6 class="fs-14">{{ __('translation.Company Info') }}</h6>
                        <address>
                            Elkhawas Trade<br>
                            Germeny, Germeny<br>
                            germeny 847.<br>
                            Phone: 0599094210
                        </address>
                    </div>
                    <div class="col-6">
                        <h6 class="fs-14">{{ __('translation.Order To') }}</h6>
                        <address>
                            {{ $order->user->name }}<br>
                            {{ $order->user->addresses->first() ? $order->user->addresses->first()->city->name : 'Unknown' }}<br>
                            {{ $order->user->addresses->first() ? $order->user->addresses->first()->state->name : 'Unknown' }}.<br>
                            {{ __('translation.PHONE NUMBER') }}: {{ $order->user->phone }}
                        </address>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-sm table-centered">
                                <thead class="border-top border-bottom bg-light-subtle border-light">
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('translation.Item') }}</th>
                                        <th>{{ __('translation.NAME') }}</th>
                                        <th>{{ __('translation.Quantity') }}</th>
                                        <th class="text-end">{{ __('translation.Total') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $counter = 1; @endphp
                                    @foreach($order->order_details as $orderdetail)
                                    <tr>
                                        <td class="text-start ">{{ $counter++ }}</td>
                                        <td class="table-user">
                                            <img src="{{ $orderdetail->item->image ? url('storage/' . $orderdetail->item->image) : url('item.png') }}" alt="table-user" class="me-2 rounded-circle">
                                            {{ $orderdetail->item->title[app()->getLocale()] }}
                                        </td>
                                        <td>{{ $orderdetail->item->unit[app()->getLocale()] }}</td>
                                        <th>{{ $orderdetail->quantity }}</th>
                                        <td class="text-end">
                                        {{ number_format($orderdetail->item->total_price, 2, ',', '.') }} ₺
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6"></div>
                    <div class="col-sm-6">
                        <div class="float-end mt-3 mt-sm-0">
                            <p><b>{{ __('translation.Sub Total') }}:</b>
                             <span class="float-end">${{ $order->subtotal }}</span></p>
                            <p style="color: red;"><b>Discount:</b> <span class="float-end">
                            (-) ${{ $order->coupon ? $order->coupon->discount : 0 }}</span></p>
                            <p><b>{{ __('translation.VAT') }}:</b>
                                <span class="float-end">
                                    @if($order->item && $order->item->tax)
                                    {{ $order->item->tax }}
                                    @else
                                    {{'No Tax Available'}}
                                    @endif
                                </span>
                            </p>
                            <h3><b>{{ __('translation.Total') }}:</b> 
                            {{ number_format($order->total_price, 2, ',', '.') }} €</h3>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>

                <!-- Page Break -->
                <div class="page-break"></div>

                <!-- Page Two -->
                <div class="container-fluid d-flex justify-content-between">
                    <div class="col-lg-3 ps-0">
                        <a href="#" class="noble-ui-logo logo-light d-block mt-3">Elkhawas<span>LTD</span></a>
                        <p class="mt-1 mb-1"><b>Elkhawas Company</b></p>
                        <p>108,<br> Great Russell St,<br>London, WC1B 3NA.</p>
                    </div>
                    <div class="col-lg-3 pe-0">
                        <h4 class="fw-bolder text-uppercase text-end mt-4 mb-2">{{ __('translation.Orders') }}</h4>
                        <h6 class="text-end mb-5 pb-4">#{{ $order->order_id }}</h6>
                        <p class="text-end mb-1">{{ __('translation.Balance Due') }}</p>
                        <h4 class="text-end fw-normal">${{ $order->total_price }}</h4>
                        <h6 class="mb-0 mt-3 text-end fw-normal mb-2">
                            <span class="text-muted">{{ __('translation.Date Purchased') }} :</span> {{ Carbon\Carbon::parse($order->created_at)->format('Y M d, H:i a') }}
                        </h6>
                        @if($order->shipped_date)
                        <h6 class="mb-0 mt-3 text-end fw-normal mb-2">
                            <span class="text-muted">{{ __('translation.Shipped Date') }} :</span> {{ Carbon\Carbon::parse($order->shipped_date)->format('Y M d, H:i a') }}
                        </h6>
                        @endif
                    </div>
                </div>

                <div class="container-fluid mt-5 d-flex justify-content-center w-100">
                    <div class="table-responsive w-100">
                        <table class="table table-sm table-centered">
                            <thead class="border-top border-bottom bg-light-subtle border-light">
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('translation.Item') }}</th>
                                    <th>{{ __('translation.NAME') }}</th>
                                    <th>{{ __('translation.Quantity') }}</th>
                                    <th class="text-end">{{ __('translation.Total') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $counter = 1; @endphp
                                @foreach($order->order_details as $orderdetail)
                                <tr>
                                    <td class="text-start">
                                        <div class="form-check" style="margin:10px auto;">
                                            <input  class="form-check-input" type="checkbox" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault"></label>
                                        </div>
                                    </td>

                                    <td class="table-user">
                                        <img src="{{ $orderdetail->item->image ? url('storage/' . $orderdetail->item->image) : url('item.png') }}" alt="table-user" class="me-2 rounded-circle">
                                        {{ $orderdetail->item->title[app()->getLocale()] }}
                                    </td>
                                    <td>{{ $orderdetail->item->unit[app()->getLocale()] }}</td>
                                    <th>{{ $orderdetail->quantity }}</th>
                                    <td class="text-end">
                                        {{ number_format($orderdetail->item->total_price, 2, ',', '.') }} €
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="signatures container-fluid" style="margin-top:20px;">
                    <br>
                    <hr>
                    <br>
                    <div class="row">
                        <div class="col-6">
                            <p style="margin-bottom: 10px;"><strong>{{ __('translation.Employee') }}</strong></p>
                            <p style="margin-bottom: 10px;">{{ __('translation.Signature') }}: -----------------------------------</p>
                        </div>
                        <div class="col-6">
                            <p style="margin-bottom: 10px;"><strong>{{ __('translation.Client') }}</strong></p>
                            <p style="margin-bottom: 10px;">{{ __('translation.Signature') }}: -----------------------------------</p>
                        </div>
                    </div>
                </div>

                <div class="d-print-none mt-4">
                    <div class="text-end">
                        <div class="btn-group">
                            <a href="javascript:window.print()" class="btn btn-soft-primary">
                                <i class="mdi mdi-printer-outline lh-sm"></i> {{ __('translation.Print') }}
                            </a>
                        </div>
                    </div>
                </div>

            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div>
</div>

@endsection

<!-- CSS for page break and checkbox styling -->
<style>
    @media print {
        .page-break {
            page-break-before: always;
            display: block;
            height: 0;
        }

        .d-print-none {
            display: none;
        }

        /* Make sure the checkbox is visible in print */
        .text-start div {
            display: block;
        }
    }

</style>
