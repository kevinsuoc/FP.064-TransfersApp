<a href="/">Volver</a>

<h3>Gestion vehiculos</h3>

<div style="border: 1px solid green;">
<form action="/" method="post">
	<input type="email" name="email_conductor">
	<input type="text" name="Descripción">
	<input type="hidden" name="request" value="agregarVehiculo">
	<button type="submit">Agregar vehiculo</button>
</form>
</div>
<br>
<div style="border: 1px solid red;">
<?php foreach ($vehiculos as $vehiculo): ?>

<form action="/" method="post">
	<input type="email" name="email_conductor" value="<?php echo $vehiculo->getEmailConductor() ?>">
	<input type="text" name="Descripción" value="<?php echo $vehiculo->getDescripcion() ?>">
	<input type="hidden" name="id_vehiculo" value="<?php echo $vehiculo->getIdVehiculo() ?>">
	<input type="hidden" name="request" value="actualizarVehiculo">
	<button type="submit">Actualizar</button>
</form>

<form action="/" method="post">
	<input type="hidden" name="request" value="eliminarVehiculo">
	<input type="hidden" name="id_vehiculo" value="<?php echo $vehiculo->getIdVehiculo() ?>">
	<button type="submit">Eliminar</button>
</form>

<?php endforeach; ?>

</div>
