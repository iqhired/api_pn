<?php
include_once 'config.php';
    class Database {

        private $host  = "localhost";
        private $database_name = "testplantnavigator";
//        private $database_name = "server";
        private $username = "root";
//        private $username = "umvc1ebnftglp";
        private $password = "";
//        private $password = "holliiszwida";

        public $conn;

        public function getConnection(){
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
