@include('head')

<div class = "main-container">
@include('header')
    <div class="container mt-4">
        <h2>Panel de control</h2>
        <div class="list-group">

            <form action="{{ route('calendario.index') }}" class="list-group-item">
                @csrf
                <button type="submit" class="btn btn-info w-100">Calendario de trayectos</button>
            </form>

            <form action="{{ route('reserva.index') }}" class="list-group-item">
                @csrf
                <button type="submit" class="btn btn-info w-100">Panel reservas</button>
            </form>

            <form action="{{ route('vehiculo.index') }}" class="list-group-item">
                @csrf
                <button type="submit" class="btn btn-info w-100">Panel vehiculos</button>
            </form>

            <form action="{{ route('hotel.index') }}" class="list-group-item">
                @csrf
                <button type="submit" class="btn btn-info w-100">Panel hoteles</button>
            </form>

            <form action="{{ route('zona.index') }}" class="list-group-item">
                @csrf
                <button type="submit" class="btn btn-info w-100">Panel Zonas</button>
            </form>

            <form action="{{ route('precio.index') }}" class="list-group-item">
                @csrf
                <button type="submit" class="btn btn-info w-100">Panel Precios</button>
            </form>

        </div>
    </div>
</div>
