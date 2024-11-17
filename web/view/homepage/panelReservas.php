<a href="/">Volver</a>

<div>
	<?php
	if (isset($_SESSION['respuestaAdmin'])){
		echo $_SESSION['respuestaAdmin'];
		unset ($_SESSION['respuestaAdmin']);
	}
	?>
</div>

<form action="/" method="post">
        <label for="vista">Selecciona el tipo de vista:</label>
        <select id="vista" name="vista" onchange="mostrarOpciones()">
            <option value="diaria" <?= $filtroData['tipo'] == 'diaria' ? 'selected' : '' ?>>Vista Diaria</option>
            <option value="semanal" <?= $filtroData['tipo'] == 'semanal' ? 'selected' : '' ?>>Vista Semanal</option>
            <option value="mensual" <?= $filtroData['tipo'] == 'mensual' ? 'selected' : '' ?>>Vista Mensual</option>
        </select>

        <div id="opciones">
			<?php if ($filtroData['tipo'] == 'diaria'): ?>
			<label for="dia">Selecciona un día:</label>
			<input type="date" id="dia" name="dia" value="<?= $filtroData['dia'] ?>">
		
			<?php elseif ($filtroData['tipo'] == 'semanal'): ?>
			<label for="semana">Selecciona una semana:</label>
			<input type="number" id="anyo" name="anyo" min="2024" max="2030" value="<?= $filtroData['anyo'] ?>">
			<input type="number" id="semana" name="semana" min="1" max="52" value="<?= $filtroData['semana'] ?>">

			<?php elseif ($filtroData['tipo'] == 'mensual'): ?>
			<label for="mes">Selecciona mes:</label>
			<input type="number" id="anyo" name="anyo" min="2024" max="2030" value="<?= $filtroData['anyo'] ?>">
			<input type="number" id="mes" name="mes" min="1" max="12" value="<?= $filtroData['mes'] ?>">

			<?php endif; ?>
		</div>

		<input type="hidden" name="request" value="filtroReservas">
        <button type="submit">Filtrar</button>
</form>

<script>
	function mostrarOpciones() {
		var vista = document.getElementById("vista").value;
		var opcionesDiv = document.getElementById("opciones");

		if (vista === "diaria") {
			opcionesDiv.innerHTML = `
				<label for="dia">Selecciona un día:</label>
				<input type="date" id="dia" name="dia" value="2024-01-01">
			`;
		} else if (vista === "semanal") {
			opcionesDiv.innerHTML = `
				<label for="semana">Selecciona una semana:</label>
				<input type="number" id="anyo" name="anyo" min="2024" max="2030" value="2024">
				<input type="number" id="semana" name="semana" min="1" max="52" value="1">
			`;
		} else if (vista === "mensual") {
			opcionesDiv.innerHTML = `
				<label for="mes">Selecciona mes:</label>
				<input type="number" id="anyo" name="anyo" min="2024" max="2030" value="2024">
				<input type="number" id="mes" name="mes" min="1" max="12" value="1">
			`;
		}
	}
</script>

