<?php 
    include_once "./config/database.php";
    include_once './controller/category.php';
    include_once './controller/product.php';
    include  "./layout/header.php";

    $id = isset($_GET['id']) ? $_GET['id'] : die("Error : Id messing");

    $database = new Database;
    $db = $database->getConnection();

    $category = new Category($db);
    $product = new Product($db);

    $product->id = $id;

    echo $product->readOne();

?>
    <main class="mt-5">
        <div class="container mb-5">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="text-center mb-5">Product</h2>
                    <div class="wrapper-border">
                        <a href="index.php" class="btn btn-success mt-3 mb-3" > Back </a>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>Name</td>
                                    <td><?php echo $product->name; ?></td>
                                </tr>
                                <tr>
                                    <td>Price</td>
                                    <td><?php echo $product->price ?></td>
                                </tr>
                                <tr>
                                    <td>Description</td>
                                    <td><?php echo $product->description ?></td>
                                </tr>
                                <tr>
                                    <td>Category</td>
                                    <td>
                                        <?php
                                            $category->id = $product->category_id;
                                            $category->readName();
                                            echo $category->name;
                                        ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </mian>

<?php 
    include  "./layout/footer.php";
?>
