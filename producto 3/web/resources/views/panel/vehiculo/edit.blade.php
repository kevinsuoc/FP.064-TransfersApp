@include( 'head')

<div class = "main-container">
    @include('header')
    <div class="container mt-5 p-4 shadow-sm rounded" style="max-width: 600px; background: #f8f9fa;">
    <h2 class="mb-4 text-center">Editar vehículo</h2

    <div>
        <form action="{{route('vehiculo.update',$vehiculo->id_vehiculo)}}" method="POST"class="d-flex flex-column">
            @csrf
            @method('PUT')

            <div class="form-group mb-4">
            <label for="descripcion">Descripción</label>
            <input value="{{$vehiculo->descripcion}}" class="form-control" type="text" name="descripcion" id="descripcion" required><br>
            @error('descripcion', 'validacion')
                <div class="alert alert-danger">{{ $message }}</div><br>
            @enderror

            <label for="email_conductor">Email conductor</label>
            <input value="{{$vehiculo->email_conductor}}" class="form-control" type="email" name="email_conductor" id="email_conductor" required><br>
            @error('email_conductor', 'validacion')
                <div class="alert alert-danger">{{ $message }}</div><br>
            @enderror
            </div>

            <button type="submit"class="btn-bd-primary mb-3">Aceptar</button>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </form>
        <form action="{{ route('vehiculo.index') }}" class="list-group-item mt-4">
                @csrf
                <button type="submit" class="btn-bd-primary w-100">Panel vehiculos</button>
        </form>
    </div>
</div>