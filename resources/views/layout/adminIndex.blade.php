@extends('layout.AdminMaster')

@section('content')


<div class="container-fluid">

 <!-- Your content here -->
    @if (session('alert.config'))
        <script>
            Swal.fire({!! session('alert.config') !!});
        </script>
    @endif

    <div class="row">
        <div class="col-xl-3">
            <div class="card overflow-hidden border-top-0">
                <div class="progress progress-sm rounded-0 bg-light" role="progressbar" 
                aria-valuenow="88" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar bg-primary" style="width: 90%"></div>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class>
                            <p class="text-muted fw-semibold fs-16 mb-1">{{__('translation.Total Orders')}}</p>

                        </div>
                        <div class="avatar-sm mb-4">
                            <div class="avatar-title bg-primary-subtle text-primary fs-24 rounded">
                                <i class="bi bi-receipt"></i>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap flex-lg-nowrap justify-content-between align-items-end">
                        <h3 class="mb-0 d-flex">({{$totalOrder}}) {{__("translation.Orders")}}</h3>

                    </div>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div><!-- end col -->

        <div class="col-xl-3">
            <div class="card overflow-hidden border-top-0">
                <div class="progress progress-sm rounded-0 bg-light" role="progressbar" aria-valuenow="88" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar bg-secondary" style="width: 40%"></div>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class>
                            <p class="text-muted fw-semibold fs-16 mb-1">{{__('translation.Active Admins')}}</p>

                        </div>
                        <div class="avatar-sm mb-4">
                            <div class="avatar-title bg-dark-subtle text-dark fs-24 rounded">
                                <i class="bi bi-people"></i>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap flex-lg-nowrap justify-content-between align-items-end">
                        <h3 class="mb-0 d-flex"><i class="bi bi-person"></i> ({{$totalAdmin}}) {{__('translation.Admins')}}</h3>

                    </div>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div><!-- end col -->


        <div class="col-xl-3">
            <div class="card overflow-hidden border-top-0">
                <div class="progress progress-sm rounded-0 bg-light" role="progressbar" aria-valuenow="88" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar bg-info" style="width: 40%"></div>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class>
                            <p class="text-muted fw-semibold fs-16 mb-1">{{__('translation.Active users')}}</p>

                        </div>
                        <div class="avatar-sm mb-4">
                            <div class="avatar-title bg-dark-subtle text-dark fs-24 rounded">
                                <i class="bi bi-people"></i>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap flex-lg-nowrap justify-content-between align-items-end">
                        <h3 class="mb-0 d-flex"><i class="bi bi-person"></i> ({{$totalUser}}) {{__("translation.Users")}} </h3>

                    </div>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div><!-- end col -->

        <div class="col-xl-3">
            <div class="card overflow-hidden border-top-0">
                <div class="progress progress-sm rounded-0 bg-light" role="progressbar" aria-valuenow="88" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar bg-success" style="width: 40%"></div>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class>
                            <p class="text-muted fw-semibold fs-16 mb-1">{{__('translation.Total Money')}}</p>

                        </div>
                        <div class="avatar-sm mb-4">
                            <div class="avatar-title bg-dark-subtle text-dark fs-24 rounded">
                                <i class="bi bi-cash"></i>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap flex-lg-nowrap justify-content-between align-items-end">
                        <h3 class="mb-0 d-flex"> {{$totalRenvue}} <i class="bi bi-currency-euro"></i>
                        </h3>

                    </div>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div><!-- end col -->


    </div><!-- end row -->

    <div class="row">

        @php

        use Carbon\Carbon;

        $today = Carbon::now();

        @endphp

        <div class="col-xxl-12 order-2 order-lg-1">
            <div class="card">
                <div class="card-header d-flex justify-content-between flex-wrap align-items-center">
                    <div>
                        <h4 class="card-title">{{__('translation.Recent Order')}}</h4>
                        <p class="text-muted fw-semibold mb-0">({{ $today->toFormattedDateString() }})</p>
                    </div>

                    <div class>

                        <a href="{{route('admin.orders.index')}}" class="btn btn-outline-primary">
                            {{__('translation.See All')}}
                        </a>

                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead>
                                <tr class="table-light text-capitalize">
                                    <th>{{__('translation.Customer')}}</th>
                                    <th>{{__('translation.Price')}}</th>
                                    <th>{{__('translation.Location')}}</th>
                                    <th>{{(__('translation.Order Code'))}}</th>
                                    <th>{{__('translation.Order Status')}}</th>
                                    <th>{{__('translation.Date Purchased')}}</th>
                                </tr>
                            </thead>
                            <!-- end table heading -->

                            <tbody>

                                @foreach($recentOrders as $order)

                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm">
                                                <img src="{{asset('assets/orderImage.jpg')}}" alt class="img-fluid rounded-circle">
                                            </div>
                                            <div class="ps-2">
                                                <h5 class="mb-1">{{$order->user->name}}</h5>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-semibold">{{ number_format($order->total_price, 2, ',', '.') }} €</span>
                                    </td>

                                    <td>
                                        <h5 class="mb-0 ms-1">{{ $order->user->addresses->first() ? $order->user->addresses->first()->city->name : 'Unknown' }}</h5>
                                    </td>
                                    <td>
                                        <h5 style="color: #af8a1d;">{{$order->order_id}}</h5>
                                    </td>
                                    <td>
                                        @if ($order->status == 'pending')
                                        <span class="badge bg-warning-subtle text-warning">{{__('translation.Pending')}}</span>
                                        @elseif($order->status == 'shipped')
                                        <span class="badge bg-success-subtle text-success">{{__('translation.Shipped')}}</span>
                                        @elseif($order->status == 'delivered')
                                        <span class="badge bg-primary-subtle text-primary">{{__('translation.Delivered')}}</span>
                                        @elseif ($order->status == 'canceled')
                                        <span class="badge bg-danger-subtle text-danger">{{__('translation.Cancelled')}}</span>
                                        @endif</span>

                                    </td>

                                    <td>{{ $order->created_at->diffForHumans() }}</td>

                                </tr>

                                @endforeach


                            </tbody>
                            <!-- end table body -->
                        </table>
                        <!-- end table -->
                    </div>

                    <div class="card-footer clearfix">
                        {{ $recentOrders->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div><!-- end col-->
    </div>
    <!-- end row -->
</div>
<form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
    @csrf
</form>
{{-- <script>
    let timeout;

    function resetTimer() {
        clearTimeout(timeout);
        timeout = setTimeout(logout, 1 * 60 * 1000); // 2 دقائق بالميلي ثانية
    }

    function logout() {
        // قم بتسجيل الخروج باستخدام طلب AJAX
        fetch("{{ route('admin.logout') }}", {
method: "POST",
headers: {
"Content-Type": "application/json",
"X-CSRF-TOKEN": "{{ csrf_token() }}"
}
}).then(response => {
if (response.ok) {
window.location.href = "/";
}
});
}

// تعقب نشاط المستخدم
window.onload = resetTimer;
document.onmousemove = resetTimer;
document.onkeypress = resetTimer;
document.onclick = resetTimer;
document.onscroll = resetTimer;
</script> --}}


@endsection
