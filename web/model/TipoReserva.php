<?php

require_once __DIR__.'/../util/Database.php';

class TipoReserva {
	public static function getTiposReserva(){
		$db = new Database();
		$db->query("SELECT * FROM transfer_tipo_reserva");
		$reservas = $db->fetchAll();
		return $reservas;
	}
}
