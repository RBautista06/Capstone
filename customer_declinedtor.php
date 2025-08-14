<!DOCTYPE html>
<html>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta name="generator" content="Geany 1.37.1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
    <title>Interment Form</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link rel="stylesheet" href="customer_declineinterment.css">
    <link rel="stylesheet" href="customerintermentpayment_mediaquery.css">
    <link rel="stylesheet" href="customersidebar.css" type="text/css" />
</head>

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
<div class="toggle-btn">
    <ion-icon name="menu-outline"></ion-icon>
</div>
<div class="dropdown-menu">
    <button class="close-btn">&times;</button>
    <div class="logosidebar">
    <h2><?php echo htmlspecialchars($account['LASTNAME'] . ', ' . $account['FIRSTNAME']); ?></h2>
    <?php
    if(empty($account['PROFILE'])) {
        $default_profile_photo = "defaultprofile.jpeg";
        echo '<img src="profilepics/' . $default_profile_photo . '" alt="logo">';
    } else {
        echo '<img src="profilepics/' . htmlspecialchars($account['PROFILE']) . '" alt="logo">';
    }
    ?>
    </div>
        <h4>Tabs</h4>
                <li>
                    <a href="customermap.php?Id=<?php echo urlencode($_GET['Id']); ?>">Providence Map</a>
                    <span class="material-symbols-outlined"><ion-icon name="folder-outline"></ion-icon></span>
                </li>
                <li>
                    <a href="intermentform.php?Id=<?php echo urlencode($_GET['Id']); ?>">Interment Form</a>
                    <span class="material-symbols-outlined"><ion-icon name="document-outline"></ion-icon></span>
                </li>
                <li>
                    <a href="transferownership.php?Id=<?php echo urlencode($_GET['Id']); ?>">Transfer Ownership</a>
                    <span class="material-symbols-outlined"><ion-icon name="send-outline"></ion-icon></span>
                </li>
                <h4>Payment</h4>
                <li>
                    <a href="customerintermentpayment.php?Id=<?php echo urlencode($_GET['Id']); ?>">Order Payment</a>
                    <span class="material-symbols-outlined"><ion-icon name="cash-outline"></ion-icon></span>
                </li>
                <li>
                    <a href="customer_reschedule_intermentpayment.php?Id=<?php echo urlencode($_GET['Id']); ?>">Reschedule Payment</a>
                    <span class="material-symbols-outlined"><ion-icon name="calendar-number-outline"></ion-icon></span>
                </li>
                <h4>Declined Request</h4>
                <li>
                    <a href="customer_declinedinterment.php?Id=<?php echo urlencode($_GET['Id']); ?>">Declined Orders</a>
                    <span class="material-symbols-outlined"><ion-icon name="alert-outline"></ion-icon></span>
                </li>
                <li>
                    <a href="customertransaction.php?Id=<?php echo urlencode($_GET['Id']); ?>">My Transactions</a>
                    <span class="material-symbols-outlined"><ion-icon name="file-tray-full-outline"></ion-icon></span>
                </li>
                <h4>Main-menu</h4>
                <li>
                    <a href="accountsettings.php?Id=<?php echo urlencode($_GET['Id']); ?>">Settings</a>
                    <span class="material-symbols-outlined"><ion-icon name="settings-outline"></ion-icon></span>
                </li>
                <li class="logout-link">
                    <a href="index.php">Logout</a>
                    <span class="material-symbols-outlined"><ion-icon name="log-out-outline"></ion-icon></span>
                </li>
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const toggleBtn = document.querySelector('.toggle-btn');
        const dropdownMenu = document.querySelector('.dropdown-menu');
        const closeBtn = document.querySelector('.dropdown-menu .close-btn');
        const btnPopups = document.querySelectorAll('.btnLogin-popup'); // Select all login buttons
        const iconClose = document.querySelector('.iconclose');
        // Toggle dropdown menu
        toggleBtn.addEventListener('click', () => {
            dropdownMenu.classList.toggle('show');
        });
        // Close dropdown menu
        closeBtn.addEventListener('click', () => {
            dropdownMenu.classList.remove('show');
        });
        // Add event listeners to all login buttons
        btnPopups.forEach((btn) => {
            btn.addEventListener('click', () => {
                wrapper.classList.add('active-popup'); // Show the login popup
                dropdownMenu.classList.remove('show'); // Close the dropdown menu
                console.log('Login button clicked: active-popup class added, dropdown menu closed');
            });
        });
        // Close the popup
        iconClose.addEventListener('click', () => {
            wrapper.classList.remove('active-popup');
            console.log('Close icon clicked: active-popup class removed');
        });
    });
</script>
<body>
<?php
 include "customeraside.php";
 ?>
    <div class="internmentform">
    <h1><img src="pictures/deedoftransfer.png" alt=""></h1>
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
            window.location.href = 'customer_declinedinterment.php?Id=<?php echo urlencode($_GET['Id']); ?>';  // Replace with the actual URL for the INTERMENT page
        } else if (transferOfRights.checked) {
            window.location.href = 'customer_declinedtor.php?Id=<?php echo urlencode($_GET['Id']); ?>';  // Replace with the actual URL for the TRANSFER OF RIGHTS page
        }
    }
</script>
<?php
include "dbconnection.php";
$account_id = isset($_GET['Id']) ? intval($_GET['Id']) : 0;
$sql = "SELECT * FROM transfer_of_rights WHERE STATUS = 'Declined' AND CUSTOMER_ID = $account_id";
$result = mysqli_query($conn, $sql);
echo "
<center>
<table border=1 id='product-table'>
    <thead>
        <tr>
            <th>TOR ID</th>
            <th>Transferee Name</th>
            <th>Lot Description</th>
            <th>Transfer Date</th>
            <th>Total Price</th>
            <th>Delete</th>
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
    <tr class='clickable-row' data-href='decline_tordetails.php?Id=" . $account_id  . "&interment_id=" . $row['ID'] . "'>
        <td>" . htmlspecialchars($row['ID']) . "</td>
        <td>" . htmlspecialchars($customerName) . "</td>
        <td>" . htmlspecialchars($row['LOT_DESCRIPTION']) . "</td>
        <td>" . htmlspecialchars($row['DATE_OF_TRANSFER']) . "</td>
        <td>₱ " . $row['TOTAL_PRICE'] . "</td>
        <td>
    <a href='delete_tor.php?interment_id=" . $row['ID'] . "&account_id=" . $account_id . "' class='delete-link' onclick='return confirm(\"Are you sure you want to delete this record?\")'>Delete</a>
</td>
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
    <div class="rightbackground">
        <model-viewer id="myModelViewer" src="3dmodels/accountlogorevised.gltf" alt="A 3D model of a walking character"
            shadow-intensity="0.5" ar animation-name="animation_name" autoplay="speed: 0.5"
            class="providence3dlogo" camera-orbit="180deg 90deg 150m">
        </model-viewer>
        <model-viewer id="myModelViewer" src="3dmodels/LOTOWNERTEXT.gltf" alt="A 3D model of a walking character"
            shadow-intensity="3" ar animation-name="animation_name" autoplay="speed: 0.5"
            class="admintext3d" camera-orbit="10deg 90deg 300m" camera-controls>
        </model-viewer>
    </div>
</script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
</body>
</html>
