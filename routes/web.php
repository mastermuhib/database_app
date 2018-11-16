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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/getdesa/{id}', 'KelompokController@getdesa');
Route::resource('daerah','DaerahController');
Route::get('/daerah/create', function () {
    return view('/daerah.create');
});
Route::resource('desa','DesaController');
Route::get('/desa/create', function () {
    return view('/desa.create');
});
Route::resource('kelompok','KelompokController');
Route::resource('people','PeopleController');
Route::get('/people/create', function () {
    return view('/people.create');
});
