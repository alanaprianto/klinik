<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();


});

Route::get('/test-api', function (){
   return json_encode(['name' => 'Alan'], true);
});


Route::group(['prefix' => 'loket', 'namespace' => 'Loket', 'middleware' => 'auth:api'], function () {
    Route::get('/antrian-list', 'ApiQueueController@getList');
    Route::post('/antrian/update-status', 'ApiQueueController@updateStatus');

    Route::get('/pendaftaran', 'ApiRegistrationController@index');
    Route::get('/pendaftaran/tambah', 'ApiRegistrationController@CreateEdit');
    Route::post('/pendaftaran/store', 'ApiRegistrationController@store');

    Route::get('/test', 'ApiRegistrationController@test');

});