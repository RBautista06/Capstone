<!DOCTYPE html>
<html>
<head>
    <title>Interment Form</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link rel="stylesheet" href="admindashboard.css">
</head>
<model-viewer id="myModelViewer" src="3dmodels/frontdesklogo.gltf" alt="A 3D model of a walking character"
    shadow-intensity="0.5" ar animation-name="animation_name" autoplay="speed: 0.5"
    class="providence3dlogo" camera-orbit="180deg 90deg 150m">
</model-viewer>
<div class="sidebackground">
</div>
<div class="rightbackground">
</div>
<model-viewer id="myModelViewer" src="3dmodels/ADMINISTRATORTEXT.gltf" alt="A 3D model of a walking character"
    shadow-intensity="3" ar animation-name="animation_name" autoplay="speed: 0.5"
    class="admintext3d" camera-orbit="340deg 83deg 200m" camera-controls>
</model-viewer>
<model-viewer id="myModelViewer" src="3dmodels/statsprovidence.gltf" alt="A 3D model of a walking character"
    shadow-intensity="3" ar animation-name="animation_name" autoplay="speed: 0.5"
    class="stats3dlogo" camera-orbit="120deg 83deg 10m">
</model-viewer>
<body>
<?php
include "adminaside.php";
?>
    <div class="internmentform">
    <h1><img src="pictures/dashboard.png" alt=""></h1>
<div class="detailstable">
<main class="main-container">
        <div class="main-title"></div>
        <div class="main-cards">
        <?php
include "dbconnection.php";
// Count all rows in the tbl_transaction table
$sql = "SELECT COUNT(*) AS transactionCount FROM tbl_transaction";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $transactionCount = $row['transactionCount'];
    // Now you have the count of all rows in the tbl_transaction table in the $transactionCount variable
} else {
    echo "0 results";
}
$conn->close();
?>
<?php
include "dbconnection.php";
// Query 1: Count for interment_forms with STATUS 'pending'
$sql = "SELECT COUNT(*) AS intermentcount FROM tbl_transaction";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $lowStockCount = $row['intermentcount'];
} else {
    $lowStockCount = 0; // No results found
}
// Query 2: Count for transfer_of_rights with STATUS 'pending'
$sql1 = "SELECT COUNT(*) AS intermentcount1 FROM request_tbl ";
$result1 = $conn->query($sql1); // Correctly use $sql1
if ($result1->num_rows > 0) {
    $row1 = $result1->fetch_assoc();
    $lowStockCount1 = $row1['intermentcount1'];
} else {
    $lowStockCount1 = 0; // No results found
}
// Query 3: Count for tbl_transaction
$sql2 = "SELECT COUNT(*) AS intermentcount2 FROM tbl_transaction";
$result2 = $conn->query($sql2); // Correctly use $sql2
if ($result2->num_rows > 0) {
    $row2 = $result2->fetch_assoc();
    $lowStockCount2 = $row2['intermentcount2'];
} else {
    $lowStockCount2 = 0; // No results found
}
$sql3 = "SELECT COUNT(*) AS intermentcount3 FROM interment_forms ";
$result3 = $conn->query($sql3); // Correctly use $sql2
if ($result2->num_rows > 0) {
    $row3 = $result3->fetch_assoc();
    $lowStockCount3 = $row3['intermentcount3'];
} else {
    $lowStockCount3 = 0; // No results found
}
$sql4 = "SELECT COUNT(*) AS intermentcount4 FROM transfer_of_rights Where STATUS = 'scheduled'";
$result4 = $conn->query($sql4); // Correctly use $sql2
if ($result4->num_rows > 0) {
    $row4 = $result4->fetch_assoc();
    $lowStockCount4 = $row4['intermentcount4'];
} else {
    $lowStockCount4 = 0; // No results found
}
$scheduledNumber = $lowStockCount3 + $lowStockCount4;
$conn->close();
?>
            <a href="admin _transaction.php" style="text-decoration: none; color: inherit;">
                <div class="card" style="position: relative;">
                    <div class="card-inner">
                        <p class="text-primary">List of Transaction</p>
                        <span class="material-icons-outlined text-blue">
                            <ion-icon name="file-tray-full-outline"></ion-icon>
                        </span>
                    </div>
                    <span class="text-primary font-weight-bold"><?php echo $lowStockCount; ?></span>
                    <?php if ($lowStockCount > 0): ?>
            <span class="red-dot"></span>
        <?php endif; ?>
                </div>
            </a>
            <a href="admin_requestaccount.php" style="text-decoration: none; color: inherit;">
            <div class="card" style="position: relative;">
                    <div class="card-inner">
                        <p class="text-primary">Account Request</p>
                        <span class="material-icons-outlined text-orange">
                        <ion-icon name="paper-plane-outline"></ion-icon>
                        </span>
                    </div>
                    <span class="text-primary font-weight-bold"><?php echo $lowStockCount1; ?></span>
                    <?php if ($lowStockCount1 > 0): ?>
<span class="red-dot"></span>
<?php endif; ?>
                </div>
            </a>
    <a href="lotlist.php" style="text-decoration: none; color: inherit;">
    <div class="card">
        <div class="card-inner">
            <p class="text-primary">Number of Descendents</p>
            <span class="material-icons-outlined text-red">
                <ion-icon name="body-outline"></ion-icon>
            </span>
        </div>
        <?php
        include "dbconnection.php";
        // Query to count the number of rows in the "burials" table
        $sql = "SELECT COUNT(*) AS count FROM interment_forms WHERE STATUS = 'Mark as done'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // Output the count dynamically
            $row = $result->fetch_assoc();
            echo '<span class="text-primary font-weight-bold">' . $row["count"] . '</span>';
        } else {
            echo "0 results";
        }
        $conn->close();
        ?>
    </div>
</a>
            <a href="adminprices.php" style="text-decoration: none; color: inherit;">
                <div class="card">
                    <div class="card-inner">
                        <p class="text-primary">Services</p>
                        <span class="material-icons-outlined text-red">
                        <ion-icon name="people-outline"></ion-icon>
                        </span>
                    </div>
                    <span class="text-primary font-weight-bold"></span>
                    <?php
        include "dbconnection.php";
        // Query to count the number of rows in the "burials" table
        $sql = "SELECT COUNT(*) AS count FROM interment_price";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // Output the count dynamically
            $row = $result->fetch_assoc();
            echo '<span class="text-primary font-weight-bold">' . $row["count"] . '</span>';
        } else {
            echo "0 results";
        }
        $conn->close();
        ?>
                </div>
            </a>
        </div>
        <div class="charts">
          <!-- <div class="charts-card">
            <p class="chart-title">Top 5 Products</p>
            <div id="bar-chart"></div>
          </div> -->
          <div class="charts-card">
            <p class="chart-title">Interment & Transfer of Rights</p>
            <div id="area-chart"></div>
          </div>
        </div>
    </main>
</div>
</div>
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.49.1/apexcharts.min.js"></script>
<script src="dashboardscript.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
</body>
</html>
