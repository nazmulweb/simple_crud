<?php 
    if($_POST){
        include_once "./config/database.php";
        include_once './controller/product.php';

        $database = new  Database;
        $db = $database->getConnection();

        $product = new Product($db);

        $test = $product->id = $_POST['object_id'];
        
        echo $test;

        if($product->delete()){
            echo "Product deleted";
        } else{
            echo "Unable to delete product";
        }
    }
?>