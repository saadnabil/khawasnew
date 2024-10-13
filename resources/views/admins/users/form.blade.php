@extends('layout.AdminMaster')

@section('content')

<div class="row">

    <form action="{{$action}}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        @if (isset($method))
        @method('PUT')
        @endif

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{__('translation.Create User')}}</h4>
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


                         <div class="mb-3 col-md-4">
                                <label for="customerID" class="form-label">{{(__('translation.Customer ID'))}}
                                </label>
                                <input name="usercode" value="{{ old('usercode', $user->usercode) }}" type="text" class="form-control" id="customerID">
                            </div>



                            <div class="mb-3 col-md-4">
                                <label for="username" class="form-label">{{(__('translation.Name'))}}
                                </label>
                                <input name="name" value="{{ old('name', $user->name) }}" type="text" class="form-control" id="username">
                            </div>


                            <div class="mb-3 col-md-4">
                                <label for="email" class="form-label">
                                    {{(__('translation.Email'))}} </label>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" id="email">
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="phone" class="form-label">
                                    {{(__('translation.PHONE NUMBER'))}} </label>
                                <input name="phone" value="{{ old('phone', $user->phone) }}" type="text" class="form-control" id="phone">
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="userstatus" class="form-label">{{(__('translation.Status'))}}
                                </label>
                                <select name="status" id="userstatus" class="form-select">
                                    <option>Choose</option>
                                     <option value="1" {{ old('status', $user->status) == 1 ? 'selected' : '-' }}>
                                        {{(__('translation.active'))}}</option>
                                    <option value="0" {{ old('status', $user->status) == 0 ? 'selected' : '-' }}>
                                        {{(__('translation.inactive'))}}</option>

                                </select>
                            </div>

                            <div class="mb-3 col-md-4">
                                    <label class="form-label">User image </label>
                                    <input autocomplete="off" name="image" type="file" class="form-control">
                                    @error('image')
                                    <div class="mt-1" style="font-size: 12px;color:red;font-weight:bold;">
                                        {{ $message }}</div>
                                    @enderror
                                </div>
                                <div id="imagePreview" class="mt-2">
                                    @if (isset($method))
                                    <img width="100" height="100" 
                                    src="{{ $user->image != null ? url('storage/'.$user->image) : url('avatar.png') }}" class="mt-2" />
                                    @endif
                                </div>
                                    </div>


                            <div class="row g-2">



                                <div class="mb-3 col-md-6">
                                    <label for="userpass" class="form-label">{{(__('translation.Password'))}}</label>
                                    <input min="6" name="password" type="password" class="form-control" id="userpass">
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="userpassconfirm" class="form-label">{{(__('translation.Repassword'))}}</label>
                                    <input name="confirmpassword" type="password" class="form-control" id="userpassconfirm">
                                </div>

                            </div>


                            <a href="{{route('admin.users.index')}}" type="submit" class="btn btn-info">{{(__('translation.Back'))}}</a>
                            <button type="submit" class="btn btn-primary">{{(__('translation.Confirm'))}}</button>
                    </form>

                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div>
    </form>
</div>
{{-- <script>
        function previewImage(event) {
            var input = event.target;
            var imageContainer = document.getElementById('imageContainer');
            var previewImage = document.getElementById('preview');

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    previewImage.src = e.target.result;
                    imageContainer.style.display = 'block'; // Show the image container
                }

                reader.readAsDataURL(input.files[0]);
            } else {
                previewImage.src = 'assets/images/tree logo.png'; // Reset to default image
                imageContainer.style.display = 'none'; // Hide the image container
            }
        }
    </script> --}}

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
