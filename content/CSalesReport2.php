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
        .body {
            font-family: "alike angular";
        }
    </style>
    <script>
        window.onload = function() {

            var chart = new CanvasJS.Chart("chartContainer", {
                title: {
                    text: "Push-ups Over a Week"
                },
                axisY: {
                    title: "Number of Push-ups"
                },
                data: [{
                    type: "line",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();

        }
    </script>
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
    <div id='chartContainer' style='height: 370px; width: 100%;'></div>
    <script src='https://canvasjs.com/assets/script/canvasjs.min.js'></script>
    <?php
    if (isset($_POST["year"])) {

        include_once "config.php";

        if ($link->connect_error) {
            die("Connection failed: " . $link->connect_error);
        }
        if ($_POST['month'] == "") {
            $sql = "call pYearSalesStock(" . $_POST['year'] . ");";
            $result = $link->query($sql);
            if (!$result) {
                die("Invalid query: " . $link->error);
            }
            echo "$dataPoints =  array(";
            while ($row = $result->fetch_assoc()) {
                echo "array('y' =>" . $row['Sold Stock'] . ", 'label' =>'" . $row['Month'] . "'),";
            }
        } else {
            $sql = "call pMonthSalesStock('" . $_POST['month'] . "', " . $_POST['year'] . ");";
            $result = $link->query($sql);
            if (!$result) {
                die("Invalid query: " . $link->error);
            }
            echo "var data = google.visualization.arrayToDataTable([ ['Variant', 'Quantity'],";
            while ($row = $result->fetch_assoc()) {
                echo "['" . $row['Variant'] . "'," . $row['Quantity'] . "],";
            }
        }
        echo ");";
    }
    ?>
</body>

</html>