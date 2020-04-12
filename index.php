    <?php 
        include  "./layout/header.php";
    ?>

    <main class="mt-5 mb-5 products">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="text-center mb-5">All Products</h2>
                    <div class="wrapper-border">
                        <a href="create_product.php" class="btn btn-success mt-3 mb-3" > Add Product </a>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                        <td>@mdo</td>
                                        <td>
                                            <ul>
                                                <il>
                                                    <a href="#" class="btn btn-primary">Read</a>
                                                </li>
                                                <il>
                                                    <a href="#" class="btn btn-success">Update</a>
                                                </li>
                                                <il>
                                                    <a href="#" class="btn btn-danger">Delete</a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php 
        include  "./layout/footer.php";
    ?>
