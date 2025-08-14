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
$lastname = trim($_POST['lastname']);
$firstname = trim($_POST['firstname']);
$middlename = trim($_POST['middlename']);
$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
$contact = trim($_POST['contact']); // Store original contact number
$address = trim($_POST['address']);
$password = trim($_POST['password']);
$position = 'Lot Owner'; // Static value for the position
$lottype = trim($_POST['lottype']);
$lotOwnedContainer = array_filter($_POST, function($key) {
    return strpos($key, 'LOT') === 0;
}, ARRAY_FILTER_USE_KEY);
$name = $firstname . ' ' . $middlename . ' ' . $lastname;

// Function to format phone number for SMS
function formatPhoneNumberForSms($number) {
    // Remove non-numeric characters
    $number = preg_replace('/\D/', '', $number);

    // Check if the number starts with 0, if so, replace it with the country code
    if (strpos($number, '0') === 0) {
        $number = '+63' . substr($number, 1);
    } else if (strpos($number, '+') !== 0) {
        $number = '+63' . $number;
    } else {
        // Assume it's already in international format
        $number = '+63' . $number;
    }

    return $number;
}

// Format the contact number for SMS
$formattedContact = formatPhoneNumberForSms($contact);

// Start a transaction
$conn->begin_transaction();

try {
    // Check if email already exists
    $stmt = $conn->prepare("SELECT COUNT(*) FROM tbl_accounts WHERE EMAIL = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->bind_result($email_count);
    $stmt->fetch();
    $stmt->close();

    if ($email_count > 0) {
        // If email already exists, redirect with alert
        ?>
        <script>
            alert("Email already taken, please Enter Another Email");
            window.location.href = "createowner.php";
        </script>
        <?php
        exit();
    }

    // Insert into tbl_accounts
    $stmt1 = $conn->prepare("INSERT INTO tbl_accounts (NAME, LASTNAME, FIRSTNAME, MIDDLENAME, EMAIL, CONTACT, ADDRESS, PASSWORD, POSITION) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt1->bind_param('sssssssss', $name, $lastname, $firstname, $middlename, $email, $contact, $address, $password, $position);
    if (!$stmt1->execute()) {
        throw new Exception("Error inserting into tbl_accounts: " . $stmt1->error);
    }

    // Prepare SQL statement with dynamic columns for lot numbers
    $lotColumns = '';
    $lotValues = [];
    $maxLots = 1; // Default to 1 for lawnlot

    switch ($lottype) {
        case 'court4':
            $maxLots = 4;
            break;
        case 'court8':
            $maxLots = 8;
            break;
        case 'estate12':
            $maxLots = 12;
            break;
        case 'estate24':
            $maxLots = 24;
            break;
    }

    for ($i = 1; $i <= $maxLots; $i++) {
        $lotColumns .= ", LOT{$i}";
        $lotValues[] = $_POST["LOT{$i}"] ?? ''; // Use the lot input or an empty string
    }

    // Insert into tbl_owners
    $sql2 = "INSERT INTO owners (EMAIL, TYPE_OF_LOT $lotColumns) VALUES (?, ?" . str_repeat(', ?', $maxLots) . ")";
    $stmt2 = $conn->prepare($sql2);
    if ($stmt2 === false) {
        throw new Exception("Error preparing statement: " . $conn->error);
    }

    $params = array_merge([$email, $lottype], $lotValues);
    $types = str_repeat('s', count($params));
    $stmt2->bind_param($types, ...$params);
    if (!$stmt2->execute()) {
        throw new Exception("Error inserting into tbl_owners: " . $stmt2->error);
    }

    // Commit the transaction
    $conn->commit();

    // Send email notification
    $mail = new PHPMailer(true);

    try {
        //Server settings
    include "emailapi.php";

        //Recipients
        $mail->setFrom('railleynickoleivincebautista@gmail.com', 'PROVIDENCE MEMORIAL PARK ANTIPOLO');
        $mail->addAddress($email, $name); // Add the recipient

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'Account Creation';
        $mail->Body    = "<h1>Welcome, $name!</h1><p>Your account has been successfully created as a Lot Owner.</p>";
        $mail->AltBody = "Welcome, $name! Your account has been successfully created as a Lot Owner.";

        $mail->send();
        echo 'Email has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

    // Send SMS notification using Infobip

    $infobipApiKey = '13fce986d02941b1fc14b173e8dd4057-ae763aac-195b-4c72-bdda-aaae4e53da97';
    $infobipUrl = 'https://3852ym.api.infobip.com'; // Infobip API base URL
    $infobipSmsEndpoint = '/sms/2/text/advanced'; // Endpoint for sending SMS

    $configuration = new Configuration(
        host: $infobipUrl,
        apiKey: $infobipApiKey
    );
    $api = new SmsApi(config: $configuration);

    $destination = new SmsDestination(to: $formattedContact); // Use formatted contact

    $theMessage = new SmsTextualMessage(
        destinations: [$destination],
        text: "Dear $name, your account as a Lot Owner has been successfully created at Providence Memorial Park.",
        from: "ProvidencePark"
    );

    $request = new SmsAdvancedTextualRequest(
        messages: [$theMessage]
    );

    try {
        $response = $api->sendSmsMessage($request, $infobipSmsEndpoint); // Pass endpoint here
        echo 'SMS has been sent successfully.';
    } catch (Exception $e) {
        echo 'Failed to send SMS. Error: ' . $e->getMessage();
    }

    // Redirect back to createowner.php and display alert
    echo '<script>alert("Successfully Created a Lot Owner Account"); window.location.href = "createowner.php";</script>';
    exit; // Exit to prevent any further code execution
} catch (Exception $e) {
    // Rollback the transaction if there was an error
    $conn->rollback();
    echo "Failed to create new owner: " . $e->getMessage();
}

// Close connections
$stmt1->close();
$stmt2->close();
$conn->close();
?>
