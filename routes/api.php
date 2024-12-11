<?php
/** @var \Laravel\Lumen\Routing\Router $router */

// 临时调试路由
$router->get('debug/users', function () {
    return response()->json([
        'users' => \App\Models\User::all()
    ]);
});

// 公共路由
$router->group(['prefix' => 'auth'], function () use ($router) {
    $router->post('login', 'AuthController@login');
    $router->post('refresh', 'AuthController@refresh');
});

// 前台公共接口
$router->group(['prefix' => 'public'], function () use ($router) {
    // 分类列表
    $router->get('categories', 'CategoryController@index');
    $router->get('categories/{id}', 'CategoryController@show');

    // 网站列表
    $router->get('sites', 'SiteController@index');
    $router->get('sites/{id}', 'SiteController@show');

    // 标签列表
    $router->get('tags', 'TagController@index');
    $router->get('tags/{id}', 'TagController@show');
});
// 需要认证的路由
$router->group(['middleware' => 'auth'], function () use ($router) {
    // 公共方法
    $router->group(['prefix' => 'common'], function () use ($router) {
        $router->post('upload', 'UploadController@uploadImage');
    });

    // 认证相关
    $router->group(['prefix' => 'auth'], function () use ($router) {
        $router->post('logout', 'AuthController@logout');
        $router->get('me', 'AuthController@me');
        $router->post('update-profile', 'AuthController@updateProfile');
    });

    // 分类管理
    $router->group(['prefix' => 'categories'], function () use ($router) {
        $router->post('/', 'CategoryController@store');
        $router->put('/{id}', 'CategoryController@update');
        $router->delete('/{id}', 'CategoryController@destroy');
        $router->patch('/{id}/sort', 'CategoryController@updateSort');
    });

    // 网站管理
    $router->group(['prefix' => 'sites'], function () use ($router) {
        $router->post('/', 'SiteController@store');
        $router->put('/{id}', 'SiteController@update');
        $router->delete('/{id}', 'SiteController@destroy');
        $router->patch('/sort', 'SiteController@updateSort');
        $router->put('/{id}/status', 'SiteController@updateStatus');
        $router->get('/max-sort-order/{id}','SiteController@maxSort');
    });

    // 统计数据
    $router->get('stats', 'StatController@index');
});
