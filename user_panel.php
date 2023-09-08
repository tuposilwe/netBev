<?php 
// echo $_COOKIE['time'];

require_once('checkUserauth.php'); 
checkUserAuthentication();


// session_start();

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
    //  $_COOKIE['invoice_no'] = $invoice_no;
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

    echo " <script>alert('Data saved successfully! Total Amount: $totalAmount ')</script>";
}



 //  $ammount=$_POST["ammount"];
  $invoice_status="Not paid";

  $sql="INSERT INTO invoice (client_name,address,telephone,location,contact_person,invoice_status, invoice_no,total_amount)  
  VALUES ('$client_name',' $address','$telephone','$location','$contact_person','$invoice_status',' $invoice_no','$totalAmount')";

  try {
   mysqli_query($conn,$sql);
   echo "<script>alert('Invoice is now Created! ')</script>";

   header("Location: generatePDF.php");
 

  } catch (mysqli_sql_exception) {
   echo "<script>alert('Failed to create Invoice!')</script>";
  }
 
  mysqli_close($conn);

}else{
 echo "<script>alert('Failed to create Invoice!')</script>";
}


}

?>
<html lang="en">
<head>
    <title>DIAMI COMPANY LIMITED</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap-5.3.0-dist/css/bootstrap.min.css">
  <script src="bootstrap-5.3.0-dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="delivery.css">
   
</head>

<body>
  
  <div class="container-fluid"></div>
    <div class="container-fluid">
        <div class="row">
            <!-- Left Side with Navigation Bar -->
            <nav class="col-lg-2 col-md-4 col-sm-12 bg-dark text-bg-primary">
                <h4> USER PANNEL </h4>
                <ul class="nav flex-column">
                    <!-- Dropdown Menu -->
                    <li class="nav-item">
                      <a class="nav-link" href="#" onclick="showContent('content0')">PROFILE</a>
                  </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="showContent('content1')">PROFOMA INVOICE</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#" onclick="showContent('content3')">INVOICE</a>
                  </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="showContent('content2')">DELIVERY NOTE</a>
                    </li>
                   
                  <!-- Content 6 -->
                     <li class="nav-item">
                        <a class="btn btn-danger"  href="logout.php" >Logout</a>
                    </li>
                    
                    <!-- Add more links for the left side as needed -->
                </ul>
            </nav>

            <!-- Right Side to Display Content -->
            <main class="col-lg-9 col-md-8 col-sm-12" style="min-height: 100vh; background-color: rgb(245, 244, 241);">

 <!--content 0-->
              <section id="content0" class="content" style="display: none;">
                <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
                  <div class="container-fluid">
                    <a class="navbar-brand" href="#">
                      <img src="avatar.png" alt="Logo" style="width:40px;" class="rounded-pill">

                      <span class="navbar-text h2"><i>PERSONAL PROFILE</i></span>
                    </a>
                  </div>
                 </nav>
                <div class="container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                               
                            </tr>
                        </thead>
                        <tbody>

            <?php

                include("connection.php");
                

               $user_name= $_SESSION["username"];
               $sql= "SELECT * FROM register WHERE user_name ='$user_name' limit 1";
               $result = mysqli_query($conn, $sql);

                   if(mysqli_num_rows($result)>0){
                   $row=mysqli_fetch_assoc($result);

                echo '<tr>';
                echo '<td> <h7>NAME</h7> </td>';
                echo '<td>'. $row["user_name"].'</td>';
                echo '<tr>';

                echo '<tr>';
                echo '<td> <h7>PHONE NUMBER</h7> </td>';
                echo '<td>'. $row["phone"] .'</td>';
                echo '<tr>';

                echo '<tr>';
                echo '<td> <h7>E-MAIL</h7> </td>';
                echo '<td>'. $row["email"] .'</td>';
                echo '<tr>';
                }
                mysqli_close($conn);
                ?>
                          
                           
                        </tbody>
                    </table>
                 </div>
              </section>
              
 <!-- Content 1 -->
    <section id="content1" class="content" style="display: none;">     

