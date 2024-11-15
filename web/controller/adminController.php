<?php

require_once __DIR__.'/../model/Reserva.php';
require_once __DIR__.'/../model/Hotel.php';


$adminController = new AdminController();

switch($request){
	case 'mostrarCalendario': $adminController->mostrarCalendario();
}

class AdminController {

	public function __contruct(){
	}

	public function mostrarCalendario(){
		// Preparamos los trayectos
		$trayectos = [];
		$reservas = Reserva::getReservas();

		foreach ($reservas as $reserva){
			if ($reserva->getIdTipoReserva() == 1 || $reserva->getIdTipoReserva() == 3){
				$trayecto = [];
				$trayecto['tipo'] = "Aeropuerto a hotel";
				$trayecto['localizador'] = $reserva->getLocalizador();
				$trayecto['email'] = $reserva->getEmailCliente();
				$trayecto['vehiculo'] = $reserva->getIdVehiculo();
				$trayecto['num_viajeros'] = $reserva->getNumViajeros();
				$trayecto['dia'] = $reserva->getFechaEntrada();
				$trayecto['hora'] = $reserva->getHoraEntrada();
				$trayecto['origen'] = $reserva->getOrigenVueloEntrada();
				$trayecto['destino'] = Hotel::getHotelById($reserva->getIdDestino())->getUsuario();
				$trayecto['numero_vuelo'] = $reserva->getNumeroVueloSalida();
				$trayectos[] = $trayecto;
			}
			if ($reserva->getIdTipoReserva() == 2 || $reserva->getIdTipoReserva() == 3){
				$trayecto = [];
				$trayecto['tipo'] = "Hotel a aeropuerto";
				$trayecto['localizador'] = $reserva->getLocalizador();
				$trayecto['email'] = $reserva->getEmailCliente();
				$trayecto['vehiculo'] = $reserva->getIdVehiculo();
				$trayecto['num_viajeros'] = $reserva->getNumViajeros();
				$trayecto['dia'] = $reserva->getFechaVueloSalida();
				$trayecto['hora_salida'] = $reserva->getHoraVueloSalida();
				$trayecto['hora'] = $reserva->getHoraRecogida();
				$trayecto['origen'] = "Hotel ".Hotel::getHotelById($reserva->getIdDestino())->getUsuario();
				$trayecto['numero_vuelo'] = $reserva->getNumeroVueloSalida();
				$trayectos[] = $trayecto;
			}
		}
		usort($trayectos, [$this, 'compararTrayectos']);
		require __DIR__.'/../view/homepage/calendario.php';
	}


	private function compararTrayectos($a, $b) {
		$datetimeA = new DateTime($a['dia'] . ' ' . $a['hora']);
		$datetimeB = new DateTime($b['dia'] . ' ' . $b['hora']);
		
		return $datetimeA <=> $datetimeB;
	}

}
