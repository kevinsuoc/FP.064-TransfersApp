@include('head')

<div class = "main-container">
@include('header')

    <div class="container mt-5 p-4 shadow-sm rounded" style="max-width: 600px; background: #f8f9fa;">
    <form action="{{route('reserva.update',$reserva->id_reserva)}}" method="POST" class="form-group d-flex flex-column">
            @csrf
            @method('PUT')

            <label for="email_cliente">Email del cliente</label>
            <input type="email" name="email_cliente" id="email_cliente"  value="{{$reserva->email_cliente}}" class="form-control"><br>
            @error('email_cliente', 'validacion')
                    <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <label for="num_viajeros">Numero de viajeros</label>
            <input type="number" name="num_viajeros" id="num_viajeros" value="{{$reserva->num_viajeros}}" class="form-control"><br>
            @error('num_viajeros', 'validacion')
                    <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <label for="id_precio">Destino/Origen</label>
            <select id="id_precio" name="id_precio" class="form-select">
            <option selected disabled value="">Selecciona un destino/origen</option>
            @foreach ($precios as $precio)
            <option value="{{$precio->id_precio}}" @if($reserva->id_precio == $precio->id_precio) selected @endif>
                Zona: {{$precio->hotel->zona->descripcion}}
                Hotel: {{$precio->hotel->usuario}}
                Vehiculo: {{$precio->vehiculo->descripcion}}
                Email del conductor: {{$precio->vehiculo->email_conductor}}
                Precio: {{$precio->precio}}
            </option>
            @endforeach

            </select><br>
        
            @if($reserva->id_tipo_reserva == 1 || $reserva->id_tipo_reserva == 3)
            <div class="w-100 mt-4"><h3 class="text-center">Datos de ida</h3></div>
            <label for="fecha_entrada">Fecha de llegada del vuelo</label>
            <input id="fecha_entrada" name="fecha_entrada" value="{{$reserva->fecha_entrada}}" type="date" class="form-control"><br>
            @error('fecha_entrada', 'validacion')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <label for="hora_entrada">Hora de llegada del vuelo</label>
            <input id="hora_entrada" name="hora_entrada" value="{{$reserva->hora_entrada}}" type="time" class="form-control"><br>
            @error('hora_entrada', 'validacion')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <label for="numero_vuelo_entrada">Numero del vuelo de entrada</label>
            <input id="numero_vuelo_entrada" name="numero_vuelo_entrada" value="{{$reserva->numero_vuelo_entrada}}" type="text" class="form-control"><br>
            @error('numero_vuelo_entrada', 'validacion')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <label for="origen_vuelo_entrada">Origen del vuelo de entrada</label>
            <input id="origen_vuelo_entrada" name="origen_vuelo_entrada" value="{{$reserva->origen_vuelo_entrada}}" type="text" class="form-control" ><br>
            @error('origen_vuelo_entrada', 'validacion')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @endif

            @if($reserva->id_tipo_reserva == 2 || $reserva->id_tipo_reserva == 3)
            <div class="w-100 mt-4"><h3 class="text-center">Datos de vuelta</h3></div>
            <label for="fecha_salida">Fecha de salida del vuelo</label>
            <input id="fecha_salida" name="fecha_salida" value="{{$reserva->fecha_salida}}" type="date" class="form-control"><br>
            @error('fecha_salida', 'validacion')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <label for="hora_salida">Hora de salida del vuelo</label>   
            <input id="hora_salida" name="hora_salida" value="{{$reserva->hora_salida}}" type="time" class="form-control"><br>
            @error('hora_salida', 'validacion')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            
            <label for="numero_vuelo_salida">Numero del vuelo de salida</label>
            <input id="numero_vuelo_salida" name="numero_vuelo_salida" value="{{$reserva->numero_vuelo_salida}}" type="text" class="form-control"><br>
            @error('numero_vuelo_salida', 'validacion')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <label for="hora_recogida">Hora de recogida del hotel</label>
            <input id="hora_recogida" name="hora_recogida" value="{{$reserva->hora_recogida}}" type="time" class="form-control"><br>
            @error('hora_recogida', 'validacion')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @endif

            <input type="hidden" name="id_tipo_reserva" value="{{$reserva->id_tipo_reserva}}">
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn-bd-primary">Aceptar</button>
            </div>
            @error('descripcion', 'validacion')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

        </form>
        <form action="{{ route('reserva.index') }}" class="form-group">
                @csrf
                <button type="submit" class="btn-bd-primary w-100">Panel Reservas</button>
        </form>


    </div>
</div>
