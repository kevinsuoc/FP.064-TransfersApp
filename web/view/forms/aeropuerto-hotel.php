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

	<label for="id_destino">Destino: </label>
	<select id="id_destino" name="id_destino">
	<?php 
		foreach ($destinos as $destino){
			echo '<option value="'.$destino[0].'">'.'Hotel '.$destino[0].': "'.$destino['descripcion'].'"</option>';
		}
	?>
	</select><br>

	<label for="numeroViejeros">Numero de viajeros</label>
	<input type="number" name="numeroViejeros" id="numeroViejeros" required><br>

	<label for="email">Email</label>
	<input type="email" name="email" id="email" required 
	<?php 
		if (isset($email)){echo ' disabled value="'.$email.'"';};
	?>
	><br>

	<input type="hidden" name="request" value="reservar">
	<input type="hidden" name="tipoReserva" value="<?php echo $tipoReserva?>">
	<button type="submit">Reservar</button><br>
	<?php if (isset($errorReserva)){echo $errorReserva;}; ?>
</form>
<br>


<a href="/">Volver</a>
