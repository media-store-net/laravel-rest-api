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

Route::middleware( 'auth:api' )->get( '/user', function ( Request $request ) {
	return $request->user();
} );

// User Api Routes
Route::get( '/v1/users', 'UserController@index' );
Route::post( '/v1/users', 'UserController@store' );

Route::get( '/v1/users/{id}', 'UserController@show' );
Route::post( '/v1/users/{id}', 'UserController@update' );
Route::delete( 'v1/users/{id}', 'UserController@destroy' );

// Software Api Routes
Route::get( '/v1/software', 'SoftwareController@index' );
Route::post( 'v1/software', 'SoftwareController@store' );

Route::get( '/v1/software/{id}', 'SoftwareController@show' );
Route::post( '/v1/software/{id}', 'SoftwareController@update' );
Route::delete( '/v1/software/{id}', 'SoftwareController@destroy' );
