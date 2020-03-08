@extends('front\master\master-with-sidebar')

@section('title','Outro título')

@section('css')
    <style>
        .teste {
            color: red;
        }
    </style>
@endsection

@section('js')
    <script>
        alert('Se precisar de um javascript em uma página determinada');
    </script>
@endsection

@section('sidebar')
    @parent
    <h3>[PAGE]Lista de Artigos</h3>
    <ul class="li">Lorem ipsum dolor sit amet.</ul>
    <ul class="li">Nam commodi quam veniam fuga?</ul>
    <ul class="li">Eum optio voluptatem unde eius.</ul>
@endsection

@section('content')

<h1 class="teste">Conteúdo</h1>

@endsection