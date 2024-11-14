<?php

// incluimos la clase de conexión a la BBDD
require_once __DIR__.'/../util/Database.php';


//clase viajero, representa a un usuario del sistema
class Viajero {

	//atributos privados para proteger datos
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

	//constructor que inicia los datos del viajero 
	function __construct($data = null){

		//si se pasa un array de datos
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
			//encriptamos la contraseña
			if (isset($data['password'])) {$this->password = crypt($data['password'], 'S4LTF0RFUN');};
        }
	}
//metodo para guardar el viajero en la base de datos 
	public function save(){
		$db = new Database();
		//insertamos o actualizamos el viajero en la base de datos 
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
		//obtenemos el id del viajero insertado o actualizado 
		$this->id_viajero = $db->getLastId();
	}
// metodo para obtener el email del viajero 
	public function getEmail(){return $this->email;}
	public function getNombre(){return $this->nombre;}
	public function getApellido1(){return $this->apellido1;}
	public function getApellido2(){return $this->apellido2;}
	public function getIdViajero(){return $this->id_viajero;}
	//metodo para obtener un viajero por email y contraseña
	public static function getViajeroWithUsernameAndPassword($username, $password){
		$db = new Database();
		//buscamos el viajero en la base de datos 
		$db->query("SELECT * FROM transfer_viajeros WHERE email = ?", [$username]);
		// si no hay viajero con ese email lanzamos una excepcion 
		if ($db->rowCount() < 1){
			throw new PublicException("Usuario no encontrado");
		}
// obtenemos los datos del viajero 
		$viajeroData = $db->fetch();
// comprobamos la contraseña 
		if (!password_verify($password, $viajeroData['password'])){
			throw new PublicException("Contraseña incorrecta");
		}
// quitamos la contraseña del array de datos 
		unset($viajeroData['password']);
	
		return new Viajero($viajeroData);
	}

    // método: Obtener viajero por ID
    public static function getViajeroById($id_viajero) {
        $db = new Database();
        $db->query("SELECT * FROM transfer_viajeros WHERE id_viajero = ?", [$id_viajero]);
        // si no hay viajero con ese ID lanzamos una excepcion 
        if ($db->rowCount() < 1) {
            throw new PublicException("Viajero no encontrado");
        }
// obtenemos los datos del viajero 
        $viajeroData = $db->fetch();
        return new Viajero($viajeroData);
    }

    // método: Actualizar información del usuario
    public function updateUsuario($id_viajero, $data) {
		// actualizamos los datos del viajero en la base de datos
        $db = new Database();
        $db->query("UPDATE transfer_viajeros SET nombre = ?, apellido1 = ?, apellido2 = ?, direccion = ?, codigoPostal = ?, ciudad = ?, pais = ?, email = ? WHERE id_viajero = ?", [
            $data['nombre'], 
            $data['apellido1'], 
            $data['apellido2'], 
            $data['direccion'], 
            $data['codigoPostal'], 
            $data['ciudad'], 
            $data['pais'], 
            $data['email'], 
            $id_viajero
        ]);
    }

    // método: Actualizar contraseña del usuario
    public function updatePassword($id_viajero, $newPassword) {
		// actualizamos la contraseña del viajero en la base de datos
        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
        $db = new Database();
        $db->query("UPDATE transfer_viajeros SET password = ? WHERE id_viajero = ?", [$hashedPassword, $id_viajero]);
    }
}