<form action="user_panel.php" method="post">
    <div class="container mt-3 text-md-center">
        <h5 class="text-primary">PROFOMA INVOICE</h5>
        <h1 class="text-primary">DIAMI COMPANY LIMITED</h1>
        <P class="text-primary">Sokoine opposite to the entrance to City Garden</P>
        <p class="text-primary">P.O.BOX 2016 Mbeya-Tanzania</p>
        <p class="text-primary">Mob: 0768663614/ 0686351155</p>
        <p class="text-primary">E-mail: info@diami.co.tz/ Website www.diami.co.tz</p>
    </div>
    <div class="row container mt-3" id="jo3h">
     <div class="col-sm-8 ">
           <p class="text-primary">Client Name   :<input type="text" id="myinput"  name="client_name"></p>
           <p class="text-primary">address       :<input type="text" id="myinput"  name="address" ></p>
           <p class="text-primary">telephone     :<input type="text" id="myinput"  name="telephone"></p>
           <p class="text-primary">location      :<input type="text" id="myinput" name="location" ></p>
           <p class="text-primary">contact person:<input type="text" id="myinput" name="contact_person" ></p>
    </div>
     <div class="col-sm-4">
           <p></p>
           <p class="text-primary">No.
            
            
            <?php 

          include("connection.php"); 

          $sql= "SELECT invoice_no FROM invoice WHERE invoice_no=( SELECT MAX(invoice_no) FROM invoice )";
          $result = mysqli_query($conn, $sql);
         
          if(mysqli_num_rows($result)>0){
             $row=mysqli_fetch_assoc($result);
             echo $row["invoice_no"]+1 . "</br>";
          }
           ?>
           
          </p>
           <p class="text-primary"> Date: <span id="date"></span></p>
           <p class="text-primary">TIN: 129-223-499</p>
           <P class="text-primary">VRN: 40-026060-H</P>
    </div>
</div>

  <div class="container mt-3 ">    
    <table  id="myTable1" class="table-sm" style="background-color: rgb(250, 249, 241);">
      <thead>
        <tr class="table-active">
        <th class="text-primary">Qty</th>
        <th class="text-primary">Qty-Ty</th>
        <th class="text-primary">Particulars</th>
        <th class="text-primary">Price(@)</th>
        <th class="text-primary">Amount</th>
        <th class="text-primary">ACTION</th>
      </thead>
      <tbody id="tableBody">
      <tr>
  <td><input type="number" name="quantity[]" /></td>
  <td><input type="text" name="quantity_type[]" /></td>
  <td><input type="text" name="particulars[]" /></td>
  <td><input type="number" name="price[]" /></td>
  <td><input type="text" name="amount[]" readonly /></td>
   <td> <button class="btn btn-danger" type="button" onclick="deleteRow(this)">Delete</button></td>
</tr>

      </tbody>
      <tfoot>
        <!-- <tr>
        <td class="text-primary">E&O.E</td>
          <td colspan="1" class="text-end text-primary">TOTAL</td>
          <td></td>
          <td id="totalAmount" class="text-primary">00.0</td>

        </tr> -->
      </tfoot>
    </table>
          
</form>

<button class="btn btn-success" type="button" onclick="addRow1()">Add Row</button>

<div class="row container mt-3" id="jo3h">
        <div class="col-sm-7 ">
              <p class="text-primary">Name:<input type="text" id="myinput"></p>
              
       </div>
        <div class="col-sm-5">
             
              <P class="text-primary">signature:<input type="text" id="myinput"></P>
       </div>

       </div>

