@include( 'head')

<div class = "main-container">
    @include('header')
    <div class="container mt-5 p-4 shadow-sm rounded" style="max-width: 600px; background: #f8f9fa;">
    <h2 class="mb-4 text-center">Editar precio</h2>

    <div>
        <form action="{{route('precio.update',$precio->id_precio)}}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
            <select name="id_hotel" id="id_hotel" required>
            <option value="" disabled selected>Selecciona una hotel</option>
            @foreach ($hoteles as $hotel)
            <option value="{{$hotel->id_hotel}}" @if($hotel->id_hotel == $precio->id_hotel) selected @endif>{{$hotel->usuario}}</option>
            @endforeach
            </select>
            @error('id_hotel', 'validacion')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            </div>
            <div class="form-group mt-3">
            <select name="id_vehiculo" id="id_vehiculo" required>
            <option value="" disabled selected>Selecciona un vehiculo</option>
            @foreach ($vehiculos as $vehiculo)
            <option value="{{$vehiculo->id_vehiculo}}" @if($vehiculo->id_vehiculo == $precio->id_vehiculo) selected @endif>{{$vehiculo->descripcion}}, {{$vehiculo->email_conductor}}</option>
            @endforeach
            </select>
            @error('id_vehiculo', 'validacion')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            </div>
            <div class="form-group mt-3">
            <label for="precio">Precio</label>
            <input value="{{$precio->precio}}" type="number" step="0.01" name="precio" id="precio" required>
            @error('precio', 'validacion')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @error('precio_unico', 'validacion')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            </div>
            <button type="submit"class="btn-bd-primary mt-4">Aceptar</button>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </form>
        <form action="{{ route('precio.index') }}" class="list-group-item">
                @csrf
                <button type="submit" class="btn-bd-primary w-100">Panel precios</button>
        </form>
    </div>
</div>
</div>