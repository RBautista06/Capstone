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
$contact = trim($_POST['contact']);
$address = trim($_POST['address']);
$password = trim($_POST['password']);
$targetlot = trim($_POST['location']);
$position = 'Lot Owner';
$id = trim($_POST['id']);
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
        echo '<script>alert("Email already taken, please Enter Another Email"); window.location.href = "createowner.php";</script>';
        exit();
    }

    $stmt1 = $conn->prepare("INSERT INTO tbl_accounts (NAME, LASTNAME, FIRSTNAME, MIDDLENAME, EMAIL, CONTACT, ADDRESS, PASSWORD, POSITION) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt1->bind_param('sssssssss', $name, $lastname, $firstname, $middlename, $email, $contact, $address, $password, $position);
    if (!$stmt1->execute()) {
        throw new Exception("Error inserting into tbl_accounts: " . $stmt1->error);
    }

    $stmt2 = $conn->prepare("UPDATE owners SET EMAIL = ? WHERE IO_ID = ?");
    $stmt2->bind_param('si', $email, $targetlot); // 's' for email (string), 'i' for targetlot (integer)
    if (!$stmt2->execute()) {
        throw new Exception("Error updating owners table: " . $stmt2->error);
    }

    

    $stmt3 = $conn->prepare("DELETE FROM request_tbl WHERE REQUEST_ID = ?");
    $stmt3->bind_param('s', $id); // Use the ID from the request
    if (!$stmt3->execute()) {
        throw new Exception("Error deleting from request_tbl: " . $stmt3->error);
    }

    // Confirm the deletion
    if ($stmt3->affected_rows > 0) {
        // Only output this if there was an actual deletion
        echo "Record from request_tbl successfully deleted.";
    } else {
        throw new Exception("No record was deleted from request_tbl. Please check the REQUEST_ID.");
    }

    // Commit the transaction
    $conn->commit();

    // Send email notification
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'railleynickoleivincebautista@gmail.com'; // Your Gmail address
        $mail->Password   = 'nuke fhwp wpbz rlak'; // Your Gmail password or app-specific password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        // Recipients
        $mail->setFrom('railleynickoleivincebautista@gmail.com', 'PROVIDENCE MEMORIAL PARK ANTIPOLO');
        $mail->addAddress($email, $name); // Add the recipient

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Account Creation';
        $mail->Body    = "<h1>Welcome, $name!</h1><p>Your account has been successfully created as a Lot Owner.</p>";
        $mail->AltBody = "Welcome, $name! Your account has been successfully created as a Lot Owner.";

        $mail->send();
        echo 'Email has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

    include "smsAPIKEY.php";

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
    echo '<script>alert("Successfully Created a Lot Owner Account and Deleted the Request Record"); window.location.href = "createowner.php";</script>';
    exit; // Exit to prevent any further code execution

} catch (Exception $e) {
    // Rollback the transaction if there was an error
    $conn->rollback();
    echo "Failed to create new owner: " . $e->getMessage();
}

// Close connections
if (isset($stmt1)) $stmt1->close();
if (isset($stmt2)) $stmt2->close();
if (isset($stmt3)) $stmt3->close(); // Close the delete statement
$conn->close();
?>
