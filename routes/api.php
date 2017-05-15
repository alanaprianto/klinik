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

    Route::group(['prefix' => 'common', 'namespace' => 'Common'], function () {
        /*list all model*/
        Route::get('/batches', '\App\Http\Controllers\GeneralController@getBatches');
        Route::get('/doctor-services', '\App\Http\Controllers\GeneralController@getDoctorServices');
        Route::get('/hospital', '\App\Http\Controllers\GeneralController@getHospital');
        Route::get('/kiosks', '\App\Http\Controllers\GeneralController@getKiosks');
        Route::get('/medical-records', '\App\Http\Controllers\GeneralController@getMedicalRecords');
        Route::get('/patiens', '\App\Http\Controllers\GeneralController@getPatients');
        Route::get('/payments', '\App\Http\Controllers\GeneralController@getPayments');
        Route::get('/permissions', '\App\Http\Controllers\GeneralController@getPermissions');
        Route::get('/polies', '\App\Http\Controllers\GeneralController@getPolies');
        Route::get('/references', '\App\Http\Controllers\GeneralController@getReferences');
        Route::get('/roles', '\App\Http\Controllers\GeneralController@getRoles');
        Route::get('/services', '\App\Http\Controllers\GeneralController@getServices');
        Route::get('/settings', '\App\Http\Controllers\GeneralController@getSettings');
        Route::get('/staff-jobs', '\App\Http\Controllers\GeneralController@getStaffJobs');
        Route::get('/staff-positions', '\App\Http\Controllers\GeneralController@getStaffPositions');
        Route::get('/tuslahs', '\App\Http\Controllers\GeneralController@getTuslahs');
        Route::get('/users', '\App\Http\Controllers\GeneralController@getUsers');
        Route::get('/doctors', '\App\Http\Controllers\GeneralController@getDoctors');
        Route::get('/countries', '\App\Http\Controllers\GeneralController@getCountries');
        Route::get('/provinces', '\App\Http\Controllers\GeneralController@getProvinces');
        Route::get('/cities', '\App\Http\Controllers\GeneralController@getCities');
        Route::get('/districts', '\App\Http\Controllers\GeneralController@getDistrict');
        Route::get('/subdistricts', '\App\Http\Controllers\GeneralController@getSubDistrict');


        /*route satuan */
        Route::get('/user-info', 'ApiCommonController@info');
        Route::get('/icd10', 'ApiCommonController@getIcd10');
        Route::post('/profile', 'ApiProfileController@postProfile');

        /*route before resource*/
        /*queues*/
        Route::post('/queues/update', 'ApiQueueController@updateStatus');

        /*registers*/
        Route::get('/registers/select-patient', 'ApiRegistrationController@selectPatient');
        Route::post('/registers/{id}', 'ApiRegistrationController@update');
        Route::post('/add-reference', 'ApiRegistrationController@postAddReference');

        /*check-up*/
        Route::post('/check-up/change-doctor', 'ApiCheckUpController@postDoctor');
        Route::post('/check-up/medical-record', 'ApiCheckUpController@postMedicalRecord');

        /*route resource*/
        Route::resource('queues', 'ApiQueueController');
        Route::resource('payments', 'ApiPaymentController');
        Route::resource('inventory-categories', 'ApiInventoryCategoryController');
        Route::resource('inventories', 'ApiInventoryController');
        Route::resource('sellers', 'ApiSellerController');
        Route::resource('visitors', 'ApiVisitorController');
        Route::resource('registers', 'ApiRegistrationController');
        Route::resource('check-up', 'ApiCheckUpController');
        Route::resource('doctor-services', 'ApiDoctorServiceController');
        Route::resource('permissions', 'ApiPermissionController');
        Route::resource('roles', 'ApiRoleController');
        Route::resource('settings', 'ApiSettingController');
        Route::resource('staff', 'ApiStaffController');
        Route::resource('staff-jobs', 'ApiStaffJobController');
        Route::resource('staff-positions', 'ApiStaffPositionController');
        Route::resource('users', 'ApiUserController');
        Route::resource('category-services', 'ApiCategoryServiceController');
        Route::resource('services', 'ApiServiceController');
        Route::resource('transactions', 'ApiTransactionController');
        Route::resource('distributors', 'ApiDistributorController');
    });

});