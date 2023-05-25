<?php
function rupiah($angka)
{

    $hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');
    return $hasil_rupiah;
}
?>

<?php
include "config.php";
$name = $address = $phone = '';
isset($_GET['custid']) ? $cid = $_GET['custid'] : $cid = '';
$cid = isset($_GET['custid']) ? $_GET['custid'] : '';
$sql = mysqli_query($link, "select cust_name as nama, cust_address as address, cust_phone as phone from customer where cust_id = '$cid';");
while ($row = mysqli_fetch_array($sql)) {
    $name = $row['nama'];
    $address = $row['address'];
    $phone = $row['phone'];
}
if (isset($_GET['modal'])) {
    echo "<script>
    $(document).ready(function() {
        $('#modalAddCustomer').modal('show');
    });
</script>";
}
if (isset($_GET['inv'])) {
    $hasilid = $_GET['inv'];
}
?>
<form action="CRUD/actionCrud.php" autocomplete="off" method="POST">
    <input type="hidden" name="cid" value="<?php echo $cid ?>">
    <input type="hidden" value="<?= $_SESSION['id'] ?>" name="usrid">
    <div class="mb-3 row">
        <label for="exampleFormControlInput1" class="col-sm-2 col-form-label">Phone Number</label>
        <div class="col-sm-4">
            <input autocomplete="off" type="text" class="form-control" name="custphone" value="<?php echo $phone ?>" required>
        </div>
        <div class="col-sm-2">
            <button type="submit" class="btn btn-secondary" name="fCheckCustomer">Check</button>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="exampleFormControlInput1" class="col-sm-2 col-form-label">Customer Name</label>
        <div class="col-sm-5">
            <input autocomplete="off" type="text" class="form-control" name="custname" value="<?php echo $name ?>">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="exampleFormControlInput1" class="col-sm-2 col-form-label">Customer Address</label>
        <div class="col-sm-5">
            <input autocomplete="off" type="text" class="form-control" name="custaddress" value="<?php echo $address ?>">
        </div>
    </div>
    <div class="mb-3 row">
        <div class="col-sm-2">
            <button type="submit" class="btn btn-primary" name="newinvoice">New Order</button>
        </div>
    </div>
</form>




<?php if (isset($hasilid)) { ?>
    <div class="container text-center">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col">Sub Total</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <tr>
                    <?php
                    $sql = "select p.product_name as `name`, pi.QTY as Quantity, p.product_price as price, pi.price as total from product_invoice pi left join product p on pi.product_id = p.product_id where salesinv_id = '$hasilid' ;";
                    $result = mysqli_query($link, $sql) or die("Query Unsuccessful.");
                    $num = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $num++;
                        echo "<tr>
                        <th scope='row'>{$num}</th>
                        <td style='text-align: left'>{$row['name']}</td>
                        <td>{$row['Quantity']}</td>
                        <td>" . rupiah($row['price']) . "</td>
                        <td>" . rupiah($row['total']) . "</td>";
                    }
                    ?>
                </tr>
                <tr>
                    <?php 
                    $sql = mysqli_query($link, "select SALESINV_TOTAL from sales_invoice where SALESINV_ID = '$hasilid';");
                    while ($row = mysqli_fetch_array($sql)) {
                        $total = $row['SALESINV_TOTAL'];
                    }
                    ?>                                                                 
                    <th></th>
                    <td></td>
                    <td></td>
                    <th>Total</th>
                    <th> <?=  rupiah($total) ?></th>
                </tr>
            </tbody>
        </table>
        <br><br>
    </div>
    <div>
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalAddItem" style="float: right; margin-right: 17%">Add item</button>
        <a href="Order.php">
            <button type="button" class="btn btn-danger mb-3" style="float: right; margin-right: 1%">Finish</button>
        </a>
    </div>
<?php } ?>



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
                        <button type="submit" class="btn btn-primary" name="fAddCustomer2">Add</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end add -->


<!-- add item -->
<div class="modal fade modal-lg" id="modalAddItem" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Form Add Product</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" autocomplete="off" action="CRUD/actionCrud.php">
                <div class="modal-body">
                    <div class="row mb-3">
                        <input type="hidden" value="<?php echo $cid ?>" name="custid">
                        <input type="hidden" value=<?= $hasilid ?> name="invid" id="invid">
                        <input type="hidden" value=<?= htmlspecialchars($_SESSION["username"]); ?> name="username" id="username">
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
                            <input type="text" class="form-control" name="qty" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="fAddItem">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end add item-->