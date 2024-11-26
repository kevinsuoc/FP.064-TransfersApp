@include( 'head')

<div class = "main-container">
    @include('header')
    <p>Zonas</p>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{route('zona.create')}}">
            @csrf
            <button type="submit">Agregar zona</button>
    </form>

    @foreach ($zonas as $zona)
    <div>
            <p><strong>Descripción: </strong>{{$zona->descripcion}}</p>
            <form action="{{route('zona.edit',$zona->id_zona)}}">
                @csrf
                <button type="submit">Editar</button>
            </form>
            <form action="{{route('zona.destroy', $zona->id_zona)}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Borrar</button>
            </form>
    </div><br>
    @endforeach

</div>