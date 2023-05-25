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
                
                <table class="table table-striped table-hover">
                    <thead>
                        <td>ID</td>
                        <th>Category</th>
                        <th>Name</th>
                        <th>Stock</th>
                        <th></th>
                    </thead>
                    <?php
                    $sql = "select m.mat_id as id, c.cat_name as cate, m.mat_name as `name`, m.mat_stock as stock from material m left join category c on m.CAT_ID = c.CAT_ID where m.status_del=0;";
                    $result = $link->query($sql);
                    while ($row = $result->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['cate'] ?></td>
                            <td><?= $row['name'] ?></td>
                            <td><?= $row['stock'] ?></td>
                            <td>
                                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalUpdateMat<?= $row['id'] ?>">Update</a>
                                <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteMat<?= $row['id'] ?>">Delete</a>
                            </td>
                        </tr>

                        <!-- update -->
                        <div class="modal fade modal-lg" id="modalUpdateMat<?= $row['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Material</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="POST" autocomplete="off" action="CRUD/actionCrud.php">
                                        <input type="hidden" name="mat_id" value="<?= $row['id'] ?>">
                                        <div class="modal-body">
                                            <div class="container ">
                                                <div class="row mb-3">
                                                    <label class="col-sm-3 col-form-label">Category</label>
                                                    <div class="col-sm-6">
                                                        <select name="mat_cat" class="form-control">
                                                            <option value="c01" selected>Raw Material</option>
                                                            <option value="c02">Packaging</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-3 col-form-label">Material Name</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="mat_name" value="<?= $row['name'] ?>">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-3 col-form-label">Stock</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="mat_stock" value="<?= $row['stock'] ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary" name="fUpdateMat">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- end update -->

                        <!-- Modal Delete-->
                        <div class="modal fade modal-lg" id="modalDeleteMat<?= $row['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Confirm</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="POST" autocomplete="off" action="CRUD/actionCrud.php">
                                        <input type="hidden" name="mat_id" value="<?= $row['id'] ?>">
                                        <div class="modal-body">
                                            <h5 class="text-center">Are you sure you want to delete this material?
                                                <br><span class="text-danger"><?= $row['id'] ?>-<?= $row['name'] ?></span>
                                            </h5>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" name="fDeleteMat">Delete</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- end delete -->

                        <!-- Modal New Mat-->
                        <div class="modal fade modal-lg" id="modalAddMat<?= $row['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Material</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="POST" autocomplete="off" action="CRUD/actionCrud.php">
                                        <input type="hidden" name="mat_id" value="<?= $row['id'] ?>">
                                        <div class="modal-body">
                                            <div class="container ">
                                                <div class="row mb-3">
                                                    <h5 class="text-center">Add
                                                        <span class="text-info"><?= $row['id'] ?>-<?= $row['name'] ?></span>
                                                    </h5>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-3 col-form-label">Nominal</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="mat_nom">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary" name="fAddMat">Add</button>
                                                </div>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- end add -->

                    <?php
                    }
                    ?>
                </table>


            </div>
        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>