<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Address;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        echo "<h1>Dados do Usuário</h1><br>";
        echo "Nome do usuário : {$user->name}<br>";
        echo "Email do usuário: {$user->email}<hr>";

        echo "<h1>Endereço de Entrega</h1><br>";
        echo "Endereço   : {$user->address->address}, Nº {$user->address->number} <br>";
        echo "Complemento: {$user->address->complement}, Cep: {$user->address->zipcode}<br>";
        echo "Cidade     : {$user->address->city}, Estado: {$user->address->state}<br>";
        
        // Os dois formatos a seguir criam um novo endereço não atualizam o existente

        // $address = new Address([
        //         'address' => 'Rua dos Lobos', 
        //         'number' => '109', 
        //         'complement' => 'Apto 123', 
        //         'zipcode' => '03227-090', 
        //         'city' => 'São Paulo', 
        //         'state' => 'SP'
        //     ]);
        // $user->address()->save($address);

        // $address = new Address();
        // $address->address = 'Rua dos Lobos';
        // $address->number = '109';
        // $address->complement = 'Apto 123';
        // $address->zipcode = '03227-090';
        // $address->city = 'São Paulo';
        // $address->state = 'SP';

        // $user->address()->save($address);

        // $address1 = new Address([
        //         'address' => 'Rua dos Lobos', 
        //         'number' => '1039', 
        //         'complement' => 'Apto 123', 
        //         'zipcode' => '03227-090', 
        //         'city' => 'São Paulo', 
        //         'state' => 'SP'
        //     ]);
        
        // $address2 = new Address();
        // $address2->address = 'Rua dos Lobos 2';
        // $address2->number = '4109';
        // $address2->complement = 'Apto 333';
        // $address2->zipcode = '03227-090';
        // $address2->city = 'São Paulo';
        // $address2->state = 'SP';

        // $user->address()->saveMany([$address1, $address2]);

        // $user->address()->create([
        //         'address' => 'Rua dos Lobos 555',
        //         'number' => '10390',
        //         'complement' => 'Apto 555',
        //         'zipcode' => '03227-090',
        //         'city' => 'São Paulo',
        //         'state' => 'SP'
        // ]);

    //     $user->address()->createMany([[
    //         'address' => 'Rua dos Lobos 777',
    //         'number' => '190',
    //         'complement' => 'Apto 777',
    //         'zipcode' => '03227-090',
    //         'city' => 'São Paulo',
    //         'state' => 'SP'
    //     ],[
    //         'address' => 'Rua dos Lobos 999',
    //         'number' => '10541',
    //         'complement' => 'Apto 999',
    //         'zipcode' => '03227-090',
    //         'city' => 'São Paulo',
    //         'state' => 'SP'
    // ]]);

    //Os relacionamentos só são carregados quando pedidos asdf->asdf->. Se quiser carregar direto pode fazer como segue. CUIDADO
    //ISTO CAUSA UM PUTA USO DO BANCO DE DADOS.

    // $users = User::with('address')->get();
    // dd($users);

        $posts = $user->posts()->get();
        if ($posts) {
            echo "<h1>Artigos</h1><br>";
            foreach ($posts as $post) {
                echo "Título   :<b> {$post->title} </b><br>";
                echo "Subtítulo:<b> {$post->subtitle}</b><br>";
                echo "Conteudo :<b> {$post->description}</b><hr>";
            }
        }

        // $comments = $user->commentsOnMyPost()->get();
        // if ($comments) {
        //     echo "<h1>Comentários nos meus artigos</h1><br>";
        //     foreach ($comments as $comment) {
        //         $usuarioNome = User::find($comment->user)->name;
        //         echo "<b>O usuário $usuarioNome fez o comentário: {$comment->content}</b><hr>";
        //     }
        // }

        // Criando um comentário a partir do Usuario
        // $user->comments()->create([
        //     'content' => 'Este foi colocado from User Controller e uma terceira vez'
        // ]);

        // Lendo comentário a partir do Post
        $comments = $user->comments()->get();
        if($comments){
            echo "<h1>Comentário do Post From User</h1><br>";
            foreach($comments as $comment){
                echo "#{$comment->id} $comment->content<br>";
            }
        }


        $usuarios = User::usuarios()->get();
        if($usuarios){
            echo "<h1>Usuários do Sistema</h1><br>";
            foreach($usuarios as $usuario){
                echo "Nome do usuário : {$usuario->name}<br>";
                echo "Email do usuário: {$usuario->email}<hr>";
            }
        }

        $admins = User::admins()->get();
        if($admins){
            echo "<h1>Admins do Sistema</h1><br>";
            foreach($admins as $admin){
                echo "Nome do usuário : {$admin->name}<br>";
                echo "Email do usuário: {$admin->email}<hr>";
            }
        }

        // Teste da serialização

        $users = User::all();
        var_dump($users->toArray());
        var_dump($users->toJson(JSON_PRETTY_PRINT));
        var_dump($users->makeVisible('created_at')->toJson(JSON_PRETTY_PRINT));








    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
