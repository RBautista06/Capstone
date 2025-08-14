<?php
include "dbconnection.php";

// Retrieve frontdeskname and intermentid from GET parameters
$frontdeskname = isset($_GET['frontdeskname']) ? htmlspecialchars($_GET['frontdeskname']) : '';
$intermentid = isset($_GET['intermentid']) ? intval($_GET['intermentid']) : 0;

// Load FPDF library
require('./fpdf186/fpdf.php');

// Create a new PDF document
$pdf = new FPDF('P', 'mm', 'A4');
$pdf->SetFont('Arial', 'B', 19); // Set a larger and bold font

$pdf->AddPage();

$pageWidth = $pdf->GetPageWidth();
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



// Fetch details from the interment_forms table based on the INTERMENTFORM_ID
$query = "SELECT * FROM interment_forms WHERE INTERMENTFORM_ID = ?";
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

$currentDate = date("M-d-Y");
$currentTime = date("h:i:s a");


$stmt->close();

$pdf->SetFont('Times', 'B', 14);
$pdf->Cell(0, 10, "INTERMENT ORDER FORM", 0, 1, "C");



$pdf->SetFont('Arial', '', 10);

$tableWidth3 = 190; // Total width of the table
$cellHeight3 = 5;   // Height of each cell
$border3 = 0;       // Border style: 0 = no border, 1 = border
$columnWidth3 = $tableWidth3 / 3; // Width for each column


$pageWidth3 = $pdf->GetPageWidth(); 
$marginRight3 = 93; 
$startX3 = $pageWidth3 - $tableWidth3 - $marginRight3; 

$pdf->SetXY($startX3, $pdf->GetY());

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell($columnWidth3 / 2, $cellHeight3, "Interment ID : ", $border3, 0, "R");

$pdf->Cell($columnWidth3 / 2, $cellHeight3, $intermentid, 'B', 1, "C");

$pdf->SetX($startX3);

$pdf->Cell($columnWidth3 / 2, $cellHeight3, "Certificate Number: ", $border3, 0, "R");

$pdf->Cell($columnWidth3 / 2, $cellHeight3, $intermentid, 'B', 1, "C");

$pdf->SetX($startX3);

$pdf->Cell($columnWidth3 / 2, $cellHeight3, "Date :", $border3, 0, "R");

$pdf->Cell($columnWidth3 / 2, $cellHeight3, $currentDate, 'B', 1, "C");

$pdf->SetX($startX3);

$pdf->Cell($columnWidth3 / 2, $cellHeight3, "Time :", $border3, 0, "R");

$pdf->Cell($columnWidth3 / 2, $cellHeight3, $currentTime, 'B', 1, "C");





$pdf->Ln(5);



$boxX = 10;
$boxWidth = 190;
$lineHeight = 5;
$padding = 2;
$innerPadding = 2; // Padding inside the box on the left and right

$boxY = $pdf->GetY();


$pdf->Ln($padding);

$pdf->SetFont('Arial', '', 10);
$pdf->SetX($boxX);
$startY = $pdf->GetY();



// Create the table header
$tableY = $pdf->GetY();
$pdf->SetFont('Arial', 'B', 10);

$pdf->SetX($boxX + $innerPadding);
$pdf->Cell(40, 5, "Name of Deceased", 0, 0, "L");
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(4, 5, ":", 0, 0, "C");
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(139, 5, $row['FIRSTNAME']." ".$row['MIDDLENAME']." ".$row['LASTNAME'], 'B', 1, "L");


////////////////////////////////////////
$pdf->SetX($boxX + $innerPadding);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(40, 5, "Date of Birth", 0, 0, "L");
$pdf->Cell(4, 5, ":", 0, 0, "C");
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(30, 5, $row['DATE_OF_BIRTH'], 'B', 0, "C"); // First date

$pdf->SetX($pdf->GetX() + 2); 
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(30, 5, "Date of Death", 0, 0, "R");
$pdf->Cell(4, 5, ":", 0, 0, "C");
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(30, 5, $row['DATE_OF_DEATH'], 'B', 0, "C"); // Second date

$pdf->SetX($pdf->GetX() + 4); 
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(10, 5, "Age", 0, 0, "R");
$pdf->Cell(4, 5, ":", 0, 0, "C");
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(25, 5, $row['AGE'], 'B', 1, "C"); 
///////////////////////////////////////////////////////////
$pdf->SetX($boxX + $innerPadding);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(40, 5, "Date of Interment", 0, 0, "L");
$pdf->Cell(4, 5, ":", 0, 0, "C");
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(30, 5, $row['DATE_OF_INTERMENT'], 'B', 0, "C"); // First date

$pdf->SetX($pdf->GetX() + 2); 
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(30, 5, "Day", 0, 0, "R");
$pdf->Cell(4, 5, ":", 0, 0, "C");
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(30, 5, $row['DAY_OF_INTERMENT'], 'B', 0, "C"); // Second date

$pdf->SetX($pdf->GetX() + 4); 
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(10, 5, "Time", 0, 0, "R");
$pdf->Cell(4, 5, ":", 0, 0, "C");
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(25, 5, $row['TIME'], 'B', 1, "C"); 

$pdf->Ln(5);

// Draw the table header for vault types
$pdf->SetX($boxX + $innerPadding);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(40, 5, "Vault Type", 0, 0, "L");
$pdf->Cell(4, 5, ":", 0, 0, "C");


/////////////////////////////////////////////

function drawRadioButton($pdf, $x, $y, $size, $checked) {
    $pdf->SetDrawColor(50, 134, 54); // Set color for the border
    $pdf->SetFillColor(50, 134, 54); // Set color for the fill
    $pdf->SetLineWidth(0.5);

    // Draw the outer circle (approximated by a rectangle with rounded corners)
    $pdf->SetXY($x - $size / 2, $y - $size / 2);
    $pdf->Cell($size, $size, '', 1, 0, 'C'); // Draw the outer circle

    if ($checked) {
        // Draw the inner filled circle to indicate selection (approximated by a filled cell)
        $pdf->SetFillColor(25, 67, 27); // Fill color
        $pdf->SetXY($x - $size / 4, $y - $size / 4);
        $pdf->Cell($size / 2, $size / 2, '', 0, 0, 'C', true); // Draw inner circle filled
    }
}

