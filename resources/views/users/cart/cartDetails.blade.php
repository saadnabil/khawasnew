@extends('layout.UserMatser')

@section('content')

   <div class="row">




                        <div class="col-md-8 ">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">Cart Details</h6>
                                    <hr>
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Item</th>
                                                    <th>Price</th>
                                                    <th>Quantity</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <tr>
                                                    <td>
                                                        <img src="assets/images/tree logo.png" alt="not found"
                                                            width="60" height="60">
                                                        Est eius hic dicta d
                                                    </td>
                                                    <td>1 x
                                                        €605</td>
                                                    <td>
                                                        <div class="input-group quantity mx-auto" style="">
                                                            <div class="buttondiv">
                                                                <button type="button" class="btn btn-success btn-sm">
                                                                    <i class="ri bi-dash-circle-fill"></i>
                                                                </button>
                                                                <button type="button" class="btn btn-success btn-sm">
                                                                    <i class="ri bi-plus-circle-fill"></i>
                                                                </button>
                                                                <button type="button" class="btn btn-danger btn-sm">
                                                                    <i class="ri bi-trash-fill"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td> 605.00€</td>

                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="assets/images/brands/bankpayment.png" alt="not found"
                                                            width="60" height="60">
                                                        Nisi maxime aliqua
                                                    </td>
                                                    <td>1 x
                                                        €393</td>
                                                    <td>
                                                        <div class="input-group quantity mx-auto" style="">
                                                            <div class="buttondiv">
                                                                <button type="button" class="btn btn-success btn-sm">
                                                                    <i class="ri bi-dash-circle-fill"></i>
                                                                </button>
                                                                <button type="button" class="btn btn-success btn-sm">
                                                                    <i class="ri bi-plus-circle-fill"></i>
                                                                </button>
                                                                <button type="button" class="btn btn-danger btn-sm">
                                                                    <i class="ri bi-trash-fill"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td> 393.00€</td>

                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="assets/images/brands/bank.jpg" alt="not found"
                                                            width="60" height="60">
                                                        Rerum est explicabo
                                                    </td>
                                                    <td>1 x
                                                        €664</td>
                                                    <td>
                                                        <div class="input-group quantity mx-auto" style="">
                                                            <div class="buttondiv">
                                                                <button type="button" class="btn btn-success btn-sm">
                                                                    <i class="ri bi-dash-circle-fill"></i>
                                                                </button>
                                                                <button type="button" class="btn btn-success btn-sm">
                                                                    <i class="ri bi-plus-circle-fill"></i>
                                                                </button>
                                                                <button type="button" class="btn btn-danger btn-sm">
                                                                    <i class="ri bi-trash-fill"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td> 664.00€</td>

                                                </tr>

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
                                        <h2 class="mb-0">Cart Summary</h2>
                                    </div>
                                    <hr>
                        
                                    <div class="d-flex justify-content-between pb-2">
                                        <div><strong>Subtotal</strong></div>
                                        <div><strong>1662€</strong></div>
                                    </div>
                        
                                    <div class="input-group apply-coupon mt-4">
                                        <input required="" type="text" name="code" placeholder="Coupon Code" class="form-control coupon-input">
                                        <button class="btn btn-primary apply-coupon coupon-button" type="button">Apply Coupon</button>
                                    </div>
                                    <div class="address-errors mt-2"></div>
                                </div>
                        
                                <div class="card-footer">
                                    <a href="{{route('user.checkout.index')}}" class="btn btn-primary btn-block">Proceed to Checkout</a>
                                </div>
                            </div>
                        </div>
                        




                </div>
    
@endsection