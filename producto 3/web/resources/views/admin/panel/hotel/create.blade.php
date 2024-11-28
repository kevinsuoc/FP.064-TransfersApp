@include( 'head')

<div class = "main-container">
    @include('header')
    <p>Crear hotel</p>

    <div>
        <form action="{{route('hotel.store')}}" method="POST">
            @csrf
            @method('POST')

            <select name="id_zona" id="id_zona" required>
            <option value="" disabled selected>Selecciona una zona</option>
            @foreach ($zonas as $zona)
            <option value="{{$zona->id_zona}}" @if($zona->id_zona == old('id_zona')) selected @endif>{{$zona->descripcion}}</option>
            @endforeach
            </select>

            <label for="comision">Comision</label>
            <input value="{{ old('comision') }}" type="number" name="comision" id="comision" required>
            @error('comision', 'validacion')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <label for="usuario">Usuario</label>
            <input value="{{ old('usuario') }}" type="text" name="usuario" id="usuario" required>
            @error('usuario', 'validacion')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password">
            @error('password', 'validacion')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <button type="submit">Crear</button>
        </form>

        <form action="{{ route('hotel.index') }}" class="list-group-item">
                @csrf
                <button type="submit" class="btn btn-info w-100">Panel hoteles</button>
        </form>
    </div>
</div>