// Define positions and sizes
$radioX = $boxX + $innerPadding + 55; // X position
$radioY = $pdf->GetY() + 10; // Y position (below the table)
$radioSize = 5; // Size of the outer circle


$vaultTypes = [
    'Oversize Vault',
    'Adult Vault',
    'Children Vault',
    'Bone Vault',
    'Infant Vault',
    'Riding Adult Vault',
    'Riding Bone Vault',
    'Bone Rider',
    'URN Base Type'
];


// Draw radio buttons
foreach ($vaultTypes as $index => $type) {
    $isChecked = ($type == $row['VAULT_TYPE']); // Check if the type matches the database value
    $xPos = $radioX + ($index % 3 * 45); // Adjust X position for radio buttons (5 per row)
    $yPos = $radioY + floor($index / 3) * 7; // Adjust Y position based on row
    drawRadioButton($pdf, $xPos, $yPos, $radioSize, $isChecked);
    
    $pdf->SetXY($xPos + $radioSize , $yPos - ($radioSize / 2)); // Adjust X position for label
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(30, 5, $type, 0, 1, "L"); // Increased width of the text cell
}
////////////////////////////////////////////
$pdf->Ln(2);
$pdf->SetX($boxX + $innerPadding);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(40, 5, "Remains Type", 0, 0, "L");
$pdf->Cell(4, 5, ":", 0, 1, "C");


$radioX1 = $boxX + $innerPadding + 55; // X position
$radioY1 = $pdf->GetY() + 5; // Y position (below the table)
$radioSize1 = 5; // Size of the outer circle

$vaultTypes1 = [
    'Adult Fresh Body',
    'Children Fresh Body',
    'Bone',
    'Infant Fresh Body',
    'Exhumation',
    'URN',
];


// Draw radio buttons
foreach ($vaultTypes1 as $index1 => $type1) {
    
    $isChecked1 = ($type1 == $row['REMAINS_TYPE']); // Check if the type matches the database value
    $xPos1 = $radioX1 + ($index1 % 3 * 45); // Adjust X position for radio buttons (5 per row)
    $yPos1 = $radioY1 + floor($index1 / 3) * 7; // Adjust Y position based on row
    drawRadioButton($pdf, $xPos1, $yPos1, $radioSize1, $isChecked1);
    
    $pdf->SetXY($xPos1 + $radioSize1 , $yPos1 - ($radioSize1 / 2)); // Adjust X position for label
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(30, 5, $type1, 0, 1, "L"); // Increased width of the text cell
}

/////////////////////////////////////////

$endY = $pdf->GetY();
$boxHeight = $endY - $boxY;
$adjustedBoxY = $boxY - $padding;
$adjustedBoxHeight = $boxHeight + (2 * $padding);
$pdf->SetDrawColor(50, 134, 54); 
$pdf->SetLineWidth(0.8); 
$pdf->Rect($boxX, $adjustedBoxY, $boxWidth, $adjustedBoxHeight);
/////////////////////////////////////////////////////
$pdf->Ln(4);


$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 10, "SERVICE ORDER", 0, 1, "L");
$pdf->SetX(15);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(0, 2, "A. DAY OF INTERMENT", 0, 1, "L");

/////////////////////////////////////////////////////////////////////////
$radioX2 = $boxX + $innerPadding + 15; // X position
$radioY2 = $pdf->GetY() + 5; // Y position (below the table)
$radioSize2 = 5; // Size of the outer circle



$vaultTypes2 = [
    'Weekends',
    'Weekdays',
];


// Draw radio buttons
foreach ($vaultTypes2 as $index2 => $type2) {
    
    $isChecked2 = ($type2 == $row['DAYOFWEEK']); // Check if the type matches the database value
    $xPos2 = $radioX2 + ($index2 % 1 * 45); // Adjust X position for radio buttons (5 per row)
    $yPos2 = $radioY2 + floor($index2 / 1) * 7; // Adjust Y position based on row
    drawRadioButton($pdf, $xPos2, $yPos2, $radioSize2, $isChecked2);
    
    $pdf->SetXY($xPos2 + $radioSize2 , $yPos2 - ($radioSize2 / 2)); // Adjust X position for label
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(30, 5, $type2, 0, 1, "L"); // Increased width of the text cell
}

//////////////////////////////////////////////////////////////////
$pdf->Ln(5);
$pdf->SetX(15);

//////////////////////////////////////////////////////////////
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(0, 2, "B. INTERMENT", 0, 1, "L");
$pdf->Ln(2);
$pdf->SetX(20);
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(0, 2, "I. LAWN LOT", 0, 1, "L");

$radioX3 = $boxX + $innerPadding + 15; // X position for radio buttons
$radioY3 = $pdf->GetY() + 5; // Y position for radio buttons
$radioSize3 = 5; // Size of the outer circle

$vaultTypes3 = [
    'Lawn Lot',
];

// Draw radio buttons
foreach ($vaultTypes3 as $index3 => $type3) {
    $isChecked3 = ($type3 == $row['INTERMENT_OPTION']); // Check if the type matches the database value
    
    $xPos3 = $radioX3 + (($index3 % 1) * 45); // 5 per row, adjust X position
    $yPos3 = $radioY3 + floor($index3 / 1) * 7; // New row every 5 options, adjust Y position

    drawRadioButton($pdf, $xPos3, $yPos3, $radioSize3, $isChecked3);
    
    $pdf->SetXY($xPos3 + $radioSize3 , $yPos3 - ($radioSize3 / 2)); // Adjust X position for label
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(30, 5, $type3, 0, 1, "L"); // Increased width of the text cell
}

///////////////////////////////////////////////

//////////////////////////////////////////////////////////////
$pdf->SetX(55);
$pdf->SetFont('Arial', 'B', 7);


