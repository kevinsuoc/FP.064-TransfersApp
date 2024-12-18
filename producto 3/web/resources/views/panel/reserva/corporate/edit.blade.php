@include('head')

<div class = "main-container">
@include('header')
<div class="container mt-5 p-4 shadow-sm rounded" style="max-width: 600px; background: #f8f9fa;">
    <div>
    <h2 class="mb-4 text-center">Editar Reserva</h2>
    <form action="{{route('corporateReserva.update',$reserva->id_reserva)}}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="p-3 mb-4">
            <div class="container p-3 mb-4 border rounded">
                    <h2 class="mb-4 text-center">Datos generales</h2>
                <input class="form-control mb-3" type="email" name="email_cliente" id="email_cliente"  value="{{$reserva->email_cliente}}"><br>
                @error('email_cliente', 'validacion')
                        <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                
                <label class="form-label" for="num_viajeros">Numero de viajeros</label>
                <input class="form-control mb-3" type="number" name="num_viajeros" id="num_viajeros" value="{{$reserva->num_viajeros}}"><br>
                @error('num_viajeros', 'validacion')
                        <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <select id="id_precio" name="id_precio" class="form-control mb-3">
                <option selected disabled value="">Selecciona un precio</option>
                @foreach ($precios as $precio)
                <option value="{{$precio->id_precio}}" @if($reserva->id_precio == $precio->id_precio) selected @endif>
                Precio: {{$precio->precio}}.
                Conductor:  {{$precio->vehiculo->email_conductor}} ({{$precio->vehiculo->descripcion}})
                </option>
                @endforeach
                </select>
            </div>
        @if($reserva->id_tipo_reserva == 1 || $reserva->id_tipo_reserva == 3)
        <div class="container p-3 mb-4 border rounded">
        <h2 class="mb-4 text-center">Datos de ida</h2>
        <label class="form-label" for="fecha_entrada">Fecha de llegada del vuelo</label>
        <input id="fecha_entrada" name="fecha_entrada" value="{{$reserva->fecha_entrada}}" type="date" ><br>
        @error('fecha_entrada', 'validacion')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <label class="form-label" for="hora_entrada">Hora de llegada del vuelo</label>
        <input class="form-select mb-3" id="hora_entrada" name="hora_entrada" value="{{$reserva->hora_entrada}}" type="time" ><br>
        @error('hora_entrada', 'validacion')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <label class="form-label" for="numero_vuelo_entrada">Numero del vuelo de entrada</label>
        <input class="form-select mb-3" id="numero_vuelo_entrada" name="numero_vuelo_entrada" value="{{$reserva->numero_vuelo_entrada}}" type="text" ><br>
        @error('numero_vuelo_entrada', 'validacion')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <label class="form-label" for="origen_vuelo_entrada">Origen del vuelo de entrada</label>
        <input class="form-select mb-3" id="origen_vuelo_entrada" name="origen_vuelo_entrada" value="{{$reserva->origen_vuelo_entrada}}" type="text" ><br>
        @error('origen_vuelo_entrada', 'validacion')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        @endif
        </div>
        @if($reserva->id_tipo_reserva == 2 || $reserva->id_tipo_reserva == 3)

        <div class="container p-3 mb-4 border rounded">
        <h2 class="mb-4 text-center">Datos de vuelta</h2>
        <label class="form-label" for="fecha_salida">Fecha de salida del vuelo</label>
        <input class="form-select mb-3" id="fecha_salida" name="fecha_salida" value="{{$reserva->fecha_salida}}" type="date" ><br>
        @error('fecha_salida', 'validacion')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <label class="form-label" for="hora_salida">Hora de salida del vuelo</label>   
        <input class="form-select mb-3" id="hora_salida" name="hora_salida" value="{{$reserva->hora_salida}}" type="time" ><br>
        @error('hora_salida', 'validacion')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        
        <label class="form-label" for="numero_vuelo_salida">Numero del vuelo de salida</label>
        <input class="form-select mb-3" id="numero_vuelo_salida" name="numero_vuelo_salida" value="{{$reserva->numero_vuelo_salida}}" type="text" ><br>
        @error('numero_vuelo_salida', 'validacion')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <label class="form-label" for="hora_recogida">Hora de recogida del hotel</label>
        <input class="form-select mb-3" id="hora_recogida" name="hora_recogida" value="{{$reserva->hora_recogida}}" type="time" ><br>
        @error('hora_recogida', 'validacion')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        </div>
        @endif

		@error('fecha', 'validacion')
        <div class="alert alert-danger">{{ $message }}</div>
  	  @enderror
    

        <input class="form-select mb-3" type="hidden" name="id_tipo_reserva" value="{{$reserva->id_tipo_reserva}}">

        <div class="d-flex justify-content-center mb-4">
            <button class="btn-bd-primary" type="submit">Aceptar</button>
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
    <form action="{{ route('corporateReserva.index') }}" class="list-group-item w-100">
            @csrf
        <div class="d-flex justify-content-center w-100">
        <button class="btn-bd-primary w-100" type="submit">Panel Reservas</button>
        </div>
    </form>
</div>

</div>
