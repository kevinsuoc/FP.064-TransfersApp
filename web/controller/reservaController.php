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
	case 'reserva': $reservaController->mostrarFormularioReserva(); break;
	case 'reservar': $reservaController->reservar(); break;
	case 'eliminarReserva': $reservaController->eliminarReserva(); break;
	case 'actualizarReserva': $reservaController->actualizarReserva(); break;
}

class ReservaController {
	private $session;
	private $reserva;
	private $tipoReserva;
	private $errorReserva;

	/*
		Si no hay una sesión, enviamos un mensaje de error.
	*/
	function __construct(){
		if (!isset($_SESSION["userSession"])){
			$this->mostrarPaginaError("No se puede reservar sin estar logeado"); exit();
		}
		$this->session = $_SESSION['userSession'];
		$this->tipoReserva = $_REQUEST['tipoReserva'] ?? $this->tipoReserva;
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
			$this->mostrarFormularioReserva();
		}
	}

	public function mostrarFormularioReserva(){
		// Preparamos los datos de la vista
		$destinos = Hotel::getHotels();
		if ($this->session->getSessionType() === SessionType::regular)
			$email = $this->session->getEmail();
		$errorReserva = $this->errorReserva;
		$tipoReserva = $this->tipoReserva;
		// Llamamos a la vista
		switch ($tipoReserva){
			case 1: require __DIR__.'/../view/forms/aeropuerto-hotel.php'; break;
			case 2: require __DIR__.'/../view/forms/hotel-aeropuerto.php'; break;
			case 3: require __DIR__.'/../view/forms/ida-y-vuelta.php'; break;
		}
	}

	/*
		Creamos un objeto Reserva con los datos apropiados. Luego usamos save() para
		guardarlos en la base de datos. Los campos son auto descriptivos y
		corresponden a los nombres de estos en la tabla Reserva
	 */
	private function agregarReservaAeropuertoHotel(){
		$data = [];
		// Generar localizador automaticamente de 5 letras
		$data['localizador'] = substr(str_shuffle(MD5(microtime())), 0, 5);
		$data['id_tipo_reserva'] = $_POST['tipoReserva'];
		$data['email_cliente'] = $_POST['email_cliente'];
		$data['id_destino'] = $_POST['id_destino'];
		$data['fecha_entrada'] = $_POST['fecha_entrada'];
		$data['hora_entrada'] = $_POST['hora_entrada'];
		$data['numero_vuelo_entrada'] = $_POST['numero_vuelo_entrada'];
		$data['origen_vuelo_entrada'] = $_POST['origen_vuelo_entrada'];
		$data['num_viajeros'] = $_POST['num_viajeros'];

		// Guardando el ID de viajero si existe.
		if ($this->session->getSessionType() == SessionType::regular)
			$data['id_viajero'] = $this->session->getViajero()->getIdViajero();
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
		$data['hora_recogida'] = $_POST['hora_recogida'];
		$data['numero_vuelo_salida'] = $_POST['numero_vuelo_salida'];
		if ($this->session->getSessionType() == SessionType::regular)
			$data['id_viajero'] = $this->session->getViajero()->getIdViajero();
		$this->reserva = new Reserva($data);
		$this->reserva->save();
	}

	private function agregarReservaIdaYVuelta(){
		$data = [];
		// Datos conjuntos
		$data['localizador'] = substr(str_shuffle(MD5(microtime())), 0, 5);
		$data['id_tipo_reserva'] = $_POST['tipoReserva'];
		$data['email_cliente'] = $_POST['email_cliente'];
		$data['id_destino'] = $_POST['id_destino'];
		$data['num_viajeros'] = $_POST['num_viajeros'];
		if ($this->session->getSessionType() == SessionType::regular)
			$data['id_viajero'] = $this->session->getViajero()->getIdViajero();

		// Datos aeropuerto->hotel
		$data['fecha_entrada'] = $_POST['fecha_entrada'];
		$data['hora_entrada'] = $_POST['hora_entrada'];
		$data['numero_vuelo_entrada'] = $_POST['numero_vuelo_entrada'];
		$data['origen_vuelo_entrada'] = $_POST['origen_vuelo_entrada'];
		
		// Datos hotel->aeropuerto
		$data['fecha_vuelo_salida'] = $_POST['fecha_vuelo_salida'];
		$data['hora_vuelo_salida'] = $_POST['hora_vuelo_salida'];
		$data['hora_recogida'] = $_POST['hora_recogida'];
		$data['numero_vuelo_salida'] = $_POST['numero_vuelo_salida'];

		$this->reserva = new Reserva($data);
		$this->reserva->save();
	}
	
	/*
		Preparamos una pequeña vista con los datos de la reserva.
		También nos servirá para confirmar que la reserva fue exitosa
	*/
	private function mostrarExito(){
		if ($this->session->getSessionType() == SessionType::regular){
			$viajero = $this->session->getViajero();
			$reservador = $viajero->getNombreCompleto();
		}
		else
			$reservador = "Administrador";
		$reserva = $this->reserva;
		$hotelDestinoRecogida = Hotel::getHotelById($reserva->getIdDestino())->getUsuario();
		$tipoReserva = TipoReserva::getReservaPorTipo($this->tipoReserva)['Descripción'];
		require __DIR__.'/../view/reserva_agregada.php';
	}

	private function mostrarPaginaError($error){
		require __DIR__.'/../view/error.php';
	}


	// Editar reserva 
    public function editarReserva($id_reserva) {
        // buscamos reserva por su ID
        $this->reserva = Reserva::getReservaById($id_reserva);
        require __DIR__.'/../view/forms/editar-reserva.php'; // Llamamos a la vista
    }

    public function actualizarReserva() {
		$reserva = new Reserva($_POST);
		$reserva->save();
		$_SESSION["mensajeReservaActualizada"] = "Reserva actualizada";
		header("Location: /"); exit();
    }

	// Eliminar reserva
	public function eliminarReserva(){
		Reserva::DeleteById($_POST['id_reserva']);
		$_SESSION["mensajeReservaEliminada"] = "Reserva eliminada";
		header("Location: /"); exit();
	}

}






