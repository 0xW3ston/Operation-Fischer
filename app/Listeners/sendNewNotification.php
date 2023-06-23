<?php

namespace App\Listeners;

use App\Events\commandeAdded;
use App\Models\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Http;
use Nette\Utils\Json;

class sendNewNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(commandeAdded $event): void
    {
        // Prepare the data to send in the POST request
        $data = [
            'channel' => $event->channel,
            'data' => $event->data
        ];
        
        Notification::create([
            "role" => "admin",
            "message" => $event->data
        ]);

        // Send the POST request using Laravel's HTTP client
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . config('app.sse')
        ])->post('http://localhost:8080/sse-webhook', $data);
    }
}
