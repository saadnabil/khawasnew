<?php

namespace App\Events;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Notifications\Notifiable;

class NewOrderReceived implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels,Notifiable;

    public $newOrderCount;

    public function __construct($newOrderCount)
    {
        $this->newOrderCount = $newOrderCount;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('new-order');
    }
}

