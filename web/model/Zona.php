<?php

require_once __DIR__.'/../util/Database.php';

class Zona {
	private $id_zona;
	private $descripcion;

	function __construct($data = null){
		if ($data) {
            if (isset($data['id_zona'])) {$this->id_zona = $data['id_zona'];};
            $this->descripcion = $data['descripcion'];
        }
	}

	public function save(){
		$db = new Database();
		$db->query("INSERT INTO transfer_zona (descripcion)
			VALUES (?)
			ON DUPLICATE KEY UPDATE
			descripcion = VALUES(descripcion),
		", [$this->descripcion,
		]);
		$this->id_zona = $db->getLastId();
	}

	public function getDescription(){
		return $this->descripcion;
	}
	
	public static function getZonaById($id_zona){
		$db = new Database();
		$db->query("SELECT * FROM transfer_zona WHERE id_zona = ?", [$id_zona]);
		
		if ($db->rowCount() < 1){
			throw new PublicException("Zona no encontrada");
		}

		$zonaData = $db->fetch();

		return new Zona($zonaData);
	}
}