$pdf->Cell(0, -16, "II. COURT LOT (4 Lots)", 0, 0, "L");
$radioX3 = $boxX + $innerPadding + 50; // X position for radio buttons
$radioY3 = $pdf->GetY() -2.5; // Y position for radio buttons
$radioSize3 = 5; // Size of the outer circle

$vaultTypes3 = [
    'Double Vault (Low Pier Foundation)',
    'Memorial Stucture .40m height (above) plus one reserved underground vault',
    'Regular Entombment for Underground Interment',
    'Options for Below the Ground Interment',
];

// Draw radio buttons
foreach ($vaultTypes3 as $index3 => $type3) {
    $isChecked3 = ($type3 == $row['INTERMENT_OPTION']); // Check if the type matches the database value
    
    $xPos3 = $radioX3 + (($index3 % 1) * 45); // 5 per row, adjust X position
    $yPos3 = $radioY3 + floor($index3 / 1) * 8; // New row every 5 options, adjust Y position

    drawRadioButton($pdf, $xPos3, $yPos3, $radioSize3, $isChecked3);
    
    $pdf->SetXY($xPos3 + $radioSize3 , $yPos3 - ($radioSize3 / 2)); // Adjust X position for label
    $pdf->SetFont('Arial', '', 7.5);
    $pdf->MultiCell(60, 4, $type3, 0, "L"); // Increased width of the text cell
}

///////////////////////////////////////////////
$pdf->SetX(55);
$pdf->SetFont('Arial', 'B', 7);


$pdf->Cell(0, 10, "III. COURT LOT (8 Lots)", 0, 1, "L");
$pdf->SetX(60);
$pdf->Cell(0, -1, "Presidential Nitche", 0, 0, "L");

$radioX3 = $boxX + $innerPadding + 55; 
$radioY3 = $pdf->GetY() + 5; 
$radioSize3 = 5; 

$vaultTypes3 = [
    'Single Vault (above) w/ .30m base (RF)',
    'Single Vault (above) w/ .30m base (RF)
plus one reserved vault (underground)',
];

// Draw radio buttons
foreach ($vaultTypes3 as $index3 => $type3) {
    $isChecked3 = ($type3 == $row['INTERMENT_OPTION']); 
    
    $xPos3 = $radioX3 + (($index3 % 1) * 45); 
    $yPos3 = $radioY3 + floor($index3 / 1) * 8; 

    drawRadioButton($pdf, $xPos3, $yPos3, $radioSize3, $isChecked3);
    
    $pdf->SetXY($xPos3 + $radioSize3 , $yPos3 - ($radioSize3 / 2)); 
    $pdf->SetFont('Arial', '', 7.5);
    $pdf->MultiCell(60, 5, $type3, 0, "L"); 
}
//////////////////////////////////////////////
$radioX4 = $boxX + $innerPadding + 50; 
$radioY4 = $pdf->GetY() + 5; 
$radioSize4 = 5; 

$vaultTypes4 = [
    'Regular Entombment for Undergournd interment',
    'Options for Below the Ground interment',
];

// Draw radio buttons
foreach ($vaultTypes4 as $index4 => $type4) {
    $isChecked4 = ($type4 == $row['INTERMENT_OPTION']); 
    
    $xPos4 = $radioX4 + (($index4 % 1) * 45); 
    $yPos4 = $radioY4 + floor($index4 / 1) * 8; 

    drawRadioButton($pdf, $xPos4, $yPos4, $radioSize4, $isChecked4);
    
    $pdf->SetXY($xPos4 + $radioSize4 , $yPos4 - ($radioSize4 / 2)); 
    $pdf->SetFont('Arial', '', 7.5);
    $pdf->MultiCell(60, 5, $type4, 0, "L"); 
}

////////////////////////////////////////////////////////////
$pdf->SetX(130);
$pdf->SetFont('Arial', 'B', 7);


$pdf->Cell(0, -155, "IV. Estate Lots - Mausoleum", 0, 0, "L");
$pdf->SetX(135);
$pdf->Cell(0, -145, "Presidential Singe Nitche", 0, 0, "L");

$radioX5 = $boxX + $innerPadding + 130; 
$radioY5 = $pdf->GetY() -67; 
$radioSize5 = 5; 

$vaultTypes5 = [
    'Single Vault (above) w/ .80m base (RF)',
    'Single Vault (above) w/ .80m base (RF)
plus one reserved vault (underground)',
];

// Draw radio buttons
foreach ($vaultTypes5 as $index5 => $type5) {
    $isChecked5 = ($type5 == $row['INTERMENT_OPTION']); 
    
    $xPos5 = $radioX5 + (($index5 % 1) * 45); 
    $yPos5 = $radioY5 + floor($index5 / 1) * 8; 

    drawRadioButton($pdf, $xPos5, $yPos5, $radioSize5, $isChecked5);
    
    $pdf->SetXY($xPos5 + $radioSize5 , $yPos5 - ($radioSize5 / 2)); 
    $pdf->SetFont('Arial', '', 7.5);
    $pdf->MultiCell(60, 5, $type5, 0, "L"); 
}





////////////////////////////////////////////////////////

$pdf->SetFont('Arial', 'B', 7);



$pdf->SetX(135);
$pdf->Cell(0, 5, "Presidential Double Nitche", 0, 0, "L");

$radioX6 = $boxX + $innerPadding + 130; 
$radioY6 = $pdf->GetY() +8; 
$radioSize6 = 5; 

$vaultTypes6 = [
    'Double Vault (above) w/ .80m base (RF)',
    'Double Vault (above) w/ .80m base (RF)
plus one reserved vault (underground)',
];

// Draw radio buttons
foreach ($vaultTypes6 as $index6 => $type6) {
    $isChecked6 = ($type6 == $row['INTERMENT_OPTION']); 
    
    $xPos6 = $radioX6 + (($index6 % 1) * 45); 
    $yPos6 = $radioY6 + floor($index6 / 1) * 8; 

    drawRadioButton($pdf, $xPos6, $yPos6, $radioSize6, $isChecked6);
    
    $pdf->SetXY($xPos6 + $radioSize6 , $yPos6 - ($radioSize6 / 2)); 
    $pdf->SetFont('Arial', '', 7.5);
    $pdf->MultiCell(60, 5, $type6, 0, "L"); 
}

