<?php

require_once __DIR__.'/../util/Database.php';

/*
	Modelo de Hotel.
	Importante ! Lo tomo como referencia para otros modelos. Sugiero hacer lo mismo.
*/
class Hotel {
	private $id_hotel;
	private $id_zona;
	private $usuario;
	private $comision;
	private $password;

	/*
		A veces puede que queramos instancias vacías.
		Recomendado solo utilizar con $data para validación de lógica de negocio.
	*/
	function __construct($data = null){
		if ($data) {
			// Usar setters para validar lógica de negocio
            if (isset($data['id_hotel'])) {$this->setIdHotel($data['id_hotel']);};
			if (isset($data['id_zona'])) {$this->setIdZona($data['id_zona']);};
			if (isset($data['Comision'])) {$this->setComision($data['Comision']);};
			if (isset($data['usuario'])) {$this->setUsuario($data['usuario']);};
			if (isset($data['password'])) {$this->setPassword($data['password']);};
        }
	}

	// Setters (TODO: Validaciones)
	public function setIdHotel($id_hotel){$this->id_hotel = $id_hotel;}
	public function setIdZona($id_zona){$this->id_zona = $id_zona;}
	public function setUsuario($usuario){$this->usuario = $usuario;}
	public function setComision($comision){$this->comision = $comision;}
	public function setPassword($password){$this->password = crypt($password, 'S4LTF0RFUN');}

	// Getters
	public function getIdHotel(){return $this->id_hotel;}
	public function getIdZona(){return $this->id_zona;}
	public function getUsuario(){return $this->usuario;}
	public function getComision(){return $this->comision;}
	public function getPassword(){return $this->password;} // Por si es necesario hacer comprobaciones, está encriptada

	/*
		La idea es que este método guarde los hoteles si no existen, o
		los actualize. Se daría cuenta que debe actualizarlos por encontrar
		una clave (usuario) repetidos.
	*/
	public function save(){
		try {
			$db = new Database();
			$db->query("INSERT INTO transfer_hotel (id_hotel, id_zona, comision, usuario, password)
				VALUES (?, ?, ?, ?, ?)
				ON DUPLICATE KEY UPDATE
				id_zona = VALUES(id_zona),
				comision = VALUES(comision),
				usuario = VALUES(usuario),
				password = VALUES(password)
			", [$this->id_hotel,
				$this->id_zona, 
				$this->comision,
				$this->usuario,
				$this->password,
			]);
			$this->id_hotel = $db->getLastId();
		} catch (PDOException $e){
			throw new PublicException("no se pudo modificar o agregar un hotel");
		}

	}


	/*
		Busca un hotel por el ID, devuelve una instancia Hotel
	 */
	public static function getHotelById($id_hotel){
		try {
			$db = new Database();
			$db->query("SELECT * FROM transfer_hotel WHERE id_hotel = ?", [$id_hotel]);
			
			if ($db->rowCount() != 1){
				throw new PublicException("Hotel no encontrado");
			}
			return new Hotel($db->fetch());
		} catch (PDOException $e){
			throw new PublicException("no se pudo obtener hotel");
		}

	}

	/*
		Busca todos los hoteles. Devuelve un array de instancias de Hotel
	*/
	public static function getHotels(){
		try {
			$db = new Database();
			$db->query("SELECT * FROM transfer_hotel");
	
			$hotelData = $db->fetchAll();
			$hotels = [];
			foreach ($hotelData as $hotel){
				$hotels[] = new Hotel($hotel);
			}
			return $hotels;
		} catch (PDOException $e){
			throw new PublicException("no se pudo obtener hoteles");
		}
	}

	public static function deleteById($id_hotel){
		try {
			$db = new Database();
			$db->query("DELETE FROM transfer_hotel WHERE id_hotel = ?", [$id_hotel]);
		} catch (PDOException $e){
			throw new PublicException("no se pudo obtener hotel");
		}
	}
	
}
