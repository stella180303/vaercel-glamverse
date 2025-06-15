<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\ExceptionHandling;
use Illuminate\Foundation\Configuration\MiddlewareHandling;
use Illuminate\Foundation\Configuration\Routing;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));
require __DIR__.'/../vendor/autoload.php';

/** @var Application $app */
$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/api.php', // hanya API
        api: null,
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(/* ... */)
    ->withExceptions(/* ... */)
    ->create();

return $app->handleRequest(Request::capture());
