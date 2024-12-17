@include( 'head')

<div class = "main-container">
    @include('header')
    <div class="container mt-5 p-4 shadow-sm rounded" style="max-width: 600px; background: #f8f9fa;">
    <h2 class="mb-4 text-center">Editar zona</h2>

     <div>
                    <form action="{{ route('zona.update', $zona->id_zona) }}" method="POST" class="d-flex flex-column align-items-center">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <input value="{{ $zona->descripcion }}" class="form-control" name="descripcion" type="text" required>
                    </div>

                    <button type="submit" class="btn-bd-primary mt-3">Aceptar</button>

                    @if (session('success'))
                        <div class="alert alert-success mt-3">
                            {{ session('success') }}
                        </div>
                    @endif

                  
                </form>

            <form action="{{ route('zona.index') }}" class="list-group-item mt-4">
                @csrf
                <button type="submit" class="btn-bd-primary w-100">Panel Zonas</button>
            </form>
        </div>
    </div>
</div>

