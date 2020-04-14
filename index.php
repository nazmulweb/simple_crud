    <?php 
        include_once "./config/database.php";
        include_once './controller/category.php';
        include_once './controller/product.php';
        include  "./layout/header.php";
        
        $database = new Database;
        $db = $database->getConnection();

        $category = new Category($db);
        $product = new Product($db);

        $page = isset($_GET['page']) ? $_GET['page'] : 1;

        $recordsPerPage = 10;
        $fromRecordNum = ($recordsPerPage * $page) - $recordsPerPage;

       $stmt = $product->readAll($fromRecordNum, $recordsPerPage);
       $num = $stmt->rowCount();

       $totalRows = $product->countAll();
       $pageUrl = "index.php?";


    ?>

    <main class="mt-5 mb-5 products">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="text-center mb-5">All Products</h2>
                    <div class="wrapper-border">
                        <a href="create_product.php" class="btn btn-success mt-3 mb-3" > Add Product </a>
                        <div class="table-responsive">
                            <?php
                                if($num > 0){
                                    echo '<table class="table table-bordered">';
                                            echo '<thead>';
                                            echo '<tr>';
                                                    echo '<th scope="col">#</th>';
                                                    echo '<th scope="col">Product</th>';
                                                    echo '<th scope="col">Price</th>';
                                                    echo '<th scope="col">Description</th>';
                                                    echo '<th scope="col">Category</th>';
                                                    echo '<th scope="col">Action</th>';
                                                echo '</tr>';
                                            echo '</thead>';
                                            echo '<tbody>';
                                                while($num = $stmt->fetch(PDO::FETCH_ASSOC)){
                                                    extract($num);
                                                    echo '<tr>';
                                                        echo "<th scope='row'>{$id}</th>";
                                                        echo "<td>{$name}</td>";
                                                        echo "<td>{$price}</td>";
                                                        echo "<td>{$description}</td>";
                                                        echo "<td>";
                                                            $category->id = $category_id;
                                                            $category->readName();
                                                            echo $category->name;
                                                        echo "</td>";
                                                        echo '<td>';
                                                            echo "<ul class='action'>";
                                                                echo '<il>';
                                                                    echo "<a href='read_one.php?id={$id}' class='btn btn-primary'>Read</a>";
                                                                echo '</li>';
                                                                echo '<il>';
                                                                    echo "<a href='update.php?id={$id}' class='btn btn-success'>Update</a>";
                                                                echo '</li>';
                                                                echo '<il>';
                                                                    echo "<a delete-id='{$id}' class='btn btn-danger delete-obj'>Delete</a>";
                                                                echo '</li>';
                                                            echo '</ul>';
                                                        echo '</td>';
                                                    echo '</tr>';
                                                };
                                            echo '</tbody>';
                                        echo '</table>';
                                    }else{
                                        echo "<p>No data found</p>";
                                    }
                            ?>
                        </div>
                        <nav aria-label="...">
                            <ul class="pagination">
                                <?php
                                    if($page > 1){
                                        echo "<li class='page-item'>";
                                            echo "<a class='page-link' href='{$pageUrl}'> First </a>";
                                        echo '</li>';
                                    }

                                    $totalPage = ceil($totalRows / $recordsPerPage);
                                    $range = 2;

                                    $initialNum = $page - $range;

                                    $conditionLimitNum = ($page + $range) + 1;

                                    for($x = $initialNum; $x < $conditionLimitNum; $x++){
                                        if(($x > 0) && ($x <= $totalPage)){
                                            // active page
                                            if($x == $page){
                                                echo "<li class='page-item active'>";
                                                    echo "<span class='page-link'> $x <span class='sr-only'>(current)</span></span>";                                        
                                                echo "</li>";
                                            }
                                            // not active page
                                            else{
                                                echo "<li class='page-item'><a class='page-link' href='{$pageUrl}page=$x'> $x </a></li>";
                                            }
                                        }
                                    };

                                    if($page < $totalPage){
                                        echo "<li class='page-item'>";
                                            echo "<a class='page-link' href='{$pageUrl}page={$totalPage}'>Next</a>";
                                        echo "</li>";
                                    }
                                ?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php 
        include  "./layout/footer.php";
    ?>