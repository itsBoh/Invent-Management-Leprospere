<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://www.gstatic.com/charts/loader.js">
</script>
</head>
<body>
    <?php 
            include 'config.php';
            echo "
            
            <div id='myChart' style='width:80%%; height:60vh;'></div>

            <script>
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
            ";

            if($link->connect_error){
                die("Connection failed: " . $link->connect_error);
            }
                $sql = "select Product_name as nama, product_stock as stock from product;";
                $result = $link->query($sql);
                if (!$result){
                die("Invalid query: " . $link->error);
                }
                echo "var data = google.visualization.arrayToDataTable([ ['Product', 'Stock'],";
                while($row = $result->fetch_assoc()){
                    echo "['" . $row['nama'] . "'," . $row['stock'] . "],";
                }
            echo "

            ]);

            var options = {
            title:''
            };

            var chart = new google.visualization.PieChart(document.getElementById('myChart'));
            chart.draw(data, options);
            }
            </script>
            ";
    ?>
</body>
</html>