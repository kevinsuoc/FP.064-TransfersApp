<?php

require_once __DIR__.'/../util/Session.php';

session_start();

if (isset($request) && $request == 'logout'){
	unset($_SESSION['userSession']);
}

if (isset($_SESSION['userSession'])){
	header("Location: /");
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){
	try {
		$_SESSION['userSession'] = new Session($_POST['username'], $_POST['password']);
		header("Location: /");
	} catch (LoginException $e){
		$loginError = "Error: ".$e->getMessage();
		require __DIR__.'/../view/login.php';
	}
} else {
	require __DIR__.'/../view/login.php';
}
