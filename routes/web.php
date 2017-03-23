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
Route::get('/', 'FrontController@welcome');
Route::get('/display', 'FrontController@getDisplay');


Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/kiosk', 'FrontController@getKiosk');
Route::post('/kiosk/add', 'FrontController@postKiosk');

Route::get('/print', function () {
    return view('penata-jasa.checkUp.print');
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'view.finder.admin', 'role:admin']], function () {
    Route::get('/', 'AdminController@index');
    Route::get('/user', 'UserController@Index');
    Route::get('/user/{param}', 'UserController@getUser');
    Route::post('/user/modify', 'UserController@postUser');
    Route::post('/user/delete', 'UserController@deleteUser');
    Route::post('/user-list', 'UserController@getList');

    Route::get('/roles', 'RoleController@index');
    Route::get('/role/{param}', 'RoleController@getRole');
    Route::post('/role/modify', 'RoleController@postRole');
    Route::post('/role/delete', 'RoleController@deleteRole');
    Route::post('/role-list', 'RoleController@getList');


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

    Route::get('/setting', 'SettingController@getSetting');
    Route::post('/setting/modify', 'SettingController@postSetting');


    Route::get('/jasa-dokter', 'DoctorServiceController@index');
    Route::post('/jasa-dokter-list', 'DoctorServiceController@getList');
    Route::get('/jasa-dokter/edit/{id}', 'DoctorServiceController@getEdit');
    Route::post('/jasa-dokter/post', 'DoctorServiceController@postEdit');

    Route::get('/rumah-sakit/profile', 'AdminController@getProfile');
    Route::post('/rumah-sakit/profil', 'AdminController@postProfile');



    /*common used*/
    Route::get('/profil', '\App\Http\Controllers\ProfileController@index');
    Route::post('/profil', '\App\Http\Controllers\ProfileController@postUpdate');

    Route::get('/pengunjung', '\App\Http\Controllers\VisitorController@index');
    Route::post('/pengunjung-list', '\App\Http\Controllers\VisitorController@getList');
    Route::get('/pengunjung/detail/{id}', '\App\Http\Controllers\VisitorController@getDetail');

    Route::get('/inventory', '\App\Http\Controllers\InventoryController@index');
    Route::post('/inventory-list', '\App\Http\Controllers\InventoryController@getList');
    Route::get('/inventory/{param}', '\App\Http\Controllers\InventoryController@getCreateEdit');
    Route::post('/inventory/post', '\App\Http\Controllers\InventoryController@store');
    Route::post('/inventory/delete', '\App\Http\Controllers\InventoryController@delete');

    Route::get('/obat', '\App\Http\Controllers\InventoryController@indexMedicine');
    Route::get('/obat/{param}', '\App\Http\Controllers\InventoryController@getCreateEditMedicine');
    /*end common used*/
});

Route::group(['prefix' => 'loket', 'namespace' => 'Loket', 'middleware' => ['auth', 'view.finder.loket', 'role:loket']], function () {
    Route::get('/', 'LoketController@index');
    Route::get('/antrian', 'QueueController@index');
    Route::post('/antrian-list', 'QueueController@getList');
    Route::post('/antrian/update-status', 'QueueController@updateStatus');

    Route::get('/pendaftaran', 'RegistrationController@index');
    Route::get('/pendaftaran/tambah', 'RegistrationController@getCreateEdit');
    Route::post('/pendaftaran/store', 'RegistrationController@store');
    Route::post('/pendaftaran-list', 'RegistrationController@getList');
    Route::get('/pendaftaran/{id}/tambah-rujukan', 'RegistrationController@getReference');
    Route::post('/pendaftaran/tambah-rujukan', 'RegistrationController@postReference');

    Route::post('/check-medical-report', 'RegistrationController@getInfoMedicalReport');
    Route::post('/pendaftaran/pilih-poli', 'RegistrationController@selectPoly');

    /*common used*/
    Route::get('/profil', '\App\Http\Controllers\ProfileController@index');
    Route::post('/profil', '\App\Http\Controllers\ProfileController@postUpdate');
    Route::get('/pengunjung', '\App\Http\Controllers\VisitorController@index');
    Route::post('/pengunjung-list', '\App\Http\Controllers\VisitorController@getList');
    Route::get('/pengunjung/detail/{id}', '\App\Http\Controllers\VisitorController@getDetail');
    /*end common used*/


});

