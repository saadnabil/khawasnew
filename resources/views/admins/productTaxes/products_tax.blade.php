@extends('layout.AdminMaster')

@section('content')

<div class="row">

    <div class="col-xl-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Products Taxes</h4>
                <form action method="POST" enctype="multipart/form-data">

                    <a href="{{route('admin.itemtaxes.create')}}" type="button" class="btn btn-primary">
                        Add Product Taxes</a>
                </form>

            </div>

            <div class="card-body">
                <div class="table-responsive-sm">
                    <table id="myTable" class="table table-striped table-centered mb-0">
                        <thead>
                            <tr>
                                <th>Products Tax</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($itemtaxes as $itemtax)
                            <tr>
                                <td>{{ $itemtax->tax}} %</td>
                                <td>
                                    <div class="btn btn-group">

                                        <a class="btn btn-warning" href="{{ route('admin.itemtaxes.edit', $itemtax) }}" class="text-reset fs-16 px-1">
                                            <i class="ri-pencil-line"></i>
                                        </a>

                                        <form action="{{ route('admin.itemtaxes.destroy', $itemtax) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger"  type="submit" href="{{ route('admin.itemtaxes.destroy', $itemtax) }}" class="text-reset fs-16 px-1">
                                                <i class="ri-delete-bin-2-line"></i>
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div> <!-- end table-responsive-->



            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div>

</div>


@endsection