////////////////////////////////////////////////////////

$radioX7 = $boxX + $innerPadding + 125; 
$radioY7 = $pdf->GetY() +5; 
$radioSize7 = 5; 

$vaultTypes7 = [
    'Regular Entombment for Underground Interment',
    'Options for Below the Ground interment',
];

// Draw radio buttons
foreach ($vaultTypes7 as $index7 => $type7) {
    $isChecked7 = ($type7 == $row['INTERMENT_OPTION']); 
    
    $xPos7 = $radioX7 + (($index7 % 1) * 45); 
    $yPos7 = $radioY7 + floor($index7 / 1) * 8; 

    drawRadioButton($pdf, $xPos7, $yPos7, $radioSize7, $isChecked7);
    
    $pdf->SetXY($xPos7 + $radioSize7 , $yPos7 - ($radioSize7 / 2)); 
    $pdf->SetFont('Arial', '', 7.5);
    $pdf->MultiCell(55, 4, $type7, 0, "L"); 
}

/////////////////////////////////////////////////////////
$pdf->Ln(100);

$pdf->SetFont('Arial', 'B', 10);
$labelWidth = 25;
$valueWidth = 160;
$pdf->Cell($labelWidth, 5, "", 0, 1, "L");


$pdf->Cell($labelWidth, 5, "Funeral Service", 0, 0, "L");
$pdf->Cell(5, 5, ":", 0, 0, "R");
$pdf->SetFont('Arial', '', 10);
$pdf->Cell($valueWidth, 5, $row['FUNERAL_SERVICE'], 'B', 1, "L");

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell($labelWidth, 5, "Coffin Details", 0, 0, "L");
$pdf->Cell(5, 5, ":", 0, 0, "R");

$pdf->Cell(13, 5, "Length", 0, 0, "R");
$pdf->Cell(5, 5, ":", 0, 0, "R");
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(35, 5, $row['LENGTH'], 'B', 0, "C");

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(13, 5, "Width", 0, 0, "R");
$pdf->Cell(5, 5, ":", 0, 0, "R");
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(35, 5, $row['WIDTH'], 'B', 0, "C");

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(13, 5, "Height", 0, 0, "R");
$pdf->Cell(5, 5, ":", 0, 0, "R");
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(36, 5, $row['HEIGHT'], 'B', 1, "C");




//////////////////////////////////////////////////////


include "dbconnection.php";

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell($labelWidth, 5, "Site", 0, 0, "L");
$pdf->Cell(5, 5, ":", 0, 0, "R");

$locationId = $row['LOCATION_ID'];

// 1. Find the IO_ID using LOCATION_ID
$query = "SELECT IO_ID FROM owners WHERE IO_ID = ?";
$stmt = $conn->prepare($query);
if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}
$stmt->bind_param("s", $locationId);
$stmt->execute();
$stmt->bind_result($ioId);
$stmt->fetch();
$stmt->close();

// 2. Discover the TYPE_OF_LOT and LOT details for the corresponding IO_ID
$query = "SELECT TYPE_OF_LOT, LOT1, LOT2, LOT3, LOT4, LOT5, LOT6, LOT7, LOT8, LOT9, LOT10, LOT11, LOT12, LOT13, LOT14, LOT15, LOT16, LOT17, LOT18, LOT19, LOT20, LOT21, LOT22, LOT23, LOT24 FROM owners WHERE IO_ID = ?";
$stmt = $conn->prepare($query);
if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}
$stmt->bind_param("i", $ioId);
$stmt->execute();
$stmt->bind_result($typeOfLot, $lot1, $lot2, $lot3, $lot4, $lot5, $lot6, $lot7, $lot8, $lot9, $lot10, $lot11, $lot12, $lot13, $lot14, $lot15, $lot16, $lot17, $lot18, $lot19, $lot20, $lot21, $lot22, $lot23, $lot24);
$stmt->fetch();
$stmt->close();

// 3. Determine which LOT columns to read based on TYPE_OF_LOT
$lots = [];
switch ($typeOfLot) {
    case 'Lawnlot':
        $lots[] = $lot1;
        break;
    case 'court4':
        $lots = array_filter([$lot1, $lot2, $lot3, $lot4]);
        break;
    case 'court8':
        $lots = array_filter([$lot1, $lot2, $lot3, $lot4, $lot5, $lot6, $lot7, $lot8]);
        break;
    case 'estate12':
        $lots = array_filter([$lot1, $lot2, $lot3, $lot4, $lot5, $lot6, $lot7, $lot8, $lot9, $lot10, $lot11, $lot12]);
        break;
    case 'estate24':
        $lots = array_filter([$lot1, $lot2, $lot3, $lot4, $lot5, $lot6, $lot7, $lot8, $lot9, $lot10, $lot11, $lot12, $lot13, $lot14, $lot15, $lot16, $lot17, $lot18, $lot19, $lot20, $lot21, $lot22, $lot23, $lot24]);
        break;
}

$lotParts = array_map(function($lot) {
    $parts = explode('-', $lot);
    return end($parts); // Returns the last element
}, $lots);

// Join the extracted parts into a single string, separated by commas or any desired separator
$lotsStr = implode(', ', $lotParts);

// Initialize GARDEN and SECTION variables
$garden = '';
$section = '';

// Determine the GARDEN and SECTION based on LOT1
if (strpos($lot1, 'EVGM') !== false) {
    $garden = 'Evergreen Memories';
} elseif (strpos($lot1, 'COS') !== false) {
    $garden = 'Court of Serenity';
}

if (preg_match('/SEC(\d+)/', $lot1, $matches)) {
    $section = 'Section ' . $matches[1];
}

// Display the results in the PDF
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(35, 5, "Location / Garden", 0, 0, "L");
$pdf->Cell(3, 5, ":", 0, 0, "R");
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(122, 5, $garden, 'B', 1, "L");

$pdf->SetX(40);
$pdf->SetFont('Arial', 'B', 10);

