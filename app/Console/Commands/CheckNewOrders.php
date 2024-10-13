<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;
use App\Events\NewOrderReceived;
use Illuminate\Support\Facades\Log;

class CheckNewOrders extends Command
{
    protected $signature = 'app:check-new-orders';
    protected $description = 'Check for new orders and fire an event if any new orders are found';

    public function handle()
    {
        $newOrders = Order::where('created_at', '>=', now()->subMinutes(1))->get();

        if ($newOrders->count() > 0) {
            event(new NewOrderReceived($newOrders->count()));
        }
    }
}
