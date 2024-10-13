@extends('layout.UserMatser')
@section('content')

@php
$backgrounds = [
'delivered' => '#d9f2f2',
'shipped' => '#cfe8da',
'pending' => '#fcdfa8',
'canceled' => '#f5b6c6',
];
@endphp

<div class="row">

    <div class="col-xl-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">{{__('translation.Orders')}}</h4>
                <form action method="POST" enctype="multipart/form-data">
                    <a href="#" type="button" class="btn btn-secondary">{{__('translation.Exports Orders')}}</a>

                </form>
            </div>

            <div class="card-body">
                <input id="myInput" onkeyup="myFunction()" type="search" placeholder="{{__('translation.Search For Order Code')}}  ..." class="form-control" />

                <br>
                <div class="table-responsive-sm">
                    <table id="myTable" class="table table-centered mb-0">
                        <thead class="table-dark">
                            <tr>
                                {{-- <th># ID</th> --}}
                                <th># {{__('translation.Order Code')}}</th>
                                <th>{{__('translation.Customer')}}</th>
                                <th>{{__('translation.PHONE NUMBER')}}</th>
                                <th>{{{__('translation.STATUS')}}}</th>
                                {{-- <th></th> --}}
                                <th>{{__('translation.Total Price')}}</th>
                                <th>{{__('translation.Date Purchased')}} </th>
                                <th>{{__('translation.Actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($orders as $key => $order)

                            <tr style="background-color: {{ $backgrounds[$order->status] }}; {{ $order->trashed() ? 'opacity: 0.5;' : '' }}">
                                <td>
                                    <strong>{{ $order->order_id }}</strong>
                                    @if($order->trashed())
                                    <i class="ri-close-circle-line text-danger ms-2" title="Deleted by Admin"></i>
                                    @endif
                                </td>
                                <td>{{ $order->user->name }}</td>
                                <td>{{ $order->user->phone }}</td>
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
                                {{-- <td>
                                    @if ($order->status == 'pending')
                                    <div class="spinner-grow text-warning" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    @endif
                                </td> --}}
                                <td>{{ number_format($order->total_price, 2, ',', '.') }} $</td>
                                <td>{{ $order->created_at ? $order->created_at->format('d.m.Y H:i') : '-' }} | {{ $order->created_at->diffForHumans() ?? '-' }}</td>
                                <td>
                                    @if($order->trashed())
                                    <span class="badge bg-danger">{{__('translation.Deleted_by_Admin')}}</span>
                                    @else
                                    <a href="{{ route('user.orderDetails.index', $order) }}" class="text-reset fs-16 px-1">
                                        <i class="ri-eye-line"></i>
                                    </a>
                                    <a href="{{ route('user.orders.order_track') }}" class="text-reset fs-16 px-1">
                                        <i class="ri-truck-line"></i>
                                    </a>
                                    @endif
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
