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

// Route::get('/', function () {
//     return view('home');
// });

Route::get('/', 'HomeController@home');

Route::get('/{id}', 'HomeController@first');
Route::get('/{id}/{first}', 'HomeController@second');
Route::get('/{id}/{first}/{second}', 'HomeController@third');
Route::get('/{id}/{first}/{second}/{third}', 'HomeController@fourth');
Route::get('/{id}/{first}/{second}/{third}/{fourth}', 'HomeController@fifth');

Route::get('/{id}/{first}/{second}/{third}/{fourth}/{fifth}', 'HomeController@product');