$pdf->Cell(35, 5, "Section", 0, 0, "L");
$pdf->Cell(3, 5, ":", 0, 0, "R");
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(122, 5, $section, 'B', 1, "L");
$pdf->SetX(40);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(35, 5, "Block", 0, 0, "L");
$pdf->Cell(3, 5, ":", 0, 0, "R");

// Set the font for the lots values
$pdf->SetFont('Arial', '', 10);

// Use MultiCell for lotsStr to wrap text within the specified width
$pdf->SetX(40 + 35 + 3); // Adjust starting X position for the MultiCell
$pdf->MultiCell(122, 5, $lotsStr , 'B', "L");

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell($labelWidth, 5, "Epitaph", 0, 0, "L");
$pdf->Cell(5, 5, ":", 0, 0, "R");
$pdf->SetFont('Arial', '', 10);
$pdf->Cell($valueWidth, 5, $row['EPITAPH'], 'B', 1, "L");

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell($labelWidth + 10, 5, "Special Instructions", 0, 0, "L");
$pdf->Cell(5, 5, ":", 0, 0, "R");
$pdf->SetFont('Arial', '', 10);
$pdf->MultiCell($valueWidth-10, 5, $row['SPECIAL_INSTRUCTIONS'], 'B', "L");

/////////////////////////////////////////////

$queryChair = "SELECT PRICE FROM interment_price WHERE NAME = 'Chair'";
$stmtChair = $conn->prepare($queryChair);
if ($stmtChair === false) {
    die("Error preparing statement for Chair: " . $conn->error);
}
$stmtChair->execute();
$stmtChair->bind_result($chairPrice);
if (!$stmtChair->fetch()) {
    die("Error fetching Chair price: " . $stmtChair->error);
}
$stmtChair->close();

// Fetch the price for "Tent"
$queryTent = "SELECT PRICE FROM interment_price WHERE NAME = 'Tent'";
$stmtTent = $conn->prepare($queryTent);
if ($stmtTent === false) {
    die("Error preparing statement for Tent: " . $conn->error);
}
$stmtTent->execute();
$stmtTent->bind_result($tentPrice);
if (!$stmtTent->fetch()) {
    die("Error fetching Tent price: " . $stmtTent->error);
}
$stmtTent->close();

// Convert prices from string to float
$chairPrice = floatval(str_replace(',', '', $chairPrice));
$tentPrice = floatval(str_replace(',', '', $tentPrice));

// Calculate rental costs
$tentRentalCost = $row['TENTRENTALNUM'] * $tentPrice;
$chairRentalCost = $row['CHAIRRENTALNUM'] * $chairPrice;

$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell($labelWidth + 15, 5, "Tent Rentals (" . $row['TENTRENTALNUM'] . " pcs)", 0, 0, "L");
$pdf->Cell(5, 5, ":", 0, 0, "R");
$pdf->SetFont('Arial', '', 10);
$pdf->Image('pictures/pesopeso.png', $pdf->GetX()+5, $pdf->GetY()+1,3.5,3.5, 'PNG');
$pdf->SetX($pdf->GetX());
$pdf->Cell(50, 5,  number_format($tentRentalCost, 2), 'B', 1, "C");

$pdf->SetFont('Arial', 'B', 10);

$pdf->Cell($labelWidth + 15, 5, "Chair Rentals (" . $row['CHAIRRENTALNUM'] . " pcs)", 0, 0, "L");
$pdf->Cell(5, 5, ":", 0, 0, "R");
$pdf->SetFont('Arial', '', 10);
$pdf->Image('pictures/pesopeso.png', $pdf->GetX()+5, $pdf->GetY()+1,3.5,3.5, 'PNG');
$pdf->SetX($pdf->GetX());
$pdf->Cell(50, 5,  number_format($chairRentalCost, 2), 'B', 1, "C");

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell($labelWidth + 15 , 5, "Interment Price", 0, 0, "L");
$pdf->Cell(5, 5, ":", 0, 0, "R");
$pdf->SetFont('Arial', '', 10);
$pdf->Image('pictures/pesopeso.png', $pdf->GetX()+5, $pdf->GetY()+1,3.5,3.5, 'PNG');
$pdf->SetX($pdf->GetX());
$pdf->Cell(50, 5, number_format($row['INTERMENT_PRICE'],2), 'B', 1, "C");
$pdf->Ln(5);

/////////////////////////////////////
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(0, 10, "UNDERTAKINGS", 0, 1, "C");

$pdf->SetFont('Arial', '', 9);

// Indentation for the first line
$indentWidth = 10; // Adjust this value for the desired indentation
$lineHeight = 5; // Height of each line

// First line with indentation

$pdf->MultiCell(0, $lineHeight, "               I hereby, certify that I am the Buyer and/or designated beneficiary and / or next of kin or authorized representative of the buyer of the above described property and hereby authorizes the interment and placement of a marker thereon and agrees to the above instructions and authorization.", 0, 'L');
$pdf->Ln(5);
$pdf->MultiCell(0, $lineHeight, "               It is likewise understood that in case the purchaser of the above-mentioned lot is subsequently declared in default in respect of the Offer to Purchase (OTP), SNRDC is hereby authorized, without need of judicial action or order to transfer the above mentioned remais to a lawn lot upon fifteen (15) days written notice to the undersigned at any of the addresses indicated below", 0, 'L');

$pdf->Ln(10);

$query1 = "SELECT ACCOUNT_ID FROM interment_forms WHERE INTERMENTFORM_ID = ?";
$stmt1 = $conn->prepare($query1);
if ($stmt1 === false) {
    die("Error preparing statement: " . $conn->error);
}
$stmt1->bind_param("s", $intermentid);
$stmt1->execute();
$stmt1->bind_result($accountid);
$stmt1->fetch();
$stmt1->close();

