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
                                        <h4 class=".card-title">Create
                                            Product Taxes</h4>
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

                                                <div class="mb-3 col-md-5">
                                                    <label for="taxx" class="form-label">Product
                                                        Product Taxes </label>
                                                    <input min="0" name="tax" value="{{ old('tax', $itemtax->tax) }}" type="number" class="form-control" id="taxx" >
                                                </div>

                                               
                                                
                                            </div>

                                           
                                            <a href="products_tax.html" type="submit" class="btn btn-info">Back</a>
                                            <button type="submit" class="btn btn-primary">Confirm</button>
                                        </form>

                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div>
                        </form>
                    </div>

    
@endsection