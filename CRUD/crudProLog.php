<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Production Log</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalAddProductionLog">Add Production Log</button>
                <table class="table table-striped table-hover">
                    <thead>
                        <th>Date</th>
                        <th>Item Count</th>
                        <th></th>
                    </thead>

                    <?php
                    include "config.php";
                    $sql = "select PRODDETAIL_ID as id, date_format(PRODDETAIL_DATE, '%d %M %Y') as date, PRODDETAIL_ITEMCOUNT as count from production_log where STATUS_DEL = 0 order by PRODDETAIL_DATE desc;";
                    $result = $link->query($sql);
                    while ($row = $result->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?= $row['date'] ?></td>
                            <td><?= $row['count'] ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
    <!-- add -->
    <div class="modal fade modal-lg" id="modalAddProductionLog" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Form Add Production Log</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" autocomplete="off" action="CRUD/actionCrud.php">
                    <div class="modal-body">
                        <div class="container ">
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Product</label>
                                <div class="col-sm-6">
                                    <select class="form-select form-select-sm-6" aria-label="Default select" name="product_id" id="product_id">
                                        <option selected>Select Variant</option>
                                        <?php
                                        $sql = "select product_id as prodid, product_name as prodname from product where STATUS_DEL = 0;";
                                        $result = $link->query($sql);
                                        while ($row = $result->fetch_assoc()) {
                                        ?>
                                            <option value='<?= $row['prodid'] ?>'><?= $row['prodname'] ?></option>";
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Quantity</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="prod_qty">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="fAddProduction">Add</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end add -->
</body>

</html>