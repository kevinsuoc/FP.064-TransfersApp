<?php

/*
	Punto de entrada de la aplicacion.
	Recibe una solicitud con un parametro 'request'.
	A partir de este se selecciona un controlador.
	Si no existe, se redirige a la pagina inicial.
*/

// Necesario para que la sesion no se destruya por tener tipos de datos desconocidos
require_once __DIR__.'/../util/Session.php';

// Cargamos la sesion para el resto de los controladores
session_start();

// Si no hay solicitud vamos a la homepage
$request = $_REQUEST['request'] ?? 'homepage';

// De acuerdo al parametro request, seleccionamos el controlador adecuado.
switch($request){
	case 'registrarse':
	case 'login':
	case 'intentoRegistro':
	case 'logout': require __DIR__.'/../controller/loginController.php'; break;
	case 'reservar':
	case 'reserva': require __DIR__.'/../controller/reservaController.php'; break;
	case 'homepage':
	default: require __DIR__.'/../controller/homeController.php';
}
