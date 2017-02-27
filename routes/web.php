<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/kiosk', 'FrontController@getKiosk');
Route::post('/kiosk/add', 'FrontController@postKiosk');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'view.finder.admin', 'role:admin']], function (){
    Route::get('/', 'AdminController@index');
    Route::get('/user', 'UserController@Index');
    Route::get('/user/{param}', 'UserController@getUser');
    Route::post('/user/modify', 'UserController@postUser');
    Route::post('/user/delete', 'UserController@deleteUser');
    Route::post('/user-list', 'UserController@getList');
});

Route::group(['prefix' => 'loket', 'namespace' => 'Loket', 'middleware' => ['auth', 'view.finder.loket', 'role:loket']], function (){
    Route::get('/', 'LoketController@index');
    Route::get('/antrian', 'QueueController@index');
    Route::post('/antrian-list', 'QueueController@getList');
    Route::get('/register', 'RegistrationController@getRegister');
});

Route::group(['prefix' => 'penata-jasa', 'namespace' => 'PenataJasa', 'middleware' => ['auth', 'view.finder.penata-jasa', 'role:penata-jasa']], function (){
    Route::get('/', 'PenataJasaController@index');
});

Route::group(['prefix' => 'kasir', 'namespace' => 'Kasir', 'middleware' => ['auth', 'view.finder.kasir', 'role:kasir']], function (){
    Route::get('/', 'KasirController@index');
});