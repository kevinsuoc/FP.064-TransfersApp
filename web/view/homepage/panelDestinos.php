
<a href="/">Volver</a>

<div>
	<?php
	if (isset($_SESSION['respuestaAdmin'])){
		echo $_SESSION['respuestaAdmin'];
		unset ($_SESSION['respuestaAdmin']);
	}
	?>
</div>

<h3> Gestion hoteles </h3>
<div style="border: 1px solid green;">

<form action="/" method="post">
	Comision
	<input type="double" name="Comision">
	Usuario
	<input type="text" name="usuario">
	Zona
	<select name="id_zona">
	<?php 
		foreach ($zonas as $zona){
			echo '<option value="'.$zona->getIdZona().'">'.$zona->getDescripcion().'</option>';
		}
	?>
	</select><br>

	<input type="hidden" name="request" value="agregarHotel">
	<button type="submit">Agregar</button>
</form>
</div>
<br>


<div style="border: 1px solid red;">
<?php foreach ($destinos as $destino): ?>

<form action="/" method="post">
	Comision
	<input type="number" name="Comision" value="<?php echo $destino->getComision() ?>">
	Usuario
	<input type="text" name="usuario" value="<?php echo $destino->getUsuario() ?>">
	Zona
	<select name="id_zona">
	<?php 
		foreach ($zonas as $zona){
			echo '<option ';
			if ($zona->getIdZona() == $destino->getIdZona()) {echo " selected ";};
			echo 'value="'.$zona->getIdZona().'">'.$zona->getDescripcion().'</option>';
		}
	?>
	</select><br>

	<input type="hidden" name="id_hotel" value="<?php echo $destino->getIdHotel() ?>">
	<input type="hidden" name="request" value="actualizarHotel">
	<button type="submit">Actualizar</button>
</form>

<form action="/" method="post">
	<input type="hidden" name="id_hotel" value="<?php echo $destino->getIdHotel() ?>">
	<input type="hidden" name="request" value="eliminarHotel">
	<button type="submit">Eliminar</button>
</form>

<?php endforeach; ?>

</div>

<h3> Gestion Zonas </h3>

<div style="border: 1px solid green;">
<form action="/" method="post">
		<input type="text" name="descripcion" required>
		<input type="hidden" name="request" value="agregarZona">
		<button type="submit">Agregar</button>
</form>
</div>

<div style="border: 1px solid blue;">
<?php foreach ($zonas as $zona): ?>
	<form action="/" method="post">
		<input type="text" name="descripcion" value="<?php echo $zona->getDescripcion() ?>">
		<input type="hidden" name="id_zona" value="<?php echo $zona->getIdZona() ?>">
		<input type="hidden" name="request" value="actualizarZona">
		<button type="submit">Actualizar</button>
	</form>

	<form action="/" method="post">
		<input type="hidden" name="id_zona" value="<?php echo $zona->getIdZona() ?>">
		<input type="hidden" name="request" value="eliminarZona">
		<button type="submit">Eliminar</button>
	</form>

<?php endforeach; ?>
</div>
