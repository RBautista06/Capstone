
<?php
include "dbconnection.php";
require('./fpdf186/fpdf.php');
require 'vendor/autoload.php';

use setasign\Fpdi\Fpdi;
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

// Create an instance of the PDF class, which extends FPDI
$pdf = new PDF('P', 'mm', array(216, 450)); // Custom page size (216mm x 450mm)

// Add a page for the FPDF content
$pdf->AddPage();

// Add custom content using FPDF methods
$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(0, 10, 'Generated Content Here', 0, 1, 'C');
$pdf->Ln(5);
$pdf->SetFont('Times', '', 12);
$pdf->Cell(0, 10, 'Some other content that you want to add before the imported PDF', 0, 1, 'L');

// Now, use FPDI to import an external PDF (e.g., GCASH PAYMENT.pdf)
$existingPdf = 'paymentinstruction/GCASH PAYMENT.pdf'; 
$pageCount = $pdf->setSourceFile($existingPdf); // Load the existing PDF

for ($page = 1; $page <= $pageCount; $page++) {
    // Import each page from the existing PDF and add it to the current document
    $templateId = $pdf->importPage($page);
    $pdf->AddPage(); // Start a new page for each imported page
    $pdf->useTemplate($templateId, 10, 10, 190); // Place the imported page content on the new page
}

// Output the final combined PDF
$pdf->Output('I', 'CombinedPDF.pdf'); // Output the PDF to the browser
?>