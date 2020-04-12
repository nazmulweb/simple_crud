<?php 

    class Product{
        // database
        private $conn;
        private $table_name = "products";

        // properties
        public $id;
        public $name;
        public $price;
        public $description;
        public $category_id;
        public $timestamp;

        public function __construct($db){
            $this->conn = $db;
        }

        public function create(){
            $query = "INSERT INTO " . $this->table_name . " SET name=:name, description=:description, price=:price, category_id=:category_id, created=:created";
            
            $stmt = $this->conn->prepare($query);

            // form value
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->price = htmlspecialchars(strip_tags($this->price));
            $this->description = htmlspecialchars(strip_tags($this->description));
            $this->category_id = htmlspecialchars(strip_tags($this->category_id));

            // timestamp format
            $this->timestamp = date("Y-m-d H:i:s");
            
            // bind value
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":price", $this->price);
            $stmt->bindParam(":description", $this->description);
            $stmt->bindParam(":category_id", $this->category_id);
            $stmt->bindParam(":created", $this->timestamp);

            
            if($stmt->execute()){
                return true;
            }else{
                return false;
            }
        }
        
    }

?>