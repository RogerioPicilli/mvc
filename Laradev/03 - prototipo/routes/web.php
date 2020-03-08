<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('/imoveis', 'PropertyController@index');

Route::get('/imoveis/novo', 'PropertyController@create');
Route::post('/imoveis/store', 'PropertyController@store');
Route::get('/imoveis/{uri}', 'PropertyController@show');

Route::get('/imoveis/editar/{uri}', 'PropertyController@edit');
Route::put('/imoveis/update/{uri}', 'PropertyController@update');
Route::get('/imoveis/remover/{uri}', 'PropertyController@destroy');

Route::get('/url', 'UrlController@index');