Route::group(['prefix' => 'penata-jasa', 'namespace' => 'PenataJasa', 'middleware' => ['auth', 'view.finder.penata-jasa', 'role:poli_umum|poli_anak']], function () {
    Route::get('/', 'PenataJasaController@index');
    Route::get('/antrian', 'QueueController@index');
    Route::post('/antrian-list', 'QueueController@getList');

    Route::get('/periksa/{id}', 'CheckUpController@getCreate');
    Route::post('/periksa', 'CheckUpController@postCreate');
    Route::post('/select-service', 'CheckUpController@getService');
    Route::post('/tambah/medical-record', 'CheckUpController@postAjax');
    Route::get('/print-letter', 'CheckUpController@printLetter');

    Route::get('/kunjungan', 'ReferenceController@index');
    Route::post('/kunjungan-list', 'ReferenceController@getList');
    Route::get('/kunjungan/detail/{id}', 'ReferenceController@getDetail');

    /*common used*/
    Route::get('/profil', '\App\Http\Controllers\ProfileController@index');
    Route::post('/profil', '\App\Http\Controllers\ProfileController@postUpdate');
    Route::get('/pengunjung', '\App\Http\Controllers\VisitorController@index');
    Route::post('/pengunjung-list', '\App\Http\Controllers\VisitorController@getList');
    Route::get('/pengunjung/detail/{id}', '\App\Http\Controllers\VisitorController@getDetail');
    /*end common used*/

});

Route::group(['prefix' => 'kasir', 'namespace' => 'Kasir', 'middleware' => ['auth', 'view.finder.kasir', 'role:kasir']], function () {
    Route::get('/', 'KasirController@index');
    Route::get('/pembayaran', 'PaymentController@index');
    Route::post('/pembayaran-list', 'PaymentController@getList');
    Route::get('/pembayaran/detail/{id}', 'PaymentController@getPayment');
    Route::post('/pembayaran', 'PaymentController@postPayment');

    /*common used*/
    Route::get('/profil', '\App\Http\Controllers\ProfileController@index');
    Route::post('/profil', '\App\Http\Controllers\ProfileController@postUpdate');
    Route::get('/pengunjung', '\App\Http\Controllers\VisitorController@index');
    Route::post('/pengunjung-list', '\App\Http\Controllers\VisitorController@getList');
    Route::get('/pengunjung/detail/{id}', '\App\Http\Controllers\VisitorController@getDetail');
    /*end common used*/

});


Route::group(['prefix' => 'apotek', 'namespace' => 'Apotek', 'middleware' => ['auth', 'view.finder.apotek', 'role:apotek']], function () {
    Route::get('/', 'ApotekController@index');

    Route::get('/resep', 'RecipeController@index');
    Route::get('/resep/{param}', 'RecipeController@getCreateEdit');
    Route::post('/resep/post', 'RecipeController@postCreate');
    Route::post('/resep-list', 'RecipeController@getList');
    Route::get('/resep/detail/{id}', 'RecipeController@getDetail');
    Route::post('/get-inventory', 'RecipeController@getInventory');
    Route::post('/search-reference', 'RecipeController@postAjaxReference');
    Route::get('/biaya-racik','RecipeController@getPrice');


    /*common used*/
    Route::get('/profil', '\App\Http\Controllers\ProfileController@index');
    Route::post('/profil', '\App\Http\Controllers\ProfileController@postUpdate');
    Route::get('/pengunjung', '\App\Http\Controllers\VisitorController@index');
    Route::post('/pengunjung-list', '\App\Http\Controllers\VisitorController@getList');
    Route::get('/pengunjung/detail/{id}', '\App\Http\Controllers\VisitorController@getDetail');

    Route::get('/inventory', '\App\Http\Controllers\InventoryController@index');
    Route::post('/inventory-list', '\App\Http\Controllers\InventoryController@getList');
    Route::get('/inventory/{param}', '\App\Http\Controllers\InventoryController@getCreateEdit');
    Route::post('/inventory/post', '\App\Http\Controllers\InventoryController@store');
    Route::post('/inventory/delete', '\App\Http\Controllers\InventoryController@delete');

    Route::get('/obat', '\App\Http\Controllers\InventoryController@indexMedicine');
    Route::get('/obat/{param}', '\App\Http\Controllers\InventoryController@getCreateEditMedicine');
    /*end common used*/

});