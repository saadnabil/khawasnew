@extends('layout.AdminMaster')

@section('content')


 <div class="container-fluid">

                    <div class="row">
                        <div class="col-xl-3">
                            <div class="card overflow-hidden border-top-0">
                                <div class="progress progress-sm rounded-0 bg-light" role="progressbar" aria-valuenow="88" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar bg-primary" style="width: 90%"></div>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class>
                                            <p class="text-muted fw-semibold fs-16 mb-1">Total
                                                orders</p>

                                        </div>
                                        <div class="avatar-sm mb-4">
                                            <div class="avatar-title bg-primary-subtle text-primary fs-24 rounded">
                                                <i class="bi bi-receipt"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-wrap flex-lg-nowrap justify-content-between align-items-end">
                                        <h3 class="mb-0 d-flex"><i class="bi bi-currency-dollar"></i>{{$totalOrder}} </h3>

                                    </div>
                                </div><!-- end card-body -->
                            </div><!-- end card -->
                        </div><!-- end col -->

                        <div class="col-xl-3">
                            <div class="card overflow-hidden border-top-0">
                                <div class="progress progress-sm rounded-0 bg-light" role="progressbar" aria-valuenow="88" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar bg-dark" style="width: 40%"></div>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class>
                                            <p class="text-muted fw-semibold fs-16 mb-1">Active Admins</p>

                                        </div>
                                        <div class="avatar-sm mb-4">
                                            <div class="avatar-title bg-dark-subtle text-dark fs-24 rounded">
                                                <i class="bi bi-people"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-wrap flex-lg-nowrap justify-content-between align-items-end">
                                        <h3 class="mb-0 d-flex"><i class="bi bi-person"></i> {{$totalAdmin}}</h3>

                                    </div>
                                </div><!-- end card-body -->
                            </div><!-- end card -->
                        </div><!-- end col -->


                        <div class="col-xl-3">
                            <div class="card overflow-hidden border-top-0">
                                <div class="progress progress-sm rounded-0 bg-light" role="progressbar" aria-valuenow="88" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar bg-dark" style="width: 40%"></div>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class>
                                            <p class="text-muted fw-semibold fs-16 mb-1">Active users</p>

                                        </div>
                                        <div class="avatar-sm mb-4">
                                            <div class="avatar-title bg-dark-subtle text-dark fs-24 rounded">
                                                <i class="bi bi-people"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-wrap flex-lg-nowrap justify-content-between align-items-end">
                                        <h3 class="mb-0 d-flex"><i class="bi bi-person"></i> {{$totalUser}} </h3>

                                    </div>
                                </div><!-- end card-body -->
                            </div><!-- end card -->
                        </div><!-- end col -->

                        <div class="col-xl-3">
                            <div class="card overflow-hidden border-top-0">
                                <div class="progress progress-sm rounded-0 bg-light" role="progressbar" aria-valuenow="88" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar bg-dark" style="width: 40%"></div>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class>
                                            <p class="text-muted fw-semibold fs-16 mb-1">Total Money</p>

                                        </div>
                                        <div class="avatar-sm mb-4">
                                            <div class="avatar-title bg-dark-subtle text-dark fs-24 rounded">
                                                <i class="bi bi-cash"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-wrap flex-lg-nowrap justify-content-between align-items-end">
                                        <h3 class="mb-0 d-flex"><i class="bi bi-person"></i> {{$totalRenvue}} </h3>

                                    </div>
                                </div><!-- end card-body -->
                            </div><!-- end card -->
                        </div><!-- end col -->


                    </div><!-- end row -->

                    <div class="row">


                        <div class="col-xxl-12 order-2 order-lg-1">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between flex-wrap align-items-center">
                                    <div>
                                        <h4 class="card-title">Recent Order</h4>
                                        <p class="text-muted fw-semibold mb-0">Order Based on Payment</p>
                                    </div>

                                    <div class>
                                        <a class="btn btn-outline-secondary me-2">
                                            <i class="mdi mdi-filter-outline pe-1 lh-1"></i>Filter
                                        </a>
                                        <a class="btn btn-outline-primary">
                                            See All
                                        </a>

                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table align-middle mb-0">
                                            <thead>
                                                <tr class="table-light text-capitalize">
                                                    <th>Customer</th>
                                                    <th>Price</th>
                                                    <th>Location</th>
                                                    <th>Requested by</th>
                                                    <th>Order</th>
                                                </tr>
                                            </thead>
                                            <!-- end table heading -->

                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar-sm">
                                                                <img src="assets/images/users/avatar-9.jpg" alt class="img-fluid rounded-circle">
                                                            </div>
                                                            <div class="ps-2">
                                                                <h5 class="mb-1">Dana Graves</h5>
                                                                <p class="text-muted fs-6 mb-0">ORD-1562792771583</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="fw-semibold">$98.59</span>
                                                    </td>
                                                    <td>
                                                        <h5 class="mb-0 ms-1">America</h5>
                                                    </td>
                                                    <td>
                                                        <h5 class="mb-0">Wade Warren</h5>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-primary-subtle text-primary">Pending
                                                            Approval</span>
                                                    </td>

                                                </tr>

                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar-sm">
                                                                <img src="assets/images/users/avatar-3.jpg" alt class="img-fluid rounded-circle">
                                                            </div>
                                                            <div class="ps-2">
                                                                <h5 class="mb-1 text-capitalize">Floyd Smith</h5>
                                                                <p class="text-muted fs-6 mb-0">ORD-1562792772493</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="fw-semibold">$32.59</span>
                                                    </td>
                                                    <td>
                                                        <h5 class="mb-0 ms-1">Russia</h5>
                                                    </td>
                                                    <td>
                                                        <h5 class="mb-0">Esther Howard</h5>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-danger-subtle text-danger">Cancelled
                                                            Requested</span>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar-sm">
                                                                <img src="assets/images/users/avatar-6.jpg" alt class="img-fluid rounded-circle">
                                                            </div>
                                                            <div class="ps-2">
                                                                <h5 class="mb-1">Fernanda Azevedo</h5>
                                                                <p class="text-muted fs-6 mb-0">ORD-1562792771583</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="fw-semibold">$18.24</span>
                                                    </td>
                                                    <td>
                                                        <h5 class="mb-0 ms-1">Brazil</h5>
                                                    </td>
                                                    <td>
                                                        <h5 class="mb-0">Brooklyn...</h5>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-success-subtle text-success">Approved</span>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar-sm">
                                                                <img src="assets/images/users/avatar-4.jpg" alt class="img-fluid rounded-circle">
                                                            </div>
                                                            <div class="ps-2">
                                                                <h5 class="mb-1">Martine Tollmache</h5>
                                                                <p class="text-muted fs-6 mb-0">ORD-1562792780452</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="fw-semibold">$42.24</span>
                                                    </td>
                                                    <td>
                                                        <h5 class="mb-0 ms-1">Los Angeles</h5>
                                                    </td>
                                                    <td>
                                                        <h5 class="mb-0 text-capitalize">Arlene Mccoy</h5>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-primary-subtle text-primary">Pending
                                                            Approval</span>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar-sm">
                                                                <img src="assets/images/users/avatar-11.jpg" alt class="img-fluid rounded-circle">
                                                            </div>
                                                            <div class="ps-2">
                                                                <h5 class="mb-1">Freja Sjöberg</h5>
                                                                <p class="text-muted fs-6 mb-0">ORD-1562792776427</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="fw-semibold">$113.39</span>
                                                    </td>
                                                    <td>
                                                        <h5 class="mb-0 ms-1">Miami</h5>
                                                    </td>
                                                    <td>
                                                        <h5 class="mb-0">Jerome Bell</h5>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-danger-subtle text-danger">Cancalled
                                                            Requested</span>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar-sm">
                                                                <img src="assets/images/users/avatar-7.jpg" alt class="img-fluid rounded-circle">
                                                            </div>
                                                            <div class="ps-2">
                                                                <h5 class="mb-1">Daniel J. Heim</h5>
                                                                <p class="text-muted fs-6 mb-0">ORD-1562792781478</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="fw-semibold">$10.39</span>
                                                    </td>
                                                    <td>
                                                        <h5 class="mb-0 ms-1">Indianapolis</h5>
                                                    </td>
                                                    <td>
                                                        <h5 class="mb-0">Courtney Henry</h5>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-success-subtle text-success">Approved</span>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar-sm">
                                                                <img src="assets/images/users/avatar-5.jpg" alt class="img-fluid rounded-circle">
                                                            </div>
                                                            <div class="ps-2">
                                                                <h5 class="mb-1">Sandra Fraser</h5>
                                                                <p class="text-muted fs-6 mb-0">ORD-1562792779615</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="fw-semibold">$95.24</span>
                                                    </td>
                                                    <td>
                                                        <h5 class="mb-0 ms-1">Stlouis</h5>
                                                    </td>
                                                    <td>
                                                        <h5 class="mb-0">Guy Hawkins</h5>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-danger-subtle text-danger">Cancelled
                                                            requested</span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <!-- end table body -->
                                        </table>
                                        <!-- end table -->
                                    </div>
                                </div>
                            </div>
                        </div><!-- end col-->
                    </div>
                    <!-- end row -->
                </div>
    
@endsection