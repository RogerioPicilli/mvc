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

Route::view('/form', 'form');

/**
 * Route::verbo_http('URI', 'Controler@metodo')
 * 
 * Passo a passo: Definir rota -> Criar o Controlador -> Criar Método -> Camada View
 * 
Route::get($uri, $callback);
Route::post($uri, $callback);
Route::put($uri, $callback);
Route::patch($uri, $callback);
Route::delete($uri, $callback);
Route::options($uri, $callback);
 */

 Route::get('users/1', 'UserController@index');
 Route::get('getData', 'UserController@getData');
 Route::post('postData', 'UserController@postData');

 Route::put('users/1', 'UserController@testPut');
 Route::patch('users/1', 'UserController@testPatch');

 Route::match(['put', 'patch'],'users/2','UserController@testMatch');
 