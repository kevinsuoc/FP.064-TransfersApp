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

        <input type="hidden" name="request" value="filtroTrayectos">

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Filtrar</button>
        </div>
    </form>

    <div class="row mt-4">
        <?php foreach ($trayectos as $trayecto): ?>
            <div class="col-md-4 mb-4">
                <div class="card" style="background-color: #f7f7f7; padding: 20px; border: 1px solid #ddd;">
					<h4>Trayecto</h4><hr>
					<p><strong>Fecha:</strong> <?php echo $trayecto['dia'].' '.$trayecto['hora'] ?></p>
                    <p><strong>Localizador:</strong> <?php echo $trayecto['localizador'] ?></p>
                    <p><strong>Email viajero:</strong> <?php echo $trayecto['email'] ?></p>
                    <button class="btn btn-info view-more-btn" data-trayecto='<?php echo json_encode($trayecto); ?>'>Ver más</button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div id="modalCalendario" class="modal fade" tabindex="-1" aria-labelledby="modalCalendarioLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCalendarioLabel">Detalles del Trayecto</h5>
                </div>
                <div class="modal-body">
                    <p id="modal-info"></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modalElement = document.getElementById('modalCalendario');
        const modal = new bootstrap.Modal(modalElement); 
        const viewMoreButtons = document.querySelectorAll('.view-more-btn');
        const modalInfo = document.getElementById('modal-info');

        viewMoreButtons.forEach(button => {
            button.addEventListener('click', function() {
                const trayecto = JSON.parse(this.getAttribute('data-trayecto'));

                if (trayecto.tipoid == 1) {
                    modalInfo.innerHTML = `
                        <p><strong>Tipo de trayecto:</strong> ${trayecto.tipo}</p>
                        <p><strong>Localizador:</strong> ${trayecto.localizador}</p>
                        <p><strong>Email viajero:</strong> ${trayecto.email}</p>
                        <p><strong>Cantidad de viajeros:</strong> ${trayecto.num_viajeros}</p>
                        <p><strong>Día de trayecto:</strong> ${trayecto.dia}</p>
                        <p><strong>Hora de trayecto:</strong> ${trayecto.hora}</p>
                        <p><strong>Origen:</strong> ${trayecto.origen}</p>
                        <p><strong>Destino:</strong> ${trayecto.destino}</p>
                        <p><strong>Vehículo:</strong> ${trayecto.vehiculo || 'Vehículo no asignado'}</p>
                        <p><strong>Email conductor:</strong> ${trayecto.email_conductor || 'Conductor no asignado'}</p>
                        <p><strong>Precio:</strong> 10 EUR</p>
                    `;
                } else if (trayecto.tipoid == 2) {
                    modalInfo.innerHTML = `
                        <p><strong>Tipo de trayecto:</strong> ${trayecto.tipo}</p>
                        <p><strong>Localizador:</strong> ${trayecto.localizador}</p>
                        <p><strong>Email viajero:</strong> ${trayecto.email}</p>
                        <p><strong>Cantidad de viajeros:</strong> ${trayecto.num_viajeros}</p>
                        <p><strong>Día de trayecto:</strong> ${trayecto.dia}</p>
                        <p><strong>Hora de trayecto:</strong> ${trayecto.hora_salida}</p>
                        <p><strong>Origen:</strong> ${trayecto.origen}</p>
                        <p><strong>Destino:</strong> Aeropuerto</p>
                        <p><strong>Vehículo:</strong> ${trayecto.vehiculo || 'Vehículo no asignado'}</p>
                        <p><strong>Email conductor:</strong> ${trayecto.email_conductor || 'Conductor no asignado'}</p>
                        <p><strong>Precio:</strong> 10 EUR</p>
                    `;
                }

                modal.show(); 
            });
        });

        modalElement.addEventListener('click', function(event) {
            if (event.target === modalElement) {
                modal.hide();
            }
        });
    });
</script>
