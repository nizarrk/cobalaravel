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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/add', 'CRUDController@create');
Route::post('/add', 'CRUDController@store');

Route::get('/edit/{nama}/{email}/{tgl}/{telp}/{jk}/{foto}/{file}', 'CRUDController@edit');
Route::post('/edit', 'CRUDController@update');

Route::get('/delete/{foto}/{file}', 'CRUDController@destroy');