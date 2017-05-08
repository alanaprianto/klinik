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
Route::post('/kiosk/create', 'ApiFrontController@postKiosk');

Route::group(['middleware' => ['auth:api']], function () {
    Route::group(['prefix' => 'bridge', 'namespace' => 'Bridge'], function (){
        Route::get('/bpjs', 'ApiBpjsController@test');
    });

    Route::group(['prefix' => 'common'], function () {
        /*list all model*/
        Route::get('/batches', 'GeneralController@getBatches');
        Route::get('/doctor-services', 'GeneralController@getDoctorServices');
        Route::get('/hospital', 'GeneralController@getHospital');
        Route::get('/inventories', 'GeneralController@getInventories');
        Route::get('/kiosks', 'GeneralController@getKiosks');
        Route::get('/medical-records', 'GeneralController@getMedicalRecords');
        Route::get('/patiens', 'GeneralController@getPatients');
        Route::get('/payments', 'GeneralController@getPayments');
        Route::get('/permissions', 'GeneralController@getPermissions');
        Route::get('/polies', 'GeneralController@getPolies');
        Route::get('/references', 'GeneralController@getReferences');
        Route::get('/roles', 'GeneralController@getRoles');
        Route::get('/services', 'GeneralController@getServices');
        Route::get('/settings', 'GeneralController@getSettings');
        Route::get('/staff-jobs', 'GeneralController@getStaffJobs');
        Route::get('/staff-positions', 'GeneralController@getStaffPositions');
        Route::get('/tuslahs', 'GeneralController@getTuslahs');
        Route::get('/users', 'GeneralController@getUsers');
        Route::get('/doctors', 'GeneralController@getDoctors');
        Route::get('/countries', '\App\Http\Controllers\Common\ApiCommonController@getCountries');
        Route::get('/provinces', '\App\Http\Controllers\Common\ApiCommonController@getProvinces');
        Route::get('/cities', '\App\Http\Controllers\Common\ApiCommonController@getCities');
        Route::get('/districts', '\App\Http\Controllers\Common\ApiCommonController@getDistrict');
        Route::get('/subDistricts', '\App\Http\Controllers\Common\ApiCommonController@getSubDistrict');


        Route::get('/user-info', '\App\Http\Controllers\Common\ApiCommonController@info');
        Route::get('/icd10', '\App\Http\Controllers\Common\ApiCommonController@getIcd10');
        Route::resource('visitors', '\App\Http\Controllers\Common\ApiVisitorController');

        /*queues*/
        Route::post('/queues/update', '\App\Http\Controllers\Common\ApiQueueController@updateStatus');
        Route::resource('queues', '\App\Http\Controllers\Common\ApiQueueController');

        /*registers*/
        Route::get('/registers/select-patient', '\App\Http\Controllers\Common\ApiRegistrationController@selectPatient');
        Route::post('/registers/{id}', '\App\Http\Controllers\Common\ApiRegistrationController@update');
        Route::post('/add-reference', '\App\Http\Controllers\Common\ApiRegistrationController@postAddReference');

        /*check-up*/
        Route::post('/check-up/change-doctor', '\App\Http\Controllers\Common\ApiCheckUpController@postDoctor');
        Route::post('/check-up/medical-record', '\App\Http\Controllers\Common\ApiCheckUpController@postMedicalRecord');

        Route::resource('payments', '\App\Http\Controllers\Common\ApiPaymentController');
        Route::resource('inventories', '\App\Http\Controllers\Common\ApiInventoryController');
        Route::resource('sellers', '\App\Http\Controllers\Common\ApiSellerController');
        Route::post('/profile', '\App\Http\Controllers\Common\ApiProfileController@postProfile');


        Route::resource('registers', '\App\Http\Controllers\Common\ApiRegistrationController');
        Route::resource('check-up', '\App\Http\Controllers\Common\ApiCheckUpController');
        Route::resource('doctor-services', '\App\Http\Controllers\Common\ApiDoctorServiceController');
        Route::resource('permissions', '\App\Http\Controllers\Common\ApiPermissionController');
        Route::resource('roles', '\App\Http\Controllers\Common\ApiRoleController');
        Route::resource('settings', '\App\Http\Controllers\Common\ApiSettingController');
        Route::resource('staff', '\App\Http\Controllers\Common\ApiStaffController');
        Route::resource('staff-jobs', '\App\Http\Controllers\Common\ApiStaffJobController');
        Route::resource('staff-positions', '\App\Http\Controllers\Common\ApiStaffPositionController');
        Route::resource('users', '\App\Http\Controllers\Common\ApiUserController');
        Route::resource('services', '\App\Http\Controllers\Common\ApiServiceController');

    });

});