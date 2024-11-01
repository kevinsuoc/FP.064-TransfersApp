<?php

require_once __DIR__.'/../util/Database.php';

class Viajero {
	private $id_viajero;
	private $nombre;
	private $apellido1;
	private $apellido2;
	private $direccion;
	private $codigoPostal;
	private $ciudad;
	private $pais;
	private $email;

	function __construct($data = null){
		if ($data) {
            $this->id_viajero = $data['id_viajero'];
            $this->nombre = $data['nombre'];
            $this->apellido1 = $data['apellido1'];
            $this->apellido2 = $data['apellido2'];
            $this->direccion = $data['direccion'];
            $this->codigoPostal = $data['codigoPostal'];
            $this->ciudad = $data['ciudad'];
            $this->pais = $data['pais'];
            $this->email = $data['email'];
        }
	}

	public static function getViajeroWithUsernameAndPassword($username, $password){
		$db = new Database();
		$db->query("SELECT * FROM transfer_viajeros WHERE email = ?", [$username]);
		
		if ($db->rowCount() < 1){
			throw new PublicException("Usuario no encontrado");
		}

		$viajeroData = $db->fetch();

		if (!isset($viajeroData['password'])){
			throw new PublicException("Viajero no registrado");
		}

		if (!password_verify($password, $viajeroData['password'])){
			throw new PublicException("Contraseña incorrecta");
		}
	
		return new Viajero($viajeroData);
	}
}
