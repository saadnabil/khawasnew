@extends('layout.AdminMaster')

@section('content')

<style>
    .nav-tabs .nav-link.active {
        background-color: #007bff;
        color: white;
    }


    .nav-tabs .nav-link {
        border: 1px solid #007bff;
        color: #007bff;
        transition: background-color 0.3s, color 0.3s;
    }

    .nav-tabs .nav-link:hover {
        background-color: #007bff;
        color: white;
    }

</style>


<div class="container mt-5">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Live Items</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Deleted Items</a>
        </li>

    </ul>

    <br>


    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">{{__('translation.Items')}}</h4>


                        <form action="" method="POST" enctype="multipart/form-data">

                            @can('item-export')
                            <a href="{{route('admin.items.export')}}" type="button" class="btn btn-secondary">
                                {{__('translation.ExportProduct')}}</a>
                            @endcan

                            @can('item-create')
                            <a href="{{route('admin.items.create')}}" class="btn btn-dark">
                                <i class="mdi mdi-plus"></i> {{__('translation.addProduct')}}</a>
                            @endcan
                        </form>

                    </div>

                    <div class="card-body">


                        <form action="{{ route('admin.items.index') }}" method="GET" class="w-100">
                            <div class="input-group">
                                <input id="myInput" name="search" type="search"
                                 placeholder="{{__('translation.Search here...')}}" class="form-control" value="{{ request()->input('search') }}">
                                <button type="submit" class="btn btn-primary">{{__('translation.Confirm')}}</button>
                            </div>
                        </form>

                        <br>

                        @if($noResults)
                        <div class="alert alert-danger" role="alert">
                            No Items found for <strong>"{{ $query }}"</strong>.
                        </div>
                        @else




                        <div class="table-responsive-sm">
                            <table class="table table-striped table-centered mb-0">
                                <thead>
                                    <tr>
                                        <th> {{__('translation.Item Barcode')}}</th>
                                        <th>{{__('translation.Items')}}</th>
                                        <th>{{__('translation.Type')}}</th>
                                        <th>{{__('translation.Quantity')}}</th>
                                        <th>{{__('translation.Unit Price')}}</th>
                                        <th>{{__('translation.Pieces')}}</th>
                                        <th>{{__('translation.Total Price')}}</th>
                                        <th>{{__('translation.Out of stock')}}</th>


                                        <th>{{__('translation.Actions')}}</th>
                                    </tr>







                                </thead>
                                <tbody id="myTable">
                                    @foreach ($products as $key => $item)
                                    <tr>
                                        <td>{{$item->barcode}}</td>

                                        <td class="table-user">
                                            <img data-bs-toggle="modal" data-bs-target="#exampleModal-{{ $item->id }}" src="{{ $item->image != null ? url('storage/' . $item->image) : url('item.png') }}" alt="item.png" class="me-2 rounded-circle">
                                            {{ $item->title[app()->getLocale()]}}
                                        </td>

                                        <td> @if($item->type)
                                            {{ $item->type->title[app()->getLocale()] }}
                                            @else
                                            Default Title
                                            @endif</td>
                                        <td>{{$item->quantity}}</td>
                                        <td>{{ number_format($item->unit_price, 2, ',', '.') }} €</td>
                                        <td>{{$item->units_number}}</td>
                                        <td> {{ number_format( $item->total_price, 2, ',', '.') }}€</td>

                                        <td>
                                            @if ($item->quantity == 0)
                                            <span class="badge bg-success">{{__('translation.Yes')}}
                                                @else
                                                <span class="badge bg-danger">{{__('translation.No')}}
                                                    @endif

                                                </span></td>



                                        <td>
                                            <div class="bt btn-group">

                                                <a class="btn btn-success" href="{{route('admin.showDupliacte',$item->id)}}" class="text-reset fs-16 px-1">
                                                    <i class="ri-file-copy-line"></i></a>

                                                <a class="btn btn-dark" href="{{ route('admin.items.viewItem',$item->id)}}" class="text-reset fs-16 px-1">
                                                    <i class="ri-eye-line"></i></a>


                                                @can('item-edit')
                                                <a class="btn btn-warning" href="{{ route('admin.items.edit', $item) }}" class="text-reset fs-16 px-1">
                                                    <i class="ri-pencil-line"></i></a>
                                                @endcan


                                                @can('item-delete')
                                                <form id="delete-item-form-{{ $item->id }}" action="{{ route('admin.items.destroy', $item) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="btn btn-danger" onclick="confirmDeletion({{ $item->id }})">
                                                        <i class="ri-delete-bin-2-line"></i>
                                                    </button>

                                                </form>
                                                @endcan


                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Modal item -->
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
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('translation.Close')}}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>





                                    @endforeach
                                    @endif

                                </tbody>
                            </table>
                        </div> <!-- end table-responsive-->

                        <div class="card-footer clearfix">
                            {{ $products->links('pagination::bootstrap-5') }}

                        </div>

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div>


        </div>



        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">


            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Deleted Items</h4>



                    </div>

                    <div class="card-body">
                        <div class="table-responsive-sm">
                            <table class="table table-striped table-centered mb-0">
                                <thead>
                                    <tr>
                                        <th> {{__('translation.Item Barcode')}}</th>
                                        <th>{{__('translation.Items')}}</th>
                                        <th>{{__('translation.Type')}}</th>
                                        <th>{{__('translation.Quantity')}}</th>
                                        <th>{{__('translation.Unit Price')}}</th>
                                        <th>{{__('translation.Pieces')}}</th>
                                        <th>{{__('translation.Total Price')}}</th>
                                        <th>{{__('translation.Out of stock')}}</th>


                                        <th>{{__('translation.Actions')}}</th>
                                    </tr>







                                </thead>
                                <tbody id="myTable">
                                    @foreach ($delete_item as $key => $item_delete)
                                    <tr>
                                        <td>{{$item_delete->barcode}}</td>

                                        <td class="table-user">
                                            <img data-bs-toggle="modal" data-bs-target="#exampleModal1-{{ $item_delete->id }}" src="{{ $item_delete->image != null ? url('storage/' . $item_delete->image) : url('item.png') }}" alt="item.png" class="me-2 rounded-circle">
                                            {{ $item_delete->title[app()->getLocale()]}}
                                        </td>

                                        <td> @if($item_delete->type)
                                            {{ $item_delete->type->title[app()->getLocale()] }}
                                            @else
                                            Default Title
                                            @endif</td>
                                        <td>{{$item_delete->quantity}}</td>
                                        <td>{{ number_format($item_delete->unit_price, 2, ',', '.') }} €</td>
                                        <td>{{$item_delete->units_number}}</td>
                                        <td> {{ number_format( $item_delete->total_price, 2, ',', '.') }}€</td>

                                        <td>
                                            @if ($item_delete->quantity == 0)
                                            <span class="badge bg-success">{{__('translation.Yes')}}
                                                @else
                                                <span class="badge bg-danger">{{__('translation.No')}}
                                                    @endif

                                                </span></td>



                                        <td>
                                            <div class="btn-group">

                                                <button class="btn btn-outline-warning recover-item" data-id="{{ $item_delete->id }}">
                                                    <i class="ri-recycle-line"></i> Recover
                                                </button>
                                        </td>
                                    </tr>



                                    <!-- Modal item -->
                                    <div class="modal fade" id="exampleModal1-{{ $item_delete->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                        {{$item_delete->title[app()->getLocale()]}} </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <img width="100%" height="100%" data-bs-toggle="modal" data-bs-target="#exampleModal" src="{{ $item_delete->image != null ? url('storage/' . $item_delete->image) : url('item.png') }}" />

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('translation.Close')}}</button>
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



    </div>
