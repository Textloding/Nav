<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

// 处理根路径
$router->get('/', function () {
    return view('index');
});

// 处理前端路由，排除 /api 路径
$router->get('/{route:(?!api/).+}', function () {
    return view('index');
});
