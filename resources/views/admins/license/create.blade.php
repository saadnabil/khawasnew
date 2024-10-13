@extends('layout.AdminMaster')

@section('content')
<div class="container">
    <h1>Create License</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('licenses.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="admin_id">Select Admin</label>
            <select name="admin_id" id="admin_id" class="form-control" required>
                @foreach($admins as $admin)
                    <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="days">Number of Days</label>
            <input type="number" name="days" id="days" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Create License</button>
    </form>
</div>
@endsection
