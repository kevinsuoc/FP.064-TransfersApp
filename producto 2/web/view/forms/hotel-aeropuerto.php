<div class="form-container-register">
    <form action="/" method="post" class="register-form">
        <div class="form-group">
            <h3>Reserva de Hotel a Aeropuerto</h3>
        </div>

        <div class="form-group">
            <div class="form-field">
                <label for="fecha_vuelo_salida" class="form-label">Día del vuelo</label>
            </div>
            <input type="date" name="fecha_vuelo_salida" id="fecha_vuelo_salida" class="form-control-register" required><br>
        </div>

        <div class="form-group">
            <div class="form-field">
                <label for="hora_vuelo_salida" class="form-label">Hora del vuelo</label>
            </div>
            <input type="time" name="hora_vuelo_salida" id="hora_vuelo_salida" class="form-control-register" required><br>
        </div>

		<div class="form-group">
            <div class="form-field">
                <label for="numero_vuelo_salida" class="form-label">Número de vuelo</label>
            </div>
            <input type="number" name="numero_vuelo_salida" id="numero_vuelo_salida" class="form-control-register" required><br>
        </div>

		<div class="form-group">
            <div class="form-field">
                <label for="hora_recogida" class="form-label">Hora de recogida</label>
            </div>
            <input type="time" name="hora_recogida" id="hora_recogida" class="form-control-register" required><br>
        </div>

        <div class="form-group">
            <div class="form-field">
                <label for="id_destino" class="form-label">Origen (Hotel)</label>
            </div>
            <select id="id_destino" name="id_destino" class="form-control-register">
                <?php 
                    foreach ($destinos as $destino) {
                        echo '<option value="'.$destino->getIdHotel().'">'.$destino->getUsuario().'</option>';
                    }
                ?>
            </select><br>
        </div>

		<div class="form-group">
            <div class="form-field">
                <label for="num_viajeros" class="form-label">Número de viajeros</label>
            </div>
            <input type="number" name="num_viajeros" id="num_viajeros" class="form-control-register" required><br>
        </div>

        <div class="form-group">
            <div class="form-field">
                <label for="email_cliente" class="form-label">Email</label>
            </div>
            <input <?php if (isset($email)){echo 'readonly value="'.$email.'"';}; ?> type="email" name="email_cliente" id="email_cliente" class="form-control-register" required><br>
        </div>

		<div class="form-group">
            <button type="submit" class="btn-bd-primary">Reservar</button><br>
        </div>

		<?php if (isset($errorReserva)): ?>
            <div class="alert alert-danger d-flex justify-content-center align-items-center" role="alert">
                <?= $errorReserva; ?>
            </div>
        <?php endif; ?>

		<input type="hidden" name="request" value="reservar">
		<input type="hidden" name="tipoReserva" value="<?php echo $tipoReserva?>">
    </form>
</div>

<br>
<a href="/" class="btn btn-secondary">Volver</a>
