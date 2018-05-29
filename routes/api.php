<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


	// "start_date" : "2018-01-01",
	// "end_date" : "2018-05-29"
// Route::post('search/date', 'DataController@findByDate');

// routes to test
// Route::get('search/date', 'DataController@getDataWithShared1');
// Route::get('search/date', 'DataController@getDataWithShared0');
// Route::get('search/date', 'DataController@getDataWithCreator1');
// Route::get('search/date', 'DataController@getDataWithCreator0');
// Route::get('search/date', 'DataController@findDuplicatedFileNames');
