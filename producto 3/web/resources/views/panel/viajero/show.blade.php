@include( 'head')

<div class = "main-container">
    @include('header')
    <div class="container mt-5 p-4 shadow-sm rounded" style="max-width: 600px; background: #f8f9fa;">
    <h2 class="mb-4 text-center">Perfil</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="mt-4">
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
        <button type="submit"class="btn-bd-primary">Editar perfil</button>
        </form>
    </div>
</div>