@extends('layout.UserMatser')

@push('style')
    <link rel="stylesheet" href="{{ url('assets/css/chat.css') }}">
@endpush

@section('content')

    @if ($ticket)
        <div class="col-12">
            <div class="chat-area">
                <!-- chatbox -->
                <div class="chatbox">
                    <div class="modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="msg-head">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="d-flex align-items-center">
                                            <span class="chat-icon">
                                                <img class="img-fluid" src="https://mehedihtml.com/chatbox/assets/img/arroleftt.svg" alt="image title">
                                            </span>
                                            <div class="flex-shrink-0">
                                                <img class="img-fluid" src="https://mehedihtml.com/chatbox/assets/img/user.png" alt="user img">
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h3>{{ $ticket->admin->name }}</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-body">
                                <div class="msg-body">
                                    <ul id="chat-area" style="height:50vh; overflow-y:scroll; overflow-x:hidden; padding:20px;">
                                        @foreach ($ticket->messages as $message)
                                            @if ($message->sender_id == auth()->id() && $message->sender_type == 'App\Models\User')
                                                <li class="repaly">
                                                    <p>{{ $message->content }}</p>
                                                    <span class="time">{{ $message->created_at->format('h:i a') }}</span>
                                                </li>
                                            @else
                                                <li class="sender">
                                                    <p>{{ $message->content }}</p>
                                                    <span class="time">{{ $message->created_at->format('h:i a') }}</span>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                            <div class="send-box">
                                <form method="post" autocomplete="off" action="{{ route('user.support.sendMessage', $ticket->id) }}" enctype="multipart/form-data" id="sendMessageForm">
                                    @csrf
                                    <input required id="message" name="content" type="text" class="form-control" aria-label="message…" placeholder="Write message…">
                                    <button id="send" type="submit">
                                        <i class="fa fa-paper-plane" aria-hidden="true"></i>{{ __("translation.Send Message") }}
                                    </button>
                                </form>
                                <div class="send-btns"></div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- chatbox -->
        </div>
    @else
        <label class="form-label">{{ __('translation.chatText') }}</label>
        <br><br>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">{{ __('translation.Create Ticket') }}</button>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ __('translation.Chat with admin') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('user.support.openticket') }}" method="post" id="form">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label">{{ __('translation.message') }}</label>
                                        <textarea required autocomplete="off" name="message" class="form-control" placeholder="Enter Message" maxlength="250">{{ old('message') }}</textarea>
                                        @error('message')
                                            <div class="mt-1" style="font-size: 12px; color:red; font-weight:bold;">
                                                {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __("translation.Close") }}</button>
                        <button type="submit" form="form" class="btn btn-primary">{{ __('translation.Save') }}</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- chat-area -->
<script>
    $('#chat-area').scrollTop($('#chat-area')[0].scrollHeight);

    $(document).ready(function() {
        $(".chat-list a").click(function() {
            $(".chatbox").addClass('showbox');
            return false;
        });

        $(".chat-icon").click(function() {
            $(".chatbox").removeClass('showbox');
        });

        $('#sendMessageForm').submit(function(e) {
            e.preventDefault();
            let route = $(this).attr('action');
            let message = $('#message').val();
            $.post(route, {
                '_token': '{{ csrf_token() }}',
                'content': message,
            }, function(data, status) {
                let senderMessage = `<li class="repaly">
                    <p>${message}</p>
                    <span class="time">Now</span>
                <li>`;
                $('#chat-area').append(senderMessage);
                $('#message').val('');
                $('#chat-area').scrollTop($('#chat-area')[0].scrollHeight);
            });
        });

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;
        var pusher = new Pusher('760480af1169b2a7b3bd', {
            cluster: 'eu'
        });

        var channel = pusher.subscribe('chat{{ auth()->user()->slug }}{{ $ticket != null ? $ticket->id : '' }}');
        channel.bind('chatMessage', function(data) {
            let message = data.message;
            let receiverMessage = `<li class="sender">
                <p>${message}</p>
                <span class="time">Now</span>
            </li>`;
            $('#chat-area').append(receiverMessage);
            $("#chat-area").animate({
                scrollTop: $('#chat-area').prop("scrollHeight")
            }, 1000);
        });
    });
</script>
@endsection
