@include('head')

<div class="main-container">
    <div class="container mt-4">
        @include('header')

        <form action="{{ route('calendario.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="localizador">Localizador:</label>
                <input type="text" id="localizador" name="localizador" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="email">Email Viajero:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="fecha">Fecha:</label>
                <input type="date" id="fecha" name="fecha" class="form-control" required>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Crear Trayecto</button>
            </div>
        </form>
    </div>
</div>
