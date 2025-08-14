<?php
require 'vendor/autoload.php'; // For Infobip SMS API
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Infobip\Configuration;
use Infobip\Api\SmsApi;
use Infobip\Model\SmsDestination;
use Infobip\Model\SmsTextualMessage;
use Infobip\Model\SmsAdvancedTextualRequest;
include 'dbconnection.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $interment_id = isset($_POST['interment_id']) ? intval($_POST['interment_id']) : 0;
    if ($interment_id > 0) {
        // Start a transaction to ensure all queries succeed together
        $conn->begin_transaction();
        try {
            // Step 1: Select the CUSTOMER_ID and LOCATION_ID from the transfer_of_rights table
            $query1 = "SELECT CUSTOMER_ID, LOCATION_ID FROM transfer_of_rights WHERE ID = ?";
            $stmt1 = $conn->prepare($query1);
            $stmt1->bind_param('i', $interment_id);
            $stmt1->execute();
            $stmt1->bind_result($customer_id, $location_id);
            $stmt1->fetch();
            $stmt1->close();
            if ($customer_id && $location_id) {
                // Step 2: Update the STATUS to "Mark as Done" in the transfer_of_rights table
                $query2 = "UPDATE transfer_of_rights SET STATUS = 'Mark as Done' WHERE ID = ?";
                $stmt2 = $conn->prepare($query2);
                $stmt2->bind_param('i', $interment_id);
                $stmt2->execute();
                // Step 3: Update the POSITION to "Previous Lot Owner" in tbl_accounts where ACCOUNT_ID is equal to the customer_id
                $query3 = "UPDATE tbl_accounts SET POSITION = 'Previous Lot Owner' WHERE ACCOUNT_ID = ?";
                $stmt3 = $conn->prepare($query3);
                $stmt3->bind_param('i', $customer_id);
                $stmt3->execute();
                // Step 4: Select the row from the owners table where IO_ID is equal to $location_id
                $query4 = "SELECT IO_ID FROM owners WHERE IO_ID = ?";
                $stmt4 = $conn->prepare($query4);
                $stmt4->bind_param('i', $location_id);
                $stmt4->execute();
                $stmt4->bind_result($io_id);
                $stmt4->fetch();
                $stmt4->close();
                if ($io_id) {
                    // Step 5: Update the EMAIL column to 'None' where IO_ID matches the $location_id
                    $query5 = "UPDATE owners SET EMAIL = '' WHERE IO_ID = ?";
                    $stmt5 = $conn->prepare($query5);
                    $stmt5->bind_param('i', $location_id);
                    $stmt5->execute();
                    // Check if all operations were successful
                    if ($stmt2->affected_rows > 0 && $stmt3->affected_rows > 0 && $stmt5->affected_rows > 0) {
                        $conn->commit(); // Commit the transaction if successful
                        ?>
                        <script>
                        alert("Transfer of Rights has been successfully marked as done, customer updated, and owner's email set to 'None'.");
                        window.history.back();
                        </script>
                        <?php
                    } else {
                        throw new Exception("Failed to update all records. Please try again.");
                    }
                    $stmt2->close();
                    $stmt3->close();
                    $stmt5->close();
                } else {
                    throw new Exception("IO_ID not found in owners table.");
                }
            } else {
                throw new Exception("Customer ID or Location ID not found.");
            }
        } catch (Exception $e) {
            $conn->rollback(); // Rollback the transaction on failure
            ?>
            <script>
            alert("<?php echo $e->getMessage(); ?>");
            window.history.back();
            </script>
            <?php
        }
    } else {
        echo "<p>Invalid ToR ID.</p>";
    }
$conn->begin_transaction();
$query10 = "SELECT CUSTOMER_ID, TOTAL_PRICE, DATE_OF_TRANSFER, DAY_OF_TRANSFER, TIME_OF_TRANSFER, LOT_DESCRIPTION, TRANSFEREE_NAME
            FROM transfer_of_rights WHERE ID = $interment_id";
$result = $conn->query($query10);
if ($result === false) {
    die("Error executing query: " . $conn->error);
}
if ($row = $result->fetch_assoc()) {
    $customerID = $row['CUSTOMER_ID'];
    $tortotalprice = $row['TOTAL_PRICE'];
    $TORDATE = $row['DATE_OF_TRANSFER'];
    $TORDAY = $row['DAY_OF_TRANSFER'];
    $TORTIME = $row['TIME_OF_TRANSFER'];
    $TORLOTDES = $row['LOT_DESCRIPTION'];
    $TRANSFEREENAME = $row['TRANSFEREE_NAME'];
}
$result->free();  // Free the result set
// Fetch account details
$query2 = "SELECT NAME, CONTACT, ADDRESS, EMAIL FROM tbl_accounts WHERE ACCOUNT_ID = ?";
$stmt2 = $conn->prepare($query2);
if ($stmt2 === false) {
    die("Error preparing statement: " . $conn->error);
}
$stmt2->bind_param("i", $customerID);
$stmt2->execute();
$stmt2->bind_result($accountName, $accountContact, $accountAddress, $accountEmail);
$stmt2->fetch();
$stmt2->close();
// Email notification
// Email notification
$mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'railleynickoleivincebautista@gmail.com'; // Your Gmail address
    $mail->Password   = 'zbcn thtx qsbs ldfv'; // Your Gmail password or app-specific password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;
    $mail->setFrom('railleynickoleivincebautista@gmail.com', 'PROVIDENCE MEMORIAL PARK ANTIPOLO');
    $mail->addAddress($accountEmail, $accountName); // Add the recipient
    $mail->isHTML(true);
    $mail->Subject = 'Transfer of Ownership has been Scheduled';
    // Start building the email body
    $mail->Body = "<h1>Dear $accountName,</h1><br>";
    $mail->Body .= "<p style='color: black;'><strong>Your Transfer of Ownership has been DONE successfully.</strong></p><br>";
    // Add more content to the body...
    $mail->send();
    echo 'Email has been sent successfully.';
} catch (Exception $e) {
    echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
// Format phone number for SMS
function formatPhoneNumberForSms($number) {
    $number = preg_replace('/\D/', '', $number);
    if (strpos($number, '0') === 0) {
        $number = '+63' . substr($number, 1);
    } else if (strpos($number, '+') !== 0) {
        $number = '+63' . $number;
    }
    return $number;
}
$formattedContact = formatPhoneNumberForSms($accountContact);
// SMS notification using Infobip
include "smsAPIKEY.php";
$configuration = new Configuration(
    host: $infobipUrl,
    apiKey: $infobipApiKey
);
$api = new SmsApi(config: $configuration);
$destination = new SmsDestination(to: $formattedContact);
$theMessage = new SmsTextualMessage(
    destinations: [$destination],
    text: "Dear $accountName, your Transfer of Right has been successfully done.",
    from: "ProvidencePark"
);
$request = new SmsAdvancedTextualRequest(
    messages: [$theMessage]
);
try {
    $response = $api->sendSmsMessage($request, $infobipSmsEndpoint);
    echo 'SMS has been sent successfully.';
} catch (Exception $e) {
    echo 'Failed to send SMS. Error: ' . $e->getMessage();
}
    $conn->close(); // Close the database connection
}
?>
