@extends('layout.AdminMaster')
@section('content')

@php
$backgrounds = [
'delivered' => '#d9f2f2',
'shipped' => '#cfe8da',
'pending' => '#fcdfa8',
'canceled' => '#f5b6c6',
];
@endphp
<style>
    .act {
        border: 2px solid #000;
    }

</style>

<div class="row">

    <div class="col-xl-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">{{__('translation.Orders')}}</h4>
                <form action="" method="POST" enctype="multipart/form-data">
                    <a href="#" type="button" class="btn btn-secondary">{{__('translation.Exports Orders')}}</a>

                </form>
            </div>

            <div class="card-body">
                <input id="myInput" onkeyup="myFunction()" type="search" placeholder="{{__('translation.Search For Order Code')}}  ..." class="form-control" />

                <br>
                <div class="table-responsive-sm">

                    <div class="mb-3">
                        <a href="{{ route('admin.orders.index') }}" style="background-color: #ffffff" class="btn btn-light {{ $status == 'all' ? 'act' : '' }}">{{__('translation.All')}}</a>
                        <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}" style="background-color:#fcdfa8" class="btn  {{ $status == 'pending' ? 'act' : '' }} ">{{__('translation.Pending')}}</a>
                        <a href="{{ route('admin.orders.index', ['status' => 'delivered']) }}" style="background-color: #d9f2f2" class="btn  {{ $status == 'delivered' ? 'act' : '' }}">{{__('translation.Delivered')}}</a>
                        <a href="{{ route('admin.orders.index', ['status' => 'shipped']) }}" style="background-color: #cfe8da" class="btn  {{ $status == 'shipped' ? 'act' : '' }}">{{__('translation.Shipped')}}</a>
                        <a href="{{ route('admin.orders.index', ['status' => 'canceled']) }}" style="background-color: #f5b6c6" class="btn  {{ $status == 'canceled' ? 'act' : '' }}">{{__('translation.Cancelled')}}</a>
                    </div>




                    <table id="myTable" class="table table-centered mb-0">
                        <thead class="table-dark">
                            <tr>
                                {{-- <th># ID</th> --}}
                                <th>#{{ __('translation.Order Code') }}</th>
                                <th>{{ __('translation.Customer') }}</th>
                                <th>{{ __('translation.PHONE NUMBER') }}</th>
                                <th>{{ __('translation.STATUS') }}</th>
                                <th></th>
                                <th>{{ __('translation.Total Price') }}</th>
                                <th>{{ __('translation.Date Purchased') }}</th>
                                <th>{{ __('translation.Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $key => $order)
                            <tr style="background-color: {{ $backgrounds[$order->status] }}">
                                {{-- <td>#{{ $loop->index +1 }}</td> --}}
                                <td><strong>{{ $order->order_id }}</strong></td>
                                <td>{{ $order->user->name }}</td>
                                <td>{{ $order->user->phone }} </td>

                                <td>
                                    @if ($order->status == 'pending')
                                    <span class="badge bg-warning">{{__('translation.Pending')}} | {{ $order->pending_date }}</span>
                                    @elseif($order->status == 'shipped')
                                    <span class="badge bg-success">{{__('translation.Shipped')}} | {{ $order->shipped_date }}</span>
                                    @elseif($order->status == 'delivered')
                                    <span class="badge bg-info">{{__('translation.Delivered')}} | {{ $order->delivered_date }}</span>
                                    @elseif ($order->status == 'canceled')
                                    <span class="badge bg-danger">{{__('translation.Cancelled')}} | {{ $order->canceled_date }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($order->status == 'pending')
                                    <div class="spinner-grow text-warning" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>

                                    @endif
                                </td>
                                <td><strong>{{ number_format($order->total_price, 2, ',', '.') }} €
                                    </strong> </td>
                                <td>{{ $order->created_at ? $order->created_at->format('d.m.Y H:i') : '-' }} | {{ $order->created_at->diffForHumans() ?? '-' }}</td>
                                {{-- <td>{{ Carbon\Carbon::parse($order->created_at)->format('Y m d, H:i a') }}</td> --}}

                                <td>
                                    @can('order-show')
                                    <a title="{{ __('translation.Show') }}" href="{{ route('admin.orders.show', $order) }}" class="text-reset fs-16 px-1">
                                        <i class="ri-eye-line"></i>
                                    </a>
                                    @endcan

                                    @can('order-track')

                                    <a title="{{ __('translation.Tracking Order') }}" href="{{ route('admin.orders.trackorderdetails', $order) }}" class="text-reset fs-16 px-1">
                                        <i class="ri-truck-line"></i>
                                    </a>
                                    @endcan


                                    @can('can-edit-order')


                                    <a title="Edit Orders" href="{{route('admin.orders.edit',$order->id)}}" class="text-reset fs-16 px-1">
                                        <i class="ri-edit-box-line"></i>

                                    </a>
                                    @endcan

                                    @can('can-delete-order')




                                    <a class="btn btn-danger btn-delete" data-id="{{ $order->id }}"><i class="ri-delete-bin-line"></i></a>

                                    <form id="delete-form-{{ $order->id }}" action="{{ route('admin.orders.deleteOrder', $order) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    @endcan
                                </td>

                            </tr>
                            @endforeach








                        </tbody>
                    </table>
                </div> <!-- end table-responsive-->

                <div class="card-footer clearfix">
                    {{ $orders->links('pagination::bootstrap-5') }}
                </div>

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function() {
            const orderId = this.getAttribute('data-id');
            Swal.fire({
                title: 'Are you sure?'
                , text: "You won't be able to revert this!"
                , icon: 'warning'
                , showCancelButton: true
                , confirmButtonColor: '#3085d6'
                , cancelButtonColor: '#d33'
                , confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-form-${orderId}`).submit();
                }
            });
        });
    });


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
