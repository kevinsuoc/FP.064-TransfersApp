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

<a href="/?request=logout">Desconectarse</a>

