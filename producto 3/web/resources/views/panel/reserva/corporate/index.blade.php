@include( 'head')

<div class = "main-container">
    @include('header')
    <div class="container mt-5 p-4 shadow-sm rounded" style="max-width: 500px; background: #f8f9fa;">
    <h2 class="mb-4 text-center">Información y consulta de reserva</h2>
    <div class="container mt-5 p-4 shadow-sm rounded">
        <p>Hotel: {{session('user')->usuario}}</p>
        <p>Comision: {{session('user')->comision}} %</p>
        @if(isset($totalComisiones))
        <p>Total de comisiones de este mes: {{$totalComisiones}}</p>
        @endif
        <form action="{{route('corporateReserva.index')}}"class="d-inline-block me-2">
            @csrf
            <label class="form-label" for="mes">Mes</label>
            <input class="form-select mb-3" id="mes" name="mes" type="number" min="1" max="12" @if(isset($mes)) value="{{$mes}}" @endif>

            <label class="form-label" for="anyo">Año</label>
            <input class="form-select mb-3" id="anyo" name="anyo" type="number" min="2020" max="2050" @if(isset($anyo)) value="{{$anyo}}" @endif>
            <div class="row gy-5">
            <div class="col-6">
            <button class="btn-bd-primary" type="submit">Ver reservas del mes y suma de comisiones</button><br>
        </form>
        
        <form action="{{route('corporateReserva.index')}}">
            @csrf
</div>
            <div class="col-6">
            <button class="btn-bd-primary" type="submit">Ver todas las reservas</button><br>
        </form>
</div>
</div>
</div>
    <div class="container mt-5 p-4 shadow-sm rounded">
    <h2 class="mb-4 text-center">Reservas</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{route('corporateReserva.create')}}">
            @csrf
            <button class="btn-bd-primary" type="submit">Agregar reserva</button>
    </form>
</div>
    
	@error('fecha', 'validacion')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    @foreach ($reservas as $reserva)
    <div class="container mt-5 p-4 shadow-sm rounded">
    <h2 class="mb-4 text-center">Datos generales</h2>
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
            <div class="row gy-5">
            <div class="col-6">
            <form action="{{route('corporateReserva.edit',$reserva->id_reserva)}}">
                @csrf
             
                <button class="btn-bd-primary"type="submit">Editar</button>
            </form>
</div>
<div class="col-6">
            <form action="{{route('corporateReserva.destroy', $reserva->id_reserva)}}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn-bd-primary" type="submit">Borrar</button>
            </form>
</div>
</div>
    </div><br>
    @endforeach

</div>
