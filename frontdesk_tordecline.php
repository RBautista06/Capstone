<?php

use Infobip\Configuration;
use Infobip\Api\SmsApi;
use Infobip\Model\SmsDestination;
use Infobip\Model\SmsTextualMessage;
use Infobip\Model\SmsAdvancedTextualRequest;
require 'vendor/autoload.php';
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include "dbconnection.php";

// Sanitize and validate input
$intermentId = $_POST['intermentId'];
$reason = $_POST['reason'];
$action = $_POST['action'];

// Update the status in the database
if ($action === 'decline') {
    $intermentId = $conn->real_escape_string($intermentId);

    $query = "UPDATE transfer_of_rights SET STATUS = 'Declined' WHERE ID = $intermentId";
    
    if ($conn->query($query) === FALSE) {
        echo "Error updating status: " . $conn->error;
        exit();
    }
}

// Fetch the ACCOUNT_ID from interment_forms using INTERMENTFORM_ID
$query = "SELECT CUSTOMER_ID FROM transfer_of_rights WHERE ID = $intermentId";
$result = $conn->query($query);

if ($result === FALSE) {
    echo "Error fetching account ID: " . $conn->error;
    exit();
}

$row = $result->fetch_assoc();
$accountId = $row['CUSTOMER_ID'];

// Fetch account details based on ACCOUNT_ID
$query = "SELECT EMAIL, CONTACT, FIRSTNAME, MIDDLENAME, LASTNAME FROM tbl_accounts WHERE ACCOUNT_ID = $accountId";
$result = $conn->query($query);

if ($result === FALSE) {
    echo "Error fetching account details: " . $conn->error;
    exit();
}

$row = $result->fetch_assoc();
$email = $row['EMAIL'];
$contact = $row['CONTACT'];
$firstname = $row['FIRSTNAME'];
$middlename = $row['MIDDLENAME'];
$lastname = $row['LASTNAME'];

// Combine names for notification
$name = $firstname . ' ' . $middlename . ' ' . $lastname;

// Format phone number for SMS
function formatPhoneNumberForSms($number) {
    $number = preg_replace('/\D/', '', $number);
    if (strpos($number, '0') === 0) {
        $number = '+63' . substr($number, 1);
    } else if (strpos($number, '+') !== 0) {
        $number = '+63' . $number;
    } else {
        $number = '+63' . $number;
    }
    return $number;
}

$formattedContact = formatPhoneNumberForSms($contact);

// Prepare and send email notification
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
    $mail->addAddress($email, $name); // Add the recipient

    $mail->isHTML(true);
    $mail->Subject = 'Transfer of Right Declined';
    $mail->Body    = "<h1>Dear $name,</h1><p>Your TRANSFER OF RIGHT request has been declined. Reason: $reason</p>";
    $mail->AltBody = "Dear $name, Your interment request has been declined. Reason: $reason";

    $mail->send();
    echo 'Email has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

// Send SMS notification using Infobip
include "smsAPIKEY.php";

$configuration = new Configuration(
    host: $infobipUrl,
    apiKey: $infobipApiKey
);
$api = new SmsApi(config: $configuration);

$destination = new SmsDestination(to: $formattedContact);
$theMessage = new SmsTextualMessage(
    destinations: [$destination],
    text: "Dear $name, your TRANSFER OF RIGHT request has been declined. Reason: $reason",
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

// Redirect back to the previous page with a success message
echo "<script>alert('Transfer of Right Request has been successfully declined.'); window.location.href = document.referrer;</script>";
exit;

?>
