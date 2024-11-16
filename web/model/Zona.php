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
		$db->query("INSERT INTO transfer_zona (id_zona, descripcion)
			VALUES (?, ?)
			ON DUPLICATE KEY UPDATE
			descripcion = VALUES(descripcion);
		", [$this->id_zona,
			$this->descripcion,
		]);
		$this->id_zona = $db->getLastId();
	}

	public function getDescripcion(){
		return $this->descripcion;
	}
	public function getIdZona(){
		return $this->id_zona;
	}
	
	public static function getZonaById($id_zona){
		$db = new Database();
		$db->query("SELECT * FROM transfer_zona WHERE id_zona = ?", [$id_zona]);
		
		if ($db->rowCount() < 1){
			throw new PublicException("Zona no encontrada");
		}

		return new Zona($db->fetch());
	}

	public static function getZonas(){
		$db = new Database();
		$db->query("SELECT * FROM transfer_zona");

		$zonaData = $db->fetchAll();
		$zonas = [];
		foreach ($zonaData as $zona){
			$zonas[] = new Zona($zona);
		}
		return $zonas;
	}

	public static function deleteById($id_zona){
		$db = new Database();
		$db->query("DELETE FROM transfer_zona WHERE id_zona = ?", [$id_zona]);
	}
}
