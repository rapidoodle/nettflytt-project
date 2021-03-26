<?php

use Illuminate\Support\Facades\Route;

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
$session = session('request');

Route::get('/', function () {
    return view('index');
});
Route::get('/mottakere', function () {
    return view('receiver');
});
Route::get('/power-supplier', function () {
    return view('power-supplier-confirm');
});
Route::get('/boligsjekk', function () {
    return view('offers');
});
Route::get('/postkasse', function () {
    return view('postbox-sign');
});
Route::get('/takk', function () {
    return view('thank-you');
});
Route::get('/oppsummering', function () {
    return view('summary');
});
Route::get('/kontakt-oss', function () {
    return view('contact-us');
});
Route::get('/kjopsvilkaar', function () {
    return view('terms-of-use');
});
Route::get('/personvern', function () {
    return view('privacy-policy');
});
Route::get('/cookies-consent', function () {
    return view('cookies-consent');
});
Route::get('/folkeregisteret', function () {
    return view('index', ['type' => "folkeregisteret"]);
});
Route::get('/betaling/{number}', 'VippsController@index');
Route::get('/betaling', 'VippsController@checker');
Route::get('/profile', 'ProfileController@index');
Route::get('/logginn', 'ProfileController@logginn');

Route::get('/testapi', 'APIController@testapi')->name('testapi');
Route::get('/recover', 'APIController@recoverStorage')->name('recoverStorage');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//API
Route::post('/getToken', 'APIController@getToken');
Route::post('/sendSMS', 'APIController@sendSMS');
Route::post('/confirmOtp', 'APIController@confirmOtp');
Route::post('/updateCompanyList', 'APIController@updateCompanyList');
Route::post('/searchCompany', 'APIController@searchCompany');
Route::post('/updateCustomerData', 'APIController@updateCustomerData');
Route::post('/storageStatus', 'APIController@storageStatus');
Route::post('/getOtpStatus', 'APIController@getOtpStatus');
Route::post('/loginAuth', 'ProfileController@loginAuth');
Route::post('/submitVipps', 'VippsController@processPayment');
