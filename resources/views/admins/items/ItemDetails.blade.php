@extends('layout.AdminMaster')

@section('content')

<style>
    .card {
        border: 1px solid #dee2e6;
    }

    .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #dee2e6;
        text-align: center;
    }

    .table th,
    .table td {
        vertical-align: middle;
    }

    .barcode {
        text-align: center;
    }

    .barcode img {
        width: 100%;
        max-width: 200px;
    }

    img.img-fluid {
        max-width: 100%;
        height: auto;
        margin: 0 auto;
        display: block;
    }

    .user-info {
        text-align: center;
    }

    .user-info img {
        width: 60px;
        height: 60px;
        border-radius: 50%;
    }

    .user-info .name {
        margin-top: 10px;
        font-size: 1rem;
        font-weight: bold;
    }

</style>

<div class="container my-5">
    <div class="card">
        <div class="card-header">
            <h3>{{__('translation.Item description')}}</h3>
            <p>Full details about ({{ $products->title[app()->getLocale()]}})</p>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="barcode">
                        <img name="barcodeimage" id="barcodeimage">

                      

                         {{__('translation.Item Barcode')}} : {{$products->barcode}}| {!! $products->barcodeimage !!} </div>


                    <table class="table table-bordered mt-4">
                        <tbody>
                            <tr>
                                <th>{{ __('translation.Items') }}</th>
                                <td>{{ $products->title[app()->getLocale()] }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('translation.Type') }}</th>
                                <td>
                                    @if ($products->type)
                                    {{ $products->type->title[app()->getLocale()] }}
                                    @else
                                    Default Title
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>{{ __('translation.Item taxes') }}</th>
                                <td>{{ $products->tax }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('translation.Unit') }}</th>
                                <td>{{ $products->unit[app()->getLocale()] }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('translation.Unit Price') }}</th>
                                <td>{{ $products->unit_price }} $</td>
                            </tr>
                            <tr>
                                <th>{{ __('translation.Quantity') }}</th>
                                <td>{{ $products->quantity }}</td>
                            </tr>

                            <tr>
                                <th>{{__('translation.Minimum')}} | {{__('translation.Maximum')}} </th>
                                <td>{{ $products->min }} | {{$products->max}}</td>
                            </tr>


                            <tr>
                                <th>{{__('translation.Discount')}}</th>
                                <td>Percentage</td>
                            </tr>
                            <tr>
                                <th>{{ __('translation.Total Money') }}</th>
                                <td>${{ $products->total_price }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('translation.Description') }}</th>
                                <td>{{ $products->description[app()->getLocale()] }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="col-md-4">
                    <div class="text-center">
                        <img src="{{ $products->image ? url('storage/' . $products->image) : url('item.png') }}" class="img-fluid" alt="Product Image">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="user-info">
                        <div class="admin-info">
                            @if ($products->admin)
                            <img data-bs-toggle="modal" data-bs-target="#exampleModal-{{ $products->admin->id }}" src="{{ $products->admin->image ? url('storage/' . $products->admin->image) : url('item.png') }}" alt="Admin">
                            <div class="name">
                                {{__('translation.Added By ')}} : {{ $products->admin->name }}
                            </div>
                            @else
                            <div class="name">No Admin Found</div>
                            @endif
                        </div>
                        <div class="editor-info mt-4">
                            @if ($products->editor)
                            <img data-bs-toggle="modal" data-bs-target="#exampleModal-{{ $products->editor->id }}" src="{{ $products->editor->image ? url('storage/' . $products->editor->image) : url('item.png') }}" alt="Editor">
                            <div class="name">
                                {{__('translation.Edited By')}} : {{ $products->editor->name }}
                            </div>
                            @else
                            <div class="name">No Editor Found</div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
