@include('head')

<div class="main-container">
    @include('header')
    <div class="container mt-5 p-4 shadow-sm rounded" style="max-width: 600px; background: #f8f9fa;">
        <h2 class="mb-4 text-center">Crear precio</h2>

        <div>
            <form action="{{route('precio.store')}}" method="POST" class="form-container">
                @csrf
                @method('POST')

                <div class="form-group">
                    <label for="id_hotel">Selecciona un hotel</label>
                    <select name="id_hotel" id="id_hotel" class="form-select" required>
                        <option value="" disabled selected>Selecciona un hotel</option>
                        @foreach ($hoteles as $hotel)
                            <option value="{{$hotel->id_hotel}}" @if($hotel->id_hotel == old('id_hotel')) selected @endif>{{$hotel->usuario}}</option>
                        @endforeach
                    </select>
                    @error('id_hotel', 'validacion')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="id_vehiculo">Selecciona un vehículo</label>
                    <select name="id_vehiculo" id="id_vehiculo" class="form-select" required>
                        <option value="" disabled selected>Selecciona un vehículo</option>
                        @foreach ($vehiculos as $vehiculo)
                            <option value="{{$vehiculo->id_vehiculo}}" @if($vehiculo->id_vehiculo == old('id_vehiculo')) selected @endif>{{$vehiculo->descripcion}}, {{$vehiculo->email_conductor}}</option>
                        @endforeach
                    </select>
                    @error('id_vehiculo', 'validacion')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="precio">Precio</label>
                    <input value="{{old('precio')}}" type="number" step="0.01" name="precio" id="precio" class="form-control" required>
                    @error('precio', 'validacion')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    @error('precio_unico', 'validacion')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn-bd-primary mt-4">Crear</button>
            </form>

            <form action="{{ route('precio.index') }}" class="mt-4">
                @csrf
                <button type="submit" class="btn-bd-primary w-100">Panel precios</button>
            </form>
        </div>
    </div>
</div>
