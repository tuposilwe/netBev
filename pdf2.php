<?php
// Include the FPDF library
require('./fpdf/fpdf.php');

// Create a new PDF document
$pdf = new FPDF();
$pdf->AddPage();

// Set font
$pdf->SetFont('Arial', '', 12);

// Header
$pdf->Cell(0, 10, 'DELIVERY NOTE', 0, 1, 'C');
$pdf->Ln();

// Company Details
$pdf->Cell(0, 10, 'Diami company limited', 0, 1, 'L');
$pdf->Cell(0, 10, '123432', 0, 1, 'L');
$pdf->Cell(0, 10, 'P.O.BOX 2016, MBEYA SOKOINE', 0, 1, 'L');
$pdf->Ln();

// Company Information
$pdf->Cell(0, 10, 'TIN: 129-223-499', 0, 1, 'L');
$pdf->Cell(0, 10, 'VRN: 40-026060-H', 0, 1, 'L');
$pdf->Cell(0, 10, 'Phone: 0768663614', 0, 1, 'L');
$pdf->Cell(0, 10, 'Email: info@diami.co.tz', 0, 1, 'L');
$pdf->Ln();

// Bill To
$pdf->Cell(0, 10, 'Bill To:', 0, 1, 'L');
$pdf->Cell(0, 10, 'TIN:', 0, 1, 'L');
$pdf->Ln();

// Details Section
$pdf->Cell(0, 10, 'Date:', 0, 0, 'L');
$pdf->Cell(0, 10, 'Invoice No:', 0, 0, 'L');
$pdf->Cell(0, 10, 'Due Date:', 0, 0, 'L');
$pdf->Cell(0, 10, 'salesPerson:', 0, 0, 'L');
$pdf->Cell(0, 10, 'Customer PO:', 0, 1, 'L');
$pdf->Ln();

// Table Header
$pdf->Cell(20, 10, 'Qty', 1, 0, 'C');
$pdf->Cell(35, 10, 'Item', 1, 0, 'C');
$pdf->Cell(60, 10, 'Description', 1, 0, 'C');
$pdf->Cell(30, 10, 'Unit price', 1, 0, 'C');
$pdf->Cell(20, 10, 'TAX%', 1, 0, 'C');
$pdf->Cell(30, 10, 'VAT', 1, 0, 'C');
$pdf->Cell(35, 10, 'Total', 1, 1, 'C');

// Table Content
$pdf->Cell(20, 10, '16', 1, 0, 'C');
$pdf->Cell(35, 10, 'Big trucks', 1, 0, 'C');
$pdf->Cell(60, 10, 'Cleaning service for the month of JUNE 2023', 1, 0, 'C');
$pdf->Cell(30, 10, 'Tsh45,000.00', 1, 0, 'C');
$pdf->Cell(20, 10, '18%', 1, 0, 'C');
$pdf->Cell(30, 10, 'Tsh129,600.00', 1, 0, 'C');
$pdf->Cell(35, 10, 'Tsh 720,000.00', 1, 1, 'C');

$pdf->Cell(20, 10, '10', 1, 0, 'C');
$pdf->Cell(35, 10, 'Small trucks', 1, 0, 'C');
$pdf->Cell(60, 10, 'Cleaning service for the month of JUNE 2023', 1, 0, 'C');
$pdf->Cell(30, 10, 'Tsh25,000.00', 1, 0, 'C');
$pdf->Cell(20, 10, '18%', 1, 0, 'C');
$pdf->Cell(30, 10, 'Tsh45,000.00', 1, 0, 'C');
$pdf->Cell(35, 10, 'Tsh 250,000.00', 1, 1, 'C');

// Summary
$pdf->Cell(0, 10, 'Subtotal  Tsh 970,000.00', 0, 1, 'R');
$pdf->Cell(0, 10, 'VAT(18%)   Tsh 174,600.00', 0, 1, 'R');
$pdf->Cell(0, 10, 'Total  Tsh1,144,600.00', 0, 1, 'R');
$pdf->Cell(0, 10, 'Balance Due  Tsh1,444,600.00', 0, 1, 'R');
$pdf->Ln();

// Note and Thank You
$pdf->Cell(0, 10, 'Please contact us for more information about payment options.', 0, 1, 'L');
$pdf->Cell(0, 10, 'Thank you for your business.', 0, 1, 'L');
$pdf->Ln();

// Print button
$pdf->Cell(0, 10, 'Please click the "print" button to print this document.', 0, 1, 'R');

// Output PDF file path
$output_pdf_file = 'output.pdf';

// Save the PDF to file
// $pdf->Output($output_pdf_file, 'F');

// echo "PDF generated successfully at: {$output_pdf_file}";
$pdf->Output();

?>
