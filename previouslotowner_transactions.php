<!DOCTYPE html>
<html>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta name="generator" content="Geany 1.37.1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
    <title>Trasaction List</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link rel="stylesheet" href="customertransaction.css">
    <link rel="stylesheet" href="customertransaction_mediaquery.css">
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
                    
                    <a href="previouslotowner_page.php?Id=<?php echo $account_id; ?>">Providence Map</a>
                    <span class="material-symbols-outlined"><ion-icon name="folder-outline"></ion-icon></span>
                </li>
                <li>
                    
                    <a href="previouslotowner_transactions.php?Id=<?php echo $account_id; ?>">My Transactions</a>
                    <span class="material-symbols-outlined"><ion-icon name="folder-outline"></ion-icon></span>
                </li>

                <h4>Main-menu</h4>
                <li>
				
                    <a href="prevlotowner_settings.php?Id=<?php echo $account_id; ?>">Settings</a>
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
    <aside class="sidebar">
    <div class="logo">
    <?php
    if(empty($account['PROFILE'])) {
        $default_profile_photo = "defaultprofile.jpeg";
        echo '<img src="profilepics/' . $default_profile_photo . '" alt="logo">';
    } else {
        echo '<img src="profilepics/' . htmlspecialchars($account['PROFILE']) . '" alt="logo">';
    }
    ?>
    <h2><?php echo htmlspecialchars($account['LASTNAME'] . ', ' . $account['FIRSTNAME']); ?></h2>

</div>
        <div class="wrapper">
            <ul class="links">
                <h4>Tabs</h4>
                <li>
                    <span class="material-symbols-outlined"><ion-icon name="folder-outline"></ion-icon></span>
                    <a href="previouslotowner_page.php?Id=<?php echo $account_id; ?>">Providence Map</a>
                </li>
                <li>
                    <span class="material-symbols-outlined"><ion-icon name="folder-outline"></ion-icon></span>
                    <a href="previouslotowner_transactions.php?Id=<?php echo $account_id; ?>">My Transactions</a>
                </li>

                <h4>Main-menu</h4>
                <li>
				<span class="material-symbols-outlined"><ion-icon name="settings-outline"></ion-icon></span>
                    <a href="prevlotowner_settings.php?Id=<?php echo $account_id; ?>">Settings</a>
                </li>
                <li class="logout-link">
				<span class="material-symbols-outlined"><ion-icon name="log-out-outline"></ion-icon></span>
                    <a href="index.php">Logout</a>
                </li>
            </ul>
        </div>
    </aside>


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

$sql = "SELECT * FROM tbl_transaction WHERE CUSTOMER_ID = '$account_id'";
$result = mysqli_query($conn, $sql);

echo "
<center>
<table border=1 id='product-table'>
    <thead>
           <th>Transaction ID</th>
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
<td style='text-align: center;'>
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
	<div class="rightbackground">
        <model-viewer id="myModelViewer" src="3dmodels/accountlogorevised.gltf" alt="A 3D model of a walking character"
            shadow-intensity="0.5" ar animation-name="animation_name" autoplay="speed: 0.5"
            class="providence3dlogo" camera-orbit="180deg 90deg 150m">
        </model-viewer>
        <model-viewer id="myModelViewer" src="3dmodels/VISITORTEXT.gltf" alt="A 3D model of a walking character"
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
