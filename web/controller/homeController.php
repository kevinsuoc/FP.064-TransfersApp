<?php

/*
	Controlador que se encarga de redireccionar a la pagina principal.
	En caso de existir una sesion, esta es la pagina de login.
	En caso de ser un usuario, la pagina principal sera la correspondiente.
	En otro caso, se da un error.

	Esto podría ser una simple funcion, pero se usa una clase
	para mantener la consistencia de diseño con otros controladores.

	Variables relevantes:
	$_SESSION['userSession']) contiene una instancia de la clase Session y se usa para
	determinar si hay un usuario logeado o no.

	$error - Utilizada por la vista de error, un mensaje.
	
	$tiposReserva - Array utilizado por la vista homepage 
	para mostrar los tipos de reserva a elegir entre.
*/

require_once __DIR__.'/../model/TipoReserva.php';
require_once __DIR__.'/../model/Reserva.php';
require_once __DIR__.'/../model/Hotel.php';
require_once __DIR__.'/../model/Vehiculo.php';


$homeController = new HomeController();
$homeController->mostrarHomepage();

class HomeController {
	public function __construct() {
	}

	/*
		Los tipos de reserva son utilizados por las vistas para mostrar
		a los usuarios las opciones adecuadas.
	*/
	public function mostrarHomepage() {
		if (!isset($_SESSION['userSession'])){
			require __DIR__.'/../view/login.php';
		}
		else if ($_SESSION['userSession']->getSessionType() === sessionType::admin){
			$this->mostrarAdminHomepage(TipoReserva::getTiposReserva());
		}
		else if ($_SESSION['userSession']->getSessionType() === sessionType::regular){
			$this->mostrarRegularHomepage(TipoReserva::getTiposReserva());
		}
		else {
			unset($_SESSION['userSession']);
			$this->mostrarErrorPage("Tipo de usuario desconocido");
		}
	}

	private function mostrarError($error){
		require __DIR__.'/../view/error.php';
	}

	private function mostrarAdminHomepage($tiposReserva){		
		require __DIR__.'/../view/homepage/admin.php';
	}

	private function mostrarRegularHomepage($tiposReserva){
		// Datos de control de perfil
		if (isset($_SESSION["mensajeActualizarPassword"])){
			$mensajePassword = $_SESSION["mensajeActualizarPassword"];
			unset($_SESSION["mensajeActualizarPassword"]);
		}
		if (isset($_SESSION["mensajeActualizarViajero"])){
			$mensajeViajero = $_SESSION["mensajeActualizarViajero"];
			unset($_SESSION["mensajeActualizarViajero"]);
		}
		if (isset($_SESSION["mensajeReservaEliminada"])){
			$mensajeReservaEliminada = $_SESSION["mensajeReservaEliminada"];
			unset($_SESSION["mensajeReservaEliminada"]);
		}

		// Peparando perfil
		$perfil = $_SESSION['userSession']->getViajero();

		//Preparando data de reservas
		$destinos = Hotel::getHotels();
		$reservas = Reserva::getReservasEmail($_SESSION['userSession']->getViajero()->getEmail());
		$dataReservas = [];
		foreach ($reservas as $reserva) {
			$dataReserva = [];
			$dataReserva['reserva'] = $reserva;
			if ($reserva->getIdViajero() !== null)
				$dataReserva['reservador'] = Viajero::getViajeroById($reserva->getIdViajero())->getNombreCompleto();
			else
				$dataReserva['reservador'] = 'Administrador';
			$dataReserva['tipoReservaDescripcion'] = TipoReserva::getReservaPorTipo($reserva->getIdTipoReserva())['Descripción'];
			$dataReserva['hotelDestinoRecogida'] = Hotel::getHotelById($reserva->getIdDestino());
			$dataReserva['descripcionVehiculo'] = Vehiculo::getVehiculoById($reserva->getIdVehiculo())->getDescripcion();
			$dataReservas[] = $dataReserva;
		}

		// Mostrar vista
		require __DIR__.'/../view/homepage/regular.php';
	}
}

