<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OtpLessController extends Controller
{

    public function sendOtp($phone){

        $post_fields = [
            "phoneNumber"=>"91".$phone,
            "orderId"=>mt_rand(111111111,999999999),
            "hash"=>"",
            "otpLength"=> 6,
            "channel"=>"WHATSAPP",
            "expiry"=> 600
        ];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://auth.otpless.app/auth/otp/v1/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>''.json_encode($post_fields),
            CURLOPT_HTTPHEADER => array(
                'clientId: AN1M2XKKVMZP6DDU2VVG3VUCNO7JLLB8',
                'clientSecret: mfb4hq0z1bl3licga54gfiukm6mz6ckz',
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    public function verifyOtp($order_id,$phone,$otp){

        $post_fields = [
            "phoneNumber"=>"91".$phone,
            "orderId"=>$order_id,
            "otp"=>$otp,
        ];

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://auth.otpless.app/auth/otp/v1/verify',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>''.json_encode($post_fields),
        CURLOPT_HTTPHEADER => array(
            'clientId: AN1M2XKKVMZP6DDU2VVG3VUCNO7JLLB8',
            'clientSecret: mfb4hq0z1bl3licga54gfiukm6mz6ckz',
            'Content-Type: application/json'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

}
