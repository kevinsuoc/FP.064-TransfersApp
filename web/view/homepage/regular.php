Regular !

<form action="/">
	<label for="tipoReserva">Tipo de reserva:</label>
	<select id="tipoReserva" name="tipoReserva">
	<?php 
		foreach ($tiposReserva as $tipoReserva){
			echo '<option value="'.$tipoReserva[0].'">'.$tipoReserva[1].'</option>';
		}
	?>
	</select>
	<input type="hidden" name="request" value="reserva">
	<button type="submit">Hacer reserva</button>
</form>

<!--Hace aparecer y desaparecer una ventaja con el perfil. En JS. -->
<form action="/">
	<input type="hidden" name="request" value="perfilUsuarioRegular">
	<button type="submit">Perfil</button>
</form>

<p><?php if (isset($mensajeReservaEliminada)) {echo $mensajeReservaEliminada;} ?></p>

<!-- Ventaja de perfil (Temporal) -->
<div style="border: 1px solid blue;">

<h3>Perfil</h3>

<form action="/" method="post" style="border: 1px solid green;">

	<label for="nombre">Nombre</label>
	<input type="text" name="nombre" id="nombre" value="<?php echo $perfil->getNombre() ?>" required><br>

	<label for="apellido1">Primer apellido</label>
	<input type="text" name="apellido1" id="apellido1" value="<?php echo $perfil->getApellido1() ?>" required><br>

	<label for="apellido2">Segundo apellido</label>
	<input type="text" name="apellido2" id="apellido2" value="<?php echo $perfil->getApellido2() ?>" required><br>

	<label for="direccion">Direccion</label>
	<input type="text" name="direccion" id="direccion" value="<?php echo $perfil->getDireccion() ?>" required><br>

	<label for="codigoPostal">Codigo postal</label>
	<input type="number" name="codigoPostal" id="codigoPostal" value="<?php echo $perfil->getCodigoPostal() ?>" required><br>

	<label for="ciudad">Ciudad</label>
	<input type="text" name="ciudad" id="ciudad" value="<?php echo $perfil->getCiudad() ?>" required><br>

	<label for="pais">Pais</label>
	<input type="text" name="pais" id="pais" value="<?php echo $perfil->getPais() ?>" required><br>

	<label for="email">Email</label>
	<input type="email" name="email" id="email" value="<?php echo $perfil->getEmail() ?>" required><br>

	<input type="hidden" name="id_viajero" value="<?php echo $perfil->getIdViajero() ?>">
	<input type="hidden" name="request" value="actualizarViajero">
	<button type="submit">Actualizar</button><br>
	<p><?php if (isset($mensajeViajero)) {echo $mensajeViajero;} ?></p>
</form>

<form action="/" method="post" style="border: 1px solid green;">
	<label for="oldPassword">Contraseña antigua</label>
	<input type="password" name="oldPassword" id="oldPassword"><br>
	
	<label for="newPassword">Contraseña nueva</label>
	<input type="password" name="newPassword" id="newPassword"><br>

	<input type="hidden" name="id_viajero" value="<?php echo $perfil->getIdViajero() ?>">
	<input type="hidden" name="request" value="actualizarPassword">
	<button type="submit">Cambiar contraseña</button><br>
	<p><?php if (isset($mensajePassword)) {echo $mensajePassword;} ?></p>
</form>

	
	<!-- id = $perfil->getIdViajero() -->
	<a href="/?request=logout">Desconectarse</a>
</div>


<!--Hace aparecer y desaparecer una ventaja con las reservas. En JS. -->
<form action="/">
	<input type="hidden" name="request" value="verReservas">
	<button type="submit">Ver reservas</button>
</form>

<!--Ventana de reservas (Temporal). -->
<div>
	<?php foreach ($dataReservas as $data): ?>
	<div style="border: 1px solid red;">
		<form method="post" action="/">
			<p><?php echo 'Reserva realizada por: '.$data['reservador']; ?></p>
			<p><?php echo 'Localizador: '.$data['reserva']->getLocalizador(); ?></p>
			<input type="hidden" name = "localizador" value="<?=$data['reserva']->getLocalizador()?>">
			<p><?php echo 'Tipo reserva: '.$data['tipoReservaDescripcion']; ?></p>
			<input type="hidden" name = "id_tipo_reserva" value="<?=$data['reserva']->getIdTipoReserva()?>">
			<p><?php echo 'Email cliente: '.$data['reserva']->getEmailCliente(); ?></p>
			<input type="email" name="email_cliente" id="email" <?php echo 'value="'.$data['reserva']->getEmailCliente().'"'; ?> required><br>
			<p><?php echo 'Fecha de reserva: '.$data['reserva']->getFechaReserva(); ?></p>
			<p><?php echo 'Fecha de ultima modificacion: '.$data['reserva']->getFechaModificacion(); ?></p>
			<p><?php echo 'Precio por trayecto:  10'; ?></p>

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

			<input type="hidden" name="id_reserva" value="<?php echo $data['reserva']->getIdReserva() ?>">
			<input type="hidden" name="request" value="actualizarReserva">
			<button type="submit">Modificar</button>
		</form>

		<form method="post" action="/">
			<input type="hidden" name="id_reserva" value="<?php echo $data['reserva']->getIdReserva() ?>">
			<input type="hidden" name="request" value="eliminarReserva">
			<button type="submit">Eliminar</button>
		</form>
	</div>
<?php endforeach; ?>
</div>

