<?php

require_once __DIR__.'/../model/TipoReserva.php';

routeHome();

function routeHome(){
	if (!isset($_SESSION['userSession'])){
		require __DIR__.'/../view/login.php';
	}
	else if ($_SESSION['userSession']->getSessionType() === sessionType::admin){
		$tiposReserva = TipoReserva::getTiposReserva();
		require __DIR__.'/../view/homepage/admin.php';
	}
	else if ($_SESSION['userSession']->getSessionType() === sessionType::regular){
		require __DIR__.'/../view/homepage/regular.php';
	}
	else {
		unset($_SESSION['userSession']);
		$error = "Tipo de usuario desconocido";
		require __DIR__.'/../view/error.php';
	}
}
