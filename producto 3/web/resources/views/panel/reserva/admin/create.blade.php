@include('head')

<div class="main-container">
@include('header')
<div class="container mt-5 p-4 shadow-sm rounded" style="max-width: 600px; background: #f8f9fa;">
    <h2 class="mb-4 text-center">Crear reserva</h2>
    <form action="{{route('reserva.store')}}" method="POST">
        @csrf
        <div class="form-group">
            <select id="id_tipo_reserva" name="id_tipo_reserva" class="form-select mb-4" onchange="mostrarDatosReserva()">
                <option value="" disabled selected>Elige un tipo de reserva</option>
                @foreach ($tiposReserva as $tipoReserva)
                <option value="{{$tipoReserva->id_tipo_reserva}}" @if(old('id_tipo_reserva') == $tipoReserva->id_tipo_reserva) selected @endif>{{$tipoReserva->descripcion}}</option>
                @endforeach
            </select>

            <div id="todos_los_tipos" class="p-3 mb-4 border rounded w-100" hidden>
                <h3 class="mb-3">Datos generales</h3>
                <label for="email_cliente" class="form-label">Email del cliente</label>
                <input type="email" name="email_cliente" id="email_cliente" value="{{old('email_cliente')}}" class="form-control mb-3">
                @error('email_cliente', 'validacion')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <label for="num_viajeros" class="form-label">Numero de viajeros</label>
                <input type="number" name="num_viajeros" id="num_viajeros" value="{{old('num_viajeros')}}" class="form-control mb-3">
                @error('num_viajeros', 'validacion')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <label for="id_precio" class="form-label">Selecciona un destino/origen</label>
                <select id="id_precio" name="id_precio" class="form-select mb-3">
                    <option selected disabled value="">Selecciona un destino/origen</option>
                    @foreach ($precios as $precio)
                    <option value="{{$precio->id_precio}}" @if(old('id_precio') == $precio->id_precio) selected @endif>
                        Zona: {{$precio->hotel->zona->descripcion}} - Hotel: {{$precio->hotel->usuario}} - Vehículo: {{$precio->vehiculo->descripcion}} - Email conductor: {{$precio->vehiculo->email_conductor}} - Precio: {{$precio->precio}}
                    </option>
                    @endforeach
                </select>
            </div>

            <div id="ida" class="p-3 mb-4 border rounded w-100" hidden>
                <h3 class="mb-3">Datos de ida</h3>
                <label for="fecha_entrada" class="form-label">Fecha de llegada del vuelo</label>
                <input class="form-control" id="fecha_entrada" name="fecha_entrada" type="date" value="{{old('fecha_entrada')}}" class="form-control mb-3">
                @error('fecha_entrada', 'validacion')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <label for="hora_entrada" class="form-label">Hora de llegada del vuelo</label>
                <input class="form-control" id="hora_entrada" name="hora_entrada" type="time" value="{{old('hora_entrada')}}" class="form-control mb-3">
                @error('hora_entrada', 'validacion')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <label for="numero_vuelo_entrada">Numero del vuelo de entrada</label>
                <input class="form-control" id="numero_vuelo_entrada" name="numero_vuelo_entrada" value="{{old('numero_vuelo_entrada')}}" type="text" ><br>
                @error('numero_vuelo_entrada', 'validacion')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <label for="origen_vuelo_entrada">Origen del vuelo de entrada</label>
                <input class="form-control" id="origen_vuelo_entrada" name="origen_vuelo_entrada" value="{{old('origen_vuelo_entrada')}}" type="text" ><br>
                @error('origen_vuelo_entrada', 'validacion')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div id="vuelta" class="p-3 mb-4 border rounded w-100" hidden>
                <h3 class="mb-3">Datos de vuelta</h3>
                <label for="fecha_salida" class="form-label">Fecha de salida del vuelo</label>
                <input class="form-control" id="fecha_salida" name="fecha_salida" type="date" value="{{old('fecha_salida')}}" class="form-control mb-3">
                @error('fecha_salida', 'validacion')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                        
                <label for="hora_salida">Hora de salida del vuelo</label>   
                <input class="form-control" id="hora_salida" name="hora_salida" value="{{old('hora_salida')}}" type="time" ><br>
                @error('hora_salida', 'validacion')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                
                <label for="numero_vuelo_salida">Numero del vuelo de salida</label>
                <input class="form-control" id="numero_vuelo_salida" name="numero_vuelo_salida" value="{{old('numero_vuelo_salida')}}" type="text" ><br>
                @error('numero_vuelo_salida', 'validacion')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <label for="hora_recogida">Hora de recogida del hotel</label>
                <input class="form-control" id="hora_recogida" name="hora_recogida" value="{{old('hora_recogida')}}" type="time" ><br>
                @error('hora_recogida', 'validacion')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-bd-primary  w-100">Crear</button>
        </div>
    </form>

    <form action="{{ route('reserva.index') }}" class="mt-4">
        @csrf
        <button type="submit" class="btn btn-primary w-100">Panel reservas</button>
    </form>
</div>

<script>
function mostrarDatosReserva() {
    const todosLosTipos = document.getElementById('todos_los_tipos');
    const ida = document.getElementById('ida');
    const vuelta = document.getElementById('vuelta');
    const id_tipo_reserva = document.getElementById('id_tipo_reserva').value;

    todosLosTipos.hidden = ida.hidden = vuelta.hidden = true;

    if (id_tipo_reserva == "1") {
        todosLosTipos.hidden = ida.hidden = false;
    } else if (id_tipo_reserva == "2") {
        todosLosTipos.hidden = vuelta.hidden = false;
    } else if (id_tipo_reserva == "3") {
        todosLosTipos.hidden = ida.hidden = vuelta.hidden = false;
    }
}
mostrarDatosReserva() 
</script>
</div>
