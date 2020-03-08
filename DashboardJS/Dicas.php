
// A pagina basica
extends('layout')
@section('content')
   <div id="wrapper">
   	   <div id="page" class="container">
   	      <h1>New Article</div>
   	      	<form method="POST" action="/articles">
   	      		@csrf
   	      		<input type="text" name="title">
   	      		<input type="button">Salvar</input>
   	      		
   	      	</form>
   	   </div>
   </div>
@endsection

Lá no route temos
Route::get('articles', 'ArticlesController@index');
Route::post('articles', 'ArticlesController@store');
Route::get('articles/create', 'ArticlesController@create');
Route::get('articles/{article}/edit', 'ArticlesController@edit');
Route::put('articles/{article}', 'ArticlesController@update');


Form Handdling


O erro 419 Page Expired provavelmente foi esquecido o @csrf no post
return view('articles.create') => Carrega a view que esta no diretório articles under views

-----------------------------------------
Criar o artigo - 2 metodos Show e Store
-----------------------------------------
No Controller store
Pra ver o que chega no controller
dump(request()->all());
/****************************************
$article = new Article();
$article->title = request('title');
$article->subtitle = request('subtitle');
$article->body = request('body');
$article->save();
return redirect('/articles');
/****************************************
Um jeito mais clean de fazer o mesmo acima

Procurar por Laravel Validation Component
/****************************************
//Qq erro que aconteca no validade volta pra pagina com a variavel error populada
//Na pagina embaixo do <input pode colocar <p class="help">{{ $error->first('title')}}</p>
OU
//Na pagina embaixo do <input pode colocar 
@error('title')
     <p class="help">{{ $error->first('title')}}</p>
@enderror
//Se quiser mudar a cor do textbox
<input class="input @error('title') is-danger @enderror" type="text" name="title" required value={{ $article->title}}>

//Pra manter o valor já digitado quando dá erro em outro text box usar o old
<input class="input @error('title') is-danger @enderror" 
       type="text" 
       name="title" 
       required value={{ old($article->title)}}> OU required value={{ old('title')}}> na inclusao

request()->validate([
	'title'> ['required', 'min:3', 'max:20'], 
	'subtitle' => 'required',
	'body' => 'required',
]);

$article = new Article();
$article->title = request('title');
$article->subtitle = request('subtitle');
$article->body = request('body');
$article->save();
return redirect('/articles');




--------------------------------------------------------------------------------------------
Edit
return view('articles.edit') => Carrega a view que esta no diretório articles under views
extends('layout')
@section('content')
   <div id="wrapper">
   	   <div id="page" class="container">
   	      <h1>New Article</div>
   	      	<form method="POST" action="/articles/{{ $article->id }}">
   	      		@csrf
   	      		@method('PUT') DELETE 
   	      		<input type="text" 
   	      		       name="title" 
   	      		       required value={{ $article->title}} >
   	      		<input type="button">Salvar</input>
   	      		
   	      	</form>
   	   </div>
   </div>
@endsection

No Controller
public function edit($id)
   $article = Article::find($id);
   return view('articles.edit', ['article' => $article]);
   OU
   return view('articles.edit', compact('article');

public function update($id)
   $article = Article::find($id);

	$article->title = request('title');
	$article->subtitle = request('subtitle');
	$article->body = request('body');
	$article->save();
	return redirect('/articles/' . $article->id);
--------------------------------------------------------------------------------------------
Tecnicas de Controller
<?php 

public function show($id)
{
	$article = Article::findOrFail($id);

	return view('articles.show', ['article' => $article]);

}

public function store()

	request()->validate([
		'title' => required,
		'subtitle' => required,
		'body' => required
	]);

	$article = new Article();
	$article->'title' = request('title');
	$article->'subtitle' = request('subtitle');
	$article->'body' = request('body');
	$article->save();

	return redirect('/articles')
}

MELHORADA
public function store()

	request()->validate([
		'title' => required,
		'subtitle' => required,
		'body' => required
	]);

	Article::create([
		'title' => request('title'),
		'subtitle' => request('subtitle'),
		'body' => request('body')
	]);

	return redirect('/articles')
}

AINDA MELHORADA
public function store()

	$validatedAttributes = request()->validate([
							'title' => required,
							'subtitle' => required,
							'body' => required
	]);

	Article::create($validatedAttributes);

	return redirect('/articles')
}

E COM O REFACTORING INLINE OBTER A PERFIETA
AINDA MELHORADA
public function store()

	Article::create(request()->validate([
							'title' => required,
							'subtitle' => required,
							'body' => required
	]));

	return redirect('/articles')
}
------------------------------------------------------------------------------
MESMO PROCESSO COM A FUNCAO update

public function update(Article $article)
{
	request()->validate([
		'title' => required,
		'subtitle' => required,
		'body' => required
	]);

	$article->'title' = request('title');
	$article->'subtitle' = request('subtitle');
	$article->'body' = request('body');
	$article->save();

	return redirect('/articles')
}

VIRARÁ DEPOIS DE TODOS AS MELHORIAS

public function update(Article $article)
{
	Article::update(request()->validate([
		'title' => required,
		'subtitle' => required,
		'body' => required
	]));
}
----------------------------------------------------------------------------

USANDO O FACTORY 

php artisan tinker
>>>factory(App\Usuarios::class)->create());





 

 ?>
