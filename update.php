<?php 

include_once "./config/database.php";
include_once './controller/category.php';
include_once './controller/product.php';
include  "./layout/header.php";

$id = isset($_GET['id']) ? $_GET['id'] : die("Erorr: Id missing ");

$database = new Database;
$db = $database->getConnection();

$product = new Product($db);
$category = new Category($db);

$product->id = $id;

$product->readOne();

?>

<main class="mt-5 mb-5">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="text-center mb-5">Add Product </h2>
                <div class="wrapper-border">
                    <?php 
                        if($_POST){
                            $product->name = $_POST["name"];
                            $product->price = $_POST["price"];
                            $product->description = $_POST["description"];
                            $product->category_id = $_POST["category_id"];
                        
                            if($product->update()){
                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                            Product created
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>';
                            }
                            else{
                                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        Something went wrong
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>.';
                            }
                        }
                        
                    ?>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}")?>" method="post">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?php echo $product->name; ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="price">Price</label>
                                <input type="number" class="form-control" id="price" name="price" value="<?php echo $product->price; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" rows="3" name="description"><?php echo $product->description; ?></textarea>
                        </div>
                        <div class="form-group ">
                            <label for="category">Category</label>
                            <select id="category" class="form-control" name="category_id">
                                <option selected>Choose...</option>
                                <?php
                                   $stmt = $category->read();  
                                    while($row_category = $stmt->fetch(PDO::FETCH_ASSOC)){
                                        extract($row_category);
                                        if($product->category_id == $id){
                                            echo "<option value='{$id}' selected>";
                                        }
                                        else{
                                            echo "<option value='{$id}'>";
                                        }

                                        echo " {$name} </option>";
                                    }
                                
                                ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>


<?php 
    include  "./layout/footer.php";
?>