// Step 2: Get the NAME from tbl_accounts using the retrieved accountid
$query2 = "SELECT NAME, CONTACT, ADDRESS, EMAIL FROM tbl_accounts WHERE ACCOUNT_ID = ?";
$stmt2 = $conn->prepare($query2);
if ($stmt2 === false) {
    die("Error preparing statement: " . $conn->error);
}
$stmt2->bind_param("i", $accountid);
$stmt2->execute();
$stmt2->bind_result($accountName, $accountContact, $accountAddress, $accountEmail);
$stmt2->fetch();
$stmt2->close();

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell($labelWidth + 5, 5, "Name", 0, 0, "L");
$pdf->Cell(5, 5, ":", 0, 0, "R");
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell($valueWidth /3 , 5, $accountName, 'B', 1, "L");

$pdf->Cell($labelWidth + 5, 5, "Email", 0, 0, "L");
$pdf->Cell(5, 5, ":", 0, 0, "R");
$pdf->SetFont('Arial', '', 10);
$pdf->Cell($valueWidth /3 , 5, $accountEmail, 'B', 0, "L");

$pdf->SetX(110);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell($valueWidth /2 , 5, $accountName, 'B', 1, "C");

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell($labelWidth + 5, 5, "Contact Number", 0, 0, "L");
$pdf->Cell(5, 5, ":", 0, 0, "R");
$pdf->SetFont('Arial', '', 10);
$pdf->Cell($valueWidth /3 , 5, $accountContact, 'B', 0, "L");

$pdf->SetX(110);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell($valueWidth /2 , 5, "Signature Over Printed Name", 0, 1, "C");



$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell($labelWidth + 5, 5, "Address", 0, 0, "L");
$pdf->Cell(5, 5, ":", 0, 0, "R");
$pdf->SetFont('Arial', '', 10);

$valueWidth = 160;
$cellWidth = $valueWidth / 3;
$cellHeight = 5; 

$addressText = $accountAddress ;

$x = $pdf->GetX();
$y = $pdf->GetY();

$lineHeight = 5; 


function wrapText($pdf, $text, $maxWidth) {
    $lines = [];
    $words = explode(' ', $text);
    $line = '';

    foreach ($words as $word) {
        $testLine = $line ? "$line $word" : $word;
        $testWidth = $pdf->GetStringWidth($testLine);

        if ($testWidth > $maxWidth) {
            if ($line) {
                $lines[] = $line;
                $line = $word;
            } else {
                $lines[] = $word;
            }
        } else {
            $line = $testLine;
        }
    }

    if ($line) {
        $lines[] = $line;
    }

    return $lines;
}

$lines = wrapText($pdf, $addressText, $cellWidth);

foreach ($lines as $line) {
    $pdf->SetXY($x, $y);
    $pdf->Cell($cellWidth, $cellHeight, $line, 0, 1, "L");
    $pdf->Line($x, $y + $cellHeight, $x + $cellWidth, $y + $cellHeight); 
    $y += $lineHeight;
}

$pdf->SetXY($x, $y);



$pdf->Ln(8);

/////////////////////////////////////////////////
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell($labelWidth + 5, 5, "NOTES:", 0, 1, "L");

$pdf->SetFont('Arial', '', 10);

$pdf->SetX(15);
$pdf->Cell(190, 5, "1. Sr. Sto.Nino De Cebu Resources and Development Corporation shall not be responsible for any valuables left",0,1,  'L');
$pdf->SetX(19);
$pdf->Cell(190, 5, "at the grave site.",0,1,  'L');

$pdf->SetX(15);
$pdf->Cell(190, 5, "2. All remains are placed in concrete vaults to minimize settlement. Vaults are made porous, reinforced concrete",0,1,  'L');
$pdf->SetX(19);
$pdf->Cell(190, 5, "and therefore, not watertight.",0,1,  'L');

$pdf->SetX(15);
$pdf->Cell(190, 5, "3. SNRDC shall not be responsible for any damage to the finished iccured during opening of tombs.",0,1,  'L');

$pdf->SetX(15);
$pdf->Cell(190, 5, "4. Only real flowers may be set at the gravesite and these shall be removed after two days.",0,1,  'L');




/////////////////////////////////////////////
$pdf->Ln(20);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(190, 5, "\"FOR OFFICIAL USE ONLY\"", 0, 1, "C");

$pdf->Ln(2);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(190, 5, "PAYMENT INFORMATION", 0, 1, "C");

$pdf->Ln(2);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell($labelWidth + 8, 5, "Amount", 0, 0, "L");
$pdf->Cell(5, 5, ":", 0, 0, "R");
$pdf->SetFont('Arial', '', 10);
$pdf->Image('pictures/pesopeso.png', $pdf->GetX()+5, $pdf->GetY(),3.5,3.5, 'PNG');
$pdf->SetX($pdf->GetX());
$pdf->Cell($valueWidth / 3 - 10, 5, ($row['TOTAL_PRICE']), 'B', 0, "C");

$pdf->SetX(100);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell($labelWidth, 5, "Prepared By", 0, 0, "L");
$pdf->Cell(5, 5, ":", 0, 0, "R");
$pdf->SetFont('Arial', '', 10);
$pdf->SetX($pdf->GetX());
$pdf->Cell($valueWidth / 3 +8, 5, $frontdeskname, 'B', 1, "C");

$query5 = "SELECT PAYMENT_OPTION FROM interment_forms WHERE INTERMENTFORM_ID = ?";
$stmt5 = $conn->prepare($query5);
if ($stmt5 === false) {
    die("Error preparing statement: " . $conn->error);
}
$stmt5->bind_param("s", $intermentid);
$stmt5->execute();
$stmt5->bind_result($paymentoption);
$stmt5->fetch();
$stmt5->close();


$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell($labelWidth + 8, 5, "Payment Option", 0, 0, "L");
$pdf->Cell(5, 5, ":", 0, 0, "R");
$pdf->SetFont('Arial', '', 10);
$pdf->SetX($pdf->GetX());
$pdf->Cell($valueWidth / 3 - 10, 5, $paymentoption, 'B', 0, "C");

$pdf->SetX(100);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell($labelWidth , 5, "Approved By", 0, 0, "L");
$pdf->Cell(5, 5, ":", 0, 0, "R");
$pdf->SetFont('Arial', '', 10);
$pdf->SetX($pdf->GetX());
$pdf->Cell($valueWidth / 3 +8, 5, "Ruth David", 'B', 1, "C");

