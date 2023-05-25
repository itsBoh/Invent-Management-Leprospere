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
                        <th>Sales ID</th>
                        <th>Date</th>
                        <th>Customer</th>
                        <th>Employee</th>
                        <th>Total</th>
                    </thead>

                    <?php
                    $sql = "select s.SALESINV_ID as salesid, s.SALESINV_DATE as `date`, date_format(s.salesinv_date, '%e %M %Y') as `dateformat`, c.CUST_NAME as custname, e.EMP_NAME as empname, s.SALESINV_TOTAL as total , c.CUST_ID as custid, e.EMP_ID as empid from sales_invoice s left join customer c on s.cust_id = c.cust_id left join employee e on s.emp_id = e.emp_id order by s.SALESINV_DATE desc;";
                    $result = $link->query($sql);
                    while ($row = $result->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?= $row['salesid'] ?></td>
                            <td><?= $row['dateformat'] ?></td>
                            <td><?= $row['custname'] ?></td>
                            <td class="col-sm-6"><?= $row['empname'] ?></td>
                            <td><?= rupiah($row['total']) ?></td>
                        </tr>
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