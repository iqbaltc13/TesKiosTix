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
Route::get('/dashboard', function () {
    return view('layouts.dashboard');
});
Route::group(['prefix'=>'errors'],function(){
    Route::get('error500','Helpers\WebHelperController@error500')->name('error.500');
    Route::get('error404','Helpers\WebHelperController@error404')->name('error.404');
});

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth'] ], function() {
    Route::group(['prefix' => 'upload'], function () {
        Route::post('file', "Api\V1\UploadFileController@uploadFile")->name('upload_file');
    });
    Route::group(['prefix' => 'dashboard', 'namespace' => 'Dashboard'], function() {
        Route::group(['prefix' => 'user-management', 'namespace' => 'User'], function() {
            Route::get('index','UserController@index')->name('dashboard.user.index');
            Route::get('data','UserController@data')->name('dashboard.user.data');
            Route::get('create','UserController@create')->name('dashboard.user.create');
            Route::get('edit/{id}','UserController@edit')->name('dashboard.user.edit');
            Route::delete('delete/{id}','UserController@destroy')->name('dashboard.user.destroy');  
            Route::post('delete-json','UserController@destroyJson')->name('dashboard.user.destroy-json'); 
            Route::post('store','UserController@store')->name('dashboard.user.store'); 
            Route::post('update/{id}','UserController@update')->name('dashboard.user.update');
            Route::get('detail/{id}','UserController@detail')->name('dashboard.user.detail'); 
            Route::get('detail-json/{id}','UserController@detailJson')->name('dashboard.user.detail-json');
        });
        Route::group(['prefix' => 'notifikasi-broadcast','as'=>'dashboard.notifikasi_broadcast.'], function() {
            Route::get('/','NotifikasiController@index')->name('index');
            Route::get('data-user','NotifikasiController@getDataCustomer')->name('data_customer');
            Route::get('history-broadcast','NotifikasiController@getHistoryBroadcast')->name('history_broadcast');
            Route::post('send','NotifikasiController@sendBroadcast')->name('send');
            Route::get('detail/{id}','NotifikasiController@getDetailBroadcast')->name('detail');


        
        });
        Route::group(['prefix' => 'master', 'namespace' => 'Master','as'=>'dashboard.master.'], function() {
            Route::group(['prefix' => 'role','as'=>'role.'], function() {
                Route::get('index','RoleController@index')->name('index');
                Route::get('data','RoleController@data')->name('data');
                Route::get('datatable','RoleController@datatable')->name('datatable');
                Route::get('create','RoleController@create')->name('create');
                Route::get('edit/{id}','RoleController@edit')->name('edit');
                Route::match(['get', 'delete','post'],'delete/{id}','RoleController@destroy')->name('destroy');  
                Route::post('delete-json','RoleController@destroyJson')->name('destroy-json'); 
                Route::post('store','RoleController@store')->name('store'); 
                Route::put('update/{id}','RoleController@update')->name('update');
                Route::get('detail/{id}','RoleController@detail')->name('detail'); 
                Route::get('detail-json/{id}','RoleController@detailJson')->name('detail-json');
            
            });
            Route::group(['prefix' => 'permission','as'=>'permission.'], function() {
                Route::get('index','PermissionController@index')->name('index');
                Route::get('data','PermissionController@data')->name('data');
                Route::get('datatable','PermissionController@datatable')->name('datatable');
                Route::get('create','PermissionController@create')->name('create');
                Route::get('edit/{id}','PermissionController@edit')->name('edit');
                Route::match(['get', 'delete','post'], 'delete/{id}','PermissionController@destroy')->name('destroy');  
                Route::post('delete-json','PermissionController@destroyJson')->name('destroy-json'); 
                Route::post('store','PermissionController@store')->name('store'); 
                Route::put('update/{id}','PermissionController@update')->name('update');
                Route::get('detail/{id}','PermissionController@detail')->name('detail'); 
                Route::get('detail-json/{id}','PermissionController@detailJson')->name('detail-json');
            
            });
            
        });
        Route::group(['prefix' => 'profile-management', 'namespace' => 'User'], function() {
            Route::get('index','ProfileController@index')->name('dashboard.profil.index');
            Route::get('edit','ProfileController@edit')->name('dashboard.profil.edit');
            Route::post('update','ProfileController@update')->name('dashboard.profil.update');
            Route::get('change-password','ProfileController@changePassword')->name('dashboard.profil.change-password');
            Route::post('update-password','ProfileController@updatePassword')->name('dashboard.profil.edit-password');
            
        });
        Route::group(['prefix' => 'buku','as'=>'dashboard.buku.'], function() {
            Route::get('index','BukuController@index')->name('index');
            Route::get('datatable','BukuController@datatable')->name('datatable');
            Route::get('create','BukuController@create')->name('create');
            Route::get('edit/{id}','BukuController@edit')->name('edit');
            Route::delete('delete/{id}','BukuController@destroy')->name('destroy');  
            Route::post('delete-json','BukuController@destroyJson')->name('destroy-json'); 
            Route::post('store','BukuController@store')->name('store'); 
            Route::post('update/{id}','BukuController@update')->name('update');
            Route::get('detail/{id}','BukuController@detail')->name('detail'); 
            Route::get('detail-json/{id}','BukuController@detailJson')->name('detail-json');
        });
        Route::group(['prefix' => 'kategori','as'=>'dashboard.kategori.'], function() {
            Route::get('index','KategoriController@index')->name('index');
            Route::get('datatable','KategoriController@datatable')->name('datatable');
            Route::get('create','KategoriController@create')->name('create');
            Route::get('edit/{id}','KategoriController@edit')->name('edit');
            Route::delete('delete/{id}','KategoriController@destroy')->name('destroy');  
            Route::post('delete-json','KategoriController@destroyJson')->name('destroy-json'); 
            Route::post('store','KategoriController@store')->name('store'); 
            Route::post('update/{id}','KategoriController@update')->name('update');
            Route::get('detail/{id}','KategoriController@detail')->name('detail'); 
            Route::get('detail-json/{id}','KategoriController@detailJson')->name('detail-json');
        });
        Route::group(['prefix' => 'penulis','as'=>'dashboard.penulis.'], function() {
            Route::get('index','PenulisController@index')->name('index');
            Route::get('datatable','PenulisController@datatable')->name('datatable');
            Route::get('create','PenulisController@create')->name('create');
            Route::get('edit/{id}','PenulisController@edit')->name('edit');
            Route::delete('delete/{id}','PenulisController@destroy')->name('destroy');  
            Route::post('delete-json','PenulisController@destroyJson')->name('destroy-json'); 
            Route::post('store','PenulisController@store')->name('store'); 
            Route::post('update/{id}','PenulisController@update')->name('update');
            Route::get('detail/{id}','PenulisController@detail')->name('detail'); 
            Route::get('detail-json/{id}','PenulisController@detailJson')->name('detail-json');
        });
        Route::group(['prefix' => 'config', 'as' =>'dashboard.config.'], function () {
            Route::get('log', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->name('log');
        });
    });
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


