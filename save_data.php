<?php
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $quantities = $_POST['quantity'];
    $quantityTypes = $_POST['quantity_type'];
    $particulars = $_POST['particulars'];
    $prices = $_POST['price'];
    $amounts = $_POST['amount'];

    $totalAmount = 0; // Initialize the total amount

    

    for ($i = 0; $i < count($quantities); $i++) {
        $quantity = $conn->real_escape_string($quantities[$i]);
        $quantityType = $conn->real_escape_string($quantityTypes[$i]);
        $particular = $conn->real_escape_string($particulars[$i]);
        $price = $conn->real_escape_string($prices[$i]);
        $amount = $conn->real_escape_string($amounts[$i]);

        // Calculate the amount
        $amount = $quantity * $price;

        $totalAmount += $amount; // Add the amount to the total

        $sql = "INSERT INTO invoice_table_data (quantity, quantity_type, particulars, price, amount) VALUES ('$quantity', '$quantityType', '$particular', '$price', '$amount')";

        if ($conn->query($sql) !== TRUE) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Insert the total amount into the database
    // $sqlTotal = "INSERT INTO total_amount_table (total_amount) VALUES ('$totalAmount')";

    $sqlTotal = "INSERT INTO invoice (total_amount) VALUES ('$totalAmount')";
    if ($conn->query($sqlTotal) !== TRUE) {
        echo "Error: " . $sqlTotal . "<br>" . $conn->error;
    }

    echo "Data saved successfully! Total Amount: $totalAmount";
}

$conn->close();

?>







