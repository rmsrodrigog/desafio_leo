<?php
    require_once('../config.php');

    class Database {

        private $dotenv;
        private $host;
        private $databaseName;
        private $username;
        private $password;

        public function __construct()
        {
            global $CFG;
            $this->host = $CFG->host;
            $this->databaseName = $CFG->databaseName;
            $this->username = $CFG->username;
            $this->password = $CFG->password;
        }

        public $conn;

        public function getConnection() {
            $this->conn = null;
            try{
                $this->conn = new \PDO("mysql:host=" . $this->host . ";dbname=" . $this->databaseName, $this->username, $this->password);
                $this->conn->exec("set names utf8");
            }catch(PDOException $exception){
                echo "Database could not be connected: " . $exception->getMessage();
            }
            return $this->conn;
        }
    }  
?>