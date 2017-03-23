<?php

use Illuminate\Http\Request;


@header("Access-Control-Allow-Origin: *");
@header("Access-Control-Allow-Credentials: true");
@header("Access-Control-Allow-Methods: GET, POST, OPTIONS, DELETE, PUT");
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
    $api->get('articles', function ($api) {
        return ['status_code' => 1 , 'data'=>[['id'=>1,'title'=>'first'],['id'=>2,'title'=>'second']]];
    });
    $api->post('admin/login', function ($api) {
        return ['status_code' => 1 , 'data'=>['1232']];
    });

    $api->group(['namespace'=>'App\Api\Controllers\Admin', 'prefix'=>'admin'], function ($api) {
        $api->get('article', 'ArticleController@index')->name('article');
        $api->get('article/{id}', 'ArticleController@detail');
        $api->post('article', 'ArticleController@store');
        $api->put('article/{id}', 'ArticleController@update');
        $api->delete('article/{id}', 'ArticleController@delete');
        $api->post('article/cover', 'ArticleController@cover');
        $api->get('category', 'CategoryController@index')->name('category');
        $api->post('upload', 'UploadController@image');
    });
});
