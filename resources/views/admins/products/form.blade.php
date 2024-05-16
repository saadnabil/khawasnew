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
                <div class="card-header">
                    <h4 class=".card-title">Create
                        Product</h4>
                            @if ($errors->any())
                    <div>
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                </div>
                <div class="card-body">
                    <form>
                        <div class="row g-2">


                            @foreach ($langs as $key => $lang)
                            <div class="mb-3 col-md-4">
                                <label for="inputEn" class="form-label">Title ({{ $lang }})
                                </label>
                                <input name="title[{{ $lang }}]" type="text" class="form-control" id="inputEn" 
                                value="{{ old('title.' . $lang, isset($item->title[$lang]) ? $item->title[$lang] : '') }}">
                            </div>
                            @endforeach




                            <div class="mb-3 col-md-4">
                                <label for="productype" class="form-label">Product
                                    Type</label>
                                <select name="item_type_id" id="producttype" class="form-select">
                                    @foreach ($types as $type)
                                    <option {{ old('item_type_id', $item->item_type_id) ==  $type->id ? 'selected' : '' }}
                                     value="{{ $type->id }}">{{ $type->title[app()->getLocale()] }}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="mb-3 col-md-2">
                                <label for="quantity" class="form-label">Quantity</label>
                                <input min="1" name="quantity" type="number" class="form-control" 
                                value="{{ old('quantity', $item->quantity) }}" id="quantity">
                            </div>

                        </div>

                        <div class="row g-2">
                            @foreach ($langs as $key => $lang)
                            <div class="mb-3 col-md-4">
                                <label for="unitEn" class="form-label">Unit
                                    Title ({{ $lang }})</label>
                                <input name="unit[{{ $lang }}]"
                                 value="{{ old('unit.' . $lang  , isset($item->unit[$lang]) ? $item->unit[$lang] : '') }}" 
                                type="text" class="form-control" id="unitEn" placeholder>
                            </div>
                            @endforeach


                            <div class="mb-3 col-md-3">
                                <label for="picess" class="form-label">The
                                    Number Of
                                    Pieces</label>
                                <input min="1" name="units_number"
                                 value="{{ old('units_number', $item->units_number) }}" type="number" class="form-control" id="picess" placeholder>
                            </div>

                            <div class="mb-3 col-md-3">
                                <label for="unitprice" class="form-label">Unit
                                    Price</label>
                                <input step="0.01"  min="1" autocomplete="off" name="unit_price" value="{{ old('unit_price', $item->unit_price) }}" type="number" class="form-control" id="unitprice">
                            </div>

                            <div class="mb-3 col-md-3">
                                <label for="tax" class="form-label">Tax</label>
                                <select name="tax" id="tax" class="form-select">
                                    @foreach ($taxes as $tax)
                                    <option {{ old('tax', $item->tax) ==  $tax->tax ? 'selected' : '' }} value="{{ $tax->tax }}">{{ $tax->tax }}%</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="mb-3 col-md-3">
                                <label for="totalprice" class="form-label">Total
                                    Price</label>
                                <input readonly  autocomplete="off" name="total_price" 
                                value="{{ old('total_price', $item->total_price) }}" type="number" class="form-control" id="totalprice">
                            </div>

                            @foreach ($langs as $key => $lang)

                            <div class="mb-3 col-md-4">
                                <label for="descriptionen" class="form-label">Description
                                    ({{ $lang }})</label>

                                <textarea name="description[{{ $lang }}]"  autocomplete="off" type="text" class="form-control">{{ old('description.'. $lang, isset($item->description[$lang]) ? $item->description[$lang] : '') }}</textarea>
                            </div>

                            @endforeach

                             <div class="mb-3 col-md-8">
                                <label for="productimage" class="form-label">Product
                                    Image</label>
                                <input name="image" onchange="previewImage(event)" type="file" class="form-control" id="productimage">
                                @error('image')
                                    <div class="mt-1" style="font-size: 12px;color:red;font-weight:bold;">
                                        {{ $message }}</div>
                                @enderror
                            </div>
                            <div id="imagePreview" class="mt-2">
                                @if (isset($method))
                                    <img width="100" height="100"
                                        src="{{ $item->image != null ? url('storage/' . $item->image) : url('item.png') }}"
                                        class="mt-2" />
                                @endif
                            </div>
                        


                        </div>
                        <br>
                        <a href="{{ route('admin.items.index') }}" type="submit" class="btn btn-info">Back</a>
                        <button type="submit" class="btn btn-primary">Confirm</button>
                    </form>

                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div>
    </form>
</div>

<form action method="POST" enctype="multipart/form-data">
    <div class="col-md-6 ">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="card-title">Add
                            Products By Excel</h6>
                    </div>
                    <div class="col-md-6" style="text-align:right;font-size:13px;font-weight:bold;">
                        <a href>Download
                            Excel Template</a>
                    </div>
                </div>
                <hr>
                <div style>
                    <input type="file" name="file" class="form-control">
                    <br>
                    <button type="submit" class="btn btn-dark">Import
                        Product</button>
                </div>
            </div>
        </div>
    </div>
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    function previewImage(event) {
        var input = event.target;
        var imageContainer = document.getElementById('imageContainer');
        var previewImage = document.getElementById('preview');

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                previewImage.src = e.target.result;
                imageContainer.style.display = 'block'; // Show the image container
            }

            reader.readAsDataURL(input.files[0]);
        } else {
            previewImage.src = 'assets/images/tree logo.png'; // Reset to default image
            imageContainer.style.display = 'none'; // Hide the image container
        }
    }

      $(document).ready(function(){
            $("input[name='units_number']").change(function(){
                var total = $("input[name='units_number']").val() * $("input[name='unit_price']").val();
                total = total + ( total *    $("select[name='tax']").val() / 100);
                $("input[name='total_price']").val(total);
            });
            $("select[name='tax']").change(function(){
                var total = $("input[name='units_number']").val() * $("input[name='unit_price']").val();
                total = total + ( total *    $("select[name='tax']").val() / 100);
                $("input[name='total_price']").val(total);
            });
            $("input[name='unit_price']").change(function(){
                var total = $("input[name='units_number']").val() * $("input[name='unit_price']").val();
                total = total + ( total *    $("select[name='tax']").val() / 100);
                $("input[name='total_price']").val(total);
            });
        });

</script>


@endsection
