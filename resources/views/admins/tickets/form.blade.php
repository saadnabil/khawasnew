@extends('layout.adminmaster')

@section('content')
    <div class="col-md-8 ">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Edit Ticket</h6>
                <form action="{{ $action }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                    {{ csrf_field() }}
                    @if (isset($method))
                        @method('PUT')
                    @endif
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label class="form-label">{{ __('translation.Admin') }}</label>
                                <select required name="admin_id" class="form-select">
                                    <option value="">{{ __('translation.Select') }}</option>
                                    @foreach ($admins as $admin)WW
                                        <option {{ old('admin_id', $ticket->admin_id) == $admin->id ? 'selected' : '' }}
                                            value="{{ $admin->id }}">{{ $admin->name }}</option>
                                    @endforeach
                                </select>
                                @error('admin_id')
                                    <div class="mt-1" style="font-size: 12px;color:red;font-weight:bold;">
                                        {{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 mt-3">
                                <a href="{{ route('tickets.index') }}" type="button" class="btn btn-light submit">
                                    {{ __('translation.Back') }}</a>
                                <button type="submit" class="btn btn-primary">{{ __('translation.Save') }}</button>
                            </div>
                        </div>

            </div>
        </div>
    </div>
    </form>
    <br>
@endsection
