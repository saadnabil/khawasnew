@extends('layout.UserMatser')

@section('content')

   <div class="row">




                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title" data-toggle="modal" data-target="#exampleModal">
                                        Address Details <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal" style="float: right;text-transform:capitalize">Add Address
                                            </a></h6>
                                    <hr>
                                    <div class="addresses">
                                        <div class="form-check">
                <input required="" class="form-check-input" type="radio" name="address_id" value="24" id="flexRadioDefault0">
                <label style="font-weight:bold;" class="form-check-label text-primary" for="flexRadioDefault0">
                    Work
                </label>
                <p class="mb-1 mt-2">Abbas Elakkad street, 20 Building Elobour</p>
                <p class="mb-1"><span class="text-warning">City</span>:
                    Cairo</p>
                <p class="mb-1"><span class="text-warning">State</span>:
                    Shoubra</p>
                <p class="mb-1"><span class="text-warning">Zip</span>:
                    2252</p>
                    </div>
            <hr>
            
        
                                    </div>
                                    <textarea class="form-control" name="comment" rows="5" placeholder="Your comment hereYour comment here ..."></textarea>
                                </div>
                            </div>
                        </div>





                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title"> Payment type</h6>
                                    <hr>
                                    <div class="form-check">
                                        <input checked="" value="cash" class="form-check-input" required="" type="radio" name="payment_type" id="cash">
                                        <label style="font-weight:bold;" class="form-check-label text-primary" for="cash">
                                            Cash on delivery
                                        </label>
                                        <div class="pt-5">
                                            <button type="submit" class="btn-primary btn btn-block w-100">Checkout</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>







                </div>
          
    
@endsection