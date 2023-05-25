<?php
include "config.php";

if (isset($_POST['fAddProd'])) {
    $simpan = mysqli_query($link, "insert into product(product_name, product_price, product_stock, product_desc, product_image_url) values ('$_POST[product_name]', $_POST[product_price], $_POST[product_stock], '$_POST[product_desc]', '$_POST[product_image_url]');");

    if ($simpan) {
        echo "<script>
                alert('New Product added!');
                document.location='../MaintenanceData.php'
                </script>";
    } else {
        echo "<script>
                alert('Failed!');
                document.location='../MaintenanceData.php'
                </script>";
    }
}

if (isset($_POST['fUpdateProd'])) {
    $update = mysqli_query($link, "update product set product_name = '$_POST[product_name]', product_price = $_POST[product_price], product_stock = $_POST[product_stock], product_desc = '$_POST[product_desc]', product_image_url = '$_POST[product_image_url]' where product_id = '$_POST[product_id]' ;");

    if ($update) {
        echo "<script>
                alert('Product updated!');
                document.location='../MaintenanceData.php'
                </script>";
    } else {
        echo "<script>
                alert('Failed!');
                document.location='../MaintenanceData.php'
                </script>";
    }
}
if (isset($_POST['fDeleteProd'])) {
    $delete = mysqli_query($link, "update product set status_del = 1 where product_id = '$_POST[product_id]' ;");

    if ($delete) {
        echo "<script>
                alert('Product deleted!');
                document.location='../MaintenanceData.php'
                </script>";
    } else {
        echo "<script>
                alert('Failed!');
                document.location='../MaintenanceData.php'
                </script>";
    }
}

if (isset($_POST['fAddProduction'])) {
    $tempid = mysqli_query($link, "select fCheckProLog() as result;");
    $prologid = "";
    while ($row = $tempid->fetch_assoc()) {
        $prologid = $row['result'];
    }

    $sql = mysqli_query($link, "insert into product_production values ('$prologid', '$_POST[product_id]', $_POST[prod_qty], 0);");

    $sql2 = mysqli_query($link, "update production_log set proddetail_itemcount = (select sum(prod_qty) from product_production where PRODDETAIL_ID = '$prologid') where PRODDETAIL_ID = '$prologid';");

    if ($sql) {
        echo "<script>
                alert('Product Stock Updated!');
                document.location='../Log2.php'
                </script>";
    } else {
        echo "<script>
                alert('Failed!');
                document.location='../Log2.php'
                </script>";
    }
}

if (isset($_POST['fAddCustomer'])) {

    $customer = mysqli_query($link, "insert into customer(cust_name, cust_email, cust_phone, cust_address) values ('$_POST[cust_name]', '$_POST[cust_email]', '$_POST[cust_phone]', '$_POST[cust_address]');");

    if ($customer) {
        echo "<script>
                alert('Customer Added!');
                document.location='../MaintenanceData.php'
                </script>";
    } else {
        echo "<script>
                alert('Failed!');
                document.location='../MaintenanceData.php'
                </script>";
    }
}

if (isset($_POST['fUpdateCustomer'])) {
    $update = mysqli_query($link, "update customer set cust_name = '$_POST[cust_name]', cust_email='$_POST[cust_email]', cust_phone='$_POST[cust_phone]', cust_address='$_POST[cust_address]' where cust_id='$_POST[cust_id]';");

    if ($update) {
        echo "<script>
                alert('Customer updated!');
                document.location='../MaintenanceData.php'
                </script>";
    } else {
        echo "<script>
                alert('Failed!');
                document.location='../MaintenanceData.php'
                </script>";
    }
}

if (isset($_POST['fDeleteCustomer'])) {
    $delete = mysqli_query($link, "update customer set status_del = 1 where cust_id = '$_POST[cust_id]' ;");

    if ($delete) {
        echo "<script>
                alert('Customer deleted!');
                document.location='../MaintenanceData.php'
                </script>";
    } else {
        echo "<script>
                alert('Failed!');
                document.location='../MaintenanceData.php'
                </script>";
    }
}
if (isset($_POST['fUpdateOrder'])) {
    $update = mysqli_query($link, "update sales_invoice_detail set status_order = '$_POST[status_order]' where SALESINV_ID = '$_POST[inv_id]' ;");
    if ($update) {
        echo "<script>
                alert('Order updated!');
                document.location='../Order.php'
                </script>";
    } else {
        echo "<script>
                alert('Failed!');
                document.location='../Order.php'
                </script>";
    }
}
if (isset($_POST['fCancelOrder'])) {
    $delete = mysqli_query($link, "update sales_invoice_detail set status_order = 'Canceled' where salesinv_id = '$_POST[inv_id]' ;");

    if ($delete) {
        echo "<script>
                alert('Order Canceled!');
                document.location='../Order.php'
                </script>";
    } else {
        echo "<script>
                alert('Failed!');
                document.location='../Order.php'
                </script>";
    }
}
if (isset($_POST['fCheckCustomer'])){
    $check = mysqli_query($link, "select cust_id as custid, cust_name as custname from customer where cust_phone = '$_POST[custphone]';");
    $row = mysqli_fetch_array($check);
    if ($row['custid'] != null){
        echo "<script>
            document.location='../NewOrder.php?custid=$row[custid]'
        </script>";
    } else {
        echo "<script>
            alert('Customer not found!');
            document.location='../NewOrder.php?modal=1'
        </script>";
    }
}
if (isset($_POST['fAddCustomer2'])) {

    $customer = mysqli_query($link, "insert into customer(cust_name, cust_email, cust_phone, cust_address) values ('$_POST[cust_name]', '$_POST[cust_email]', '$_POST[cust_phone]', '$_POST[cust_address]');");

    if ($customer) {
        echo "<script>
                alert('Customer Added!');
                document.location='../NewOrder.php'
                </script>";
    } else {
        echo "<script>
                alert('Failed!');
                document.location='../NewOrder.php'
                </script>";
    }
}

