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

/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/', 'MainController@index');
Route::post('/create', 'MainController@create');
Route::get('/edit/{id}', 'MainController@edit');
Route::post('/save/{data}', 'MainController@save');
Route::post('/destroy/{id}', 'MainController@destroy');



