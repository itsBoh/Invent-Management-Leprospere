<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <!-- <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Alike+Angular" /> -->
    <style>
        .body{
            font-family: "alike angular";
        }
    </style>
</head>
<body>
    <form action="" method="POST" style="font-family: 'alike angular';">
        <label for="year">Select year : </label>
        <input list="years" name="year" id="year">
        <datalist id="years">
            <option value="2021">
            <option value="2022">
        </datalist>
        <label for="month"> month : </label>
        <input list="months" name="month" id="month">
        <datalist id="months">
            <option value="January">
            <option value="February">
            <option value="March">
            <option value="April">
            <option value="May">
            <option value="June">
            <option value="July">
            <option value="August">
            <option value="September">
            <option value="October">
            <option value="November">
            <option value="December">
        </datalist>
        <input type="submit" value="submit">
    </form>

    <?php 
        if(isset($_POST["year"])){

            include_once "config.php";
            echo "
            
            <div id='myChart' style='width:80%%; height:40vh;'></div>

            <script>
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
            ";

            if($link->connect_error){
                die("Connection failed: " . $link->connect_error);
            }
            if($_POST['month'] == ""){
                $sql = "call pYearSalesStock(". $_POST['year'] .");";
                $result = $link->query($sql);
                if (!$result){
                die("Invalid query: " . $link->error);
                }
                echo "var data = google.visualization.arrayToDataTable([ ['Month', 'Sold Stock'],";
                while($row = $result->fetch_assoc()){
                    echo "['" . $row['Month'] . "'," . $row['Sold Stock'] . "],";
                }
            }
            else {
                $sql = "call pMonthSalesStock('" . $_POST['month'] . "', " . $_POST['year'] . ");";
                $result = $link->query($sql);
                if (!$result){
                die("Invalid query: " . $link->error);
                }
                echo "var data = google.visualization.arrayToDataTable([ ['Variant', 'Quantity'],";
                while($row = $result->fetch_assoc()){
                    echo "['" . $row['Variant']. "',". $row['Quantity']. "],";
                }
            }
            echo "

            ]);

            var options = {
            title:'Laporan Penjualan'
            };

            var chart = new google.visualization.BarChart(document.getElementById('myChart'));
            chart.draw(data, options);
            }
            </script>
            ";

        }
    ?>
</body>
</html>