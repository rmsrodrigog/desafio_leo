<?php
    namespace Config;

    use Symfony\Component\Dotenv\Dotenv;

    class database {

        private $dotenv;
        private $host;
        private $databaseName;
        private $username;
        private $password;


        public function __construct()
        {
            $this->dotenv = new Dotenv();
            $this->dotenv->load($_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'backend'.DIRECTORY_SEPARATOR.'.env');
            $this->host = $_ENV['DB_HOST'];
            $this->databaseName = $_ENV['DB_NAME'];
            $this->username = $_ENV['USERNAME'];
            $this->password = $_ENV['PASSWORD'];
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