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
use App\User;

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/getdesa/{id}', 'KelompokController@getdesa');
Route::get('/getkelompok/{id}', 'PeoppleController@getkelompok');
Route::get('/getkelas/{id}', 'KelasController@getkelas');
Route::resource('daerah','DaerahController');
Route::get('/daerah/create', function () {
    return view('/daerah.create');
});
Route::resource('desa','DesaController');
Route::resource('absensi','AbsensiController');
Route::get('/desa/create', function () {
    return view('/desa.create');
});
Route::resource('kelompok','KelompokController');
Route::resource('peopple','PeoppleController')->only(['index','create','show', 'store', 'edit', 'update', 'destroy','addguru']);
Route::get('/people/created', function () {
    return view('create');
});
Route::get('/peopple/addguru/{id}', 'PeoppleController@addguru');
Route::resource('users','UserController');
Route::get('/users/create', function () {
    return view('/users.create');
});
// Route::get ( '/peopple/{id}/addguru', function () {
//     return view ( '/peopple.addguru' );
// } );
Route::get ( '/datatable', function () {
    return view ( '/coba.index' );
} );
Route::resource('kelas','KelasController');
Route::get('absensi/{id}','AbsensiController@show');
Route::get('/kelas/create', function () {
    return view('/kelas.create');
});
Route::resource('event','EventController')->only(['index','create','show', 'store', 'edit', 'update', 'destroy','rekap']);
Route::get('/event/create', function () {
    return view('/event.create');
});