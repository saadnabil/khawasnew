<?php

namespace App\Http\Controllers\Users;

use App\Events\ChatSent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Users\TicketFormUserValdate;
use App\Http\Requests\Users\TicketFormValidation;
use App\Models\Message;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Broadcast;
use RealRashid\SweetAlert\Facades\Alert;



class ChatController extends Controller
{
    public function chatform(){
        $user = auth()->user();
        $user = $user->load('tickets.admin','tickets.messages','tickets.user');
        $ticket = $user->tickets->where('status','open')->first();
        return view('users.chat.chatform',compact('ticket'));
    }

    public function sendMessage(Request $request, Ticket $ticket){
        $user = auth()->user();
        $message = new Message();
        $message->content = $request->content;
        $message->ticket_id = $ticket->id;
        $message->reciever_type = 'App\Models\Admin';
        $message->reciever_id = $ticket->admin_id;
        $user->messages()->save($message);

        \Log::info($ticket->admin->slug);
        //Pusher Data
        $message =  $request->content;
        Broadcast(new ChatSent($message,$ticket->admin->slug.$ticket->id));
    }

    public function openticket(TicketFormUserValdate $request)
    {
        $data = $request->validated();
        $user = auth()->user();
        $user = $user->load('tickets');
        $user->tickets()->update([
            'status' => 'closed',
        ]);
        Ticket::create([
            'message' => $data['message'],
            'user_id' => auth()->user()->id,
            'status' => 'new',
         ]);
         Alert::toast(__('translation.Thank you for your inquiry. We have received your message and will respond within the next 24 hours'),
             __('translation.Success'));

        return redirect()->back();
    }

}
