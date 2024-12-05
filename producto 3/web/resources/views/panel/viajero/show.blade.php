@include( 'head')

<div class = "main-container">
    @include('header')
    <p>Perfil</p>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div>
        <p><strong>Nombre: </strong>{{$viajero->nombre}}</p>
        <p><strong>Apellido 1: </strong>{{$viajero->apellido1}}</p>
        <p><strong>Apellido 2: </strong>{{$viajero->apellido2}}</p>
        <p><strong>Direccion: </strong>{{$viajero->direccion}}</p>
        <p><strong>Codigo postal: </strong>{{$viajero->codigo_postal}}</p>
        <p><strong>Ciudad: </strong>{{$viajero->ciudad}}</p>
        <p><strong>Pais: </strong>{{$viajero->pais}}</p>
        <p><strong>Email: </strong>{{$viajero->email}}</p>
        <form action="{{route('perfil.edit', $viajero->id_viajero)}}">
        @csrf
        <button type="submit">Editar perfil</button>
        </form>
    </div>
</div>