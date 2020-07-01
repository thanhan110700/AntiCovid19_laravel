<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('login', 'Api\Auth\AuthController@login');
Route::post('register', 'Api\Auth\AuthController@register');
Route::post('checksodienthoai', 'Api\Auth\AuthController@checksodienthoai');
Route::post('logout', 'Api\Auth\AuthController@logout');
Route::POST('khaibaoytetunguyendangky','Api\Auth\AuthController@getKhaibaoDK'); 
Route::POST('getThongtinnguoidung','Api\Auth\AuthController@getThongtinnguoidung');
Route::POST('getTheodoisuckhoe','Api\Auth\AuthController@getTheodoisuckhoe');
Route::POST('getThongtintheodoisuckhoe','Api\Auth\AuthController@getThongtintheodoisuckhoe');
Route::POST('getGuithongtinRequest','Api\Auth\AuthController@getGuithongtinRequest');
Route::POST('getKhaibaotiepxuc','Api\Auth\AuthController@getKhaibaotiepxuc');
Route::POST('getNguoithan','Api\Auth\AuthController@getNguoithan');
Route::POST('getGuithongtinNguoithan','Api\Auth\AuthController@getGuithongtinNguoithan');
Route::POST('GetXoanguoithan','Api\Auth\AuthController@GetXoanguoithan');
Route::POST('getThongtinNguoithan','Api\Auth\AuthController@getThongtinNguoithan');
Route::POST('getCapnhatsuckhoeNguoithan','Api\Auth\AuthController@getCapnhatsuckhoeNguoithan');


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
