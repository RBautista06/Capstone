<!DOCTYPE html>
<html>
<head>
    <title>Interment Form</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link rel="stylesheet" href="proofofpaymentdetails.css">
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
$account_id = isset($_GET['account_id']) ? intval($_GET['account_id']) : 0;
$proofId = isset($_GET['id']) ? intval($_GET['id']) : 0;
$intermentid = isset($_GET['intermentid']) ? intval($_GET['intermentid']) : 0;
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
 include "frondeskaside_accountid.php";
 ?>
    <div class="internmentform">
    <h1><img src="pictures/payments.png" alt=""></h1>
<div class="detailstable">
<script>
        document.addEventListener('DOMContentLoaded', function() {
            const backButton = document.getElementById('backButton');
            backButton.addEventListener('click', function() {
                window.location.href = 'frontdeskpayment.php?Id=<?php echo urlencode($_GET['account_id']); ?>';
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
$query1 = "SELECT * FROM tor_proof_of_payments WHERE TOR_ID = ?";
$stmt1 = $conn->prepare($query1);
if (!$stmt1) {
    echo "Error preparing statement: " . $conn->error;
    exit;
}
$stmt1->bind_param("i", $intermentid );
$stmt1->execute();
$result1 = $stmt1->get_result();
if ($result1->num_rows > 0) {
    $interment1 = $result1->fetch_assoc();
} else {
    echo "Interment form not found.";
    exit;
}
$stmt1->close();
?>
<div class="details">
<div class="paymentcontainer">
<div class="payments">
    <img src="pictures/paymentdetails.png" alt="">
    <!-- <br>
    <label for="">
        View Transfer of Right Order:
        <button type="button" onclick="location.href='proofofpayment_intermentform.php?Id=<?php echo htmlspecialchars($intermentid); ?>&account_id=<?php echo $account_id; ?>'">
    <ion-icon name="document-attach-outline"></ion-icon>
</button>
    </label>
    <br> -->
    <?php
    $query2 = "SELECT * FROM transfer_of_rights WHERE ID = ?";
    $stmt2 = $conn->prepare($query2);
    if (!$stmt2) {
        echo "Error preparing statement: " . $conn->error;
        exit;
    }
    $stmt2->bind_param("i", $intermentid);
    $stmt2->execute();
    $result2 = $stmt2->get_result();
    if ($result2->num_rows > 0) {
        $fetch = $result2->fetch_assoc();
    } else {
        echo "Interment order not found.";
        exit;
    }
    $stmt2->close();
    ?>
    <table>
        <tr>
            <th style="width: 20%;">Prepared by:</th>
            <td><?php echo htmlspecialchars($interment1['PREPARED_BY']); ?></td>
        </tr>
        <tr>
            <th style="width: 20%;">Payment Number:</th>
            <td><?php echo htmlspecialchars($interment1['PAYMENT_NUMBER']); ?></td>
        </tr>
        <tr>
            <th style="width: 20%;">Interment Order Number:</th>
            <td><?php echo htmlspecialchars($interment1['TOR_ID']); ?></td>
        </tr>
        <tr>
            <th style="width: 20%;">Reference Number:</th>
            <td><?php echo htmlspecialchars($interment1['REFERENCE_NUMBER']); ?> </td>
        </tr>
        <tr>
            <th style="width: 20%;">Total Price to be Paid:</th>
            <td>₱ <?php echo htmlspecialchars($fetch['TOTAL_PRICE']); ?></span><br>
        </tr>
    </table>
</div>
<div class="proofpicture">
<img src="pictures/proofofpayment.png" alt="">
 <div class="piccontainer">
    <img src="<?php echo htmlspecialchars($interment1['FILE_PATH']); ?>" alt=""></img>
 </div>
</div>
</div>
<div class="actionhere">
    <div class="buttons">
        <button id="approveBtn">
            <a href="#">
                <span class='text'>Approve</span>
            </a>
        </button>
        <button id="declineBtn">
            <a href="#">
                <span class='text'>Decline</span>
            </a>
        </button>
    </div>
</div>
<div id="declineModal" class="modaldecline">
    <div class="modaldecline-content">
        <span class="close1">&times;</span>
        <br>
        <form id="declineForm">
            <label for="reason">Enter Reason:</label>
            <textarea id="reason" name="reason" rows="6" required></textarea>
            <button type="button" id="submitDecline">Submit</button>
        </form>
    </div>
</div>
<script>
    // Open the modal for entering decline reason
    document.getElementById("declineBtn").addEventListener("click", function(event) {
        event.preventDefault();
        openDeclineModal();
    });
    // Close the modal when the close button is clicked
    document.querySelector('.modaldecline .close1').addEventListener('click', function() {
        var modaldecline = document.getElementById("declineModal");
        modaldecline.style.display = "none";
    });
    // Close the modal when clicking outside of the modal content
    window.addEventListener('click', function(event) {
        var modaldecline = document.getElementById("declineModal");
        if (event.target == modaldecline) {
            modaldecline.style.display = "none";
        }
    });
    document.getElementById("approveBtn").addEventListener("click", function(event) {
        event.preventDefault();
        sendData('approve', 'tor_paymentapprove.php');
    });
    document.getElementById("submitDecline").addEventListener("click", function() {
        var reason = document.getElementById("reason").value;
        if (reason.trim() === "") {
            alert("Please provide a reason.");
            return;
        }
        // Hide the modal
        document.getElementById("declineModal").style.display = "none";
        // Send data to update the database and redirect to paymentdecline.php
        sendData('decline', 'tor_paymentdecline.php', reason);
    });
    function openDeclineModal() {
        var modaldecline = document.getElementById("declineModal");
        modaldecline.style.display = "block";
    }
    function sendData(action, url, reason) {
        var intermentId = "<?php echo $intermentid; ?>";
        var accountId = "<?php echo $account_id; ?>";
        var frontdeskname = "<?php echo htmlspecialchars($interment1['PREPARED_BY']); ?>";
        // Construct the URL with query parameters
        var fullUrl = url + "?action=" + encodeURIComponent(action) +
                      "&intermentid=" + encodeURIComponent(intermentId) +
                      "&account_id=" + encodeURIComponent(accountId) +
                      "&frontdeskname=" + encodeURIComponent(frontdeskname) +
                      "&reason=" + encodeURIComponent(reason);
        // Redirect to the constructed URL
        window.location.href = fullUrl;
    }
</script>
</div>
</div>
</script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
</body>
</html>