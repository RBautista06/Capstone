<?php
use Infobip\Configuration;
use Infobip\Api\SmsApi;
use Infobip\Model\SmsDestination;
use Infobip\Model\SmsTextualMessage;
use Infobip\Model\SmsAdvancedTextualRequest;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
include "dbconnection.php";
// Sanitize and retrieve form inputs
$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
$name = ($_POST['ownername']);
$contact = trim($_POST['contact']); // Retrieve the contact from the form
$lottype = trim($_POST['lottype']);
$position = 'Lot Owner'; // Static value
// Filter and handle LOT fields
$lotOwnedContainer = array_filter($_POST, function ($key) {
    return strpos($key, 'LOT') === 0;
}, ARRAY_FILTER_USE_KEY);
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
    // Determine the number of lots based on lot type
    $maxLots = match ($lottype) {
        'court4' => 4,
        'court8' => 8,
        'estate12' => 12,
        'estate24' => 24,
        default => 1, // Default to 1 for lawnlot
    };
    // Prepare the dynamic query for lots
    $lotColumns = '';
    $lotValues = [];
    for ($i = 1; $i <= $maxLots; $i++) {
        $lotColumns .= ", LOT{$i}";
        $lotValues[] = $_POST["LOT{$i}"] ?? ''; // Use the lot input or an empty string
    }
    // Insert into owners table
    $sql = "INSERT INTO owners (EMAIL, TYPE_OF_LOT $lotColumns) VALUES (?, ?" . str_repeat(', ?', $maxLots) . ")";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        throw new Exception("Error preparing statement: " . $conn->error);
    }
    $params = array_merge([$email, $lottype], $lotValues);
    $types = str_repeat('s', count($params));
    $stmt->bind_param($types, ...$params);
    if (!$stmt->execute()) {
        throw new Exception("Error inserting into owners: " . $stmt->error);
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
        $mail->Subject = 'Lot Owned Update';
        $mail->Body    = "<h1>Welcome, $name!</h1><p>Your account has been updated successfully created as a Lot Owner.</p>";
        $mail->AltBody = "Welcome, $name! Your account Lot Owned has been successfully updated, Thank you for trusting us.";
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
        text: "Dear $name, your account as a Lot Owned has been successfully updated at Providence Memorial Park.",
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
    echo '<script>alert("Successfully Updated a Lot Owner Account"); window.location.href = "existingaccount.php";</script>';
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
