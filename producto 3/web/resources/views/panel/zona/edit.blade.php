@include( 'head')

<div class = "main-container">
    @include('header')
    <p>Editar zona</p>

    <div>
        <form action="{{route('zona.update',$zona->id_zona)}}" method="POST">
            @csrf
            @method('PUT')
            <label for="descripcion">Descripción</label>
            <input value="{{$zona->descripcion}}" type="text" name="descripcion" id="descripcion" required>
            <button type="submit">Aceptar</button>
            @error('descripcion', 'validacion')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </form>
        <form action="{{ route('zona.index') }}" class="list-group-item">
                @csrf
                <button type="submit" class="btn btn-info w-100">Panel Zonas</button>
        </form>
    </div>
</div>