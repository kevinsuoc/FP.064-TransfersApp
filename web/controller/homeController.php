<?php

require_once __DIR__.'/../util/sessionType.php';

// Si el usuario tiene la sesión iniciada
function isLogged(){
	return isset($_SESSION['userSession']);
}

function routeHomepage(){
	if (!isLogged()){
		require __DIR__.'/../view/login.php';
	}
//	else if ($_SESSION['userSession'].sessionType == sessionType::admin)
//	else if ($_SESSION['userSession'].sessionType == sessionType::admin)
	else {
		$error = "Tipo de usuario desconocido";
		require __DIR__.'/../view/error.php';
	}
}
