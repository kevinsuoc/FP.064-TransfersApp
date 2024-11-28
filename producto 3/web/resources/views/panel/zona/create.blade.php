@include( 'head')

<div class = "main-container">
    @include('header')
    <p>Crear zona</p>

    <div>
        <form action="{{route('zona.store')}}" method="POST">
            @csrf
            @method('POST')
            <label for="descripcion" value="{{ old('descripcion') }}">Descripción</label>
            <input type="text" name="descripcion" id="descripcion" required>
            <button type="submit">Crear</button>
            @error('descripcion', 'validacion')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </form>
        <form action="{{ route('zona.index') }}" class="list-group-item">
                @csrf
                <button type="submit" class="btn btn-info w-100">Panel Zonas</button>
        </form>
    </div>
</div>