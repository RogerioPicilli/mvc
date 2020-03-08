 @extends('front\master\master') @section('title', 'Título Rogério') @section('content')

<div class="container">
    <div class="row py-4">
        <div class="col-12">
            <p>Meu nome é {{ $user->name }}</p>
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <h3>Listagem de Cursos</h3>

            @for($i = 0; $i<count($courses); $i++) 
                <p>{{ $courses[$i]['name']}} - {{ $courses[$i]['tutor'] }}</p>
            @endfor @foreach($courses as $course)
                <p style="background-color: {{ ($loop->index % 2 === 0 ? 'yellow' : 'blue' ) }}">{{ $course['name']}} - {{ $course['tutor'] }}</p>
                <!-- @php
                    var_dump($loop)
                @endphp -->
            @endforeach
        </div>
        <div class="col-6">
            @if(!empty($user->email))
            <p>O email do usuário é {{ $user->email }}</p>
            @elseif($user)
            <p>Existe o objeto usuário</p>
            @else
            <p>O objeto user não existe</p>
            @endif
        </div>
    </div>
</div>

@endsection