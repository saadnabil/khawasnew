@extends('layout.UserMatser')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">




<form action="{{ route('user.items.index') }}" method="GET" class="w-100">
    <div class="input-group">
        <input id="myInput" name="search" type="search" placeholder="{{__('translation.Search here...')}}" class="form-control" value="{{ request()->input('search') }}">
        <button type="submit" class="btn btn-primary">{{__('translation.Confirm')}}</button>
    </div>
</form>

<br>

@if($noResults)
<div class="alert alert-danger" role="alert">
    No Items found for <strong>"{{ $query }}"</strong>.
</div>
@else
<div class="card-footer clearfix">
    {{ $items->links('pagination::bootstrap-5') }}

</div>

<div class="row" id="product-list">
    @foreach ($items as $item)
    <div class="col-xl-3 product">
        <div class="card hover-effect">
            <div class="position-relative img-overlay">
                <img src="{{ $item->image ? url('storage/' . $item->image) 
                : url('item.png') }}" alt="" height="150" width="100%" class="object-fit-cover">
                @if ($item->quantity == 0)
                <div class="out-of-stock-overlay">
                    {{__('translation.Out of stock')}}
                </div>
                @endif
            </div>
            <div class="card-body">
                <div class="text-center">
                    <div class="pt-4">
                        <h4 class="mb-1">{{ $item->title[app()->getLocale()] }}</h4>
                        <p class="mb-2">{{__('translation.Price')}}: <strong>{{ number_format($item->total_price, 2, ',', '.') }} €</strong></p>

                    </div>
                    <ul class="d-flex justify-content-around list-unstyled border-top border-dark-subtle pt-2 text-center mb-0">
                        <li>
                            <button type="button" data-bs-toggle="modal"
                             data-bs-target="#exampleModal-{{ $item->id }}" 
                             class="btn btn-primary" @if ($item->quantity == 0) disabled @endif>
                                <i class="bi bi-cart-fill"></i>
                            </button>
                            <a href="{{ route('wishlist.favourite', $item) }}?wishlist=true" class="btn btn-light ml-2 {{ $item->wishlisted != null ? 'text-danger' : '' }} addwishlist" data-route="{{ route('wishlist.favourite', $item) }}?wishlist=true">
                                <i class="bi bi-heart-fill"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>




    <!-- Modal -->
    <div class="modal fade" id="exampleModal-{{ $item->id }}" tabindex="-1" aria-labelledby="modalTitle-{{ $item->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="modalTitle-{{ $item->id }}" class="modal-title">{{ $item->title[app()->getLocale()] }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="card shadow border-0">
                        <div class="card-body px-lg-5 py-lg-5">
                            <div class="row">
                                <div class="col-lg-6 text-center">
                                    <img src="{{ $item->image ? url('storage/' . $item->image) : url('item.png') }}" class="img-fluid" alt="Image Not Found">
                                </div>
                                <div class="col-lg-6">
                                    <br>
                                    <h5><strong>{{__('translation.Description')}}</strong></h5>
                                    <p class="description">{{ $item->description[app()->getLocale()] }}</p>
                                    <br>
                                    <ul class="list-group">
                                        <li class="list-group-item">{{__('translation.Unit')}}: {{ $item->unit[app()->getLocale()] }}</li>
                                        <li class="list-group-item">{{__('translation.Unit Price')}}: €{{ number_format($item->total_price, 2, ',', '.') }}</li>
                                    </ul>
                                    <br>
                                    <div class="quantity-area">
                                        <label style="color: goldenrod" class="form-control-label" 
                                        for="quantity">{{__('translation.Quantity')}}</label>
                                        <form method="POST" id="additem{{$item->id}}" action="{{ route('carts.add') }}">
                                            @csrf
                                            <div class="form-group">
                                                <input type="number" name="quantity" id="quantity{{$item->id}}" 
                                                class="form-control form-control-alternative" min="1" value="1" required>
                                                <input type="hidden" name="item_id" value="{{ $item->id }}">
                                            </div>
                                            <br>
                                            <div class="quantity-btn">
                                                <button type="submit" class="btn btn-primary additem" 
                                                data-route="{{ route('carts.add') }}">{{__('translation.Add')}}</button>
                                            </div>
                                        </form>
                                    </div>






                                    <!-- Inform if closed -->
                                    <!-- End inform -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @endif
</div>











<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function myFunction() {
            // Get the input field value
            var input = document.getElementById('myInput');
            var filter = input.value.toLowerCase();

            // Get the product list and the individual products
            var productList = document.getElementById('product-list');
            var products = productList.getElementsByClassName('product');

            // Loop through all products and hide those that don't match the search query
            for (var i = 0; i < products.length; i++) {
                var title = products[i].getElementsByTagName('h4')[0];
                if (title) {
                    var txtValue = title.textContent || title.innerText;
                    if (txtValue.toLowerCase().indexOf(filter) > -1) {
                        products[i].style.display = "";
                    } else {
                        products[i].style.display = "none";
                    }
                }
            }
        }



        $(document).on('click', 'a.addwishlist', function(e) {
            e.preventDefault();
            var url = $(this).data('route');
            var element = $(this);
            $.ajax({
                url: url
                , method: 'GET'
                , processData: false
                , contentType: false
                , success: function(response) {
                    if (response.status == 1) {
                        element.addClass('text-danger');
                    } else {
                        element.removeClass('text-danger');
                    }
                    $('#myProducts').html(response.view);
                }
                , error: function() {
                    alert('An error occurred while processing your request.');
                }
            });
        });






    });

</script>

@endsection
