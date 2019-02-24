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
    return redirect('/home');
});

Auth::routes();
Route::get('login',function(){
    return view('auth.login');
})->name('login');
Route::get('qr-login','Auth\LoginController@qrCodeLogin')->name('qr.login');
Route::post('login','Auth\LoginController@attemptLogin')->name('login');
Route::get('logout','Auth\LoginController@logout')->name('logout');
Route::get('/home', 'HomeController@index')->name('home');
