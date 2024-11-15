<?php

/*
	Punto de entrada de la aplicacion.
	Recibe una solicitud con un parametro 'request'.
	A partir de este se selecciona un controlador.
	Si no existe, se redirige a la pagina inicial.

	Variables relevantes:
	
	$_REQUEST['request']. - A través de un post/get se redirige a algun controlador.
*/

// Necesario para que la sesion no se destruya por tener tipos de datos desconocidos
require_once __DIR__.'/../util/Session.php';

// Cargamos la sesion para el resto de los controladores
session_start();

// Si no hay solicitud vamos a la homepage
$request = $_REQUEST['request'] ?? 'homepage';

// De acuerdo al parametro request, seleccionamos el controlador adecuado.
switch($request){
	case 'registrarse': // Para registrar un viajero
	case 'login': // Para iniciar sesion
	case 'intentoRegistro': // Para registrar un viajero
	case 'actualizarPassword': // Para cambiar la password
	case 'actualizarViajero': // Para editar el perfil
	case 'logout': require __DIR__.'/../controller/loginController.php'; break;
	case 'reservar': // Para reservar
	case 'editarReserva':  // Para editar la reserva
	case 'eliminarReserva': // Para eliminar una reserva
	case 'reserva': require __DIR__.'/../controller/reservaController.php'; break;
	case 'homepage': // Para la pagina principal
	default: require __DIR__.'/../controller/homeController.php';
}
