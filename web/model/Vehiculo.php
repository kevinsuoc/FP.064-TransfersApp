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
		try {
			$db = new Database();
			$db->query("INSERT INTO transfer_vehiculo (id_vehiculo, Descripción, email_conductor, password)
				VALUES (?, ?, ?, ?)
				ON DUPLICATE KEY UPDATE
				Descripción = VALUES(Descripción),
				email_conductor = VALUES(email_conductor),
				password = VALUES(password);
			", [$this->id_vehiculo,
				$this->descripcion,
				$this->email_conductor,
				$this->password,
			]);
			$this->id_vehiculo = $db->getLastId();
		} catch (PDOException $e){
			throw new PrivateException("no se pudo modificar o agregar un vehiculo");
		}
	}

	public static function getVehiculoById($id_vehiculo){
		try {
			$db = new Database();
			$db->query("SELECT * FROM transfer_vehiculo WHERE id_vehiculo = ?", [$id_vehiculo]);
			
			if ($db->rowCount() < 1){
				throw new PublicException("Vehiculo no encontrado");
			}
			return new Vehiculo($db->fetch());
		} catch (PDOException $e) {
			throw new PrivateException("no se pudo obtener vehiculo");
		}
	}

	public static function getVehiculos(){
		try {
			$db = new Database();
			$db->query("SELECT * FROM transfer_vehiculo");
	
			$vehiculoData = $db->fetchAll();
			$vehiculos = [];
			foreach ($vehiculoData as $vehiculo){
				$vehiculos[] = new Vehiculo($vehiculo);
			}
			return $vehiculos;
		} catch (PDOException $e) {
			throw new PrivateException("no se pudo obtener vehiculos");
		}
	}

	public static function deleteById($id_vehiculo){
		try {
			$db = new Database();
			$db->query("DELETE FROM transfer_vehiculo WHERE id_vehiculo = ?", [$id_vehiculo]);
		} catch (PDOException $e) {
			throw new PrivateException("no se pudo eliminar vehiculo");
		}
	}
}
