@extends('layout.UserMatser')

@section('content')


						<div class="row">
						
                            
							
                            <div class="col-md-6 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                        
                                        <h6 class="card-title">Change profile image</h6>
                        
                                       <form id="changeImageForm" action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group col-sm-8">
                                <div class="mb-3">
                                    <label for="imageInput" class="form-label">Upload New Image</label>
                                    <input id="imageInput" name="image" type="file" class="form-control" accept="image/*" onchange="previewImage(event)">
                                </div>
                                        <div class="mb-3" id="imagePreviewContainer" style="display: none;">
                                    <label class="form-label">Image Preview</label>
                                    <img id="imagePreview" alt="Image Preview" width="80" height="80">
                                </div>
                            </div>
                        
                            <div class="form-group col-sm-6">
                                <button type="submit" class="btn btn-primary">Change Photo</button>
                            </div>
                        </form>
                        
                                     
                        
                        
                        
                                    </div>
                                </div>
                            </div>
	
						
						</div>
						   <script>
                                       
                        
                        
                        
                        function previewImage(event) {
                            const file = event.target.files[0];
                            if (file) {
                                const reader = new FileReader();
                                
                                reader.onload = function(e) {
                                    // Set the src attribute of the preview image to the uploaded file
                                    const preview = document.getElementById('imagePreview');
                                    preview.src = e.target.result;
                                    document.getElementById('imagePreviewContainer').style.display = 'block';
                                };
                        
                                reader.readAsDataURL(file); // Read the file as a data URL
                            } else {
                                document.getElementById('imagePreviewContainer').style.display = 'none';
                            }
                        }
                        
                        
                                        </script>
	
@endsection