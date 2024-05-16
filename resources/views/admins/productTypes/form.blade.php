@extends('layout.AdminMaster')

@section('content')

   <div class="row">

                        <form action="{{ $action }}" method="post" >
                         {{ csrf_field() }}
                    @if (isset($method))
                        @method('PUT')
                    @endif

                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Product Types </h4>
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
                                                    <label for="inputEn" class="form-label">Product
                                                        Type ({{ $lang }}) </label>
                                                    <input  value="{{ old('title.' . $lang, isset($itemtype->title[$lang]) ? $itemtype->title[$lang] : '') }}"
                                                     name="title[{{ $lang }}]" type="text" class="form-control" id="inputEn" >
                                                </div>
                                                @endforeach

                                               

                                                

                                                
                                            </div>

                                           
                                            <a href="Product_type.html" type="submit" class="btn btn-info">Back</a>
                                            <button type="submit" class="btn btn-primary">Confirm</button>
                                        </form>

                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div>
                        </form>
                    </div>

    
@endsection