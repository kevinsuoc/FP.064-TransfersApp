<?php

require_once __DIR__.'/../util/Database.php';

class Vehiculo {
	private $id_vehiculo;
	private $descripcion;
	private $email_conductor;
	private $password;

	function __construct($data = null){
		if ($data) {
			if (isset($data['id_vehiculo'])) {$this->setIdVehiculo($data['id_vehiculo']);};
            if (isset($data['Descripción'])) {$this->setDescripcion($data['Descripción']);};
			if (isset($data['email_conductor'])) {$this->setEmailConductor($data['email_conductor']);};
			if (isset($data['password'])) {$this->setPassword($data['password']);};
        }
	}

	public function setIdVehiculo($id_vehiculo){$this->id_vehiculo = $id_vehiculo;}
	public function setDescripcion($descripcion){$this->descripcion = $descripcion;}
	public function setEmailConductor($email_conductor){$this->email_conductor = $email_conductor;}
	public function setPassword($password){$this->password = crypt($password, 'S4LTF0RFUN');}

	public function getIdVehiculo(){return $this->id_vehiculo;}
	public function getDescripcion(){return $this->descripcion;}
	public function getEmailConductor(){return $this->email_conductor;}
	public function getPassword(){return $this->password;}

	public function save(){
		$db = new Database();
		$db->query("INSERT INTO transfer_hotel (Descripción, email_conductor, password)
			VALUES (?, ?, ?)
			ON DUPLICATE KEY UPDATE
			Descripción = VALUES(Descripción),
			email_conductor = VALUES(email_conductor),
			password = VALUES(password),
		", [$this->descripcion,
			$this->email_conductor,
			$this->password,
		]);
		$this->id_vehiculo = $db->getLastId();
	}

	public static function getVehiculoById($id_vehiculo){
		$db = new Database();
		$db->query("SELECT * FROM transfer_vehiculo WHERE id_vehiculo = ?", [$id_vehiculo]);
		
		if ($db->rowCount() < 1){
			throw new PublicException("Hotel no encontrado");
		}
		return new Vehiculo($db->fetch());
	}

	public static function getVehiculos(){
		$db = new Database();
		$db->query("SELECT * FROM transfer_vehiculo");

		$vehiculoData = $db->fetchAll();
		$vehiculos = [];
		foreach ($vehiculoData as $vehiculo){
			$vehiculos[] = new Vehiculo($vehiculo);
		}
		return $vehiculos;
	}
}
