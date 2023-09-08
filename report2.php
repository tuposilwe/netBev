<?php 
require('./fpdf/fpdf.php');

$pdf =new FPDF('P','mm',"A4");

$pdf ->AddPage();

$pdf->SetFont('Arial', 'B', 18);

$pdf->Cell(0, 10, 'WEEKLY REPORT', 0, 1, 'C');



include("connection.php"); 

$sql= "SELECT * FROM invoice WHERE invoice_no=( SELECT MAX(invoice_no) FROM invoice )";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result)>0){
   $row=mysqli_fetch_assoc($result);
}


$pdf->SetFont('Arial', 'B', 12);

// Company Details
$pdf->Cell(0, 10, 'DIAMI COMPANY LIMITED', 0, 1, 'C');
$pdf->Cell(0, 10, 'Sokoine opposite to the entrance to City Garden', 0, 1, 'C');
$pdf->Cell(0, 10, 'P.O.BOX 2016 Mbeya-Tanzania', 0, 1, 'C');

$pdf->Cell(0, 10, 'Mob: 0768663614/ 0686351155', 0, 1, 'C');
$pdf->Cell(0, 10, 'E-mail: info@diami.co.tz/ Website www.diami.co.tz', 0, 1, 'C');
$pdf->Ln();






// Set column widths
$colWidths = array(30, 60, 40, 30, 30); // Adjust column widths as needed

// Header row
$pdf->Cell($colWidths[0], 10, 'INVOICE NO.', 1, 0, 'C');
$pdf->Cell($colWidths[1], 10, 'NAME', 1, 0, 'C');
$pdf->Cell($colWidths[2], 10, 'DATE', 1, 0, 'C');
$pdf->Cell($colWidths[3], 10, 'AMMOUNT', 1, 0, 'C');
$pdf->Cell($colWidths[4], 10, 'STATUS', 1, 1, 'C');

// Retrieve data from the database
// $sql = "SELECT quantity, quantity_type, particulars, price, amount FROM invoice_table_data  WHERE invoice_no=( SELECT MAX(invoice_no) FROM invoice )";
// $result = $conn->query($sql);

// $totalAmount = 0; // Initialize total amount

//Row Logic PDF
// $lenght=count($row)/5;
// for ($i=1; $i <= $lenght; $i++) {}
// $pdf->Cell($colWidths[0], 10, 'Row', 1, 0, 'C');
// $pdf->Cell(30, 10,$i, 1, 0, 'C');

$sql= "SELECT * FROM invoice WHERE invoice_date <= CURDATE() - INTERVAL 7 DAY";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data into the PDF
    while ($row = $result->fetch_assoc()) {
        $pdf->Cell($colWidths[0], 10, $row['invoice_no'] , 1, 0, 'C');
        $pdf->Cell($colWidths[1], 10, $row['client_name'] , 1, 0, 'C');
        $pdf->Cell($colWidths[2], 10, $row['invoice_date'], 1, 0, 'C');
        $pdf->Cell($colWidths[3], 10, $row['total_amount'], 1, 0, 'C');
        $pdf->Cell($colWidths[4], 10, $row['invoice_status'], 1, 1, 'C');
        
        // $totalAmount += $row['amount']; // Calculate total amount
    }
   
    // Display the total amount row within the table
    // $pdf->Cell(array_sum($colWidths)-$colWidths[4], 10, 'Total Amount:', 1, 0, 'R');
    // $pdf->Cell($colWidths[4], 10, $totalAmount, 1, 1, 'C');

}
 else {
    $pdf->Cell(array_sum($colWidths), 10, 'No data found.', 1, 1, 'C');
}


// // Table header
// $pdf->SetFont('Arial', 'B', 12);
// $pdf->Cell(10, 10, 'Row', 1);
// $pdf->Cell(20, 10, 'Qty', 1);
// $pdf->Cell(30, 10, 'Qty-Ty', 1);
// $pdf->Cell(60, 10, 'Particulars', 1);
// $pdf->Cell(25, 10, 'Price(@)', 1);
// $pdf->Cell(30, 10, 'Amount', 1);
// $pdf->Ln();


// // Table content (simulating loop)
// for ($i = 1; $i <= 9; $i++) {
//     $pdf->Cell(10, 10, $i, 1);
//     $pdf->Cell(20, 10, '', 1); // Qty input (empty)
//     $pdf->Cell(30, 10, '', 1); // Qty-Ty input (empty)
//     $pdf->Cell(60, 10, '', 1); // Particulars input (empty)
//     $pdf->Cell(25, 10, '', 1); // Price input (empty)
//     $pdf->Cell(30, 10, '', 1); // Amount input (empty)
//     $pdf->Ln();
// }

// // Total row
// $pdf->SetFont('Arial', '', 12);
// $pdf->Cell(145, 10, 'TOTAL', 1, 0, 'R');
// $pdf->Cell(30, 10, '00.0', 1, 1);

$pdf->Ln();


// $pdf->Cell(130, 10, 'Name:.........................................', 0, 0);
// $pdf->Cell(25, 10, 'signature:.....................................', 0, 1);



$pdf->Output();
?>