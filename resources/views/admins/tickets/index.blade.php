@extends('layout.adminmaster')


@section('content')
    <div class="col-md-12 ">
        <div class="card">
            <div class="card-body">

                {{--  @can('user-create')  --}}
                <div style="float: right">
                    {{-- <a href="{{ route('admins.create') }}" type="button" class="btn btn-inverse-primary">
                        <i data-feather="plus"></i>
                        {{ __('translation.Add') }}</a> --}}
                </div>
                {{--  @endcan  --}}


                {{-- <h6 class="card-title">{{ __('translation.Users') }}</h6> --}}
                {{-- <p class="text-muted mb-3">{{ __('translation.Here you can see all your users in the table.') }}</p> --}}

                <div class="table-responsive">
                    <table id="dataTableExample" class="table table-hover">
                        <thead>
                            <tr>
                                <th>{{ __('translation.ID') }} </th>
                                <th>{{ __('translation.CREATED AT') }} </th>
                                <th>{{ __('translation.User') }}</th>
                                <th>{{__('translation.message')}}</th>
                                <th>{{ __('translation.Status') }}</th>
                                <th>{{ __('translation.Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            @foreach ($tickets as $ticket)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ Carbon\Carbon::parse($ticket->created_at)->format('Y M d - h:i a')  }}</td>
                                    <td>
                                        <img src="{{ $ticket->user->image != null ? url('storage/' . $ticket->user->image) : url('avatar.png') }}"
                                            width="60" height="60" alt="not found" />
                                        <strong> {{ $ticket->user->name }}</strong>
                                    </td>
                                    <td>{{ $ticket->message }}</td>
                                    <th>
                                        @if ($ticket->status == 'open')
                                            <span class="badge bg-success">{{(__('translation.Open'))}}</span>
                                        @elseif($ticket->status == 'closed')
                                            <span class="badge bg-danger">{{(__('translation.Close'))}}</span>
                                        @elseif($ticket->status == 'new')
                                            <span class="badge bg-info">{{(__('translation.New'))}}</span>
                                        @endif
                                    </th>

                                    <td>
                                        <div class="btn-group">

                                                @if($ticket->status != 'closed')
                                                    @can('ticket-edit')
                                                        <a href="{{ route('tickets.edit', $ticket->id) }}"
                                                            class="btn btn-warning btn-icon">
                                                            <i class="ri-check-line"></i>

                                                        </a>
                                                    @endcan
                                                    @can('ticket-close')
                                                        <a href="{{ route('tickets.close', $ticket->id) }}"
                                                            class="btn btn-danger btn-icon">
                                                           <i class="ri-lock-line"></i>

                                                        </a>
                                                    @endcan
                                                @else
                                                -
                                                @endif
                                            {{--  @endcan  --}}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>





    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        // Add event listener for delete button click
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                const userId = this.getAttribute('data-user-id');

                // Show SweetAlert confirmation
                Swal.fire({
                    title: 'Are you sure ?',
                    text: 'You will not be able to recover this user!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If confirmed, submit the form
                        document.getElementById('delete-form-' + userId).submit();
                    }
                });
            });
        });



        $(document).ready(function() {
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
@endsection
