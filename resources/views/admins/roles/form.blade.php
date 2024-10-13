@extends('layout.AdminMaster')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <h6 class="card-title">
            @if (isset($method) && $method =='PUT')
                         {{ __('translation.Edit Roles') }}
                        @else
                         {{ __('translation.Create Roles') }}
                        @endif
            </h6>
            <form action="{{ $action }}" method="POST" autocomplete="off" enctype="multipart/form-data">
                @csrf
                @isset($method)
                @method('PUT')
                @endisset
                <div class="row">
                    <div class="col-sm-4">
                        <div class="mb-3">
                            <label class="form-label">{{ __('translation.Roles') }}</label>
                            <input required autocomplete="off" name="name" value="{{ old('name', $role->name) }}" type="text" 
                            class="form-control" placeholder="{{ __('translation.Enter Role Name') }}">
                            @error('name')
                            <div class="mt-1" style="font-size: 12px; color:red; font-weight:bold;">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12">
                        <!-- Start::buttons -->
                        <div class="mb-5">
                            <button type="button" class="btn btn-primary btn-sm checkall">{{ __('translation.Check all') }}</button>
                            <button type="button" class="btn btn-light btn-sm uncheckall">{{ __('translation.Uncheck all') }}</button>
                        </div>
                        <!-- End::buttons -->
                        <div class="col-md-12">
                            <div class="row">
                                @foreach ($permissions as $permission)
                                <div class="col-md-3">
                                    <input name="permission[]" value="{{ $permission->name }}" {{ $role->hasAnyPermission($permission->name) ? 'checked' : '' }} id="permission{{ $permission->id }}" style="margin-right:10px; display:inline-block;" type="checkbox" />
                                    <!-- begin::Label -->
                                    <label style="cursor:pointer;" for="permission{{ $permission->id }}" class="form-label">{{ $permission->name }}</label>
                                    <!-- end::Label -->
                                </div>
                                @endforeach
                                @error('permission')
                                <div class="mt-1" style="font-size: 12px; color:red; font-weight:bold;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4 mt-3">
                        <a href="{{ route('roles.index') }}" type="button" class="btn btn-light submit">{{ __('translation.Back') }}</a>
                        <button type="submit" class="btn btn-primary">{{ __('translation.Save') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <br>
</div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $(".checkall").click(function(e) {
            e.preventDefault();
            $("input[name='permission[]']").prop('checked', true);
        });

        $(".uncheckall").click(function(e) {
            e.preventDefault();
            $("input[name='permission[]']").prop('checked', false);
        });
    });
</script>
