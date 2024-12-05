@include( 'head')

<div class = "main-container">
    @include('header')
    <div>
        <p>Editar perfil</p>
        <form action="{{route('perfil.update',$viajero->id_viajero)}}" method="POST">
            @csrf
            @method('PUT')

            <label for="nombre">Nombre</label>
            <input value="{{$viajero->nombre}}" type="text" name="nombre" id="nombre" required>
            @error('nombre', 'validacion')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <label for="apellido1">apellido1</label>
            <input value="{{$viajero->apellido1}}" type="text" name="apellido1" id="apellido1" required>
            @error('apellido1', 'validacion')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <label for="apellido2">apellido2</label>
            <input value="{{$viajero->apellido2}}" type="text" name="apellido2" id="apellido2" required>
            @error('apellido2', 'validacion')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <label for="direccion">direccion</label>
            <input value="{{$viajero->direccion}}" type="text" name="direccion" id="direccion" required>
            @error('direccion', 'validacion')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <label for="codigo_postal">Codigo postal</label>
            <input value="{{$viajero->codigo_postal}}" type="text" name="codigo_postal" id="codigo_postal" required>
            @error('codigo_postal', 'validacion')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <label for="ciudad">Ciudad</label>
            <input value="{{$viajero->ciudad}}" type="text" name="ciudad" id="ciudad" required>
            @error('ciudad', 'validacion')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <label for="pais">pais</label>
            <input value="{{$viajero->pais}}" type="text" name="pais" id="pais" required>
            @error('pais', 'validacion')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <label for="email">email</label>
            <input value="{{$viajero->email}}" type="text" name="email" id="email" required>
            @error('email', 'validacion')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <button type="submit">Aceptar</button>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </form>
        
        <p>Cambiar contraseña</p>
        <form>
            <label for="password">Contraseña</label>
            <input type="text" name="password" id="password" required>
            @error('password', 'validacion')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <label for="password_confirmation">Confirmar contraseña</label>
            <input type="text" name="password_confirmation" id="password_confirmation" required>
            @error('password_confirmation', 'validacion')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </form>
        <form action="{{ route('perfil.show', $viajero->id_viajero) }}" class="list-group-item">
                @csrf
                <button type="submit" class="btn btn-info w-100">Volver</button>
        </form>
    </div>
</div>