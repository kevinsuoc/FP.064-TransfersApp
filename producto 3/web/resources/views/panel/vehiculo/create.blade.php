@include( 'head')

<div class = "main-container">
    @include('header')
    <div class="container mt-5 p-4 shadow-sm rounded" style="max-width: 600px; background: #f8f9fa;">
    <h2 class="mb-4 text-center">Crear vehículo</h2>

    <div>
        <form action="{{route('vehiculo.store')}}" method="POST"class="mb-4">
            @csrf
            @method('POST')

            <div class="form-group mb-4">
                <label for="descripcion">Descripción</label>
                <input value="{{ old('descripcion') }}" class="form-control" type="text" name="descripcion" id="descripcion" required>
                @error('descripcion', 'validacion')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>


            <div class="form-group mb-4">
                <label for="email_conductor">Email conductor</label>
                <input value="{{ old('email_conductor') }}" class="form-control" type="email" name="email_conductor" id="email_conductor" required>
                @error('email_conductor', 'validacion')
                    <div class="alert alert-danger">{{ $message }}</div><br>
                @enderror
            </div>

     <div style="text-align: center;"> <!-- Centra el botón Crear -->
        <button type="submit" class="btn-bd-primary">Crear</button>
    </div>
</form>

        <form action="{{ route('vehiculo.index') }}" class="list-group-item">
                @csrf
                <button type="submit" class="btn-bd-primary w-100">Panel vehiculos</button>
        </form>
    </div>
</div>