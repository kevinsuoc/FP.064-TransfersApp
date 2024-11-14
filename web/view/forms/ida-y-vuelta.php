<p>Aeropuerto -> Hotel</p>

<br>
<form action="/" method="post">
	<p>Datos de la reserva</p>
	<p> Ida </p>
	<label for="diaLlegada">Dia de llegada</label>
	<input type="date" name="fecha_entrada" id="diaLlegada" required><br>

	<label for="diaLlegada">Hora de llegada</label>
	<input type="time" name="hora_entrada" id="horaLlegada" required><br>

	<label for="numeroVuelo">Numero de vuelo</label>
	<input type="number" name="numero_vuelo_entrada" id="numeroVuelo" required><br>

	<label for="aeropueroOrigen">Aeropuerto de origen</label>
	<input type="text" name="origen_vuelo_entrada" id="aeropueroOrigen" required><br>

	<p> Vuelta </p>

	<label for="fecha_vuelo_salida">Dia del vuelo</label>
	<input type="date" name="fecha_vuelo_salida" id="fecha_vuelo_salida" required><br>

	<label for="hora_vuelo_salida">Hora del vuelo</label>
	<input type="time" name="hora_vuelo_salida" id="hora_vuelo_salida" required><br>

	<label for="numero_vuelo_salida">Numero de vuelo</label>
	<input type="number" name="numero_vuelo_salida" id="numero_vuelo_salida" required><br>

	<label for="hora_recogida">Hora de recogida</label>
	<input type="time" name="hora_recogida" id="hora_recogida" required><br>

	<p> Compartidos </p>

	<label for="id_destino">Destino/Origen (Hotel): </label>
	<select id="id_destino" name="id_destino">
	<?php 
		foreach ($destinos as $destino){
			echo '<option value="'.$destino->getIdHotel().'">'.$destino->getUsuario().'</option>';
		}
	?>
	</select><br>

	<label for="numeroViejeros">Numero de viajeros</label>
	<input type="number" name="num_viajeros" id="numeroViejeros" required><br>

	<label for="email">Email</label>
	<input type="email" name="email_cliente" id="email" required 
	<?php 
		if (isset($email)){echo ' readonly value="'.$email.'"';};
	?>
	><br>

	<input type="hidden" name="request" value="reservar">
	<input type="hidden" name="tipoReserva" value="<?php echo $tipoReserva?>">
	<button type="submit">Reservar</button><br>
	<?php if (isset($errorReserva)){echo $errorReserva;}; ?>
</form>
<br>


<a href="/">Volver</a>


<a href="/">Volver</a>
