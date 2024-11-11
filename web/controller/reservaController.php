<?php

/*
	Controlador de reservas
 */

require __DIR__.'/../model/Hotel.php';
require __DIR__.'/../model/Zona.php';

$reservaController = new ReservaController();

switch($request){
	case 'reserva': $reservaController->showForm(); break;
	case 'reservar': $reservaController->reservar(); break;
}

class ReservaController {
	private $viajero;
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
		$this->viajero = $_SESSION['userSession'];
		$this->tipoReserva = $_REQUEST['tipoReserva'];
	}

	/*
		Agregamos la reserva, en caso de error volvemos a la vista con un mensaje.
	*/
	public function reservar(){
		try {
			switch ($tipoReserva){
				case 1: $this->reservarAeropuertoHotel(); break;
				case 2: $this->reservaerHotelAeropuerto(); break;
				case 3: $this->reservarIdaYVuelta(); break;
			}
		} catch (PublicException $e){
			$this->errorReserva = "Error: ".$e->getMessage();
			showForm();
		}
	}

	/*
		Preparamos los datos que la vista necesita y la llamamos.
	*/
	public function showForm(){
		$destinos = Hotel::getHotels();
		foreach ($destinos as &$destino){
			$this->destino['descripcion'] = Zona::getZonaById($destino[1])->getDescription();
		}
		$this->destinos = $destinos;
		if ($this->viajero->getSessionType() === SessionType::regular)
			$this->email = $this->viajero->getEmail();
		$this->mostrarFormularioReserva();
	}

	private function agregarReservaAeropuertoHotel(){
		$data = [];
		$data['localizador'] = substr(str_shuffle(MD5(microtime())), 0, 20);
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
		success();
	}

	private function agregarReservaHotelAeropuerto(){
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
}






