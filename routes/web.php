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

Route::get('/', 'HomeController@dashboard')->name('home');

Route::get('/portfolio', 'PortfolioController@index');
Route::get('/emiten', 'EmitenController@index');

Route::get('/toploss', 'EmitenController@toploss');

Route::post('/pd/portfolio', 'PortfolioController@parsePortfolio');

Route::get('/pd/gettoploss', 'EmitenController@getLoss');
