@extends('layout.UserMatser')

@section('content')


<div class="row">



    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <h6 class="card-title">{{__('translation.Change password')}}</h6>

                <form  action="{{ route('user.UserChangePassword') }}" enctype="multipart/form-data" method="POST">
                    @csrf
					
					 <div class="form-group">
                        <label for="current_password">{{__('translation.New Password')}}</label>
                        <input type="password" name="current_password" class="form-control" >
						 @error('current_password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="new_password">{{__('translation.Confirm New Password')}}</label>
                        <input type="password" name="new_password" class="form-control" >
						@error('new_password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="confirm_password">{{__('translation.Change password')}}</label>
                        <input type="password" name="confirm_password" class="form-control" >
						@error('confirm_password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <br>





                    <button type="submit"   class="btn btn-primary">{{__('translation.Change password')}}</button>
                </form>





            </div>
        </div>
    </div>


</div>



@endsection
