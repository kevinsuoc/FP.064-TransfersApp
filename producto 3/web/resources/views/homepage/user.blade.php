@include('head')

<div class = "main-container">
@include('header')
<div class="d-flex justify-content-center mt-4">
            <h1>¡Bienvenido!</h1>
</div>
<div class="container mt-5 mb-5 p-4 shadow-sm rounded" style="max-width: 400px; background: #f8f9fa;">
        <div class="d-flex justify-content-center">
            <h2 class="mb-2 p-2">Panel de control</h2>
        </div>
        <div class="d-flex justify-content-around mt-2 p-4">
            <form action="{{ route('userReserva.index') }}" class="w-50 d-flex justify-content-center" >
                @csrf
                <button type="submit" class="btn-bd-primary w-75">Reservas</button>
            </form>

            <form action="{{ route('perfil.show', $viajero->id_viajero) }}" class="w-50 d-flex justify-content-center">
                @csrf
                <button type="submit" class="btn-bd-primary w-75">Perfil</button>
            </form>
        </div>
    </div>
</div>
