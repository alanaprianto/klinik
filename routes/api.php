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


Route::group(['middleware' => ['auth:api']], function () {
    Route::group(['prefix' => 'common'], function () {
        Route::get('/batches', 'GeneralController@getBatches');
        Route::get('/buyers', 'GeneralController@getBuyers');
        Route::get('/doctor-services', 'GeneralController@getDoctorServices');
        Route::get('/hospital', 'GeneralController@getHospital');
        Route::get('/icd10', 'GeneralController@getIcd10s');
        Route::get('/inventories', 'GeneralController@getInventories');
        Route::get('/kiosks', 'GeneralController@getKiosks');
        Route::get('/medical-records', 'GeneralController@getMedicalRecords');
        Route::get('/patiens', 'GeneralController@getPatients');
        Route::get('/payments', 'GeneralController@getPayments');
        Route::get('/permissions', 'GeneralController@getPermissions');
        Route::get('/pharmacy-seller', 'GeneralController@getPharmacySeller');
        Route::get('/polies', 'GeneralController@getPolies');
        Route::get('/recipes', 'GeneralController@getRecipes');
        Route::get('/references', 'GeneralController@getReferences');
        Route::get('/registers', 'GeneralController@getRegisters');
        Route::get('/roles', 'GeneralController@getRoles');
        Route::get('/services', 'GeneralController@getServices');
        Route::get('/settings', 'GeneralController@getSettings');
        Route::get('/staff', 'GeneralController@getStaff');
        Route::get('/staff-jobs', 'GeneralController@getStaffJobs');
        Route::get('/staff-positions', 'GeneralController@getStaffPositions');
        Route::get('/tuslahs', 'GeneralController@getTuslahs');
        Route::get('/users', 'GeneralController@getUsers');
        Route::get('/user-info', 'CommonController@info');
    });

    Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['role:admin']], function () {
        Route::resource('doctor-services', 'ApiDoctorServiceController');
        Route::resource('permissions', 'ApiPermissionController');
        Route::resource('polies', 'ApiPolyController');
        Route::resource('roles', 'ApiRoleController');
        Route::resource('services', 'ApiServiceController');
        Route::resource('settings', 'ApiSettingController');
        Route::resource('staff', 'ApiStaffController');
    });

    Route::group(['prefix' => 'loket', 'namespace' => 'Loket', 'middleware' => ['role:loket|admin_loket']], function () {
        Route::resource('queues', 'ApiQueueController');

        Route::group(['prefix' => 'registers'], function () {
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
    });

    Route::group(['prefix' => 'kasir', 'namespace' => 'Kasir', 'middleware' => ['role:kasir|admin_kasir']], function () {
        Route::resource('payments', 'ApiPaymentController');
    });

    Route::group(['prefix' => 'apotek', 'namespace' => 'Apotek', 'middleware' => ['role:apotek|admin_apotek']], function () {
        Route::resource('recipes', 'ApiRecipeController');
    });

});