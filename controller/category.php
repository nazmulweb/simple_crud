<?php 

    class Category{
        // database connection and name
        private $conn;
        private $table_name = "categories";

        // properties
        public $id;
        public $name;

        public function __construct($db){
            $this->conn = $db;
        }

        public function read(){
            // select all data
            $query =  "SELECT id, name FROM " . $this->table_name . " ORDER BY name";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function readName(){
             $query = "SELECT name FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";  
             $stmt = $this->conn->prepare($query);

             $stmt->bindParam( 1, $this->id);
             $stmt->execute();

             $row = $stmt->fetch(PDO::FETCH_ASSOC);
             $this->name = $row['name'];

        }
    }

?>