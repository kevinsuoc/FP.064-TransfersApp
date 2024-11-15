<!-- Ver adminController: mostrarCalendario() para el formato de datos. -->

<p>Filtar por: mes/dia/semana (JS)</p>

<?php foreach ($trayectos as $trayecto): ?>
	<p>Fecha (O mas cosas): <?php echo $trayecto['dia'].' '.$trayecto['hora'] ?> </p>
	<button>Ver mas (O con JS click encima)</button>
<?php endforeach; ?>
