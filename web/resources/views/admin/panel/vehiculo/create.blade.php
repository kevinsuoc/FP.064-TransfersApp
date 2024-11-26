@include( 'head')

<div class = "main-container">
    @include('header')
    <p>Crear vehiculo</p>

    <div>
        <form action="{{route('vehiculo.store')}}" method="POST">
            @csrf
            @method('POST')

            <label for="descripcion">Descripción</label>
            <input value="{{ old('descripcion') }}" type="text" name="descripcion" id="descripcion" required>
            @error('descripcion', 'validacion')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <label for="email_conductor">Email conductor</label>
            <input value="{{ old('email_conductor') }}" type="email" name="email_conductor" id="email_conductor" required>
            @error('email_conductor', 'validacion')
                <div class="alert alert-danger">{{ $message }}</div><br>
            @enderror

            <button type="submit">Crear</button>

        </form>
        <form action="{{ route('vehiculo.index') }}" class="list-group-item">
                @csrf
                <button type="submit" class="btn btn-info w-100">Panel vehiculos</button>
        </form>
    </div>
</div>