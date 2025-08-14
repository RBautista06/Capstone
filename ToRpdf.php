<?php
include "dbconnection.php";
require('./fpdf186/fpdf.php');
require 'vendor/autoload.php';

use setasign\Fpdi\Fpdi;


// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Get form data
    $transferorFirstName = isset($_POST['transferorfirstname']) ? htmlspecialchars($_POST['transferorfirstname']) : '';
    $transferorMiddleName = isset($_POST['transferormiddlename']) ? htmlspecialchars($_POST['transferormiddlename']) : '';
    $transferorLastName = isset($_POST['transferorlastname']) ? htmlspecialchars($_POST['transferorlastname']) : '';

    $spouseFirstName = isset($_POST['spouseFirstname']) ? htmlspecialchars($_POST['spouseFirstname']) : '';
    $spouseMiddleName = isset($_POST['spouseMiddlename']) ? htmlspecialchars($_POST['spouseMiddlename']) : '';
    $spouseLastName = isset($_POST['spouseLastname']) ? htmlspecialchars($_POST['spouseLastname']) : '';

    $transfereeFirstName = isset($_POST['transfereefirstname']) ? htmlspecialchars($_POST['transfereefirstname']) : '';
    $transfereeMiddleName = isset($_POST['transfereemiddlename']) ? htmlspecialchars($_POST['transfereemiddlename']) : '';
    $transfereeLastName = isset($_POST['transfereelastname']) ? htmlspecialchars($_POST['transfereelastname']) : '';

    $spouseFirstNameTransferee = isset($_POST['spouseFirstname-transferee']) ? htmlspecialchars($_POST['spouseFirstname-transferee']) : '';
    $spouseMiddleNameTransferee = isset($_POST['spouseMiddlename-transferee']) ? htmlspecialchars($_POST['spouseMiddlename-transferee']) : '';
    $spouseLastNameTransferee = isset($_POST['spouseLastname-transferee']) ? htmlspecialchars($_POST['spouseLastname-transferee']) : '';


    $transferorValidID = isset($_POST['transferor-valid-id-num']) ? htmlspecialchars($_POST['transferor-valid-id-num']) : '';
    $transfereeValidID = isset($_POST['transferee-valid-id-num']) ? htmlspecialchars($_POST['transferee-valid-id-num']) : '';




    $customerId = isset($_GET['Id']) ? intval($_GET['Id']) : 0;
    $status = 'request';
    $transferorFullName = $transferorFirstName . ' ' . $transferorMiddleName . ' ' . $transferorLastName;
    $transferorAddress = isset($_POST['transferor_address']) ? htmlspecialchars($_POST['transferor_address']) : '';
    $transferorspouseFullName = $spouseFirstName . ' ' . $spouseMiddleName . ' ' . $spouseLastName;
    $transferorStatus = isset($_POST['statusType']) ? htmlspecialchars($_POST['statusType']) : '';

    $contractPrice = isset($_POST['contractPrices']) ? htmlspecialchars($_POST['contractPrices']) : '';
    $lotdescription = isset($_POST['lot_description_2']) ? htmlspecialchars($_POST['lot_description_2']) : '';
    $location = isset($_POST['location']) ? htmlspecialchars($_POST['location']) : '';
    $typeoflot = isset($_POST['typeoflot']) ? htmlspecialchars($_POST['typeoflot']) : '';
    $datetransfer = isset($_POST['dateinterment']) ? htmlspecialchars($_POST['dateinterment']) : '';
    $daytransfer = isset($_POST['dayinterment']) ? htmlspecialchars($_POST['dayinterment']) : '';
    $timetransfer = isset($_POST['timeinterment']) ? htmlspecialchars($_POST['timeinterment']) : '';
    $paymentOption = isset($_POST['paymentOption']) ? htmlspecialchars($_POST['paymentOption']) : '';
    $transferFee = isset($_POST['transferFee']) ? htmlspecialchars($_POST['transferFee']) : '';
    $notarialFee = isset($_POST['notarialFee']) ? htmlspecialchars($_POST['notarialFee']) : '';
    $totalPrice = isset($_POST['totalprice']) ? htmlspecialchars($_POST['totalprice']) : '';

    $transfereeFullName = $transfereeFirstName . ' ' . $transfereeMiddleName . ' ' . $transfereeLastName;
    $transfereeAddress = isset($_POST['transfereeaddress']) ? htmlspecialchars($_POST['transfereeaddress']) : '';
    $transfereespouseFullName = $spouseFirstNameTransferee . ' ' . $spouseMiddleNameTransferee . ' ' . $spouseLastNameTransferee;
    $transfereeStatus = isset($_POST['statusTypeTransferee']) ? htmlspecialchars($_POST['statusTypeTransferee']) : '';


$query = "
    INSERT INTO transfer_of_rights (
        CUSTOMER_ID, STATUS, TRANSFEROR_NAME, TRANSFEROR_STATUS, TRANSFEROR_SPOUSE, TRANSFEROR_ADDRESS,
        TRANSFEREE_NAME, TRANSFEREE_STATUS, TRANSFEREE_SPOUSE, TRANSFEREE_ADDRESS, LOCATION_ID,
        LOT_DESCRIPTION, TYPE_OF_LOT, CONTRACT_PRICE, DATE_OF_TRANSFER, DAY_OF_TRANSFER, TIME_OF_TRANSFER,
        PAYMENT_OPTION, TOTAL_PRICE
    )
    VALUES (
        '$customerId', '$status', '$transferorFullName', '$transferorStatus', '$transferorspouseFullName', '$transferorAddress',
        '$transfereeFullName', '$transfereeStatus', '$transfereespouseFullName', '$transfereeAddress', '$location',
        '$lotdescription', '$typeoflot', '$contractPrice', '$datetransfer', '$daytransfer', '$timetransfer',
        '$paymentOption', '$totalPrice'
    )
";

