@extends('layout.AdminMaster')

@section('content')
<div class="container">
    <h1>Edit License</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('licenses.update', $license->id) }}" method="POST">
        @method('PUT')
        @csrf
        
        <div class="form-group">
            <label for="admin_id">Admin</label>
            <select name="admin_id" id="admin_id" class="form-control">
                @foreach($admins as $admin)
                    <option value="{{ $admin->id }}" {{ $license->admin_id == $admin->id ? 'selected' : '' }}>{{ $admin->name }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="form-group">
            <label for="days">Days</label>
<input type="number" name="days" id="days" class="form-control"
 value="{{ $license->end_date }} | {{$license->start_date}}">
        </div>

        <button type="submit" class="btn btn-primary">Edit License</button>
    </form>
</div>
@endsection
