<?php
namespace yobit\net\php\api\src;

class GetTradeAPI
{
    // public and secret key ( still for info & trade & deposits), CHANGE before USE
    protected $key;
    protected $secret;

    public function __construct($key, $secret)
    {
        $this->key = $key;
        $this->secret = $secret;
    }

    public function queryInit($method, $params=null)
    {

        global $nonce; //подключаем счетчик запросов

        $post = [
            'method' => $method,
            'params' => $params,
            'nonce' => $nonce
        ];

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, 'https://yobit.net/tapi/');
        curl_setopt($curl, CURLOPT_HTTPHEADER, [

            'key: ' . $this->key,
            'sign: ' . \hash_hmac('SHA512', null, $this->secret)
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
