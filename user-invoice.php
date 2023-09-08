<?php 
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
   $invoice_no='Hello';


  //  $ammount=$_POST["ammount"];
   $invoice_status="Not paid";

   $sql="INSERT INTO invoice (client_name,address,telephone,location,contact_person,invoice_status, invoice_no)  VALUES ('$client_name',' $address','$telephone','$location','$contact_person','$invoice_status',' $invoice_no')";

   try {
    mysqli_query($conn,$sql);
    echo "Invoice is now Created!";

   } catch (mysqli_sql_exception) {
    echo "Failed to create Invoice!";
   }
  
   mysqli_close($conn);

 }else{
  echo "Failed to create Invoice!";
}

 }


 
$cookie=$_COOKIE['cname'];

if($cookie){
  echo "<script>alert('Total is: $cookie ')</script>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap-5.3.0-dist/css/bootstrap.min.css">
  <script src="bootstrap-5.3.0-dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="jozeey.css">
</head>
<body>
<a class="btn btn-danger" href="logout.php" >Logout</a>

<form action="user-invoice.php" method="post">


    <div class="container mt-3 text-md-center">
        <h5 class="text-primary">PROFOMA INVOICE </h5>
        <h1 class="text-primary">DIAMI COMPANY LIMITED</h1>
        <P class="text-primary">Sokoine opposite to the entrance to City Garden</P>
        <p class="text-primary">P.O.BOX 2016 Mbeya-Tanzania</p>
        <p class="text-primary">Mob: 0768663614/ 0686351155</p>
        <p class="text-primary">E-mail: info@diami.co.tz/ Website www.diami.co.tz</p>
    </div>
    <div class="row container mt-3" id="jo3h">
     <div class="col-sm-8 ">
           <p class="text-primary">Client Name   :<input type="text" id="client_name" name="client_name"></p>
           <p class="text-primary">address       :<input type="text" id="address"  name="address"></p>
           <p class="text-primary">telephone     :<input type="text" id="telephone"   name="telephone"></p>
           <p class="text-primary">location      :<input type="text" id="location"  name="location"></p>
           <p class="text-primary">contact person:<input type="text" id="contact_person"  name="contact_person" ></p>
    </div>


     <div class="col-sm-4">
           <p></p>
           <p class="text-primary">No:  <?php  


           $user_name= $_SESSION["username"];

           $sql= "SELECT * FROM register WHERE user_name ='$user_name' limit 1";
           $result = mysqli_query($conn, $sql);
          
           if(mysqli_num_rows($result)>0){
              $row=mysqli_fetch_assoc($result);
              
              echo $row["id"]+1 . "</br>";
           }
            mysqli_close($conn);
           
           ?>
           
          </p>
           <p class="text-primary"> Date: <span id="date"></span></p>
           <p class="text-primary">TIN: 129-223-499</p>
           <P class="text-primary">VRN: 40-026060-H</P>
    </div>


    
</div>
  <div class="container mt-3">
    <table class="table">
      <thead>
        <tr class="table-active">
          <th class="text-primary">QTY</th>
          <th class="text-primary">QTY-TYPE</th>
          <th class="text-primary">PARTICULARS</th>
          <th class="text-primary">@</th>
          <th class="text-primary">AMOUNT</th>
          <th class="text-primary">Action</th> <!-- New column for the delete button -->
        </tr>
      </thead>
      <tbody id="tableBody">

        <tr>
          <td><input type="text" id="quantity"></td>
          <td><input type="text" id="quantity_type"></td>
          <td><input type="text" id="particulars" ></td>
          <td><input type="text" id="value"></td>
          <td> <span id="amount" ></span></td>
          <td><button class="btn btn-danger" onclick="deleteRow(this)">Delete</button></td>
        </tr>

     <tr>
          <td><input type="text" id="quantity2"></td>
          <td><input type="text" id="quantity_type"></td>
          <td><input type="text" id="particulars" ></td>
          <td><input type="text" id="value2"></td>
          <td> <span id="amount2" ></span></td>
          <td><button class="btn btn-danger" onclick="deleteRow(this)">Delete</button></td>
        </tr>
    


      </tbody>
      <tfoot>
        <tr>
        <td class="text-primary">E&O.E</td>
          <td colspan="1" class="text-end text-primary">TOTAL</td>
          <td></td>
          <td id="totalAmount" class="text-primary"  name="totalAmount">00.0</td>
         
</form>

        </tr>
      </tfoot>
    </table>



  
    <!-- Button to add rows -->
    <button class="btn btn-primary" id="addRowBtn">Add Row</button>
    <!-- Button to save the data -->
    <button class="btn btn-success" id="saveBtn" name="save">Save</button>

    <button class="btn btn-primary" onClick="getValue()">Calculate</button>

  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>

  <script >
var x=new Date();
document.getElementById("date").innerHTML=x;


function generateRandomNumber(){
const randomNumbers=[];
for(let i=0;i<4;i++){
  randomNumbers.push(Math.floor(Math.random()*9));
}
return randomNumbers;
}



document.getElementById("getInvoice").innerHTML=generateRandomNumber();



function getValue(){
  var qty=document.getElementById("quantity").value;
  var value=document.getElementById("value").value;

  var total=qty*value;
  document.getElementById("amount").innerHTML=total;

  var qty2=document.getElementById("quantity2").value;
  var value2=document.getElementById("value2").value;

  var total2=qty2*value2;
  document.getElementById("amount2").innerHTML=total2;


  document.getElementById("totalAmount").innerHTML=total2+total;

  var sum=total2+total;
  document.cookie="cname="+sum;                        
  
}



    $(document).ready(function () {
      // Function to add a new row to the table
      function addRow() {
        const newRow = `
          <tr>
          <td><input type="text" id="quantity"></td>
          <td><input type="text" id="particulars" ></td>
          <td><input type="text" id="value"></td>
          <td> <span id="amount" ></span></td>
            <td><button class="btn btn-danger" onclick="deleteRow(this)">Delete</button></td>
          </tr>
        `;
        $("#tableBody").append(newRow);
        updateTotal();
      }

      // Function to delete a row
      function deleteRow(row) {
        $(row).closest("tr").remove();
        updateTotal();
      }

      // Function to update the total amount
      function updateTotal() {
        let total = 0;
        $("#tableBody tr").each(function () {
          const amount = parseFloat($(this).find("td input[type='text']").val()) || 0;
          total += amount;
        });
        $("#totalAmount").text(total.toFixed(2));
      }

      // Function to save the data
      function saveData() {
        const data = [];
        $("#tableBody tr").each(function (index, row) {
          const rowData = {};
          $(row).find("input").each(function (i, input) {
            const columnName = ['qty', 'particulars', 'rate', 'amount'][i];
            rowData[columnName] = $(input).val();
          });
          data.push(rowData);
        });

        // Do something with the data (e.g., send it to the server or process it as needed)
        console.log(data);
        alert("Data has been saved!");
      }

      // Attach the click event to the "Add Row" button
      $("#addRowBtn").click(function () {
        addRow();
      });

      // Attach the click event to the "Delete" buttons on existing rows
      $(document).on("click", ".btn-danger", function () {
        deleteRow(this);
      });

      // Attach the click event to the "Save" button
      $("#saveBtn").click(function () {
        saveData();
      });
    });
    
  </script>
     <div class="row container mt-3" id="jo3h">
        <div class="col-sm-7 ">
              <p class="text-primary">Name:<input type="text" id="myinput"></p>
              
       </div>
        <div class="col-sm-5">
             
              <P class="text-primary">signature:<input type="text" id="myinput"></P>
       </div>  
</body>
</html>
