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
include 'dbconnection.php'; // Include your database connection file
// Retrieve parameters from the URL
$interment_id = $_GET['interment_id'];
$account_id = $_GET['account_id'];
$dateinterment = $_GET['dateinterment'];
$dayinterment = $_GET['dayinweek'];
$timeinterment = $_GET['timeinterment'];
$status = 'reschedule payment'; // Status to be updated
// Start transaction
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
    $mail->Body .= "<p style='color: black;'><strong>Your Transfer of Ownership has been scheduled successfully.</strong></p><br>";
    $mail->Body .= "<p style='color: black;'>We look forward to welcoming you at <strong>Providence Memorial Park Antipolo on $TORDAY, $TORDATE at $TORTIME </strong> for the transfer of rights for Lot <strong>$TORLOTDES to $TRANSFEREENAME.</strong>";
    $mail->Body .= "Please ensure to <strong>bring all the required documents and arrive on time</strong> to complete the process smoothly. Should you have any questions, feel free to contact our office. We appreciate your trust in Providence Memorial Park Antipolo.</p><br>";
    $mail->Body .= "<p style='color: black;'><strong>Requirements to Bring on the Date of Transfer:</strong></p><br>";
    $mail->Body .= "<p style='color: black;'><strong>TRANSFEROR/LOT OWNER</strong></p>";
    $mail->Body .= "<p style='color: black;'>1. VALID ID WITH CLEAR SIGNATURE</p>";
    $mail->Body .= "<p style='color: black;'>- 3 COPIES WITH 3 SPECIMEN SIGNATURE</p><br>";
    $mail->Body .= "<p style='color: black;'>- IF MARRIED, NEED VALID ID OF SPOUSE</p>";
    $mail->Body .= "<p style='color: black;'>- 3 COPIES WITH 3 SPECIMEN SIGNATURE</p>";
    $mail->Body .= "<p style='color: black;'>- MARRIAGE CONTRACT (PHOTO COPY)</p><br>";
    $mail->Body .= "<p style='color: black;'>- IF SINGLE, NEED BIRTH CERTIFICATE (PHOTO COPY)</p>";
    $mail->Body .= "<p style='color: black;'>- IF WIDOW, NEED CERTIFIED TRUE COPY OF DEATH CERTIFICATE</p>";
    $mail->Body .= "<p style='color: black;'>- IF LOT OWNER DECEASED, NEED CERTIFIED TRUE COPY OF DEATH CERTIFICATE</p><br>";
    $mail->Body .= "<p style='color: black;'>3. NOTARIZED DEED OF TRANSFER OF RIGHTS</p>";
    $mail->Body .= "<p style='color: black;'>4. NOTARIZED JOINT AFFIDAVIT OF CONFORMITY</p>";
    $mail->Body .= "<p style='color: black;'>5. SURRENDER ORIGINAL CERTIFICATE OF OWNERSHIP OR TITLE</p><br>";
    $mail->Body .= "<p style='color: black;'><strong>TRANSFEREE</strong></p><br>";
    $mail->Body .= "<p style='color: black;'>1. VALID ID WITH CLEAR SIGNATURE</p>";
    $mail->Body .= "<p style='color: black;'>- 3 COPIES WITH 3 SPECIMEN SIGNATURE</p>";
    $mail->Body .= "<p style='color: black;'>- IF MARRIED, NEED VALID ID OF SPOUSE</p>";
    $mail->Body .= "<p style='color: black;'>- 3 COPIES WITH 3 SPECIMEN SIGNATURE</p>";
    $mail->Body .= "<p style='color: black;'>- MARRIAGE CONTRACT (PHOTO COPY)</p>";
    $mail->Body .= "<p style='color: black;'>- IF SINGLE, NEED BIRTH CERTIFICATE (PHOTO COPY)</p>";
    $mail->Body .= "<p style='color: black;'>- IF WIDOW, NEED CERTIFIED TRUE COPY OF DEATH CERTIFICATE</p>";
    $mail->Body .= "<p style='color: black;'>- IF LOT OWNER DECEASED, NEED CERTIFIED TRUE COPY OF DEATH CERTIFICATE</p>";
    $mail->send();
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
    text: "Dear $accountName, your Transfer of Right has been rescheduled to $dateinterment at $timeinterment .",
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
try {
    // Prepare the SQL query for the transfer_of_rights table
    $sql1 = "UPDATE transfer_of_rights
            SET
                DATE_OF_TRANSFER='$dateinterment',
                DAY_OF_TRANSFER='$dayinterment',
                TIME_OF_TRANSFER='$timeinterment',
                STATUS='$status'
            WHERE ID='$interment_id'";
    // Execute the first query
    if ($conn->query($sql1) !== TRUE) {
        throw new Exception("Error updating transfer_of_rights: " . $conn->error);
    }
    // Prepare the SQL query for the tor_proof_of_payments table
    $sql2 = "UPDATE tor_proof_of_payments
            SET
                STATUS='$status'
            WHERE TOR_ID='$interment_id'";
    // Execute the second query
    if ($conn->query($sql2) !== TRUE) {
        throw new Exception("Error updating tor_proof_of_payments: " . $conn->error);
    }
    // Prepare the SQL query for the payment_tor table
    $sql3 = "UPDATE payment_tor
            SET
                STATUS='$status'
            WHERE TOR_ID='$interment_id'";
    // Execute the third query
    if ($conn->query($sql3) !== TRUE) {
        throw new Exception("Error updating payment_tor: " . $conn->error);
    }
    // If all updates are successful, commit the transaction
    $conn->commit();
    // Set a success message
    $message = "Transfer of Rights and payment has been Rescheduled successfully.";
    // Redirect back to the calendar with the success message
    header("Location: frontdesk_calendar.php?Id=" . urlencode($account_id) . "&success=" . urlencode($message));
    exit(); // Always call exit after a header redirect to stop further script execution
} catch (Exception $e) {
    // Rollback the transaction in case of an error
    $conn->rollback();
    // Set the error message
    $error_message = "An error occurred: " . $e->getMessage();
    // Redirect back to the calendar with the error message
    header("Location: frontdesk_calendar.php?Id=" . urlencode($account_id) . "&error=" . urlencode($error_message));
    exit(); // Ensure the script stops after redirect
}
$conn->close();
?>
