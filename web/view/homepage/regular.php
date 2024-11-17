
<form action="/" class="container d-flex justify-content-center mb-3 mt-3">
    <div class="d-flex align-items-center">
        <select id="tipoReserva" name="tipoReserva" class="form-control w-auto">
            <?php 
                foreach ($tiposReserva as $tipoReserva){
                    echo '<option value="'.$tipoReserva[0].'">'.$tipoReserva[1].'</option>';
                }
            ?>
        </select>
        <input type="hidden" name="request" value="reserva">
        <button type="submit" class="btn btn-primary ml-3">Hacer reserva</button>
    </div>
</form>

<div class="container d-flex justify-content-center mb-3">
  <div class="btn-group" role="group" aria-label="Basic example">
    <button type="button" class="btn btn-secondary" id="btnPerfil">Ver Perfil</button>
    <button type="button" class="btn btn-success" id="btnReservas">Ver Reservas</button>
	
  </div>
  
</div>

<div class="container mt-4 perfil">
	<div id="perfilSection" class="section">
        <div class="card">
            <div class="card-header">
                <h5>Perfil de Usuario</h5>
            </div>
            <div class="card-body">
			<p><strong>Nombre:</strong> <?php echo $perfil->getNombre() ?></p>
			<p><strong>Primer apellido:</strong> <?php echo $perfil->getApellido1() ?></p>
			<p><strong>Segundo apellido:</strong> <?php echo $perfil->getApellido2() ?></p>
			<p><strong>Direcction:</strong> <?php echo $perfil->getDireccion() ?></p>
			<p><strong>Codigo postal:</strong> <?php echo $perfil->getCodigoPostal() ?></p>
			<p><strong>Ciudad:</strong> <?php echo $perfil->getCiudad() ?></p>
			<p><strong>Pais:</strong> <?php echo $perfil->getPais() ?></p>
			<p><strong>Email:</strong> <?php echo $perfil->getEmail() ?></p>
            <button class="btn btn-warning" id="btnEditarPerfil">Editar</button>
            </div>
        </div>
    </div>

	<div id="editSection" class="section perfil">
		<div class="container mt-4">
			<div class="card">
				<div class="card-header">
					<h5>Actualizar Perfil</h5>

				</div>
				
				<div class="card-body">
					<?php if (isset($mensajeViajero)): ?>
							<div class="alert alert-primary d-flex justify-content-center align-items-center" role="alert">
								<?= $mensajeViajero; ?>
							</div>
					<?php endif; ?>	
					<form action="/" method="post">
						<div class="mb-3">
							<label for="nombre" class="form-label">Nombre</label>
							<input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo $perfil->getNombre() ?>" required>
						</div>

						<div class="mb-3">
							<label for="apellido1" class="form-label">Primer apellido</label>
							<input type="text" name="apellido1" id="apellido1" class="form-control" value="<?php echo $perfil->getApellido1() ?>" required>
						</div>

						<div class="mb-3">
							<label for="apellido2" class="form-label">Segundo apellido</label>
							<input type="text" name="apellido2" id="apellido2" class="form-control" value="<?php echo $perfil->getApellido2() ?>" required>
						</div>

						<div class="mb-3">
							<label for="direccion" class="form-label">Dirección</label>
							<input type="text" name="direccion" id="direccion" class="form-control" value="<?php echo $perfil->getDireccion() ?>" required>
						</div>

						<div class="mb-3">
							<label for="codigoPostal" class="form-label">Código postal</label>
							<input type="number" name="codigoPostal" id="codigoPostal" class="form-control" value="<?php echo $perfil->getCodigoPostal() ?>" required>
						</div>

						<div class="mb-3">
							<label for="ciudad" class="form-label">Ciudad</label>
							<input type="text" name="ciudad" id="ciudad" class="form-control" value="<?php echo $perfil->getCiudad() ?>" required>
						</div>

						<div class="mb-3">
							<label for="pais" class="form-label">País</label>
							<input type="text" name="pais" id="pais" class="form-control" value="<?php echo $perfil->getPais() ?>" required>
						</div>

						<div class="mb-3">
							<label for="email" class="form-label">Email</label>
							<input type="email" name="email" id="email" class="form-control" value="<?php echo $perfil->getEmail() ?>" required>
						</div>

						<input type="hidden" name="id_viajero" value="<?php echo $perfil->getIdViajero() ?>">
						<input type="hidden" name="request" value="actualizarViajero">

						<button type="submit" class="btn btn-primary">Actualizar</button>					
					</form>
				</div>
    		</div>
			<div class="card mt-4">
				<div class="card-header">
					<h5>Cambiar Contraseña</h5>
				</div>
				<div class="card-body">
					<form action="/" method="post">
						<div class="mb-3">
							<label for="oldPassword" class="form-label">Contraseña antigua</label>
							<input type="password" name="oldPassword" id="oldPassword" class="form-control" required>
						</div>

						<div class="mb-3">
							<label for="newPassword" class="form-label">Contraseña nueva</label>
							<input type="password" name="newPassword" id="newPassword" class="form-control" required>
						</div>

						<input type="hidden" name="id_viajero" value="<?php echo $perfil->getIdViajero() ?>">
						<input type="hidden" name="request" value="actualizarPassword">

						<button type="submit" class="btn btn-warning">Cambiar contraseña</button>
						<?php if (isset($mensajePassword)): ?>
							<div class="alert alert-primary d-flex justify-content-center align-items-center" role="alert">
								<?= $mensajePassword; ?>
							</div>
						<?php endif; ?>	
					</form>
				</div>
			</div>
			<div class="mt-4">
				<button id="btnGoBackPerfil" class="btn btn-secondary">Volver</button>
			</div>
		</div>
	</div>

	<div id="reservasSection" class="section perfil">
		<?php foreach ($dataReservas as $data): ?>
			<div class="card mb-4">
				<div class="card-header">
					<h5>Reserva realizada por: <?php echo $data['reservador']; ?></h5>
				</div>
				
				<div class="card-body">
					<?php if (isset($mensajeReservaEliminada)): ?>
							<div class="alert alert-primary d-flex justify-content-center align-items-center" role="alert">
								<?= $mensajeReservaEliminada; ?>
							</div>
					<?php endif; ?>	
					<form method="post" action="/">
						<div class="mb-3">
							<p><strong>Localizador:</strong> <?php echo $data['reserva']->getLocalizador(); ?></p>
							<input type="hidden" name="localizador" value="<?=$data['reserva']->getLocalizador()?>">
						</div>

						<div class="mb-3">
							<p><strong>Tipo reserva:</strong> <?php echo $data['tipoReservaDescripcion']; ?></p>
							<input type="hidden" name="id_tipo_reserva" value="<?=$data['reserva']->getIdTipoReserva()?>">
						</div>

						<div class="mb-3">
							<p><strong>Email cliente:</strong> <?php echo $data['reserva']->getEmailCliente(); ?></p>
							<input hidden readonly type="email" name="email_cliente" id="email" value="<?php echo $data['reserva']->getEmailCliente(); ?>" required class="form-control">
						</div>

						<div class="mb-3">
							<p><strong>Fecha de reserva:</strong> <?php echo $data['reserva']->getFechaReserva(); ?></p>
							<p><strong>Fecha de última modificación:</strong> <?php echo $data['reserva']->getFechaModificacion(); ?></p>
						</div>

						<div class="mb-3">
							<p><strong>Precio por trayecto:</strong> 10</p>
						</div>

						<div class="mb-3">
							<label for="id_destino" class="form-label">Destino/recogida (Hotel):</label>
							<select id="id_destino" name="id_destino" class="form-select">
								<?php foreach ($destinos as $destino): ?>
									<option value="<?=$destino->getIdHotel()?>" <?php if ($destino->getIdHotel() == $data['reserva']->getIdDestino()) echo 'selected'; ?>>
										<?=$destino->getUsuario()?>
									</option>
								<?php endforeach; ?>
							</select>
						</div>

						<?php if ($data['reserva']->getIdTipoReserva() == 1 || $data['reserva']->getIdTipoReserva() == 3): ?>
							<div class="mb-3">
								<label for="fecha_entrada" class="form-label">Día de llegada:</label>
								<input type="date" name="fecha_entrada" id="fecha_entrada" value="<?php echo $data['reserva']->getFechaEntrada()?>" required class="form-control">
							</div>

							<div class="mb-3">
								<label for="hora_entrada" class="form-label">Hora de llegada:</label>
								<input type="time" name="hora_entrada" id="hora_entrada" value="<?php echo $data['reserva']->getHoraEntrada()?>" required class="form-control">
							</div>

							<div class="mb-3">
								<label for="numero_vuelo_entrada" class="form-label">Número de vuelo de entrada:</label>
								<input type="number" name="numero_vuelo_entrada" id="numero_vuelo_entrada" value="<?php echo $data['reserva']->getNumeroVueloEntrada()?>" required class="form-control">
							</div>

							<div class="mb-3">
								<label for="origen_vuelo_entrada" class="form-label">Aeropuerto de origen:</label>
								<input type="text" name="origen_vuelo_entrada" id="origen_vuelo_entrada" value ="<?php echo $data['reserva']->getOrigenVueloEntrada()?>" required class="form-control">
							</div>
						<?php endif; ?> 

						<?php if ($data['reserva']->getIdTipoReserva() == 2 || $data['reserva']->getIdTipoReserva() == 3): ?>
							<div class="mb-3">
								<label for="fecha_vuelo_salida" class="form-label">Día del vuelo de salida:</label>
								<input type="date" name="fecha_vuelo_salida" id="fecha_vuelo_salida" value="<?php echo $data['reserva']->getFechaVueloSalida() ?>" required class="form-control">
							</div>

							<div class="mb-3">
								<label for="hora_vuelo_salida" class="form-label">Hora del vuelo de salida:</label>
								<input type="time" name="hora_vuelo_salida" id="hora_vuelo_salida" value="<?php echo $data['reserva']->getHoraVueloSalida() ?>" required class="form-control">
							</div>

							<div class="mb-3">
								<label for="numero_vuelo_salida" class="form-label">Número de vuelo de salida:</label>
								<input type="number" name="numero_vuelo_salida" id="numero_vuelo_salida" value="<?php echo $data['reserva']->getNumeroVueloSalida() ?>" required class="form-control">
							</div>

							<div class="mb-3">
								<label for="hora_recogida" class="form-label">Hora de recogida de salida:</label>
								<input type="time" name="hora_recogida" id="hora_recogida" value="<?php echo $data['reserva']->getHoraRecogida() ?>" required class="form-control">
							</div>
						<?php endif; ?>

						<div class="mb-3">
							<label for="num_viajeros" class="form-label">Número de viajeros:</label>
							<input type="number" name="num_viajeros" id="num_viajeros" value="<?php echo $data['reserva']->getNumViajeros()?>" required class="form-control">
						</div>

						<input type="hidden" name="id_reserva" value="<?php echo $data['reserva']->getIdReserva() ?>">
						<input type="hidden" name="request" value="actualizarReserva">

						<button type="submit" class="btn btn-primary">Modificar</button>
					</form>

					<form method="post" action="/" class="mt-3">
						<input type="hidden" name="id_reserva" value="<?php echo $data['reserva']->getIdReserva() ?>">
						<input type="hidden" name="request" value="eliminarReserva">
						<button type="submit" class="btn btn-danger">Eliminar</button>
					</form>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>

<script>
    const perfilSection = document.getElementById('perfilSection')
    const reservasSection = document.getElementById('reservasSection')
	const editSection = document.getElementById('editSection')
    const btnPerfil = document.getElementById('btnPerfil')
    const btnReservas = document.getElementById('btnReservas')


    btnPerfil.addEventListener('click', () => {
        showSection(perfilSection);
    });
    btnReservas.addEventListener('click', () => {
        showSection(reservasSection);
    });
    function showSection(section) {
        perfilSection.classList.remove('active');
        reservasSection.classList.remove('active');
		editSection.classList.remove('active');
        section.classList.add('active');
    }
    document.getElementById('btnGoBackPerfil').addEventListener('click', () => {
        showSection(perfilSection);
    });
    document.getElementById('btnEditarPerfil').addEventListener('click', () => {
        showSection(editSection);
    });
	<?php
		if (isset($mensajeViajero) || isset($mensajePassword)){
			echo 'showSection(editSection);';
		} else {
			echo 'showSection(reservasSection);';
		}
	?>
</script>








