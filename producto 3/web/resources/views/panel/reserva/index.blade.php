@include( 'head')

<div class = "main-container">
    @include('header')
    <p>reservas</p>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{route('reserva.create')}}">
            @csrf
            <button type="submit">Agregar reserva</button>
    </form>

</div>