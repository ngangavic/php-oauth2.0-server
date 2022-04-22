<?php

class Oauth
{

    function GenerateToken()
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'http://192.168.0.113/oauth/token.php');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
        curl_setopt($ch, CURLOPT_USERPWD, '4edf9268e1e99694b99eb5bc5c59756f' . ':' . 'e6c0e364db477242465154d29520e8cc');

        $headers = array();
        $headers[] = 'Content-Type: application/x-www-form-urlencoded';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        print_r($result);
    }

    function TestToken($token)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'http://192.168.0.113/oauth/resource.php');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "access_token={$token}");

        $headers = array();
        $headers[] = 'Content-Type: application/x-www-form-urlencoded';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            return 'Error:';
        }
        curl_close($ch);
        $data=json_decode($result);
        return $data;
    }
}
