<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Post;

class postController extends Controller
{
    public function show($post) {

        //$post = \DB::table('posts')->where('slug', $post)->first();
        //depois de criar o Model Post o uso é da seguinte forma

        // $post = Post::where('slug', $post)->first();

        // if (! $post) {
        //     abort(404);
        // }

        //Já faz o abort automaticamente
        $post = Post::where('slug', $post)->firstOrFail();

        // $variaveis = [
        //     'primeiro' => "Olá, este é o meu primeiro post",
        //     'segundo' => "Olá, este é o meu segundo post"
        // ];
          
        // if (!array_key_exists([$post, $variaveis])){
        //     abort(404, 'Desculpe, este post não existe!');
        // }
    
        return view('post', ['post' => $post]);
        }
}
