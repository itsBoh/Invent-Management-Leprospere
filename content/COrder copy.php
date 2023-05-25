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
                <a href="NewOrder.php">
                    <button type="button" class="btn btn-primary mb-3" style="float: right;">
                        New Order
                    </button>
                </a>
                <table class="table table-striped table-hover">
                    <thead>
                        <th>Date</th>
                        <th>Invoice ID</th>
                        <th>Customer</th>
                        <th>Receipt Number</th>
                        <th class="text-end">Details</th>
                        <th class="text-end">Status</th>
                        <th></th>
                    </thead>
                    <?php
                    include "config.php";
                    $sql = "select date_format(s.salesinv_date, '%d %M %Y') as `date`, s.salesinv_id as ID, c.cust_name as Customer, sd.receipt_number as receipt , sd.status_order as status from sales_invoice s left join customer c on c.cust_id = s.cust_id left join sales_invoice_detail sd on sd.salesinv_id = s.salesinv_id order by s.salesinv_date desc;";
                    $result = $link->query($sql);
                    while ($row = $result->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?= $row['date'] ?></td>
                            <td><?= $row['ID'] ?></td>
                            <td><?= $row['Customer'] ?></td>
                            <td><?php
                                if ($row['receipt']) {
                                    echo $row['receipt'];
                                    echo "<a href='' class='btn' data-bs-toggle='modal' data-bs-target='#modalResi$row[ID]'><i class='bx bx-edit-alt icon'></i></a>";
                                } else {
                                    echo "<button class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#modalResi$row[ID]'>Update</button>";
                                }
                                ?></td>
                            <td class="text-end">
                                <a href="" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalDetailOrder<?= $row['ID'] ?>"><i class='bx bx-list-ul'></i></a>
                            </td>
                            <td class="text-end"><?= $row['status'] ?>
                                <a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalUpdateINV<?= $row['ID'] ?>"><i class="bx bx-edit-alt icon"></i></a>
                            </td>
                            <!-- <td>
                                <a href="" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalCancelOrder<?php //$row['ID'] ?>">Cancel</a>
                            </td> -->
                        </tr>

                        <!-- update -->
                        <div class="modal fade modal-lg" id="modalUpdateINV<?= $row['ID'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Product</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="POST" autocomplete="off" action="CRUD/actionCrud.php">
                                        <input type="hidden" name="inv_id" value="<?= $row['ID'] ?>">
                                        <div class="modal-body">
                                            <label class="col-sm-3 col-form-label">Status</label>
                                            <select name="status_order" id="status_order">
                                                <option selected value="Completed">Completed</option>
                                                <option value="Shipped">Shipped</option>
                                                <option value="Processing">Processing</option>

                                            </select>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" name="fUpdateOrder">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- end update -->

                        <!-- detail -->
                        <div class="modal fade modal-lg" id="modalDetailOrder<?= $row['ID'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel"><?= $row['Customer'] ?>'s Order</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="POST" autocomplete="off" action="CRUD/actionCrud.php">
                                        <input type="hidden" name="inv_id" value="<?= $row['ID'] ?>">
                                        <div class="modal-body">
                                            <div class="container text-start">
                                                <div class="row">
                                                    <div class="col">
                                                        Variant
                                                    </div>
                                                    <div class="col">
                                                        Quantity
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="container text-start">
                                                <?php
                                                $sql2 = "select p.PRODUCT_NAME, pi.QTY from product_invoice pi left join product p on pi.PRODUCT_ID = p.PRODUCT_ID where pi.SALESINV_ID = '$row[ID]' order by 1 desc ; ";
                                                $result2 = $link->query($sql2);
                                                while ($row2 = $result2->fetch_assoc()) {
                                                    echo "
                                                        <div class='row'>
                                                            <div class='col'>
                                                                $row2[PRODUCT_NAME]
                                                            </div>
                                                            <div class='col'>
                                                                $row2[QTY]
                                                            </div>
                                                        </div>
                                                        ";
                                                }
                                                ?>
                                            </div>


                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- end detail -->

                        <!-- Modal Delete-->
                        <div class="modal fade" id="modalCancelOrder<?= $row['ID'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Confirm</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="POST" autocomplete="off" action="CRUD/actionCrud.php">
                                        <div class="modal-body">
                                            <input type="hidden" name="inv_id" value="<?= $row['ID'] ?>">
                                            <h5 class="text-center">Are you sure you want to cancel this order?
                                                <br><span class="text-danger"><?= $row['ID'] ?></span>
                                            </h5>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" name="fCancelOrder">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- end delete -->

                        <!-- NOMOR RESI-->
                        <div class="modal fade" id="modalResi<?= $row['ID'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Input Receipt</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="POST" autocomplete="off" action="CRUD/actionCrud.php">
                                        <div class="modal-body">
                                            <input type="hidden" name="inv_id" value="<?= $row['ID'] ?>">
                                            <label for="inpresi">Receipt Number</label>
                                            <input type="text" name="inpresi" id="inpresi" class="form-control" placeholder="Input Receipt Number">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" name="fTambahResi">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- NOMOR RESI -->

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