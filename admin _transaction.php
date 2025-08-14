<!DOCTYPE html>
<html>
<head>
    <title>Trasaction List</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link rel="stylesheet" href="admin_transaction.css">
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
<body>
<?php
include "adminaside.php";
?>
    <div class="internmentform">
    <h1><img src="pictures/listoftransactions.png" alt=""></h1>
<div class="detailstable">
<model-viewer id="myModelViewer" src="3dmodels/transactions.gltf" alt="A 3D model of a walking character"
    shadow-intensity="3" ar animation-name="animation_name" autoplay="speed: 0.5"
    class="stats3dlogo" camera-orbit="35deg 90deg 5m">
</model-viewer>
<div class="search-bar">
        <input type="text" id="search-input" placeholder="Search Name..." onkeyup="filterTable()">
        <button type="button" onclick="filterTable()"><ion-icon name="search-outline"></ion-icon></button>
    </div>
    <script>
function filterTable() {
    var searchValue = document.getElementById("search-input").value.toLowerCase();
    if (searchValue === "") {
        window.location.reload();
        return;
    }
    var table = document.getElementById("product-table");
    var rows = table.getElementsByTagName("tr");
    for (var i = 1; i < rows.length; i++) {
        var row = rows[i];
        var found = false;
        var cells = row.getElementsByTagName("td");
        for (var j = 0; j < cells.length; j++) {
            var cellText = cells[j].innerText.toLowerCase();
            if (cellText.includes(searchValue)) {
                found = true;
                break;
            }
        }
        row.style.display = found ? '' : 'none';
    }
}
</script>
<?php
include "dbconnection.php";
$sql = "SELECT * FROM tbl_transaction ";
$result = mysqli_query($conn, $sql);
echo "
<center>
<table border=1 id='product-table'>
    <thead>
           <th>Transaciton ID</th>
            <th>Order Type</th>
            <th>Order ID</th>
            <th>Customer Name</th>
            <th>Amount Paid</th>
            <th>Prepared By</th>
            <th>Invoice</th>
    </thead>
    <tbody>
";
while ($row = mysqli_fetch_assoc($result)) {;
    $intermentorederid = $row['TRANSACTION_ID'];
    $customerNameQuery = "SELECT * FROM interment_forms WHERE INTERMENTFORM_ID = '$intermentorederid'";
    $customerNameResult = mysqli_query($conn, $customerNameQuery);
    $customerNameRow = mysqli_fetch_assoc($customerNameResult);
                        echo "
                        <tr class='clickable-row' >
                            <td>" . htmlspecialchars($row['TRANSACTION_ID']) . "</td>
                            <td>" . htmlspecialchars($row['ORDER_TYPE']) . "</td>
                            <td>" . htmlspecialchars($row['ORDER_ID']) . "</td>
                            <td>" . htmlspecialchars($row['CUSTOMER_NAME']) . "</td>
                            <td> ₱ " . htmlspecialchars($row['PAYMENT_PRICE']) . "</td>
                            <td>" . htmlspecialchars($row['PREPARED_BY']) . "</td>
                            <td style='padding-left: 2.5%;'>
                            <a href='".$row['INVOICE_FILE']."' target='_blank' class='document-link'>
                            <ion-icon name='document'></ion-icon>
                            </a>
                            </td>
                            </tr>";
                            }
                            echo "
                            </tbody>
                            </table>
                            </center>
                            ";
?>
</div>
</div>
</script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
</body>
</html>
