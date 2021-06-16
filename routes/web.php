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

// BACKEND
// Routes for authentication
Auth::routes();

Route::prefix('admin')
    ->namespace('Admin')
    ->middleware('auth')
    ->name('admin.')
    ->group(function () {
        // Route for home
        Route::get('/', 'HomeController@index')->name('home');

        // Route fore CRUD
        Route::resource('/posts', 'PostController');
    });

// FRONTEND
Route::get('{any?}', function () {
    return view('guest.home');
})->where('any', '.*');