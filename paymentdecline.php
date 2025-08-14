<?php
        // Prepare and send email notification
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
include 'dbconnection.php';
// Retrieve parameters from the URL
$action = isset($_GET['action']) ? $_GET['action'] : '';
$intermentId = isset($_GET['intermentid']) ? $_GET['intermentid'] : '';
$accountId = isset($_GET['account_id']) ? $_GET['account_id'] : '';
$frontdeskname = isset($_GET['frontdeskname']) ? $_GET['frontdeskname'] : '';
$reason = isset($_GET['reason']) ? $_GET['reason'] : '';
// Check if action is 'decline'
if ($action === 'decline') {
    // Sanitize input
    $intermentId = $conn->real_escape_string($intermentId);
    // Start a transaction
    $conn->begin_transaction();
    try {
        // Fetch the ACCOUNT_ID from interment_forms
        $queryFetchAccount = "SELECT ACCOUNT_ID FROM interment_forms WHERE INTERMENTFORM_ID = '$intermentId'";
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
        // Update the status in the payment_interment table
        $query1 = "UPDATE payment_interment SET STATUS = 'pending' WHERE INTERMENT_ID = '$intermentId'";
        if (!$conn->query($query1)) {
            throw new Exception("Error updating payment_interment: " . $conn->error);
        }
        // Update the status in the proof_of_payments table
        $query2 = "UPDATE proof_of_payments SET STATUS = 'declined' WHERE INTERMENT_ORDER = '$intermentId'";
        if (!$conn->query($query2)) {
            throw new Exception("Error updating proof_of_payments: " . $conn->error);
        }
        // Commit the transaction
        $conn->commit();
                 $mail = new PHPMailer(true);
                    try {
                        $mail->isSMTP();
                        $mail->Host       = 'smtp.gmail.com';
                        $mail->SMTPAuth   = true;
                        $mail->Username   = 'railleynickoleivincebautista@gmail.com'; // Your Gmail address
                        $mail->Password   = 'zbcn thtx qsbs ldfv';
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                        $mail->Port       = 465;
                        $mail->setFrom('railleynickoleivincebautista@gmail.com', 'PROVIDENCE MEMORIAL PARK ANTIPOLO');
                        $mail->addAddress($email, $accountName); // Add the recipient email
            $mail->isHTML(true);
            $mail->Subject = 'Interment Payment Declined';
            $mail->Body    = "<h1>Dear $name,</h1><p>Your interment request has been declined,  you can see the Payment Details on the Interment Payment tab of Providence Antipolo Website. Reason for Declining: $reason</p>";
            $mail->AltBody = "Dear $name, Your interment payment has been declined. Reason: $reason";
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
            text: "Dear $name, your interment payment has been declined. Reason for Declining: $reason",
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
        // Redirect back to the previous page with a success message
        echo "<script>alert('Interment Payment declined. Email and SMS notifications have been sent.'); window.location.href = 'frontdeskpayment.php?Id=" . urlencode($accountId) . "';</script>";
        exit;
    } catch (Exception $e) {
        // Rollback the transaction if any error occurs
        $conn->rollback();
        // Output JavaScript for alert if there's an error
        echo "<script>
                alert('Error updating records: " . addslashes($e->getMessage()) . "');
                window.location.href = 'frontdeskpayment.php?Id=" . urlencode($accountId) . "';
              </script>";
    }
}
$conn->close();
?>
