<?php

switch($request){
	case 'reserva': showForm($_REQUEST['tipoReserva']); break;
	case 'reservar': reservar($_REQUEST['tipoReserva']); break;
}

function reservar($tipoReserva){
	try {
		switch ($tipoReserva){
			case 1: reservarAeropuertoHotel(); break;
			case 2: reservaerHotelAeropuerto(); break;
			case 3: reservarIdaYVuelta(); break;
			$message = "Reserva realizada. Codigo de tracking: ".$codigoTracking;
			require __DIR__.'/../view/forms/message.php';
		}
	} catch (PublicException $e){
		$errorReserva = "Error: ".$e->getMessage();
		showForm($tipoReserva);
	}
}

function agregarViajero(){
	$data = [];
	$data['nombre'] = $_POST['nombreViajero'];
	$data['apellido1'] = $_POST['apellido1Viajero'];
	$data['apellido2'] = $_POST['apellido2Viajero'];
	$data['direccion'] = $_POST['direccionViajero'];
	$data['codigoPostal'] = $_POST['codigoPostal'];
	$data['ciudad'] = $_POST['ciudadViajero'];
	$data['pais'] = $_POST['paisViajero'];
	$data['email'] = $_POST['emailViajero'];

	$viajero = new Viajero($data);
	$viajero->save();
}

function success(){
	$message = 'Reserva agregada correctamente';
	require __DIR__.'/../view/message.php';
}

function reservarAeropuertoHotel(){
	agregarViajero();
	success();
}

function reservaerHotelAeropuerto(){
	
}

function reservarIdaYVuelta(){

}

function showForm($tipoReserva){
	switch ($tipoReserva){
		case 1: require __DIR__.'/../view/forms/aeropuerto-hotel.php'; break;
		case 2: require __DIR__.'/../view/forms/hotel-aeropuerto.php'; break;
		case 3: require __DIR__.'/../view/forms/ida-y-vuelta.php'; break;
	}
}

