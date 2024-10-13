<?php

namespace App\Jobs;

use App\Mail\SendOrderEmail;
use App\Models\Admin;
use App\Notifications\TestPusherNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendNotificationAdminJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * Create a new job instance.
     */

     protected $msg;
    public function __construct($msg)
    {
        $this->msg = $msg;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $admins = Admin::all(); //Fetch all admin users
        foreach ($admins as $admin) {
            $admin->notify(new TestPusherNotification($admin->id, $this->msg));
        }
        //notification push
    }
}
