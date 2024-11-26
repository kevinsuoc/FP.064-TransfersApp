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
		try {
			$db = new Database();
			$db->query("INSERT INTO transfer_zona (id_zona, descripcion)
				VALUES (?, ?)
				ON DUPLICATE KEY UPDATE
				descripcion = VALUES(descripcion);
			", [$this->id_zona,
				$this->descripcion,
			]);
			$this->id_zona = $db->getLastId();
		} catch (PDOException $e){
			throw new PrivateException("no se pudo modificar o agregar una zona");
		}
	}

	public function getDescripcion(){
		return $this->descripcion;
	}
	public function getIdZona(){
		return $this->id_zona;
	}
	
	public static function getZonaById($id_zona){
		try {
			$db = new Database();
			$db->query("SELECT * FROM transfer_zona WHERE id_zona = ?", [$id_zona]);
			if ($db->rowCount() < 1){
				throw new PublicException("zona no encontrada");
			}
			return new Zona($db->fetch());
		} catch (PDOException $e){
			throw new PrivateException("no se pudo obtener zona por el id");
		}
	}

	public static function getZonas(){
		try {
			$db = new Database();
			$db->query("SELECT * FROM transfer_zona");
	
			$zonaData = $db->fetchAll();
			$zonas = [];
			foreach ($zonaData as $zona){
				$zonas[] = new Zona($zona);
			}
			return $zonas;
		} catch (PDOException $e){
			throw new PrivateException("no se pudieron obtener las zonas");
		}
	}

	public static function deleteById($id_zona){
		try {
			$db = new Database();
			$db->query("DELETE FROM transfer_zona WHERE id_zona = ?", [$id_zona]);
		} catch (PDOException $e){
			throw new PrivateException("no se pudo eliminar la zona");
		}
	}

	public function validate(){
		if (strlen($this->descripcion ?? '') < 3){
			throw new PublicException ("La descripcion debe 3 letras o más");
		}
	}
}