if (isset($_POST["newinvoice"])) {
    $sql = mysqli_query($link, "insert into sales_invoice(cust_id, emp_id, salesinv_date, salesinv_itemcount, salesinv_total) values('$_POST[cid]', '$_POST[usrid]', curdate(), 0, 0);");
    $result = mysqli_query($link, "select salesinv_id as id from sales_invoice order by salesinv_id desc limit 1;");
    $row = mysqli_fetch_assoc($result);
    $hasilid = $row['id'];
    $sql = mysqli_query($link, "insert into sales_invoice_detail values('$hasilid', '$_POST[custname]', '$_POST[custaddress]', '$_POST[custphone]', '', 'Processing', '0');");
    echo "<script>
            alert('Invoice Created!');
            document.location='../NewOrder.php?inv=$hasilid&custid=$_POST[cid]'
        </script>";
}
if(isset($_POST["fAddItem"])){
    $sql = mysqli_query($link, "select fCheckStock($_POST[qty],'$_POST[product_id]') as result;");
    while($row = $sql->fetch_assoc()){
        $chStock = $row['result'];
    }
    if (isset($chStock)){
        $total = $_POST['qty'];
        $sql2 = mysqli_query($link, "select product_price as price from product where product_id ='$_POST[product_id]';");
        while($row = $sql2->fetch_assoc()){
            $total = $total*$row['price'];
        }
        $sql = mysqli_query($link, "insert into product_invoice(salesinv_id, product_id, qty, price, status_del) values ('$_POST[invid]','$_POST[product_id]',$_POST[qty],$total, 0);");
        $sql = mysqli_query($link, "update sales_invoice set salesinv_itemcount=(select sum(qty) from product_invoice where salesinv_id='$_POST[invid]'), salesinv_total=(select sum(price) from product_invoice where salesinv_id='$_POST[invid]') where salesinv_id='$_POST[invid]' ");
        echo "<script>
            document.location='../NewOrder.php?inv=$_POST[invid]&custid=$_POST[custid]'</script>";
    } else
    {
        echo "<script>alert('Stock is not enough');</script>";
        echo "<script>document.location='../NewOrder.php?inv=$_POST[invid]&custid=$_POST[custid]'</script>";
    }
}
if(isset($_POST["fTambahResi"])){
    $sql = mysqli_query($link, "update sales_invoice_detail set RECEIPT_NUMBER = '$_POST[inpresi]', status_order = 'Shipped' where salesinv_id = '$_POST[inv_id]';");
    echo "<script>
            document.location='../Order.php'
        </script>";
}

if (isset($_POST['fUpdateMat'])) {
    $update = mysqli_query($link, "update material set mat_name = '$_POST[mat_name]', mat_stock = '$_POST[mat_stock]', cat_id ='$_POST[mat_cat]' where mat_id = '$_POST[mat_id]' ;");

    if ($update) {
        echo "<script>
                alert('Material updated!');
                document.location='../MaintenanceData.php'
                </script>";
    } else {
        echo "<script>
                alert('Failed!');
                document.location='../MaintenanceData.php'
                </script>";
    }
}
if (isset($_POST['fDeleteMat'])) {
    $delete = mysqli_query($link, "update material set status_del = 1 where mat_id = '$_POST[mat_id]' ;");

    if ($delete) {
        echo "<script>
                alert('Material deleted!');
                document.location='../MaintenanceData.php'
                </script>";
    } else {
        echo "<script>
                alert('Failed!');
                document.location='../MaintenanceData.php'
                </script>";
    }
}

if (isset($_POST['fAddMatLog'])) {
    $tempid = mysqli_query($link, "select fCheckMatLog() as result;");
    $matlogid = "";
    while ($row = $tempid->fetch_assoc()) {
        $matlogid = $row['result'];
    }

    $sql = mysqli_query($link, "insert into material_invoice values ('$matlogid', '$_POST[mat_id]', $_POST[mat_qty], $_POST[mat_price], 0);");

    $sql2 = mysqli_query($link, "update purchase_invoice set matinv_itemcount = (select sum(qty) from material_invoice where matinv_id = '$matlogid') where matinv_id = '$matlogid';");

    if ($sql) {
        echo "<script>
                alert('Material Stock Updated!');
                document.location='../Log.php'
                </script>";
    } else {
        echo "<script>
                alert('Failed!');
                document.location='../Log.php'
                </script>";
    }
}

?>