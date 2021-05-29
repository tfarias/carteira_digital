<?php


namespace App\Services;


use GuzzleHttp\Client;

class AutorizaServices
{
    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Exception
     */
    public function autorizar(){
        $client = new Client();
        $res = $client->request('GET', config('services.api.autorizador'));
        $result = json_decode($res->getBody()->getContents());
        if($result->message !== "Autorizado"){
            throw new \Exception($result->message);
        }
        return $result;
    }
}
