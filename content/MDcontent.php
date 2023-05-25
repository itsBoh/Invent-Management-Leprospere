<?php
    function rupiah($angka){
	
        $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
        return $hasil_rupiah;
     
    }
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial;
        }

        /* Style the tab */
        .tab {
            overflow: hidden;
            background-color: #FFFFFF;
        }

        /* Style the buttons inside the tab */
        .tab button {
            background-color: inherit;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            transition: 0.3s;
            font-size: 17px;
        }

        /* Change background color of buttons on hover */
        .tab button:hover {
            background-color: #ddd;
        }

        /* Create an active/current tablink class */
        .tab button.active {
            background-color: #ccc;
        }

        /* Style the tab content */
        .tabcontent {
            display: none;
            padding: 6px 12px;
            border-top: none;
        }
    </style>
</head>

<body>

    <div class="tab">
        <button class="tablinks" onclick="openTab(event, 'prod')" id="defaultOpen">Product</button>
        <button class="tablinks" onclick="openTab(event, 'cust')">Customer</button>
        <button class="tablinks" onclick="openTab(event, 'emp')">Employee</button>
        <button class="tablinks" onclick="openTab(event, 'sales')">Sales Invoice</button>
        <button class="tablinks" onclick="openTab(event, 'mat')">Material</button>
    </div>

    <div id="prod" class="tabcontent">
        <?php include "CRUD/crudProduct.php"; ?>
    </div>

    <div id="cust" class="tabcontent">
        <?php include "CRUD/crudCustomer.php"; ?>
    </div>

    <div id="emp" class="tabcontent">
        <?php include "CRUD/crudEmployee.php" ?>
    </div>

    <div id="sales" class="tabcontent">
        <?php include "CRUD/crudSalesInvoice.php" ?>
    </div>
    
    <div id="mat" class="tabcontent">
        <?php include "CRUD/crudMaterial.php" ?>
    </di>
    
    <script>
        function openTab(evt, tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += " active";
        }

        document.getElementById("defaultOpen").click();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>