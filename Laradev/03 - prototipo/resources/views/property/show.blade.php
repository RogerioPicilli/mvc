@extends('property.master')

@section('content')

<div class="container my-3">

<h1>Listagem de Produtos</h1>

<h1>Página Single</h1>

<?php
    if(!empty($property)){
        foreach($property as $item){
            ?>
            <h2>Título do Imóvel: <?= $item->title; ?></h2>

            <p>Descrição: <?= $item->description; ?></p>
            <p>Valor de locação: <?= $item->rental_price; ?></p>
            <p>Valor de Venda: <?= $item->sale_price; ?></p>

            <?php
        }
    }
?>

</div>

@endsection