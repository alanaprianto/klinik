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


    Route::get('/poli', 'poliController@Index');
    Route::get('/poli/{param}', 'poliController@getPoli');
    Route::post('/poli/modify', 'poliController@postPoli');
    Route::post('/poli/delete', 'poliController@deletePoli');
    Route::post('/poli-list', 'poliController@getList');

    Route::get('/staffposition', 'StaffpositionController@Index');
    Route::get('/staffposition/{param}', 'staffpositionController@getStaffposition');
    Route::post('/staffposition/modify', 'staffpositionController@postStaffposition');
    Route::post('/staffposition/delete', 'StaffpositionController@deleteStaffposition');
    Route::post('/staffposition-list', 'StaffpositionController@getList');

    Route::get('/staffjob', 'StaffjobController@Index');
    Route::get('/staffjob/{param}', 'staffjobController@getStaffjob');
    Route::post('/staffjob/modify', 'staffjobController@postStaffjob');
    Route::post('/staffjob/delete', 'StaffjobController@deleteStaffjob');
    Route::post('/staffjob-list', 'StaffjobController@getList');

    Route::get('/staff', 'StaffController@Index');
    Route::get('/staff/{param}', 'staffController@getStaff');
    Route::post('/staff/modify', 'staffController@postStaff');
    Route::post('/staff/delete', 'StaffController@deleteStaff');
    Route::post('/staff-list', 'StaffController@getList');

    Route::get('/tindakan', 'ServiceController@Index');
    Route::get('/tindakan/{param}', 'ServiceController@getService');
    Route::post('/tindakan/modify', 'ServiceController@postService');
    Route::post('/tindakan/delete', 'ServiceController@deleteService');
    Route::post('/tindakan-list', 'ServiceController@getList');

    Route::get('/setting', 'SettingController@Index');
    Route::get('/setting/{param}', 'SettingController@getSetting');
    Route::post('/setting/modify', 'SettingController@postSetting');
    Route::post('/setting/delete', 'SettingController@deleteSetting');
    Route::post('/setting-list', 'SettingController@getList');


});

Route::group(['prefix' => 'loket', 'namespace' => 'Loket', 'middleware' => ['auth', 'view.finder.loket', 'role:loket']], function (){
    Route::get('/', 'LoketController@index');
    Route::get('/antrian', 'QueueController@index');
    Route::post('/antrian-list', 'QueueController@getList');

    Route::get('/pendaftaran', 'RegistrationController@index');
    Route::get('/pendaftaran/tambah', 'RegistrationController@getCreateEdit');
    Route::post('/pendaftaran/store', 'RegistrationController@store');
    Route::post('/pendaftaran-list', 'RegistrationController@getList');
    Route::get('/pendaftaran/{id}/tambah-rujukan', 'RegistrationController@getReference');
    Route::post('/pendaftaran/tambah-rujukan', 'RegistrationController@postReference');

    Route::post('/check-medical-report', 'RegistrationController@getInfoMedicalReport');
    Route::post('/pendaftaran/pilih-poli','RegistrationController@selectPoly');

    /*common user*/
    Route::get('/profil', '\App\Http\Controllers\ProfileController@index');
    Route::post('/profil', '\App\Http\Controllers\ProfileController@postUpdate');

});

Route::group(['prefix' => 'penata-jasa', 'namespace' => 'PenataJasa', 'middleware' => ['auth', 'view.finder.penata-jasa', 'role:poli_umum|poli_anak']], function (){
    Route::get('/', 'PenataJasaController@index');
    Route::get('/antrian', 'QueueController@index');
    Route::post('/antrian-list', 'QueueController@getList');

    Route::get('/periksa/{id}', 'CheckUpController@getCreate');
    Route::post('/periksa', 'CheckUpController@postCreate');
    Route::post('/select-service', 'CheckUpController@getService');

    Route::get('/kunjungan', 'ReferenceController@index');
});

Route::group(['prefix' => 'kasir', 'namespace' => 'Kasir', 'middleware' => ['auth', 'view.finder.kasir', 'role:kasir']], function (){
    Route::get('/', 'KasirController@index');
});