@extends('layout.AdminMaster')

@section('content')

<div class="row">

    <div class="col-xl-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Users</h4>
                <form action method="POST" enctype="multipart/form-data">
                    <a href="#" type="button" class="btn btn-secondary">Export Users</a>
                    <a href="{{route('admin.users.create')}}" type="button" class="btn btn-primary">
                        Add Users</a>
                </form>

            </div>

            <div class="card-body">
                <input id="myInput" onkeyup="myFunction()" type="search" placeholder="search For Customer ID ..." class="form-control" />
                <div class="table-responsive-sm">
                    <table id="myTable" class="table table-striped table-centered mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th># Customer ID</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{$loop->index + 1 }}</td>
                                <td>{{ $user->usercode }}</td>
                                <td class="table-user">
                                    <img data-bs-toggle="modal" data-bs-target="#exampleModal-{{$user->id}}" src="{{ $user->image != null ? url('storage/' . $user->image) : url('avatar.png') }}" alt="user" class="me-2 rounded-circle">
                                    {{ $user->name }}
                                </td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if ($user->status == 1)
                                    <span class="badge bg-success">Active</span>
                                    </th>
                                    @else
                                    <span class="badge bg-danger">Inactive</span></th>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn btn-group">
                                        <a class="btn btn-warning" href="{{ route('admin.users.edit', $user->id) }}" class="text-reset fs-16 px-1">
                                            <i class="ri-pencil-line"></i></a>

                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger" type="submit" href="{{ route('admin.users.destroy', $user) }}" class="text-reset fs-16 px-1">
                                                <i class="ri-delete-bin-2-line"></i>
                                            </button>
                                        </form>
                                    </div>

                                </td>
                            </tr>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal-{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                                {{ $user->name }} </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <img width="100%" height="100%" data-bs-toggle="modal" data-bs-target="#exampleModal" src="assets/images/users/avatar-2.jpg" />

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @endforeach

                        </tbody>
                    </table>
                </div> <!-- end table-responsive-->
                <div class="card-footer clearfix">
                    {{ $users->links('pagination::bootstrap-5') }}
                </div>


            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div>

</div>
<script>
    function myFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }

</script>

@endsection
