<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="#">Material</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="Notification2.php" style="color: black;">Product</a>
  </li>
</ul>
<table class="table table-striped">
  <?php
  include_once "config.php";

  if (!$link) {
    die("connection failed: ") . mysqli_connect_error();
  }
  $sql = "select * from vMatLowStock;";

  $result = mysqli_query($link, $sql);

  if (mysqli_num_rows($result) > 0) {
    echo "<div class='p-2'><a href='Log.php'><button type='button' class='btn btn-primary'><i class='bx bx-plus'></i></button></a></div>";
    while ($row = $result->fetch_assoc()) {
      echo "
      <tr>
        <td>" . $row["Material Name"] . "</td>
        <td>" . $row["Material Stock"] . "</td>
      ";
    }
  } else {
    echo "<tr><td>No material is running out</td></tr>";
  }
  ?>
</table>