@extends('layout.UserMatser')

@section('content')

<div class="row">

    <form action="{{ route('user.orders.checkout') }}" method="post">
        @csrf
        <div class="row mt-2">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title" data-toggle="modal" data-target="#exampleModal">
                            {{ __('translation.Address Details') }} <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal" style="float: right;text-transform:capitalize">{{ __('translation.Add Address') }}
                            </a></h6>
                        <hr>
                        <div class="addresses">
                            @include('users.cart.addresses')
                        </div>
                        <textarea class="form-control" name="comment" rows="5" placeholder="{{ __('translation.Your comment here') }}Your comment here ..."></textarea>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title"> {{ __('translation.Payment type') }}</h6>
                        <hr>
                        <div class="form-check">
                            <input checked value="cash" class="form-check-input" required type="radio" name="payment_type" id="cash">
                            <label style="font-weight:bold;" class="form-check-label text-primary" for="cash">
                                {{ __('translation.Cash on delivery') }}
                            </label>
                            <div class="pt-5">
                                <button type="submit" class="btn-primary btn btn-block w-100">{{ __('translation.Checkout') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @php
    use App\Models\Country;
    use App\Models\City;
    use App\Models\Area;
    $countries = Country::all();
    $Citys = City::all();
    $Areas = Area::all();

    @endphp


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="modalTitle" class="modal-title title">{{ __('translation.Add Address') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="card shadow border-0">
                        <div class="card-body px-lg-5 py-lg-5">
                            <div class="row">
                                <div class="col-lg-12" id="modalItemDetailsPart">
                                    <div id="modalItemDetailsPart">
                                        <br>
                                        <!-- Form Start -->
                                        <form method="POST" id="addaddress" action="{{ route('user.addresses.store') }}">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="label">Label</label>
                                                        <input type="text" name="label" id="label" class="form-control form-control-alternative" placeholder="Label" autofocus>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="address">{{__('translation.Address')}}</label>
                                                        <input type="text" name="address" id="address" class="form-control form-control-alternative" placeholder="Address" autofocus>

                                                    </div>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="country_id">Country</label>
                                                        <select name="country_id" id="country_id" class="form-control form-control-alternative" autofocus>
                                                            <option value="">Select Country</option>
                                                            @foreach($countries as $country)
                                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="city_id">City</label>
                                                        <select name="city_id" id="city_id" class="form-control form-control-alternative" autofocus>
                                                            <option value="">Select City</option>
                                                            @foreach($Citys as $city)
                                                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="state_id">State</label>
                                                        <select name="state_id" id="state_id" class="form-control form-control-alternative" autofocus>
                                                            <option value="">Select State</option>
                                                            @foreach($Areas as $state)
                                                            <option value="{{ $state->id }}">{{ $state->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>





                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="zip">{{__('translation.Zip')}}</label>
                                                        <input type="text" name="zip" id="zip" class="form-control form-control-alternative" placeholder="Zip" autofocus>

                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="addresserrors">
                                            </div>
                                            <div class="quantity-btn">
                                                <button type="submit" class="btn btn-primary addaddress">{{__('translation.Confirm')}}</button>
                                            </div>
                                        </form>
                                        <!-- Form End -->
                                        <div class="offcanvas offcanvas-end" id="demo">
                                            <!-- Offcanvas Modal Content -->
                                        </div>
                                    </div>
                                    <!-- Inform if closed -->
                                    <!-- End inform -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>




    <script>
        $(document).ready(function() {
            $(document).on('click', '.deleteaddress', function(e) {
                e.preventDefault();
                var url = $(this).data('route');
                $.ajax({
                    url: url
                    , type: 'POST'
                    , data: {
                        _token: '{{ csrf_token() }}'
                        , _method: 'DELETE'
                    }
                    , success: function(response) {
                        $('.addresses').html(response);
                    }
                    , error: function(response) {
                        alert('error')
                    }
                });
            });
            $(document).on('click', 'button.addaddress', function(e) {
                e.preventDefault();
                // Serialize the form data
                let form = $('#addaddress')[0];
                let data = new FormData(form);
                var url = "{{ route('user.addresses.store') }}";
                $.ajax({
                    url: url
                    , type: 'POST'
                    , data: data
                    , processData: false
                    , contentType: false
                    , success: function(response) {
                        $('.modal').modal('hide');
                        $('.addresses').html(response);
                        $('#addaddress')[0].reset();
                    }
                    , error: function(xhr) {
                        var errors = xhr.responseJSON;
                        var errorresult = '';
                        $.each(errors.errors, function(key, value) {
                            errorresult += `<div class="alert alert-danger" role="alert">${value}</div>`;
                        });
                        $('.addresserrors').html(errorresult);
                    }
                });
            });
        });

    </script>


    @endsection
