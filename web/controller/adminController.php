<?php

require_once __DIR__.'/../model/Reserva.php';
require_once __DIR__.'/../model/Hotel.php';
require_once __DIR__.'/../model/Vehiculo.php';
require_once __DIR__.'/../model/Hotel.php';
require_once __DIR__.'/../model/Zona.php';
require_once __DIR__.'/../model/TipoReserva.php';


$adminController = new AdminController();

switch($request){
	case 'mostrarCalendario': $adminController->mostrarCalendario(); break;
	case 'panelDestinos': $adminController->mostrarPanelDestinos(); break;
	case 'panelReservas': $adminController->mostrarPanelReservas(); break; 
	case 'panelVehiculos': $adminController->mostrarPanelVehiculos(); break;
}

class AdminController {

	public function __contruct(){
	}


	public function mostrarPanelDestinos(){
		$destinos = Hotel::getHotels();
		$zonas = Zona::getZonas();
		require __DIR__.'/../view/homepage/panelDestinos.php';
	}

	public function mostrarPanelReservas(){
		$vehiculos = Vehiculo::getVehiculos();
		$reservas = Reserva::getReservas();
		$destinos = Hotel::getHotels();
		$tiposReserva = TipoReserva::getTiposReserva();
		$dataReservas = [];
		foreach ($reservas as $reserva) {
			$dataReserva = [];
			$dataReserva['reserva'] = $reserva;
			$dataReserva['tipoReservaDescripcion'] = TipoReserva::getReservaPorTipo($reserva->getIdTipoReserva())['Descripción'];
			if ($reserva->getIdTipoReserva() == 1 || $reserva->getIdTipoReserva() == 3){
				$dataReserva['dia'] = $reserva->getFechaEntrada();
				$dataReserva['hora'] = $reserva->getHoraEntrada();
			}
			else {
				$dataReserva['dia'] = $reserva->getFechaVueloSalida();
				$dataReserva['hora'] = $reserva->getHoraRecogida();
			}
			$dataReservas[] = $dataReserva;
		}
		usort($dataReservas, [$this, 'comparar']);
		require __DIR__.'/../view/homepage/panelReservas.php';
	}

	public function mostrarPanelVehiculos(){
		$vehiculos = Vehiculo::getVehiculos();
		require __DIR__.'/../view/homepage/panelVehiculos.php';
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
				$trayecto['num_viajeros'] = $reserva->getNumViajeros();
				$trayecto['dia'] = $reserva->getFechaVueloSalida();
				$trayecto['hora_salida'] = $reserva->getHoraVueloSalida();
				$trayecto['hora'] = $reserva->getHoraRecogida();
				$trayecto['origen'] = "Hotel ".Hotel::getHotelById($reserva->getIdDestino())->getUsuario();
				$trayecto['numero_vuelo'] = $reserva->getNumeroVueloSalida();
				$trayectos[] = $trayecto;
			}
		}
		usort($trayectos, [$this, 'comparar']);
		require __DIR__.'/../view/homepage/calendario.php';
	}


	private function comparar($a, $b) {
		$datetimeA = new DateTime($a['dia'] . ' ' . $a['hora']);
		$datetimeB = new DateTime($b['dia'] . ' ' . $b['hora']);
		
		return $datetimeA <=> $datetimeB;
	}

}
