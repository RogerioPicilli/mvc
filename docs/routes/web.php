<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('/teste', function () {
    return view('teste');
});

Route::get('/roger', function () {
    return "Olá Rogério Picilli...";
});

Route::get('/roger/{variavel}', function ($variavel) {
    return $variavel;
});

// Route::get('/roger2/{variavel}', function ($variavel) {
//     $variaveis = [
//         'primeiro' => "Olá, este é o meu primeiro post",
//         'segundo' => "Olá, este é o meu segundo post"
//     ];

//     //Uma forma de tratar quando o post não existe
//     //return view('post', ['post' => $variaveis[$variavel] ?? 'Ainda não disponível! Aguarde...']);

//     //Outra forma mais sofisticada
//     if (!array_key_exists($variavel, $variaveis)){
//         abort(404, 'Desculpe, este post não existe!');
//     }

//     return view('post', [
//         'post' => $variaveis[$variavel]
//     ]);
// });

//Reescrevendo o Route acima usando controlador
Route::get('roger3/{variavel}', 'postController@show');

