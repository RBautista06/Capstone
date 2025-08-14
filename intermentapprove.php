<?php

include 'dbconnection.php';
require 'vendor/autoload.php';
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

// Get POST data
$intermentId = isset($_POST['intermentId']) ? intval($_POST['intermentId']) : 0;
$accountId = isset($_POST['accountId']) ? intval($_POST['accountId']) : 0;
$frontdeskId = isset($_POST['frontdeskId']) ? intval($_POST['frontdeskId']) : 0;
$paymentOption = isset($_POST['paymentOption']) ? $_POST['paymentOption'] : '';
$totalPrice = isset($_POST['totalPrice']) ? floatval($_POST['totalPrice']) : 0.0;

$dateinterment = isset($_POST['dateInterment']) ? trim($_POST['dateInterment']) : '';
$weekofinterment = isset($_POST['weekOfInterment']) ? trim($_POST['weekOfInterment']) : '';
$dayinterment = isset($_POST['dayInterment']) ? trim($_POST['dayInterment']) : '';
$timeinterment = isset($_POST['timeInterment']) ? trim($_POST['timeInterment']) : '';
$clientcode = isset($_POST['accountNumber']) ? trim($_POST['accountNumber']) : '';
$approveReason = isset($_POST['approve-reasoning']) ? htmlspecialchars($_POST['approve-reasoning'], ENT_QUOTES, 'UTF-8') : '';

// Fetch the ACCOUNT_ID from interment_forms using INTERMENTFORM_ID
$query3 = "SELECT ACCOUNT_ID FROM interment_forms WHERE INTERMENTFORM_ID = $intermentId";
$result = $conn->query($query3);

if ($result === FALSE) {
    echo "Error fetching account ID: " . $conn->error;
    exit();
}

$row = $result->fetch_assoc();
$customerId = $row['ACCOUNT_ID'];

// Approve action
$status = 'pending';
$query = "INSERT INTO payment_interment (INTERMENT_ID, STATUS, FRONTDESK_ID, ACCOUNT_ID, PAYMENT_OPTION, TOTAL_PRICE) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($query);

