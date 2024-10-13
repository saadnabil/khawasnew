@extends('layout.AdminMaster')

@section('content')
<div class="row">

    <form action="{{ $action }}" method="post">
        {{ csrf_field() }}
        @if (isset($method))
        @method('PUT')
        @endif

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class=".card-title">
                        @if (isset($method) && $method =='PUT')
                        {{ __('translation.Edit item tax') }}
                        @else
                        {{__('translation.Item taxes')}}
                        @endif






                    </h4>
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
                                <label for="taxx" class="form-label">

                                    @if (isset($method) && $method =='PUT')
                                    {{ __('translation.Edit item tax') }}
                                    @else
                                    {{__('translation.Create item tax')}}
                                    @endif



                                </label>
                                <input min="0" name="tax" value="{{ old('tax', $itemtax->tax) }}" type="number" class="form-control" id="taxx">
                            </div>



                        </div>


                        <a href="products_tax.html" type="submit" class="btn btn-info">{{__('translation.Back')}}</a>
                        <button type="submit" class="btn btn-primary">{{__('translation.Confirm')}}</button>
                    </form>

                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div>
    </form>
</div>


@endsection
