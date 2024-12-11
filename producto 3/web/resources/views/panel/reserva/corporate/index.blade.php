@include( 'head')

<div class = "main-container">
    @include('header')

    <div>
        <p>Hotel: {{session('user')->usuario}}</p>
        <p>Comision: {{session('user')->comision}} %</p>
        @if(isset($totalComisiones))
        <p>Total de comisiones de este mes: {{$totalComisiones}}</p>
        @endif
        <form action="{{route('corporateReserva.index')}}">
            @csrf
            <label for="mes">Mes</label>
            <input id="mes" name="mes" type="number" min="1" max="12" @if(isset($mes)) value="{{$mes}}" @endif>

            <label for="anyo">Año</label>
            <input id="anyo" name="anyo" type="number" min="2020" max="2050" @if(isset($anyo)) value="{{$anyo}}" @endif>

            <button type="submit">Ver reservas del mes y suma de comisiones</button><br>
        </form>
        <form action="{{route('corporateReserva.index')}}">
            @csrf
            <button type="submit">Ver todas las reservas</button><br>
        </form>
    </div>
    <p>reservas</p>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{route('corporateReserva.create')}}">
            @csrf
            <button type="submit">Agregar reserva</button>
    </form>

    
	@error('fecha', 'validacion')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    @foreach ($reservas as $reserva)
    <div>
            <p>Datos generales</p>
            <p><strong>Reservador: </strong>
            @if ($reserva->id_viajero)
                {{$reserva->viajero->email}}
            @elseif ($reserva->id_hotel)
                {{$reserva->hotel->usuario}}
            @else
                Administrador
            @endif
            </p>

            <P><strong>Precio: </strong>{{ $reserva->precio->precio }}</P>
            @if($reserva->id_hotel && $reserva->id_tipo_reserva != 3)
            <p><strong>Comision: </strong>{{ (session('user')->comision / 100.) * $reserva->precio->precio}}</p>
            @elseif($reserva->id_hotel)
            <p><strong>Comision ida: </strong>{{ (session('user')->comision / 100.) * $reserva->precio->precio}}</p>
            <p><strong>Comision vuelta: </strong>{{ (session( 'user')->comision / 100.) * $reserva->precio->precio}}</p>
            <br>
            @endif

            <p><strong>Tipo de reserva: </strong>{{ $reserva->tipoReserva->descripcion }}</p>
            <p><strong>Localizador: </strong>{{ $reserva->localizador }}</p>
            <p><strong>Email del cliente: </strong>{{ $reserva->email_cliente }}</p>
            <p><strong>Fecha cuando se realizó la reserva: </strong>{{ $reserva->fecha_reserva }}</p>
            <p><strong>Última fecha de modificación: </strong>{{ $reserva->fecha_modificacion }}</p>
            <p><strong>Número de viajeros: </strong>{{ $reserva->num_viajeros }}</p>
            <p><strong>Vehículo: </strong>{{ $reserva->precio->vehiculo->descripcion }}</p>
            <p><strong>Email conductor: </strong>{{ $reserva->precio->vehiculo->email_conductor }}</p>
            <p><strong>Hotel: </strong>{{ $reserva->precio->hotel->usuario }}</p>
            <p><strong>Zona: </strong>{{ $reserva->precio->hotel->zona->descripcion }}</p>

            @if ($reserva->id_tipo_reserva == 1 || $reserva->id_tipo_reserva == 3)
            <p>Datos de ida</p>
            <p><strong>Fecha de llegada al aeropuerto: </strong>{{$reserva->fecha_entrada}}</p>
            <p><strong>Hora de llegada al aeropuerto: </strong>{{$reserva->hora_entrada}}</p>
            <p><strong>Numero de vuelo: </strong>{{$reserva->numero_vuelo_entrada}}</p>
            <p><strong>Aeropuerto de origen: </strong>{{$reserva->origen_vuelo_entrada}}</p>
            @endif
            @if ($reserva->id_tipo_reserva == 2 || $reserva->id_tipo_reserva == 3)
            <p>Datos de vuelta</p>
            <p><strong>Fecha de departura: </strong>{{$reserva->fecha_salida}}</p>
            <p><strong>Hora de departura: </strong>{{$reserva->hora_salida}}</p>
            <p><strong>Hora de recogida en hotel: </strong>{{$reserva->hora_recogida}}</p>
            <p><strong>Numero de vuelo: </strong>{{$reserva->numero_vuelo_salida}}</p>
            @endif

            <form action="{{route('corporateReserva.edit',$reserva->id_reserva)}}">
                @csrf
                <button type="submit">Editar</button>
            </form>
            <form action="{{route('corporateReserva.destroy', $reserva->id_reserva)}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Borrar</button>
            </form>
    </div><br>
    @endforeach

</div>
