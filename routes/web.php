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

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('orders', 'OrderController');
    Route::resource('orderdetail', 'OrderDetailController');
    Route::resource('payments', 'PaymentController');
    Route::get('/cetak_pdf/{id}', 'OrderController@printpdf')->name('print_pdf');
    Route::get('/email/{id}','OrderController@sendemail')->name('send_invoice');
});



