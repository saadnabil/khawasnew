@extends('layout.AdminMaster')

@section('content')

<div class="row">

    <div class="col-xl-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">{{__('translation.Roles')}}</h4>

                <a href="{{route('roles.create')}}" class="btn btn-dark">
                    <i class="mdi mdi-plus"></i>{{__('translation.Roles&Premisstions')}}</a>



            </div>

            <div class="card-body">
                <input id="myInput" onkeyup="myFunction()" type="search" placeholder="{{__('translation.Search here...')}} ..." class="form-control">
                <div class="table-responsive-sm">
                    <table id="myTable" class="table table-striped table-centered mb-0">
                        <thead>
                            <tr>
                                <th>{{__('translation.Roles')}}</th>
                                <th>{{__('translation.Actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rows as $row)
                            <tr>
                                <td>{{ $row->name}}</td>
                                <td>
                                    <div class="btn btn-group">
                                        <a class="btn btn-warning " href="{{ route('roles.edit', $row) }}">
                                            <i class="ri-pencil-line"></i></a>


                                        <form action="{{ route('roles.destroy', $row) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger " type="submit" href="{{ route('roles.destroy', $row) }}">
                                                <i class="ri-delete-bin-2-line"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>




                            </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div> <!-- end table-responsive-->



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
