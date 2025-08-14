<!DOCTYPE html>
<html>
<head>
    <title>Interment Form</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link rel="stylesheet" href="frontdeskpayment.css">
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
    <h1><img src="pictures/intermentpayment.png" alt=""></h1>
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
<div class="radiotransfer">
    <label>
        <input type="radio" name="pageSelection" id="interment" onclick="navigatePage()"> INTERMENT
    </label>
    <label>
        <input type="radio" name="pageSelection" id="transferOfRights" onclick="navigatePage()"> TRANSFER OF RIGHTS
    </label>
</div>
<script>
    function navigatePage() {
        const interment = document.getElementById('interment');
        const transferOfRights = document.getElementById('transferOfRights');
        // Redirect to the respective page based on the selected radio button
        if (interment.checked) {
            window.location.href = 'frontdeskpayment.php?Id=<?php echo urlencode($_GET['Id']); ?>';  // Replace with the actual URL for the INTERMENT page
        } else if (transferOfRights.checked) {
            window.location.href = 'frontdesk_tor_payment.php?Id=<?php echo urlencode($_GET['Id']); ?>';  // Replace with the actual URL for the TRANSFER OF RIGHTS page
        }
    }
</script>
<?php
include "dbconnection.php";
$sql = "SELECT * FROM proof_of_payments WHERE STATUS = 'pending'";
$result = mysqli_query($conn, $sql);
echo "
<center>
<table border=1 id='product-table'>
    <thead>
        <tr>
            <th>Payment ID</th>
            <th>Interment Order ID</th>
            <th>Prepared By</th>
            <th>Payment Option</th>
            <th>Reference Number</th>
        </tr>
    </thead>
    <tbody>
";
while ($row = mysqli_fetch_assoc($result)) {;
    $intermentorederid = $row['INTERMENT_ORDER'];
    $customerNameQuery = "SELECT * FROM interment_forms WHERE INTERMENTFORM_ID = '$intermentorederid'";
    $customerNameResult = mysqli_query($conn, $customerNameQuery);
    $customerNameRow = mysqli_fetch_assoc($customerNameResult);
    $customerName = $customerNameRow['PAYMENT_OPTION'];
                        echo "
                        <tr class='clickable-row' data-href='proofofpaymentdetails.php?id=" . $row['PROOF_ID'] . "&account_id=" . $account_id . "&intermentid=".$row['INTERMENT_ORDER']."'>
                            <td>" . htmlspecialchars($row['PROOF_ID']) . "</td>
                            <td>" . htmlspecialchars($row['INTERMENT_ORDER']) . "</td>
                            <td>" . htmlspecialchars($row['PREPARED_BY']) . "</td>
                            <td>" . htmlspecialchars($customerName) . "</td>
                            <td>" . htmlspecialchars($row['REFERENCE_NUMBER']) . "</td>
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
        var rows = document.querySelectorAll('.clickable-row');
        rows.forEach(function(row) {
            row.addEventListener('click', function() {
                window.location.href = this.dataset.href;
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
