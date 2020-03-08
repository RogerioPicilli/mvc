@extends('property.master') @section('content')

<div class="container my-3">
    <h1>Listagem de Produtos</h1>
    <?php 
        $property = $property[0];
    ?>
    <form action="<?= url('/imoveis/update', ['id' => $property->id]); ?>" method="POST">

        <?= csrf_field();  ?>
        <?= method_field('PUT');  ?>
        <div class="form-group">
            <label for="title">Título do imóvel</label>
            <input type="text" name="title" id="title" value="<?= $property->title; ?>" class="form-control">
        </div>
        <div class="form-group">
            <label for="descricao">Descrição</label>
            <textarea name="description" class="form-control" id="descricao" cols="30" rows="10"><?= $property->description; ?></textarea>
        </div>
        <div class="form-group">
            <label for="rental_price">Valor da locação</label>
            <input type="text" name="rental_price" id="rental_price" value="<?= $property->rental_price; ?>" class="form-control">
        </div>
        <div class="form-group">
            <label for="sale_price">Valor de venda</label>
            <input type="text" name="sale_price" id="sale_price" value="<?= $property->sale_price; ?>" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Atualizar Imóvel</button>

    </form>
</div>
@endsection