@extends('layout.AdminMaster')

@section('content')

<div class="row">

    <div class="col-xl-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">{{__('translation.Coupons')}} </h4>
                <form action method="POST" enctype="multipart/form-data">

                    @can('coupon-create')
                    <a href="{{route('admin.coupons.create')}}" class="btn btn-dark">
                        <i class="mdi mdi-plus"></i> {{__('translation.Add coupons')}}</a>

                    @endcan
                </form>

            </div>

            <div class="card-body">
                <input id="myInput" onkeyup="myFunction()" type="search" placeholder="{{__('translation.Search here...')}}" class="form-control" />
                <div class="table-responsive-sm">
                    <table id="myTable" class="table table-striped table-centered mb-0">
                        <thead>
                            <tr>
                                <th>{{ __('translation.Code') }}</th>
                                <th>{{ __('translation.Description') }}</th>
                                <th>{{ __('translation.Discount') }}</th>
                                <th>{{ __('translation.Type') }}</th>
                                <th>{{ __('translation.Quantity') }}</th>
                                <th>{{ __('translation.Used Quantity') }}</th>
                                <th>{{ __('translation.Valid From') }}</th>
                                <th>{{ __('translation.Valid To') }}</th>
                                <th>{{ __('translation.Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($coupons as $coupon)
                            <tr>
                                <td>{{ $coupon->code}}</td>
                                <td>{{ $coupon->description}}</td>
                                <td>{{ $coupon->discount}}</td>
                                 <td>{{ $coupon->type}}</td>
                                <td>{{ $coupon->quantity}}</td>
                                <td>{{ $coupon->used_quantity}}</td>
                                <td>{{ $coupon->valid_from}}</td>
                                <td>{{ $coupon->valid_to}}</td>

                                <td>
                                    <div class="btn btn-group">

                                        @can('coupon-edit')

                                        <a class="btn btn-warning" href="{{ route('admin.coupons.edit', $coupon) }}" class="text-reset fs-16 px-1">
                                            <i class="ri-pencil-line"></i></a>
                                        @endcan

                                        @can('coupon-delete')
                                        <form action="{{ route('admin.coupons.destroy', $coupon) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger" type="submit" href="{{ route('admin.coupons.destroy', $coupon) }}" class="text-reset fs-16 px-1">
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
<script>
    function myFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }

</script>

@endsection
