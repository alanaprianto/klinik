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

Route::group(['prefix' => 'common'], function (){
    Route::get('/services', 'GeneralController@getServices');
    Route::get('/polies', 'GeneralController@getPolies');
    Route::get('/icd10s', 'GeneralController@getIcd10s');
    Route::get('/medicalRecords', 'GeneralController@getMedicalRecords');
});

Route::group(['middleware' => ['auth:api']], function () {

    Route::group(['prefix' => 'loket', 'namespace' => 'Loket', 'middleware' => ['role:loket|admin_loket']], function () {
        Route::group(['prefix' => 'antrian'], function () {
            Route::get('/', 'ApiQueueController@index');
            Route::get('/list', 'ApiQueueController@getList');
            Route::post('/update-status', 'ApiQueueController@updateStatus');
        });
        Route::group(['prefix' => 'pendaftaran'], function () {
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


    Route::group(['prefix' => 'penata-jasa', 'namespace' => 'PenataJasa', 'middleware' => ['role:poli_umum|poli_anak|admin_poli_umum|admin_poli_anak']], function () {
        Route::group(['prefix' => 'antrian'], function () {
            Route::get('/', 'ApiQueueController@index');
            Route::get('/list', 'ApiQueueController@getList');
            Route::post('/update-status', 'ApiQueueController@updateStatus');
        });

            Route::group(['prefix' => 'periksa'], function (){
            Route::get('/tambah', 'ApiCheckUpController@getCreate');
            Route::post('/tambah', 'ApiCheckUpController@postCreate');
            Route::get('/select-service', 'ApiCheckUpController@selectService');
        });
    });

});