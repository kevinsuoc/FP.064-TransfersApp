<?php

require_once __DIR__.'/PublicException.php';
require_once __DIR__.'/PrivateException.php';

class Database {
	private $host;
    private $db;
	private $user;
    private $pass;
	private $pdo;
    private $stmt;

	public function __construct() {
        $this->host = getenv("MYSQL_HOST");
        $this->db = getenv("MYSQL_DATABASE");
        $this->user = getenv("MYSQL_USER");
        $this->pass = getenv("MYSQL_PASSWORD");

        $this->connect();
    }

	private function connect(){
		$dir = "mysql:host=$this->host;dbname=$this->db";
		try {
			$this->pdo = new PDO($dir, $this->user, $this->pass);
		} catch (PDOException $e){
			throw new PrivateException("Error estableciendo conexion con la base de datos");
		}
	}

	public function query($sql, $params = []) {
        $this->stmt = $this->pdo->prepare($sql);
        $this->stmt->execute($params);
        return $this;
    }

    public function fetchAll() {
        return $this->stmt->fetchAll();
    }

    public function fetch() {
        return $this->stmt->fetch();
    }

	public function rowCount() {
        return $this->stmt->rowCount();
    }

    public function getLastId() {
        return $this->pdo->lastInsertId();
    }
}
