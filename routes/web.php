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

Route::get('/', function () {
    return view('index');
});
Route::get('/receiver', function () {
    return view('receiver');
});
Route::get('/power-supplier', function () {
    return view('power-supplier-confirm');
});
Route::get('/offers', function () {
    return view('offers');
});
Route::get('/postbox-sign', function () {
    return view('postbox-sign');
});
Route::get('/thank-you', function () {
    return view('thank-you');
});
Route::get('/summary', function () {
    return view('summary');
});
Route::get('/contact-us', function () {
    return view('contact-us');
});
Route::get('/terms-of-use', function () {
    return view('terms-of-use');
});
Route::get('/privacy-policy', function () {
    return view('privacy-policy');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
