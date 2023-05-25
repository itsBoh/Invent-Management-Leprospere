<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link" href="Notification.php" href="Notification.php" style="color: black;">Material</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" aria-current="page">Product</a>
  </li>
</ul>
<table class="table table-striped">
    <?php
        include_once "config.php";

        if(!$link){
            die("connection failed: "). mysqli_connect_error();
        }
        $sql = "select * from vProdLowStock;";

        $result = mysqli_query($link, $sql);

        if(mysqli_num_rows($result)> 0){
            while($row = $result->fetch_assoc()){
              echo "<div class='p-2'><a href='Log2.php'><button type='button' class='btn btn-primary'><i class='bx bx-plus'></i></button></a></div>";
    
                echo "<tr><td>Warning! ". ( isset ( $row['Name'] ) ? $row['Name'] : '' ) ." will run out soon</td></tr>";
            }
        }
        else{
            echo "<tr><td>No product is running out</td></tr>";
        }
    ?>
</table>