<!DOCTYPE html>
<html>
<head>
    <title>Front Desk ToR Order</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link rel="stylesheet" href="frondesk_transferorrights.css">
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

<!-- <model-viewer id="myModelViewer" src="3dmodels/statsprovidence.gltf" alt="A 3D model of a walking character" 
    shadow-intensity="3" ar animation-name="animation_name" autoplay="speed: 0.5" 
    class="stats3dlogo" camera-orbit="120deg 83deg 10m">
</model-viewer> -->
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
    <h1><img src="pictures/transferofrightsorder.png" alt=""></h1>

<div class="detailstable">

<div class="search-bar">
        <input type="text" id="search-input" placeholder="Search Name..." onkeyup="filterTable()">
        <button type="button" onclick="filterTable()"><ion-icon name="search-outline"></ion-icon></button>
    </div>



    <script>
function filterTable() {
    var searchValue = document.getElementById("search-input").value.toLowerCase();
    
    if (searchValue === "") {
        // If the search box is empty, refresh the page
        window.location.reload(); // Refreshes the current page
        return; // Exit the function to avoid further processing
    }

    var table = document.getElementById("product-table");
    var rows = table.getElementsByTagName("tr");

    // Loop through all rows in the table (excluding the header)
    for (var i = 1; i < rows.length; i++) {
        var row = rows[i];
        var found = false;

        // Loop through all cells in the row
        var cells = row.getElementsByTagName("td");
        for (var j = 0; j < cells.length; j++) {
            var cellText = cells[j].innerText.toLowerCase();

            // Check if the search value is found in any cell
            if (cellText.includes(searchValue)) {
                found = true;
                break;
            }
        }

        // Show or hide the row based on whether the search value is found
        row.style.display = found ? '' : 'none';
    }
}

</script>
<?php
include "dbconnection.php";

$sql = "SELECT * FROM transfer_of_rights WHERE STATUS = 'request'";
$result = mysqli_query($conn, $sql);

echo "
<center>
<table border=1 id='product-table'>
    <thead>
        <tr>
            <th>Request ID</th>
            <th>Transferor Name</th>
            <th>Transferee Name</th>
            <th>Location ID</th>
            <th>Date of Transfer</th>
            <th>TOR File</th>
            <th>Total Price</th>
        </tr>
    </thead>
    <tbody>
";

while ($row = mysqli_fetch_assoc($result)) {
                        // Fetch customer name from tbl_accounts using ACCOUNT_ID
                        $customerId = $row['CUSTOMER_ID'];
                        $customerNameQuery = "SELECT NAME FROM tbl_accounts WHERE ACCOUNT_ID = $customerId";
                        $customerNameResult = mysqli_query($conn, $customerNameQuery);
                        $customerNameRow = mysqli_fetch_assoc($customerNameResult);
                        $customerName = $customerNameRow['NAME'];

                        echo "
                        <tr class='clickable-row' data-href='frontdesk_tordetails.php?id=" . $row['ID'] . "&account_id=" . $account_id . "'>
                            <td>" . htmlspecialchars($row['ID']) . "</td>
                            <td>" . htmlspecialchars($row['TRANSFEROR_NAME']) . "</td>
                            <td>" . htmlspecialchars($row['TRANSFEREE_NAME']) . "</td>

                            <td>" . htmlspecialchars($row['LOCATION_ID']) . "</td>
                            <td>" . htmlspecialchars($row['DATE_OF_TRANSFER']) . "</td>
                            <td style='padding-left: 2.5%;'>
                            <a href='".$row['TOR_PDF']."' target='_blank' class='document-link'>
                            <ion-icon name='document'></ion-icon>
                            </a>
                            </td> 
                            <td>₱ " . htmlspecialchars($row['TOTAL_PRICE']) . "</td>

                        </tr>";
}

echo "
    </tbody>
</table>
</center>
";
?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const rows = document.querySelectorAll('.clickable-row');

    rows.forEach(row => {
        row.addEventListener('click', function() {
            window.location = this.getAttribute('data-href');
        });

        // Prevent row click when clicking on the anchor link
        row.querySelectorAll('.document-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.stopPropagation(); // Stop the click from bubbling up to the row
            });
        });
    });
});
</script>



</div>


</div>
</script>


    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
</body>

</html>
