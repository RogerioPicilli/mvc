<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LaraDev: CRUD Imobi</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="container">
            <a href="#" class="navbar-brand">Lara<b>Dev</b></a>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="<?= url('/imoveis'); ?>" class="nav-link">Listar todos os imóveis</a>
                </li>
                <li class="nav-item">
                    <a href="<?= url('/imoveis/novo'); ?>" class="nav-link">Cadastro Novo Imóvel</a>
                </li>
            </ul>
        </div>
    </nav>

    @yield('content')

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>

</html>