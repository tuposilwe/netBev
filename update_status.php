<?php
include("connection.php");

if (isset($_POST['update_status']) && isset($_POST['invoice_id'])) {
    $invoice_id = $_POST['invoice_id'];
    // Assuming your invoice_status column in the database is named 'invoice_status'
    $new_status = 'paid'; // Set the new status here

    $update_query = "UPDATE invoice SET invoice_status='$new_status' WHERE invoice_id=$invoice_id";
    if (mysqli_query($conn, $update_query)) {
        // Status updated successfully
        header("Location: admin.php"); // Redirect back to the invoice list
        exit();
    } else {
        // Handle error
        echo "Error updating status: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
