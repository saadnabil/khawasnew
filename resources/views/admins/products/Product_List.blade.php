@extends('layout.AdminMaster')

@section('content')

<div class="row">

    <div class="col-xl-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Products</h4>
                <form action method="POST" enctype="multipart/form-data">
                    <a href="#" type="button" class="btn btn-secondary">Export Product</a>
                    <a href="{{route('admin.items.create')}}" type="button" class="btn btn-primary">
                        Add Products</a>
                </form>

            </div>

            <div class="card-body">
                <input id="myInput" onkeyup="myFunction()" type="search" placeholder="search For Product Name ..." class="form-control" />
                <div class="table-responsive-sm">
                    <table id="myTable" class="table table-striped table-centered mb-0">
                        <thead>
                            <tr>
                                <th>Products</th>
                                <th>Type</th>
                                <th>Unit</th>
                                <th>Qty</th>
                                <th>Unit Price</th>
                                <th>Pieces</th>
                                <th>Total Price</th>
                                <th>Action</th>
                            </tr>







                        </thead>
                        <tbody>
                            @foreach ($products as $key => $item)
                            <tr>
                                <td class="table-user">
                                    <img data-bs-toggle="modal" data-bs-target="#exampleModal-{{ $item->id }}" src="{{ $item->image != null ? url('storage/' . $item->image) : url('item.png') }}" alt="item.png" class="me-2 rounded-circle">
                                    {{ $item->title[app()->getLocale()]}}
                                </td>
                                @if($item->type)
                                <td>{{ $item->type->title[app()->getLocale()] }}</td>
                                @else
                                <td>No Type</td>
                                @endif

                                <td>{{$item->unit[app()->getLocale()]}}</td>
                                <td>{{$item->quantity}}</td>
                                <td>{{$item->unit_price}}</td>
                                <td>{{$item->units_number}}</td>
                                <td> €{{ number_format( $item->total_price, 2, ',', '.') }}</td>
                                <td>
                                    <div class="bt btn-group">
                                        <a class="btn btn-warning" href="{{ route('admin.items.edit', $item) }}" class="text-reset fs-16 px-1">
                                            <i class="ri-pencil-line"></i></a>


                                        <form action="{{ route('admin.items.destroy', $item) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger" type="submit" href="{{ route('admin.items.destroy', $item) }}" class="text-reset fs-16 px-1">
                                                <i class="ri-delete-bin-2-line"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal-{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                                {{$item->title[app()->getLocale()]}} </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <img width="100%" height="100%" data-bs-toggle="modal" data-bs-target="#exampleModal" src="{{ $item->image != null ? url('storage/' . $item->image) : url('item.png') }}" />

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

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
