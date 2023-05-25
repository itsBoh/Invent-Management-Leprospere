<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: login.php");
  exit;
}
?>
<!DOCTYPE html>
<!-- Coding by CodingLab | www.codinglabweb.com-->
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!--<title>Sidebar Menu | Side Navigation Bar</title>-->
  <!-- CSS -->
  <link rel="stylesheet" href="styles.css" />
  <!-- Boxicons CSS -->
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
  <nav>
    <div class="logo">
      <i class="bx bx-menu menu-icon"></i>
      <span class="logo-name" style="font-family: 'italiana';">LE PROSPÈRE</span>
    </div>
    <div class="sidebar">
      <div class="logo">
        <i class="bx bx-menu menu-icon"></i>
        <span class="logo-name" style="font-family: 'italiana';">LE PROSPÈRE</span>
      </div>

      <div class="sidebar-content">
        <ul class="lists">
          <li class="list">
            <a href="SalesReport.php" class="nav-link">
              <i class='bx bx-money-withdraw icon'></i>
              <span class="link">Sales Report</span>
            </a>
          </li>
          <li class="list">
            <a href="MaterialReport.php" class="nav-link">
              <i class='bx bx-spreadsheet icon'></i>
              <span class="link">Material Report</span>
            </a>
          </li>
          <li class="list">
            <a href="ProductStock.php" class="nav-link">
              <i class='bx bx-package icon'></i>
              <span class="link">Product Stock</span>
            </a>
          </li>
          <li class="list">
            <a href="MaintenanceData.php" class="nav-link">
              <i class='bx bx-bar-chart-alt-2 icon'></i>
              <span class="link">Maintenance Data</span>
            </a>
          </li>
          <li class="list">
            <a href="Log.php" class="nav-link">
              <i class='bx bx-data icon'></i>
              <span class="link">Log</span>
            </a>
          </li>
          <li class="list">
            <a href="Order.php" class="nav-link">
              <i class='bx bx-plus-circle icon'></i>
              <span class="link">Order</span>
            </a>
          </li>
        </ul>
        <div class="bottom-cotent">
          <li class="list">
            <a href="Notification.php" class="nav-link">
              <i class="bx bx-bell icon"></i>
              <span class="link">Notifications</span>
            </a>
          </li>
          <li class="list">
            <a href="Profile.php" class="nav-link">
              <i class='bx bxs-user icon'></i>
              <span class="link">User Profile</span>
            </a>
          </li>
          <li class="list">
            <a href="logout.php" class="nav-link">
              <i class="bx bx-log-out icon"></i>
              <span class="link">Logout</span>
            </a>
          </li>
        </div>
      </div>
    </div>
  </nav>
  <section class="overlay"></section>

  <div class="content" style="margin-left: 15%;">
    <div>
      <h1>Product Stock</h1>
    </div>
    <div class="chartStock">
      <?php
      include "content/productContent.php";
      ?>
    </div>
  </div>
  </div>



  <script>
    const navBar = document.querySelector("nav"),
      menuBtns = document.querySelectorAll(".menu-icon"),
      overlay = document.querySelector(".overlay");

    menuBtns.forEach((menuBtn) => {
      menuBtn.addEventListener("click", () => {
        navBar.classList.toggle("open");
      });
    });

    overlay.addEventListener("click", () => {
      navBar.classList.remove("open");
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>