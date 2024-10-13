@extends('layout.AdminMaster')

@section('content')


<div class="row">

      <form action="{{ $action }}" method="POST" autocomplete="off" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @if (isset($method))
                        @method('PUT')
                    @endif
                    
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class=".card-title">
                    @if (isset($method) && $method =='PUT')
                                    {{ __('translation.Edit admin') }}
                                    @else
                                    {{__('translation.Create admin')}}
                                    @endif
                                        
                    </h4>
                </div>
                <div class="card-body">

                    <div class="row g-2">

                        <div class="mb-3 col-md-4">
                            <label for="username" class="form-label">{{__('translation.NAME')}}
                            </label>
                            <input name="name" type="text" value="{{ old('name', $admin->name) }}" 
                            class="form-control" id="username">
                             @error('name')
                                    <div class="mt-1" style="font-size: 12px;color:red;font-weight:bold;">
                                        {{ $message }}</div>
                                @enderror
                        </div>

                        <div class="mb-3 col-md-4">
                            <label for="email" class="form-label">
                                {{__('translation.EMAIL')}} </label>
                            <input name="email" value="{{ old('email', $admin->email) }}" type="text" class="form-control" id="email">
                            @error('email')
                                    <div class="mt-1" style="font-size: 12px;color:red;font-weight:bold;">
                                        {{ $message }}</div>
                                @enderror
                        </div>

                        <div class="mb-3 col-md-4">
                            <label for="phone" class="form-label">
                                {{__('translation.PHONE NUMBER')}} </label>
                            <input name="phone" value="{{ old('phone', $admin->phone) }}" type="text" class="form-control" id="phone">
                            @error('phone')
                                    <div class="mt-1" style="font-size: 12px;color:red;font-weight:bold;">
                                        {{ $message }}</div>
                                @enderror
                        </div>

                        <div class="mb-3 col-md-4">
                            <label for="adminroles" class="form-label">{{__('translation.Roles')}}
                            </label>
                            <select id="adminroles" class="form-select" name="role">
                                  <option>Select Role</option>
                                    @foreach ($roles as $role)
                                        <option {{ $admin->hasAnyRole($role->name) ?'selected' : '' }} value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach

                            </select>
                            @error('role')
                                    <div class="mt-1" style="font-size: 12px;color:red;font-weight:bold;">
                                        {{ $message }}</div>
                                @enderror
                        </div>

                        <div class="mb-3 col-md-4">
                            <label for="adminstatus" class="form-label">{{__('translation.Status')}}
                            </label>
                            <select name="status" id="adminstatus" class="form-select">
                                <option  value="" {{ old('status', $admin->status) == '' ? 'selected' : '-' }}>
                                    select</option>
                                <option value="1" {{ old('status', $admin->status) == '1' ? 'selected' : '-' }}>
                                    {{__('translation.active')}}</option>
                                <option value="0" {{ old('status', $admin->status) == '0' ? 'selected' : '-' }}>
                                    {{__('translation.inactive')}}</option>

                            </select>
                            @error('status')
                                    <div class="mt-1" style="font-size: 12px;color:red;font-weight:bold;">
                                        {{ $message }}</div>
                                @enderror
                        </div>

                        <div class="mb-3 col-md-4">
                                <label for="productimage" class="form-label">{{__('translation.Admin Image')}}</label>
                                <input name="image" onchange="previewImage(event)" type="file" class="form-control" id="productimage">
                                @error('image')
                                    <div class="mt-1" style="font-size: 12px;color:red;font-weight:bold;">
                                        {{ $message }}</div>
                                @enderror
                                 <div id="imagePreview" class="mt-2">
                                @if (isset($method))
                                    <img width="100" height="100"
                                        src="{{ $admin->image != null ? url('storage/' . $admin->image) : url('item.png') }}"
                                        class="mt-2" />
                                @endif
                            </div>
                            </div>
                           

                    </div>

                    <div class="row g-2">



                        <div class="mb-3 col-md-6">
                            <label for="userpass" class="form-label">{{__('translation.Password')}}</label>
                            <input min="6" name="password" type="password" class="form-control" id="userpass">
                            @error('password')
                                    <div class="mt-1" style="font-size: 12px;color:red;font-weight:bold;">
                                        {{ $message }}</div>
                                @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="userpassconfirm" class="form-label">{{__('translation.Repassword')}}</label>
                            <input name="repassword" type="password" class="form-control" id="userpassconfirm">
                            @error('repassword')
                                    <div class="mt-1" style="font-size: 12px;color:red;font-weight:bold;">
                                        {{ $message }}</div>
                                @enderror
                        </div>

                    </div>


                    <a href="{{route('admins.index')}}" type="submit" class="btn btn-info">{{__('translation.Back')}}</a>
                    <button type="submit" class="btn btn-primary">{{__('translation.Confirm')}}</button>


                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div>
    </form>

</div>


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

    </script>

@endsection
