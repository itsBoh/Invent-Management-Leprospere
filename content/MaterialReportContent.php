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
            include_once "config.php";
            echo "
            
            <div id='myChart' style='width:80%%; height:60vh;'></div>

            <script>
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
            ";

            if($link->connect_error){
                die("Connection failed: " . $connection->connect_error);
            }
                $sql = "select MAT_NAME as nama, MAT_STOCK as stock from material;";
                $result = $link->query($sql);
                if (!$result){
                die("Invalid query: " . $link->error);
                }
                echo "var data = google.visualization.arrayToDataTable([ ['Material', 'Stock'],";
                while($row = $result->fetch_assoc()){
                    echo "['" . $row['nama'] . "'," . $row['stock'] . "],";
                }
            echo "

            ]);

            var options = {
            title:''
            };

            var chart = new google.visualization.BarChart(document.getElementById('myChart'));
            chart.draw(data, options);
            }
            </script>
            ";
    ?>
</body>
</html>