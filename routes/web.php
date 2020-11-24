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
    Route::get('/info','BookController@index');
    Route::post('/books', 'BookController@store');
    Route::put('/books', 'BookController@update');
    Route::delete('/books/{book}', 'BookController@destroy');
    //Loan routes
    Route::post('/loan', 'LoanController@index');
    Route::post('/loan', 'LoanController@store');
    Route::put('/loan', 'LoanController@update');
    Route::get('/data','LoanController@data');
    Route::delete('/loan/{loan}', 'LoanController@destroy');
    //Categories routes
    Route::get('/categories', 'CategoryController@index'); 
    Route::post('/categories','CategoryController@store');
    Route::put('/categories','CategoryController@update');
    Route::delete('/categories/{category}','CategoryController@destroy');
    //Register admins
    Route::post('createAdmin','UserController@store');

});