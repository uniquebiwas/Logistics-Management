<?php
namespace App\Traits\Api;

use GuzzleHttp\Client;

/**
 *
 */
trait SendNotification
{
    protected function sendNotification($notificationData)
    {
        $data['android'] = [
                "notification" => [
                    "sound" => 'default',
                    "title" => $notificationData['title'],
                    "body" => $notificationData['body'],
                ],
            ];
            $headers = [
                "Authorization" => 'key=AAAAwu7PdCs:APA91bFmmE2ioAP9PAnwVrxobWqdwIPlKK4U5XWT2Bo-hHN76gxUx-ud6-5lgb57bIXlAktiKTw5okHfx0G9zzCcSjXzxKcqIMelkTUJhMUxGtjBak5qm-Fp92uVYaG67wOOFxE8MdHr',
                "Content-Type" => "application/json",
                // "cache-control" => "no-cache"
            ];

                $fields['to'] = "/topics/" . $notificationData['receiverId'];
                $fields['content-available'] = true;
                $fields['priority'] = 'high';
                $fields['data'] = $data;
                $fields['priority'] = 'high';
                $fields = json_encode($fields);

                $client = new Client();
                try {
                    $response = $client->post(env('FCM_URL', "https://fcm.googleapis.com/fcm/send"), [
                        'headers' => $headers,
                        'body' => $fields,
                    ]);
                    // dd($response);
                    $payload = [
                        'senderId' => $notificationData['senderId'],
                        'receiverId' => $notificationData[recieverId],
                    ];
                    if ($response->getStatusCode() == 200) {
                        FirebasePayload::create($payload);
                    }
                    return $response->getStatusCode();
                } catch (\Exception $e) {
                    return $e->getMessage();
                }
                
        // dd($response->getStatusCode());
    }
}
