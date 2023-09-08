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
                <div class="container mt-3 overflow-hidden">
                    <table class="table">
                      <thead>
                        <tr class="table-active">
                          <th class="text-primary">QTY</th>
                          <th class="text-primary">PARTICULARS</th>
                        </tr>
                      </thead>
                      <tbody id="tableBody">


                      
        <?php

for ($i = 1; $i <= 1; $i++) {
  echo '<tr>';
  echo '<td><input type="number" name="quantity[]" /></td>';
  echo '<td><input type="text" name="particulars[]" /></td>';

  echo '</tr>';
}

?>
                    
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
