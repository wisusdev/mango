<?php

namespace App\core;

use PDO;
use PDOException;

class Database {
	private $link;
    private string $db_engine;
    private string $db_host;
    private string $db_name;
    private string $db_user;
    private string $db_pass;
    private string $db_charset;
    private array $options;

    public function __construct() {
        $this->db_engine = config('database.db_engine');
        $this->db_host = config('database.db_host');
        $this->db_name = config('database.db_name');
        $this->db_user = config('database.db_user');
        $this->db_pass = config('database.db_pass');
        $this->db_charset = config('database.db_charset');
        $this->options = [
			PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			PDO::ATTR_EMULATE_PREPARES   => false,
		];
    }

	// Método para abrir una conexión a la base de datos
    private function connect()
	{
        try {
            $dsn = $this->db_engine .':host=' . $this->db_host . ';dbname=' . $this->db_name . ';charset=' . $this->db_charset;
            return new PDO($dsn, $this->db_user, $this->db_pass, $this->options);
        } catch(PDOException $error) {
            die(sprintf('No  tenemos conexión a la base de datos, ocurrio un error: %s', $error->getMessage()));
        }
    }

	// Método para hacer un query a la base de datos
  	public static function query($sql, $params = [])
	{
    	$db = new self();
    	$link = $db->connect(); // nuestra conexión a la db
    	$link->beginTransaction(); // por cualquier error, checkpoint
    	$query = $link->prepare($sql);

    	// Manejando errores en el query o la petición
    	// SELECT * FROM usuarios WHERE id=:cualquier AND name = :name;
    	if(!$query->execute($params)) {

			$link->rollBack();
			$error = $query->errorInfo();
			// index 0 es el tipo de error
			// index 1 es el código de error
			// index 2 es el mensaje de error al usuario
			throw new Exception($error[2]);
		}

		// SELECT | INSERT | UPDATE | DELETE | ALTER TABLE
		// Manejando el tipo de query
		// SELECT * FROM usuarios;
		if(str_contains($sql, 'SELECT')) {
			return $query->rowCount() > 0 ? $query->fetchAll() : false; // no hay resultados
		} 
		
		elseif(str_contains($sql, 'INSERT')) {
			$id = $link->lastInsertId();
			$link->commit();
			return $id;
		} 
		
		elseif(str_contains($sql, 'UPDATE')) {
			$link->commit();
			return true;
		} 
		
		elseif(str_contains($sql, 'DELETE')) {
			if($query->rowCount() > 0) {
				$link->commit();
				return true;
			}
			
			$link->rollBack();
			return false; // Nada ha sido borrado

		} 
		
		else {
			// ALTER TABLE | DROP TABLE 
			$link->commit();
			return true;
		}
  	}
}