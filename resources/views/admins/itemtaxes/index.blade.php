@extends('layout.AdminMaster')

@section('content')

<div class="row">

    <div class="col-xl-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">{{__('translation.Items Taxes')}}</h4>
                <form action method="POST" enctype="multipart/form-data">

                    @can('item-tax-create')


                    <a href="{{route('admin.itemtaxes.create')}}" class="btn btn-dark">
                        <i class="mdi mdi-plus"></i> {{__('translation.Add Items Taxes')}}</a>


                    @endcan
                </form>

            </div>

            <div class="card-body">
                <div class="table-responsive-sm">
                    <table id="myTable" class="table table-striped table-centered mb-0">
                        <thead>
                            <tr>
                                <th>{{__('translation.Items Taxes')}}</th>
                                <th>{{__('translation.Actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($itemtaxes as $itemtax)
                            <tr>
                                <td>{{ $itemtax->tax}} %</td>
                                <td>
                                    <div class="btn btn-group">
                                        @can('item-tax-edit')
                                        <a class="btn btn-warning" href="{{ route('admin.itemtaxes.edit', $itemtax) }}" class="text-reset fs-16 px-1">
                                            <i class="ri-pencil-line"></i>
                                        </a>
                                        @endcan

                                        @can('item-tax-delete')

                                        <form action="{{ route('admin.itemtaxes.destroy', $itemtax) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger" type="submit" href="{{ route('admin.itemtaxes.destroy', $itemtax) }}" class="text-reset fs-16 px-1">
                                                <i class="ri-delete-bin-2-line"></i>
                                            </button>
                                        </form>
                                        @endcan

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
