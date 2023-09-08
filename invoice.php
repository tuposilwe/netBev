<?php 
// echo $_COOKIE['time'];

session_start();

include("connection.php");

if(isset($_POST["save"])){

 if(!empty($_POST["client_name"]) && !empty($_POST["address"])
 && !empty($_POST["telephone"])   && !empty($_POST["location"])  && 
 !empty($_POST["contact_person"])  ) {

  $client_name=$_POST["client_name"];
  $address=$_POST["address"];
  $telephone=$_POST["telephone"];
  $location=$_POST["location"];
  $contact_person=$_POST["contact_person"];

  include("connection.php"); 

  $sql= "SELECT invoice_no FROM invoice WHERE invoice_no=( SELECT MAX(invoice_no) FROM invoice )";
  $result = mysqli_query($conn, $sql);
 
  if(mysqli_num_rows($result)>0){
     $row=mysqli_fetch_assoc($result);
    //invoice No.
     $invoice_no= $row["invoice_no"]+1;
  }
 
//invoice No. Logic

  $quantities = $_POST['quantity'];
  $quantityTypes = $_POST['quantity_type'];
  $particulars = $_POST['particulars'];
  $prices = $_POST['price'];
  $amounts = $_POST['amount'];
  $invoice_no = $row["invoice_no"]+1;

  $totalAmount = 0; // Initialize the total amount

  for ($i = 0; $i < count($quantities); $i++) {
    $quantity = floatval($quantities[$i]);
    $quantityType = $conn->real_escape_string($quantityTypes[$i]);
    $particular = $conn->real_escape_string($particulars[$i]);
    $price = floatval($prices[$i]);
    $amount = $conn->real_escape_string($amounts[$i]);
    $invoice_no =$row["invoice_no"]+1;

    // Calculate the amount
    $amount = $quantity * $price;

    $totalAmount += $amount; // Add the amount to the total

    $sql = "INSERT INTO invoice_table_data (quantity, quantity_type, particulars, price, amount,invoice_no) 
    VALUES ('$quantity', '$quantityType', '$particular', '$price', '$amount','  $invoice_no')";

    if ($conn->query($sql) !== TRUE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    echo "Data saved successfully! Total Amount: $totalAmount";
}



 //  $ammount=$_POST["ammount"];
  $invoice_status="Not paid";

  $sql="INSERT INTO invoice (client_name,address,telephone,location,contact_person,invoice_status, invoice_no,total_amount)  
  VALUES ('$client_name',' $address','$telephone','$location','$contact_person','$invoice_status',' $invoice_no','$totalAmount')";

  try {
   mysqli_query($conn,$sql);
   echo "Invoice is now Created!";

   header("Location: generatePDF3.php");
 

  } catch (mysqli_sql_exception) {
   echo "Failed to create Invoice!";
  }
 
  mysqli_close($conn);

}else{
 echo "Failed to create Invoice!";
}

}

?>































//  session_start();

//  include("connection.php");

//  if(isset($_POST["save"])){

//   if(!empty($_POST["client_name"]) && !empty($_POST["address"])
//   && !empty($_POST["telephone"])   && !empty($_POST["location"])  && 
//   !empty($_POST["contact_person"])  ) {

//    $client_name=$_POST["client_name"];
//    $address=$_POST["address"];
//    $telephone=$_POST["telephone"];
//    $location=$_POST["location"];
//    $contact_person=$_POST["contact_person"];
//    $invoice_no='Hello';


//   //  $ammount=$_POST["ammount"];
//    $invoice_status="Not paid";

//    $sql="INSERT INTO invoice (client_name,address,telephone,location,contact_person,invoice_status, invoice_no)  VALUES ('$client_name',' $address','$telephone','$location','$contact_person','$invoice_status',' $invoice_no')";

//    try {
//     mysqli_query($conn,$sql);
//     echo "Invoice is now Created!";
//     header("Location: user_panel.php");

//    } catch (mysqli_sql_exception) {
//     echo "Failed to create Invoice!";
//    }
  
//    mysqli_close($conn);

//  }else{
//   echo "Failed to create Invoice!";
// }

//  } 


 
// $cookie=$_COOKIE['cname'];

// if($cookie){
//   echo "<script>alert('Total is: $cookie ')</script>";
// }



