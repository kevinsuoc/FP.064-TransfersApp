@include('head')

<div class = "main-container">
@include('header')
<div class="container mt-5 p-4 shadow-sm rounded" style="max-width: 400px; background: #f8f9fa;">
        <h2>Panel de control</h2>
        <div class="list-group">
            <form action="{{ route('userReserva.index') }}" class="list-group-item">
                @csrf
                <button type="submit" class="btn-bd-primary ">Panel reservas</button>
            </form>

            <form action="{{ route('perfil.show', $viajero->id_viajero) }}" class="list-group-item">
                @csrf
                <button type="submit" class="btn-bd-primary ">Perfil</button>
            </form>
        </div>
    </div>
</div>
