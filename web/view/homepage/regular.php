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

<p><?php echo 'Reserva realizada por: '.$data['reservador']; ?></p>
<p><?php echo 'Localizador: '.$data['reserva']->getLocalizador(); ?></p>
<p><?php echo 'Tipo reserva: '.$data['tipoReservaDescripcion']; ?></p>
<p><?php echo 'Email cliente: '.$data['reserva']->getEmailCliente(); ?></p>
<p><?php echo 'Fecha de reserva: '.$data['reserva']->getFechaReserva(); ?></p>
<p><?php echo 'Fecha de ultima modificacion: '.$data['reserva']->getFechaModificacion(); ?></p>
<p><?php echo 'Hotel de destino/recogida: '.$data['hotelDestinoRecogida']->getUsuario(); ?></p>
<p><?php if (null !== $data['reserva']->getFechaEntrada()) {echo 'Fecha entrada: '.$data['reserva']->getFechaEntrada();}; ?></p>
<p><?php if (null !== $data['reserva']->getHoraEntrada()) {echo 'Hora entrada: '.$data['reserva']->getHoraEntrada();}; ?></p>
<p><?php if (null !== $data['reserva']->getNumeroVueloEntrada()) {echo 'Numero de vuelo de entrada: '.$data['reserva']->getNumeroVueloEntrada();}; ?></p>
<p><?php if (null !== $data['reserva']->getOrigenVueloEntrada()) {echo 'Origen de vuelo de entrada: '.$data['reserva']->getOrigenVueloEntrada();}; ?></p>
<p><?php if (null !== $data['reserva']->getHoraRecogida()) {echo 'Hora de recogida: '.$data['reserva']->getHoraRecogida();}; ?></p>
<p><?php if (null !== $data['reserva']->getNumeroVueloSalida()) {echo 'Numero de vuelo de salida: '.$data['reserva']->getNumeroVueloSalida();}; ?></p>
<p><?php if (null !== $data['reserva']->getHoraVueloSalida()) {echo 'Hora de vuelo de salida: '.$data['reserva']->getHoraVueloSalida();}; ?></p>
<p><?php if (null !== $data['reserva']->getFechaVueloSalida()) {echo 'Fecha de vuelo de salida: '.$data['reserva']->getFechaVueloSalida();}; ?></p>
<p><?php echo 'Numero de viajeros: '.$data['reserva']->getNumViajeros(); ?></p>
<p><?php echo 'Vehiculo: '.$data['descripcionVehiculo']; ?></p>

</div>
<?php endforeach; ?>

</div>

