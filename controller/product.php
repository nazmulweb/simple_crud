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

        public function readAll($fromRecordNum, $recordsPerPage){
            $query = "SELECT id, name, price, description, category_id FROM " . $this->table_name . " ORDER BY id ASC LIMIT {$fromRecordNum}, {$recordsPerPage}";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function countAll (){
            $query = "SELECT id FROM " . $this->table_name . "";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            $num = $stmt->rowCount();
            return $num;

        }

        public function readOne () {
            // return $this->category_id;
            $query = "SELECT name, price, description, category_id FROM " . $this->table_name . " WHERE id = ? LIMIT 0, 1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->id);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->name = $row['name'];
            $this->price = $row['price'];
            $this->description = $row['description'];
            $this->category_id = $row['category_id'];
        }

        public function update(){
            $query = "UPDATE " .$this->table_name . " SET name = :name, price = :price, description = :description, category_id = :category_id WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":price", $this->price);
            $stmt->bindParam(":description", $this->description);
            $stmt->bindParam(":category_id", $this->category_id);
            $stmt->bindParam(":id", $this->id);

            if( $stmt->execute()){
                return true;
            } else{
                return false;
            }
        }

        public function delete (){
            $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
     
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->id);
         
            if($result = $stmt->execute()){
                return true;
            }else{
                return false;
            }
        }

        
    }

?>