@include('head')

<div class = "main-container">
@include('header')
    <div class="container mt-4">
        <h2>Panel de control</h2>
        <div class="list-group">


            <!-- <form action="{{ route('reserva.index') }}" class="list-group-item"> -->
            <form action="" class="list-group-item">
                @csrf
                <button type="submit" class="btn btn-info w-100">Panel reservas</button>
            </form>

            <form action="{{ route('perfil.show', $viajero->id_viajero) }}" class="list-group-item">
                @csrf
                <button type="submit" class="btn btn-info w-100">Perfil</button>
            </form>
        </div>
    </div>
</div>
