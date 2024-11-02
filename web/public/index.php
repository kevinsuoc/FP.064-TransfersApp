<?php

require_once __DIR__.'/../util/Session.php';

session_start();

if (isset($_REQUEST['request'])){
	$request = $_REQUEST['request'];
}
else {
	$request = 'homepage';
}

switch($request){
	case 'registrarse':
	case 'login':
	case 'logout': require __DIR__.'/../controller/loginController.php'; break;
	case 'reservar':
	case 'reserva': require __DIR__.'/../controller/reservaController.php'; break;
	case 'homepage':
	default: require __DIR__.'/../controller/homeController.php';
}
