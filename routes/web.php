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


Route::group(['middleware' => ['auth']], function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('index');

    Route::get('/home', function () {
        return view('welcome');
    })->name('home');

    Route::get('teste2', function (){
       return view('emails.cartaoServidor');
    });

    //Image
    Route::get('imagem', 'ImageController@imagem')->name('imagem');
    Route::post('imagem/store', 'ImageController@store')->name('image.store');
    Route::get('imagem/apagar', 'ImageController@destroy')->name('image.destroy');
    Route::get('imagem/editar/{id}', 'ImageController@edit')->name('image.edit');
    Route::get('imagem/update', 'ImageController@update')->name('image.update');
    Route::get('imagem/baixar/{id}', 'ImageController@baixar')->name('image.baixar');
    Route::post('imagem/baixarImagem', 'ImageController@baixarImagem')->name('image.baixarImagem');
    Route::get('teste', 'ImageController@envioAutomaticoCartao')->name('teste');

//Servidores
    Route::get('/servidor/index', 'ServidorController@index')->name('servidor.index');
    Route::get('/servidor/create', 'ServidorController@create')->name('servidor.create');
    Route::post('/servidor/store', 'ServidorController@store')->name('servidor.store');
    Route::get('servidor/{id}/edit', 'ServidorController@edit')->name('servidor.edit');
    Route::post('servidor/update/{id}', 'ServidorController@update')->name('servidor.update');
    Route::get('servidor/destroy/{id}', 'ServidorController@destroy')->name('servidor.destroy');
    Route::post('servidor/enviarCartao', 'ServidorController@enviarEmail')->name('servidor.enviarEmail');

//Clipping
    Route::get('clipping/create', 'ClippingController@create')->name('clipping.create');
    Route::post('clipping/gerar', 'ClippingController@gerar')->name('clipping.gerar');
    Route::post('clipping/enviarEmail', 'ClippingController@gerarEmail')->name('clipping.enviarEmail');

//Cartao
    Route::post('cartao/create', 'CartaoController@criar')->name('cartao.criar');
    Route::post('cartao/atualizar', 'CartaoController@atualizar')->name('cartao.atualizar');

});


Auth::routes();
