<?php
include "dbconnection.php";
// Include PHPMailer and Infobip for sending email and SMS
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

// Retrieve frontdeskname and intermentid from GET parameters
$frontdeskname = isset($_GET['frontdeskname']) ? htmlspecialchars($_GET['frontdeskname']) : '';
$intermentid = isset($_GET['intermentid']) ? intval($_GET['intermentid']) : 0;
$accountId = isset($_GET['account_id']) ? $_GET['account_id'] : '';

// Load FPDF library

$query10 = "SELECT CUSTOMER_ID, TOTAL_PRICE, DATE_OF_TRANSFER, DAY_OF_TRANSFER, TIME_OF_TRANSFER, LOT_DESCRIPTION, TRANSFEREE_NAME 
            FROM transfer_of_rights WHERE ID = $intermentid";

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
    $mail->Password   = 'zbcn thtx qsbs ldfv';  // Your Gmail password or app-specific password
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
    text: "Dear $accountName, your Transfer of Right payment has been recieved and scheduled successfully.",
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


$query10 = "SELECT TOR_PDF from transfer_of_rights WHERE ID = ?";
$stmt10 = $conn->prepare($query10);
if ($stmt10 === false) {
    die("Error preparing statement: " . $conn->error);
}
$stmt10->bind_param("i", $intermentid);
$stmt10->execute();
$stmt10->bind_result($torpdffilepath);
$stmt10->fetch();
$stmt10->close();

$filePath = $torpdffilepath;



// Escape variables for safety
$accountNameEscaped = $conn->real_escape_string($accountName);
$frontdesknameEscaped = $conn->real_escape_string($frontdeskname);
$totalPriceEscaped = $tortotalprice;

// Insert transaction into the database
$queryInsertTransaction = "INSERT INTO tbl_transaction 
(INVOICE_FILE, ORDER_ID, ORDER_TYPE, CUSTOMER_NAME, CUSTOMER_ID, PREPARED_BY, PAYMENT_PRICE) 
VALUES ('$filePath', '$intermentid', 'Transfer of Right', '$accountNameEscaped', '$customerID', '$frontdesknameEscaped', '$totalPriceEscaped')";

if ($conn->query($queryInsertTransaction) === false) {
    die("Error executing query: " . $conn->error);
}

// Update interment form status
$queryUpdateStatus = "UPDATE transfer_of_rights SET STATUS = 'scheduled' WHERE ID = ?";
$stmtUpdateStatus = $conn->prepare($queryUpdateStatus);
if ($stmtUpdateStatus === false) {
    die("Error preparing statement: " . $conn->error);
}
$stmtUpdateStatus->bind_param("i", $intermentid);
$stmtUpdateStatus->execute();
$stmtUpdateStatus->close();

// Update proof of payment status
$queryUpdateProof = "UPDATE tor_proof_of_payments SET STATUS = 'completed' WHERE TOR_ID = ?";
$stmtUpdateProof = $conn->prepare($queryUpdateProof);
if ($stmtUpdateProof === false) {
    die("Error preparing statement: " . $conn->error);
}
$stmtUpdateProof->bind_param("i", $intermentid);
$stmtUpdateProof->execute();
$stmtUpdateProof->close();

$conn->close();
header("Location: frontdesk_tor_payment.php?Id=$accountId");
?>

