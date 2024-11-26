<?php

require_once __DIR__.'/PublicException.php';
require_once __DIR__.'/SessionType.php';
require_once __DIR__.'/../model/Viajero.php';

class LoginException extends PublicException {};

$admin_password = "password";
$admin_username = "admin";

class Session {
	private $viajero;
	private $sessionType;

	function __construct($userName, $password) {
		if ($userName == $GLOBALS['admin_username'])
			$this->validateAdminLogin($password);
		else
			$this->validateRegularLogin($userName, $password);
	}

	public function getSessionType(){return $this->sessionType;}
	public function getEmail(){return $this->viajero->getEmail();}
	public function getViajero(){return $this->viajero;}

	public function setViajero($viajero){$this->viajero = $viajero;}

	private function validateAdminLogin($password){
		if ($password != $GLOBALS['admin_password'])
			throw new LoginException("La contraseña de administrador es incorrecta");
		$this->sessionType = SessionType::admin;
	}

	private function validateRegularLogin($userName, $password){
		$this->sessionType = SessionType::regular;
		try {
			$this->viajero = Viajero::getViajeroWithUsernameAndPassword($userName, $password);
		} catch (PublicException $e){
			throw new LoginException($e->getMessage());
		}
		return $this->viajero;
	}
}
