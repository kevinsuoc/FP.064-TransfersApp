<?php

require_once __DIR__.'/../util/Database.php';

/*
	La clase modelo Hotel, allí hay explicaciones.
*/
class Reserva {
	private $id_reserva;
	private $localizador;
	private $id_hotel;
	private $id_viajero;
	private $id_tipo_reserva;
	private $email_cliente;
	private $fecha_reserva;
	private $fecha_modificacion;
	private $id_destino;
	private $fecha_entrada;
	private $hora_entrada;
	private $numero_vuelo_entrada;
	private $origen_vuelo_entrada;
	private $hora_recogida;
	private $numero_vuelo_salida;
	private $hora_vuelo_salida;
	private $fecha_vuelo_salida;
	private $num_viajeros;
	private $id_vehiculo;

	function __construct($data = null){
		if ($data) {
			if (isset($data['id_reserva'])) {$this->setIdReserva($data['id_reserva']);}
			else {echo 'no';}
			$this->setLocalizador($data['localizador']);
			if (isset($data['id_hotel'])) {$this->setIdHotel($data['id_hotel']);};
			if (isset($data['id_viajero'])) {$this->setIdViajero($data['id_viajero']);};
			$this->setIdTipoReserva($data['id_tipo_reserva']);
			$this->setEmailCliente($data['email_cliente']);
			if (isset($data['fecha_reserva'])) {$this->setFechaReserva($data['fecha_reserva']);}
			else {$this->setFechaReserva(date('Y-m-d'));};
			if (isset($data['fecha_modificacion'])) {$this->setFechaModificacion($data['fecha_modificacion']);};
			$this->setIdDestino($data['id_destino']);
			if (isset($data['fecha_entrada'])) {$this->setFechaEntrada($data['fecha_entrada']);};
			if (isset($data['hora_entrada'])) {$this->setHoraEntrada($data['hora_entrada']);};
			if (isset($data['numero_vuelo_entrada'])) {$this->setNumeroVueloEntrada($data['numero_vuelo_entrada']);};
			if (isset($data['origen_vuelo_entrada'])) {$this->setOrigenVueloEntrada($data['origen_vuelo_entrada']);};
			if (isset($data['numero_vuelo_salida'])) {$this->setNumeroVueloSalida($data['numero_vuelo_salida']);};
			if (isset($data['hora_recogida'])) {$this->setHoraRecogida($data['hora_recogida']);};		
			if (isset($data['hora_vuelo_salida'])) {$this->setHoraVueloSalida($data['hora_vuelo_salida']);};
			if (isset($data['fecha_vuelo_salida'])) {$this->setFechaVueloSalida($data['fecha_vuelo_salida']);};
			$this->setNumViajeros($data['num_viajeros']);
			$this->setIdVehiculo($data['id_vehiculo']);
        }
	}

	public function getIdReserva(){return $this->id_reserva;}
	public function getLocalizador(){return $this->localizador;}
	public function getIdHotel(){return $this->id_hotel;}
	public function getIdViajero(){return $this->id_viajero;}
	public function getIdTipoReserva(){return $this->id_tipo_reserva;}
	public function getEmailCliente(){return $this->email_cliente;}
	public function getFechaReserva(){return $this->fecha_reserva;}
	public function getFechaModificacion(){return $this->fecha_modificacion;}
	public function getIdDestino(){return $this->id_destino;}
	public function getFechaEntrada(){return $this->fecha_entrada;}
	public function getHoraEntrada(){return $this->hora_entrada;}
	public function getNumeroVueloEntrada(){return $this->numero_vuelo_entrada;}
	public function getOrigenVueloEntrada(){return $this->origen_vuelo_entrada;}
	public function getHoraRecogida(){return $this->hora_recogida;}
	public function getNumeroVueloSalida(){return $this->numero_vuelo_salida;}
	public function getHoraVueloSalida(){return $this->hora_vuelo_salida;}
	public function getFechaVueloSalida(){return $this->fecha_vuelo_salida;}
	public function getNumViajeros(){return $this->num_viajeros;}
	public function getIdVehiculo(){return $this->id_vehiculo;}

	public function setIdReserva($id_reserva){$this->id_reserva = $id_reserva;}
	public function setLocalizador($localizador){ $this->localizador = $localizador;}
	public function setIdHotel($id_hotel){ $this->id_hotel = $id_hotel;}
	public function setIdViajero($id_viajero){ $this->id_viajero = $id_viajero;}
	public function setIdTipoReserva($id_tipo_reserva){ $this->id_tipo_reserva = $id_tipo_reserva;}
	public function setEmailCliente($email_cliente){ $this->email_cliente = $email_cliente;}
	public function setFechaReserva($fecha_reserva){ $this->fecha_reserva = $fecha_reserva;}
	public function setFechaModificacion($fecha_modificacion){ $this->fecha_modificacion = $fecha_modificacion;}
	public function setIdDestino($id_destino){ $this->id_destino = $id_destino;}
	public function setFechaEntrada($fecha_entrada){ $this->fecha_entrada = $fecha_entrada;}
	public function setHoraEntrada($hora_entrada){ $this->hora_entrada = $hora_entrada;}
	public function setNumeroVueloEntrada($numero_vuelo_entrada){ $this->numero_vuelo_entrada = $numero_vuelo_entrada;}
	public function setOrigenVueloEntrada($origen_vuelo_entrada){ $this->origen_vuelo_entrada = $origen_vuelo_entrada;}
	public function setHoraRecogida($hora_recogida){ $this->hora_recogida = $hora_recogida;}
	public function setNumeroVueloSalida($numero_vuelo_salida){ $this->numero_vuelo_salida = $numero_vuelo_salida;}
	public function setHoraVueloSalida($hora_vuelo_salida){ $this->hora_vuelo_salida = $hora_vuelo_salida;}
	public function setFechaVueloSalida($fecha_vuelo_salida){ $this->fecha_vuelo_salida = $fecha_vuelo_salida;}
	public function setNumViajeros($num_viajeros){ $this->num_viajeros = $num_viajeros;}
	public function setIdVehiculo($id_vehiculo){ $this->id_vehiculo = $id_vehiculo;}


