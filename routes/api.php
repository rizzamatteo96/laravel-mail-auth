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

// Il file JSON che crea questa route è visibile qui: 'http://127.0.0.1:8000/api/posts'
Route::get('/posts', 'Api\PostController@index');
Route::get('/posts/{slug}', 'Api\PostController@show');
