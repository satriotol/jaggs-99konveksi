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

use Illuminate\Support\Facades\Route;

Auth::routes(['register' => false]);

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('orders', 'OrderController');
    Route::resource('orderdetail', 'OrderDetailController');
    Route::resource('payments', 'PaymentController');
    Route::resource('user', 'UserController')->except([
        'index','create'
    ]);
    Route::put('/user/{user}/editemail','UserController@updateemail')->name('user.updateemail');
    Route::get('/user/{user}/editemail','UserController@editemail')->name('user.editemail');
    Route::get('/cetak_pdf/{id}', 'OrderController@printpdf')->name('print_pdf');
    Route::get('/email/{id}','OrderController@sendemail')->name('send_invoice');
});
Route::group(['middleware' => ['admin']], function () {
    Route::get('/user', 'UserController@index')->name('user.index');
    Route::get('/create', 'UserController@create')->name('user.create');
    Route::get('/role','UserController@createadmin')->name('user.admin');
    Route::get('/role/{user}', 'UserController@editadmin')->name('user.editadmin');
    Route::put('/role/{user}','UserController@updateadmin')->name('user.updateadmin');
    Route::get('/income','PaymentController@index_income')->name('payment.income');
    Route::get('/outcome','PaymentController@index_outcome')->name('payment.outcome');
    Route::get('/outcome/create','PaymentController@create_outcome')->name('payment.outcomecreate');
    Route::post('/outcome/create','PaymentController@store_outcome')->name('payment.storeoutcome');
    Route::get('/yourorder','OrderController@indexinvoice')->name('order.your');
});



