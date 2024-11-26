@include( 'head')

<div class = "main-container">
    @include('header')
    <p>Vehiculos</p>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{route('vehiculo.create')}}">
            @csrf
            <button type="submit">Agregar vehiculo</button>
    </form>

    @foreach ($vehiculos as $vehiculo)
    <div>
            <p><strong>Descripción: </strong>{{$vehiculo->descripcion}}</p>
            <p><strong>Email conductor: </strong>{{$vehiculo->email_conductor}}</p>
            <form action="{{route('vehiculo.edit',$vehiculo->id_vehiculo)}}">
                @csrf
                <button type="submit">Editar</button>
            </form>
            <form action="{{route('vehiculo.destroy', $vehiculo->id_vehiculo)}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Borrar</button>
            </form>
    </div><br>
    @endforeach

</div>