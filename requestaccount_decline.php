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
$requestId = intval($_POST['request_id']);
$reason = trim($_POST['reason']);

// Retrieve user information based on request_id from request_tbl
$query = "SELECT EMAIL, CONTACT, NAME FROM request_tbl WHERE REQUEST_ID = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $requestId);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

if ($user) {
    $email = $user['EMAIL'];
    $contact = $user['CONTACT'];
    $name = $user['NAME'];

    // Function to format phone number for SMS
    function formatPhoneNumberForSms($number) {
        $number = preg_replace('/\D/', '', $number);
        if (strpos($number, '0') === 0) {
            $number = '+63' . substr($number, 1);
        } elseif (strpos($number, '+') !== 0) {
            $number = '+63' . $number;
        }
        return $number;
    }

    // Format the contact number for SMS
    $formattedContact = formatPhoneNumberForSms($contact);

    // Start a transaction
    $conn->begin_transaction();

    try {
        // Delete the record
        $deleteStmt = $conn->prepare("DELETE FROM request_tbl WHERE REQUEST_ID = ?");
        $deleteStmt->bind_param('i', $requestId);
        if (!$deleteStmt->execute()) {
            throw new Exception("Error deleting record: " . $deleteStmt->error);
        }
        $deleteStmt->close();

        // Commit the transaction
        $conn->commit();

        // Send email notification
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'railleynickoleivincebautista@gmail.com'; // Your Gmail address
            $mail->Password   = 'nuke fhwp wpbz rlak'; // Your Gmail password or app-specific password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;

            $mail->setFrom('railleynickoleivincebautista@gmail.com', 'PROVIDENCE MEMORIAL PARK ANTIPOLO');
            $mail->addAddress($email, $name);

            $mail->isHTML(true);
            $mail->Subject = 'Account Request Declined';
            $mail->Body = "<h1>Dear $name,</h1><p>Your account request has been declined.</p><p>Reason: $reason</p>";
            $mail->AltBody = "Dear $name,\n\nYour account request has been declined.\n\nReason: $reason";

            $mail->send();
        } catch (Exception $e) {
            error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
            throw new Exception("Failed to send email.");
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

        $destination = new SmsDestination(to: $formattedContact);

        $theMessage = new SmsTextualMessage(
            destinations: [$destination],
            text: "Dear $name, your account request has been declined. Reason: $reason.",
            from: "ProvidencePark"
        );

        $request = new SmsAdvancedTextualRequest(
            messages: [$theMessage]
        );

        try {
            $response = $api->sendSmsMessage($request, $infobipSmsEndpoint);
        } catch (Exception $e) {
            error_log('Failed to send SMS. Error: ' . $e->getMessage());
            throw new Exception("Failed to send SMS.");
        }

        // Redirect back with a success message
        echo '<script>alert("Request has been declined and notifications sent."); window.location.href = "admin_requestaccount.php";</script>';
        exit;
    } catch (Exception $e) {
        // Rollback the transaction if there was an error
        $conn->rollback();
        error_log("Failed to decline request: " . $e->getMessage());
        echo "Failed to decline request.";
    }
} else {
    echo "User not found.";
}

$conn->close();
?>
