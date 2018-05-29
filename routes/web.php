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

Auth::routes();

Route::get('/', function () {
    return redirect('shared');
});

Route::get('shared', 'DataController@getDataWithShared1');
Route::get('unshared', 'DataController@getDataWithShared0');
Route::get('owned', 'DataController@getDataWithCreator1');
Route::get('unowned', 'DataController@getDataWithCreator0');
Route::get('duplicates', 'DataController@findDuplicatedFileNames');
Route::post('search', 'DataController@findByDate');