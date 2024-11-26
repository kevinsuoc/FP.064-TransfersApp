<div class="form-container-register">
<form action="/" method="post" class="register-form">
	<div class="form-group">
		<h3>Reserva de aeropuerto a hotel</h3>
	</div>

	<div class="form-group">
		<div class="form-field">
			<label for="diaLlegada" class="form-label">Dia de llegada</label>
		</div>
		<input type="date" name="fecha_entrada" id="diaLlegada" class="form-control-register" placeholder="Dia de llegada" required><br>
	</div>

	<div class="form-group">
		<div class="form-field">
			<label for="hora_entrada" class="form-label">Hora de llegada</label>
		</div>
		<input type="time" name="hora_entrada" id="hora_entrada" class="form-control-register" placeholder="Hora de entrada" required><br>
	</div>

	<div class="form-group">
		<div class="form-field">
			<label for="numero_vuelo_entrada" class="form-label">Numero de vuelo</label>
		</div>
		<input type="number" name="numero_vuelo_entrada" id="numero_vuelo_entrada" class="form-control-register" placeholder="Numero de vuelo" required><br>
	</div>

	<div class="form-group">
		<div class="form-field">
			<label for="origen_vuelo_entrada" class="form-label">Aeropuerto de origen</label>
		</div>
		<input type="text" name="origen_vuelo_entrada" id="origen_vuelo_entrada" class="form-control-register" placeholder="Aeropuerto de origen" required><br>
	</div>

	<div class="form-group">
		<div class="form-field">
			<label for="id_destino">Destino (Hotel): </label>
		</div>
		<select id="id_destino" name="id_destino" class="form-control-register">
		<?php 
			foreach ($destinos as $destino){
				echo '<option value="'.$destino->getIdHotel().'">'.$destino->getUsuario().'</option>';
			}
		?>
		</select>
	</div>

	<div class="form-group">
		<div class="form-field">
			<label for="num_viajeros" class="form-label">Numero de viajeros</label>
		</div>
		<input type="number" name="num_viajeros" id="num_viajeros" class="form-control-register" placeholder="Numero de viajeros" required><br>
	</div>

	<div class="form-group">
		<div class="form-field">
			<label for="email_cliente" class="form-label">Email</label>
		</div>
		<input <?php  if (isset($email)){echo ' readonly value="'.$email.'"';}; ?> type="email" name="email_cliente" id="email_cliente" class="form-control-register" placeholder="Email" required><br>
	</div>

	<div class="form-group">
		<button type="submit" class="btn-bd-primary">Reservar</button><br>
	</div>
	
	<?php if (isset($errorReserva)): ?>
		<div class="alert alert-danger d-flex justify-content-center align-items-center" role="alert">
			<?= $errorReserva; ?>
		</div>
    <?php endif; ?>

	<input type="hidden" name="request" value="reservar">
	<input type="hidden" name="tipoReserva" value="<?php echo $tipoReserva?>">
	
</form>

</div>
