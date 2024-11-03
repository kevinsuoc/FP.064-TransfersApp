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
	private $password;

	function __construct($data = null){
		if ($data) {
            if (isset($data['id_viajero'])) {$this->id_viajero = $data['id_viajero'];};
            $this->nombre = $data['nombre'];
            $this->apellido1 = $data['apellido1'];
            $this->apellido2 = $data['apellido2'];
            $this->direccion = $data['direccion'];
            $this->codigoPostal = $data['codigoPostal'];
            $this->ciudad = $data['ciudad'];
            $this->pais = $data['pais'];
            $this->email = $data['email'];
			if (isset($data['password'])) {$this->password = crypt($data['password'], 'S4LTF0RFUN');};
        }
	}

	public function save(){
		$db = new Database();
		$db->query("INSERT INTO transfer_viajeros (nombre, apellido1, apellido2, direccion, codigoPostal, ciudad, pais, email, password)
			VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
			ON DUPLICATE KEY UPDATE
			nombre = VALUES(nombre),
			apellido1 = VALUES(apellido1),
			apellido2 = VALUES(apellido2),
			direccion = VALUES(direccion),
			codigoPostal = VALUES(codigoPostal),
			ciudad = VALUES(ciudad),
			pais = VALUES(pais),
			email = VALUES(email),
			password = VALUES(password);
		", [$this->nombre, 
			$this->apellido1, 
			$this->apellido2, 
			$this->direccion,
			$this->codigoPostal,
			$this->ciudad,
			$this->pais,
			$this->email,
			$this->password,
		]);
		$this->id_viajero = $db->getLastId();
	}

	public function getEmail(){
		return $this->email;
	}
	
	public static function getViajeroWithUsernameAndPassword($username, $password){
		$db = new Database();
		$db->query("SELECT * FROM transfer_viajeros WHERE email = ?", [$username]);
		
		if ($db->rowCount() < 1){
			throw new PublicException("Usuario no encontrado");
		}

		$viajeroData = $db->fetch();

		if (!password_verify($password, $viajeroData['password'])){
			throw new PublicException("Contraseña incorrecta");
		}

		unset($viajeroData['password']);
	
		return new Viajero($viajeroData);
	}
}
