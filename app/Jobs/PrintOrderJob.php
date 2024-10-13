<?php

namespace App\Jobs;

use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PrintOrderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $order;

    /**
     * Create a new job instance.
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $client = new Client();
        try {
            $response = $client->post('https://api.printnode.com/v1/printjobs', [
                'auth' => ['c8SCqjuYtRnAf3c--2CG9VQIpQb6FSegJBsRecf1UQM', ''],
                'json' => [
                    'printerId' => 73577734,
                    'title' => 'Order Print',
                    'contentType' => 'pdf_uri',
                    'content' => route('user.printer.pdf', $this->order->id),
                    'source' => 'Laravel App',
                ]
            ]);

            // You can handle the response here if needed
            \Log::info('Print job response: ' . $response->getBody()->getContents());
        } catch (\Exception $e) {
            // Log the error or notify the user
            \Log::error('Error sending print job: ' . $e->getMessage());
        }
    }
}
