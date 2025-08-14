<?php
include "dbconnection.php";

require('./fpdf186/fpdf.php');

// Retrieve frontdeskname and intermentid from GET parameters
$frontdeskname = isset($_GET['frontdeskname']) ? htmlspecialchars($_GET['frontdeskname']) : '';
$intermentid = isset($_GET['intermentid']) ? intval($_GET['intermentid']) : 0;

// Load FPDF library


// Create a new PDF document


// Fetch details from the interment_forms table based on the INTERMENTFORM_ID
$query = "SELECT * FROM transfer_of_rights WHERE ID = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $intermentid);
$stmt->execute();
$result = $stmt->get_result();

// Check if there are any rows returned
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    

    // Add additional fields as needed
} else {
    // If no rows are returned, display a message
    $pdf->Cell(0, 10, "No details found for INTERMENTFORM_ID: " . $intermentid, 0, 1, "L");
}





///////////////////////////////////////////////////////////////////////////
$query1 = "SELECT CUSTOMER_ID FROM transfer_of_rights WHERE ID = ?";
$stmt1 = $conn->prepare($query1);
if ($stmt1 === false) {
    die("Error preparing statement: " . $conn->error);
}
$stmt1->bind_param("s", $intermentid);
$stmt1->execute();
$stmt1->bind_result($accountid);
$stmt1->fetch();
$stmt1->close();
////////////////////////////////////////////

