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
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::group(['middleware' => 'auth'], function () {
    //Book routes
    Route::get('/books','BookController@index')->name('books');
    Route::post('/books', 'BookController@store');
    Route::put('/books', 'BookController@update');
    Route::delete('/books/{book}', 'BookController@destroy');
    //Loan routes
    Route::get('/loan','LoanController@index')->name('loans');
    Route::put('/loan', 'LoanController@update');
    Route::get('/data','LoanController@data');
    Route::delete('/loan/{loan}', 'LoanController@destroy');
    //Categories routes
    Route::get('/categories', 'CategoryController@index')->name('categories');
    Route::post('/categories','CategoryController@store');
    Route::put('/categories','CategoryController@update');
    Route::delete('/categories/{category}','CategoryController@destroy');
    //User routes
    Route::get('/users','UserController@index')->name('users');
    Route::post('/users','UserController@store');

});