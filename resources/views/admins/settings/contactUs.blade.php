@extends('layout.AdminMaster')

@section('content')
    <div class="container-fluid">

        <div class="row">

            <form action="{{ $action }}" method="post" enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class=".card-title">Contact us Settings</h4>
                                @if ($errors->any())
                    <div>
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="row g-2">

                                    <div class="mb-3 col-md-4">
                                        <label for="phone" class="form-label">
                                            Phone </label>
                                        <input name="phone" value="{{ old('phone', $contact->phone) }}" type="text"
                                            class="form-control" id="phone">
                                    </div>

                                    <div class="mb-3 col-md-4">
                                        <label for="email" class="form-label">
                                            Email </label>
                                        <input name="email" value="{{ old('email', $contact->email) }}" type="text"
                                            class="form-control" id="email">
                                    </div>

                                    <div class="mb-3 col-md-4">
                                        <label for="Company" class="form-label">Company Name
                                        </label>
                                        <input name="CompanyName" value="{{ $contact->CompanyName }}" type="text"
                                            class="form-control" id="Company">
                                    </div>



                                    <div class="mb-3 col-md-4">
                                        <label for="Address" class="form-label">
                                            Address </label>
                                        <input name="address" value="{{ $contact->address }}" type="text"
                                            class="form-control" id="Address">
                                    </div>

                                    <div class="mb-3 col-md-4">
                                        <label for="Street" class="form-label">Street
                                        </label>
                                        <input name="street" value="{{ $contact->street }}" type="text"
                                            class="form-control" id="Street">
                                    </div>

                                    <div class="mb-3 col-md-4">
                                        <label for="zip" class="form-label">
                                            zip code </label>
                                        <input name="zip" value="{{ $contact->zip }}" type="text"
                                            class="form-control" id="zip">
                                    </div>
                                </div>




                                <div class="row g-2">
                                    <div class="mb-3 col-md-6">
                                        <label for="urllink" class="form-label">Url Link</label>
                                        <input name="UrlLink" value="{{ $contact->UrlLink }}" type="text"
                                            class="form-control" id="urllink">
                                    </div>
                                </div>


                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>

                        </div> <!-- end card-body -->
                    </div> <!-- end card-->
                </div>
            </form>
        </div>


        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class=".card-title">Cobtact us info</h4>

                </div>
                <div class="card-body">
                    <div class="table-responsive-sm">
                        <table class="table table-centered mb-0">
                            <thead>
                                <tr>






                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Company Name</th>
                                    <th>Address</th>
                                    <th>Street</th>
                                    <th>zip code</th>
                                    <th>Url Link</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $show)
                                    <tr>
                                        <td>{{ $show->phone }}</td>
                                        <td>{{ $show->email }}</td>
                                        <td>{{ $show->CompanyName }} </td>
                                        <td>{{ $show->address }}</td>
                                        <td>{{ $show->street }}</td>
                                        <td>{{ $show->zip }}</td>
                                        <td>{{ $show->UrlLink }}</td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div> <!-- end table-responsive-->

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div>
    @endsection
