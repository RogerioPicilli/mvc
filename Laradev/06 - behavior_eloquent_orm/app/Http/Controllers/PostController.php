<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function forceDelete($post) 
    {
        Post::onlyTrashed()->where(['id' => $post])->forceDelete();
        return redirect()->route('posts.trashed');
    }
    public function restore($post) 
    {
        //traz para a vida algo que foi softdeleted
        $post = Post::onlyTrashed()->where(['id' => $post])->first();
        if($post->trashed()){
            $post->restore();
        }

        return redirect()->route('posts.trashed');
    }

    public function trashed() 
    {
        $posts = Post::onlyTrashed()->get();

        return view('posts.trashed', ['posts' => $posts]);
    }

    public function index()
    {
        // echo "<h3>Lista dos Posts</h3>";

        // $posts = Post::where('created_at', '>=', date('Y-m-d H:i:s'))
        //                     ->take(2)->orderBy('title','desc')->get();
        // foreach($posts as $post){
        //     echo "<h1>{$post->title}</h1>";
        //     echo "<h2>{$post->subtitle}</h2>";
        //     echo "<p>{$post->description}</>";
        //     echo "<hr>";
        // }

        // $post = Post::where('created_at', '>=', date('Y-m-d H:i:s'))->first();
        // $post = Post::where('created_at', '>=', date('2022-m-d H:i:s'))->firstOrFail();
        // echo "<h1>{$post->title}</h1>";
        // echo "<h2>{$post->subtitle}</h2>";
        // echo "<p>{$post->description}</>";
        // echo "<hr>";

        // $post = Post::find(1);
        // $post = Post::findOrFail(31);
       
        // echo "<h1>{$post->title}</h1>";
        // echo "<h2>{$post->subtitle}</h2>";
        // echo "<p>{$post->description}</>";
        // echo "<hr>";

        // $posts = Post::where('created_at', '>=', date('Y-m-d H:i:s'))->exists();
        // $posts = Post::where('created_at', '>=', date('Y-m-d H:i:s'))->count();
        // $posts = Post::where('created_at', '>=', date('Y-m-d H:i:s'))->max('title');
        // var_dump($posts);

        // $posts = Post::all();
        // foreach($posts as $post){
        //     echo "<h1>{$post->title}</h1>";
        //     echo "<h2>{$post->subtitle}</h2>";
        //     echo "<p>{$post->description}</>";
        //     echo "<hr>";
        // }

        $posts = Post::all();
        return view('posts.index', ['posts' => $posts]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        //Formato Primeiro
        // Object -> Prop -> Save
        $post = new Post;
        $post->title = $request->title;
        $post->subtitle = $request->subtitle;
        $post->description = $request->description;
        $post->save();

        //Formato Segundo - mass assingment precisa configurar o Model com o parametro fillable
        // Post::create([
        //     'title' => $request->title,
        //     'subtitle' => $request->subtitle,
        //     'description' => $request->description
        // ]);

        //Formato Terceiro - Verifica se o primeiro parametro title já existe na tabela. Existindo não faz nada caso contrário cria com os dados do segundo []
        //O primeiro parametro pode conter mais do que um campo basta separar por virgula.
        // $post = Post::firstOrNew([
        //         'title' => $request->title],
        //         [
        //         'subtitle' => $request->subtitle,
        //         'description' => $request->description
        //         ]);
        // $post->save();

        //Formato Quarto - Idem ao terceiro mas não precisa do save pois se não houver no db a chave ele já cria
        // $post = Post::firstOrCreate([
        //     'title' => $request->title],
        //     [
        //     'subtitle' => $request->subtitle,
        //     'description' => $request->description
        //     ]);

        return redirect()->route('posts.index');

    }

    public function show(Post $post)
    {
        //
    }

    public function edit(Post $post)
    {
        return view('posts.edit', ['post' => $post] );
    }

    public function update(Request $request, Post $post)
    {
        //Primeiro formato usando o objeto $post enviado
        // $post->title = $request->title;
        // $post->subtitle = $request->subtitle;
        // $post->description = $request->description;
        // $post->save();

        //Segundo formato pegando pelo id
        $mpost = Post::findOrFail($post->id);
        $mpost->title = $request->title;
        $mpost->subtitle = $request->subtitle;
        $mpost->description = $request->description;
        $mpost->save();

        //Terceiro formato - Uma bosta pois inclui mesmo que no update !!!!!!!
        // $mpost = Post::updateOrCreate([
        //         'title' => $request->title
        //     ],[
        //         'subtitle' => $request->subtitle,
        //         'description' => $request->description
        // ]);

        //Quarto - Atualização de vários registros
        // Post::where('created_at', '>=', date('Y-m-d H:i:s'))->update([
        //     'description' => 'Teste'
        // ]);

        return redirect()->route('posts.index');


    }

    public function destroy(Post $post)
    {
        // dd($post);
        // Post::destroy([2,3]); //Deleta os  registro id 2 e 3
        Post::destroy($post->id);
        // Post::where('created_at', '>=', date('Y-m-d H:i:s'))->delete();
        // Post::find($post->id)->delete();
        return redirect()->route('posts.index');
    }
}