$query4 = "SELECT REFERENCE_NUMBER, RESCHEDULE_REFERENCE FROM proof_of_payments WHERE INTERMENT_ORDER = ?";
$stmt4 = $conn->prepare($query4);
if ($stmt4 === false) {
    die("Error preparing statement: " . $conn->error);
}
$stmt4->bind_param("s", $intermentid);
$stmt4->execute();
$stmt4->bind_result($referencenumber, $reschedulereference);
$stmt4->fetch();
$stmt4->close();

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell($labelWidth + 8, 5, "Reference Number", 0, 0, "L");
$pdf->Cell(5, 5, ":", 0, 0, "R");
$pdf->SetFont('Arial', '', 10);
$pdf->SetX($pdf->GetX());
$pdf->Cell($valueWidth / 3 - 10, 5, $referencenumber, 'B', 0, "C");


$reschedule_fee_query = "SELECT PRICE FROM interment_price WHERE NAME = 'reschedule fee'";
$reschedule_fee_result = $conn->query($reschedule_fee_query);

// Check if the query was successful and fetch the price
if ($reschedule_fee_result && $reschedule_fee_result->num_rows > 0) {
    $reschedule_fee_row = $reschedule_fee_result->fetch_assoc();
    $reschedule_fee = $reschedule_fee_row['PRICE'];
} else {
    $reschedule_fee = 500; // Fallback value in case of error or no result
}




$pdf->SetX(100);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell($labelWidth , 5, "Date", 0, 0, "L");
$pdf->Cell(5, 5, ":", 0, 0, "R");
$pdf->SetFont('Arial', '', 10);
$pdf->SetX($pdf->GetX());
$pdf->Cell($valueWidth / 3 +8,  5, $currentDate, 'B', 1, "C");

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell($labelWidth + 8, 5, "Date", 0, 0, "L");
$pdf->Cell(5, 5, ":", 0, 0, "R");
$pdf->SetFont('Arial', '', 10);
$pdf->SetX($pdf->GetX());
$pdf->Cell($valueWidth / 3 - 10, 5, $currentDate, 'B', 0, "C");

$pdf->SetX(100);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell($labelWidth , 5, "Recieved By", 0, 0, "L");
$pdf->Cell(5, 5, ":", 0, 0, "R");
$pdf->SetFont('Arial', '', 10);
$pdf->SetX($pdf->GetX());
$pdf->Cell($valueWidth / 3 +8, 5, "HANS KENDRICK RESPICIO", 'B', 1, "C");
$pdf->SetFont('Arial', 'B', 10);

$pdf->Cell($labelWidth + 8, 5, "Reschhedule Fee", 0, 0, "L");
$pdf->Cell(5, 5, ":", 0, 0, "R");
$pdf->SetFont('Arial', '', 10);
$pdf->Image('pictures/pesopeso.png', $pdf->GetX()+5, $pdf->GetY(),3.5,3.5, 'PNG');
$pdf->SetX($pdf->GetX());
$pdf->Cell($valueWidth / 3 - 10, 5, $reschedule_fee, 'B', 0, "C");

$pdf->Ln(6);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell($labelWidth + 8, 5, "Reschedule Ref.", 0, 0, "L");
$pdf->Cell(5, 5, ":", 0, 0, "R");
$pdf->SetFont('Arial', '', 10);
$pdf->SetX($pdf->GetX());
$pdf->Cell($valueWidth / 3 - 10, 5, $reschedulereference, 'B', 0, "C");




$pdf->Ln(100);
////////////////////////////////////////////



$pdf->Cell(0, 15, " ", 0, 1, "C");
$pdf->Image('pictures/snrDc.jpeg',50,5,100);
$pdf->Cell(0, 7, " ", 0, 1, "C");
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(0, 4, "Unit 26 Alyssa's Arcade,", 0, 1, "C");
$pdf->Cell(0, 4, "San Benito, Alaminos,", 0, 1, "C");
$pdf->Cell(0, 4, "Laguna", 0, 1, "C");
$pdf->Cell(0, 4, "Tel No : 0495307947 Fax No", 0, 1, "C");
$pdf->Ln(5);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 5, "Mr/Mrs. $accountName", 0, 1, "L");
$pdf->Cell(0, 5, "$accountAddress", 0, 1, "L");


$pdf->Cell(125, 5, "", 0, 0, "L");
$pdf->Cell(20, 5, "Invoice No ", 0, 0, "L");
$pdf->Cell(5, 5, ": ", 0, 0, "C");
$pdf->Cell(40, 5, "$intermentid", 0, 1, "L");


$pdf->Cell(125, 5, "", 0, 0, "L");
$pdf->Cell(20, 5, "Invoice Date ", 0, 0, "L");
$pdf->Cell(5, 5, ": ", 0, 0, "C");
$pdf->Cell(40, 5, "$currentDate", 0, 1, "L");


$pdf->Cell(125, 5, "", 0, 0, "L");
$pdf->Cell(20, 5, "Terms ", 0, 0, "L");
$pdf->Cell(5, 5, ": ", 0, 0, "C");
$pdf->Cell(40, 5, "NOAP Days", 0, 1, "L");

$pdf->Cell(125, 5, "", 0, 0, "L");
$pdf->Cell(20, 5, "Client Code", 0, 0, "L");
$pdf->Cell(5, 5, ": ", 0, 0, "C");
$pdf->Cell(40, 5, $row['ACCOUNT_NUMBER'], 0, 1, "l");


$pdf->Ln(5);

$pdf->Cell(95, 10, "   Description", 'TBL', 0, "L");
$pdf->Cell(95, 10, "Amount ( PHP )   ", 'TBR', 1, "R");
$pdf->Ln(2);

$pdf->Cell(135, 5, "", 'TL', 0, "L");
$pdf->Cell(55, 5, "", 'LTR', 1, "R");
$pdf->Cell(135, 5, "   Income on Processing Internment for: ".$row['FIRSTNAME']." ".$row['MIDDLENAME']." ".$row['LASTNAME'], 'L', 0, "L");

