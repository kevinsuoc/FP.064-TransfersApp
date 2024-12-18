@include('head')

<div class = "main-container">
@include('header')
<div class="container mt-5 p-4 shadow-sm rounded" style="max-width: 600px; background: #f8f9fa;">
    <h2 class="mb-4 text-center">Hacer reserva</h2>
<form action="{{route('userReserva.store')}}" method="POST">
    @csrf
    @method('POST')
    <div class="form-group">
    <select id="id_tipo_reserva" name="id_tipo_reserva" class="form-select mb-4 w-100" onchange="mostrarDatosReserva()">
    <option value="" disabled selected>Elige un tipo de reserva</option>
    @foreach ($tiposReserva as $tipoReserva)
    <option value="{{$tipoReserva->id_tipo_reserva}}" @if(old('id_tipo_reserva') == $tipoReserva->id_tipo_reserva) selected @endif>{{$tipoReserva->descripcion}}</option>
    @endforeach
    </select>

    <div id="todos_los_tipos"class="p-3 mb-4 border rounded w-100" hidden>
    <h3 class="mb-3">Datos generales</h3>
        <!-- Viajero reservador -->
        <label for="num_viajeros">Numero de viajeros</label>
        <input type="number" name="num_viajeros" id="num_viajeros"   value="{{old('num_viajeros')}}"class="form-control mb-3"><br>
        @error('num_viajeros', 'validacion')
                <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <select id="id_precio" name="id_precio" class="form-control">
        <option selected disabled value="">Selecciona un destino/origen</option>
        @foreach ($precios as $precio)
        <option value="{{$precio->id_precio}}" @if(old('id_precio') == $precio->id_precio) selected @endif>
            Hotel: {{$precio->hotel->usuario}} ({{$precio->precio}} $ Por trayecto)
            
        </option>
        @endforeach
        </select>
        @error('id_precio', 'validacion')
                <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div id="ida" class="p-3 mb-4 border rounded w-100" hidden>
    <h3 class="mb-3">Datos de ida</h3>
        <label for="fecha_entrada"class="form-label">Fecha de llegada del vuelo</label>
        <input id="fecha_entrada" class="form-control mb-3" name="fecha_entrada" value="{{old('fecha_entrada')}}" type="date" class="form-control mb-3"><br>
        @error('fecha_entrada', 'validacion')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <label for="hora_entrada"class="form-label">Hora de llegada del vuelo</label>
        <input id="hora_entrada"  class="form-control mb-3"name="hora_entrada" value="{{old('hora_entrada')}}" type="time" ><br>
        @error('hora_entrada', 'validacion')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <label for="numero_vuelo_entrada"class="form-label">Numero del vuelo de entrada</label>
        <input id="numero_vuelo_entrada"  class="form-control mb-3" name="numero_vuelo_entrada" value="{{old('numero_vuelo_entrada')}}" type="text" ><br>
        @error('numero_vuelo_entrada', 'validacion')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <label for="origen_vuelo_entrada"class="form-label">Origen del vuelo de entrada</label>
        <input id="origen_vuelo_entrada"  class="form-control mb-3"name="origen_vuelo_entrada" value="{{old('origen_vuelo_entrada')}}" type="text" ><br>
        @error('origen_vuelo_entrada', 'validacion')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

    </div>

    <div id="vuelta" class="p-3 mb-4 border rounded w-100" hidden>
        <h3>Datos de vuelta</h3>
        <label for="fecha_salida"class="form-label" >Fecha de salida del vuelo</label>
        <input id="fecha_salida"  class="form-control mb-3" name="fecha_salida" value="{{old('fecha_salida')}}" type="date" ><br>
        @error('fecha_salida', 'validacion')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <label for="hora_salida"class="form-label">Hora de salida del vuelo</label>   
        <input id="hora_salida"class="form-control mb-3" name="hora_salida" value="{{old('hora_salida')}}" type="time" ><br>
        @error('hora_salida', 'validacion')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        
        <label for="numero_vuelo_salida"class="form-label">Numero del vuelo de salida</label>
        <input id="numero_vuelo_salida"class="form-control mb-3" name="numero_vuelo_salida" value="{{old('numero_vuelo_salida')}}" type="text" ><br>
        @error('numero_vuelo_salida', 'validacion')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <label for="hora_recogida"class="form-label">Hora de recogida del hotel</label>
        <input id="hora_recogida"class="form-control mb-3" name="hora_recogida" value="{{old('hora_recogida')}}" type="time" ><br>
        @error('hora_recogida', 'validacion')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

    </div>

    @error('fecha', 'validacion')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <button type="submit"class="btn-bd-primary w-100">Crear</button>
    </div>
</form>
<form action="{{ route('userReserva.index') }}"class="mt-4>
        @csrf
        <button type="submit" class="btn-bd-primary w-100">Panel reservas</button>
</form>
<script>

function mostrarDatosReserva(){
    todosLosTipos = document.getElementById('todos_los_tipos')
    ida = document.getElementById('ida')
    vuelta = document.getElementById('vuelta')
    id_tipo_reserva = document.getElementById('id_tipo_reserva').value

    switch (id_tipo_reserva){
        case "1": todosLosTipos.hidden = false; ida.hidden = false; vuelta.hidden = true; break; 
        case "2": todosLosTipos.hidden = false; ida.hidden = true; vuelta.hidden = false; break;
        case "3": todosLosTipos.hidden = false; ida.hidden = false; vuelta.hidden = false; break;
    }
}

mostrarDatosReserva()
</script>

</div>
