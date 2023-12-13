<?php
namespace App\Instamojo;

class InstamojoManager
{
    private static function generateAccessToken()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, env('IM_URL').'/oauth2/token/');
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

        $payload = Array(
            'grant_type'    => 'client_credentials',
            'client_id'     => env('IM_CLIENT_ID'),
            'client_secret' => env('IM_CLIENT_SECRET')
        );

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }


    private static function createPaymentRequest($token, $user_data, $amount){
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, env('IM_URL').'/v2/payment_requests/');
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER,array('Authorization: Bearer '.$token));

        $payload = Array(
            'purpose'           => 'Wallet Recharge',
            'amount'            => $amount,
            'buyer_name'        => $user_data->name,
            'email'             => $user_data->email?$user_data->email:'techuptechnologies1+instamojo@gmail.com',
            'phone'             => $user_data->phone,
            'redirect_url'      => route('instamojo-redirect').'?user_id='.$user_data->id.'&amount='.$amount,
            'send_email'        => 'true',
            'webhook'           => 'http://www.example.com/webhook/',
            'allow_repeated_payments' => 'False',
        );

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }


    private static function createOrder($id, $token)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, env('IM_URL').'/v2/gateway/orders/payment-request/');
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER,array('Authorization: Bearer '.$token));

        $payload = Array(
            'id' => $id
        );

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    public static function generateOrderId($user_data, $amount)
    {
        $access_token_response = InstamojoManager::generateAccessToken();
        $access_token = json_decode($access_token_response)->access_token;

        $payment_response = InstamojoManager::createPaymentRequest($access_token, $user_data, $amount);
        $id = json_decode($payment_response)->id;

        $createOrder = InstamojoManager::createOrder($id, $access_token);

        return response()->json([
            'created_order'         => json_decode($createOrder),
            'payment_response'      => json_decode($payment_response)
        ],200);
    }
}
