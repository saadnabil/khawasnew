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
                            <h4 class=".card-title">{{(__('translation.Contact us info'))}}</h4>
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
                                            {{(__('translation.PHONE NUMBER'))}} </label>
                                        <input name="phone" value="{{ old('phone', $contact->phone) }}" type="text"
                                            class="form-control" id="phone">
                                    </div>

                                    <div class="mb-3 col-md-4">
                                        <label for="email" class="form-label">
                                            {{(__('translation.Email'))}} </label>
                                        <input name="email" value="{{ old('email', $contact->email) }}" type="text"
                                            class="form-control" id="email">
                                    </div>

                                    <div class="mb-3 col-md-4">
                                        <label for="Company" class="form-label">{{(__('translation.Company Name'))}}
                                        </label>
                                        <input name="CompanyName" value="{{ $contact->CompanyName }}" type="text"
                                            class="form-control" id="Company">
                                    </div>



                                    <div class="mb-3 col-md-4">
                                        <label for="Address" class="form-label">
                                            {{(__('translation.Add Address'))}} </label>
                                        <input name="address" value="{{ $contact->address }}" type="text"
                                            class="form-control" id="Address">
                                    </div>

                                    <div class="mb-3 col-md-4">
                                        <label for="Street" class="form-label">{{(__('translation.Street'))}}
                                        </label>
                                        <input name="street" value="{{ $contact->street }}" type="text"
                                            class="form-control" id="Street">
                                    </div>

                                    <div class="mb-3 col-md-4">
                                        <label for="zip" class="form-label">
                                            {{(__('translation.Zip'))}} </label>
                                        <input name="zip" value="{{ $contact->zip }}" type="text"
                                            class="form-control" id="zip">
                                    </div>
                                </div>




                                <div class="row g-2">
                                    <div class="mb-3 col-md-6">
                                        <label for="urllink" class="form-label">{{(__('translation.Url Link'))}}</label>
                                        <input name="UrlLink" value="{{ $contact->UrlLink }}" type="text"
                                            class="form-control" id="urllink">
                                    </div>
                                </div>


                                <button type="submit" class="btn btn-primary">{{(__('translation.Update'))}}</button>
                            </form>

                        </div> <!-- end card-body -->
                    </div> <!-- end card-->
                </div>
            </form>
        </div>


        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class=".card-title">{{(__('translation.Contact us info'))}}</h4>

                </div>
                <div class="card-body">
                    <div class="table-responsive-sm">
                        <table class="table table-centered mb-0">
                            <thead>
                                <tr>






                                    <th>{{(__('translation.PHONE NUMBER'))}}</th>
                                    <th>{{(__('translation.Email'))}}</th>
                                    <th>{{(__('translation.Company Name'))}}</th>
                                    <th>{{(__('translation.Address'))}}</th>
                                    <th>{{(__('translation.Street'))}}</th>
                                    <th>{{(__('translation.Zip'))}}</th>
                                    <th>{{(__('translation.Url Link'))}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $show)
                                    <tr style="background-color:#d4d4f8">
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
