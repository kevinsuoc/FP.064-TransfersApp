<div class="container mt-4">
	<?php if (isset($_SESSION['respuestaAdmin'])): ?>
        <div class="alert alert-info">
            <?php 
                echo $_SESSION['respuestaAdmin'];
                unset($_SESSION['respuestaAdmin']);
            ?>
        </div>
    <?php endif; ?>

	<form action="/" method="post" class="container mt-4">
		<div class="form-group">
			<label for="vista">Selecciona el tipo de vista:</label>
			<select id="vista" name="vista" class="form-control" onchange="mostrarOpciones()">
				<option value="diaria" <?= $filtroData['tipo'] == 'diaria' ? 'selected' : '' ?>>Vista Diaria</option>
				<option value="semanal" <?= $filtroData['tipo'] == 'semanal' ? 'selected' : '' ?>>Vista Semanal</option>
				<option value="mensual" <?= $filtroData['tipo'] == 'mensual' ? 'selected' : '' ?>>Vista Mensual</option>
			</select>
		</div>

		<div id="opciones">
			<?php if ($filtroData['tipo'] == 'diaria'): ?>
				<div class="form-group">
					<label for="dia">Selecciona un día:</label>
					<input type="date" id="dia" name="dia" class="form-control" value="<?= $filtroData['dia'] ?>">
				</div>
			<?php elseif ($filtroData['tipo'] == 'semanal'): ?>
				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="anyo">Año:</label>
						<input type="number" id="anyo" name="anyo" class="form-control" min="2024" max="2030" value="<?= $filtroData['anyo'] ?>">
					</div>
					<div class="form-group col-md-6">
						<label for="semana">Semana:</label>
						<input type="number" id="semana" name="semana" class="form-control" min="1" max="52" value="<?= $filtroData['semana'] ?>">
					</div>
				</div>
			<?php elseif ($filtroData['tipo'] == 'mensual'): ?>
				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="anyo">Año:</label>
						<input type="number" id="anyo" name="anyo" class="form-control" min="2024" max="2030" value="<?= $filtroData['anyo'] ?>">
					</div>
					<div class="form-group col-md-6">
						<label for="mes">Mes:</label>
						<input type="number" id="mes" name="mes" class="form-control" min="1" max="12" value="<?= $filtroData['mes'] ?>">
					</div>
				</div>
			<?php endif; ?>
		</div>

		<input type="hidden" name="request" value="filtroReservas">

		<div class="form-group">
			<button type="submit" class="btn btn-primary">Filtrar</button>
		</div>
	</form>

	<?php foreach ($dataReservas as $data): ?>
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <form method="post" action="/">
                <h5 class="card-title"><strong>Reserva</strong></h5><hr>

				<p><strong>Reserva:</strong> <?php echo 'Localizador: '.$data['reserva']->getLocalizador(); ?></p>
                <input type="hidden" name="localizador" value="<?=$data['reserva']->getLocalizador()?>">

                <p><strong>Tipo reserva:</strong> <?php echo $data['tipoReservaDescripcion']; ?></p>
                <input type="hidden" name="id_tipo_reserva" value="<?=$data['reserva']->getIdTipoReserva()?>">
                
                <p><strong>Fecha de reserva:</strong> <?php echo $data['reserva']->getFechaReserva(); ?></p>
                <p><strong>Fecha de última modificación:</strong> <?php echo $data['reserva']->getFechaModificacion(); ?></p>
                <p><strong>Precio por trayecto:</strong> 10</p>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email_cliente" id="email" class="form-control" value="<?= $data['reserva']->getEmailCliente() ?>" required>
                </div>

                <div class="form-group">
                    <label for="id_destino">Destino/Recogida (Hotel)</label>
                    <select id="id_destino" name="id_destino" class="form-control">
                        <?php 
                            foreach ($destinos as $destino){
                                if ($destino->getIdHotel() == $data['reserva']->getIdDestino())
                                    echo '<option selected="selected" value="'.$destino->getIdHotel().'">'.$destino->getUsuario().'</option>';
                                else
                                    echo '<option value="'.$destino->getIdHotel().'">'.$destino->getUsuario().'</option>';
                            }
                        ?>
                    </select>
                </div>

                <?php if ($data['reserva']->getIdTipoReserva() == 1 || $data['reserva']->getIdTipoReserva() == 3): ?>
                    <div class="form-group">
                        <label for="fecha_entrada">Día de llegada</label>
                        <input type="date" name="fecha_entrada" id="fecha_entrada" class="form-control" value="<?= $data['reserva']->getFechaEntrada() ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="hora_entrada">Hora de llegada</label>
                        <input type="time" name="hora_entrada" id="hora_entrada" class="form-control" value="<?= $data['reserva']->getHoraEntrada() ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="numero_vuelo_entrada">Número de vuelo de entrada</label>
                        <input type="number" name="numero_vuelo_entrada" id="numero_vuelo_entrada" class="form-control" value="<?= $data['reserva']->getNumeroVueloEntrada() ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="origen_vuelo_entrada">Aeropuerto de origen</label>
                        <input type="text" name="origen_vuelo_entrada" id="origen_vuelo_entrada" class="form-control" value="<?= $data['reserva']->getOrigenVueloEntrada() ?>" required>
                    </div>
                <?php endif; ?> 

                <?php if ($data['reserva']->getIdTipoReserva() == 2 || $data['reserva']->getIdTipoReserva() == 3): ?>
                    <div class="form-group">
                        <label for="fecha_vuelo_salida">Día del vuelo de salida</label>
                        <input type="date" name="fecha_vuelo_salida" id="fecha_vuelo_salida" class="form-control" value="<?= $data['reserva']->getFechaVueloSalida() ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="hora_vuelo_salida">Hora del vuelo de salida</label>
                        <input type="time" name="hora_vuelo_salida" id="hora_vuelo_salida" class="form-control" value="<?= $data['reserva']->getHoraVueloSalida() ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="numero_vuelo_salida">Número de vuelo de salida</label>
                        <input type="number" name="numero_vuelo_salida" id="numero_vuelo_salida" class="form-control" value="<?= $data['reserva']->getNumeroVueloSalida() ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="hora_recogida">Hora de recogida de salida</label>
                        <input type="time" name="hora_recogida" id="hora_recogida" class="form-control" value="<?= $data['reserva']->getHoraRecogida() ?>" required>
                    </div>
                <?php endif; ?>

                <div class="form-group">
                    <label for="num_viajeros">Número de viajeros</label>
                    <input type="number" name="num_viajeros" id="num_viajeros" class="form-control" value="<?= $data['reserva']->getNumViajeros() ?>" required>
                </div>

                <div class="form-group">
                    <label for="id_vehiculo">Vehículo</label>
                    <select id="id_vehiculo" name="id_vehiculo" class="form-control">
                        <option value="">Vehículo no seleccionado</option>
                        <?php 
                            foreach ($vehiculos as $vehiculo){
                                if ($vehiculo->getIdVehiculo() == $data['reserva']->getIdVehiculo())
                                    echo '<option selected="selected" value="'.$vehiculo->getIdVehiculo().'">'.$vehiculo->getDescripcion().': '.$vehiculo->getEmailConductor().'</option>';
                                else
                                    echo '<option value="'.$vehiculo->getIdVehiculo().'">'.$vehiculo->getDescripcion().': '.$vehiculo->getEmailConductor().'</option>';
                            }
                        ?>
                    </select>
                </div>

                <input type="hidden" name="id_reserva" value="<?php echo $data['reserva']->getIdReserva() ?>">
                <input type="hidden" name="request" value="actualizarReservaAdmin">
                <button type="submit" class="btn btn-success btn-block">Modificar</button>
            </form>

            <form method="post" action="/" class="mt-3">
                <input type="hidden" name="id_reserva" value="<?php echo $data['reserva']->getIdReserva() ?>">
                <input type="hidden" name="request" value="eliminarReservaAdmin">
                <button type="submit" class="btn btn-danger btn-block">Eliminar</button>
            </form>
        </div>
    </div>
	<?php endforeach; ?>

</div>


<script>
    function mostrarOpciones() {
        var vista = document.getElementById("vista").value;
        var opcionesDiv = document.getElementById("opciones");

        if (vista === "diaria") {
            opcionesDiv.innerHTML = `
                <div class="form-group">
                    <label for="dia">Selecciona un día:</label>
                    <input type="date" id="dia" name="dia" class="form-control" value="2024-01-01">
                </div>
            `;
        } else if (vista === "semanal") {
            opcionesDiv.innerHTML = `
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="anyo">Año:</label>
                        <input type="number" id="anyo" name="anyo" class="form-control" min="2024" max="2030" value="2024">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="semana">Semana:</label>
                        <input type="number" id="semana" name="semana" class="form-control" min="1" max="52" value="1">
                    </div>
                </div>
            `;
        } else if (vista === "mensual") {
            opcionesDiv.innerHTML = `
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="anyo">Año:</label>
                        <input type="number" id="anyo" name="anyo" class="form-control" min="2024" max="2030" value="2024">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="mes">Mes:</label>
                        <input type="number" id="mes" name="mes" class="form-control" min="1" max="12" value="1">
                    </div>
                </div>
            `;
        }
    }
</script>