	public function save(){
		$db = new Database();
		$db->query("INSERT INTO transfer_reservas 
		(localizador, 
		id_hotel, 
		id_viajero, 
		id_tipo_reserva, 
		email_cliente, 
		id_destino, 
		fecha_entrada, 
		hora_entrada, 
		numero_vuelo_entrada, 
		origen_vuelo_entrada, 
		hora_recogida, 
		numero_vuelo_salida, 
		hora_vuelo_salida, 
		fecha_vuelo_salida, 
		num_viajeros, 
		id_vehiculo)
			VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
			ON DUPLICATE KEY UPDATE
			localizador = VALUES(localizador),
			id_hotel = VALUES(id_hotel),
			id_viajero = VALUES(id_viajero),
			id_tipo_reserva = VALUES(id_tipo_reserva),
			email_cliente = VALUES(email_cliente),
			id_destino = VALUES(id_destino),
			fecha_entrada = VALUES(fecha_entrada),
			hora_entrada = VALUES(hora_entrada),
			numero_vuelo_entrada = VALUES(numero_vuelo_entrada),
			origen_vuelo_entrada = VALUES(origen_vuelo_entrada),
			hora_recogida = VALUES(hora_recogida),
			numero_vuelo_salida = VALUES(numero_vuelo_salida),
			hora_vuelo_salida = VALUES(hora_vuelo_salida),
			fecha_vuelo_salida = VALUES(fecha_vuelo_salida),
			num_viajeros = VALUES(num_viajeros),
			id_vehiculo = VALUES(id_vehiculo);
		", [$this->localizador, 
			$this->id_hotel, 
			$this->id_viajero,
			$this->id_tipo_reserva, 
			$this->email_cliente,
			$this->id_destino,
			$this->fecha_entrada,
			$this->hora_entrada,
			$this->numero_vuelo_entrada,
			$this->origen_vuelo_entrada,
			$this->hora_recogida,
			$this->numero_vuelo_salida,
			$this->hora_vuelo_salida,
			$this->fecha_vuelo_salida,
			$this->num_viajeros,
			$this->id_vehiculo,
		]);
		$this->id_reserva = $db->getLastId();
		$this->fecha_modificacion = date('Y-m-d');
	}

	public static function getReservas(){
		$db = new Database();
		$db->query("SELECT * FROM transfer_reservas");

		$reservaData = $db->fetchAll();
		$reservas = [];
		foreach ($reservaData as $reserva){
			$reservas[] = new Reserva($reserva);
		}
		return $reservas;
	}


	public static function getReservasEmail($email){
		$db = new Database();
		$db->query("SELECT * FROM transfer_reservas WHERE email_cliente = ?", [$email]);

		$reservaData = $db->fetchAll();
		$reservas = [];
		foreach ($reservaData as $reserva){
			$reservas[] = new Reserva($reserva);
		}
		return $reservas;
	}



	// Busca una reserva por su ID
    public static function getReservaById($id_reserva) {
        $db = new Database();
        $db->query("SELECT * FROM transfer_reservas WHERE id_reserva = ?", [$id_reserva]);
        
        if ($db->rowCount() < 1) {
            throw new PublicException("Reserva no encontrada");
        }
		// obtiene los datos de la reserva
        $data = $db->fetch();
        return new Reserva($data); // crea una nueva instancia de Reserva
    }

		// Actualiza los datos de la reserva en la base de datos 
    public function update() {
        $db = new Database();

		// actualizamos los datos de la reserva en la base de datos 
        $db->query("UPDATE transfer_reservas SET id_tipo_reserva = ?, email_cliente = ?, id_destino = ?, fecha_entrada = ?, hora_entrada = ?, numero_vuelo_entrada = ?, origen_vuelo_entrada = ?, fecha_vuelo_salida = ?, hora_vuelo_salida = ?, num_viajeros = ?, id_vehiculo = ? WHERE id_reserva = ?", [
            $this->id_tipo_reserva,
            $this->email_cliente,
            $this->id_destino,
            $this->fecha_entrada,
            $this->hora_entrada,
            $this->numero_vuelo_entrada,
            $this->origen_vuelo_entrada,
            $this->fecha_vuelo_salida,
            $this->hora_vuelo_salida,
            $this->num_viajeros,
            $this->id_vehiculo,
            $this->id_reserva
        ]);
    }

	public static function DeleteById($id_reserva){
		$db = new Database();
		$db->query("DELETE FROM transfer_reservas WHERE id_reserva = ?", [$id_reserva]);
	}
}
