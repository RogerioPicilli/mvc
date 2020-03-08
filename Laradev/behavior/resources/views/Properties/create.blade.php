<h1>Benvindo</h1>
<form action="{{ route('imoveis.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="">Titulo do Imóvel</label>
    <input type="text" name="title">
    <br>
    <label for="">Valor do Aluguel</label>
    <input type="text" name="rental_price">
    <br>
    <label for="">Foto</label>
    <input type="file" name="cover">
    <br>
    <br>
    <button type="submit">Gravar Imóvel</buttton>

</form>