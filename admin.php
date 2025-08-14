<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMINISTRATOR VIEW</title>
    <!-- Linking Google font link for icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link rel="stylesheet" href="admin.css">
  </head>
  <body>
    <aside class="sidebar">
      <div class="logo">
        <img src="adminphoto.jpg" alt="logo">
        <h2>ADMINISTRATOR</h2>
      </div>
      <div class="wrapper">
      <ul class="links">
        <h4>Sales</h4>
        <li>
          <span class="material-symbols-outlined">dashboard</span>
          <a href="#">Dashboard</a>
        </li>
        <li>
            <span class="material-symbols-outlined"><ion-icon name="folder-outline"></ion-icon></span>
            <a href="adminapplicationinterment.php">Transactions</a>
        </li>
        <li>
            <span class="material-symbols-outlined"><ion-icon name="folder-outline"></ion-icon></span>
            <a href="lotlist.php">List of Lots</a>
        </li>
        <hr>
        <h4>Accounts</h4>
        <li>
          <span class="material-symbols-outlined">person</span>
          <a href="listaccs.php" class="listaccs">List of Accounts</a>
        </li>
        <li>
          <span class="material-symbols-outlined">group</span>
          <a href="logs.php">Log-in Time</a>
        </li>
        <hr>
        <h4>Main-menu</h4>
        <li>
          <span class="material-symbols-outlined">settings</span>
          <a href="#">Settings</a>
        </li>
        <li class="logout-link">
          <span class="material-symbols-outlined">logout</span>
          <a href="index.html">Logout</a>
        </li>
      </ul>
    </div>
  </div>
    </aside>
    <main class="main-container">
        <div class="main-title">
        </div>
        <div class="main-cards">
<?php
include "conaccounts.php";
$sql = "SELECT COUNT(*) AS productCount FROM tbl_modelstock";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $productCount = $row['productCount'];
} else {
    echo "0 results";
}
$conn->close();
?>
          <div class="card">
            <div class="card-inner">
              <p class="text-primary">PRODUCTS</p>
              <span class="material-icons-outlined text-blue"><ion-icon name="bag-add-outline"></ion-icon></span>
            </div>
            <span class="text-primary font-weight-bold"><?php echo $productCount; ?>  </span>
          </div>
          <?php
include "conaccounts.php";
$sql = "SELECT SUM(TOTAL) AS ORDER_SALES FROM transactionlist WHERE CATEGORY = ?";
$stmt = $conn->prepare($sql);
$category = 'Order';
$stmt->bind_param('s', $category);
$stmt->execute();
$result = $stmt->get_result();
if ($result) {
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $orderSales = $row['ORDER_SALES'];
    } else {
        echo "0 results";
    }
} else {
    echo "Error: " . $conn->error;
}
$sqlrent = "SELECT SUM(TOTAL) AS RENTING_SALES FROM transactionlist WHERE category = ?";
$stmtrent = $conn->prepare($sqlrent);
$category = 'Rental';
$stmtrent->bind_param('s', $category);
$stmtrent->execute();
$resultrent = $stmtrent->get_result();
if ($resultrent) {
    if ($resultrent->num_rows > 0) {
        $row1 = $resultrent->fetch_assoc();
        $rentsales = $row1['RENTING_SALES'];
    } else {
        echo "0 results";
    }
} else {
    echo "Error: " . $conn->error;
}
$stmtrent->close();
?>
<?php
$conn->close();
?>
          <div class="card">
            <div class="card-inner">
              <p class="text-primary">ORDER SALES</p>
              <span class="material-icons-outlined text-orange"><ion-icon name="cart-outline"></ion-icon></span>
            </div>
            <span class="text-primary font-weight-bold"><?php echo "₱ " . number_format($orderSales, 2); ?></span>
          </div>
          <div class="card">
            <div class="card-inner">
              <p class="text-primary">RENTAL SALES</p>
              <span class="material-icons-outlined text-green"><ion-icon name="file-tray-full-outline"></ion-icon></span>
            </div>
            <span class="text-primary font-weight-bold"><?php echo "₱ " . number_format($rentsales, 2); ?></span>
          </div>
          <?php
include "conaccounts.php";
$sql = "SELECT COUNT(*) AS lowStockCount FROM tbl_modelstock WHERE STOCK <= 10";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $lowStockCount = $row['lowStockCount'];
} else {
    echo "0 results";
}
$conn->close();
?>
          <div class="card">
            <div class="card-inner">
              <p class="text-primary">INVENTORY ALERTS</p>
              <span class="material-icons-outlined text-red"><ion-icon name="notifications-outline"></ion-icon></span>
            </div>
            <span class="text-primary font-weight-bold"><?php echo $lowStockCount; ?></span>
          </div>
        </div>
        <div class="charts">
          <div class="charts-card">
            <p class="chart-title">Top 5 Products</p>
            <div id="bar-chart"></div>
          </div>
          <div class="charts-card">
            <p class="chart-title">Purchase and Sales Orders</p>
            <div id="area-chart"></div>
          </div>
        </div>
      </main>
      <!-- End Main -->
    </div>
    <!-- Scripts -->
    <!-- ApexCharts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.3/apexcharts.min.js"></script>
    <!-- Custom JS -->
    <script src="dashboardscript.js"></script>
  </body>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</html>