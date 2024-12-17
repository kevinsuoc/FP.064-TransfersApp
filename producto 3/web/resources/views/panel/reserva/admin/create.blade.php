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

            <div id="todos_los_tipos" class="p-3 mb-4 border rounded" hidden>
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

            <div id="ida" class="p-3 mb-4 border rounded" hidden>
                <h3 class="mb-3">Datos de ida</h3>
                <label for="fecha_entrada" class="form-label">Fecha de llegada del vuelo</label>
                <input id="fecha_entrada" name="fecha_entrada" type="date" value="{{old('fecha_entrada')}}" class="form-control mb-3">
                @error('fecha_entrada', 'validacion')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <label for="hora_entrada" class="form-label">Hora de llegada del vuelo</label>
                <input id="hora_entrada" name="hora_entrada" type="time" value="{{old('hora_entrada')}}" class="form-control mb-3">
                @error('hora_entrada', 'validacion')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div id="vuelta" class="p-3 mb-4 border rounded" hidden>
                <h3 class="mb-3">Datos de vuelta</h3>
                <label for="fecha_salida" class="form-label">Fecha de salida del vuelo</label>
                <input id="fecha_salida" name="fecha_salida" type="date" value="{{old('fecha_salida')}}" class="form-control mb-3">
                @error('fecha_salida', 'validacion')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-bd-primary  w-100">Crear</button>
        </div>
    </form>

    <form action="{{ route('vehiculo.index') }}" class="mt-4">
        @csrf
        <button type="submit" class="btn btn-secondary w-100">Panel reservas</button>
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
