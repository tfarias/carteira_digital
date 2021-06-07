<?php

use Illuminate\Http\Request;

\ApiRoute::version('v1',function() {
    ApiRoute::group([
        'namespace' => 'App\Http\Controllers',
        'as' => 'api',
        'middleware' => 'bindings' //TODO middleware que permite a passagem de parametros entre os eventos pelo routeApi
    ], function () {
        ApiRoute::get('/', function () {
            return 'home api';
        });
        ApiRoute::post('lojista', 'LojistaController@store')->name('lojista.store');
        ApiRoute::post('comun', 'ComunController@store')->name('comun.store');

        ApiRoute::post('login', 'AuthController@login');
        ApiRoute::post('refresh', 'AuthController@refresh');

        ApiRoute::group([
            'middleware' => ['api.throttle','api.auth'],
            'limit'=>100,
            'expires'=> 3
        ], function () {
            ApiRoute::post('logout', 'AuthController@logout');
            ApiRoute::post('detalhes', 'AuthController@detalhes');

            ApiRoute::put('comun', 'ComunController@update')->name('comun.update');
            ApiRoute::put('lojista', 'LojistaController@update')->name('lojista.update');

            ApiRoute::group(['as' =>'movimento','prefix' => 'movimento'],function(){
                ApiRoute::post('transferir', 'MovimentoController@transferir')->name('movimento.transferir');
                ApiRoute::post('/', 'MovimentoController@store')->name('movimento.store');
            });
            ApiRoute::group(['as' =>'carteira','prefix' => 'carteira'],function(){
                ApiRoute::get('/','CarteiraController@index')->name('carteira.index');
                ApiRoute::get('saldo','CarteiraController@saldo')->name('carteira.saldo');
            });

            ApiRoute::group(['as' =>'notificacoes','prefix' => 'notificacoes'],function(){
                ApiRoute::get('/','NotificacaoController@index')->name('notificacoes.index');
                ApiRoute::get('all','NotificacaoController@all')->name('notificacoes.all');
            });

        });
    });

});


