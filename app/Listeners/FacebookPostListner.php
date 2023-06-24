<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Http;
class FacebookPostListner
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        //
        $longAccessPageToken  = $event->longAccessPageToken;
        $slug = $event->slug ;
        sleep(15);
        $post = Http::post("https://graph.facebook.com?scrape=true&id=https://www.aajakokhabar.com/news/$slug", ['access_token' => $longAccessPageToken]);
    }
}
