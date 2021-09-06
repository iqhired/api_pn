<?php
include_once 'config.php';
    class Database {

        private $host  = "localhost";
        private $database_name = "sg_crewAssignmentMgmt";
//        private $database_name = "dbzdwexbkd5orw";
        private $username = "ashams001";
//        private $username = "umvc1ebnftglp";
        private $password = "iqHired@123";
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
