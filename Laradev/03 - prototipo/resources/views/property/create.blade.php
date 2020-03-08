@extends('property.master') @section('content')
<div class="container my-3">

    <h1>Listagem de Produtos</h1>

    <form action="<?= url('/imoveis/store'); ?>" method="POST">

        <?= csrf_field();  ?>

        <div class="form-group">
            <label for="title">Título do imóvel</label>
            <input type="text" name="title" id="title" class="form-control">
        </div>
        <div class="form-group">
            <label for="descricao">Descrição</label>
            <textarea name="description" id="descricao" cols="30" rows="10" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label for="rental_price">Valor da locação</label>
            <input type="text" name="rental_price" id="rental_price" class="form-control">
        </div>
        <div class="form-group">
            <label for="sale_price">Valor de venda</label>
            <input type="text" name="sale_price" id="sale_price" class="form-control">
        </div>


        <button type="submit" class="btn btn-primary">Cadastrar Imóvel</button>

    </form>

</div>

@endsection