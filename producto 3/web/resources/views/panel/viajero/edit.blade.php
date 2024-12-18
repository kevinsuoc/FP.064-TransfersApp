@include( 'head')

<div class = "main-container">
    @include('header')
    <div>
    <div class="container mt-5 p-4 shadow-sm rounded" style="max-width: 400px; background: #f8f9fa;">
    <h2 class="mb-4 text-center">Editar Perfil</h2>
        <form action="{{route('perfil.update',$viajero->id_viajero)}}" method="POST">
            @csrf
            @method('PUT')
        <div class="p-3 mb-4 border rounded">
            <label for="nombre"class="form-label">Nombre</label>
            <input value="{{$viajero->nombre}}"class="form-control mb-3" type="text" name="nombre" id="nombre" required><br>
            @error('nombre', 'validacion')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <label class="form-label"for="apellido1">Apellido</label>
            <input value="{{$viajero->apellido1}}" class="form-control mb-3"type="text" name="apellido1" id="apellido1" required><br>
            @error('apellido1', 'validacion')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <label class="form-label"for="apellido2">Segundo apellido</label>
            <input value="{{$viajero->apellido2}}" class="form-control mb-3"type="text" name="apellido2" id="apellido2" required><br>
            @error('apellido2', 'validacion')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <label class="form-label" for="direccion">direccion</label>
            <input value="{{$viajero->direccion}}" class="form-control mb-3"type="text" name="direccion" id="direccion" required><br>
            @error('direccion', 'validacion')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <label class="form-label" for="codigo_postal">Codigo postal</label>
            <input value="{{$viajero->codigo_postal}}" class="form-control mb-3"type="text" name="codigo_postal" id="codigo_postal" required><br>
            @error('codigo_postal', 'validacion')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <label class="form-label" for="ciudad">Ciudad</label>
            <input value="{{$viajero->ciudad}}"class="form-control mb-3" type="text" name="ciudad" id="ciudad" required><br>
            @error('ciudad', 'validacion')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <label class="form-label" for="pais">pais</label>
            <input value="{{$viajero->pais}}" class="form-control mb-3"type="text" name="pais" id="pais" required><br>
            @error('pais', 'validacion')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <label class="form-label" for="email">email</label>
            <input value="{{$viajero->email}}" class="form-control mb-3"type="text" name="email" id="email" required><br>
            @error('email', 'validacion')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <button type="submit"class="btn-bd-primary" >Aceptar</button>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </form>
</div>
<div class="p-3 mb-4 border rounded">
        <p>Cambiar contraseña</p>
        <form action="{{route('perfil.changePassword',$viajero->id_viajero)}}" method="POST">
            @csrf
            @method('PUT')


            <label class="form-label" for="password">Contraseña</label>
            <input class="form-control mb-3" type="password" name="password" id="password" required><br>


            <label class="form-label"for="password_confirmation">Confirmar contraseña</label>
            <input class="form-control mb-3" type="password" name="password_confirmation" id="password_confirmation" required><br>

            <button class="btn-bd-primary" type="submit">Aceptar</button>
            
            @error('password', 'validacion')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            @if (session('success-password'))
                <div class="alert alert-success">
                    {{ session('success-password') }}
                </div>
            @endif
        </form>
        </div>
        <form action="{{ route('perfil.show', $viajero->id_viajero) }}" class="list-group-item">
                @csrf
                <button type="submit" class="btn-bd-primary  w-100">Volver</button>
        </form>
    
</div>
</div>
