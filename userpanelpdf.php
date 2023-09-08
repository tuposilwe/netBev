<?php
require('./fpdf/fpdf.php'); // Include the FPDF library

// Create a new PDF instance
$pdf = new FPDF();
$pdf->AddPage();

// Set font for the document
$pdf->SetFont('Arial', '', 12);

// Add content to the PDF
$pdf->Cell(0, 10, 'PROFORMA INVOICE', 0, 1, 'C');
$pdf->Ln(10);

// Client details
$clientDetails = "Client Name: John Doe\n";
$clientDetails .= "Address: 123 Main St\n";
$clientDetails .= "Telephone: 123-456-7890\n";
$clientDetails .= "Location: City, Country\n";
$clientDetails .= "Contact Person: Jane Smith";

$pdf->MultiCell(0, 10, $clientDetails, 0, 'L');
$pdf->Ln(10);

// Table header
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(10, 10, 'Row', 1);
$pdf->Cell(20, 10, 'Qty', 1);
$pdf->Cell(30, 10, 'Qty-Ty', 1);
$pdf->Cell(60, 10, 'Particulars', 1);
$pdf->Cell(25, 10, 'Price(@)', 1);
$pdf->Cell(30, 10, 'Amount', 1);
$pdf->Ln();

// Table content (simulating loop)
for ($i = 1; $i <= 10; $i++) {
    $pdf->Cell(10, 10, $i, 1);
    $pdf->Cell(20, 10, '', 1); // Qty input (empty)
    $pdf->Cell(30, 10, '', 1); // Qty-Ty input (empty)
    $pdf->Cell(60, 10, '', 1); // Particulars input (empty)
    $pdf->Cell(25, 10, '', 1); // Price input (empty)
    $pdf->Cell(30, 10, '', 1); // Amount input (empty)
    $pdf->Ln();
}

// Total row
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(145, 10, 'TOTAL', 1, 0, 'R');
$pdf->Cell(30, 10, '00.0', 1, 1);

// Output the PDF to the browser
$pdf->Output();
?>
