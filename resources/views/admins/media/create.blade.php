@extends('layout.AdminMaster')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Upload Media</h1>

    <form action="{{ route('media.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
        @csrf

        <div class="form-group">
            <label for="files" class="form-label">Select Files</label>
            <input type="file" id="files" name="files[]" class="form-control" multiple required>
            <div class="invalid-feedback">
                Please select one or more files.
            </div>
        </div>
        <hr>

        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
</div>
@endsection
