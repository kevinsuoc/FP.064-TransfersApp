<?php

require_once __DIR__.'/../util/Database.php';

class Reserva {
	private $id_reserva;
	private $localizador;
	private $id_hotel;
	private $id_tipo_reserva;
	private $email_cliente;
	private $fecha_reserva;
	private $fecha_modificacion;
	private $id_destino;
	private $fecha_entrada;
	private $hora_entrada;
	private $numero_vuelo_entrada;
	private $origen_vuelo_entrada;
	private $hora_vuelo_salida;
	private $fecha_vuelo_salida;
	private $num_viajeros;
	private $id_vehiculo;

	function __construct($data = null){
		if ($data) {
			if (isset($data['id_reserva'])) {$this->id_reserva = $data['id_reserva'];};
			$this->localizador = $data['localizador'];};
			if (isset($data['id_hotel'])) {$this->id_hotel = $data['id_hotel'];
			$this->id_tipo_reserva = $data['id_tipo_reserva'];
			$this->email_cliente = $data['email_cliente'];
			$this->fecha_reserva = $data['fecha_reserva'];
			$this->id_destino = $data['id_destino'];
			if (isset($data['fecha_entrada'])) {$this->fecha_entrada = $data['fecha_entrada'];};
			if (isset($data['hora_entrada'])) {$this->hora_entrada = $data['hora_entrada'];};
			if (isset($data['numero_vuelo_entrada'])) {$this->numero_vuelo_entrada = $data['numero_vuelo_entrada'];};
			if (isset($data['origen_vuelo_entrada'])) {$this->origen_vuelo_entrada = $data['origen_vuelo_entrada'];};
			if (isset($data['hora_vuelo_salida'])) {$this->hora_vuelo_salida = $data['hora_vuelo_salida'];};
			if (isset($data['fecha_vuelo_salida'])) {$this->fecha_vuelo_salida = $data['fecha_vuelo_salida'];};
			$this->num_viajeros = $data['num_viajeros'];
			$this->id_vehiculo = $data['id_vehiculo'];
        }
	}

	public function save(){
		$db = new Database();
		$db->query("INSERT INTO transfer_reservas (localizador, id_hotel, id_tipo_reserva, email_cliente, fecha_reserva, fecha_modificacion, id_destino, fecha_entrada, hora_entrada, numero_vuelo_entrada, origen_vuelo_entrada, hora_vuelo_salida, fecha_vuelo_salida, num_viajeros, id_vehiculo)
			VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
			ON DUPLICATE KEY UPDATE
			localizador = VALUES(localizador),
			id_hotel = VALUES(id_hotel),
			id_tipo_reserva = VALUES(id_tipo_reserva),
			email_cliente = VALUES(email_cliente),
			fecha_reserva = VALUES(fecha_reserva),
			fecha_modificacion = CURRENT_TIMESTAMP,
			id_destino = VALUES(id_destino),
			fecha_entrada = VALUES(fecha_entrada),
			hora_entrada = VALUES(hora_entrada),
			numero_vuelo_entrada = VALUES(numero_vuelo_entrada),
			origen_vuelo_entrada = VALUES(origen_vuelo_entrada),
			hora_vuelo_salida = VALUES(hora_vuelo_salida),
			fecha_vuelo_salida = VALUES(fecha_vuelo_salida),
			num_viajeros = VALUES(num_viajeros),
			id_vehiculo = VALUES(id_vehiculo);
		", [$this->localizador, 
			$this->id_hotel, 
			$this->id_tipo_reserva, 
			$this->email_cliente,
			$this->fecha_reserva,
			date("Y-m-d"),
			$this->id_destino,
			$this->fecha_entrada,
			$this->hora_entrada,
			$this->numero_vuelo_entrada,
			$this->origen_vuelo_entrada,
			$this->hora_vuelo_salida,
			$this->fecha_vuelo_salida,
			$this->num_viajeros,
			$this->id_vehiculo,
		]);
		$this->id_reserva = $db->getLastId();
	}

}
