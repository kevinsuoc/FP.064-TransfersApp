Admin !

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

<form action="/">
	<input type="hidden" name="request" value="mostrarCalendario">
	<button type="submit">Panel trayectos</button>
</form>

<form action="/">
	<input type="hidden" name="request" value="panelReservas">
	<button type="submit">Panel reservas</button>
</form>

<form action="/">
	<input type="hidden" name="request" value="panelDestinos">
	<button type="submit">Panel destinos</button>
</form>

<form action="/">
	<input type="hidden" name="request" value="panelVehiculos">
	<button type="submit">Panel vehiculos</button>
</form>



<a href="/?request=logout">Desconectarse</a>
