@include( 'head')

<div class = "main-container">
    @include('header')
    <p>Editar vehiculo</p>

    <div>
        <form action="{{route('vehiculo.update',$vehiculo->id_vehiculo)}}" method="POST">
            @csrf
            @method('PUT')

            <label for="descripcion">Descripción</label>
            <input value="{{$vehiculo->descripcion}}" type="text" name="descripcion" id="descripcion" required><br>
            @error('descripcion', 'validacion')
                <div class="alert alert-danger">{{ $message }}</div><br>
            @enderror

            <label for="email_conductor">Email conductor</label>
            <input value="{{$vehiculo->email_conductor}}" type="email" name="email_conductor" id="email_conductor" required><br>
            @error('email_conductor', 'validacion')
                <div class="alert alert-danger">{{ $message }}</div><br>
            @enderror

            <button type="submit">Aceptar</button>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </form>
        <form action="{{ route('vehiculo.index') }}" class="list-group-item">
                @csrf
                <button type="submit" class="btn btn-info w-100">Panel vehiculos</button>
        </form>
    </div>
</div>