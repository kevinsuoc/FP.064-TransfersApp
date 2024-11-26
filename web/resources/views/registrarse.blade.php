@include('head')

<div class="main-container">
    @include('header')

    <div class="form-container-register paginaRegistro">
        <form action="{{ route('registrarRegular') }}" class="register-form" method="POST">
            @csrf
            @method('POST')

            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach

            @error('error-registro')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <h3>Datos de viajero</h3>
            </div>
            <div class="form-group">
                <p>
                    Por favor, rellena los datos de registro
                </p>
            </div>
            <div class="form-group">
                <div class="form-field">
                <label for="nombre" class="form-label">Nombre</label>
                </div>
                <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" class="form-control-register" placeholder="Nombre de viajero" required><br>
            </div>
            @error('nombre', 'error-registro')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <div class="form-field">
                    <label for="apellido1" class="form-label">Primer apellido</label>
                </div>
                <input type="text" name="apellido1" id="apellido1" value="{{ old('apellido1') }}" class="form-control-register" placeholder="Primer apellido de viajero" required><br>
            </div>
            @error('apellido1', 'error-registro')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <div class="form-field">
                <label for="apellido2" class="form-label">Segundo apellido</label>
                </div>
                <input type="text" name="apellido2" id="apellido2" value="{{ old('apellido2') }}" class="form-control-register" placeholder="Segundo apellido de viajero"><br>
            </div>
            @error('apellido2', 'error-registro')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <div class="form-field">
                <label for="direccion" class="form-label">Direccion</label>
                </div>
                <input type="text" name="direccion" id="direccion" value="{{ old('direccion') }}" class="form-control-register" placeholder="dirección del viajero" required><br>
            </div>
            @error('direccion', 'error-registro')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <div class="form-field">
                <label for="codigo_postal" class="form-label">Codigo postal</label>
                </div>
                <input type="text" name="codigo_postal" id="codigo_postal" value="{{ old('codigo_postal') }}" class="form-control-register" placeholder="Código Postal" required><br>
            </div>
            @error('codigo_postal', 'error-registro')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <div class="form-field">
                <label for="ciudad" class="form-label">Ciudad</label>
                </div>
                <input type="text" name="ciudad" id="ciudad" value="{{ old('ciudad') }}"  class="form-control-register" placeholder="Ciudad del viajero" required><br>
            </div>
            @error('ciudad', 'error-registro')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <div class="form-field">
                <label for="pais" class="form-label">Pais</label>
                </div>
                <input type="text" name="pais" id="pais"  value="{{ old('pais') }}" class="form-control-register" placeholder="País del viajero" required><br>
            </div>
            @error('pais', 'error-registro')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <div class="form-field">
                <label for="email" class="form-label">Email</label>
                </div>
                <input type="email" name="email" id="email" value="{{ old('email') }}"  class="form-control-register" placeholder="Email"required><br>
            </div>
            @error('email', 'error-registro')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <div class="form-field">
                <label for="password" class="form-label">Password</label>
                </div>
                <input type="password" class="form-control-register" id="password" name= "password" placeholder="Contraseña" required><br>
            </div>
            <div class="form-group">
                <div class="form-field">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                </div>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control-register" placeholder="Confirm Password" required><br>
            </div>
            @error('password', 'error-registro')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <button type="submit" class="btn-bd-primary">Registrarse</button><br>
            </div>
            
        </form>
    </div>
</div>

