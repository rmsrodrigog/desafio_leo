<?php 
    //namespace config;

    class database {
        private $host = "127.0.0.1";
        private $database_name = "desafio_leo";
        private $username = "root";
        private $password = "rsubuntu";

        public $conn;

        public function getConnection() {
            $this->conn = null;
            try{
                $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database_name, $this->username, $this->password);
                $this->conn->exec("set names utf8");
            }catch(PDOException $exception){
                echo "Database could not be connected: " . $exception->getMessage();
            }
            return $this->conn;
        }
    }  
?>