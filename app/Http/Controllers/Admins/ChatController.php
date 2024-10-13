<?php

namespace App\Http\Controllers\Admins;

use App\Events\ChatSent;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Broadcast;


class ChatController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:ticket-chat-replay', ['only' => ['chatform','sendMessage']]);

    }

    public function chatform(Ticket $ticket){
        $user = auth()->user();
        $user = $user->load('tickets.admin','tickets.messages','tickets.user');
        return view('admins.chat.chatform',compact('ticket'));
    }

    public function sendMessage(Request $request, Ticket $ticket){
        $admin = auth()->user();
        $message = new Message();
        $message->content = $request->content;
        $message->ticket_id = $ticket->id;
        $message->reciever_type = 'App\Models\User';
        $message->reciever_id = $ticket->user_id;
        $admin->messages()->save($message);
        //Pusher Data
        $message =  $request->content;
        Broadcast(new ChatSent($message,$ticket->user->slug.$ticket->id));
    }

}
