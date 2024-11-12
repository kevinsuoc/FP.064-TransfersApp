<div class="form-container-register">
<form action="/" method="post" class="register-form">
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
		<label for="nombreViajero" class="form-label">Nombre</label>
		</div>
		<input type="text" name="nombreViajero" id="nombreViajero" class="form-control-register" placeholder="Nombre de viajero" required><br>
	</div>
	<div class="form-group">
		<div class="form-field">
			<label for="apellido1Viajero" class="form-label">Primer apellido</label>
		</div>
		<input type="text" name="apellido1Viajero" id="apellido1Viajero" class="form-control-register" placeholder="Primer apellido de viajero" required><br>
	</div>
	<div class="form-group">
		<div class="form-field">
		<label for="apellido2Viajero" class="form-label">Segundo apellido</label>
		</div>
		<input type="text" name="apellido2Viajero" id="apellido2Viajero" class="form-control-register" placeholder="Segundo apellido de viajero"><br>
	</div>
	<div class="form-group">
		<div class="form-field">
		<label for="direccionViajero" class="form-label">Direccion</label>
		</div>
		<input type="text" name="direccionViajero" id="direccionViajero" class="form-control-register" placeholder="dirección del viajero" required><br>
	</div>
	<div class="form-group">
		<div class="form-field">
		<label for="codigoPostal" class="form-label">Codigo postal</label>
		</div>
		<input type="number" name="codigoPostal" id="codigoPostal" class="form-control-register" placeholder="Código Postal" required><br>
	</div>

	<div class="form-group">
		<div class="form-field">
		<label for="ciudadViajero" class="form-label">Ciudad</label>
		</div>
		<input type="text" name="ciudadViajero" id="ciudadViajero"  class="form-control-register" placeholder="Ciudad del viajero" required><br>
	</div>
	<div class="form-group">
		<div class="form-field">
		<label for="paisViajero" class="form-label">Pais</label>
		</div>
		<input type="text" name="paisViajero" id="paisViajero"  class="form-control-register" placeholder="País del viajero" required><br>
	</div>
	<div class="form-group">
		<div class="form-field">
		<label for="emailViajero" class="form-label">Email</label>
		</div>
		<input type="email" name="emailViajero" id="emailViajero"  class="form-control-register" placeholder="Email"required><br>
	</div>
	<div class="form-group">
		<div class="form-field">
		<label for="passwordViajero" class="form-label">Password</label>
		</div>
		<input type="password" class="form-control-register" id="passwordViajero" name= "passwordViajero" placeholder="Contraseña" required><br>
	</div>

	<input type="hidden" name="request" value="registrarse">
	<div class="form-group">
		<button type="submit" class="btn-bd-primary">Registrarse</button><br>
	</div>

	<?php if (isset($registrarError)){echo $registrarError;}; ?>

</form>
<form action="/" class="return-button">
    <input type="hidden" name="request" value="return_login"> 
    <button type="submit" value="return_login" class="btn-bd-primary">Volver</button> <br>
	</form>
</div>

