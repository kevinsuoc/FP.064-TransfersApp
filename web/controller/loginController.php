<?php

session_start();

require_once __DIR__.'/../util/Session.php';

// Si ya existe una sesion, redireccionar a pagina principal
if (isset($_SESSION['userSession'])){
	header("Location: /index.php");
}

// Si el usuario y contraseña existen en el metodo POST, venimos de intento de acceder
// Si no, venimos de un intento de registro nuevo
if (isset($_POST['username']) && isset($_POST['password'])){
	try {
		// Intentamos validar los datos. Si son validos vamos a la pagina principal
		$_SESSION['userSession'] = new Session($_POST['username'], $_POST['password']);
		header("Location: /index.php");
	} catch (LoginException $e){
		// Si encontramos un error vamos a login con mensaje de error
		$loginError = "Error: ".$e->getMessage();
		require __DIR__.'/../view/login.php';
	}
} else {
	require __DIR__.'/../view/login.php';
}