if ($stmt) {
    $stmt->bind_param("isissd", $intermentId, $status, $accountId, $frontdeskId, $paymentOption, $totalPrice);

    if ($stmt->execute()) {
        // Update interment_forms status to 'payment'
        $updateQuery = " UPDATE interment_forms 
            SET STATUS = 'payment',
                ACCOUNT_NUMBER = '$clientcode',
                TIME = '$timeinterment',
                DAY_OF_INTERMENT = '$dayinterment',
                DAYOFWEEK = '$weekofinterment',
                DATE_OF_INTERMENT = '$dateinterment'
            WHERE INTERMENTFORM_ID = ?";
        $updateStmt = $conn->prepare($updateQuery);
        
        if ($updateStmt) {
            $updateStmt->bind_param("i", $intermentId);
            $updateStmt->execute();
            $updateStmt->close();

            // Fetch account details based on ACCOUNT_ID
            $accountQuery = "SELECT EMAIL, CONTACT, FIRSTNAME, MIDDLENAME, LASTNAME FROM tbl_accounts WHERE ACCOUNT_ID = ?";
            $accountStmt = $conn->prepare($accountQuery);
            $accountStmt->bind_param("i", $customerId);
            $accountStmt->execute();
            $accountResult = $accountStmt->get_result();
            $accountDetails = $accountResult->fetch_assoc();
            $accountStmt->close();

            $selectIntermentQuery = "SELECT * FROM interment_forms WHERE INTERMENTFORM_ID = ?";
            $selectIntermentStmt = $conn->prepare($selectIntermentQuery);
            $selectIntermentStmt->bind_param("i", $intermentId);
            $selectIntermentStmt->execute();
            $intermentResult = $selectIntermentStmt->get_result();
            $intermentDetails = $intermentResult->fetch_assoc();
            $selectIntermentStmt->close();
            
            // Use $intermentDetails instead of $intermentResult
            $deceasedfirstname = $intermentDetails['FIRSTNAME'];
            $deceasedmiddlename = $intermentDetails['MIDDLENAME'];
            $deceasedlastname = $intermentDetails['LASTNAME'];
            $deceasedname = $deceasedfirstname . ' ' . $deceasedmiddlename . ' ' . $deceasedlastname;
            
            $deceasedbirth = $intermentDetails['DATE_OF_BIRTH'];
            $deceaseddeath = $intermentDetails['DATE_OF_DEATH'];
            $dateofinterment = $intermentDetails['DATE_OF_INTERMENT'];
            $dayofinterment = $intermentDetails['DAY_OF_INTERMENT'];
            $TIMEofinterment = $intermentDetails['TIME'];
            $AGEofinterment = $intermentDetails['AGE'];
            $interementtotalprice = $intermentDetails['TOTAL_PRICE'];

            $email = $accountDetails['EMAIL'];
            $contact = $accountDetails['CONTACT'];
            $firstname = $accountDetails['FIRSTNAME'];
            $middlename = $accountDetails['MIDDLENAME'];
            $lastname = $accountDetails['LASTNAME'];

            $name = $firstname . ' ' . $middlename . ' ' . $lastname;

            // Send Email Notification
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
                $mail->Subject = 'Interment Approve';
                $mail->Body    = "<h1>Dear $name,</h1><p>Your INTERMENT ORDER FORM request has been approved.</p>";
                $mail->AltBody = "Dear $name, Your Interment Order has been approved.";
                
                $mail->Body .= "<p style='color: black;'>Additional Notes: $approveReason</p><br>";
                $mail->Body .= "<p style='color: black;'>We are pleased to inform you that your Interment Order Form (IOF) request has been approved. </p><br>";
                $mail->Body .= "<p style='color: black;'>To proceed with the interment arrangements, please submit proof of payment for the amount of </p><br>";
                $mail->Body .= "<p style='color: black;'>Payments can be made via GCash or Metrobank bills payment.</p><br>";

                $mail->Body .= "<p style='color: black;'><strong>Deceased Information:</strong></p><br>";
                $mail->Body .= "<p style='color: black;'><strong>Name of Deceased:  $deceasedname</strong></p>";
                $mail->Body .= "<p style='color: black;'>Deceasesd Age: $AGEofinterment</p>";
                $mail->Body .= "<p style='color: black;'>Date of Birth: $deceasedbirth</p>";
                $mail->Body .= "<p style='color: black;'>Date of Death: $deceaseddeath</p>";
                $mail->Body .= "<p style='color: black;'>Date of Interment: $dateofinterment</p>";
                $mail->Body .= "<p style='color: black;'>Interment Day: $dayofinterment</p>";
                $mail->Body .= "<p style='color: black;'>Interment Time: $TIMEofinterment</p><br>";
                $mail->Body .= "<p style='color: black;'>Total Amount to Pay:  $interementtotalprice Php</p><br>";

                $mail->Body .= "<p style='color: black;'>Once payment is confirmed, we will begin preparing for the interment services. If you have any</p><br>";
                $mail->Body .= "<p style='color: black;'>special requests or further questions, feel free to contact us.</p><br>";
                $mail->Body .= "<p style='color: black;'>Thank you for choosing iLocatepmpant. We look forward to assisting you!</p><br><br>";

                $mail->Body .= "<p style='color: black;'>Best regards,</p><br>";
                $mail->Body .= "<p style='color: black;'>The iLocatepmpant Team</p><br>";
                $mail->Body .= "<p style='color: black;'>Providence Memorial Park - Antipolo</p><br>";

                $mail->send();
                echo 'Email has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
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

            $formattedContact = formatPhoneNumberForSms($contact);

            // Send SMS Notification
            include "smsAPIKEY.php";
            $configuration = new Configuration(
                host: $infobipUrl,
                apiKey: $infobipApiKey
            );
            $api = new SmsApi(config: $configuration);

            $destination = new SmsDestination(to: $formattedContact);
            $theMessage = new SmsTextualMessage(
                destinations: [$destination],
                text: "Dear $name, Your Interment Order has been approved.",
                from: "ProvidencePark"
            );
            $request = new SmsAdvancedTextualRequest(
                messages: [$theMessage]
            );

            try {
                $response = $api->sendSmsMessage($request, $infobipSmsEndpoint);
                echo 'SMS has been sent';
                                        echo "<script>alert('Interment approved successfully.'); window.location.href = document.referrer;</script>";
            } catch (Exception $e) {
                echo 'Error sending SMS: ' . $e->getMessage();
            }
        } else {
            echo "Error updating interment form: " . $conn->error;
        }
    } else {
        echo "Error inserting payment: " . $stmt->error;
    }
    $stmt->close();


    
} else {
    echo "Error preparing statement: " . $conn->error;
}
?>
