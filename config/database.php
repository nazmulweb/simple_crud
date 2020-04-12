<?php 

    class Database {
        
        private $host = "localhost";
        private $db_name = "simple_crud";
        private $user_name = "root";
        private $password = "";
        public $conn;

        public function getConnection(){
            $this->conn = null;
            try{
                $this->conn = new PDO("mysql:host=" . $this->host . "; dbname=" . $this->db_name, $this->user_name, $this->password);
            } catch (PDOException $exception){
                echo "Connection error: " . $exception->getMessage();
            }

            return $this->conn;
        }
    }

?>