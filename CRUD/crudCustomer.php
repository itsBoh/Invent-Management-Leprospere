<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Customer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>


    <div class="container">

        <div class="card">
            <div class="card-body">

                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalAddCustomer">
                    Add Customer
                </button>

                <table class="table table-striped table-hover">
                    <thead>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Address</th>
                    </thead>

                    <?php
                    $sql = "select CUST_ID as id, CUST_NAME as `name`, CUST_EMAIL as email, cust_phone as phone, cust_address as address from customer where status_del=0;";
                    $result = $link->query($sql);
                    while ($row = $result->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?= $row['name'] ?></td>
                            <td><?= $row['email'] ?></td>
                            <td><?= $row['phone'] ?></td>
                            <td class="col-sm-3"><?= $row['address'] ?></td>
                            <td>
                                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalUpdateCustomer<?= $row['id'] ?>">Update</a>
                                <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteProduct<?= $row['id'] ?>">Delete</a>
                            </td>
                        </tr>

                        <!-- update -->
                        <div class="modal fade modal-lg" id="modalUpdateCustomer<?= $row['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Form Update Customer</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="POST" autocomplete="off" action="CRUD/actionCrud.php">
                                    <input type="hidden" name="cust_id" value="<?= $row['id']?>">
                                        <div class="modal-body">
                                            <div class="container ">
                                                <div class="row mb-3">
                                                    <label class="col-sm-3 col-form-label">Name</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="cust_name" value="<?= $row['name']?>">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-3 col-form-label">Email</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="cust_email" value="<?= $row['email']?>">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-3 col-form-label">Phone Number</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="cust_phone" value="<?= $row['phone']?>">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-3 col-form-label">Address</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="cust_address" value="<?= $row['address']?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary" name="fUpdateCustomer">Update</button>
                                            </div>
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
                                            <input type="hidden" name="cust_id" value="<?= $row['id'] ?>">
                                            <h5 class="text-center">Are you sure you want to delete this customer?
                                                <br><span class="text-danger"><?= $row['id'] ?>-<?= $row['name'] ?></span>
                                            </h5>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" name="fDeleteCustomer">Delete</button>
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
                <div class="modal fade modal-lg" id="modalAddCustomer" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Form Add Customer</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="POST" autocomplete="off" action="CRUD/actionCrud.php">
                                <div class="modal-body">
                                    <div class="container ">
                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Name</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" name="cust_name">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Email</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" name="cust_email">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Phone Number</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" name="cust_phone">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Address</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" name="cust_address">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" name="fAddCustomer">Add</button>
                                    </div>
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