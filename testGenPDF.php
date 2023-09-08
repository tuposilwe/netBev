<?php
require('./fpdf/fpdf.php'); // Include the FPDF library

// Replace with your database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bwigane";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create a new PDF instance
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

// Set column widths
$colWidths = array(30, 40, 40, 30, 30); // Adjust column widths as needed

// Header row
$pdf->Cell($colWidths[0], 10, 'Quantity', 1, 0, 'C');
$pdf->Cell($colWidths[1], 10, 'Quantity Type', 1, 0, 'C');
$pdf->Cell($colWidths[2], 10, 'Particulars', 1, 0, 'C');
$pdf->Cell($colWidths[3], 10, 'Price', 1, 0, 'C');
$pdf->Cell($colWidths[4], 10, 'Amount', 1, 1, 'C');

// Retrieve data from the database
$sql = "SELECT quantity, quantity_type, particulars, price, amount FROM invoice_table_data  WHERE invoice_no=( SELECT MAX(invoice_no) FROM invoice )";
$result = $conn->query($sql);

$totalAmount = 0; // Initialize total amount

if ($result->num_rows > 0) {
    // Output data into the PDF
    while ($row = $result->fetch_assoc()) {
        $pdf->Cell($colWidths[0], 10, $row['quantity'], 1, 0, 'C');
        $pdf->Cell($colWidths[1], 10, $row['quantity_type'], 1, 0, 'C');
        $pdf->Cell($colWidths[2], 10, $row['particulars'], 1, 0, 'C');
        $pdf->Cell($colWidths[3], 10, $row['price'], 1, 0, 'C');
        $pdf->Cell($colWidths[4], 10, $row['amount'], 1, 1, 'C');
        
        $totalAmount += $row['amount']; // Calculate total amount
    }
    
    // Display the total amount row within the table
    $pdf->Cell(array_sum($colWidths)-$colWidths[4], 10, 'Total Amount:', 1, 0, 'R');
    $pdf->Cell($colWidths[4], 10, $totalAmount, 1, 1, 'C');
} else {
    $pdf->Cell(array_sum($colWidths), 10, 'No data found.', 1, 1, 'C');
}

$pdf->Output();

$conn->close();

?>

