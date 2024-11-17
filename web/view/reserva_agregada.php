<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h3>Reserva realizada - detalles</h3>
        </div>
        <div class="card-body">
            <p><strong>Reserva realizada por:</strong> <?php echo $reservador; ?></p>
            <p><strong>Localizador:</strong> <?php echo $reserva->getLocalizador(); ?></p>
            <p><strong>Tipo de reserva:</strong> <?php echo $tipoReserva; ?></p>
            <p><strong>Email del cliente:</strong> <?php echo $reserva->getEmailCliente(); ?></p>
            <p><strong>Fecha de reserva:</strong> <?php echo $reserva->getFechaReserva(); ?></p>
            <p><strong>Fecha de última modificación:</strong> <?php echo $reserva->getFechaModificacion(); ?></p>
            <p><strong>Hotel de destino/recogida:</strong> <?php echo $hotelDestinoRecogida; ?></p>
            
            <?php if (null !== $reserva->getFechaEntrada()) { ?>
                <p><strong>Fecha de entrada:</strong> <?php echo $reserva->getFechaEntrada(); ?></p>
            <?php } ?>
            
            <?php if (null !== $reserva->getHoraEntrada()) { ?>
                <p><strong>Hora de entrada:</strong> <?php echo $reserva->getHoraEntrada(); ?></p>
            <?php } ?>
            
            <?php if (null !== $reserva->getNumeroVueloEntrada()) { ?>
                <p><strong>Número de vuelo de entrada:</strong> <?php echo $reserva->getNumeroVueloEntrada(); ?></p>
            <?php } ?>
            
            <?php if (null !== $reserva->getOrigenVueloEntrada()) { ?>
                <p><strong>Origen del vuelo de entrada:</strong> <?php echo $reserva->getOrigenVueloEntrada(); ?></p>
            <?php } ?>
            
            <?php if (null !== $reserva->getHoraRecogida()) { ?>
                <p><strong>Hora de recogida:</strong> <?php echo $reserva->getHoraRecogida(); ?></p>
            <?php } ?>
            
            <?php if (null !== $reserva->getNumeroVueloSalida()) { ?>
                <p><strong>Número de vuelo de salida:</strong> <?php echo $reserva->getNumeroVueloSalida(); ?></p>
            <?php } ?>
            
            <?php if (null !== $reserva->getHoraVueloSalida()) { ?>
                <p><strong>Hora de vuelo de salida:</strong> <?php echo $reserva->getHoraVueloSalida(); ?></p>
            <?php } ?>
            
            <?php if (null !== $reserva->getFechaVueloSalida()) { ?>
                <p><strong>Fecha de vuelo de salida:</strong> <?php echo $reserva->getFechaVueloSalida(); ?></p>
            <?php } ?>
            
            <p><strong>Número de viajeros:</strong> <?php echo $reserva->getNumViajeros(); ?></p>
        </div>
        <div class="card-footer text-center">
            <a href="/" class="btn btn-secondary">Volver</a>
        </div>
    </div>
</div>
