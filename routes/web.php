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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get(	'/home', 	'HomeController@index')->name('home');
Route::post('imagem/store', 		'ImageController@store'			)->name('image.store');
Route::post('imagem/apagar', 		'ImageController@destroy'		)->name('image.destroy');
Route::get(	'imagem/editar/{id}', 	'ImageController@edit'			)->name('image.edit');
Route::post('imagem/update', 	'ImageController@update'			)->name('image.update');
Route::get('imagem/baixar/{id}', 	'ImageController@baixar'		)->name('image.baixar');
Route::post('imagem/baixarImagem', 	'ImageController@baixarImagem'	)->name('image.baixarImagem');
