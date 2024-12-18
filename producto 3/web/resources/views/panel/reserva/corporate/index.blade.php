@include( 'head')

<div class = "main-container">
    @include('header')
    <div class="container mt-5 p-4 shadow-sm rounded" style="max-width: 600px; background: #f8f9fa;">
        <h2 class="mb-4 text-center">Información y consulta de reserva</h2>
        <p class="mb-2"><strong>Hotel: </strong>{{session('user')->usuario}}</p>
        <p class="mb-3"><strong>Comision: </strong>{{session('user')->comision}} %</p>
        @if(isset($totalComisiones))
        <p>Total de comisiones de este mes: {{$totalComisiones}}</p>
        @endif
        <form action="{{route('corporateReserva.index')}}" class="form-group">
            @csrf
            <label for="mes">Mes</label>
            <input class="form-control mb-3" id="mes" name="mes" type="number" min="1" max="12" @if(isset($mes)) value="{{$mes}}" @endif>

            <label for="anyo">Año</label>
            <input class="form-control mb-3" id="anyo" name="anyo" type="number" min="2020" max="2050" @if(isset($anyo)) value="{{$anyo}}" @endif>
            <div class="d-flex justify-content-center">
                <button class="btn-bd-primary" type="submit">Ver reservas del mes y suma de comisiones</button>
            </div>
        </form>

        <form action="{{route('corporateReserva.index')}}">
            @csrf
            <div class="d-flex justify-content-center">
                <button class="btn-bd-primary" type="submit">Ver todas las reservas</button>
            </div>
        </form>
    </div>

    <div class="container mt-5 p-4 border rounded" style="max-width: 600px; background: #f8f9fa;">
        <div class="container mt-5 p-4 border rounded">
            <h2 class="mb-4 text-center">Reservas</h2>

            @if (session('success'))
            <div class="alert alert-success">
            {{ session('success') }}
            </div>
            @endif

            <form action="{{route('corporateReserva.create')}}">
                @csrf
                <div class="d-flex justify-content-center">
                <button class="btn-bd-primary" type="submit">Agregar reserva</button>
                </div>
            </form>

            @error('fecha', 'validacion')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        @foreach ($reservas as $reserva)
            <div class="container mt-5 p-3 border rounded">
                <h3>Reserva</h3>
                <div class="container mt-2 p-3 border rounded">
                    <h3>Datos generales</h3>
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
                </div>

                @if ($reserva->id_tipo_reserva == 1 || $reserva->id_tipo_reserva == 3)
                <div class="container mt-5 p-4 border rounded">
                    <h3>Datos de ida</h3>
                    <p><strong>Fecha de llegada al aeropuerto: </strong>{{$reserva->fecha_entrada}}</p>
                    <p><strong>Hora de llegada al aeropuerto: </strong>{{$reserva->hora_entrada}}</p>
                    <p><strong>Numero de vuelo: </strong>{{$reserva->numero_vuelo_entrada}}</p>
                    <p><strong>Aeropuerto de origen: </strong>{{$reserva->origen_vuelo_entrada}}</p>
                    
                </div>
                @endif

                @if ($reserva->id_tipo_reserva == 2 || $reserva->id_tipo_reserva == 3)
                <div class="container mt-5 p-4 border rounded">
                    <h3>Datos de vuelta</h3>
                    <p><strong>Fecha de departura: </strong>{{$reserva->fecha_salida}}</p>
                    <p><strong>Hora de departura: </strong>{{$reserva->hora_salida}}</p>
                    <p><strong>Hora de recogida en hotel: </strong>{{$reserva->hora_recogida}}</p>
                    <p><strong>Numero de vuelo: </strong>{{$reserva->numero_vuelo_salida}}</p>
                </div>
                @endif

                <div class="d-flex justify-content-around mt-4 w-100">
                    <form action="{{route('corporateReserva.edit',$reserva->id_reserva)}}" class="mr-4">
                        @csrf
                        <div class="d-flex justify-content-center">
                        <button class="btn-bd-primary"type="submit">Editar</button>
                        </div>
                    </form>

                    <form action="{{route('corporateReserva.destroy', $reserva->id_reserva)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="d-flex justify-content-center">
                        <button class="btn-bd-primary" type="submit">Borrar</button>
                        </div>
                    </form>
                </div>

            </div>
        @endforeach
    </div>
</div>
