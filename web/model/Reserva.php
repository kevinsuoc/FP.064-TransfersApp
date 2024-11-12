<?php

require_once __DIR__.'/../util/Database.php';

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
			if (isset($data['id_reserva'])) {$this->id_reserva = $data['id_reserva'];};
			$this->localizador = $data['localizador'];
			if (isset($data['id_hotel'])) {$this->id_hotel = $data['id_hotel'];};
			if (isset($data['id_viajero'])) {$this->id_viajero = $data['id_viajero'];};
			$this->id_tipo_reserva = $data['id_tipo_reserva'];
			$this->email_cliente = $data['email_cliente'];
			$this->id_destino = $data['id_destino'];
			if (isset($data['fecha_entrada'])) {$this->fecha_entrada = $data['fecha_entrada'];};
			if (isset($data['hora_entrada'])) {$this->hora_entrada = $data['hora_entrada'];};
			if (isset($data['numero_vuelo_entrada'])) {$this->numero_vuelo_entrada = $data['numero_vuelo_entrada'];};
			if (isset($data['origen_vuelo_entrada'])) {$this->origen_vuelo_entrada = $data['origen_vuelo_entrada'];};
			if (isset($data['numero_vuelo_salida'])) {$this->numero_vuelo_salida = $data['numero_vuelo_salida'];};
			if (isset($data['hora_recogida'])) {$this->hora_recogida = $data['hora_recogida'];};		
			if (isset($data['hora_vuelo_salida'])) {$this->hora_vuelo_salida = $data['hora_vuelo_salida'];};
			if (isset($data['fecha_vuelo_salida'])) {$this->fecha_vuelo_salida = $data['fecha_vuelo_salida'];};
			$this->num_viajeros = $data['num_viajeros'];
			$this->id_vehiculo = $data['id_vehiculo'];
        }
	}

	public function getLocalizador(){return $this->localizador;}
	public function getIdHotel(){return $this->id_hotel;}
	public function getIdViajero(){return $this->id_viajero;}
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
	}

}
