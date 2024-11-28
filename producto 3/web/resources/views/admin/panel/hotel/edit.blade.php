@include( 'head')

<div class = "main-container">
    @include('header')
    <p>Editar hotel</p>

    <div>
        <form action="{{route('hotel.update',$hotel->id_hotel)}}" method="POST">
            @csrf
            @method('PUT')

            <select name="id_zona" id="id_zona" required>
            <option value="" disabled selected>Selecciona una zona</option>
            @foreach ($zonas as $zona)
            <option value="{{$zona->id_zona}}" @if($zona->id_zona == $hotel->zona->id_zona) selected @endif>{{$zona->descripcion}}</option>
            @endforeach
            </select>
            @error('id_zona', 'validacion')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <label for="comision">Comision</label>
            <input value="{{$hotel->comision}}" type="number" name="comision" id="comision" required>
            @error('comision', 'valodacion')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <label for="usuario">Usuario</label>
            <input value="{{$hotel->usuario}}" type="text" name="usuario" id="usuario" required>
            @error('usuario', 'validacion')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <button type="submit">Aceptar</button>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </form>

        <form action="{{route('hotel.update',$hotel->id_hotel)}}" method="POST">
            @csrf
            @method('PUT')
            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password" required>

            <button type="submit">Cambiar contraseña</button>
            @if (session('success-password'))
                <div class="alert alert-success">
                    {{ session('success-password') }}
                </div>
            @endif
            @error('descripcion', 'password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </form>

        <form action="{{ route('hotel.index') }}" class="list-group-item">
                @csrf
                <button type="submit" class="btn btn-info w-100">Panel hoteles</button>
        </form>
    </div>
</div>