$pdf->Image('pictures/pesopeso.png', $pdf->GetX()+5, $pdf->GetY(),3.5,3.5, 'PNG');
$pdf->SetX($pdf->GetX());
$pdf->Cell(55, 5, ($row['TOTAL_PRICE']), 'LR', 1, "C");






$pdf->Cell(135, 5, "   Location:", 'L', 0, "L");
$pdf->Cell(55, 5, "", 'LR', 1, "R");
$pdf->Cell(135, 5, "   $garden", 'L', 0, "L");
$pdf->Cell(55, 5, "", 'LR', 1, "R");
$pdf->Cell(135, 5, "   $section", 'L', 0, "L");
$pdf->Cell(55, 5, "", 'LR', 1, "R");
$pdf->Cell(135, 5, "   $lotsStr", 'L', 0, "L");
$pdf->Cell(55, 5, "", 'LR', 1, "R");


$pdf->Cell(135, 5, "   Reschedule Fee:", 'L', 0, "L");
$pdf->Image('pictures/pesopeso.png', $pdf->GetX()+5, $pdf->GetY(),3.5,3.5, 'PNG');
$pdf->SetX($pdf->GetX());
$pdf->Cell(55, 5, $reschedule_fee, 'LR', 1, "C");
$pdf->Cell(135, 60, "", 'L', 0, "L");
$pdf->Cell(55, 60, "", 'LR', 1, "R");

$pdf->Cell(135, 5, "", 'BL', 0, "L");
$pdf->Cell(55, 5, "", 'LBR', 1, "R");

$pdf->Cell(0, 15, "", '1', 1, "C");

$pdf->Ln(10);

$pdf->Cell(125, 5, "", 0, 0, "L");
$pdf->Cell(20, 5, "Total Amount", 0, 0, "L");
$pdf->Cell(5, 5, ": ", 0, 0, "C");
$pdf->Image('pictures/pesopeso.png', $pdf->GetX()+5, $pdf->GetY(),3.5,3.5, 'PNG');
$pdf->SetX($pdf->GetX());
$pdf->Cell($valueWidth / 3 - 15, 5, ($row['TOTAL_PRICE']), '', 1, "C");

$pdf->Cell(125, 5, "", 0, 0, "L");
$pdf->Cell(20, 5, "Reschedule Fee", 0, 0, "L");
$pdf->Cell(5, 5, ": ", 0, 0, "C");

$pdf->Image('pictures/pesopeso.png', $pdf->GetX()+5, $pdf->GetY(),3.5,3.5, 'PNG');
$pdf->SetX($pdf->GetX());
$pdf->Cell($valueWidth / 3 - 15, 5, $reschedule_fee, '', 1, "C");
$pdf->Cell(125, 5, "", 0, 0, "L");
$pdf->Cell(20, 5, "Invoice Amount", 0, 0, "L");
$pdf->Cell(5, 5, ": ", 0, 0, "C");

$pdf->Image('pictures/pesopeso.png', $pdf->GetX()+5, $pdf->GetY(),3.5,3.5, 'PNG');
$pdf->SetX($pdf->GetX());
$pdf->Cell($valueWidth / 3 - 15, 5, ($row['TOTAL_PRICE']), '', 1, "C");

$pdf->Ln(15);
$pdf->Cell(0, 5, "For Sto.Nino De Cebu Res. & Dev. Corp.", 0, 1, "C");
$pdf->Cell(0, 5, "Note:", 0, 1, "L");
$pdf->Cell(0, 5, "All cheques should be crossed and made payable to", 0, 1, "L");


//////////////////////////////////////////////
header("Content-type: application/pdf");
header("Content-Disposition: inline; filename='custom_filename.pdf'");
header("Content-Transfer-Encoding: binary");
header("Accept-Ranges: bytes");

$filePath = 'transactions/' . $intermentid . '.pdf';

// Create the directory if it does not exist
if (!file_exists('transactions')) {
    mkdir('transactions', 0777, true);
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

// Escape variables for safety
$accountNameEscaped = $conn->real_escape_string($accountName);
$frontdesknameEscaped = $conn->real_escape_string($frontdeskname);
$totalPriceEscaped = $conn->real_escape_string($row['TOTAL_PRICE']);

// Update transaction in the database (overwriting the existing record)
$queryUpdateTransaction = "UPDATE tbl_transaction 
SET INVOICE_FILE = '$pdfPath', 
    ORDER_TYPE = 'Interment', 
    CUSTOMER_NAME = '$accountNameEscaped', 
    CUSTOMER_ID = '$accountid', 
    PREPARED_BY = '$frontdesknameEscaped', 
    PAYMENT_PRICE = '$totalPriceEscaped' 
WHERE ORDER_ID = '$intermentid'";

if ($conn->query($queryUpdateTransaction) === false) {
    die("Error executing query: " . $conn->error);
}

// Update interment form status
$queryUpdateStatus = "UPDATE interment_forms SET STATUS = 'scheduled' WHERE INTERMENTFORM_ID = ?";
$stmtUpdateStatus = $conn->prepare($queryUpdateStatus);
if ($stmtUpdateStatus === false) {
    die("Error preparing statement: " . $conn->error);
}
$stmtUpdateStatus->bind_param("i", $intermentid);
$stmtUpdateStatus->execute();
$stmtUpdateStatus->close();

// Update proof of payment status
$queryUpdateProof = "UPDATE proof_of_payments SET STATUS = 'completed' WHERE INTERMENT_ORDER = ?";
$stmtUpdateProof = $conn->prepare($queryUpdateProof);
if ($stmtUpdateProof === false) {
    die("Error preparing statement: " . $conn->error);
}
$stmtUpdateProof->bind_param("i", $intermentid);
$stmtUpdateProof->execute();
$stmtUpdateProof->close();

$conn->close();

// Output the PDF to the browser
header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="' . $intermentid . '.pdf"');
header('Content-Transfer-Encoding: binary');
header('Accept-Ranges: bytes');

// Output PDF contents
readfile($pdfPath);
exit();
?>