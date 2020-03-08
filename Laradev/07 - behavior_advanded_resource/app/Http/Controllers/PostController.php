<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
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
        $post = Post::find($id);

        echo "<h1>Artigo</h1><br>";
        echo "Título   :<b> {$post->title} </b><br>";
        echo "Subtítulo:<b> {$post->subtitle}</b><br>";
        echo "Conteudo :<b> {$post->description}</br>";
        echo "Quando :<b> {$post->createdBr}</b><hr>";

        //TEste to set
        // $post->title = 'Título de teste do meu artigo notório!';
        // $post->save(); 


        $author = $post->author()->first();
        echo "<h3>Escrito por: <b>{$author->name}</b></h3><hr>";

        $postCategories = $post->categories()->get();
        if ($postCategories) {
            echo "<h1>Categorias</h1><br>";
            foreach ($postCategories as $category) {
                echo "#{$category->id} Categoria: $category->name<br>";
            }
        }

        // Adicionando uma categoria (ou mais) a um post
        // $post->categories()->attach(1);
        // $post->categories()->attach([2,3]);

        // Removenod uma categoria (ou mais) a um post
        // $post->categories()->detach(1);

        // O comando sync insere as explicitadas e remove todas as outras se houverem
        // $post->categories()->sync([1,2,3]);

        // O comando sync insere as explicitadas e NÃO remove as outras se houverem
        // $post->categories()->syncWithoutDetaching([1,2,9,7]);

        // Criando um comentário a partir do Post
        // $post->comments()->create([
        //     'content' => 'Este foi colocado just now comentário'
        // ]);

        // Lendo comentário a partir do Post
        $comments = $post->comments()->get();
        if($comments){
            echo "<h1>Comentário do Post</h1><br>";
            foreach($comments as $comment){
                echo "#{$comment->id} $comment->content<br>";
            }
        }

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
