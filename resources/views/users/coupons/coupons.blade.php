@extends('layout.UserMatser')

@section('content')
   <div class="row">

                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-header">
                                    <h2 class="h5 mb-0 pt-2 pb-2">
                                        <div class="icon-item" style="display: flex; align-items: center;">
                                            <i class="bi bi-bookmark-star me-3 fs-20"></i><span>Coupons</span>
                                        </div>

                                    </h2>
                                </div>
                                <div class="card-body p-4 wishlist-items">
                                    <div
                                        class="d-sm-flex justify-content-between ">
                                        <div class="d-block d-sm-flex align-items-start text-center text-sm-start">
                                            <div class="pt-2">
                                                <h4 class="product-title fs-base mb-2 text-primary couponcode">HELLO25
                                                </h4>
                                                <div class="fs-lg text-accent pt-2">Valid
                                                    To : <span class="badge bg-info">2024
                                                        May 30 , 04:39
                                                        pm</span></div>

                                                <div class="fs-lg text-accent pt-2">Discount
                                                    : <span class="badge bg-primary">10%</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="pt-2 ps-sm-3 mx-auto mx-sm-0 text-center">
                                            <button data-coupon="HELLO25"
                                                class="btn btn-outline-primary "
                                                type="button">
                                               Copy</button>

                                        </div>
                                    </div>
                                    <hr>

                                    <div
                                        class="d-sm-flex justify-content-between ">
                                        <div class="d-block d-sm-flex align-items-start text-center text-sm-start">
                                            <div class="pt-2">
                                                <h4 class="product-title fs-base mb-2 text-primary couponcode">Hel20252
                                                </h4>
                                                <div class="fs-lg text-accent pt-2">Valid
                                                    To : <span class="badge bg-info">2024
                                                        Apr 28 , 04:39
                                                        pm</span></div>

                                                <div class="fs-lg text-accent pt-2">Discount
                                                    : <span class="badge bg-primary">10%</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="pt-2 ps-sm-3 mx-auto mx-sm-0 text-center">
                                            <button data-coupon="Hel20252"
                                                class="btn btn-outline-primary "
                                                type="button">
                                              Copy</button>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
    
@endsection