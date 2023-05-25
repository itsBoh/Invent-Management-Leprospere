<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modal CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>

    <div class="container">

        <div class="card">
            <div class="card-body">

                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalAddProduct">
                    Add Product
                </button>

                <table class="table table-striped table-hover">
                    <thead>
                        <th>id</th>
                        <th>name</th>
                        <th>price</th>
                        <th>stock</th>
                        <th></th>
                    </thead>
                    <?php
                    include "config.php";
                    $sql = "select product_id as id, product_name as `name`, PRODUCT_PRICE as price, PRODUCT_STOCK as stock, product_image_url as url, product_desc as `desc` from product where status_del = 0;";
                    $result = $link->query($sql);
                    while ($row = $result->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['name'] ?></td>
                            <td><?= rupiah($row['price']) ?></td>
                            <td><?= $row['stock'] ?></td>
                            <td>
                                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalUpdateProduct<?= $row['id'] ?>">Update</a>
                                <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteProduct<?= $row['id'] ?>">Delete</a>
                            </td>
                        </tr>

                        <!-- update -->
                        <div class="modal fade modal-lg" id="modalUpdateProduct<?= $row['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Product</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="POST" autocomplete="off" action="CRUD/actionCrud.php">
                                        <input type="hidden" name="product_id" value="<?= $row['id'] ?>">
                                        <div class="modal-body">
                                            <div class="container ">
                                                <div class="row mb-3">
                                                    <label class="col-sm-3 col-form-label">Product Name</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="product_name" value="<?= $row['name'] ?>">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-3 col-form-label">Price</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="product_price" value="<?= $row['price'] ?>">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-3 col-form-label">Stock</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="product_stock" value="<?= $row['stock'] ?>">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-3 col-form-label">Product Description</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="product_desc" value="<?= $row['desc'] ?>">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-3 col-form-label">Image URL</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="product_image_url" value="<?= $row['url'] ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" name="fUpdateProd">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- end update -->

                        <!-- Modal Delete-->
                        <div class="modal fade" id="modalDeleteProduct<?= $row['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Confirm</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="POST" autocomplete="off" action="CRUD/actionCrud.php">
                                        <div class="modal-body">
                                            <input type="hidden" name="product_id" value="<?= $row['id'] ?>">
                                            <h5 class="text-center">Are you sure you want to delete this product?
                                                <br><span class="text-danger"><?= $row['id'] ?>-<?= $row['name'] ?></span>
                                            </h5>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" name="fDeleteProd">Delete</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- end delete -->

                    <?php
                    }
                    ?>
                </table>

                <!-- add -->
                <div class="modal fade modal-lg" id="modalAddProduct" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Form Add Product</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="POST" autocomplete="off" action="CRUD/actionCrud.php">
                                <div class="modal-body">
                                    <div class="container ">
                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Product Name</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" name="product_name">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Price</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" name="product_price">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Stock</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" name="product_stock">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Product Description</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" name="product_desc">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Image URL</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" name="product_image_url">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="fAddProd">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- end add -->
            </div>
        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>