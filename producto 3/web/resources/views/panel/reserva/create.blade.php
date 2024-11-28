@include('head')

<div class = "main-container">
@include('header')

<form>
    <select id="id_tipo_reserva" name="id_tipo_reserva" required onchange="mostrarDatosReserva()">
    <option value="" disabled selected>Elige un tipo de reserva</option>
    @foreach ($tiposReserva as $tipoReserva)
    <option value="{{$tipoReserva->id_tipo_reserva}}" @if(old('id_tipo_reserva') == $tipoReserva->id_tipo_reserva) selected @endif>{{$tipoReserva->descripcion}}</option>
    @endforeach
    </select>

    <div id="todos_los_tipos" hidden>
        <h3>Datos generales</h3>
        <!-- Viajero reservador -->
        <label for="email_cliente" value="{{old('email_cliete')}}">Email del cliente</label>
        <input type="email" name="email_cliente" id="email_cliente" required><br>

        <label for="num_viajeros" value="{{old('num_viajeros')}}">Numero de viajeros</label>
        <input type="number" name="num_viajeros" id="num_viajeros" required><br>

        <select id="id_precio" name="id_precio">
        <option selected value="">Selecciona un destino/origen</option>
        @foreach ($precios as $precio)
        <option value="{{$precio->id_precio}}" @if(old('id_precio') === $precio->id_precio) selected @endif>
            Zona: {{$precio->hotel->zona->descripcion}}
            Hotel: {{$precio->hotel->usuario}}
            Vehiculo: {{$precio->vehiculo->descripcion}}
            Email del conductor: {{$precio->vehiculo->email_conductor}}
            Precio: {{$precio->precio}}
        </option>
        @endforeach
        </select><br>

        <!-- Viajero reservador -->
        <!-- Hotel reservador -->
    </div>

    <div id="ida" hidden>
        <h3>Datos de ida</h3>
        <label for="fecha_entrada">Fecha de llegada del vuelo</label>
        <input id="fecha_entrada" name="fecha_entrada" value="{{old('fecha_entrada')}}" type="date" required><br>

        <label for="hora_entrada">Hora de llegada del vuelo</label>
        <input id="hora_entrada" name="hora_entrada" value="{{old('hora_entrada')}}" type="time" required><br>

        <label for="numero_vuelo_entrada">Numero del vuelo de entrada</label>
        <input id="numero_vuelo_entrada" name="numero_vuelo_entrada" value="{{old('numero_vuelo_entrada')}}" type="text" required><br>
      
        <label for="origen_vuelo_entrada">Origen del vuelo de entrada</label>
        <input id="origen_vuelo_entrada" name="origen_vuelo_entrada" value="{{old('origen_vuelo_entrada')}}" type="text" required><br>
    </div>

    <div id="vuelta" hidden>
        <h3>Datos de vuelta</h3>
        <label for="fecha_salida">Fecha de salida del vuelo</label>
        <input id="fecha_salida" name="fecha_salida" value="{{old('fecha_salida')}}" type="date" required><br>

        <label for="hora_salida">Hora de salida del vuelo</label>   
        <input id="hora_salida" name="hora_salida" value="{{old('hora_salida')}}" type="time" required><br>

        <label for="numero_vuelo_salida">Numero del vuelo de salida</label>
        <input id="numero_vuelo_salida" name="numero_vuelo_salida" value="{{old('numero_vuelo_salida')}}" type="text" required><br>
      
        <label for="hora_recogida">Hora de recogida del hotel</label>
        <input id="hora_recogida" name="hora_recogida" value="{{old('hora_recogida')}}" type="time" required><br>
    </div>
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