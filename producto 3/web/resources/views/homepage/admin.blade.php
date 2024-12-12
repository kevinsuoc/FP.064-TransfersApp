@include('head')

<div class="main-container">
    @include('header')
    <div class="container mt-5 p-4 shadow-sm rounded" style="max-width: 400px; background: #f8f9fa;">
        <h2 class="mb-4 text-center">Panel de Control</h2>
        <div class="list-group">
            
            <form action="{{ route('trayectos.index') }}" class="list-group-item border-0 p-2">
                @csrf
                <button type="submit" class=" btn-bd-primary w-100">Calendario de trayectos</button>
            </form>

            <form action="{{ route('reserva.index') }}" class="list-group-item border-0 p-2">
                @csrf
                <button type="submit" class=" btn-bd-primary w-100">Panel Reservas</button>
            </form>

            <form action="{{ route('vehiculo.index') }}" class="list-group-item border-0 p-2">
                @csrf
                <button type="submit" class=" btn-bd-primary w-100">Panel Vehículos</button>
            </form>

            <form action="{{ route('hotel.index') }}" class="list-group-item border-0 p-2">
                @csrf
                <button type="submit" class="btn-bd-primary w-100">Panel Hoteles</button>
            </form>

            <form action="{{ route('zona.index') }}" class="list-group-item border-0 p-2">
                @csrf
                <button type="submit" class="btn-bd-primary w-100">Panel Zonas</button>
            </form>

            <form action="{{ route('precio.index') }}" class="list-group-item border-0 p-2">
                @csrf
                <button type="submit" class=" btn-bd-primary w-100">Panel Precios</button>
            </form>
        </div>
    </div>
</div>
