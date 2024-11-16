<?php

require_once __DIR__.'/../model/Reserva.php';
require_once __DIR__.'/../model/Hotel.php';
require_once __DIR__.'/../model/Vehiculo.php';
require_once __DIR__.'/../model/Hotel.php';
require_once __DIR__.'/../model/Zona.php';
require_once __DIR__.'/../model/TipoReserva.php';


$adminController = new AdminController();

switch($request){
	case 'filtroTrayectos':
	case 'mostrarCalendario': $adminController->mostrarCalendario(); break;
	case 'panelDestinos': $adminController->mostrarPanelDestinos(); break;
	case 'filtroReservas':
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
		$filtroData = $this->obtenerDataFiltro();
		switch($filtroData['tipo']){
			case 'diaria': $reservas = Reserva::getByCreationDate($filtroData['dia']); break;
			case 'mensual': $reservas = Reserva::getByCreationMonth($filtroData['anyo'], $filtroData['mes']); break;
			case 'semanal': $reservas = Reserva::getByCreationWeek($filtroData['anyo'], $filtroData['semana']);break;
			default: $reservas = [];
		}
		$vehiculos = Vehiculo::getVehiculos();
		$destinos = Hotel::getHotels();
		$tiposReserva = TipoReserva::getTiposReserva();
		$dataReservas = [];
		foreach ($reservas as $reserva) {
			$dataReserva = [];
			$dataReserva['reserva'] = $reserva;
			$dataReserva['tipoReservaDescripcion'] = TipoReserva::getReservaPorTipo($reserva->getIdTipoReserva())['Descripción'];
			$dataReservas[] = $dataReserva;
		}
		require __DIR__.'/../view/homepage/panelReservas.php';
	}

	public function mostrarPanelVehiculos(){
		$vehiculos = Vehiculo::getVehiculos();
		require __DIR__.'/../view/homepage/panelVehiculos.php';
	}

	public function mostrarCalendario(){
		$filtroData = $this->obtenerDataFiltro();
		// Preparamos los trayectos
		switch($filtroData['tipo']){
			case 'diaria': $reservas = Reserva::getByTrayectoDate($filtroData['dia']); break;
			case 'mensual': $reservas = Reserva::getByTrayectoMonth($filtroData['anyo'], $filtroData['mes']); break;
			case 'semanal': $reservas = Reserva::getByTrayectoWeek($filtroData['anyo'], $filtroData['semana']);break;
			default: $reservas = [];
		}
	
		$trayectos = [];
		foreach ($reservas as $reserva){
			if (($reserva->getIdTipoReserva() == 1 || $reserva->getIdTipoReserva() == 3) && $this->dentroDeFecha($filtroData, $reserva->getFechaEntrada())){
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
			if (($reserva->getIdTipoReserva() == 2 || $reserva->getIdTipoReserva() == 3 ) && $this->dentroDeFecha($filtroData, $reserva->getFechaVueloSalida())){
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

	private function obtenerDataFiltro(){
		$dataFiltro = [];
		$dataFiltro['tipo'] = $_REQUEST['vista'] ?? 'mensual';
		if ($dataFiltro['tipo'] == 'semanal'){
			$dataFiltro['semana'] = $_REQUEST['semana'] ?? "1";
			$dataFiltro['anyo'] = $_REQUEST['anyo'] ?? "2024";
		} else if ($dataFiltro['tipo'] == 'diaria') {
			$dataFiltro['dia'] = $_REQUEST['dia'] ?? "2024-01-01";
		}
		else {
			$dataFiltro['mes'] = $_REQUEST['mes'] ?? 1;
			$dataFiltro['anyo'] = $_REQUEST['anyo'] ?? 2024;
		}
		return $dataFiltro;
	}

	private function dentroDeFecha($filtroData, $fecha) {
		$fechaDate = new DateTime($fecha);
		switch ($filtroData['tipo']) {
			case 'diaria': 
				$filtroDate = new DateTime($filtroData['dia']);
				return $fechaDate->format('Y-m-d') === $filtroDate->format('Y-m-d');
			case 'semanal':
				$fechaReserva = new DateTime($fecha);
				$anyoReserva = $fechaReserva->format("Y");
				$semanaReserva = $fechaReserva->format("W");
				return $filtroData['anyo'] == $anyoReserva && $filtroData['semana'] == $semanaReserva;
			case 'mensual':
				$month = str_pad($filtroData['mes'], 2, '0', STR_PAD_LEFT);
				$year = $filtroData['anyo'];
				return $fechaDate->format('Y-m') === "$year-$month";
			default:
				return false;
		}
	}
}
