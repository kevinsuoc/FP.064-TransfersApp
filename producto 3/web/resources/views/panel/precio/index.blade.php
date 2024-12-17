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

    <form action="{{route('precio.create')}}">
            @csrf
            <button type="submit"class="btn-bd-primary" >Agregar precio</button>
    </form>

    @foreach ($precios as $precio)
    <div class="mt-4">
            <p><strong>Hotel: </strong>{{$precio->hotel->usuario}}</p>
            <p><strong>Vehiculo: </strong>{{$precio->vehiculo->descripcion}}, {{$precio->vehiculo->email_conductor}}</p>
            <p><strong>Precio: </strong>{{$precio->precio}}</p>
            <div class="mt-4 d-flex container justify-content-between">
            <form action="{{route('precio.edit',$precio->id_precio)}}">
                @csrf
                <button type="submit"class="btn-bd-primary  ">Editar</button>
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
</div>
</div>