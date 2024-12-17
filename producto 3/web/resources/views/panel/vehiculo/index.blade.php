@include( 'head')

<div class = "main-container">
    @include('header')
    <div class="container mt-5 p-4 shadow-sm rounded" style="max-width: 400px; background: #f8f9fa;">
    <h2 class="mb-4 text-center">Vehículos</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{route('vehiculo.create')}}">
            @csrf
            <button type="submit"class="btn-bd-primary">Agregar vehiculo</button>
    </form>

    @foreach ($vehiculos as $vehiculo)
    <div>
    <div class="mt-4">
        <h5>Vehículo:</h5>
            <p><strong>Descripción: </strong>{{$vehiculo->descripcion}}</p>
            <p><strong>Email conductor: </strong>{{$vehiculo->email_conductor}}</p>
            <form action="{{route('vehiculo.edit',$vehiculo->id_vehiculo)}}"class="d-inline-block me-2>
                @csrf
                <button type="submit"class="btn-bd-primary">Editar</button>
            </form>
            <form action="{{route('vehiculo.destroy', $vehiculo->id_vehiculo)}}" class="d-inline-block" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit"class="btn-bd-primary">Borrar</button>
            </form>
    </div><br>
    @endforeach

</div>
</div>