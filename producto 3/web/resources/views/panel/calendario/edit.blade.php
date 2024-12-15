@include('head')

<div class="main-container">
    <div class="container mt-4">
        @include('header')

        <form action="{{ route('calendario.update', $trayecto->id) }}" method="post">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="localizador">Localizador:</label>
                <input type="text" id="localizador" name="localizador" class="form-control" value="{{ $trayecto->localizador }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email Viajero:</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ $trayecto->email }}" required>
            </div>

            <div class="form-group">
                <label for="fecha">Fecha:</label>
                <input type="date" id="fecha" name="fecha" class="form-control" value="{{ $trayecto->fecha }}" required>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Actualizar Trayecto</button>
            </div>
        </form>
    </div>
</div>
