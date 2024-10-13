@extends('layout.AdminMaster')

@section('content')

<div class="row">

    <div class="col-xl-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">{{__('translation.Admins')}}</h4>
                <form action="" method="POST" enctype="multipart/form-data">
                    @can('admin-export')
                    <a href="{{route('admin.exportAdmins')}}" type="button" class="btn btn-secondary">{{__('translation.Exports Admins')}}</a>
                    @endcan

                    @can('admin-create')

                    <a href="{{route('admins.create')}}" class="btn btn-dark">
                        <i class="mdi mdi-plus"></i> {{__('translation.Create admin')}}</a>

                    @endcan
                </form>

            </div>

            <div class="card-body">
                <input id="myInput" onkeyup="myFunction()" type="search" placeholder="{{__('translation.Search here...')}} ..." class="form-control">
                <div class="table-responsive-sm">
                    <table id="myTable" class="table table-striped table-centered mb-0">
                        <thead>
                            <tr>
                                <th>{{ __('translation.NAME') }}</th>
                                <th>{{ __('translation.PHONE NUMBER') }}</th>

                                <th>{{ __('translation.EMAIL') }}</th>
                                <th>{{ __('translation.Status') }}</th>
                                <th>{{ __('translation.Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admins as $admin)
                            <tr>
                                <td class="table-user">
                                    <img data-bs-toggle="modal" data-bs-target="#exampleModal-{{$admin->id }}" src="{{$admin->image != null ? url('storage/' .$admin->image) : url('item.png') }}" alt="table-user" class="me-2 rounded-circle">
                                    {{$admin->name }}
                                </td>
                                <td> {{$admin->phone }}</td>
                                <td> {{$admin->email }}</td>
                                <td><span class="badge bg-success rounded-pill"> @if($admin->status == 0)
                                        <span class="badge bg-warning">{{__('translation.inactive')}}</span>
                                        @elseif($admin->status == 1)
                                        <span class="badge bg-success">{{__('translation.active')}}</span>
                                        @endif</span></td>
                                <td>

                                    <div class="btn btn-group">
                                        @can('admin-edit')
                                        <a class="btn btn-warning " href="{{ route('admins.edit', $admin) }}">
                                            <i class="ri-pencil-line"></i></a>
                                        @endcan


                                        @can('admin-delete')
                                        <form id="delete-admin-form-{{ $admin->id }}" action="{{ route('admins.destroy', $admin) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="button" class="btn btn-danger" onclick="confirmDeletionAdmin({{ $admin->id }})">
                                                <i class="ri-delete-bin-2-line"></i>
                                            </button>

                                        </form>

                                        @endcan
                                    </div>

                                </td>


                            </tr>



                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal-{{$admin->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                                {{$admin->name }} </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <img width="100%" height="100%" data-bs-toggle="modal" data-bs-target="#exampleModal" src="{{$admin->image != null ? url('storage/' .$admin->image) : url('item.png') }}">

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('translation.Close')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>








                            @endforeach






                        </tbody>
                    </table>
                </div> <!-- end table-responsive-->



            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>


<script>
   


function confirmDeletionAdmin(adminId) {
    Swal.fire({
        title: '{{ __('translation.Are you sure ?') }}',
        text: '{{ __('translation.You wont be able to revert this!') }}',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: '{{ __('translation.Yes, delete it!') }}',
        cancelButtonText: '{{ __('translation.Cancel') }}'
    }).then((result) => {
        if (result.isConfirmed) {
            let timerInterval;
            Swal.fire({
                title: '{{ __('translation.Deleting_in_5_seconds...') }}',
                html: '{{ __('translation.You_can_undo_this_action') }} <b></b>',
                timer: 5000,
                timerProgressBar: true,
                showCancelButton: true,
                confirmButtonText: '{{ __('translation.Undo') }}',
                cancelButtonText: '{{ __('translation.Wait') }}',
                didOpen: () => {
                    const b = Swal.getHtmlContainer().querySelector('b');
                    timerInterval = setInterval(() => {
                        b.textContent = Math.ceil(Swal.getTimerLeft() / 1000);
                    }, 1000);
                },
                willClose: () => {
                    clearInterval(timerInterval);
                }
            }).then((result) => {
                if (result.dismiss === Swal.DismissReason.timer) {
                    // Timer finished, proceed with deletion
                    document.getElementById('delete-admin-form-' + adminId).submit();
                } else if (result.isConfirmed) {
                    // User clicked undo, do nothing
                    Swal.fire({
                        title: '{{ __('translation.Deletion_Cancelled') }}',
                        text: '{{ __('translation.The_admin_has_not_been_deleted') }}',
                        icon: 'info'
                    });
                }
            });
        }
    });
}





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
