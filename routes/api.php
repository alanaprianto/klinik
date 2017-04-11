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

Route::group(['prefix' => 'common'], function () {
    Route::get('/services', 'GeneralController@getServices');
    Route::get('/polies', 'GeneralController@getPolies');
    Route::get('/icd10s', 'GeneralController@getIcd10s');
    Route::get('/medicalRecords', 'GeneralController@getMedicalRecords');
});

Route::group(['middleware' => ['auth:api']], function () {

    Route::group(['prefix' => 'loket', 'namespace' => 'Loket', 'middleware' => ['role:loket|admin_loket']], function () {
        Route::resource('queues', 'ApiQueueController');

        Route::group(['prefix' => 'registers'], function (){
            Route::put('/select-poly', 'ApiRegistrationController@selectPoly');
            Route::get('/get-patient', 'ApiRegistrationController@getPatient');
            Route::get('/get-reference', 'ApiRegistrationController@getReference');
            Route::post('/post-reference', 'ApiRegistrationController@postReference');
        });
        Route::resource('registers', 'ApiRegistrationController');
    });


    Route::group(['prefix' => 'penata-jasa', 'namespace' => 'PenataJasa', 'middleware' => ['role:poli_umum|poli_anak|admin_poli_umum|admin_poli_anak']], function () {
        Route::resource('queues', 'ApiQueueController');

        Route::group(['prefix' => 'check-up'], function () {
            Route::get('/select-service', 'ApiCheckUpController@selectService');
            Route::post('/add-medical-record', 'ApiCheckUpController@postMedicalRecord');
            Route::get('/print-letter', 'ApiCheckUpController@printLetter');
        });
        Route::resource('check-up', 'ApiCheckUpController');
/*        Route::group(['prefix' => 'antrian'], function () {
            Route::get('/', 'ApiQueueController@index');
            Route::get('/list', 'ApiQueueController@getList');
            Route::post('/update-status', 'ApiQueueController@updateStatus');
        });


        Route::group(['prefix' => 'periksa'], function () {
            Route::get('/tambah', 'ApiCheckUpController@getCreate');
            Route::post('/tambah', 'ApiCheckUpController@postCreate');
            Route::get('/select-service', 'ApiCheckUpController@selectService');
            Route::get('/medical-record/tambah', 'ApiCheckUpController@addMedicalRecord');
        });*/
    });

});