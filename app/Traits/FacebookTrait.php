<?php

namespace App\Traits;

use App\Events\FacebookPostEvent;
use GuzzleHttp\Client as guzzle;
use Carbon\Carbon as Carbon;
use Illuminate\Support\Facades\Http;

trait FacebookTrait
{

    public function facebookShare($news)
    {

        $facebookPageId = '1009044339262777';
        $longAccessPageToken = 'EAAG8OiTceJEBAE5JfZB8KKvuli6rsfgEgSAfvojiUGpnbwj0mGRKX07E1f8kbTpvVZARZAfSr3fGnDP8su1ZARKCZCPwsXtUfSXWRDjO875LiLh05sxNAYPZAZCefkgUbojvEA5GouIK5ToykjNAkXbvQHDMTjc21mD9d59U9W4MAZDZD';
        if ($this->checkNewsValidity($news)) {
            $response = Http::post("https://graph.facebook.com/$facebookPageId/feed", [
                'message' => $news->title['np'],
                'link' => route('newsDetail', $news->slug),
                'access_token' => $longAccessPageToken
            ]);

            $mainpage = Http::get("https://graph.facebook.com/", route('index'), ['access_token' => $longAccessPageToken]);
            $newsPage = Http::get("https://graph.facebook.com/", route('newsDetail', $news->slug), ['access_token' => $longAccessPageToken]);

            $slug = $news->slug;
            event(new FacebookPostEvent($longAccessPageToken, $slug));



            return $response;
        }
        return false;
    }

    public function checkNewsValidity($news)
    {
        $scheduled = $news->published_at->lt(Carbon::now());
        $publish_status = $news->publish_status;
        if ($publish_status && $scheduled) {
            return true;
        }
        return false;
    }
}
