@include( 'head')

<div class = "main-container">
    @include('header')
    <div class="container mt-5 p-4 shadow-sm rounded" style="max-width: 600px; background: #f8f9fa;">
        <h2 class="mb-4 text-center">Crear zona</h2>

        <div>
            <form action="{{route('zona.store')}}" method="POST">
                @csrf
                @method('POST')
                
                <div class="form-group">
                    <label for="descripcion" value="{{ old('descripcion') }}">Descripción</label>
                    <input type="text" name="descripcion"  class="form-control" id="descripcion" required>
                </div>

                @error('descripcion', 'validacion')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn-bd-primary mt-3">Crear</button>
                </div>

            </form>
            <form action="{{ route('zona.index') }}" class="list-group-item mt-4">
                    @csrf
                    <button type="submit" class="btn-bd-primary w-100">Panel Zonas</button>
            </form>
        </div>
    </div>
</div>
