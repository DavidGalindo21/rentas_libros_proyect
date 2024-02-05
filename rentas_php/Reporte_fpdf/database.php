<?php

class Database{
    private $host;
    private $db;
    private $user;
    private $password;
    private $charset;

    public function __construct(){
        $this->host     = 'localhost';
        $this->db       = 'libreria';
        $this->user     = 'root';
        $this->password = "";
        $this->charset  = 'latin1_spanish_ci';
    }
	
    function connect(){
    
        try {
            $pdo = new PDO("mysql:host=".$this->host.";dbname=".$this->db."","root","");
            //echo "conexion exitosa";
            return $pdo;
        }
          catch(PDOException $e) {
              echo $e->getMessage();
        }
    }

}
?>