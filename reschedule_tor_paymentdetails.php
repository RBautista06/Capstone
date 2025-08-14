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
<!-- <model-viewer id="myModelViewer" src="3dmodels/statsprovidence.gltf" alt="A 3D model of a walking character" 
    shadow-intensity="3" ar animation-name="animation_name" autoplay="speed: 0.5" 
    class="stats3dlogo" camera-orbit="120deg 83deg 10m">
</model-viewer> -->
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
    <h1><img src="pictures/rescheduleToRpayment.png" alt=""></h1>

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
    <br>



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
            <th style="width: 20%;">Transfer of Right ID:</th>
            <td><?php echo htmlspecialchars($interment1['TOR_ID']); ?></td>
        </tr>
        <tr>
            <th style="width: 20%;">Reference Number:</th>
            <td><?php echo htmlspecialchars($interment1['RESCHEDULE_REFERENCE']); ?> </td>
        </tr>
        <tr>
            <th style="width: 20%;">Total Price to be Paid:</th>
            <?php 
    $reschedule_fee_query = "SELECT PRICE FROM interment_price WHERE NAME = 'reschedule fee'";
    $reschedule_fee_result = $conn->query($reschedule_fee_query);
    
    // Check if the query was successful and fetch the price
    if ($reschedule_fee_result && $reschedule_fee_result->num_rows > 0) {
        $reschedule_fee_row = $reschedule_fee_result->fetch_assoc();
        $reschedule_fee = $reschedule_fee_row['PRICE'];
    } else {
        $reschedule_fee = 500; // Fallback value in case of error or no result
    }
            ?>
            <td>₱ <?php echo number_format($reschedule_fee, 2); ?></span><br>
        </tr>
    </table>

</div>

<div class="proofpicture">
<img src="pictures/proofofpayment.png" alt="">
 <div class="piccontainer">
    <img src="<?php echo htmlspecialchars($interment1['RESCHEDULE_FILE']); ?>" alt=""></img>
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

<!-- Modal for Decline -->
<div id="declineModal" class="modaldecline" style="display: none;">
    <div class="modaldecline-content">
        <span class="close1">&times;</span>
        <br>
        <form id="declineForm">
            <label for="reason">Enter Reason:</label>
            <textarea id="reason" name="reason" rows="6" required></textarea>
            <input type="hidden" id="intermentId" name="intermentid" value="<?php echo $intermentid; ?>">
            <input type="hidden" id="accountId" name="account_id" value="<?php echo $account_id; ?>">
            <input type="hidden" id="frontdeskname" name="frontdeskname" value="<?php echo htmlspecialchars($interment1['PREPARED_BY']); ?>">
            <button type="button" id="submitDecline">Submit</button>
        </form>
    </div>
</div>

<script>
    // Approve button functionality
    document.getElementById("approveBtn").addEventListener("click", function(event) {
        event.preventDefault();
        sendData('approve');
    });

    // Decline button functionality
    document.getElementById("declineBtn").addEventListener("click", function(event) {
        event.preventDefault();
        showModal();
    });

    // Function to show the decline modal
    function showModal() {
        var modal = document.getElementById("declineModal");
        modal.style.display = "block";
    }

    // Close the modal when clicking the 'x' button
    document.querySelector(".close1").addEventListener("click", function() {
        document.getElementById("declineModal").style.display = "none";
    });

    // Handle decline form submission
    document.getElementById("submitDecline").addEventListener("click", function(event) {
        event.preventDefault();

        var reason = document.getElementById("reason").value;
        var intermentId = document.getElementById("intermentId").value;
        var accountId = document.getElementById("accountId").value;
        var frontdeskname = document.getElementById("frontdeskname").value;

        if (reason.trim() === "") {
            alert("Please enter a reason.");
            return;
        }

        // Construct URL for decline action
        var url = "reschedule_TOR_declineprocess.php?action=decline" +
                  "&intermentid=" + encodeURIComponent(intermentId) +
                  "&account_id=" + encodeURIComponent(accountId) +
                  "&frontdeskname=" + encodeURIComponent(frontdeskname) +
                  "&reason=" + encodeURIComponent(reason);

        // Redirect to the constructed URL
        window.location.href = url;
    });

    // Function to send data for approve (this redirects immediately)
    function sendData(action) {
        var intermentId = "<?php echo $intermentid; ?>";
        var accountId = "<?php echo $account_id; ?>";
        var frontdeskname = "<?php echo htmlspecialchars($interment1['PREPARED_BY']); ?>";

        var url = "reschedule_TOR_pdfupdate.php?action=" + encodeURIComponent(action) +
                  "&intermentid=" + encodeURIComponent(intermentId) +
                  "&account_id=" + encodeURIComponent(accountId) +
                  "&frontdeskname=" + encodeURIComponent(frontdeskname);

        // Redirect to the constructed URL
        window.location.href = url;
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