class PDF extends FPDF {
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

$reschedule_fee_query = "SELECT PRICE FROM interment_price WHERE NAME = 'reschedule fee'";
$reschedule_fee_result = $conn->query($reschedule_fee_query);

// Check if the query was successful and fetch the price
if ($reschedule_fee_result && $reschedule_fee_result->num_rows > 0) {
    $reschedule_fee_row = $reschedule_fee_result->fetch_assoc();
    $reschedule_fee = $reschedule_fee_row['PRICE'];
} else {
    $reschedule_fee = 500; // Fallback value in case of error or no result
}

$reschedule_fee_query1 = "SELECT PRICE FROM interment_price WHERE NAME = 'NOTARIAL_FEE'";
$reschedule_fee_result1 = $conn->query($reschedule_fee_query1);

// Check if the query was successful and fetch the price
if ($reschedule_fee_result1 && $reschedule_fee_result1->num_rows > 0) {
    $reschedule_fee_row1 = $reschedule_fee_result1->fetch_assoc();
    $reschedule_fee1 = $reschedule_fee_row1['PRICE'];
} else {
    $reschedule_fee1 = 500; // Fallback value in case of error or no result
}

$reschedule_fee_query2 = "SELECT PRICE FROM interment_price WHERE NAME = 'TRANSFER_FEE'";
$reschedule_fee_result2 = $conn->query($reschedule_fee_query2);

// Check if the query was successful and fetch the price
if ($reschedule_fee_result2 && $reschedule_fee_result2->num_rows > 0) {
    $reschedule_fee_row2 = $reschedule_fee_result2->fetch_assoc();
    $reschedule_fee2 = $reschedule_fee_row2['PRICE'];
} else {
    $reschedule_fee2 = 500; // Fallback value in case of error or no result
}



$data = [
    'Transferor Name:' => $row['TRANSFEROR_NAME'],
    'Transferee Name:' => $row['TRANSFEREE_NAME'],
    'Location:' => $row['LOCATION_ID'],
    'Type of Lot:' => $row['TYPE_OF_LOT'],
    'Date of Transfer:' => $row['DATE_OF_TRANSFER'],
    'Day of Transfer:' => $row['DAY_OF_TRANSFER'],
    'Time of Transfer:' => $row['TIME_OF_TRANSFER'],
    'Payment Option:' => $row['PAYMENT_OPTION'],
    'Reschedule Fee:' => $reschedule_fee,
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
///////////////////////////////////////////////
$totalPriceString = $row['TOTAL_PRICE'];

// Remove commas and convert to float
$totalPriceEscaped = (float) str_replace(',', '', $totalPriceString);

// Fetch the reschedule fee
$reschedule_fee_query6 = "SELECT PRICE FROM interment_price WHERE NAME = 'reschedule fee'";
$reschedule_fee_result6 = $conn->query($reschedule_fee_query6);

// Initialize reschedule_fee
$reschedule_fee6 = 0; // Default to 0 in case of no result

// Check if the query was successful and fetch the price
if ($reschedule_fee_result6 && $reschedule_fee_result6->num_rows > 0) {
    $reschedule_fee_row6 = $reschedule_fee_result6->fetch_assoc();
    $reschedule_fee6 = (float) str_replace(',', '', $reschedule_fee_row6['PRICE']);
} 

// Calculate the total price by adding the reschedule fee if needed
$totalPrice = $totalPriceEscaped + $reschedule_fee6; 

$totalPriceFormatted = number_format($totalPrice, 2, '.', ',');
$customerupdatename = $row['TRANSFEROR_NAME'];

//////////////////////////////////////////////
$data = [
    
    'Transfer Fee:' => $reschedule_fee2,
    'Notarial Fee:' =>  $reschedule_fee1,
    'Total Price:' => $totalPriceFormatted
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

$datetransfer = $row['DATE_OF_TRANSFER'];


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

// Title
$pdf->SetX($leftMargin); // Set X position for left margin
$pdf->Ln(10); // Move down to account for top margin
// Move down to account for top margin
$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(0, 10, 'DEED OF TRANSFER OF RIGHTS', 0, 1, 'C');
$pdf->SetFont('Times', '', 12);
$pdf->Ln(10); // Add spacing
$pdf->Cell(0, 10, 'KNOW ALL MEN BY THESE PRESENTS:', 0, 1, 'L');
$transferorStatus = $row['TRANSFEROR_STATUS'];
$transfereeStatus  = $row['TRANSFEREE_STATUS'];
$transferorAddress   = $row['TRANSFEROR_ADDRESS'];
// Transferor's status
if ($transferorStatus === 'Married') {
    $transferorwife = "married to  ".$row['TRANSFEROR_SPOUSE'];
} elseif ($transferorStatus === 'Widow') {
    $transferorwife = "widow of ".$row['TRANSFEROR_SPOUSE'];
} else {
    $transferorwife = "single";
}

$pdf->Ln(2);// Add spacing
$text = 'That I, ' 

. $row['TRANSFEROR_NAME'] . 

', of legal age, Filipino citizen, ' 
. $transferorwife . 
' with residential and postal address at ' 
. $transferorAddress . 
', herein after referred to as the TRANSFEROR';

$pdf->MultiCellJustified(180, 7.5, $text, 0, 'L');
$pdf->Cell(0, 10, '-and-', 0, 1, 'C');

if ($transfereeStatus === 'Married') {
    $transfereeWife = "married to ".$row['TRANSFEREE_SPOUSE'];
} elseif ($transfereeStatus === 'Widow') {
    $transfereeWife = "widow of ".$row['TRANSFEREE_SPOUSE'];
} else {
    $transfereeWife = "single";
}

$transfereeFullName = $row['TRANSFEREE_NAME'];
$transfereeAddress = $row['TRANSFEREE_ADDRESS'];

$text2 = $transfereeFullName . ' of legal age, Filipino citizen, '
        .$transfereeWife.
        ' with residential and postal address at'
        .$transfereeAddress.
        ' herein after referred to as the TRANSFEREE.'
        ;

$pdf->MultiCellJustified(180, 7.5, $text2, 0, 'L');
$pdf->Ln(5);
$text3 = 'For and in consideration of '
        .$row['CONTRACT_PRICE'] .
        ' Total Contract Price and Memorial Maintenance Fund to me in hand paid in fully by TRANSFEREE, do hereby SELL, TRANSFER, AND CONVEY all my rights and interest in the purchaser of Memorial Lot particularly '
        .$row['LOT_DESCRIPTION'].
        ' at Providence Memorial Park , Brgy. Inarawan'
        .', Antipolo City, to the said TRANSFEREE, specified in Contract No.'
        .$row['LOCATION_ID'].
        ', entered into by me and the Memorial Park owner.'
        ;



$pdf->MultiCellJustified(175, 7.5, $text3, 0, 'L');

$pdf->Ln(5);
$pdf->SetX(30); 
$pdf->Cell(0, 5, '    That upon signing of this instrument TRANSFEREE shall be directly responsible for all', 0, 'L');
$pdf->SetX(20); 
$pdf->Cell(0, 5, 'instrument due payable to the memorial park owner and shall comply with all obligations pertaining ', 0, 'L');


$text4 = 'to me and as stipulated in said Contract No. '
.$row['LOCATION_ID'].
' and the stipulation of the Reservation Application when not contrary.'
;
$text5 = 'That TRANSFEREE after having read Contract No. '
.$row['LOCATION_ID'].
' entered into by the herein TRANSFEROR do hereby accept and promise to comply with all conditions pertaining to the purchaser as contained therein.'
;
$pdf->SetX(20); 
$pdf->MultiCellJustified(175, 7.5, $text4, 0, 'L');
$pdf->Ln(5);

$pdf->SetX(30); 
$pdf->MultiCellJustified(175, 7.5, 'IN WITNESS WHEREOF, we have hereunto sign this ____________ day of ______________at __________________________________________ City', 0, 'L');

$pdf->Ln(20);
$pdf->SetX(20); 
$pdf->Cell(0, 5, '    '.$row['TRANSFEROR_NAME'].'                                      '.$row['TRANSFEREE_NAME']);
$pdf->Ln(2);
$pdf->SetX(30); 
$pdf->Cell(0, 5, '__________________________                                   __________________________');
$pdf->Ln(5);
$pdf->SetX(30); 
$pdf->Cell(0, 5, '                (Transferor)                                                                     (Transferee)');

$pdf->Ln(20);
$pdf->SetX(0); 
$pdf->Cell($pdf->GetPageWidth(), 5, $row['TRANSFEROR_SPOUSE'], 0, 0, 'C');
$pdf->Ln(2);
$pdf->SetX(0); 
$pdf->Cell($pdf->GetPageWidth(), 5, '__________________________', 0, 0, 'C');
$pdf->Ln(5);
$pdf->SetX(0); 
$pdf->Cell($pdf->GetPageWidth(), 5, 'Transferor Spouse', 0, 0, 'C');
$pdf->Ln(20);
$pdf->SetX(0); 
$pdf->Cell($pdf->GetPageWidth(), 5, 'SIGNED IN PRESENCE OF (REPUBLIC OF THE PHILIPPINES)SS', 0, 0, 'C');
$pdf->Ln(10);

$pdf->MultiCellJustified(175, 7.5, 'BEFORE ME, a Notary Public for and in _____________this _______day of ________ personally appeared:', 0, 'L');

$header = ['Name', 'ID No / CTC No.', 'Date & Place Issued'];
$widths = [60, 60, 55]; // Define the widths for the columns

// Draw header without bottom border
foreach ($header as $i => $col) {
    $pdf->Cell($widths[$i], 10, $col, 0, 0, 'C'); // Centered header with no border
}
$pdf->Ln(7); // Move to the next line

// Draw the underline for the rows below the header only
foreach ($header as $i => $col) {
    $pdf->Cell($widths[$i], 0, '', '', 0, 'C'); // Underline only for the row below the header
}
$pdf->Ln(); // Move to the next line

// Create rows
for ($i = 0; $i < 3; $i++) {
    foreach ($header as $j => $col) {
        $pdf->Cell($widths[$j], 8, '', 'B', 0, 'C'); // Underline only for each row
    }
    $pdf->Ln(); // Move to the next line
}

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

. $row['TRANSFEROR_NAME']. 

', of legal age,Filipino citizen, ' 
. $row['TRANSFEROR_SPOUSE'].
' with residential and postal address at ' 
. $row['TRANSFEROR_ADDRESS']. 
'and'
. $row['TRANSFEREE_NAME'] . 
'of legal age, Filipino citizen,'
.$row['TRANSFEREE_SPOUSE'] .
' with residential and postal address at'
.$row['TRANSFEREE_ADDRESS'] .
',under oath, deposes and state, that:';

$pdf->MultiCellJustified(180, 7.5, $text7, 0, 'L');

$pdf->Ln(7); 

$text8 = 'That this Joint Affidavit refer to a '
. $row['TYPE_OF_LOT'] . 

' designated as ' 

. $row['LOT_DESCRIPTION']  . 

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
$pdf->SetX(20); 
$pdf->Cell(0, 5, '    '.$row['TRANSFEROR_NAME'].'                                      '.$row['TRANSFEREE_NAME']);
$pdf->Ln(2);
$pdf->SetX(30); 
$pdf->Cell(0, 5, '__________________________                                   __________________________');
$pdf->Ln(5);
$pdf->SetX(30); 
$pdf->Cell(0, 5, '                (Affiant)                                                                     (Affiant)');

$pdf->Ln(20);
$pdf->SetX(0); 
$pdf->Cell($pdf->GetPageWidth(), 5, $row['TRANSFEROR_SPOUSE'], 0, 0, 'C');
$pdf->Ln(2);
$pdf->SetX(0); 
$pdf->Cell($pdf->GetPageWidth(), 5, '__________________________', 0, 0, 'C');
$pdf->Ln(5);
$pdf->SetX(0); 
$pdf->Cell($pdf->GetPageWidth(), 5, 'Affiant-Spouse', 0, 0, 'C');
$pdf->Ln(10);
$pdf->SetX(0); 
$pdf->SetFont('Times', 'B', 12);
$pdf->Cell($pdf->GetPageWidth(), 5, 'ACKNOWLEDGMENT (REPUBLIC OF THE PHILIPPINES)SS', 0, 0, 'C');
$pdf->SetFont('Times', '', 12);
$pdf->Ln(10);

$pdf->MultiCellJustified(175, 7.5, 'BEFORE ME, a Notary Public for and in _____________this _______day of ________ personally appeared:', 0, 'L');

$header = ['Name', 'ID No / CTC No.', 'Date & Place Issued'];
$widths = [60, 60, 55]; // Define the widths for the columns

// Draw header without bottom border
foreach ($header as $i => $col) {
    $pdf->Cell($widths[$i], 10, $col, 0, 0, 'C'); // Centered header with no border
}
$pdf->Ln(7); // Move to the next line

// Draw the underline for the rows below the header only
foreach ($header as $i => $col) {
    $pdf->Cell($widths[$i], 0, '', '', 0, 'C'); // Underline only for the row below the header
}
$pdf->Ln(); // Move to the next line

// Create rows
for ($i = 0; $i < 3; $i++) {
    foreach ($header as $j => $col) {
        $pdf->Cell($widths[$j], 8, '', 'B', 0, 'C'); // Underline only for each row
    }
    $pdf->Ln(); // Move to the next line
}

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


ob_start();































//////////////////////////////////////////////


$filePath = 'torrequest/' . $intermentid . 'reschedule.pdf';

// Create the directory if it does not exist
if (!file_exists('torrequest')) {
    mkdir('torrequest', 0777, true);
}

$pdfPath = $filePath;

// Check if file exists and delete it before creating a new one
if (file_exists($pdfPath)) {
    unlink($pdfPath);  // Delete the existing file
}

// Overwrite the existing PDF (or create a new one if it doesn't exist)
$pdf->Output($pdfPath, 'F');

// Check if the PDF was successfully created or updated
if (!file_exists($pdfPath)) {
    die("Error: PDF file was not created.");
}


// Update transaction in the database (overwriting the existing record)
$queryUpdateTransaction = "UPDATE tbl_transaction 
SET INVOICE_FILE = '$pdfPath', 
    ORDER_TYPE = 'Transfer of Right', 
    CUSTOMER_ID = '$accountid', 
    CUSTOMER_NAME = '$customerupdatename', 
    PAYMENT_PRICE = '$totalPriceFormatted' 
WHERE ORDER_ID = '$intermentid'";

if ($conn->query($queryUpdateTransaction) === false) {
    die("Error executing query: " . $conn->error);
}

// Update interment form status
$queryUpdateStatus = "UPDATE transfer_of_rights 
SET STATUS = 'scheduled', TOTAL_PRICE = '$totalPriceFormatted' 
WHERE ID = '$intermentid'";

if ($conn->query($queryUpdateStatus) === false) {
    die("Error executing status update: " . $conn->error);
}

// Update proof of payment status
$queryUpdateProof = "UPDATE tor_proof_of_payments SET STATUS = 'completed' WHERE TOR_ID = ?";
$stmtUpdateProof = $conn->prepare($queryUpdateProof);
if ($stmtUpdateProof === false) {
    die("Error preparing statement: " . $conn->error);
}
$stmtUpdateProof->bind_param("i", $intermentid);
$stmtUpdateProof->execute();
$stmtUpdateProof->close();

// Output the PDF to the browser
header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="' . $intermentid . '.pdf"');
header('Content-Transfer-Encoding: binary');
header('Accept-Ranges: bytes');
$conn->close();

// Output PDF contents
readfile($pdfPath);
exit();
