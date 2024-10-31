<?php

require_once __DIR__.'/../util/Session.php';

session_start();

// Si el usuario tiene la sesión iniciada
function isLogged(){
	return isset($_SESSION['userSession']);
}

if (!isLogged()){
	header("Location: /?request=login");
	exit();
}
else if ($_SESSION['userSession']->getSessionType() === sessionType::admin){
	require __DIR__.'/../view/adminHomepage.php';
}
else if ($_SESSION['userSession']->getSessionType() === sessionType::regular){
	require __DIR__.'/../view/regularHomepage.php';
}
else {
	unset($_SESSION['userSession']);
	$error = "Tipo de usuario desconocido";
	require __DIR__.'/../view/error.php';
}
