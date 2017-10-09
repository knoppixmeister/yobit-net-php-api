<?php

class GetTradeAPI
{
    // public and secret key ( still for info & trade & deposits), CHANGE before use
    protected $key = '6377975XD4B4411551058D877CFEECD9';
    protected $secret = 'ff1bc3dd1da1Z8819981e0eeba7c4c55';

    public function queryInit($method, $params=null)
    {

        global $nonce; //подключаем счетчик запросов

        $post = [
            'method' => $method,
            'params' => $params,
            'nonce' => $nonce
        ];

        $curl = curl_init(); //инициализация сеанса

        curl_setopt($curl, CURLOPT_URL, 'https://yobit.net/tapi/');
        curl_setopt($curl, CURLOPT_HTTPHEADER, [

            'key: ' . $this->key,
            'sign: ' . hash_hmac('SHA512', null, $this->secret)
        ]);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_REFERER, true );
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $res = curl_exec($curl);

        if(!$res) {
            $error = curl_error($curl).'('.curl_errno($curl).')';
            echo $error;
        }

        curl_close($curl);

        $j_res = json_decode($res);

        return $j_res;
    }
}