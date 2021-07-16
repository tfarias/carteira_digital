<?php

namespace App\Providers;

use App\Exceptions\PolicyException;
use Illuminate\Support\ServiceProvider;
use Dingo\Api\Exception\Handler;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Tymon\JWTAuth\Exceptions\JWTException;
/**
 * This will suppress all the PMD warnings in
 * this class.
 *
 * @SuppressWarnings(PHPMD)
 */
class ApiServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registeHandler();
    }

    public function registeHandler(){
        $handler = app(Handler::class);
        $handler->register(function (AuthenticationException $exception){
            return response()->json(['error' => $exception->getMessage()],401);
        });

        $handler->register(function (JWTException $exception){
            return response()->json(['error' => $exception->getMessage()],401);
        });

        $handler->register(function (ValidationException $exception){
            return response()->json(
                [
                    'message' => $exception->getMessage(),
                    'errors' => $exception->validator->getMessageBag()->toArray(),
                    'status_code' => 422
                ],422);
        });

        $handler->register(function (PolicyException $exception){
            return response()->json(
                [
                    'message' => $exception->getMessage(),
                    'status_code' => 403
                ],403);
        });

    }
}
