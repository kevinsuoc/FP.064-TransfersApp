<p>Aeropuerto -> Hotel</p>

<br>
<form action="/" method="post">
	<p>Datos de la reserva</p>
	<label for="diaLlegada">Dia de llegada</label>
	<input type="date" name="diaLlegada" id="diaLlegada" required><br>

	<label for="diaLlegada">Hora de llegada</label>
	<input type="time" name="horaLlegada" id="horaLlegada" required><br>

	<label for="numeroVuelo">Numero de vuelo</label>
	<input type="number" name="numeroVuelo" id="numeroVuelo" required><br>

	<label for="aeropueroOrigen">Aeropuerto de origen</label>
	<input type="text" name="aeropueroOrigen" id="aeropueroOrigen" required><br>

	<label for="hotelDestino">Hotel de destino</label>
	<input type="text" name="hotelDestino" id="hotelDestino" required><br>

	<label for="numeroViejeros">Numero de viajeros</label>
	<input type="number" name="numeroViejeros" id="numeroViejeros" required><br>

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

	<input type="hidden" name="request" value="reservar">
	<input type="hidden" name="tipoReserva" value="<?php echo $tipoReserva?>">
	<button type="submit">Reservar</button><br>
	<?php if (isset($errorReserva)){echo $errorReserva;}; ?>
</form>
<br>


<a href="/">Volver</a>
