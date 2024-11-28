@include('head')

<div class = "main-container">
@include('header')
<p>Hoteles</p>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<form action="{{route('hotel.create')}}">
        @csrf
        <button type="submit">Agregar hotel</button>
</form>

@foreach ($hoteles as $hotel)
<div>
    <p><strong>Zona: </strong>{{$hotel->zona->descripcion}}</p>
    <p><strong>Comision: </strong>{{$hotel->comision}} %</p>
    <p><strong>Usuario: </strong>{{$hotel->usuario}}</p>
    <form action="{{route('hotel.edit',$hotel->id_hotel)}}">
        @csrf
        <button type="submit">Editar</button>
    </form>
    <form action="{{route('hotel.destroy', $hotel->id_hotel)}}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Borrar</button>
    </form>
</div><br>
@endforeach

</div>