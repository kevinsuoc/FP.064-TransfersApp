@include( 'head')

<div class = "main-container">
    @include('header')
    <div class="container mt-5 p-4 shadow-sm rounded" style="max-width: 500px; background: #f8f9fa;">
        <form action="{{route('reserva.index')}}" class="form-group">
            @csrf
            <label for="mes">Mes</label>
            <input class="form-control" id="mes" name="mes" type="number" min="1" max="12" @if(isset($mes)) value="{{$mes}}" @endif required>

            <label for="anyo">Año</label>
            <input class="form-control" id="anyo" name="anyo" type="number" min="2020" max="2050" @if(isset($anyo)) value="{{$anyo}}" @endif required>

            <label for="id_hotel">Hotel</label>
            <select name="id_hotel"  class="form-select" required>
                <option disabled selected value="">Selecciones un hotel</option>
                @foreach($hoteles as $hotelSelect)
                <option value="{{$hotelSelect->id_hotel}}" @if(isset($id_hotel) && $id_hotel == $hotelSelect->id_hotel) selected @endif>
                Hotel: {{$hotelSelect->usuario}} Comision: {{$hotelSelect->comision}} %
                </option>
                @endforeach
            </select>

            @if(isset($totalComisiones))
            <div class="mt-4">
                <p>Total de comisiones de este mes: {{$totalComisiones}}</p>
            </div>
            @endif

            <div class="d-flex justify-content-center mt-3">
                <button class="btn-bd-primary" type="submit">Ver reservas del mes del hotel y comisiones</button><br>
            </div>
        </form>
        <form action="{{route('reserva.index')}}" class="form-group">
            @csrf
            <button class="btn-bd-primary" type="submit">Ver todas las reservas</button><br>
        </form>
    </div>
    
    <div class="container mt-5 p-4 shadow-sm rounded" style="max-width: 500px; background: #f8f9fa;">
    <h2 class="mb-4 text-center">Reservas</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{route('reserva.create')}}">
            @csrf
        <div class="d-flex justify-content-center mb-4">
            <button type="submit" class="btn-bd-primary">Agregar reserva</button>
        </div>
    </form>

    @foreach ($reservas as $reserva)
    <div class="p-3 mb-4 border rounded">
    <div id="todos_los_tipos" class="p-3 mb-4 border rounded">
    <h3 class="mb-3">Datos generales - reserva</h3>
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
            @if(isset($hotel))
                <p><strong>Comision: </strong>{{ $hotel->comision }} %</p>
                @if($reserva->id_hotel && $reserva->id_tipo_reserva != 3)
                    <p><strong>Comision total: </strong>{{ ($hotel->comision / 100.) * $reserva->precio->precio}}</p>
                @elseif($reserva->id_hotel)
                    <p><strong>Comision ida: </strong>{{ ($hotel->comision / 100.) * $reserva->precio->precio}}</p>
                    <p><strong>Comision vuelta: </strong>{{ ($hotel->comision / 100.) * $reserva->precio->precio}}</p>
                @endif
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
            </div>
            <div id="todos_los_tipos" class="p-3 mb-4 border rounded">
            <h3 class="mb-3">Datos de ida</h3>
            <p><strong>Fecha de llegada al aeropuerto: </strong>{{$reserva->fecha_entrada}}</p>
            <p><strong>Hora de llegada al aeropuerto: </strong>{{$reserva->hora_entrada}}</p>
            <p><strong>Numero de vuelo: </strong>{{$reserva->numero_vuelo_entrada}}</p>
            <p><strong>Aeropuerto de origen: </strong>{{$reserva->origen_vuelo_entrada}}</p>
            @endif
            @if ($reserva->id_tipo_reserva == 2 || $reserva->id_tipo_reserva == 3)
            </div>
            <div id="todos_los_tipos" class="p-3 mb-4 border rounded">
            <h3 class="mb-3">Datos de vuelta</h3>
            <p><strong>Fecha de departura: </strong>{{$reserva->fecha_salida}}</p>
            <p><strong>Hora de departura: </strong>{{$reserva->hora_salida}}</p>
            <p><strong>Hora de recogida en hotel: </strong>{{$reserva->hora_recogida}}</p>
            <p><strong>Numero de vuelo: </strong>{{$reserva->numero_vuelo_salida}}</p>
            @endif


    </div>
            <form action="{{route('reserva.edit',$reserva->id_reserva)}}"class="d-inline-block me-2">
                @csrf
                <button type="submit"class="btn-bd-primary">Editar</button>
            </form>
            <form action="{{route('reserva.destroy', $reserva->id_reserva)}}"class="d-inline-block"method="POST">
                @csrf
                @method('DELETE')
                <button type="submit"class="btn-bd-primary">Borrar</button>
            </form>
    </div>
    @endforeach

</div>
</div>
