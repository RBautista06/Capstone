<?php
include "dbconnection.php";
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
include 'smsAPIKEY.php';
use Infobip\Configuration;
use Infobip\Api\SmsApi;
use Infobip\Model\SmsDestination;
use Infobip\Model\SmsTextualMessage;
use Infobip\Model\SmsAdvancedTextualRequest;

// Retrieve frontdeskname, intermentid, and account_id from GET parameters
$frontdeskname = isset($_GET['frontdeskname']) ? htmlspecialchars($_GET['frontdeskname']) : '';
$intermentid = isset($_GET['intermentid']) ? intval($_GET['intermentid']) : 0;
$account_id = isset($_GET['account_id']) ? intval($_GET['account_id']) : 0;
$reason = isset($_GET['reason']) ? $_GET['reason'] : '';
// Action should be defined somewhere, ensure it's set properly
$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($action === 'decline') {
    // Start a transaction
    $conn->begin_transaction();

    try {
        // Fetch the ACCOUNT_ID from transfer_of_rights
        $queryFetchAccount = "SELECT CUSTOMER_ID FROM transfer_of_rights WHERE ID = ?";
        $stmt = $conn->prepare($queryFetchAccount);
        $stmt->bind_param('i', $intermentid);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            throw new Exception("No records found for the provided interment ID.");
        }

        $row = $result->fetch_assoc();
        $accountIdFromDb = $row['CUSTOMER_ID'];

        // Fetch account details from tbl_accounts based on ACCOUNT_ID
        $queryFetchContact = "SELECT CONTACT, EMAIL, FIRSTNAME, MIDDLENAME, LASTNAME FROM tbl_accounts WHERE ACCOUNT_ID = ?";
        $stmt = $conn->prepare($queryFetchContact);
        $stmt->bind_param('i', $accountIdFromDb);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            throw new Exception("No account details found for the provided ACCOUNT_ID.");
        }

        $row = $result->fetch_assoc();
        $contact = $row['CONTACT'];
        $email = $row['EMAIL'];
        $firstname = $row['FIRSTNAME'];
        $middlename = $row['MIDDLENAME'];
        $lastname = $row['LASTNAME'];

        // Combine names for notification
        $name = trim("$firstname $middlename $lastname");

        // Format phone number for SMS
        function formatPhoneNumberForSms($number) {
            $number = preg_replace('/\D/', '', $number);
            if (strpos($number, '0') === 0) {
                return '+63' . substr($number, 1);
            }
            return (strpos($number, '+') !== 0) ? '+63' . $number : $number;
        }

        $formattedContact = formatPhoneNumberForSms($contact);

        // Setup PHPMailer
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'railleynickoleivincebautista@gmail.com'; // Your Gmail address
        $mail->Password   = 'nuke fhwp wpbz rlak'; // Your Gmail app-specific password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        $mail->setFrom('railleynickoleivincebautista@gmail.com', 'PROVIDENCE MEMORIAL PARK ANTIPOLO');
        $mail->addAddress($email, $name);

        $mail->isHTML(true);
        $mail->Subject = 'Transfer of Right Payment Declined';
        $mail->Body    = "<h1>Dear $name,</h1><p>Your Transfer of Right Reschedule Paymenthas been declined. Reason: $reason</p>";
        $mail->AltBody = "Dear $name, Your Transfer of Right Reschedule Paymenhas been declined. Reason: $reason";

        $mail->send();

        // SMS Notification
        $configuration = new Configuration(host: $infobipUrl, apiKey: $infobipApiKey);
        $api = new SmsApi(config: $configuration);

        $destination = new SmsDestination(to: $formattedContact);
        $theMessage = new SmsTextualMessage(
            destinations: [$destination],
            text: "Dear $name, your ToR Reschedule payment has been declined. Reason: $reason",
            from: "ProvidencePark"
        );
        $request = new SmsAdvancedTextualRequest(messages: [$theMessage]);

        $api->sendSmsMessage($request, $infobipSmsEndpoint);

        // Update status and total price in the database
        $queryUpdate = "UPDATE transfer_of_rights SET STATUS = 'reschedule payment', TOTAL_PRICE = (TOTAL_PRICE - 500) WHERE ID = ?";
        $stmt = $conn->prepare($queryUpdate);
        $stmt->bind_param('i', $intermentid);
        if (!$stmt->execute()) {
            throw new Exception("Error updating transfer_of_rights: " . $stmt->error);
        }

        // Update proof of payment status
        $queryUpdateProof = "UPDATE payment_tor SET STATUS = 'reschedule payment' WHERE TOR_ID = ?";
        $stmt = $conn->prepare($queryUpdateProof);
        $stmt->bind_param('i', $intermentid);
        if (!$stmt->execute()) {
            throw new Exception("Error updating payment_tor: " . $stmt->error);
        }

        // Commit the transaction
        $conn->commit();

        // Show an alert and redirect
        echo "<script>
                alert('Decline Reschedule Payment successful!');
                window.location.href = 'frontdesk_tor_payment.php?Id=$account_id';
              </script>";
    } catch (Exception $e) {
        $conn->rollback(); // Rollback on error
        echo "Error: " . $e->getMessage();
    } finally {
        $stmt->close();
    }
}

// Close the database connection
$conn->close();
?>
