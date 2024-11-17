<div class="container mt-4">
	<h2>Panel de control</h2>
	<div class="list-group">

		<form action="/" class="list-group-item">
			<label for="tipoReserva" class="font-weight-bold text-primary">Tipo de reserva</label>
			<select id="tipoReserva" name="tipoReserva" class="form-control mb-2">
			<?php 
				foreach ($tiposReserva as $tipoReserva){
					echo '<option value="'.$tipoReserva[0].'">'.$tipoReserva[1].'</option>';
				}
			?>
			</select>
			<input type="hidden" name="request" value="reserva">
			<button type="submit" class="btn btn-primary w-100">Hacer reserva</button>
		</form>

		<form action="/" class="list-group-item">
			<input type="hidden" name="request" value="mostrarCalendario">
			<button type="submit" class="btn btn-info w-100">Calendario de trayectos</button>
		</form>

		<form action="/" class="list-group-item">
			<input type="hidden" name="request" value="panelReservas">
			<button type="submit" class="btn btn-info w-100">Panel reservas</button>
		</form>

		<form action="/" class="list-group-item">
			<input type="hidden" name="request" value="panelDestinos">
			<button type="submit" class="btn btn-info w-100">Panel destinos</button>
		</form>

		<form action="/" class="list-group-item">
			<input type="hidden" name="request" value="panelVehiculos">
			<button type="submit" class="btn btn-info w-100">Panel vehiculos</button>
		</form>

	</div>
</div>
