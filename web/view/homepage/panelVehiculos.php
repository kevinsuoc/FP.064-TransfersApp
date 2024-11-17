<div class="container mt-4">
    <?php if (isset($_SESSION['respuestaAdmin'])): ?>
        <div class="alert alert-info">
            <?php 
                echo $_SESSION['respuestaAdmin'];
                unset($_SESSION['respuestaAdmin']);
            ?>
        </div>
    <?php endif; ?>

    <h3 class="mb-4">Gestión de Vehículos</h3>

    <div class="card mb-4">
        <div class="card-header">
            <strong>Agregar Vehículo</strong>
        </div>
        <div class="card-body">
            <form action="/" method="post">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="email_conductor" class="form-label">Email del Conductor</label>
                        <input type="email" name="email_conductor" id="email_conductor" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <input type="text" name="Descripción" id="descripcion" class="form-control" required>
                    </div>
                </div>
                <input type="hidden" name="request" value="agregarVehiculo">
                <button type="submit" class="btn btn-primary">Agregar Vehículo</button>
            </form>
        </div>
    </div>

    <?php if (!empty($vehiculos)): ?>
        <h4>Vehículos Registrados</h4>
        <?php foreach ($vehiculos as $vehiculo): ?>
            <div class="card mb-3">
                <div class="card-header">
                    <strong>Vehículo ID: <?php echo $vehiculo->getIdVehiculo(); ?></strong>
                </div>
                <div class="card-body">
                    <form action="/" method="post" class="mb-3">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="email_conductor_<?php echo $vehiculo->getIdVehiculo(); ?>" class="form-label">Email del Conductor</label>
                                <input type="email" name="email_conductor" id="email_conductor_<?php echo $vehiculo->getIdVehiculo(); ?>" value="<?php echo $vehiculo->getEmailConductor(); ?>" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="descripcion_<?php echo $vehiculo->getIdVehiculo(); ?>" class="form-label">Descripción</label>
                                <input type="text" name="Descripción" id="descripcion_<?php echo $vehiculo->getIdVehiculo(); ?>" value="<?php echo $vehiculo->getDescripcion(); ?>" class="form-control" required>
                            </div>
                        </div>
                        <input type="hidden" name="id_vehiculo" value="<?php echo $vehiculo->getIdVehiculo(); ?>">
                        <input type="hidden" name="request" value="actualizarVehiculo">
                        <button type="submit" class="btn btn-warning">Actualizar</button>
                    </form>

                    <form action="/" method="post">
                        <input type="hidden" name="request" value="eliminarVehiculo">
                        <input type="hidden" name="id_vehiculo" value="<?php echo $vehiculo->getIdVehiculo(); ?>">
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="alert alert-warning">
            No hay vehículos registrados.
        </div>
    <?php endif; ?>

</div>
