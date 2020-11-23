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

Route::get('/about', function() {
    return view('layouts.partials.about');
});

Route::get('/contact', function() {
    return view('layouts.partials.contact');
});

Route::get('/master/{id}', 'HomeController@first');
Route::get('/master/{id}/{first}', 'HomeController@second');
Route::get('/master/{id}/{first}/{second}', 'HomeController@third');
Route::get('/master/{id}/{first}/{second}/{third}', 'HomeController@fourth');
Route::get('/master/{id}/{first}/{second}/{third}/{fourth}', 'HomeController@fifth');

Route::get('/master/{id}/{first}/{second}/{third}/{fourth}/{fifth}', 'HomeController@product');

Route::get('/interactive', 'ChartController@interactive');
Route::get('/getchartdata/{country}', 'ChartController@getChartData');