</div>



<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>


<script>
    $(document).ready(function() {
        $('.recover-item').on('click', function() {
            var itemId = $(this).data('id');

            Swal.fire({
                title: 'Are you sure?'
                , text: 'Do you want to recover this item?'
                , icon: 'warning'
                , showCancelButton: true
                , confirmButtonColor: '#3085d6'
                , cancelButtonColor: '#d33'
                , confirmButtonText: 'Yes, recover it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('
                        item.recover ', ['
                        id ' => '
                        __ITEM_ID__ ']) }}'.replace('__ITEM_ID__', itemId)
                        , type: 'patch'
                        , data: {
                            _token: '{{ csrf_token() }}'
                        , }
                        , success: function(response) {
                            Swal.fire(
                                'Recovered!'
                                , 'The item has been recovered.'
                                , 'success'
                            ).then(() => {
                                location.reload(); // Reload the page to reflect changes
                            });
                        }
                        , error: function(xhr) {
                            Swal.fire(
                                'Error!'
                                , 'There was an error recovering the item.'
                                , 'error'
                            );
                        }
                    });
                }
            });
        });
    });

</script>





<script>
    function confirmDeletion(itemId) {
        Swal.fire({
            title: '{{ __('
            translation.Are you sure ? ') }}'
            , text : '{{ __('
            translation.You wont be able to revert this!') }}'
            , icon: 'warning'
            , showCancelButton: true
            , confirmButtonColor: '#d33'
            , cancelButtonColor: '#3085d6'
            , confirmButtonText: '{{ __('
            translation.Yes
            , delete it!') }}'
            , cancelButtonText: '{{ __('
            translation.Cancel ') }}'
        }).then((result) => {
            if (result.isConfirmed) {
                let timerInterval;
                Swal.fire({
                    title: '{{ __('
                    translation.Deleting_in_5_seconds...') }}'
                    , html: '{{ __('
                    translation.You_can_undo_this_action ') }} <b></b>'
                    , timer: 5000
                    , timerProgressBar: true
                    , showCancelButton: true
                    , confirmButtonText: '{{ __('
                    translation.Undo ') }}'
                    , cancelButtonText: '{{ __('
                    translation.Wait ') }}'
                    , didOpen: () => {
                        const b = Swal.getHtmlContainer().querySelector('b');
                        timerInterval = setInterval(() => {
                            b.textContent = Math.ceil(Swal.getTimerLeft() / 1000);
                        }, 1000);
                    }
                    , willClose: () => {
                        clearInterval(timerInterval);
                    }
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        // Timer finished, proceed with deletion
                        document.getElementById('delete-item-form-' + itemId).submit();
                    } else if (result.isConfirmed) {
                        // User clicked undo, do nothing
                        Swal.fire({
                            title: '{{ __('
                            translation.Deletion_Cancelled ') }}'
                            , text: '{{ __('
                            translation.The_item_has_not_been_deleted ') }}'
                            , icon: 'info'
                        });
                    }
                });
            }
        });
    }

    $(document).ready(function() {
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });
    });

</script>

@endsection
