@include('head')

<div class = "main-container">
@include('header')
<div class="container mt-5 p-4 shadow-sm rounded" style="max-width: 400px; background: #f8f9fa;">
        <h2 class="mb-4 text-center">Hoteles</h2>

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

<form action="{{route('hotel.create')}}">
        @csrf
        <div class="d-flex justify-content-center">
        <button type="submit" class="btn-bd-primary">Agregar hotel</button>
        </div>
</form>

@foreach ($hoteles as $hotel)
<div class="mt-4 p-3 mb-4 border rounded">
    <p><strong>Zona: </strong>{{$hotel->zona->descripcion}}</p>
    <p><strong>Comision: </strong>{{$hotel->comision}} %</p>
    <p><strong>Usuario: </strong>{{$hotel->usuario}}</p>
    <form action="{{route('hotel.edit',$hotel->id_hotel)}}"class="d-inline-block me-2">
        @csrf
        <button type="submit"class="btn-bd-primary">Editar</button>
    </form>
    <form action="{{route('hotel.destroy', $hotel->id_hotel)}}" method="POST"class="d-inline-block">
        @csrf
        @method('DELETE')
        <button type="submit"class="btn-bd-primary">Borrar</button>
    </form>
</div>
@endforeach

</div>
</div>
