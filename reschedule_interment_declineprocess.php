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




    // Sanitize input
    $intermentId = $conn->real_escape_string($intermentId);

    // Start a transaction
    $conn->begin_transaction();

        // Fetch the ACCOUNT_ID from interment_forms
        $queryFetchAccount = "SELECT ACCOUNT_ID FROM interment_forms WHERE INTERMENTFORM_ID = '$intermentid'";
        $result = $conn->query($queryFetchAccount);

        if (!$result) {
            throw new Exception("Error fetching ACCOUNT_ID: " . $conn->error);
        }

        $row = $result->fetch_assoc();
        $accountIdFromDb = $row['ACCOUNT_ID'];

        // Fetch account details from tbl_accounts based on ACCOUNT_ID
        $queryFetchContact = "SELECT CONTACT, EMAIL, FIRSTNAME, MIDDLENAME, LASTNAME FROM tbl_accounts WHERE ACCOUNT_ID = '$accountIdFromDb'";
        $result = $conn->query($queryFetchContact);

        if (!$result) {
            throw new Exception("Error fetching account details: " . $conn->error);
        }

        $row = $result->fetch_assoc();
        $contact = $row['CONTACT'];
        $email = $row['EMAIL'];
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
        // Commit the transaction
        $conn->commit();



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
            $mail->addAddress($email, $name); // Add the recipient
        

            $mail->isHTML(true);
            $mail->Subject = 'Interment Payment Declined';
            $mail->Body    = "<h1>Dear $name,</h1><p>Your interment reschedule payment has been declined. Reason for Declining: $reason</p>";
            $mail->AltBody = "Dear $name, Your interment reschedule payment has been declined Reason: $reason";

            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }



        $configuration = new Configuration(
            host: $infobipUrl,
            apiKey: $infobipApiKey
        );
        $api = new SmsApi(config: $configuration);

        $destination = new SmsDestination(to: $formattedContact);
        $theMessage = new SmsTextualMessage(
            destinations: [$destination],
            text: "Dear $name, your interment reschedule payment has been declined Reason for Declining: $reason",
            from: "ProvidencePark"
        );
        $request = new SmsAdvancedTextualRequest(
            messages: [$theMessage]
        );

        try {
            $response = $api->sendSmsMessage($request, $infobipSmsEndpoint);
        } catch (Exception $e) {
            echo 'Failed to send SMS. Error: ' . $e->getMessage();
        }





// Prepare the query to fetch data
$query = "SELECT * FROM interment_forms WHERE INTERMENTFORM_ID = $intermentid";
$result = $conn->query($query);

// Check if there are any rows returned
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    // Fetch the TOTAL_PRICE
    $totalPrice = $row['TOTAL_PRICE'];
    
    // Remove commas and convert to float
    $totalPriceFloat = floatval(str_replace(',', '', $totalPrice));
    
    // Subtract 500
    $newTotalPrice = $totalPriceFloat - 500;
    
    // Format the new total price back to string with commas
    $totalPriceFormatted = number_format($newTotalPrice, 2);

    // Update status and formatted total price in the database
    $queryUpdateStatus = "UPDATE interment_forms 
                          SET STATUS = 'reschedule payment', TOTAL_PRICE = '$totalPriceFormatted' 
                          WHERE INTERMENTFORM_ID = $intermentid";
    if (!$conn->query($queryUpdateStatus)) {
        die("Error executing status update: " . $conn->error);
    }

    // Update proof of payment status
    $queryUpdateProof = "UPDATE payment_interment SET STATUS = 'reschedule payment' WHERE INTERMENT_ID = $intermentid";
    if (!$conn->query($queryUpdateProof)) {
        die("Error executing proof of payment update: " . $conn->error);
    }

    // Update additional proof of payment status

    // Show an alert and redirect after a short delay
    echo "<script>
            alert('Decline Reschedule Payment successful!');
            window.location.href = 'frontdesk_tor_payment.php?Id=$account_id';
          </script>";
    exit();
} else {
    // If no rows are returned, handle the case (optional)
    echo "No records found for the provided interment ID.";
}

// Close the database connection
$conn->close();
?>
