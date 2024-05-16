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
                                                <h4 class="m-0 d-print-none">Order Bills</h4>
                                            </div>
                                        </div>

                                        <!-- Invoice Detail-->
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="float-end mt-3">
                                                    <p><b>Hello, Mohammed Jameel</b></p>
                                                    <p class="text-muted fs-13">Please find below a cost-breakdown for the recent work completed. Please make payment at your earliest convenience, and do not hesitate to contact me with any questions.</p>
                                                </div>
            
                                            </div><!-- end col -->
                                            <div class="col-sm-4 offset-sm-2">
                                                <div class="mt-3 float-sm-end">
                                                    <p class="fs-13"><strong>Order Date: </strong> &nbsp;&nbsp;&nbsp; Jan 17, 2023</p>
                                                    <p class="fs-13"><strong>Order ID: </strong> <span class="float-end">#<strong>ODR20240573</strong></span></p>
                                                </div>
                                            </div><!-- end col -->
                                        </div>
                                        <!-- end row -->
            
                                        <div class="row mt-4">
                                            <div class="col-6">
                                                <h6 class="fs-14">Company Info</h6>
                                                <address>
                                                    Elkhawas Company<br>
                                                    Great Russell St, London<br>
                                                    WC1B 3NA.<br>
                                                   Phone: (123) 456-7890
                                                </address>
                                            </div> <!-- end col-->
            
                                            <div class="col-6">
                                                <h6 class="fs-14">Order To</h6>
                                                <address>
                                                    Amy Dickson<br>
                                                    795 Folsom Ave, Suite 600<br>
                                                    San Francisco, CA 94107<br>
                                                    Phone: (123) 456-7890
                                                </address>
                                            </div> <!-- end col-->
                                        </div>    
                                        <!-- end row -->        
    
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="table-responsive">
                                                    <table class="table table-sm table-centered">
                                                        <thead class="border-top border-bottom bg-light-subtle border-light">
                                                        <tr><th>#</th>
                                                            <th>Item</th>
                                                            <th>Name</th>
                                                            <th>Quantity</th>
                                                            <th class="text-end">Total</th>
                                                        </tr></thead>
                                                        <tbody>
                                                        <tr>
                                                            <td class="">1</td>
                                                            <td class="table-user">
                                                                <img  src="{{asset('assets/images/users/avatar-2.jpg')}}" alt="table-user"
                                                                    class="me-2 rounded-circle">
                                                                Chees
                                                            </td>
                                                            <td>Milk</td>
                                                            <th>10</th>
                                                            <td class="text-end">$1799.00</td>
                                                        </tr>

                                                        <tr>
                                                            <td class="">2</td>
                                                            <td class="table-user">
                                                                <img  src="{{asset('assets/images/users/avatar-2.jpg')}}" alt="table-user"
                                                                    class="me-2 rounded-circle">
                                                                Chees
                                                            </td>
                                                            <td>Milk</td>
                                                            <th>10</th>
                                                            <td class="text-end">$1799.00</td>
                                                        </tr>
                                                        
                                                        
                                                       
    
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
                                                    <p><b>Sub-total:</b> <span class="float-end">$4120.00</span></p>
                                                    <p style="color: red;"><b>Discount:</b> <span class="float-end">(-) $0</span></p>
                                                    <p><b>VAT ( 7 %):</b> <span class="float-end">$515.00</span></p>
                                                    <h3><b>Total:</b> $4635.00 </h3>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div> <!-- end col -->
                                        </div>
                                        <!-- end row-->
    
                                        <div class="d-print-none mt-4">
                                            <div class="text-end">
                                                <div class="btn-group">
                                                    <a href="javascript:window.print()" class="btn btn-soft-primary"><i class="mdi mdi-printer-outline lh-sm"></i> Print</a>
                                                   
                                                </div>
                                                
                                            </div>
                                        </div>   
                                        <!-- end buttons -->

                                    </div> <!-- end card-body-->
                                </div> <!-- end card -->
                            </div>
						</div>
	
@endsection