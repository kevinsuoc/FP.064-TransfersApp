<div class="container mt-4">
    <?php if (isset($_SESSION['respuestaAdmin'])): ?>
        <div class="alert alert-info">
            <?php 
                echo $_SESSION['respuestaAdmin'];
                unset($_SESSION['respuestaAdmin']);
            ?>
        </div>
    <?php endif; ?>

    <h3 class="mb-4">Gestión de Hoteles</h3>

    <div class="card mb-4">
        <div class="card-header">
            <strong>Agregar Hotel</strong>
        </div>
        <div class="card-body">
            <form action="/" method="post" >
                <div class="mb-3">
                    <label for="comision" class="form-label">Comisión</label>
                    <input type="number" step="0.01" name="Comision" id="comision" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="usuario" class="form-label">Usuario</label>
                    <input type="text" name="usuario" id="usuario" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="id_zona" class="form-label">Zona</label>
                    <select name="id_zona" id="id_zona" class="form-select" required>
                        <?php foreach ($zonas as $zona): ?>
                            <option value="<?php echo $zona->getIdZona(); ?>"><?php echo $zona->getDescripcion(); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <input type="hidden" name="request" value="agregarHotel">
                <button type="submit" class="btn btn-success">Agregar Hotel</button>
            </form>
        </div>
    </div>

	<?php foreach ($destinos as $destino): ?>
    <div class="card mb-4">
        <div class="card-header">
            <strong>Hotel</strong>
        </div>
        <div class="card-body">
            
                <form action="/" method="post" class="mb-3">
                    <div class="mb-3">
                        <label for="comision_<?php echo $destino->getIdHotel(); ?>" class="form-label">Comisión</label>
                        <input type="number" step="0.01" name="Comision" value="<?php echo $destino->getComision(); ?>" id="comision_<?php echo $destino->getIdHotel(); ?>" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="usuario_<?php echo $destino->getIdHotel(); ?>" class="form-label">Usuario</label>
                        <input type="text" name="usuario" value="<?php echo $destino->getUsuario(); ?>" id="usuario_<?php echo $destino->getIdHotel(); ?>" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="id_zona_<?php echo $destino->getIdHotel(); ?>" class="form-label">Zona</label> <br>
                        <select name="id_zona" id="id_zona_<?php echo $destino->getIdHotel(); ?>" class="form-select" required>
                            <?php foreach ($zonas as $zona): ?>
                                <option value="<?php echo $zona->getIdZona(); ?>" <?php if ($zona->getIdZona() == $destino->getIdZona()) echo 'selected'; ?>>
                                    <?php echo $zona->getDescripcion(); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <input type="hidden" name="id_hotel" value="<?php echo $destino->getIdHotel(); ?>">
                    <input type="hidden" name="request" value="actualizarHotel">
                    <button type="submit" class="btn btn-warning">Actualizar</button>
                </form>

                <form action="/" method="post mb-4">
                    <input type="hidden" name="id_hotel" value="<?php echo $destino->getIdHotel(); ?>">
                    <input type="hidden" name="request" value="eliminarHotel">
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
				<hr class="my-4 border-4">
        </div>
    </div>
	<?php endforeach; ?>

    <h3 class="mb-4">Gestión de Zonas</h3>

    <div class="card mb-4">
        <div class="card-header">
            <strong>Agregar Zona</strong>
        </div>
        <div class="card-body">
            <form action="/" method="post">
                <div class="mb-3">
                    <label for="descripcion_zona" class="form-label">Descripción</label>
                    <input type="text" name="descripcion" id="descripcion_zona" class="form-control" required>
                </div>
                <input type="hidden" name="request" value="agregarZona">
                <button type="submit" class="btn btn-success">Agregar Zona</button>
            </form>
        </div>
    </div>
	<?php foreach ($zonas as $zona): ?>
    <div class="card mb-3">
        <div class="card-header">
            <strong>Zona</strong>
        </div>
        <div class="card-body">
                <form action="/" method="post" class="mb-3">
                    <div class="mb-3">
                        <label for="descripcion_zona_<?php echo $zona->getIdZona(); ?>" class="form-label">Descripción</label>
                        <input type="text" name="descripcion" value="<?php echo $zona->getDescripcion(); ?>" id="descripcion_zona_<?php echo $zona->getIdZona(); ?>" class="form-control" required>
                    </div>
                    <input type="hidden" name="id_zona" value="<?php echo $zona->getIdZona(); ?>">
                    <input type="hidden" name="request" value="actualizarZona">
                    <button type="submit" class="btn btn-warning">Actualizar</button>
                </form>

                <form action="/" method="post">
                    <input type="hidden" name="id_zona" value="<?php echo $zona->getIdZona(); ?>">
                    <input type="hidden" name="request" value="eliminarZona">
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
        </div>
    </div>
	<?php endforeach; ?>
</div>
