<?php

session_start();

require_once __DIR__.'/../util/SessionType.php';

// Si el usuario tiene la sesión iniciada
function isLogged(){
	return isset($_SESSION['userSession']);
}

if (!isLogged()){
	header("Location: /index.php?request=login");
	exit();
}
else if ($_SESSION['userSession']->sessionType === sessionType::admin){
	require __DIR__.'/../view/adminHomepage.php';
}
else if ($_SESSION['userSession']->sessionType === sessionType::regular){
	require __DIR__.'/../view/regularHomepage.php';
}
else {
	$error = "Tipo de usuario desconocido";
	require __DIR__.'/../view/error.php';
}
