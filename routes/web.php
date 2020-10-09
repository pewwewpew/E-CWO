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


Route::get('/test','test1Controller@testing');
Route::get('/test/get-dinamic','test1Controller@dinamic');
Route::get('/test/get-dinamic2','test1Controller@dinamic2');
Route::get('/query','test1Controller@query');
Route::post('/query','test1Controller@query');
Route::post('/test/ajax','test1Controller@test')->name('Test1Controller.test');

//test search dropdown
Route::get('/cari', 'test1Controller@loadData');


Route::get('/','WelcomeController@index');
Route::post('/','WelcomeController@store');

Auth::routes();


//middleware untuk membatasi user yang belum login
Route::group(['middleware' => 'auth:web'], function() {


    Route::get('/home', 'HomeController@index')->name('admin.home');
    //Start Route untuk Admin
    Route::get('/admin/aircraft','Admin\AdminAircraftViewController@index');




    //add menu routes untuk Admin

    //insert aircraft registration
    Route::get('/add-data/aircraft-registration', 'Addrecord\AddAircraftRegistrationController@index');
    Route::post('/add-data/aircraft-registration', 'Addrecord\AddAircraftRegistrationController@store');
    //insert company
    route::get('/add-data/company','Addrecord\AddCompanyController@index');
    route::post('/add-data/company','Addrecord\AddCompanyController@store');
    //insert service
    Route::get('/add-data/service','Addrecord\AddServiceController@index');
    Route::post('/add-data/service','Addrecord\AddServiceController@store');
    //insert aircraft type
    route::get('/add-data/aircraft-type','Addrecord\AddAircraftTypeController@index');
    route::post('/add-data/aircraft-type','Addrecord\AddAircraftTypeController@store');
    //insert detail service
    Route::get('/add-data/detail-service','Addrecord\AddDetailServiceController@index');
    Route::post('/add-data/detail-service','Addrecord\AddDetailServiceController@store');
    //insert new order
    route::get('/add-data/order','Addrecord\AddNewOrderController@index');
    route::post('/add-data/order','Addrecord\AddNewOrderController@store');
    route::get('/add-data/order/get-aircraft','Addrecord\AddNewOrderController@getaircrafts');
    route::get('/add-data/order/get-manhours','Addrecord\AddNewOrderController@getmanhours');
    route::get('/add-data/order/get-users','Addrecord\AddNewOrderController@getusers');
    //add menu route untuk admin end


    //view route untuk admin
    route::get('/detail-services','Admin\AdminDetailServiceViewController@index');

    route::get('/admin/aircraft','AdminAircraftController@index');
    route::get('/admin/aircraft','AdminAircraftController@index');
    route::get('/admin/aircraft/{company}/{id}','AdminAircraftController@show');
    route::put('/admin/aircraft/{company}/{id}','AdminAircraftController@update');

    route::get('/admin/aircraft/{company}/{id}/{service}/detail','OrderDetailController@index');

    route::get('/admin/companies/{id}','CompaniesCostumerController@show');

    Route::get('/services','ServiceController@index');
    Route::delete('/services/add/service/{id}','ServiceController@destroy');

    route::get('/admin/{company}/{aircraft}/orders','OrderController@index');

    //End Route untuk Admin


    //Start Route untuk Costumer
    Route::get('/costumer/home', 'HomeController@index')->name('home');

    //view costumer aircraft
    Route::get('/aircraft','Costumer\AircraftController@index');
    //view costumer aircraft orders
    Route::get('/aircraft/{aircraft}/orders','Costumer\OrderController@index');
    Route::put('/aircraft/{aircraft}/orders','Costumer\OrderController@update');

    //view costumer aircraft order detail
    route::get('/aircraft/{var1}/{var2}/detail','OrderDetailController@index');

    Route::post('/add-data/orders','OrderController@store');
    //End Route untuk Costumer

     //Start Route untuk Performer
     Route::get('/performer/home', 'HomeController@index')->name('performer.home');
    //End Route untuk Performer


});


