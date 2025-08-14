<!DOCTYPE html>
<html>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta name="generator" content="Geany 1.37.1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
    <title>Lot Owner Payment</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link rel="stylesheet" href="customerintermentpayment_details.css">
     <link rel="stylesheet" href="customerintermentpayment_details_mediaquery.css">
        <link rel="stylesheet" href="customersidebar.css" type="text/css" />
</head>
<?php
include 'dbconnection.php';
$account_id = isset($_GET['account_id']) ? intval($_GET['account_id']) : 0;
$interment_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($account_id > 0) {
    // Fetch account details
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
    $stmt->close();
} else {
    echo "Invalid account ID.";
    exit;
}
if ($interment_id > 0) {
    // Fetch interment form details
    $query = "SELECT * FROM payment_tor WHERE ID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $interment_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $interment = $result->fetch_assoc();
    } else {
        echo "Interment form not found.";
        exit;
    }
    $stmt->close();
} else {
    echo "Invalid interment ID.";
    exit;
}
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
        if (empty($account['PROFILE'])) {
            $default_profile_photo = "defaultprofile.jpeg";
            echo '<img src="profilepics/' . $default_profile_photo . '" alt="logo">';
        } else {
            echo '<img src="profilepics/' . htmlspecialchars($account['PROFILE']) . '" alt="logo">';
        }
        ?>
    </div>
                <h4>Tabs</h4>
                <li>
                    <a href="customermap.php?Id=<?php echo urlencode($account_id); ?>">Providence Map</a>
                                        <span class="material-symbols-outlined"><ion-icon name="folder-outline"></ion-icon></span>
                </li>
                <li>
                    <a href="intermentform.php?Id=<?php echo urlencode($account_id); ?>">Interment Form</a>
                    <span class="material-symbols-outlined"><ion-icon name="document-outline"></ion-icon></span>
                </li>
                <li>
                    <a href="transferownership.php?Id=<?php echo urlencode($account_id); ?>">Transfer Ownership</a>
                    <span class="material-symbols-outlined"><ion-icon name="send-outline"></ion-icon></span>
                </li>
                <h4>Payment</h4>
                <li>
                    <a href="customerintermentpayment.php?Id=<?php echo urlencode($account_id); ?>">Order Payment</a>
                   <span class="material-symbols-outlined"><ion-icon name="cash-outline"></ion-icon></span>
                </li>
                <li>
                    <a href="customer_reschedule_intermentpayment.php?Id=<?php echo urlencode($account_id); ?>">Reschedule Payment</a>
                      <span class="material-symbols-outlined"><ion-icon name="calendar-number-outline"></ion-icon></span>
                </li>
                <h4>Declined Request</h4>
                <li>
                    <a href="customer_declinedinterment.php?Id=<?php echo urlencode($account_id); ?>">Declined Orders</a>
                   <span class="material-symbols-outlined"><ion-icon name="alert-outline"></ion-icon></span>
                </li>
                <li>
                    <a href="customertransaction.php?Id=<?php echo urlencode($account_id); ?>">My Transactions</a>
                    <span class="material-symbols-outlined"><ion-icon name="file-tray-full-outline"></ion-icon></span>
                </li>
                <h4>Main-menu</h4>
                <li>
                    <a href="accountsettings.php?Id=<?php echo urlencode($account_id); ?>">Settings</a>
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
 include "customeraside_accountid.php";
 ?>
<div class="internmentform">
    <h1><img src="pictures/paymentdetails.png" alt=""></h1>
    <div class="detailstable">
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const backButton = document.getElementById('backButton');
            backButton.addEventListener('click', function() {
                window.location.href = 'customerintermentpayment.php?Id=<?php echo urlencode($_GET['account_id']); ?>';
            });
        });
        </script>
        <div class="passbuttons">
            <button type="button" id="backButton">
                <ion-icon name="arrow-back-circle"></ion-icon>
            </button>
        </div>
    <?php
