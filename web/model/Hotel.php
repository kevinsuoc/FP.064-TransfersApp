<?php

require_once __DIR__.'/../util/Database.php';

class Hotel {
	private $id_hotel;
	private $id_zona;
	private $comision;

	function __construct($data = null){
		if ($data) {
            if (isset($data['id_hotel'])) {$this->id_viajero = $data['id_hotel'];};
            $this->id_zona = $data['id_zona'];
            $this->comision = $data['comision'];
        }
	}

	public function save(){
		$db = new Database();
		$db->query("INSERT INTO transfer_hotel (id_zona, comision)
			VALUES (?, ?)
			ON DUPLICATE KEY UPDATE
			id_zona = VALUES(id_zona),
			comision = VALUES(comision),
		", [$this->id_zona, 
			$this->comision,
		]);
		$this->id_hotel = $db->getLastId();
	}

	public function getEmail(){
		return $this->email;
	}
	
	public static function getHotelById($id_hotel){
		$db = new Database();
		$db->query("SELECT * FROM transfer_hotel WHERE id_hotel = ?", [$id_hotel]);
		
		if ($db->rowCount() < 1){
			throw new PublicException("Hotel no encontrado");
		}

		$hotelData = $db->fetch();

		return new Hotel($hotelData);
	}

	public static function getHotels(){
		$db = new Database();
		$db->query("SELECT * FROM transfer_hotel");
		$hotels = $db->fetchAll();
		return $hotels;
	}
}