<button class="btn btn-success" id="saveBtn" name="save">Save</button>
<a class="btn btn-primary" href="generatePDF.php" >Preview</a>


  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
 
 <script>
               var x=new Date();
               document.getElementById("datee").innerHTML=x;

               function addRow1() {
            var table = document.getElementById("myTable1");
            var row = table.insertRow(-1);

            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            var cell4 = row.insertCell(3);
            var cell5 = row.insertCell(4);
            var cell6 = row.insertCell(5);
            

            cell1.innerHTML = '<input type="number" name="quantity[]" />';
            cell2.innerHTML = '<input type="text" name="quantity_type[]" />';
            cell3.innerHTML = '<td><input type="text" name="particulars[]" /></td>';
            cell4.innerHTML = '<td><input type="number" name="price[]" /></td>';
            cell5.innerHTML = '<input type="text" name="amount[]" readonly /></td>';
            cell6.innerHTML ='<button class="btn btn-danger" type="button" onclick="deleteRow(this)">Delete</button>'
        }

        function deleteRow(button) {
            var row = button.parentNode.parentNode;
            row.parentNode.removeChild(row);
        }


              </script>

  <script>
var x=new Date();
document.getElementById("date").innerHTML=x;

document.cookie="time="+x; 
  </script>
     
</section>


<section id="content3" class="content" style="display: none;">

<form action="invoice.php" method="post">

                  <div class="container mt-3 text-md-center">
                    <h5 class="text-primary">INVOICE</h5>
                    <h1 class="text-primary">DIAMI COMPANY LIMITED</h1>
                    <P class="text-primary">Sokoine opposite to the entrance to City Garden</P>
                    <p class="text-primary">P.O.BOX 2016 Mbeya-Tanzania</p>
                    <p class="text-primary">Mob: 0768663614/ 0686351155</p>
                    <p class="text-primary">E-mail: info@diami.co.tz/ Website www.diami.co.tz</p>
                </div>
                <div class="row container mt-3" id="jo3h">
                 <div class="col-sm-8 ">
                       <p class="text-primary">Client Name   :<input type="text" id="myinput" name="client_name" ></p>
                       <p class="text-primary">address       :<input type="text" id="myinput" name="address" ></p>
                       <p class="text-primary">telephone     :<input type="text" id="myinput" name="telephone" ></p>
                       <p class="text-primary">location      :<input type="text" id="myinput" name="location" ></p>
                       <p class="text-primary">contact person:<input type="text" id="myinput" name="contact_person" ></p>
                </div>
                 <div class="col-sm-4">
                       <p></p>
                       <p class="text-primary">No.
                       <?php 

include("connection.php"); 

$sql= "SELECT invoice_no FROM invoice WHERE invoice_no=( SELECT MAX(invoice_no) FROM invoice )";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result)>0){
   $row=mysqli_fetch_assoc($result);
   echo $row["invoice_no"]+1 . "</br>";
}
 ?>
                       </p>
                       <p class="text-primary"> Date: <span id="datee"></span></p>
                       <p class="text-primary">TIN: 129-223-499</p>
                       <P class="text-primary">VRN: 40-026060-H</P>
                </div>
            </div>
              <div class="container mt-3">
                <table class="table" id="myTable">
                  <thead>
                    <tr class="table-active">
                      <th class="text-primary">QTY</th>
                      <th class="text-primary">Qty-Type</th>
                      <th class="text-primary">PARTICULARS</th>
                      <th class="text-primary">@</th>
                      <th class="text-primary">AMOUNT</th>
                      <th class="text-primary">ACTION</th>
            
                    </tr>
                  </thead>
                  <tbody id="tableBody">
                   
    

  <tr>
  <td><input type="number" name="quantity[]" /></td>
  <td><input type="text" name="quantity_type[]" /></td>
  <td><input type="text" name="particulars[]" /></td>
  <td><input type="number" name="price[]" /></td>
  <td><input type="text" name="amount[]" readonly /></td>
   <td> <button class="btn btn-danger" type="button" onclick="deleteRow(this)">Delete</button></td>
