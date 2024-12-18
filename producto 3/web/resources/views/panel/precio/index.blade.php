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

    @if (session('error'))
        <div class="alert alert-warning">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{route('precio.create')}}" class="d-flex justify-content-center">
            @csrf
            <button type="submit"class="btn-bd-primary center" >Agregar precio</button>
    </form>

    @foreach ($precios as $precio)
    <div class="mt-4 p-3 mb-4 border rounded">
        <p><strong>Hotel: </strong>{{$precio->hotel->usuario}}</p>
        <p><strong>Vehiculo: </strong>{{$precio->vehiculo->descripcion}}, {{$precio->vehiculo->email_conductor}}</p>
        <p><strong>Precio: </strong>{{$precio->precio}}</p>
        <div class="mt-4 d-flex container justify-content-left">
            <form action="{{route('precio.edit',$precio->id_precio)}}">
                @csrf
                <button type="submit" class="btn-bd-primary mr-2">Editar</button>
            </form>
            <form action="{{route('precio.destroy', $precio->id_precio)}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit"class="btn-bd-primary mr-2">Borrar</button>
            </form>
        </div>
    </div>
    @endforeach
</div>
</div>
</div>
</div>
