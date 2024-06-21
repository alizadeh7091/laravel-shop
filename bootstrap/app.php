<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\CanViewPosts;

return Application::configure(basePath: dirname(__DIR__))
    ->withProviders()
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        api: __DIR__.'/../routes/api.php'
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias(['can-view-post'=>CanViewPosts::class]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
//        $exceptions->render(function (NotFoundHttpException $e,Request $request){
//           dd($e);
//        });

    })->create();
