@include( 'head')

<div class = "main-container">
    @include('header')
     <div class="container mt-5 p-4 shadow-sm rounded" style="max-width: 400px; background: #f8f9fa;">
        <h2 class="mb-4 text-center">Precios</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('precio.create') }}">
        @csrf
        <button type="submit" class="btn-bd-primary" style="display: block; margin: 0 auto;">Agregar precio</button>
    </form>
    
</div>
    @foreach ($precios as $precio)
    <div class="mt-4">
            <p><strong>Hotel: </strong>{{$precio->hotel->usuario}}</p>
            <p><strong>Vehiculo: </strong>{{$precio->vehiculo->descripcion}}, {{$precio->vehiculo->email_conductor}}</p>
            <p><strong>Precio: </strong>{{$precio->precio}}</p>
            <form action="{{route('precio.edit',$precio->id_precio)}}">
                @csrf
                <button type="submit"class="btn-bd-primary">Editar</button>
            </form>
            <form action="{{route('precio.destroy', $precio->id_precio)}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit"class="btn-bd-primary">Borrar</button>
            </form>
    </div><br>
    @endforeach

</div>
</div>