</tr>

                  </tbody>
                  <tfoot>
                    <!-- <tr>
                        
                      <td colspan="1" class="text-end text-primary">TOTAL</td>
                      <td></td>
                      <td id="totalAmount" class="text-primary">00.0</td>
                     
                    </tr> -->
                  </tfoot>
                </table>
              
            
              </div>
              <button class="btn btn-success" type="button" onclick="addRow()">Add Row</button>

                <div class="row container mt-3" id="jo3h">
                
                    <div class="col-sm-7 ">
                    
                          <p class="text-primary">Name:<input type="text" id="myinput"></p>
                          
                   </div>
                    <div class="col-sm-5">
                         
                          <P class="text-primary">signature:<input type="text" id="myinput"></P>
                   </div>  

                   <div class="container mt-3">
                  
                            <!-- Button to save the data -->
                <button class="btn btn-success" id="saveBtn" name="save">Save</button>
                <a class="btn btn-primary" href="generatePDF3.php" >Preview</a>
                  </div>
      
                  </form>
              <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
              <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
              <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
            
              <script>
               var x=new Date();
               document.getElementById("datee").innerHTML=x;

               function addRow() {
            var table = document.getElementById("myTable");
            var row = table.insertRow(-1);

            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            var cell4 = row.insertCell(3);
            var cell5 = row.insertCell(4);
            var cell6 = row.insertCell(5);
            

            cell1.innerHTML = '<input type="number" name="quantity[]" />';
            cell2.innerHTML = '<input type="text" name="quantity_type[]" />';
            cell3.innerHTML = '<td><input type="text" name="particulars[]" /></td>';
            cell4.innerHTML = '<td><input type="number" name="price[]" /></td>';
            cell5.innerHTML = '<input type="text" name="amount[]" readonly /></td>';
            cell6.innerHTML ='<button class="btn btn-danger" type="button" onclick="deleteRow(this)">Delete</button>'
        }

        function deleteRow(button) {
            var row = button.parentNode.parentNode;
            row.parentNode.removeChild(row);
        }
              </script>

              
               
     </section> 


                <!-- Content 2 -->
                
 <!-- Content 2 -->
 <section id="content2" class="content" style="display: none;">

<form action="delivery.php" method="post">

    <div class="container mt-3 text-md-center">
        <h5 class="text-primary">DELIVERY NOTE</h5>
        <h1 class="text-primary">DIAMI COMPANY LIMITED</h1>
        <P class="text-primary">Sokoine opposite to the entrance to City Garden</P>
        <p class="text-primary">P.O.BOX 2016 Mbeya-Tanzania</p>
        <p class="text-primary">Mob: 0768663614/ 0686351155</p>
        <p class="text-primary">E-mail: info@diami.co.tz/ Website www.diami.co.tz</p>
    </div>
    <div class="row container mt-3" id="jo3h">
     <div class="col-sm-8 ">
           <p class="text-primary">Client Name   :<input type="text" id="myinput" name="client_name"></p>
           <p class="text-primary">address       :<input type="text" id="myinput" name="address" ></p>
           <p class="text-primary">telephone     :<input type="text" id="myinput" name="telephone"> ></p>
           <p class="text-primary">location      :<input type="text" id="myinput" name="location" ></p>
           <p class="text-primary">contact person:<input type="text" id="myinput" name="contact_person" ></p>
           <P class="text-primary"><I>please recieve the followinng goods:</I></P>
    </div>
     <div class="col-sm-4">
           <p class="text-primary">No.

               
<?php 

include("connection.php"); 

$sql= "SELECT invoice_no FROM invoice WHERE invoice_no=( SELECT MAX(invoice_no) FROM invoice )";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result)>0){
$row=mysqli_fetch_assoc($result);
echo $row["invoice_no"]+1 . "</br>";
}
?>
           </p>
           <p class="text-primary"> Date: <span id="datei"></span></p>
           <p class="text-primary">TIN: 129-223-499</p>
           <P class="text-primary">VRN: 40-026060-H</P>
    </div>
