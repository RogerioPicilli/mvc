<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulário</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>

<div class="container my-5">
    <section class="articles_list">
        <a href="{{ route('posts.create') }}" class="btn btn-success mb-5">Cadastrar novo artigo</a>
        <a href="{{ route('posts.index') }}" class="btn btn-success mb-5">Ver Todos</a>
        
        @foreach($posts as $post)
        <article class="mb-5">
            <h1>{{ $post->title }}</h1>
            <h2>{{ $post->subtitle }}</h2>s
            <p>{{ $post->description }}</p>
            <small>Criado em: {{ date('d/m/Y', strtotime($post->created_at)) }} - Editado em: {{ date('d/m/Y H:i', strtotime($post->updated_at)) }}</small>
            <form action="{{ route('posts.forceDelete', ['post' => $post->id ]) }}" method="POST">
                @csrf
                @method('DELETE')
                <a href="{{ route('posts.restore', ['post' => $post->id ]) }}" class="btn btn-primary">Restaurar</a>&nbsp;|
                <button class="btn btn-danger">Excluir</button>
            </form>
        </article>
        <hr>
        @endforeach
    </section>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>