if (mysqli_query($conn, $query)) {
    // Retrieve the last inserted ID
    $last_id = mysqli_insert_id($conn);
    echo "Data inserted successfully. The ID is: " . $last_id;

    // Process file uploads for transferor and transferee
    $baseFolder = 'torrequest/';
    $idFolder = $baseFolder . $last_id;

    // Create the folder if it doesn't exist
    if (!is_dir($idFolder)) {
        mkdir($idFolder, 0777, true);
    }

function handleFileUpload($fileKey, $uploadDir, $newFileName) {
    if (isset($_FILES[$fileKey]) && $_FILES[$fileKey]['error'] === UPLOAD_ERR_OK) {
        $tmpName = $_FILES[$fileKey]['tmp_name'];
        $fileExtension = pathinfo($_FILES[$fileKey]['name'], PATHINFO_EXTENSION); // Get file extension
        $targetFilePath = $uploadDir . '/' . $newFileName . '.' . $fileExtension; // Rename file

        if (move_uploaded_file($tmpName, $targetFilePath)) {
            return $newFileName . '.' . $fileExtension; // Return the new file name
        }
    }
    return null; // Return null if no file uploaded
}

// Handle file uploads with new names
// Assuming handleFileUpload() handles the file upload and returns the file path or name
$transferorFile1 = handleFileUpload('transferor-file1', $idFolder, 'transferor_file1');
$transferorFile2 = handleFileUpload('transferor-file2', $idFolder, 'transferor_file2');
$transfereeFile1 = handleFileUpload('transferee-file1', $idFolder, 'transferee_file1');
$transfereeFile2 = handleFileUpload('transferee-file2', $idFolder, 'transferee_file2');

// Assuming these variables will store the paths if the file inputs exist in the form submission

// Prepare the SQL query to update file paths
$sql20 = "UPDATE transfer_of_rights
          SET TRANSFEROR_FILE1 = '$transferorFile1',
              TRANSFEROR_FILE2 = '$transferorFile2',
              TRANSFEREE_FILE1 = '$transfereeFile1',
              TRANSFEREE_FILE2 = '$transfereeFile2'
          WHERE ID = '$last_id'"; // Use $last_id to update the record

// Execute the query to update the file paths
if ($conn->query($sql20) === TRUE) {
    echo "Record updated successfully!";
} else {
    echo "Error: " . $conn->error;
}





class PDF extends Fpdi {
    // Custom method for justified multi-cell text (based on your code)
    function MultiCellJustified($w, $h, $txt, $border = 0, $align = 'L') {
        $words = explode(' ', $txt);
        $line = '';
        $lineHeight = $h;

        foreach ($words as $word) {
            $testLine = $line . $word . ' ';
            $testWidth = $this->GetStringWidth($testLine);

            if ($testWidth > $w) {
                $this->MultiCell($w, $lineHeight, trim($line), $border, $align);
                $line = $word . ' '; // Start a new line
            } else {
                $line = $testLine; // Add the word to the current line
            }
        }

        if ($line !== '') {
            $this->MultiCell($w, $lineHeight, trim($line), $border, $align);
        }
    }
}

    $pdf = new PDF('P', 'mm', array(216, 450)); // Width: 216mm, Height: 330mm
    $pdf->AddPage();
    $pdf->SetFont('Times', 'B', 12);

    $leftMargin = 20;
    $topMargin = 20;
    $rightMargin = 20;

    $pdf->SetLeftMargin($leftMargin);
    $pdf->SetTopMargin($topMargin);
    $pdf->SetRightMargin($rightMargin);
    $imageWidth = 40;
    $imageX = 10;


    $pdf->Image('pictures/providence_logo - Copy.png', $imageX, 10, $imageWidth);

    $pdf->SetTextColor(50, 134, 54);

    // Add the cell with the green text
    $pdf->Cell(0, 20, "Providence Memorial Park Antipolo", 0, 1, "R");

    // Reset text color to default (black, RGB: 0, 0, 0)
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('Arial', '', 10); // Reset font size and style
    $pdf->Cell(0, -2, "Marcos Highway 1870 Antipolo, Philippines", 0, 1, "R");
    $pdf->Cell(0, 10, "Email Address: Interment.pmpa@gmail.com", 0, 1, "R");
    $pdf->Cell(0, -2, "Contact Number: 0919-0638-018", 0, 1, "R");
    $pdf->Ln(13);

    $pdf->SetFont('Times', 'B', 12);
    $pdf->Cell(0, 20, "TRANSFER OF RIGHT REQUEST", 0, 1, "C");

    $pdf->SetX(30);
    $pdf->Cell(0, 20,'Details:', 0, 0, 'L');
    $pdf->Ln(5);
    $pdf->SetX(30);
    $pdf->SetFont('Times', '', 12);
    $header1 = ['Name', 'Value'];
    $widths1 = [80, 80]; // Define the widths for the columns

    // Array of data to be displayed in the table
    $data = [
        'Transferor Name:' => $transferorFullName,
        'Transferee Name:' => $transfereeFullName,
        'Location:' => $location,
        'Type of Lot:' => $typeoflot,
        'Date of Transfer:' => $datetransfer,
        'Day of Transfer:' => $daytransfer,
        'Time of Transfer:' => $timetransfer,
        'Payment Option:' => $paymentOption,
    ];

    // Draw header without bottom border

    $pdf->Ln(10); // Move to the next line



    foreach ($data as $label => $value) {

        $pdf->SetX(30);
        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell($widths1[0], 8, $label, 'TLB', 0, 'L');

        $pdf->SetFont('Times', '', 12);
        $pdf->SetTextColor(50, 134, 54);


        $pdf->Cell($widths1[1] - 8, 8, $value, 'TRB', 0, 'L');

        $pdf->SetTextColor(0, 0, 0);
        $pdf->Ln();
    }
    $data = [

        'Transfer Fee:' => $transferFee,
        'Notarial Fee:' => $notarialFee,
        'Total Price:' => $totalPrice,
    ];

    // Draw header without bottom border

    $pdf->Ln(10); // Move to the next line
    $pdf->SetX(30);
    $pdf->SetFont('Times', 'B', 12);
    $pdf->Cell(0, 0,'Payment Details:', 0, 0, 'L');
    $pdf->Ln(5);
    // Create rows with the provided data
    foreach ($data as $label => $value) {

        $pdf->SetX(30);
        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell($widths1[0], 8, $label, 0, 0, 'L');

        $pdf->SetFont('Times', '', 12);
        $pdf->SetTextColor(50, 134, 54);

        $pdf->Image('pictures/pesopeso.png', $pdf->GetX() + 3, $pdf->GetY() + 1.5, 3.5, 3.5, 'PNG');

        $pdf->SetX($pdf->GetX() + 7);
        $pdf->Cell($widths1[1] - 8, 8, $value, 0, 0, 'L');

        $pdf->SetTextColor(0, 0, 0);
        $pdf->Ln();
    }

    $pdf->Ln(15);
    $pdf->SetX($leftMargin);
    $pdf->SetFont('Times', 'B', 12);
    $pdf->Cell($widths1[0], 8, 'REQUIREMENTS TO BRING AT THE DATE OF TRANSFER: '.$datetransfer, 0, 0, 'L');
    $pdf->Ln(10);
    $pdf->Cell($widths1[0], 8, 'TRANSFEROR/LOT OWNER', 0, 0, 'L');
    $pdf->Ln(5);
    $pdf->SetFont('Times', '', 11);
    $pdf->Cell($widths1[0], 8, '1. VALID ID WITH CLEAR SIGNATURE', 0, 0, 'L');
    $pdf->Ln(5);
    $pdf->Cell($widths1[0], 8, '- 3 COPIES WITH 3 SPECIMEN SIGNATURE', 0, 0, 'L');

    $pdf->Ln(10);
    $pdf->Cell($widths1[0], 8, '- IF MARRIED NEED VALID ID OF SPOUSE', 0, 0, 'L');
    $pdf->Ln(5);
    $pdf->Cell($widths1[0], 8, '- 3 COPIES WITH 3 SPECIMEN SIGNATURE', 0, 0, 'L');
    $pdf->Ln(5);
    $pdf->Cell($widths1[0], 8, '- MARRIAGE CONTRACT (PHOTO COPY)', 0, 0, 'L');

    $pdf->Ln(10);
    $pdf->Cell($widths1[0], 8, ' IF SINGLE NEED BIRTH CERTIFICATE (PHOTO COPY)', 0, 0, 'L');
    $pdf->Ln(5);
    $pdf->Cell($widths1[0], 8, '- IF WIDOW NEED (CERTIFIED TRUE COPY OF DEATH CERTIFICATE)', 0, 0, 'L');
    $pdf->Ln(5);
    $pdf->Cell($widths1[0], 8, '- IF LOT OWNER DECEASED NEED CERTIFIED TRUE COPY OF DEATH CERTIFICATE', 0, 0, 'L');

    $pdf->Ln(10);
    $pdf->Cell($widths1[0], 8, '3. NOTARIZED DEED OF DEED OF RIGHTS', 0, 0, 'L');
    $pdf->Ln(5);
    $pdf->Cell($widths1[0], 8, '4. NOTARIZED JOINT AFFFIDAVIT OF CONFORMITY', 0, 0, 'L');
    $pdf->Ln(5);
    $pdf->Cell($widths1[0], 8, '5. SURRENDER ORIGINAL CERTIFICATE OF OWNERSHIP OR TITLE', 0, 0, 'L');
    $pdf->Ln(10);
    $pdf->SetFont('Times', 'B', 12);
    $pdf->Cell($widths1[0], 8, 'TRANSFEREE', 0, 0, 'L');
    $pdf->SetFont('Times', '', 12);
    $pdf->Ln(5);
    $pdf->Cell($widths1[0], 8, '1. VALID ID WITH CLEAR SIGNATURE', 0, 0, 'L');
    $pdf->Ln(5);
    $pdf->Cell($widths1[0], 8, '- 3 COPIES WITH 3 SPECIMEN SIGNATURE', 0, 0, 'L');
    $pdf->Ln(10);
    $pdf->Cell($widths1[0], 8, '- IF MARRIED NEED VALID ID OF SPOUSE', 0, 0, 'L');
    $pdf->Ln(5);
    $pdf->Cell($widths1[0], 8, '- 3 COPIES WITH 3 SPECIMEN SIGNATURE', 0, 0, 'L');
    $pdf->Ln(5);
    $pdf->Cell($widths1[0], 8, '- MARRIAGE CONTRACT (PHOTO COPY)', 0, 0, 'L');
    $pdf->Ln(10);
    $pdf->Cell($widths1[0], 8, '- IF SINGLE NEED BIRTH CERTIFICATE (PHOTO COPY)', 0, 0, 'L');
    $pdf->Ln(5);
    $pdf->Cell($widths1[0], 8, '- IF WIDOW NEED (CERTIFIED TRUE COPY OF DEATH CERTIFICATE)', 0, 0, 'L');
    $pdf->Ln(5);
    $pdf->Cell($widths1[0], 8, '- IF LOT OWNER DECEASED NEED CERTIFIED TRUE COPY OF DEATH CERTIFICATE', 0, 0, 'L');









    $pdf->Ln(300);

    $pdf->Cell(0, 15, " ", 0, 1, "C");
    $pdf->Image('pictures/snrDc.jpeg',50,5,100);
    $pdf->SetFont('Times', '', 11);
    $pdf->Cell(0, 6, "LEGAL DOCUMENTATION DIVISION", 0, 1, "C");
    $pdf->Cell(0, 6, "ANTIPOLO BRANCH", 0, 1, "C");
    $pdf->SetFont('Times', 'B', 11);
    $pdf->Cell(0, 6, "OFFICIAL REQUEST FORM", 0, 1, "C");
    $pdf->SetFont('Times', '', 11);


    $currentDate = date("F, d, Y");

    $pdf->Cell(25, 6, "Date: ", "TL", 0, 0);
    $pdf->SetFont('Times', 'B', 11);
    $pdf->Cell(63, 6, "$currentDate", "T", 0, 1);
    $pdf->SetFont('Times', '', 11);

    $pdf->Cell(30, 6, "Reference no: ","T", 0, 0);

                            $pdf->SetTextColor(139, 0, 0);
    $pdf->SetFont('Times', 'B', 11);
    $pdf->Cell(58, 6, "$last_id","TR", 1, 1);
                    $pdf->SetTextColor(0, 0, 0);

    $pdf->SetFont('Times', '', 11);

    $pdf->Cell(25, 6, "Name: ", "L", 0, 0);

    $pdf->SetFont('Times', 'B', 11);
            $pdf->SetTextColor(0, 0, 139);
    $pdf->Cell(63, 6, "$transferorFullName", "", 0, 1);
                    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('Times', '', 11);
    $pdf->Cell(30, 6, "Civil Status: ", "", 0, 0);


    $pdf->SetFont('Times', 'B', 11);
    $pdf->Cell(58, 6, "$transferorStatus", "R", 1, 1);
    $pdf->SetFont('Times', '', 11);
        $pdf->SetTextColor(0, 0, 0);
    $pdf->Cell(25, 6, "Address: ","L", 0, 0);
    $pdf->SetFont('Times', 'B', 11);
    $pdf->Cell(151, 6, "$transferorAddress","R", 1, 1);
    if ($customerId > 0) {

        $query_customer = "SELECT * FROM tbl_accounts WHERE ACCOUNT_ID = ?";
        $stmt_customer = $conn->prepare($query_customer);
        $stmt_customer->bind_param("i", $customerId);
        $stmt_customer->execute();
        $result_customer = $stmt_customer->get_result();

        if ($result_customer->num_rows > 0) {
            $account_customer = $result_customer->fetch_assoc();
        } else {
            echo "Account not found.";
            exit;
        }
    } else {
        echo "Invalid account ID.";
        exit;
    }
    $pdf->SetFont('Times', '', 11);
    $pdf->Cell(25, 6, "Contact No.: ","L", 0, 0);
    $pdf->SetFont('Times', 'B', 11);
    $pdf->Cell(63, 6, $account_customer['CONTACT'],"", 0, 1);
    $pdf->SetFont('Times', '', 11);
    $pdf->Cell(30, 6, "Email: ","",  0, 0);
    $pdf->SetFont('Times', 'B', 11);
    $pdf->Cell(58, 6, $account_customer['EMAIL'],"R",  1, 1);

    $pdf->SetFont('Times', '', 11);
    $pdf->Cell(25, 6, "Project:","L", 0, 0);
    $pdf->SetFont('Times', 'B', 11);
    $pdf->Cell(151, 6, "VCE - PROVIDENCE MEMORIAL PARK ANTIPOLO","R",1, 1);
    $pdf->SetFont('Times', '', 11);
    $pdf->Cell(25, 6, "Block: ","LB", 0, 0);
    $pdf->SetFont('Times', 'B', 11);
    $pdf->Cell(110, 6, "$lotdescription","B", 0, 0);
    $pdf->SetFont('Times', '', 11);
    $pdf->Cell(15, 6, "Lot ID: ","B", 0, 0);
    $pdf->SetFont('Times', 'B', 11);
    $pdf->Cell(26, 6, "$location","RB", 1, 1);


    $pdf->Cell(0, 3, "", 'B',1, 1);
    $pdf->Cell(0, 12, "", 'LR',1, 1);
    $pdf->SetFont('Times', '', 11);

    $pdf->Cell(0, 6, "       A Request for", "LR", 1);

    $pdf->SetFont('Times', 'BI', 12);
    $pdf->Cell(0, 6, "               TRANSFER OF RIGHTS", "LR", 1);
    $pdf->Cell(0, 12, " ", "LR", 1);


    $pdf->Cell(40, 6, "               from:", "L", 0,0);
    $pdf->Cell(0, 6, "$transferorFullName", "R", 1,1);

    $pdf->Cell(40, 6, "               to:", "L", 0,0);
    $pdf->Cell(0, 6, "$transfereeFullName", "R", 1,1);
    $pdf->Cell(0, 18, "", "BLR", 1);


    ///comment out this when finish layouting

    $pdf->Cell(0, 3, "", 0, 1);
      $pdf->SetFont('Times', '', 11);

    $pdf->Cell(0, 6, "Requested By:", 0, 1);
      $pdf->SetFont('Times', 'B', 11);

    $pdf->Cell(70, 6, $transferorFullName, 'B', 0, 'C');
    $pdf->Cell(5, 6, "  ", '', 0, 'C');
    $pdf->SetFont('Times', 'I', 11);

    $pdf->Cell(0, 6, "This request Shall be subject for approval. Request Shall not", "LRT", 1,'C');

   $pdf->SetFont('Times', 'I', 7);
    $pdf->Cell(70, 6, "(Buyer/Authorized Representative's Signature Over Printed Name)", '', 0, 'C');
    $pdf->Cell(5, 6, "  ", '', 0, 'C');
    $pdf->SetFont('Times', 'I', 11);
    $pdf->Cell(0, 6, "be processed unless requirements are complete.", "BLR", 1,'C');
    $pdf->SetFont('Times', '', 11);

    $pdf->Cell(44, 12, "Verified by:", "", 0,);
    $pdf->Cell(44, 12, "Endorsed by:", "", 0,);
    $pdf->Cell(44, 12, "Recommended by:", "", 0);
    $pdf->Cell(44, 12, "Approved by:", "", 1);

    $pdf->Cell(42, 6, "", "B", 0);
    $pdf->Cell(2, 6, "", "", 0);
    $pdf->Cell(42, 6, "", "B", 0);
    $pdf->Cell(2, 6, "", "", 0);
    $pdf->Cell(42, 6, "", "B", 0);
    $pdf->Cell(2, 6, "", "", 0);
    $pdf->Cell(44, 6, "", "B", 1);

    $pdf->Cell(44, 6, "LDA/LDS", "", 0,);
    $pdf->Cell(44, 6, "BSM", "", 0,);
    $pdf->Cell(44, 6, "LDO", "", 0);
    $pdf->Cell(44, 6, "LDM", "", 1);

    $pdf->Cell(42, 6, "Date:", "B", 0);
        $pdf->Cell(2, 6, "", "", 0);
    $pdf->Cell(42, 6, "Date:", "B", 0);
        $pdf->Cell(2, 6, "", "", 0);
    $pdf->Cell(42, 6, "Date:", "B", 0);
        $pdf->Cell(2, 6, "", "", 0);
    $pdf->Cell(44, 6, "Date:", "B", 1);


    $pdf->Cell(0, 6, "", "", 1);


    $pdf->SetFont('Times', 'B', 11);

    $pdf->Cell(20, 6, "NOTES:", "LT", 0);
    $pdf->SetFont('Times', '', 11);
    $pdf->Cell(28, 6, "(to be filled up by ",'T',0);
        $pdf->SetFont('Times', 'B', 11);

    $pdf->Cell(9, 6, "LDD",'T',0);
        $pdf->SetFont('Times', '', 11);
    $pdf->Cell(0, 6, "only)",'TR',1);

    $pdf->Cell(4, 8, "",'L',0);
    $pdf->Cell(168, 8, "",'B',0);
    $pdf->Cell(4, 8, "",'R',1);

    $pdf->Cell(4, 8, "",'L',0);
    $pdf->Cell(168, 8, "",'B',0);
    $pdf->Cell(4, 8, "",'R',1);

    $pdf->Cell(4, 8, "",'L',0);
    $pdf->Cell(168, 8, "",'B',0);
    $pdf->Cell(4, 8, "",'R',1);

    $pdf->Cell(4, 8, "",'L',0);
    $pdf->Cell(168, 8, "",'B',0);
    $pdf->Cell(4, 8, "",'R',1);
    $pdf->Cell(4, 8, "",'L',0);
    $pdf->Cell(168, 8, "",'B',0);
    $pdf->Cell(4, 8, "",'R',1);
    $pdf->Cell(4, 8, "",'L',0);
    $pdf->Cell(168, 8, "",'B',0);
    $pdf->Cell(4, 8, "",'R',1);
    $pdf->Cell(4, 8, "",'L',0);
    $pdf->Cell(168, 8, "",'B',0);
    $pdf->Cell(4, 8, "",'R',1);

    $pdf->Cell(4, 8, "",'LB',0);
    $pdf->Cell(168, 8, "",'B',0);
    $pdf->Cell(4, 8, "",'RB',1);


    $pdf->Ln(300);

    $text20 = 'I, '

    . $transferorFullName .

    ', of legal age,Filipino citizen,
    with residential and postal address at '
    . $transferorAddress .
    ' and '
    . $transfereeFullName .
    'of legal age, Filipino citizen,
    with residential and postal address at '
    .$transfereeAddress.
    ',under oath, deposes and state, that:';
    $pdf->SetFont('Times', 'B', 12);
    $pdf->Cell(0, 12, "AFFIDAVIT OF UNDERTAKING",'',1,'C');
        $pdf->Ln(10);
    $pdf->SetFont('Times', '', 12);
    $pdf->MultiCellJustified(176, 6, $text20, 0, 'L');
    $pdf->Ln(5); // Add spacing
    $x = 30; // Custom X offset
    $pdf->MultiCellJustified(180, 6, "1. That I purchased from Sr. Sto. Nino de Cebu Resources and Development Corporation (the 'Company') a parcel of land with house thereon at PROVIDENCE MEMORIAL PARK ANTIPOLO particularly $lotdescription with OTP# $last_id (the Subject 'Property');", 0, 'L');
    $pdf->Ln(5); // Add spacing
    $pdf->MultiCellJustified(180, 6, "2. As part of this transaction, I have provided contact information, including but not lomited to email addresses and phone numbers to wit:", 0, 'L');

    $pdf->Cell(40, 6, "Email Address: ",'',0,'R');
    $pdf->Cell(0, 6, $account_customer['EMAIL'],'',1);
    $pdf->Cell(40, 6, "Contact Number: ",'',0,'R');
    $pdf->Cell(0, 6, $account_customer['CONTACT'],'',1);

    $pdf->Ln(5);

    $pdf->MultiCellJustified(180, 6, "3. That I acknowledge and agree that the contact information provided to the Company will be used solely for the purpose of sending notices and any other correspondence related to the Property. This includesm but is not limited to, updates, maintenance notifications, payment reminders, legal notices, and any other communication/request deemed necessary but the Company in connection with the Property.", 0, 'L');
       $pdf->Ln(5);
    $pdf->MultiCellJustified(180, 6, "4. That I acknowledge that all notices/reminders sent by the contact information provided are deemed received.", 0, 'L');
       $pdf->Ln(5);
    $pdf->MultiCellJustified(180, 6, "5. That Furthermore, I acknowledge and agree that the contact informaiton provided to the Company may be used to send request related to the Property. This inclides, but is not limited to, Move-in Request, Construction Request, Refund Request, Transfer of Rights, Change of Name, Transfer of Lot, and any other communication deemed necessary to the Company in connection with the Property.", 0, 'L');
       $pdf->Ln(5);
    $pdf->MultiCellJustified(180, 6, "6. That I acknowledge that all request sent by the contact information provided are binding.", 0, 'L');
       $pdf->Ln(5);
    $pdf->MultiCellJustified(180, 6, "7. That I confirm that the contact information provided is accurate and up-to-date. I agree to notify the Company promptly in writing of any changes to the contact information to ensure continuous and accurate communication.", 0, 'L');
       $pdf->Ln(5);
    $pdf->MultiCellJustified(180, 6, "9. That I consent to receiving communications form the Company through carious methids, including but not limited to email, phone calls, and text messages. That I acknowledge that electronic communications may be subkect to risks associated wih electronic transmission, including but not limited to unauthorized access, system failures, and transmission errors.", 0, 'L');
       $pdf->Ln(5);
    $pdf->MultiCellJustified(180, 6, "10. This Undertaking shall remain in effect for the duration of the ownership of the Property or until such time as the I provide written notice to the Company requesting the cessation of such communications.", 0, 'L');
       $pdf->Ln(5);
    $pdf->MultiCellJustified(180, 6, "11. Finally, I have read and fully understood the contents of this Undertaking and that I have voluntarily affixed my signature above my printed name to confirm all matters stated herein.", 0, 'L');
     $pdf->Ln(10);
    $pdf->MultiCellJustified(180, 6, "In WITNESS HEREOF, I/We have to hereunto set our hande at ________________,Philippines, on this ___________________",'',1);
         $pdf->Ln(15);

    $pdf->SetFont('Times', 'B', 11);
    $pdf->Cell(0, 6, $transferorFullName,'',1,'C');
    $pdf->Cell(0, 6, "Affiant",'',1,'C');
    $pdf->Ln(10);
    $pdf->SetFont('Times', '', 11);
    $pdf->Cell(0, 6, "SIGNED IN THE PRESENCE OF:",'',1,'C');
                 $pdf->Ln(10);
        $pdf->Cell(58, 6, "",'B',0);
        $pdf->Cell(58, 6, "",'',0);
        // $pdf->Cell(44, 6, "",'',0);
        $pdf->Cell(58, 6, "",'B',1);
            $pdf->Ln(10);
        $pdf->Cell(0, 6, "REPUBLIC OF THE PHILIPPINES )________________)SS",'',1);
                $pdf->Ln(15);
        $pdf->Cell(0, 6, "BEFORE ME, a Notary Public for and in ______________________this day of ____________________.",'',1);


        $pdf->Cell(58, 6, "Personally Appeared:",'',0,'C');
        $pdf->Cell(58, 6, "ID.No/CTC No.:",'',0,'C');
        $pdf->Cell(58, 6, "Date & Place Issued",'',1,'C');
            $pdf->SetFont('Times', 'B', 11);
        $pdf->Cell(56, 6, "$transferorFullName",'B',0,'C');
        $pdf->Cell(2, 6, "",'',0,'C');

        $pdf->Cell(56, 6, "$transferorValidID",'B',0,'C');
        $pdf->Cell(2, 6, "",'',0,'C');

        $pdf->Cell(56, 6, "PHILIPPINES",'B',1,'C');
              $pdf->Ln(10);
        $pdf->SetFont('Times', '', 11);
        $pdf->MultiCellJustified(180, 6, "Known to me and to known to be the same persons who executed the foregoing instrument and they acknowleged to me that the same area their own free voluntary act and deed.",'',1,'L');

        $pdf->Ln(10);

        $pdf->Cell(0, 6, "WITNESS HAND AND SEAL",'',0,'C');
              $pdf->Ln(15);

    $pdf->Cell(0, 5, 'Doc. No.________________;', 0, 'L');
    $pdf->Cell(0, 5, 'Page No.________________;', 0, 'L');
    $pdf->Cell(0, 5, 'Book. No.________________;', 0, 'L');
    $pdf->Cell(0, 5, 'Series of.________________;                                                                         Notarial Seal', 0, 'L');
    $pdf->Cell(0, 5, 'Republic of the Philipppines', 0, 'L');
    $pdf->Cell(0, 5, 'City of _________________ )S.S.', 0, 'L');




    $pdf->Ln(300);

    // Title
    $pdf->SetX($leftMargin); // Set X position for left margin
    $pdf->Ln(10); // Move down to account for top margin
    // Move down to account for top margin
    $pdf->SetFont('Times', 'B', 12);
    $pdf->Cell(0, 10, 'DEED OF TRANSFER OF RIGHTS', 0, 1, 'C');
    $pdf->SetFont('Times', '', 12);
    $pdf->Ln(10); // Add spacing
    $pdf->Cell(0, 10, 'KNOW ALL MEN BY THESE PRESENTS:', 0, 1, 'L');

    // Transferor's status
    if ($transferorStatus === 'Married') {
        $transferorwife = "married to $spouseFirstName $spouseMiddleName $spouseLastName";
    } elseif ($transferorStatus === 'Widow') {
        $transferorwife = "widow of $spouseFirstName $spouseMiddleName $spouseLastName";
    } else {
        $transferorwife = "single";
    }

    $pdf->Ln(2);// Add spacing
    $text = 'That I, '

    . $transferorFullName .

    ', of legal age, Filipino citizen, '
    . $transferorwife .
    ' with residential and postal address at '
    . $transferorAddress .
    ', herein after referred to as the TRANSFEROR';

    $pdf->MultiCellJustified(180, 7.5, $text, 0, 'L');
    $pdf->Cell(0, 10, '-and-', 0, 1, 'C');

    if ($transfereeStatus === 'Married') {
        $transfereeWife = "married to $spouseFirstNameTransferee $spouseMiddleNameTransferee $spouseLastNameTransferee";
    } elseif ($transfereeStatus === 'Widow') {
        $transfereeWife = "widow of $spouseFirstNameTransferee $spouseMiddleNameTransferee $spouseLastNameTransferee";
    } else {
        $transfereeWife = "single";
    }

    $text2 = $transfereeFullName . ' of legal age, Filipino citizen, '
            .$transfereeWife.
            ' with residential and postal address at'
            .$transfereeAddress.
            ' herein after referred to as the TRANSFEREE.'
            ;

    $pdf->MultiCellJustified(180, 7.5, $text2, 0, 'L');
    $pdf->Ln(5);
    $text3 = 'For and in consideration of '
            .$contractPrice .
            ' Total Contract Price and Memorial Maintenance Fund to me in hand paid in fully by TRANSFEREE, do hereby SELL, TRANSFER, AND CONVEY all my rights and interest in the purchaser of Memorial Lot particularly '
            .$lotdescription.
            ' at Providence Memorial Park , Brgy. Inarawan'
            .', Antipolo City, to the said TRANSFEREE, specified in Contract No.'
            .$location.
            ', entered into by me and the Memorial Park owner.'
            ;



    $pdf->MultiCellJustified(175, 7.5, $text3, 0, 'L');

    $pdf->Ln(5);
    $pdf->SetX(30);
    $pdf->Cell(0, 5, '    That upon signing of this instrument TRANSFEREE shall be directly responsible for all', 0, 'L');
    $pdf->SetX(20);
    $pdf->Cell(0, 5, 'instrument due payable to the memorial park owner and shall comply with all obligations pertaining ', 0, 'L');


    $text4 = 'to me and as stipulated in said Contract No. '
    .$location.
    ' and the stipulation of the Reservation Application when not contrary.'
    ;
    $text5 = 'That TRANSFEREE after having read Contract No. '
    .$location.
    ' entered into by the herein TRANSFEROR do hereby accept and promise to comply with all conditions pertaining to the purchaser as contained therein.'
    ;
    $pdf->SetX(20);
    $pdf->MultiCellJustified(175, 7.5, $text4, 0, 'L');
    $pdf->Ln(5);

    $pdf->SetX(30);
    $pdf->MultiCellJustified(175, 7.5, 'IN WITNESS WHEREOF, we have hereunto sign this ____________ day of ______________at __________________________________________ City', 0, 'L');

    $pdf->Ln(20);

    $pdf->Cell(70, 6, $transferorFullName, 'B', 0, 'C');
    $pdf->Cell(30, 6, "  ", '', 0, 'C');
    $pdf->Cell(70, 6, $transfereeFullName, 'B', 1, 'C');

    $pdf->Cell(70, 6, "(Transferor)", '', 0, 'C');
    $pdf->Cell(30, 6, "  ", '', 0, 'C');
    $pdf->Cell(70, 6, "(Transferee)", '', 0, 'C');

    $pdf->Ln(20);

   $pdf->Cell(50, 6, "", '', 0, 'C');
    $pdf->Cell(70, 6, $spouseFirstName . ' ' . $spouseMiddleName . ' ' . $spouseLastName, 'B', 0, 'C');
    $pdf->Cell(50, 6, "", '', 1, 'C');

    $pdf->Cell(0, 6, "Transferor-Spouse", '', 1, 'C');
        $pdf->Ln(10);
    $pdf->SetFont('Times', 'B', 12);
    $pdf->Cell(0, 5, 'ACKNOWLEDGMENT (REPUBLIC OF THE PHILIPPINES)SS', 0, 1, 'C');
    $pdf->SetFont('Times', '', 12);


    $pdf->SetX(0);
    $pdf->Cell($pdf->GetPageWidth(), 5, 'SIGNED IN PRESENCE OF (REPUBLIC OF THE PHILIPPINES)SS', 0, 0, 'C');
    $pdf->Ln(10);

    $pdf->MultiCellJustified(175, 7.5, 'BEFORE ME, a Notary Public for and in _____________this _______day of ________ personally appeared:', 0, 'L');




    $pdf->Cell(58, 6, "Personally Appeared:",'',0,'C');
    $pdf->Cell(58, 6, "ID.No/CTC No.:",'',0,'C');
    $pdf->Cell(58, 6, "Date & Place Issued",'',1,'C');
    $pdf->SetFont('Times', 'B', 11);
    $pdf->Cell(56, 6, "$transferorFullName",'B',0,'C');
    $pdf->Cell(2, 6, "",'',0,'C');

    $pdf->Cell(56, 6, "$transferorValidID",'B',0,'C');
    $pdf->Cell(2, 6, "",'',0,'C');

    $pdf->Cell(56, 6, "PHILIPPINES",'B',1,'C');

    $pdf->Cell(56, 6, "$transfereeFullName",'B',0,'C');
        $pdf->Cell(2, 6, "",'',0,'C');
    $pdf->Cell(56, 6, "$transfereeValidID",'B',0,'C');
        $pdf->Cell(2, 6, "",'',0,'C');
    $pdf->Cell(56, 6, "PHILIPPINES",'B',1,'C');
        $pdf->SetFont('Times', '', 11);



    $pdf->Ln(5);
    $pdf->SetX(30);
    $pdf->Cell(0, 5, '    All known to me and to known to be the same persons who executed the foregoing instrument ', 0, 'L');
    $pdf->SetX(20);
    $pdf->Cell(0, 5, 'and they acknowledged to me that the same are their own free voluntary act and deed.', 0, 'L');

    $pdf->Ln(5);
    $pdf->SetFont('Times', 'B', 12);
    $pdf->Cell(0, 10, 'WITNESS HAND AND SEAL', 0, 1, 'C');
    $pdf->SetFont('Times', '', 12);
    $pdf->Ln(5);
    $pdf->SetX(20);
    $pdf->Cell(0, 5, 'Doc. No.________________;', 0, 'L');
    $pdf->Cell(0, 5, 'Page No.________________;', 0, 'L');
    $pdf->Cell(0, 5, 'Book. No.________________;', 0, 'L');
    $pdf->Cell(0, 5, 'Series of.________________;                                                                         Notarial Seal', 0, 'L');
    $pdf->Cell(0, 5, 'Republic of the Philipppines', 0, 'L');
    $pdf->Cell(0, 5, 'City of _________________ )S.S.', 0, 'L');













    $pdf->Ln(300);




    $pdf->SetX($leftMargin); // Set X position for left margin
    $pdf->Ln(10); // Move down to account for top margin
    $pdf->SetFont('Times', 'B', 12);
    $pdf->Cell(0, 10, 'JOINT AFFIDAVIT OF CONFORMITY', 0, 1, 'C');
    $pdf->SetFont('Times', '', 12);
    $pdf->Ln(10);



    $text7 = 'We, '

    . $transferorFullName .

    ', of legal age,Filipino citizen, '
    . $transferorwife .
    ' with residential and postal address at '
    . $transferorAddress .
    'and'
    . $transfereeFullName .
    'of legal age, Filipino citizen,'
    .$transfereeWife.
    ' with residential and postal address at'
    .$transfereeAddress.
    ',under oath, deposes and state, that:';

    $pdf->MultiCellJustified(180, 7.5, $text7, 0, 'L');

    $pdf->Ln(7);

    $text8 = 'That this Joint Affidavit refer to a '
    . $typeoflot .

    ' designated as '

    . $lotdescription .

    ' located at Brgy. Inarawan, Antipolo City consisting of 1 X 2.5 square meters (the Property) known as PROVIDENCE MEMORIAL PARK - ANTIPOLO developed by Sr. Sto. Nino De Cebu Resources and Development Corporation (SNRDC)(the Developer);'
;

    $pdf->MultiCellJustified(180, 7.5, $text8, 0, 'L');
    $pdf->Ln(7);
    $pdf->MultiCellJustified(180, 7.5, 'That we jointly and severally undertake to pay the Capital Gains Tax and other taxes that the Government may require due to the transfer of any rights and obligations arising from this transaction;', 0, 'L');
    $pdf->Ln(7);
    $pdf->MultiCellJustified(180, 7.5, 'That we will hold the Sr. Sto. Nino De Cebu Resources and Development Corporation (SNRDC) free and clear of any harm, liability, damage, or cost arising from any action, whether directly or indirectly, taken upon or as a consequence of my execution of this Affidavit; ', 0, 'L');
    $pdf->Ln(7);
    $pdf->MultiCellJustified(180, 7.5, 'That we shall be held personally liable to any person, natural or juridical, that may be prejudiced by my representation, in addition to other liabilities, civil or criminal, that may arise therefrom; hereby', 0, 'L');
    $pdf->MultiCellJustified(180, 7.5, 'releasing and discharging the Sr. Sto. Nino De Cebu Resources and Development Corporation (SNRDC) from any and all further obligations in connection with the above.', 0, 'L');
    $pdf->Ln(7);
    $pdf->MultiCellJustified(180, 7.5, 'That we execute this Affidavit freely and voluntarily to attest to the truth of all the foregoing for whatever legal purpose this may serve.', 0, 'L');
    $pdf->Ln(7);
    $pdf->MultiCellJustified(180, 7.5, 'IN WITNESS WHEREOF, I have hereunto set my hand this ____ day of ________, _____ at_____________, Philippines.', 0, 'L');

    $pdf->Ln(20);
    $pdf->Cell(70, 6, $transferorFullName, 'B', 0, 'C');
    $pdf->Cell(30, 6, "  ", '', 0, 'C');
    $pdf->Cell(70, 6, $transfereeFullName, 'B', 1, 'C');

    $pdf->Cell(70, 6, "(Affiant)", '', 0, 'C');
    $pdf->Cell(30, 6, "  ", '', 0, 'C');
    $pdf->Cell(70, 6, "(Affiant)", '', 0, 'C');

    $pdf->Ln(20);

    $pdf->Cell(50, 6, "", '', 0, 'C');
    $pdf->Cell(70, 6, $spouseFirstName . ' ' . $spouseMiddleName . ' ' . $spouseLastName, 'B', 0, 'C');
    $pdf->Cell(50, 6, "", '', 1, 'C');

    $pdf->Cell(0, 6, "Affiant-Spouse", '', 1, 'C');
        $pdf->Ln(10);
    $pdf->SetFont('Times', 'B', 12);
     $pdf->Cell(0, 5, 'ACKNOWLEDGMENT (REPUBLIC OF THE PHILIPPINES)SS', 0, 1, 'C');
    $pdf->SetFont('Times', '', 12);
    $pdf->Ln(10);

    $pdf->MultiCellJustified(175, 7.5, 'BEFORE ME, a Notary Public for and in _____________this _______day of ________ personally appeared:', 0, 'L');


    $pdf->Cell(58, 6, "Personally Appeared:",'',0,'C');
    $pdf->Cell(58, 6, "ID.No/CTC No.:",'',0,'C');
    $pdf->Cell(58, 6, "Date & Place Issued",'',1,'C');
    $pdf->SetFont('Times', 'B', 11);
    $pdf->Cell(56, 6, "$transferorFullName",'B',0,'C');
    $pdf->Cell(2, 6, "",'',0,'C');

    $pdf->Cell(56, 6, "$transferorValidID",'B',0,'C');
    $pdf->Cell(2, 6, "",'',0,'C');

    $pdf->Cell(56, 6, "PHILIPPINES",'B',1,'C');

    $pdf->Cell(56, 6, "$transfereeFullName",'B',0,'C');
        $pdf->Cell(2, 6, "",'',0,'C');
    $pdf->Cell(56, 6, "$transfereeValidID",'B',0,'C');
        $pdf->Cell(2, 6, "",'',0,'C');
    $pdf->Cell(56, 6, "PHILIPPINES",'B',1,'C');
        $pdf->SetFont('Times', '', 11);
    $pdf->SetFont('Times', '', 11);

    $pdf->Ln(5);
    $pdf->SetX(30);

    $pdf->Cell(0, 5, '    All known to me and to known to be the same persons who executed the foregoing instrument ', 0, 'L');
    $pdf->SetX(20);
    $pdf->Cell(0, 5, 'and they acknowledged to me that the same are their own free voluntary act and deed.', 0, 'L');

    $pdf->Ln(5);
    $pdf->SetFont('Times', 'B', 12);
    $pdf->Cell(0, 10, 'WITNESS HAND AND SEAL', 0, 1, 'C');
    $pdf->SetFont('Times', '', 12);
    $pdf->Ln(5);
    $pdf->SetX(20);
    $pdf->Cell(0, 5, 'Doc. No.________________;', 0, 'L');
    $pdf->Cell(0, 5, 'Page No.________________;', 0, 'L');
    $pdf->Cell(0, 5, 'Book. No.________________;', 0, 'L');
    $pdf->Cell(0, 5, 'Series of.________________;                                                                         Notarial Seal', 0, 'L');
    $pdf->Cell(0, 5, 'Republic of the Philipppines', 0, 'L');
    $pdf->Cell(0, 5, 'City of _________________ )S.S.', 0, 'L');



$folderPath = 'torrequest/'.$last_id.'/';

// Get all PDF files that start with "transferee" or "transferor" in the folder
$files = glob($folderPath . '{transferee*,transferor*}.pdf', GLOB_BRACE);
foreach ($files as $existingPdf) {
    // Get the number of pages in the current file
    $pageCount = $pdf->setSourceFile($existingPdf);

    // Import each page of the external PDF
    for ($page = 1; $page <= $pageCount; $page++) {
        // Import the page
        $templateId = $pdf->importPage($page);
        $pdf->AddPage();  // Start a new page for each imported page
        $pdf->useTemplate($templateId, 10, 10, 190);  // Place the imported page on the new page
    }
}

    ob_start();


    $pdfFilePath = $idFolder . '/' . $last_id . '.pdf';
    $pdf->Output('F', $pdfFilePath);

    $pdf->Output('I', 'Transfer_of_Rights.pdf');
$updateQuery = "UPDATE transfer_of_rights SET TOR_PDF = '$pdfFilePath' WHERE ID = '$last_id'";

  if ($conn->query($updateQuery) === TRUE) {
    echo "Record updated successfully!";
} else {
    echo "Error: " . $conn->error;
}


    ob_end_flush();
}}
?>
