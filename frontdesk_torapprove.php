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

if (isset($_POST['action']) && !empty($_POST['action'])) {

    $action = $_POST['action'];
    $intermentId = isset($_POST['intermentId']) ? intval($_POST['intermentId']) : 0;
    $accountId = isset($_POST['accountId']) ? intval($_POST['accountId']) : 0;
    $frontdeskId = isset($_POST['frontdeskId']) ? intval($_POST['frontdeskId']) : 0;
    $paymentOption = isset($_POST['paymentOption']) ? $_POST['paymentOption'] : '';
    $totalPrice = isset($_POST['totalPrice']) ? $_POST['totalPrice'] : ''; // No floatval used here

    // Fetch the ACCOUNT_ID from interment_forms using INTERMENTFORM_ID
    $query3 = "SELECT CUSTOMER_ID FROM transfer_of_rights WHERE ID = $intermentId";
    $result = $conn->query($query3);

    if ($result === FALSE) {
        echo "Error fetching account ID: " . $conn->error;
        exit();
    }

    $row = $result->fetch_assoc();
    $customerId = $row['CUSTOMER_ID'];

    switch ($action) {
        case 'approve':
            $status = 'pending';
            $query = "INSERT INTO payment_tor (TOR_ID, STATUS, FRONTDESK_ID, ACCOUNT_ID, PAYMENT_OPTION, TOTAL_PRICE) 
                      VALUES ($intermentId, '$status', $frontdeskId, $customerId, '$paymentOption', '$totalPrice')";
            
            // Execute the query without prepared statement
            $result = mysqli_query($conn, $query);
            
            if ($result) {
                // Update transfer_of_rights status to 'payment'
                $updateQuery = "UPDATE transfer_of_rights SET STATUS = 'payment' WHERE ID = ?";
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
                        $mail->Password   = 'zbcn thtx qsbs ldfv';  // Your Gmail password or app-specific password
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                        $mail->Port       = 465;
                    
                        $mail->setFrom('railleynickoleivincebautista@gmail.com', 'PROVIDENCE MEMORIAL PARK ANTIPOLO');
                        $mail->addAddress($email, $name); // Add the recipient
                    
                        $mail->isHTML(true);
                        $mail->Subject = 'Interment Approve';
                        $mail->Body    = "<h1>Dear $name,</h1><p>Your Transfer or RightOrder has been approved.</p>";
                        $mail->AltBody = "Dear $name, Your Transfer or Right has been approved.";
                    
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
                        text: "Dear $name, your Transfer or Right request has been approved.",
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

                    echo "<script>alert('Transfer of Right Request has been approved successfully.'); window.location.href = document.referrer;</script>";
                } else {
                    echo "<script>alert('Error preparing update statement: " . $conn->error . "'); window.location.href = document.referrer;</script>";
                }
            } else {
                echo "<script>alert('Error executing insert statement: " . $conn->error . "'); window.location.href = document.referrer;</script>";
            }
            break;

        case 'decline':
            echo "<script>alert('Interment declined.'); window.location.href = document.referrer;</script>";
            break;

        default:
            echo "<script>alert('Invalid action.'); window.location.href = document.referrer;</script>";
            break;
    }

    $conn->close();
} else {
    echo "<script>alert('Action not specified.'); window.location.href = document.referrer;</script>";
}

?>
