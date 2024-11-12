<p><?php echo 'Reserva realizada por: '.$reservador; ?></p>
<p><?php echo 'Localizador: '.$reserva->getLocalizador(); ?></p>
<p><?php echo 'Tipo reserva: '.$tipoReserva; ?></p>
<p><?php echo 'Email cliente: '.$reserva->getEmailCliente(); ?></p>
<p><?php echo 'Fecha de reserva: '.$reserva->getFechaReserva(); ?></p>
<p><?php echo 'Fecha de ultima modificacion: '.$reserva->getFechaModificacion(); ?></p>
<p><?php echo 'Hotel de destino/recogida: '.$hotelDestinoRecogida; ?></p>
<p><?php if (null !== $reserva->getFechaEntrada()) {echo 'Fecha entrada: '.$reserva->getFechaEntrada();}; ?></p>
<p><?php if (null !== $reserva->getHoraEntrada()) {echo 'Hora entrada: '.$reserva->getHoraEntrada();}; ?></p>
<p><?php if (null !== $reserva->getNumeroVueloEntrada()) {echo 'Numero de vuelo de entrada: '.$reserva->getNumeroVueloEntrada();}; ?></p>
<p><?php if (null !== $reserva->getOrigenVueloEntrada()) {echo 'Origen de vuelo de entrada: '.$reserva->getOrigenVueloEntrada();}; ?></p>
<p><?php if (null !== $reserva->getHoraRecogida()) {echo 'Hora de recogida: '.$reserva->getHoraRecogida();}; ?></p>
<p><?php if (null !== $reserva->getNumeroVueloSalida()) {echo 'Numero de vuelo de salida: '.$reserva->getNumeroVueloSalida();}; ?></p>
<p><?php if (null !== $reserva->getHoraVueloSalida()) {echo 'Hora de vuelo de salida: '.$reserva->getHoraVueloSalida();}; ?></p>
<p><?php if (null !== $reserva->getFechaVueloSalida()) {echo 'Fecha de vuelo de salida: '.$reserva->getFechaVueloSalida();}; ?></p>
<p><?php echo 'Numero de viajeros: '.$reserva->getNumViajeros(); ?></p>
<p><?php echo 'Vehiculo: '.$descripcionVehiculo; ?></p>

<a href="/">Volver</a>