</div>
<div class="container mt-3">
    <table class="table" id="myTable2">
      <thead>
        <tr class="table-active">
          <th class="text-primary">QTY</th>
          <th class="text-primary">PARTICULARS</th>
          <th class="text-primary">ACTION</th>
        </tr>
      </thead>
      <tbody id="tableBody">
<tr>
<td><input type="number" name="quantity[]" /></td>
<td><input type="text" name="particulars[]" /></td>
<td> <button class="btn btn-danger" type="button" onclick="deleteRow(this)">Delete</button></td>
</tr>
      </tbody>
    </table>


</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
<script src="bootstrap-5.3.0-dist/js/bootstrap.bundle.min.js"></script>

<script>
  var x=new Date();
document.getElementById("datei").innerHTML=x;

</script>
<button class="btn btn-success" type="button" onclick="addRow2()">Add Row</button>

<div class="row container mt-3" id="jo3h">
  <div class="col-sm-7 ">
    <p class="text-primary"><i>all the above goods were received in a good order and condition</i></p>
        <p class="text-primary">Name:<input type="text" id="myinput"></p>
        <p class="text-primary">phone:<input type="text" id="myinput"></p>
        
 </div>
  <div class="col-sm-5">
       <p></p>
        <P class="text-primary">signature:<input type="text" id="myinput"></P>
 </div>  
 <div class="container mt-3">
 <!-- Button to save the data -->
<button class="btn btn-success" id="saveBtn" name="saved" >Save</button>

 <a class="btn btn-primary" href="generatePDF2.php" >Preview</a>
 </div>
</form>  
</section>

<script>
               var x=new Date();
               document.getElementById("datee").innerHTML=x;

               function addRow2() {
            var table = document.getElementById("myTable2");
            var row = table.insertRow(-1);

            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
           

            cell1.innerHTML = '<input type="number" name="quantity[]" />';
            cell2.innerHTML = '<input type="text" name="particulars[]" />';
            cell3.innerHTML ='<button class="btn btn-danger" type="button" onclick="deleteRow(this)">Delete</button>'
        }

        function deleteRow(button) {
            var row = button.parentNode.parentNode;
            row.parentNode.removeChild(row);
        }
              </script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
<script src="bootstrap-5.3.0-dist/js/bootstrap.bundle.min.js"></script>


<script>
var x = new Date();
document.getElementById("datei").innerHTML = x;
</script>

<script>
$(document).ready(function () {
    // Add a new row when the "Add Row" button is clicked
    $("#addRowBtn").click(function () {
        var newRow = '<tr>' +
            '<td><input type="number" name="quantity[]" /></td>' +
            '<td><input type="text" name="particulars[]" /></td>' +
            '<td><input type="checkbox" class="rowCheckbox" /></td>' +
            '</tr>';
        $("#tableBody").append(newRow);
    });

    // Delete selected rows when the "Delete Selected Rows" button is clicked
    $("#deleteRowsBtn").click(function () {
        $(".rowCheckbox:checked").closest("tr").remove();
    });
});
</script>

     
            </main>
        </div>
    </div>
               <!-- Link to Bootstrap 5 JS bundle -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
    <script src="bootstrap-5.3.0-dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // JavaScript to handle the click event
        function showContent(targetId) {
            const contentElements = document.querySelectorAll(".content");

            contentElements.forEach(function (content) {
                content.style.display = "none";
            });

            const targetElement = document.getElementById(targetId);
            targetElement.style.display = "block";
        }

          // JavaScript to handle the dropdown toggle
          function toggleContent(targetId) {
            const targetElement = document.getElementById(targetId);
            const isDisplayed = targetElement.style.display === "block";

            targetElement.style.display = isDisplayed ? "none" : "block";
        }
           // Set initial display for the content sections
    document.addEventListener("DOMContentLoaded", function () {
      showContent("content0"); // Display the invoice section by default
    });
    </script>
               
  
</body>

</html>
