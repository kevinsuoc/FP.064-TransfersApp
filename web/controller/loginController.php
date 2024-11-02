<?php

switch($request){
	case 'logout': logout(); break;
	case 'login': login(); break;
	case 'registrarse': registrar(); break;
}

function logout(){
	unset($_SESSION['userSession']);
	require __DIR__.'/../view/login.php';
}

function login(){
	try {
		$_SESSION['userSession'] = new Session($_POST['username'], $_POST['password']);
		header("Location: /"); exit();
	} catch (LoginException $e){
		$loginError = "Error: ".$e->getMessage();
	} catch (DatabaseException $e){
		$error = "Error con la base de datos: ".$e->getMessage();
		require __DIR__.'/../view/error.php'; exit();
	}
	require __DIR__.'/../view/login.php';
}

function registrar(){
	if ($_SERVER['REQUEST_METHOD'] === 'POST'){
		$data = [];
		$data['nombre'] = $_POST['nombreViajero'];
		$data['apellido1'] = $_POST['apellido1Viajero'];
		$data['apellido2'] = $_POST['apellido2Viajero'];
		$data['direccion'] = $_POST['direccionViajero'];
		$data['codigoPostal'] = $_POST['codigoPostal'];
		$data['ciudad'] = $_POST['ciudadViajero'];
		$data['pais'] = $_POST['paisViajero'];
		$data['email'] = $_POST['emailViajero'];
		$data['password'] = $_POST['passwordViajero'];
		
		try {
			$viajero = new Viajero($data);
			$viajero->save();
			$loginMessage = "Usuario registrado correctamente";
			require __DIR__.'/../view/login.php';
		} catch (PublicException $e){
			$registrarError = "Error: ".$e->getMessage();
			require __DIR__.'/../view/forms/registrar.php';
		}
	}
	else {
		require __DIR__.'/../view/forms/registrar.php';
	}
}

