<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class PrintService
{
    protected $client;
    protected $apiKey;
    protected $printerId;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = env('PRINTNODE_API_KEY');
        $this->printerId = env('PRINTNODE_PRINTER_ID');
    }

    public function printOrder($order)
    {
        // Generate invoice PDF content
        $pdfContent = $this->generateOrderPdf($order);

        try {
            $response = $this->client->post('https://api.printnode.com/printjobs', [
                'auth' => [$this->apiKey, ''],
                'json' => [
                    'printerId' => $this->printerId,
                    'title' => 'Order Invoice',
                    'contentType' => 'pdf_base64',
                    'content' => base64_encode($pdfContent),
                    'source' => 'Khawas.de'
                ]
            ]);

            Log::info('Print job response: ', ['status' => $response->getStatusCode(), 'body' => $response->getBody()->getContents()]);

            return $response->getStatusCode() == 201;

        } catch (\Exception $e) {
            Log::error('Failed to send print job to PrintNode', ['error' => $e->getMessage()]);
            return false;
        }
    }

    protected function generateOrderPdf($order)
    {
        $html = view('orders.invoice', compact('order'))->render();
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadHTML($html);
        return $pdf->output();
    }
}


