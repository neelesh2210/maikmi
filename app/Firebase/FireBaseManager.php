<?php
namespace App\Firebase;

class FireBaseManager
{
    private static function getGoogleAccessToken(){

        $credentialsFilePath = 'maikmi-firebase-adminsdk-o8gj2-3ec4b0ea98.json'; //replace this with your actual path and file name
        $client = new \Google_Client();
        $client->setAuthConfig($credentialsFilePath);
        $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
        $client->refreshTokenWithAssertion();
        $token = $client->getAccessToken();

        return $token['access_token'];
    }

    public static function sendMessage($notification_tray, $token)
    {
        $apiurl = 'https://fcm.googleapis.com/v1/projects/maikmi/messages:send';   //replace "your-project-id" with...your project ID

        $headers = [
            'Authorization: Bearer ' . FireBaseManager::getGoogleAccessToken(),
            'Content-Type: application/json'
        ];

        $message = [
            'message' => [
                'token'             => $token,
                'notification'      => $notification_tray,
            ],
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiurl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($message));

        $result = curl_exec($ch);

        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }

        curl_close($ch);
    }
}
