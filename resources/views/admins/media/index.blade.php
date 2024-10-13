@extends('layout.AdminMaster')

@section('content')


<div class="col-xl-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Media Gallery</h4>

            <a href="{{ route('media.create') }}" class="btn btn-primary mb-3">Upload New Files</a>



            <div class="card-body">

                <div class="table-responsive-sm">
                    <table class="table table-striped table-centered mb-0">
                        <thead>
                            <tr>
                                <th>File Name</th>
                                <th>File Type</th>
                                <th>Preview</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($media as $item)
                            <tr>
                                <td>{{ $item->file_name }}</td>
                                <td>{{ $item->file_type }}</td>
                                <td>
                                    @if(str_contains($item->file_type, 'image'))
                                    <img src="{{ Storage::url($item->file_path) }}"
                                     alt="{{ $item->file_name }}" style="max-width: 100px;">


                                    @elseif(str_contains($item->file_type, 'video'))
                                    <video width="150" controls>
                                        <source  src="{{ Storage::url($item->file_path) }}" type="{{ $item->file_type }}">
                                        Your browser does not support the video tag.
                                    </video>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('media.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>



                </div>

                <div class="card-footer clearfix">
                {{ $media->links('pagination::bootstrap-5') }}

            </div>

            </div>



        </div>
    </div>
</div>





@endsection
