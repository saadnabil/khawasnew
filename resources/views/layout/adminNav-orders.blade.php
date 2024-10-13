@foreach ($orders as $show)


    <!-- Order item-->
    <a href="{{route('admin.orders.index')}}" class="dropdown-item p-0 notify-item read-noti card m-0 shadow-none">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                    <div class="notify-icon">
                        @if ($show->item != null && $show->item->image != null)
                            <img src="{{ url('storage/' . $show->item->image) }}" class="img-fluid rounded-circle" alt />
                        @else
                            <img src="{{ asset('assets/images/item defualt.png') }}" class="img-fluid rounded-circle" alt />
                        @endif
                    </div>
                </div>
                <div class="flex-grow-1 text-truncate ms-2">
                    <h5 class="noti-item-title fw-semibold fs-14">Order #{{$show->order_id}} <small class="fw-normal text-muted float-end ms-1">{{$show->created_at->diffForHumans()}}</small></h5>
                    <small class="noti-item-subtitle text-muted">Customer: {{$show->user->name}}</small><br>
                    <small class="noti-item-subtitle text-muted">
                        Details:
                        @foreach($show->order_details as $key => $orderdetail)


                           @if ($orderdetail->item)
    {{ $orderdetail->item->title[app()->getLocale()] }} | 
    {{ number_format($orderdetail->item->total_price, 2, ',', '.') }} € x 
    {{ $orderdetail->quantity }}
@else
    {{ 'Item not available' }}
@endif

                            <strong> {{ number_format($show->total_price, 2, ',', '.') }} €
                            </strong>


                        @endforeach

                    </small>
                </div>
            </div>
        </div>
    </a>

@endforeach
