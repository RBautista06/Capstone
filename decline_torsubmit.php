<?php
include "dbconnection.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve INTERMENTFORM_ID from URL
    $intermentId = isset($_GET['Id']) ? intval($_GET['Id']) : 0;
    // Fetch CUSTOMER_ID for the given INTERMENTFORM_ID
    $customerIdQuery = "SELECT CUSTOMER_ID FROM transfer_of_rights WHERE ID = '$intermentId'";
    $customerIdResult = $conn->query($customerIdQuery);
    if ($customerIdResult->num_rows > 0) {
        $row = $customerIdResult->fetch_assoc();
        $customerId = $row['CUSTOMER_ID'];
        // Now proceed with the form processing
        $transferorFirstName = isset($_POST['transferorfirstname']) ? htmlspecialchars($_POST['transferorfirstname']) : '';
        $transferorMiddleName = isset($_POST['transferormiddlename']) ? htmlspecialchars($_POST['transferormiddlename']) : '';
        $transferorLastName = isset($_POST['transferorlastname']) ? htmlspecialchars($_POST['transferorlastname']) : '';
        $spouseFirstName = isset($_POST['spouseFirstname']) ? htmlspecialchars($_POST['spouseFirstname']) : '';
        $spouseMiddleName = isset($_POST['spouseMiddlename']) ? htmlspecialchars($_POST['spouseMiddlename']) : '';
        $spouseLastName = isset($_POST['spouseLastname']) ? htmlspecialchars($_POST['spouseLastname']) : '';
        $transfereeFirstName = isset($_POST['transfereefirstname']) ? htmlspecialchars($_POST['transfereefirstname']) : '';
        $transfereeMiddleName = isset($_POST['transfereemiddlename']) ? htmlspecialchars($_POST['transfereemiddlename']) : '';
        $transfereeLastName = isset($_POST['transfereelastname']) ? htmlspecialchars($_POST['transfereelastname']) : '';
        $spouseFirstNameTransferee = isset($_POST['spouseFirstname-transferee']) ? htmlspecialchars($_POST['spouseFirstname-transferee']) : '';
        $spouseMiddleNameTransferee = isset($_POST['spouseMiddlename-transferee']) ? htmlspecialchars($_POST['spouseMiddlename-transferee']) : '';
        $spouseLastNameTransferee = isset($_POST['spouseLastname-transferee']) ? htmlspecialchars($_POST['spouseLastname-transferee']) : '';
        $status = 'request';
        $transferorFullName = $transferorFirstName . ' ' . $transferorMiddleName . ' ' . $transferorLastName;
        $transferorAddress = isset($_POST['transferor_address']) ? htmlspecialchars($_POST['transferor_address']) : '';
        $transferorspouseFullName = $spouseFirstName . ' ' . $spouseMiddleName . ' ' . $spouseLastName;
        $transferorStatus = isset($_POST['statusType']) ? htmlspecialchars($_POST['statusType']) : '';
        $contractPrice = isset($_POST['contractPrices']) ? htmlspecialchars($_POST['contractPrices']) : '';
        $lotdescription = isset($_POST['lot_description_2']) ? htmlspecialchars($_POST['lot_description_2']) : '';
        $location = isset($_POST['location']) ? htmlspecialchars($_POST['location']) : '';
        $typeoflot = isset($_POST['typeoflot']) ? htmlspecialchars($_POST['typeoflot']) : '';
        $datetransfer = isset($_POST['dateinterment']) ? htmlspecialchars($_POST['dateinterment']) : '';
        $daytransfer = isset($_POST['dayinterment']) ? htmlspecialchars($_POST['dayinterment']) : '';
        $timetransfer = isset($_POST['timeinterment']) ? htmlspecialchars($_POST['timeinterment']) : '';
        $paymentOption = isset($_POST['paymentOption']) ? htmlspecialchars($_POST['paymentOption']) : '';
        $transferFee = isset($_POST['transferFee']) ? htmlspecialchars($_POST['transferFee']) : '';
        $notarialFee = isset($_POST['notarialFee']) ? htmlspecialchars($_POST['notarialFee']) : '';
        $totalPrice = isset($_POST['totalprice']) ? htmlspecialchars($_POST['totalprice']) : '';
        $transfereeFullName = $transfereeFirstName . ' ' . $transfereeMiddleName . ' ' . $transfereeLastName;
        $transfereeAddress = isset($_POST['transfereeaddress']) ? htmlspecialchars($_POST['transfereeaddress']) : '';
        $transfereespouseFullName = $spouseFirstNameTransferee . ' ' . $spouseMiddleNameTransferee . ' ' . $spouseLastNameTransferee;
        $transfereeStatus = isset($_POST['statusTypeTransferee']) ? htmlspecialchars($_POST['statusTypeTransferee']) : '';
        // Update query
        $query = "
        UPDATE transfer_of_rights
        SET
            CUSTOMER_ID = '$customerId',
            STATUS = '$status',
            TRANSFEROR_NAME = '$transferorFullName',
            TRANSFEROR_STATUS = '$transferorStatus',
            TRANSFEROR_SPOUSE = '$transferorspouseFullName',
            TRANSFEROR_ADDRESS = '$transferorAddress',
            TRANSFEREE_NAME = '$transfereeFullName',
            TRANSFEREE_STATUS = '$transfereeStatus',
            TRANSFEREE_SPOUSE = '$transfereespouseFullName',
            TRANSFEREE_ADDRESS = '$transfereeAddress',
            LOCATION_ID = '$location',
            LOT_DESCRIPTION = '$lotdescription',
            TYPE_OF_LOT = '$typeoflot',
            CONTRACT_PRICE = '$contractPrice',
            DATE_OF_TRANSFER = '$datetransfer',
            DAY_OF_TRANSFER = '$daytransfer',
            TIME_OF_TRANSFER = '$timetransfer',
            PAYMENT_OPTION = '$paymentOption',
            TOTAL_PRICE = '$totalPrice'
        WHERE ID = '$intermentId'
        ";
        // Execute the update query
        if ($conn->query($query) === TRUE) {
            echo '<script>
                alert("Transfer of Right Request Updated and Submitted Successfully!");
                window.location.href="customer_declinedinterment.php?Id=' . $customerId . '";
            </script>';
        } else {
            echo "Error: " . $query . "<br>" . $conn->error;
        }
    } else {
        echo '<script>
            alert("Record not found for the given INTERMENTFORM_ID!");
            window.location.href="customer_declinedinterment.php?Id=' . $intermentId . '";
        </script>';
    }
} else {
    echo '<script>
        alert("Invalid request!");
        window.location.href="customer_declinedinterment.php?Id=' . $intermentId . '";
    </script>';
}
$conn->close();
?>
