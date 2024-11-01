<?php

require_once __DIR__.'/../util/Session.php';

session_start();

if ($request == 'logout'){
	unset($_SESSION['userSession']);
}

if (isset($_SESSION['userSession'])){
	header("Location: /"); exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){
	try {
		$_SESSION['userSession'] = new Session($_POST['username'], $_POST['password']);
		header("Location: /"); exit();
	} catch (LoginException $e){
		$loginError = "Error: ".$e->getMessage();
	} catch (DatabaseException $e){
		$error = "Error con la base de datos: ".$e->getMessage();
		require __DIR__.'/../view/error.php'; exit();
	}
}

require __DIR__.'/../view/login.php';

