@extends('layout.AdminMaster')

@section('content')

<div class="row">
    <form action="{{ $action }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        @if (isset($method))
        @method('PUT')
        @endif

        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">
                        @if (isset($method) && $method == 'PUT')
                        {{ __('translation.Edit Items') }}
                        @else
                        {{ __('translation.Create Items') }}
                        @endif
                    </h4>
                    <div>
                        <a href="{{ route('admin.items.index') }}" class="btn btn-info"> <i class="mdi mdi-arrow-left"></i> {{ __('translation.Back') }}</a>
                        <button type="submit" class="btn btn-primary">{{ __('translation.Confirm') }}</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row g-2">
                        @foreach ($langs as $key => $lang)
                        <div class="mb-3 col-md-4">
                            <label for="inputEn" class="form-label">{{__('translation.Title')}} ({{ $lang }})</label>
                            <input name="title[{{ $lang }}]" type="text" class="form-control" id="inputEn" value="{{ old('title.' . $lang, isset($item->title[$lang]) ? $item->title[$lang] : '') }}">
                            @error('title.' . $lang)
                            <div class="mt-1" style="font-size: 12px;color:red;font-weight:bold;">
                                {{ $message }}</div>
                            @enderror
                        </div>
                        @endforeach

                        <input type="hidden" name="admin_id" value="{{ auth('admin')->user()->id }}">
                        <input type="hidden" name="editor_id" value="{{ auth('admin')->user()->id }}">


                        <div class="mb-3 col-md-4">
                            <label for="producttype" class="form-label">{{__('translation.Item types')}}</label>
                            <div class="input-group">
                                <select name="item_type_id" id="producttype" class="form-select">
                                    @foreach ($types as $type)
                                    <option {{ old('item_type_id', $item->item_type_id) ==  $type->id ? 'selected' : '' }} value="{{ $type->id }}">{{ $type->title[app()->getLocale()] }}</option>
                                    @endforeach
                                </select>
                                @if (!isset($method))
                                <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addNewItemTypeModal">{{__('translation.Add New')}}</button>
                                @endif </div>
                            @error('item_type_id')
                            <div class="mt-1" style="font-size: 12px;color:red;font-weight:bold;">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-2">
                            <label for="quantity" class="form-label">{{__('translation.Quantity')}}</label>
                            <input min="1" name="quantity" type="number" class="form-control" value="{{ old('quantity', $item->quantity) }}" id="quantity">
                            @error('quantity')
                            <div class="mt-1" style="font-size: 12px;color:red;font-weight:bold;">
                                {{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-2 col-md-2">
                            <label for="minitem" class="form-label">{{__('translation.Minumaum')}}</label>
                            <input min="1" name="min" type="number" class="form-control" value="{{ old('min', $item->min) }}" id="minitem">
                            @error('min')
                            <div class="mt-1" style="font-size: 12px;color:red;font-weight:bold;">
                                {{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-2 col-md-2">
                            <label for="maxitem" class="form-label">{{__('translation.Maxmuam')}}</label>
                            <input min="1" name="max" type="number" class="form-control" value="{{ old('max', $item->max) }}" id="maxitem">
                            @error('max')
                            <div class="mt-1" style="font-size: 12px;color:red;font-weight:bold;">
                                {{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-2">
                            <label style="color:#8b8562" for="itembarcode" class="form-label">{{__('translation.Item Barcode')}}</label>
                            <input name="barcode" type="text" class="form-control" value="{{ old('barcode', $item->barcode) }}" id="itembarcode">
                            @error('barcode')
                            <div class="mt-1" style="font-size: 12px;color:red;font-weight:bold;">
                                {{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    <div class="mb-3 col-md-2">
                        <label for="barcodeimage" class="form-label">{{__('translation.Image Barcode')}}</label>
                        <img name="barcodeimage" id="barcodeimage">

                        {!! $item->barcodeimage !!}
                    </div>





                    <div class="row g-2">
                        @foreach ($langs as $key => $lang)
                        <div class="mb-3 col-md-4">
                            <label for="unitEn" class="form-label">{{__('translation.UniTitle')}} ({{ $lang }})</label>
                            <input name="unit[{{ $lang }}]" value="{{ old('unit.' . $lang  , isset($item->unit[$lang]) ? $item->unit[$lang] : '') }}" type="text" class="form-control" id="unitEn" placeholder>
                            @error('unit.' . $lang)
                            <div class="mt-1" style="font-size: 12px;color:red;font-weight:bold;">
                                {{ $message }}</div>
                            @enderror
                        </div>
                        @endforeach

                        <div class="mb-3 col-md-3">
                            <label for="picess" class="form-label">{{__('translation.The Number Of Pieces')}}</label>
                            <input min="1" name="units_number" value="{{ old('units_number', $item->units_number) }}" type="number" class="form-control" id="picess" placeholder>
                            @error('units_number')
                            <div class="mt-1" style="font-size: 12px;color:red;font-weight:bold;">
                                {{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-3">
                            <label for="unitprice" class="form-label">{{__('translation.Unit Price')}}</label>
                            <input step="0.01" min="1" autocomplete="off" name="unit_price" value="{{ old('unit_price', $item->unit_price) }}" type="number" class="form-control" id="unitprice">
                            @error('unit_price')
                            <div class="mt-1" style="font-size: 12px;color:red;font-weight:bold;">
                                {{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-3">
                            <label for="tax" class="form-label">{{__('translation.Tax')}}</label>
                            <select name="tax" id="tax" class="form-select">
                                @foreach ($taxes as $tax)
                                <option {{ old('tax', $item->tax) ==  $tax->tax ? 'selected' : '' }} value="{{ $tax->tax }}">{{ $tax->tax }}%</option>
                                @endforeach
                            </select>
                            @error('tax')
                            <div class="mt-1" style="font-size: 12px;color:red;font-weight:bold;">
                                {{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-3">
                            <label style="color:red" for="totalprice" class="form-label">{{__('translation.Total Price')}}</label>
                            <input readonly autocomplete="off" name="total_price" value="{{ old('total_price', $item->total_price) }}" type="number" class="form-control" id="totalprice">
                            @error('total_price')
                            <div class="mt-1" style="font-size: 12px;color:red;font-weight:bold;">
                                {{ $message }}</div>
                            @enderror
                        </div>

                        @foreach ($langs as $key => $lang)
                        <div class="mb-3 col-md-4">
                            <label for="descriptionen" class="form-label">{{__('translation.Description')}} ({{ $lang }})</label>
                            <textarea name="description[{{ $lang }}]" autocomplete="off" type="text" class="form-control">{{ old('description.'. $lang, isset($item->description[$lang]) ? $item->description[$lang] : '') }}</textarea>
                            @error('description.' . $lang)
                            <div class="mt-1" style="font-size: 12px;color:red;font-weight:bold;">
                                {{ $message }}</div>
                            @enderror
                        </div>
                        @endforeach



                        <div class="form-group">
                            <label for="productimage" class="form-label">{{ __('translation.Image of Product') }}</label>
                            <input name="image" onchange="previewImage(event)" type="file" class="form-control" id="productimage">
                            @error('image')
                            <div class="mt-1" style="font-size: 12px; color:red; font-weight:bold;">
                                {{ $message }}</div>
                            @enderror
                            <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#imageModal">
                                Select Image from Server
                            </button>
                        </div>
                        <div id="imagePreview" class="mt-2">
                            <img width="100" height="100" src="{{ $item->image != null ? url('storage/' . $item->image) : asset('assets/images/brands/infinity.png') }}" class="mt-2" />
                        </div>


                        <!-- Hidden input to store selected image URL -->
                        <input type="hidden" name="selected_image" id="selectedImage">


                        <br>
                    </div> <!-- end card-body -->
                    <br>
                    <a href="{{ route('admin.items.index') }}" class="btn btn-info"> <i class="mdi mdi-arrow-left"></i> {{__('translation.Back')}}</a>
                    <button type="submit" class="btn btn-primary">{{__('translation.Confirm')}}</button>

                </div> <!-- end card-->
            </div>
    </form>
</div>

@if (!isset($method))
<div class="col-md-6">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h6 class="card-title">{{ __('translation.Add Products By Excel') }}</h6>
                </div>
                <div class="col-md-6" style="text-align:right;font-size:13px;font-weight:bold;">
                    <a href="{{ url('templates/excel_Items_template.xlsx') }}">{{__('translation.Download Excel Template')}}</a>
                </div>
            </div>
            <hr>
            <form action="{{ route('admins.itemsexcelimport') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" class="form-control">
                @error('file')
                <div class="mt-1" style="font-size: 12px;color:red;font-weight:bold;">
                    {{ $message }}
                </div>
                @enderror
                <br>
                <button type="submit" class="btn btn-dark">{{ __('translation.Import Product') }}</button>
            </form>
        </div>
    </div>
</div>
@endif

<!-- Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Select Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    @foreach ($images as $image)
                    <div class="col-md-3 mb-3">
                        <img src="{{ url('storage/' . $image->file_path) }}" class="img-thumbnail selectable-image" style="cursor: pointer;" onclick="selectImage('{{ url('storage/' . $image->file_path) }}')">
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</div>


<!-- Add New Item Type Modal -->
<div class="modal fade" id="addNewItemTypeModal" tabindex="-1" aria-labelledby="addNewItemTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewItemTypeModalLabel">{{__('translation.Item types')}} </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('admin.items.CreateItemType')}}" method="post">
                    @csrf
                    @foreach ($langs as $key => $lang)
                    <div class="mb-3">
                        <label for="newItemTypeTitle" class="form-label">{{__('translation.Item types')}} ({{ $lang }})</label>
                        <input value="{{ old('title.' . $lang, isset($itemtype->title[$lang]) ? $itemtype->title[$lang] : '') }}" name="title[{{ $lang }}]" type="text" class="form-control" id="inputEn">
                    </div>
                    @endforeach
                    <button type="submit" class="btn btn-primary">{{__('translation.Confirm')}}</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('imagePreview');
            output.innerHTML = '<img width="100" height="100" src="' + reader.result + '" class="mt-2"/>';
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    function selectImage(imageUrl) {
        document.getElementById('imagePreview').innerHTML = '<img width="100" height="100" src="' + imageUrl + '" class="mt-2"/>';
        document.getElementById('productimage').value = "";
        document.getElementById('selectedImage').value = imageUrl;
        $('#imageModal').modal('hide');
    }


    function previewImage(event) {
        var input = event.target;
        var previewImage = document.getElementById('preview');

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                previewImage.src = e.target.result;
                document.getElementById('imageContainer').style.display = 'block';
            }

            reader.readAsDataURL(input.files[0]);
        } else {
            previewImage.src = 'assets/images/tree logo.png';
            document.getElementById('imageContainer').style.display = 'none';
        }
    }

    $(document).ready(function() {
        function calculateTotalPrice() {
            var unitsNumber = $("input[name='units_number']").val();
            var unitPrice = $("input[name='unit_price']").val();
            var tax = $("select[name='tax']").val();
            var total = unitsNumber * unitPrice;
            total = total + (total * tax / 100);
            $("input[name='total_price']").val(total);
        }

        $("input[name='units_number'], input[name='unit_price'], select[name='tax']").on('change', calculateTotalPrice);
    });

</script>

@endsection
