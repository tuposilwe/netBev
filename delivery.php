<?php 
// echo $_COOKIE['time'];

session_start();

include("connection.php");

if(isset($_POST["saved"])){

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
  $particulars = $_POST['particulars'];

  $invoice_no = $row["invoice_no"]+1;

  $totalAmount = 0; // Initialize the total amount

  for ($i = 0; $i < count($quantities); $i++) {
    $quantity = $conn->real_escape_string($quantities[$i]);
    $particular = $conn->real_escape_string($particulars[$i]);
    $invoice_no =$row["invoice_no"]+1;


    $sql = "INSERT INTO delivery (quantity, particulars,invoice_no) 
    VALUES ('$quantity', '$particular','  $invoice_no')";

    if ($conn->query($sql) !== TRUE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    echo "Data saved successfully!";
}



 //  $ammount=$_POST["ammount"];
 

  $sql="INSERT INTO main_delivery (client_name,address,telephone,location,contact_person, invoice_no)  
  VALUES ('$client_name',' $address','$telephone','$location','$contact_person','$invoice_no')";

  try {
   mysqli_query($conn,$sql);
   echo "Delivery is now Created!";

   header("Location: generatePDF2.php");
 

  } catch (mysqli_sql_exception) {
   echo "Failed to create Delivery!";
  }
 
  mysqli_close($conn);

}else{
 echo "Failed to create Delivery!";
}
}

?>