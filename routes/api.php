<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

/**
 * GET BLOG POSTS
 */
Route::namespace('Api')->group(function() {
    // Get posts
    Route::get('/posts', 'PostController@index');

    // Get post detail
    Route::get('posts/{slug}', 'PostController@show');

    // Contact form
    Route::post('/contacts', 'ContactController@store');
});