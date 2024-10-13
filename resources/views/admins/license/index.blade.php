@extends('layout.AdminMaster')

@section('content')
<div class="container">
    <h1>Licenses</h1>

    <a href="{{route('licenses.create')}}" class="btn btn-primary">Create Lic</a>
    <br>

    <table class="table">
        <thead>
            <tr>
                <th>Admin</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Remaining Days</th>
                <th>Created at</th>
                <th>updated at</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($licenses as $license)
  
            <tr>
                <td>{{ $license->admin->name }}</td>
                <td>{{ $license->start_date }}</td>
                <td>{{ $license->end_date }}</td>
                <td>  {{  $license->remaining_days }} </td>
                {{-- <td>{{$license->created_at->diffForHumans()}}</td> --}}
                {{-- <td>{{$license->updated_at->diffForHumans()}}</td> --}}
                <td>
                @can('edit-lic')
                    <a href="{{ route('licenses.edit', $license->id) }}" class="btn btn-warning">Edit</a>
                    @endcan

                    @can('delete-lic')
                    <form action="{{ route('licenses.destroy', $license->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    @endcan
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
