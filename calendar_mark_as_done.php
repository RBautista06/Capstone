<?php
include 'dbconnection.php';
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
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $interment_id = isset($_POST['interment_id']) ? intval($_POST['interment_id']) : 0;
    if ($interment_id > 0) {
        $query = "SELECT LOCATION_ID, REMAINS_TYPE, ACCOUNT_ID FROM interment_forms WHERE INTERMENTFORM_ID = ?";
        $stmt = $conn->prepare($query);
        if ($stmt === false) {
            die("Error preparing statement: " . $conn->error);
        }
        $stmt->bind_param('i', $interment_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $location_id = $row['LOCATION_ID'];
            $remains_type = $row['REMAINS_TYPE'];
            $account_id = $row['ACCOUNT_ID'];
            // Step 3: Fetch the current SLOT from the owners table
            $slotQuery = "SELECT SLOT FROM owners WHERE IO_ID = ?";
            $slotStmt = $conn->prepare($slotQuery);
            if ($slotStmt === false) {
                die("Error preparing slot query: " . $conn->error);
            }
            $slotStmt->bind_param('i', $location_id);
            $slotStmt->execute();
            $slotResult = $slotStmt->get_result();
            if ($slotResult->num_rows > 0) {
                // Determine the amount to add based on REMAINS_TYPE
                $amountToAdd = ($remains_type === 'Adult Fresh Body' || $remains_type === 'Children Fresh Body') ? 2 : 1;
                // Update the SLOT based on the amountToAdd
                $updateSlotQuery = "UPDATE owners SET SLOT = SLOT + ? WHERE IO_ID = ?";
                $updateSlotStmt = $conn->prepare($updateSlotQuery);
                if ($updateSlotStmt === false) {
                    die("Error preparing update slot statement: " . $conn->error);
                }
                $updateSlotStmt->bind_param('ii', $amountToAdd, $location_id);
                $updateSlotStmt->execute();
                if ($updateSlotStmt->affected_rows > 0) {
                    // Step 5: Mark the interment as done
                    $query3 = "UPDATE interment_forms SET STATUS = 'Mark as Done' WHERE INTERMENTFORM_ID = ?";
                    $stmt3 = $conn->prepare($query3);
                    if ($stmt3 === false) {
                        die("Error preparing status update statement: " . $conn->error);
                    }
                    $stmt3->bind_param('i', $interment_id);
                    $stmt3->execute();
                    // Step 6: Fetch interment details for email notification
                    $selectIntermentQuery = "SELECT * FROM interment_forms WHERE INTERMENTFORM_ID = ?";
                    $selectIntermentStmt = $conn->prepare($selectIntermentQuery);
                    if ($selectIntermentStmt === false) {
                        die("Error preparing interment details statement: " . $conn->error);
                    }
                    $selectIntermentStmt->bind_param("i", $interment_id);
                    $selectIntermentStmt->execute();
                    $intermentResult = $selectIntermentStmt->get_result();
                    if ($intermentResult->num_rows === 0) {
                        echo "<p>No interment details found.</p>";
                        exit;
                    }
                    $intermentDetails = $intermentResult->fetch_assoc();
                    $selectIntermentStmt->close();
                    // Fetch EMAIL and CONTACT from owners based on ACCOUNT_ID
                    $ownerQuery = "SELECT EMAIL, CONTACT, NAME FROM tbl_accounts WHERE ACCOUNT_ID = ?";
                    $ownerStmt = $conn->prepare($ownerQuery);
                    $ownerStmt->bind_param('i', $account_id);
                    $ownerStmt->execute();
                    $ownerResult = $ownerStmt->get_result();
                    if ($ownerResult->num_rows > 0) {
                        $ownerRow = $ownerResult->fetch_assoc();
                        $email = $ownerRow['EMAIL'];
                        $accountContact = $ownerRow['CONTACT'];
                        $accountName = $ownerRow['NAME'];
                    } else {
                        echo "<p>No owner details found.</p>";
                        exit;
                    }
                    // Use $intermentDetails and $email, $accountContact to construct the email and SMS notification
                    $deceasedfirstname = $intermentDetails['FIRSTNAME'];
                    $deceasedmiddlename = $intermentDetails['MIDDLENAME'];
                    $deceasedlastname = $intermentDetails['LASTNAME'];
                    $deceasedname = "$deceasedfirstname $deceasedmiddlename $deceasedlastname";
                    $deceasedbirth = $intermentDetails['DATE_OF_BIRTH'];
                    $deceaseddeath = $intermentDetails['DATE_OF_DEATH'];
                    $dateofinterment = $intermentDetails['DATE_OF_INTERMENT'];
                    $dayofinterment = $intermentDetails['DAY_OF_INTERMENT'];
                    $TIMEofinterment = $intermentDetails['TIME'];
                    $AGEofinterment = $intermentDetails['AGE'];
                    $interementtotalprice = $intermentDetails['TOTAL_PRICE'];
                    // Send email notification
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
                        $mail->addAddress($email, $accountName); // Add the recipient email
                        $mail->isHTML(true);
                        $mail->Subject = 'IOF Process Complete';
                        $mail->Body = "<h1>Dear $accountName,</h1>
                                       <p>We are pleased to inform you that the IOF process has been successfully completed.</p>
                                       <p><strong>Deceased Information:</strong></p>
                                       <p><strong>Name of Deceased: $deceasedname</strong></p>
                                       <p>Deceased Age: $AGEofinterment</p>
                                       <p>Date of Birth: $deceasedbirth</p>
                                       <p>Date of Death: $deceaseddeath</p>
                                       <p>Date of Interment: $dateofinterment</p>
                                       <p>Interment Day: $dayofinterment</p>
                                       <p>Interment Time: $TIMEofinterment</p>
                                       <p>Total Amount to Pay: $interementtotalprice</p>
                                       <p>Thank you for choosing Providence Memorial Park</p>
                                       <p>Best regards,</p>
                                       <p>Providence Memorial Park - Antipolo</p>
                                       <p>https://ilocatepmpant.site | example@gmail.com | 09123456789</p>";
                        $mail->send();
                        // Format phone number for SMS
                        function formatPhoneNumberForSms($contact) {
                            $contact = preg_replace('/\D/', '', $contact);
                            if (strpos($contact, '0') === 0) {
                                $contact = '+63' . substr($contact, 1);
                            } else if (strpos($contact, '+') !== 0) {
                                $contact = '+63' . $contact;
                            }
                            return $contact;
                        }
                        // Send SMS notification
                        $formattedContact = formatPhoneNumberForSms($accountContact);
                        include "smsAPIKEY.php";
                        $configuration = new Configuration(host: $infobipUrl, apiKey: $infobipApiKey);
                        $api = new SmsApi(config: $configuration);
                        $destination = new SmsDestination(to: $formattedContact);
                        $theMessage = new SmsTextualMessage(
                            destinations: [$destination],
                            text: "Dear $accountName, Your IOF process is complete. Please check your email for more details.",
                            from: "ProvidencePark"
                        );
                        $request = new SmsAdvancedTextualRequest(messages: [$theMessage]);
                        $response = $api->sendSmsMessage($request, $infobipSmsEndpoint);
                        echo 'SMS has been sent successfully.';
                        // Success message to user
                        echo "<script>
                        alert('Mark as Done successfully: Deceased Person can be viewed on Providence Map. Slot updated.');
                        window.history.back();
                        </script>";
                    } catch (Exception $e) {
                        echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
                } else {
                    echo "<p>Failed to update SLOT.</p>";
                }
            } else {
                echo "<p>Location ID not found.</p>";
            }
        } else {
            echo "<p>No interment form found for this ID.</p>";
        }
    }
    $stmt->close();
    $conn->close();
} else {
    echo "<p>Invalid request method.</p>";
}
?>
