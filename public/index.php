<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\ExceptionHandling;
use Illuminate\Foundation\Configuration\MiddlewareHandling;
use Illuminate\Foundation\Configuration\Routing;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Maintenance mode
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

require __DIR__.'/../vendor/autoload.php';

// Bootstrap dengan view support
/** @var Application $app */
$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (MiddlewareHandling $middleware) {
        $middleware->trustProxies(at: '*');
    })
    ->withExceptions(function (ExceptionHandling $exceptions) {
        //
    })
    ->withViews()  // ← **TAMBAHKAN INI**
    ->create();

return $app->handleRequest(Request::capture());
