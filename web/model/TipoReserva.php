<?php

require_once __DIR__.'/../util/Database.php';

class TipoReserva {
	public static function getTiposReserva(){
		$db = new Database();
		$db->query("SELECT * FROM transfer_tipo_reserva");
		$reservas = $db->fetchAll();
		return $reservas;
	}

	public static function getReservaPorTipo($tipoReserva){
		$db = new Database();
		$db->query("SELECT * FROM transfer_tipo_reserva WHERE id_tipo_reserva = ?", [$tipoReserva]);
		$reserva = $db->fetch();
		return $reserva;
	}
}
