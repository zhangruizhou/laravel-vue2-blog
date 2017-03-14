<?php

use Illuminate\Http\Request;


@header("Access-Control-Allow-Origin: *");
@header("Access-Control-Allow-Credentials: true");
@header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
@header("Access-Control-Allow-Headers: DNT,X-Mx-ReqToken,Keep-Alive,User-Agent,X-Requested-With,If-Modified-Since,Cache-Control,Content-Type,token");

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/
$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    $api->get('articles', function () {
        return ['status_code' => 1 , 'data'=>[['id'=>1,'title'=>'first'],['id'=>2,'title'=>'second']]];
    });
    $api->post('admin/login', function () {
        return ['status_code' => 1 , 'data'=>[['token'=>'sadnaskdaksdkas']]];
    });
});
