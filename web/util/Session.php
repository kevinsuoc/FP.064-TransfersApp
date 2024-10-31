<?php

require_once __DIR__.'/PublicException.php';
require_once __DIR__.'/SessionType.php';

class LoginException extends PublicException {};

$admin_password = "password";
$admin_username = "admin";

class Session{
	private $sessionType;
	private $userName;

	function __construct($userName, $password) {
		if ($userName == $GLOBALS['admin_username'])
			$this->validateAdminLogin($password);
		else
			$this->validateRegularLogin($userName, $password);
	}

	public function getSessionType(){return $this->sessionType;}

	public function getUserName(){return $this->userName;}

	private function validateAdminLogin($password){
		if ($password != $GLOBALS['admin_password'])
			throw new LoginException("La contraseña de administrador es incorrecta");
		$this->sessionType = SessionType::admin;
	}

	private function validateRegularLogin($userName, $password){
		throw new LoginException("Usuario regular no implementado");
		$this->$sessionType = SessionType::regular;
		$this->userName = $userName;
	}
}
