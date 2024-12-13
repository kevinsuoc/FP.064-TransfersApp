@include('head')

<div class="main-container">
    @include('header')

    <div class="containerfromwelcome">

        <div class="airlines-welcome">
            <div class="welcome-text">
                <h1>Bienvenido a Codecrafters Airlines, 
                    ¿listo para una nueva aventura?</h1>
            </div>
        </div>

        <div class="form-container">
            <div class="d-flex justify-content-center"> <!-- Usamos flexbox para centrar los formularios -->
                <div class="login-form mx-3"> <!-- Espaciado entre los formularios -->
                    <form action="/authenticateLogin" method="POST">
                        @csrf
                        @method('POST')

                        <div class="form-group">
                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                            <input type="text" class="form-control" name="username" placeholder="nombre de usuario" id="exampleInputEmail1" aria-describedby="emailHelp" required><br>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="contraseña" required><br>
                        </div>

                        <div class="d-flex justify-content-between">
                        <button type="submit" class="btn-bd-primary mb-3">Login</button>
                    </form>
                

                <!-- Espaciado entre los formularios -->
                    <form action="/registrarse">
                        @csrf
                        @method('GET')
                        <button type="submit" class="btn-register-btn">Registrarse</button>

                    </form>
                    </div>
                <div>
            </div> <!-- Cierre del d-flex -->

            @error('username')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror

            @if (session('success'))
                <div id="success-message" class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

        </div>
    </div>
</div>
