<?php

require_once __DIR__.'/PublicException.php';
require_once __DIR__.'/SessionType.php';

class LoginException extends PublicException {};

$admin_password = "password";
$admin_username = "admin";

class Session{
	public $sessionType;
	public $userName;

	function __construct($userName, $password) {
		if ($userName == $GLOBAL['admin_username'])
			validateAdminLogin($password);
		else
			validateRegularLogin($userName, $password);
	}

	private function validateAdminLogin($password){
		if ($password != $GLOBAL['admin_password'])
			throw new PublicException("Admin login: Contraseña incorrecta");
		$sessionType = SessionType::admin;
	}

	private function validateRegularLogin($userName, $password){
		throw new PublicException("Usuario regular no implementado");
		$this->userName = $userName;
	}
}
