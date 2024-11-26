<header class="header-bar d-flex justify-content-between align-items-center">

    <h2 class="airlines-title">CODECRAFTER AIRLINES</h2> 

    <div>
        <a href="/" class="btn btn-primary">Homepage</a>

        @if(session('userType'))
        <a href="{{route('logout')}}" class="btn btn-warning">Desconectarse</a>
        @endif

    </div>
</header>