@include( 'head')

<div class = "main-container">
    @include('header')
    <div class="container mt-5 p-4 shadow-sm rounded" style="max-width: 600px; background: #f8f9fa;">
        <h2 class="mb-4 text-center">Crear hotel</h2>

    <div>
        <form action="{{route('hotel.store')}}" method="POST" class="mb-4">
            @csrf
            @method('POST')
            <div class="form-group mb-4">
                <label for="id_zona">Zona</label>
                <select name="id_zona" id="id_zona" class="form-select" required>
                    <option value="" disabled selected>Selecciona una zona</option>
                    @foreach ($zonas as $zona)
                        <option value="{{$zona->id_zona}}" @if($zona->id_zona == old('id_zona')) selected @endif>{{$zona->descripcion}}</option>
                    @endforeach
                </select>
                @error('id_zona', 'validacion')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-4">
                <label for="comision">Comisión</label>
                <input value="{{ old('comision') }}" type="number" step="0.01" class="form-control" name="comision" id="comision" required>
                @error('comision', 'validacion')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-4">
                <label for="usuario">Usuario</label>
                <input value="{{ old('usuario') }}" type="text" class="form-control" name="usuario" id="usuario" required>
                @error('usuario', 'validacion')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-4">
                <label for="password">Contraseña</label>
                <input type="password" class="form-control" name="password" id="password">
                @error('password', 'validacion')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-center">
                <button type="submit" class="btn-bd-primary mb-3">Crear</but>
            </div>
            
        </form>

        <form action="{{ route('hotel.index') }}" class="list-group-item">
            @csrf
            <button type="submit" class="btn-bd-primary w-100">Panel hoteles</button>
        </form>
    </div>
    </div>
</div>
