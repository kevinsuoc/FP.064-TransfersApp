@include( 'head')

<div class = "main-container">
    @include('header')
    <p>reservas</p>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{route('reserva.create')}}">
            @csrf
            <button type="submit">Agregar reserva</button>
    </form>

    @foreach ($reservas as $reserva)
    <div>
            <p>Datos generales</p>
            <p><strong>Reservador: </strong>
            @if ($reserva->id_viajero)
                Viajero {{$reserva->viajero()->email}}
            @elseif ($reserva->id_hotel)
                Hotel {{$reserva->hotel()->usuario}}
            @else
                Administrador
            @endif
            </p>

            <p><strong>Tipo de reserva: </strong>{{ $reserva->tipoReserva->descripcion }}</p>
            <p><strong>Localizador: </strong>{{ $reserva->localizador }}</p>
            <p><strong>Email del cliente: </strong>{{ $reserva->email_cliente }}</p>
            <p><strong>Fecha cuando se realizó la reserva: </strong>{{ $reserva->fecha_reserva }}</p>
            <p><strong>Última fecha de modificación: </strong>{{ $reserva->fecha_modificacion }}</p>
            <p><strong>Número de viajeros: </strong>{{ $reserva->num_viajeros }}</p>
            <p><strong>Vehículo: </strong>{{ $reserva->precio->vehiculo->descripcion }}</p>
            <p><strong>Email conductor: </strong>{{ $reserva->precio->vehiculo->email_conductor }}</p>
            <P><strong>Precio: </strong>{{ $reserva->precio->precio }}</P>
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

            <form action="{{route('reserva.edit',$reserva->id_reserva)}}">
                @csrf
                <button type="submit">Editar</button>
            </form>
            <form action="{{route('reserva.destroy', $reserva->id_reserva)}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Borrar</button>
            </form>
    </div><br>
    @endforeach

</div>