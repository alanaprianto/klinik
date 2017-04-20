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

Route::get('/', 'ApiFrontController@welcome');
Route::get('/display', 'ApiFrontController@getDisplay');
Route::post('/kiosk/add', 'ApiFrontController@postKiosk');


Route::group(['middleware' => ['auth:api']], function () {
    Route::group(['prefix' => 'common'], function () {
        /*list all model*/
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
        Route::get('/staff-jobs', 'GeneralController@getStaffJobs');
        Route::get('/staff-positions', 'GeneralController@getStaffPositions');
        Route::get('/tuslahs', 'GeneralController@getTuslahs');
        Route::get('/users', 'GeneralController@getUsers');
        Route::get('/doctors', 'GeneralController@getDoctors');


        Route::get('/user-info', 'ApiCommonController@info');
    });

    Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['role:admin']], function () {
        Route::resource('doctor-services', 'ApiDoctorServiceController');
        Route::resource('permissions', 'ApiPermissionController');
        Route::resource('polies', 'ApiPolyController');
        Route::resource('roles', 'ApiRoleController');
        Route::resource('services', 'ApiServiceController');
        Route::resource('settings', 'ApiSettingController');
        Route::resource('staff', 'ApiStaffController');
        Route::resource('staff-jobs', 'ApiStaffJobController');
        Route::resource('staff-positions', 'ApiStaffPositionController');
        Route::resource('users', 'ApiUserController');

        /*loket*/
        Route::resource('queues', 'ApiQueueController');
        Route::resource('registers', 'ApiRegistrationController');

        /*penata jasa*/
        Route::resource('queues', 'ApiQueueController');

        Route::group(['prefix' => 'check-up'], function () {
            Route::get('/select-service', 'ApiCheckUpController@selectService');
            Route::post('/add-medical-record', 'ApiCheckUpController@postMedicalRecord');
            Route::get('/print-letter', 'ApiCheckUpController@printLetter');
        });
        Route::resource('check-up', 'ApiCheckUpController');

        /*kasir*/
        Route::resource('payments', 'ApiPaymentController');


        /*apotek*/
        Route::resource('recipes', 'ApiRecipeController');

        /*common used*/
        Route::resource('inventories', '\App\Http\Controllers\ApiInventoryController');
        Route::resource('visitors', '\App\Http\Controllers\ApiVisitorController');
        Route::post('/profile', '\App\Http\Controllers\ApiProfileController@postProfile');
    });

    Route::group(['prefix' => 'loket', 'namespace' => 'Loket', 'middleware' => ['role:loket|admin_loket']], function () {
        Route::resource('queues', 'ApiQueueController');

        Route::group(['prefix' => 'registers'], function () {
            Route::put('/select-poly', 'ApiRegistrationController@selectPoly');
            Route::get('/get-patient', 'ApiRegistrationController@getPatient');
            Route::get('', 'ApiRegistrationController@getRegister');
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

        /*common used*/
        Route::resource('inventories', '\App\Http\Controllers\ApiInventoryController');
    });

});