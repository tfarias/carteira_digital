<?php

namespace App\Services;
use GuzzleHttp\Client;

class ChecaServicoService
{
    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function checar(){
        $client = new Client();
        $res = $client->request('GET', config('services.api.notificacao'));
        return json_decode($res->getBody()->getContents());

    }
}
