<?php 

    class DataBase{
        private $db;
        private $user;
        private $password;
        private $host;

        public function __construct()
        {
            $this -> db = 'libreria';
            $this -> user = 'root';
            $this -> password = '';
            $this -> host = 'localhost';
        }

        function connect(){
            try {
                $pdo = new PDO('mysql:host='.$this->host.';dbname='.$this->db.'','root','');
                return $pdo;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
?>