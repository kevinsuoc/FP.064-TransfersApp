@include( 'head')

<div class = "main-container">
    @include('header')
    <div class="container mt-5 p-4 shadow-sm rounded" style="max-width: 400px; background: #f8f9fa;">
    <h2 class="mb-4 text-center">Reservas</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{route('reserva.create')}}">
            @csrf
            <button type="submit" class="btn-bd-primary">Agregar reserva</button>
    </form>

    @foreach ($reservas as $reserva)
    <div class="mt-4">
    <h5>Reserva:</h5>
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

            <form action="{{route('reserva.edit',$reserva->id_reserva)}}"class="d-inline-block me-2">
                @csrf
                <button type="submit"class="btn-bd-primary">Editar</button>
            </form>
            <form action="{{route('reserva.destroy', $reserva->id_reserva)}}"class="d-inline-block"method="POST">
                @csrf
                @method('DELETE')
                <button type="submit"class="btn-bd-primary">Borrar</button>
            </form>
    </div><br>
    @endforeach

</div>
</div>