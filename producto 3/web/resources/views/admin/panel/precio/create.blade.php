@include( 'head')

<div class = "main-container">
    @include('header')
    <p>Crear precio</p>

    <div>
        <form action="{{route('precio.store')}}" method="POST">
            @csrf
            @method('POST')

            <select name="id_hotel" id="id_hotel" required>
            <option value="" disabled selected>Selecciona un hotel</option>
            @foreach ($hoteles as $hotel)
            <option value="{{$hotel->id_hotel}}" @if($hotel->id_hotel == old('id_hotel')) selected @endif>{{$hotel->usuario}}</option>
            @endforeach
            </select>
            @error('id_hotel', 'validacion')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <select name="id_vehiculo" id="id_vehiculo" required>
            <option value="" disabled selected>Selecciona un vehiculo</option>
            @foreach ($vehiculos as $vehiculo)
            <option value="{{$vehiculo->id_vehiculo}}" @if($vehiculo->id_vehiculo == old('id_vehiculo')) selected @endif>{{$vehiculo->descripcion}}, {{$vehiculo->email_conductor}}</option>
            @endforeach
            </select>
            @error('id_vehiculo', 'validacion')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <label for="precio">Precio</label>
            <input value="{{old('precio')}}" type="number" step="0.01" name="precio" id="precio" required>
            @error('precio', 'validacion')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @error('precio_unico', 'validacion')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <button type="submit">Crear</button>
        </form>

        <form action="{{ route('precio.index') }}" class="list-group-item">
                @csrf
                <button type="submit" class="btn btn-info w-100">Panel precios</button>
        </form>
    </div>
</div>