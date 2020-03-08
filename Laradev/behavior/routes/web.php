<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Jobs\emailWelcome;
use Illuminate\Support\Facades\Storage;
use App\Http\Middleware\checkParam;

Route::get('/', function () {
    $user = new stdClass();
    $user->name='Rogério Picilli';
    $user->email='rogerio@docs.com.br';

    $courses = [
        [
            "id" => 1,
            "name" => "Laravel Developer",
            'tutor' => "Rogerio Picilli"
        ],
        [
            "id" => 2,
            "name" => "Bootstrap Builder",
            'tutor' => "Rogerio Picilli"
        ],
        [
            "id" => 3,
            "name" => "FaullStack PHP Developper",
            'tutor' => "Wilma Picilli"
        ]
    ];

    return view('front.home', [
        'user' => $user,
        'courses' => $courses,
    ]);
});

// Route::get('/log', function () {
//     //Lançamento de Log para ocana padrão
//     // Log::info('Teste');

//     //Lançamento de Log para um cana específico
//     // Log::channel('slack')->info('Teste');

//     //Lançamento de Log para vários canais simultaneamente
//     Log::stack(['slack', 'daily'])->error('Teste');

// });

// Route::get('/session', function () {

//     session([
//         'usuario' => 'Rogério Picilli',
//         'course' => 'LaraDev'
//     ]);

//     session()->put('Sobrenome', 'Rambo');

//     echo session('usuario') . '<br>';
//     echo session('estudante', 'Não informado') . "<br>";
//     echo session('Usuario', function () {
//         if (!session('estudante')) {
//             session()->put('estudante', 'Maria das Dores');
//         }
//     });

//     echo session()->get('estudante');

//     echo session()->get('curso', 'Não informado'); //Não dá erro se não existir

//     session()->push('time', 'Rogerio'); //Vai colocando cada conteudo informado em uma array
//     session()->push('time', 'Wilma');

//     $profissao = session()->pull('estudante');  //Remove a key e retorna o conteúdo
//     echo $profissao . '<hr>';

//     session()->forget('course');  //excluir sem retorna nada

//     // session()->flush(); //Deleta tudo da session

//     //Se usuário não existir ou for nulo
//     if (session()->has('usuario')) {
//         echo "A chave session->usuario existe" . "<hr>";
//     };
//     //Mesmo com nulo no conteúdo se a chave existir volta true
//     if (session()->exists('usuario')) {
//         echo "A chave session->usuario existe" . "<hr>";
//     };

//     //Usado para mostrar uma mensagem para o usuário ela só existe até o carragamento da página target
//     session()->flash('Message', 'Produto cadastrado com sucesso');
//     session()->reflash(); //é mantida até o final do processo quando é mostrada para o usuário. Qdoo passa por ++ 1 controlador


//     var_dump(session()->all());

// });

// Route::get('/email', function () {
//     // return new \App\Mail\welcomeLaradev();
//     //As variaveis abaixo poderiam estar armazenadas em um DB
//     $user = new stdClass();
//     $user->name = 'Wilma A. R. Picilli';
//     $user->email = 'rogerio@sospdf.com';

//     $order = new stdClass();
//     $order->type = 'Boleto';
//     $order->vencimento = '2020-03-22';
//     $order->value = 777;

//     // var_dump($user, $order);
//     // Mail::to('rogerio@sospdf.com')->send(new \App\Mail\welcomeLaradev());

//     // return new \App\Mail\welcomeLaradev($user, $order);

//     Mail::send(new \App\Mail\welcomeLaradev($user, $order));

// });

// //envio assincrono usando banco de dados. Notar que mudou o Mail::send para Mail::queue
// Route::get('/email-queue', function () {
//     // return new \App\Mail\welcomeLaradev();
//     //As variaveis abaixo poderiam estar armazenadas em um DB
//     $user = new stdClass();
//     $user->name = 'Wilma A. R. Picilli';
//     $user->email = 'rogerio@sospdf.com';

//     $order = new stdClass();
//     $order->type = 'Boleto';
//     $order->vencimento = '2020-03-22';
//     $order->value = 777;

//     // var_dump($user, $order);
//     // Mail::to('rogerio@sospdf.com')->send(new \App\Mail\welcomeLaradev());

//     // return new \App\Mail\welcomeLaradev($user, $order);

//     // Mail::queue(new \App\Mail\welcomeLaradev($user, $order));

//     emailWelcome::dispatch($user, $order)->delay(now()->addSeconds(15));

// });

// Route::get('/files', function () {
//     $files = Storage::files(''); //Não informado nada pega o rais que é storage\app
//     $allFiles = Storage::allFiles(''); //Não informado nada pega o rais que é storage\app
//     $directories = Storage::directories('');
//     $allDirectories = Storage::allDirectories('');
    
//     // Storage::makeDirectory('public/rogerio');
//     // Storage::makeDirectory('public/picilli');
//     // Storage::deleteDirectory('public/picilli');
//     // storage::disk('public')->put('Meu Arquivo.txt', 'O melhor arquivo!');
//     // echo storage::disk('public')->get('Meu Arquivo.txt');
   
//     // var_dump($files, $allFiles, $directories, $allDirectories);

//     // return Storage::disk('public')->download('Meu Arquivo.txt');

//     // if(Storage::disk('public')->exists('Meu Arquivo1.txt')) {
//     //     return Storage::disk('public')->download('Meu Arquivo.txt');
//     // } else {
//     //     echo "Arquivo não encontrado";   
//     // };

//     // echo "O tamanho do arquivo é => " . $size = Storage::disk('public')->size('Meu Arquivo.txt') . "<br>";
//     // echo "A última modificação   => " . $size = Storage::disk('public')->lastModified('Meu Arquivo.txt') . "<br>";

//     // Storage::disk('public')->prepend('Meu Arquivo.txt', 'São Paulo, 08 de março de 2.020');

//     // Storage::disk('public')->append('Meu Arquivo.txt', 'Este arquivo foi apendado pelo Storage');

//     // Storage::copy('public\Meu Arquivo.txt','Meu Arquivo.txt');
//     // Storage::move('public\Meu Arquivo.txt','Meu Arquivo.txt');
//     Storage::delete('public\Meu Arquivo.txt');
    

// });

// Route::resource('/imoveis', 'PropertyController');

// //Pode usar com o nome da classe e não esquecer to use lá emcima
// // Route::get('teste-middleware', 'PropertyController@middle')->middleware(checkParam::class);
// // ou usar o apelido que demos no arquivo Kernel, lembra?

// //CHAMADA SEM PARAMETRO 
// // Route::get('teste-middleware', 'PropertyController@middle')->middleware('testemiddlewarepic');

// //CHAMADA COM PARAMETRO
// Route::get('teste-middleware', 'PropertyController@middle')->middleware('testemiddlewarepic:admin, interno');

Route::get('/curso', function(){
    return view('front.course');
});