<!DOCTYPE html>
<html>
<head>
    <title>Frontdesk Dashboard</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link rel="stylesheet" href="frontdeskdashboard.css">
</head>
<model-viewer id="myModelViewer" src="3dmodels/frontdesklogo.gltf" alt="A 3D model of a walking character" 
    shadow-intensity="0.5" ar animation-name="animation_name" autoplay="speed: 0.5" 
    class="providence3dlogo" camera-orbit="180deg 90deg 150m">
</model-viewer>
<div class="sidebackground">

</div>
<div class="rightbackground">

</div>

<model-viewer id="myModelViewer" src="3dmodels/FRONTDESKTEXT.gltf" alt="A 3D model of a walking character" 
    shadow-intensity="3" ar animation-name="animation_name" autoplay="speed: 0.5" 
    class="admintext3d" camera-orbit="340deg 83deg 300m" camera-controls>
</model-viewer>

<model-viewer id="myModelViewer" src="3dmodels/statsprovidence.gltf" alt="A 3D model of a walking character" 
    shadow-intensity="3" ar animation-name="animation_name" autoplay="speed: 0.5" 
    class="stats3dlogo" camera-orbit="120deg 83deg 10m">
</model-viewer>
<?php

include 'dbconnection.php';


$account_id = isset($_GET['Id']) ? intval($_GET['Id']) : 0;

if ($account_id > 0) {

    $query = "SELECT * FROM tbl_accounts WHERE ACCOUNT_ID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $account_id);
    $stmt->execute();
    $result = $stmt->get_result();


    if ($result->num_rows > 0) {

        $account = $result->fetch_assoc();
    } else {
        echo "Account not found.";
        exit;
    }
} else {
    echo "Invalid account ID.";
    exit;
}


$stmt->close();
$conn->close();
?>
<body>

<?php
include "frontdeskaside.php";
?>

    

    <div class="internmentform">
    <h1><img src="pictures/dashboard.png" alt=""></h1>

<div class="detailstable">


<main class="main-container">
        <div class="main-title"></div>

        <div class="main-cards">
<?php
include "dbconnection.php";

// Query 1: Count for interment_forms with STATUS 'pending'
$sql = "SELECT COUNT(*) AS intermentcount FROM interment_forms WHERE STATUS = 'pending'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $lowStockCount = $row['intermentcount'];
} else {
    $lowStockCount = 0; // No results found
}

// Query 2: Count for transfer_of_rights with STATUS 'pending'
$sql1 = "SELECT COUNT(*) AS intermentcount1 FROM transfer_of_rights WHERE STATUS = 'request'";
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

$sql3 = "SELECT COUNT(*) AS intermentcount3 FROM interment_forms Where STATUS = 'scheduled'";
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
            <a href="frontdeskintermentorder.php?Id=<?php echo urlencode($_GET['Id']); ?>" style="text-decoration: none; color: inherit;">
            <div class="card" style="position: relative;">
                    <div class="card-inner">
                        <p class="text-primary">Interment Orders</p>
                        <span class="material-icons-outlined text-blue">
                            <ion-icon name="file-tray-full-outline"></ion-icon>
                        </span>
                    </div>
                    <span class="text-primary font-weight-bold"><?php echo $lowStockCount; ?></span>
                    <?php if ($lowStockCount > 0): ?>
            <!-- Red dot if $lowStockCount1 is not zero -->
            <span class="red-dot"></span>
        <?php endif; ?>
                </div>
                
            </a>

<a href="frondesk_transferorrights.php?Id=<?php echo urlencode($_GET['Id']); ?>" style="text-decoration: none; color: inherit;">
    <div class="card" style="position: relative;">
        <div class="card-inner">
            <p class="text-primary">Transfer of Rights Orders</p>
            <span class="material-icons-outlined text-orange">
                <ion-icon name="paper-plane-outline"></ion-icon>
            </span>
        </div>
        <span class="text-primary font-weight-bold"><?php echo $lowStockCount1; ?></span>

        <?php if ($lowStockCount1 > 0): ?>
            <!-- Red dot if $lowStockCount1 is not zero -->
            <span class="red-dot"></span>
        <?php endif; ?>
    </div>
</a>


            <a href="frontdesk_calendar.php?Id=<?php echo urlencode($_GET['Id']); ?>" style="text-decoration: none; color: inherit;">
            <div class="card" style="position: relative;">
                    <div class="card-inner">
                        <p class="text-primary">Schedules</p>
                        <span class="material-icons-outlined text-red">
                        <ion-icon name="calendar-outline"></ion-icon>
                        </span>
                    </div>
                    <span class="text-primary font-weight-bold"><?php echo $scheduledNumber; ?></span>
                    <?php if ($scheduledNumber > 0): ?>
            <!-- Red dot if $lowStockCount1 is not zero -->
            <span class="red-dot"></span>
        <?php endif; ?>
                </div>
            </a>
            <a href="#" style="text-decoration: none; color: inherit;">
                <div class="card">
                    <div class="card-inner">
                        <p class="text-primary">Transactions</p>
                        <span class="material-icons-outlined text-red">
                        <ion-icon name="folder-outline"></ion-icon>
                        
                        </span>
                    </div>
                    <span class="text-primary font-weight-bold"><?php echo $lowStockCount2; ?></span>
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
