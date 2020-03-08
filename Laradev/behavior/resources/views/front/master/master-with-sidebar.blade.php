<!DOCTYPE html>
<html lang="pt_br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LaraDev - @yield('title')</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    @hasSection('css')
        @yield('css')
    @endif
</head>

<body>

    @include('front\includes\header')

    <div class="container py-4">
        <div class="row">

            <div class="col-8">
                @yield('content')
            </div>

            <div class="col-4">
                <!-- @yield('sidebar') -->
                @section('sidebar')
                    <h2>[MASTER]Links</h2>
                    <ul class="li">Lorem ipsum dolor sit amet.</ul>
                    <ul class="li">Doloribus rerum quisquam in! Sequi!</ul>
                    <ul class="li">Modi adipisci cumque debitis hic!</ul>
                    <ul class="li">Corrupti vitae nobis beatae velit!</ul>
                    <ul class="li">Dolore commodi vitae molestias est.</ul>

                @show
            </div>

        </div>
    </div>

    @include('front\includes\footer')

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    @hasSection('js')
        @yield('js')
    @endif

</body>

</html>