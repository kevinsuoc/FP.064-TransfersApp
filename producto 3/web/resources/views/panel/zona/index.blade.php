@include( 'head')

<div class = "main-container">
    @include('header')
    <div class="container mt-5 p-4 shadow-sm rounded" style="max-width: 400px; background: #f8f9fa;">
        <h2 class="mb-4 text-center">Zonas</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{route('zona.create')}}">
            @csrf
            <button type="submit"class="btn-bd-primary" style="display: block; margin: 0 auto;">Agregar zona</button>
    </form>

    @foreach ($zonas as $zona)
    <div class="mt-4">
        <h5>Zona:</h5>
        <p><strong>Descripción: </strong>{{$zona->descripcion}}</p>
        <div style="display: flex; justify-content: center; gap: 15px; margin-top: 10px;">
            <form action="{{route('zona.edit', $zona->id_zona)}}" method="GET">
                @csrf
                <button type="submit" class="btn-bd-primary">Editar</button>
            </form>
            <form action="{{route('zona.destroy', $zona->id_zona)}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-bd-primary">Borrar</button>
            </form>
        </div>
    </div>
 </div><br>
    @endforeach

</div>
</div>