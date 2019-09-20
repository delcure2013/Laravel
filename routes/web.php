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
    return view('auth.login');
});

Auth::routes();

//HOME ---------------------------------------------------
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

//CAREGORIES ---------------------------------------------
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/category/create','CategoryController@create');
Route::post('/category/create','CategoryController@store');

Route::get('/category/change','CategoryController@change');
Route::post('/category/change','CategoryController@change');

Route::get('/category/edit/{id}','CategoryController@edit');
Route::post('/category/edit/{id}','CategoryController@update');

Route::delete('/category/destroy/{id}','CategoryController@destroy');

Route::get('/category/index','CategoryController@index');

//SUPPLIERS ------------------------------------------------

Route::get('/supplier/create','SupplierController@create');
Route::post('/supplier/create','SupplierController@store');

Route::get('/supplier/change','SupplierController@change');
Route::post('/supplier/change','SupplierController@change');

Route::get('/supplier/edit/{id}','SupplierController@edit');
Route::post('/supplier/edit/{id}','SupplierController@update');

Route::get('/supplier/view/{id}','SupplierController@view');

Route::delete('/supplier/destroy/{id}','SupplierController@destroy');

Route::get('/supplier/index','SupplierController@index');

//ITEMS ------------------------------------------------

Route::get('/items/create','ItemController@create');
Route::post('/items/create','ItemController@store');

Route::get('/items/edit/{id}','ItemController@edit');
Route::post('/items/edit/{id}','ItemController@update');

Route::get('/items/view/{id}','ItemController@view');

Route::delete('/items/destroy/{id}','ItemController@destroy');

Route::get('/items/index','ItemController@index');

//UNITS ------------------------------------------------

Route::get('/unit/create','UnitController@create');
Route::post('/unit/create','UnitController@store');

Route::get('/unit/edit/{id}','UnitController@edit');
Route::post('/unit/update','UnitController@update');

Route::get('/unit/view/{id}','UnitController@view');

Route::delete('/unit/destroy/{id}','UnitController@destroy');

Route::get('/unit/index','UnitController@index');

//LOCATION ------------------------------------------------

Route::get('/location/create','LocationController@create');
Route::post('/location/create','LocationController@store');

Route::get('/location/edit/{id}','LocationController@edit');
Route::post('/location/update','LocationController@update');

Route::get('/location/view/{id}','LocationController@view');

Route::delete('/location/destroy/{id}','LocationController@destroy');

Route::get('/location/index','LocationController@index');

//BRANDS ------------------------------------------------

Route::get('/brand/create','BrandController@create');
Route::post('/brand/create', 'BrandController@store' );


Route::get('/brand/edit/{id}','BrandController@edit');
Route::post('/brand/update','BrandController@update');

Route::get('/brand/view/{id}','BrandController@view');

Route::delete('/brand/destroy/{id}','BrandController@destroy');
Route::get('/brand/index','BrandController@index');

//STOCK IN------------------------------------------------

Route::get('/stock/createStockIn','StockInController@createStockIn');
Route::post('/stock/createStockIn','StockInController@store');

Route::get('/stock/edit/{id}','StockInController@edit');
Route::post('/stock/edit/{id}','StockInController@update');

Route::get('/stock/view/{id}','StockInController@view');

Route::delete('/stock/destroy/{id}','StockInController@destroy');

Route::delete('/stock/destroyItems/{id}', 'StockInController@destroyItems')->name('stock.destroyItems');

//Route::delete('/stock/destroyItems/{id}','StockInController@destroyItems');


Route::get('/stock/index','StockInController@index');

//STOCK STATUS ------------------------------------------------

Route::get('/stockStatus/create','StockController@createStockIn');
Route::post('/stockStatus/create','StockController@store');

Route::get('/stockStatus/view/{id}','StockController@view');

Route::get('/stockStatus/index','StockController@index');

//STOCK ASSIGN ------------------------------------------------

Route::get('/stockAssign/index','StockAssignController@index');

Route::post('/stockAssign/update','StockAssignController@update');

Route::get('/stockAssign/view/{id}','StockAssignController@view');

Route::delete('/stockAssign/destroy/{id}','StockAssignController@destroy');




