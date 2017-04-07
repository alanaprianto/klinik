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

Route::group(['middleware' => ['auth:api']], function () {

    Route::group(['prefix' => 'loket', 'namespace' => 'Loket', 'middleware' => ['role:loket|admin_loket']], function () {
        Route::group(['prefix' => 'antrian'], function (){
            Route::get('/', 'ApiQueueController@index');
            Route::get('/list', 'ApiQueueController@getList');
            Route::post('/update-status', 'ApiQueueController@updateStatus');
        });
        Route::group(['prefix' => 'pendaftaran'], function (){
            Route::get('/', 'ApiRegistrationController@index');
            Route::get('/list', 'ApiRegistrationController@getList');
            Route::get('/tambah', 'ApiRegistrationController@CreateEdit');
            Route::get('/pilih-poli', 'ApiRegistrationController@selectPoly');
            Route::get('/get_patient', 'ApiRegistrationController@getPatient');
            Route::post('/store', 'ApiRegistrationController@store');
            Route::get('/tambah-rujukan', 'ApiRegistrationController@getReference');
            Route::post('/tambah-rujukan', 'RegistrationController@postReference');

        });





    });

});