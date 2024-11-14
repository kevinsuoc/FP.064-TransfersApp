<?php

/*
	Controlador de reservas

	Requests disponibles:
	reserva: Mostrar formulario de reserva
	reservar: intento de reserva
 */

require __DIR__.'/../model/Hotel.php';
require __DIR__.'/../model/Zona.php';
require __DIR__.'/../model/Reserva.php';
require __DIR__.'/../model/TipoReserva.php';
require __DIR__.'/../model/Vehiculo.php';

$reservaController = new ReservaController();

switch($request){
	case 'reserva': $reservaController->showForm(); break;
	case 'reservar': $reservaController->reservar(); break;
}

class ReservaController {
	private $session;
	private $reserva;
	private $tipoReserva;
	private $destinos;
	private $email;
	private $errorReserva;

	/*
		Si no hay una sesión, enviamos un mensaje de error.
	*/
	function __construct(){
		if (!isset($_SESSION["userSession"])){
			$this->mostrarPaginaError("No se puede reservar sin estar logeado"); exit();
		}
		$this->session = $_SESSION['userSession'];
		$this->tipoReserva = $_REQUEST['tipoReserva'];
	}

	/*
		Agregamos la reserva, en caso de error volvemos a la vista con un mensaje.
	*/
	public function reservar(){
		try {
			switch ($this->tipoReserva){
				case 1: $this->agregarReservaAeropuertoHotel(); break;
				case 2: $this->agregarReservaHotelAeropuerto(); break;
				case 3: $this->agregarReservaIdaYVuelta(); break;
			}
			$this->mostrarExito();
		} catch (PublicException $e){
			$this->errorReserva = "Error: ".$e->getMessage();
			$this->showForm();
		}
	}

	/*
		Preparamos los datos que la vista necesita y la llamamos.
	*/
	public function showForm(){
		$this->destinos = Hotel::getHotels();
		if ($this->session->getSessionType() === SessionType::regular)
			$this->email = $this->session->getEmail();
		$this->mostrarFormularioReserva();
	}

	private function agregarReservaAeropuertoHotel(){
		$data = [];
		$data['localizador'] = substr(str_shuffle(MD5(microtime())), 0, 5);
		$data['id_tipo_reserva'] = $_POST['tipoReserva'];
		$data['email_cliente'] = $_POST['email_cliente'];
		$data['id_destino'] = $_POST['id_destino'];
		$data['fecha_entrada'] = $_POST['fecha_entrada'];
		$data['hora_entrada'] = $_POST['hora_entrada'];
		$data['numero_vuelo_entrada'] = $_POST['numero_vuelo_entrada'];
		$data['origen_vuelo_entrada'] = $_POST['origen_vuelo_entrada'];
		$data['num_viajeros'] = $_POST['num_viajeros'];
		$data['id_vehiculo'] = 1;
		$this->reserva = new Reserva($data);
		$this->reserva->save();
	}

	private function agregarReservaHotelAeropuerto(){
		$data = [];
		$data['localizador'] = substr(str_shuffle(MD5(microtime())), 0, 5);
		$data['id_tipo_reserva'] = $_POST['tipoReserva'];
		$data['email_cliente'] = $_POST['email_cliente'];
		$data['id_destino'] = $_POST['id_destino'];
		$data['fecha_vuelo_salida'] = $_POST['fecha_vuelo_salida'];
		$data['hora_vuelo_salida'] = $_POST['hora_vuelo_salida'];
		$data['num_viajeros'] = $_POST['num_viajeros'];
		$data['id_vehiculo'] = 1;
		$data['hora_recogida'] = $_POST['hora_recogida'];
		$this->reserva = new Reserva($data);
		$this->reserva->save();
	}

	private function agregarReservaIdaYVuelta(){
		$data = [];
		$data[''] = $_POST[''];
		$data[''] = $_POST[''];
		$data[''] = $_POST[''];
		$data[''] = $_POST[''];
		$data[''] = $_POST[''];
		$data[''] = $_POST[''];
		$data[''] = $_POST[''];
		$data[''] = $_POST[''];
		$data[''] = $_POST[''];
		$data[''] = $_POST[''];
		$this->reserva = new Reserva($data);
	}

	private function mostrarFormularioReserva(){
		// Preparamos los datos de la vista
		$errorReserva = $this->errorReserva;
		$tipoReserva = $this->tipoReserva;
		$destinos = $this->destinos;
		$email = $this->email;
		// Llamamos a la vista
		switch ($tipoReserva){
			case 1: require __DIR__.'/../view/forms/aeropuerto-hotel.php'; break;
			case 2: require __DIR__.'/../view/forms/hotel-aeropuerto.php'; break;
			case 3: require __DIR__.'/../view/forms/ida-y-vuelta.php'; break;
		}
	}
	
	public function mostrarPaginaError($error){
		require __DIR__.'/../view/error.php';
	}

	public function mostrarExito(){
		if ($this->session->getSessionType() == SessionType::regular){
			$viajero = $this->session->getViajero();
			$reservador = $viajero->getNombre().' '.$viajero->getApellido1().' '.$viajero->getApellido2();
		}
		else
			$reservador = "Administrador";
		$reserva = $this->reserva;
		$hotelDestinoRecogida = Hotel::getHotelById($reserva->getIdDestino())->getUsuario();
		$tipoReserva = TipoReserva::getReservaPorTipo($this->tipoReserva)['Descripción'];
		$descripcionVehiculo = Vehiculo::getVehiculoById($reserva->getIdVehiculo())->getDescripcion();
		require __DIR__.'/../view/reserva_agregada.php';
	}
}






