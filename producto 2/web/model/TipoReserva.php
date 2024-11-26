<?php

require_once __DIR__.'/../util/Database.php';

/*
	Simple por no estar sujeto a modificacion.
*/
class TipoReserva {
	public static function getTiposReserva(){
		try {
			$db = new Database();
			$db->query("SELECT * FROM transfer_tipo_reserva");
			$reservas = $db->fetchAll();
			return $reservas;
		} catch (PDOException $e){
			throw new PrivateException("no se pudo obtener tipos de reserva");
		}
	}

	public static function getReservaPorTipo($tipoReserva){
		try {
			$db = new Database();
			$db->query("SELECT * FROM transfer_tipo_reserva WHERE id_tipo_reserva = ?", [$tipoReserva]);
			$reserva = $db->fetch();
			return $reserva;
		} catch (PDOException $e){
			throw new PrivateException("no se pudo obtener tipo de reserva");
		}
	}
}
