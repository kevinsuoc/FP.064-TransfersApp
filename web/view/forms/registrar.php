<form action="/" method="post">
	<p>Datos de viajero</p>

	<label for="nombreViajero">Nombre</label>
	<input type="text" name="nombreViajero" id="nombreViajero" required><br>

	<label for="apellido1Viajero">Primer apellido</label>
	<input type="text" name="apellido1Viajero" id="apellido1Viajero" required><br>

	<label for="apellido2Viajero">Segundo apellido</label>
	<input type="text" name="apellido2Viajero" id="apellido2Viajero"><br>

	<label for="direccionViajero">Direccion</label>
	<input type="text" name="direccionViajero" id="direccionViajero" required><br>

	<label for="codigoPostal">Codigo postal</label>
	<input type="number" name="codigoPostal" id="codigoPostal" required><br>

	<label for="ciudadViajero">Ciudad</label>
	<input type="text" name="ciudadViajero" id="ciudadViajero" required><br>

	<label for="paisViajero">Pais</label>
	<input type="text" name="paisViajero" id="paisViajero" required><br>

	<label for="emailViajero">Email</label>
	<input type="email" name="emailViajero" id="emailViajero" required><br>

	<label for="passwordViajero">Password</label>
	<input type="password" name="passwordViajero" id="passwordViajero" required><br>

	<input type="hidden" name="request" value="registrarse">
	<button type="submit">Registrarse</button><br>
	<?php if (isset($registrarError)){echo $registrarError;}; ?>
</form>


<a href="/">Volver</a>
