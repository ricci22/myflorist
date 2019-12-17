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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route provided by Laravel authentication
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

// Route from home page, to get the Pages Controller index,search and show function
Route::get('/', 'PagesController@index');
Route::post('/home/search', 'PagesController@search');
Route::get('/pages/{flower}', 'PagesController@show');

// Route to map the CartsController resources to Views carts and related action
Route::resource('carts', 'CartsController')->middleware('auth');

// Route from navbar link Order History to TransactionsController orderIndex function
Route::get('/order', 'TransactionsController@orderIndex')->middleware('auth');

// Route from transaction history link to TransactionsController index function
Route::get('/transactions', 'TransactionsController@index')->middleware('admin');

// Route to map the UsersController resources to Views users and related action
Route::resource('users', 'UsersController')->middleware('auth');
// Route from profile link to UsersController show function
Route::get('/profile', 'UsersController@show')->middleware('auth');

// Route to map the FlowerTypesController resources to Views flower_types
Route::resource('flower_types', 'FlowerTypesController')->middleware('admin');
Route::post('/flower_types/search', 'FlowerTypesController@search')->middleware('admin');

// Route to map the CouriersController resources to Views couriers
Route::resource('couriers', 'CouriersController')->middleware('admin');
Route::post('couriers/search', 'CouriersController@search')->middleware('admin');

// Route to map the FlowersController resources to Views flowers and related action
Route::resource('flowers', 'FlowersController')->middleware('admin');
Route::post('flowers/search', 'FlowersController@search')->middleware('admin');
