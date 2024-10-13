@extends('layout.UserMatser')

@section('content')


<div class="row">



    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <h6 class="card-title">{{__('translation.Change profile photo')}}</h6>

               <form id="changeImageForm" action="{{ route('user.UserChangeImage') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-group col-sm-8">
        <div class="mb-3">
            <label for="imageInput" class="form-label">Upload New Image</label>
            <input id="imageInput" name="image" type="file" class="form-control" accept="image/*" onchange="previewImage(event)">
        </div>
        @if (auth()->user()->image)
        <div class="mb-3">
            <img id="currentImage" src="{{ asset('storage/' . old('image', auth()->user()->image)) }}" alt="Current Image" width="80" height="80">
        </div>
        @endif
    
    </div>

    <div class="form-group col-sm-6">
        <button type="submit" class="btn btn-primary">{{__('translation.Change profile photo')}}</button>
    </div>
</form>



              



            </div>
            </div>
            

            <script>
function previewImage(event) {
    const imagePreviewContainer = document.getElementById('imagePreviewContainer');
    const imagePreview = document.getElementById('imagePreview');
    const file = event.target.files[0];

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            imagePreview.src = e.target.result;
            imagePreviewContainer.style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else {
        imagePreviewContainer.style.display = 'none';
    }
}
</script>


	
@endsection