<?php foreach ($dataReservas as $data): ?>
	<div style="border: 1px solid red;">
		<form method="post" action="/">
			<p><?php echo 'Localizador: '.$data['reserva']->getLocalizador(); ?></p>
			<input type="hidden" name = "localizador" value="<?=$data['reserva']->getLocalizador()?>">
			<p><?php echo 'Tipo reserva: '.$data['tipoReservaDescripcion']; ?></p>
			<input type="hidden" name = "id_tipo_reserva" value="<?=$data['reserva']->getIdTipoReserva()?>">
			<p><?php echo 'Fecha de reserva: '.$data['reserva']->getFechaReserva(); ?></p>
			<p><?php echo 'Fecha de ultima modificacion: '.$data['reserva']->getFechaModificacion(); ?></p>
			<p><?php echo 'Precio por trayecto:  10'; ?></p>

			<label for="email">Email</label>
			<input type="email" name="email_cliente" id="email" <?php echo 'value="'.$data['reserva']->getEmailCliente().'"'; ?> required><br>

			<label for="id_destino">Destino/recogida (Hotel): </label>
			<select id="id_destino" name="id_destino">
				<?php 
					foreach ($destinos as $destino){
						if ($destino->getIdHotel() == $data['reserva']->getIdDestino())
							echo '<option selected="selected" value="'.$destino->getIdHotel().'">'.$destino->getUsuario().'</option>';
						else
							echo '<option value="'.$destino->getIdHotel().'">'.$destino->getUsuario().'</option>';
					}
				?>
			</select><br>

			<?php if ($data['reserva']->getIdTipoReserva() == 1 || $data['reserva']->getIdTipoReserva() == 3): ?>

				<label for="fecha_entrada">Dia de llegada</label>
				<input type="date" name="fecha_entrada" id="fecha_entrada" value="<?php echo $data['reserva']->getFechaEntrada()?>" required><br>

				<label for="hora_entrada">Hora de llegada</label>
				<input type="time" name="hora_entrada" id="hora_entrada" value="<?php echo $data['reserva']->getHoraEntrada()?>" required><br>

				<label for="numero_vuelo_entrada">Numero de vuelo de entrada</label>
				<input type="number" name="numero_vuelo_entrada" id="numero_vuelo_entrada" value="<?php echo $data['reserva']->getNumeroVueloEntrada()?>" required><br>

				<label for="origen_vuelo_entrada">Aeropuerto de origen</label>
				<input type="text" name="origen_vuelo_entrada" id="origen_vuelo_entrada" value ="<?php echo $data['reserva']->getOrigenVueloEntrada()?>" required><br>

			<?php endif; ?> 

			<?php if ($data['reserva']->getIdTipoReserva() == 2 || $data['reserva']->getIdTipoReserva() == 3): ?>

				<label for="fecha_vuelo_salida">Dia del vuelo de salida</label>
				<input type="date" name="fecha_vuelo_salida" id="fecha_vuelo_salida" value="<?php echo $data['reserva']->getFechaVueloSalida() ?>" required><br>

				<label for="hora_vuelo_salida">Hora del vuelo de salida</label>
				<input type="time" name="hora_vuelo_salida" id="hora_vuelo_salida" value="<?php echo $data['reserva']->getHoraVueloSalida() ?>" required><br>

				<label for="numero_vuelo_salida">Numero de vuelo de salida</label>
				<input type="number" name="numero_vuelo_salida" id="numero_vuelo_salida" value="<?php echo $data['reserva']->getNumeroVueloSalida() ?>" required><br>

				<label for="hora_recogida">Hora de recogida de salida</label>
				<input type="time" name="hora_recogida" id="hora_recogida" value="<?php echo $data['reserva']->getHoraRecogida() ?>" required><br>

			<?php endif; ?>

			<label for="num_viajeros">Numero de viajeros</label>
			<input type="number" name="num_viajeros" id="num_viajeros"  value="<?php echo $data['reserva']->getNumViajeros()?>" required><br>

			<label for="id_vehiculo">Vehiculo </label>
			<select id="id_vehiculo" name="id_vehiculo">
				<?php 
					echo '<option value="">Vehiculo no seleccionado</option>';
					foreach ($vehiculos as $vehiculo){
						if ($vehiculo->getIdVehiculo() == $data['reserva']->getIdVehiculo())
							echo '<option selected="selected" value="'.$vehiculo->getIdVehiculo().'">'.$vehiculo->getDescripcion().': '.$vehiculo->getEmailConductor().'</option>';
						else
							echo '<option value="'.$vehiculo->getIdVehiculo().'">'.$vehiculo->getDescripcion().': '.$vehiculo->getEmailConductor().'</option>';
					}
				?>
			</select><br>

			<input type="hidden" name="id_reserva" value="<?php echo $data['reserva']->getIdReserva() ?>">
			<input type="hidden" name="request" value="actualizarReservaAdmin">
			<button type="submit">Modificar</button>
		</form>

		<form method="post" action="/">
			<input type="hidden" name="id_reserva" value="<?php echo $data['reserva']->getIdReserva() ?>">
			<input type="hidden" name="request" value="eliminarReservaAdmin">
			<button type="submit">Eliminar</button>
		</form>
	</div>
<?php endforeach; ?>