include "dbconnection.php";
$interment_id1 = $interment['TOR_ID'];
$query1 = "SELECT * FROM transfer_of_rights WHERE ID = ?";
$stmt1 = $conn->prepare($query1);
if (!$stmt1) {
    echo "Error preparing statement: " . $conn->error;
    exit;
}
$stmt1->bind_param("i", $interment_id1);
$stmt1->execute();
$result1 = $stmt1->get_result();
if ($result1->num_rows > 0) {
    $interment1 = $result1->fetch_assoc();
} else {
    echo "Interment form not found.";
    exit;
}
$stmt1->close();
$payment_option = $interment1['PAYMENT_OPTION'];
$payment_instruction_link = "";
if ($payment_option == "Gcash") {
    $payment_instruction_link = "paymentinstruction/GCASH PAYMENT.pdf";
} elseif ($payment_option == "Metrobank") {
    $payment_instruction_link = "paymentinstruction/METROBANK PAYMENT.pdf";
} else {
}
?>
<div class="details">
        <div class="payments">
    <img src="pictures/intermentdetails.png" alt="">
    <br>
    <label for="">
        View Interment Order:
        <button type="button" onclick="window.open('<?php echo htmlspecialchars($interment1['TOR_PDF']); ?>', '_blank')">
    <ion-icon name="document-attach-outline"></ion-icon>
</button>
</label>
    <br>
<label for="">Payment Instructions:</label>
        <?php if (!empty($payment_instruction_link)): ?>
            <a href="<?php echo $payment_instruction_link; ?>" target="_blank">View Instruction</a>
        <?php else: ?>
            <span>No payment instruction available for this payment option.</span>
        <?php endif; ?>
    <table>
    <?php
$frontdesk_id= $interment['FRONTDESK_ID'];
$query2 = "SELECT NAME FROM tbl_accounts WHERE ACCOUNT_ID = ?";
$stmt2 = $conn->prepare($query2);
if (!$stmt2) {
    echo "Error preparing statement: " . $conn->error;
    exit;
}
$stmt2->bind_param("i", $frontdesk_id);
$stmt2->execute();
$result2 = $stmt2->get_result();
if ($result2->num_rows > 0) {
    $frontdesk = $result2->fetch_assoc();
    $frontdesk_name = $frontdesk['NAME'];
} else {
    $frontdesk_name = "Unknown";
}
$stmt2->close();
?>
        <tr>
            <th style="width: 20%;">Prepared by:</th>
            <td><?php echo htmlspecialchars($frontdesk_name); ?></td>
        </tr>
        <tr>
            <th style="width: 20%;">Payment Option:</th>
            <td><?php echo htmlspecialchars($interment1['PAYMENT_OPTION']); ?></td>
        </tr>
        <tr>
            <th style="width: 20%;">Total Price:</th>
            <td>₱ <?php echo htmlspecialchars($interment1['TOTAL_PRICE']); ?></td>
        </tr>
    </table>
    <div class="totalprice">
<Label>TOTAL PRICE : </Label><span>₱ <?php echo htmlspecialchars($interment1['TOTAL_PRICE']); ?></span><br>
</div>
</div>
<div class="proofpayment">
    <img src="pictures/proofofpayment.png" alt="">
    <form action="submit_tor_proofofpayment.php?account_id=<?php echo $account_id?>" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <th><label for="payment_number">For Payment Number:</label></th>
                <td><input type="text" id="payment_number" name="payment_number" value="<?php echo htmlspecialchars($interment_id); ?>" readonly></td>
            </tr>
            <tr>
                <th><label for="interment_order">Transfer of Right ID:</label></th>
                <td>
                    <input type="text" id="interment_order" name="interment_order" value="<?php echo htmlspecialchars($interment1['ID']); ?>" readonly>
                </td>
            </tr>
            <tr>
                <th><label for="prepared_by">Prepared by:</label></th>
                <td><input type="text" id="prepared_by" name="prepared_by" value="<?php echo htmlspecialchars($frontdesk_name); ?>" readonly></td>
            </tr>
            <tr>
                <th><label for="proof_image">Upload Proof of Payment:</label></th>
                <td><input type="file" id="proof_image" name="proof_image" accept="image/*" required></td>
            </tr>
            <tr>
                <th><label for="reference_number">Reference Number:</label></th>
                <td><input type="text" id="reference_number" name="reference_number" placeholder="Enter the Reference Number here..." required></td>
            </tr>
        </table>
        <button type="submit" class="btnLogin-popup">Submit</button>
    </form>
</div>
</div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.3/apexcharts.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
</body>
</html>
