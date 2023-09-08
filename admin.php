<?php 

require_once('checkUserauth.php'); // Replace with the path to your functions file
checkUserAuthentication();


 include("connection.php");

 if(isset($_POST["submit"])){
   $user_name=$_POST["user_name"];
   $password=$_POST["password"];
   $email=$_POST["email"];
   $phone=$_POST["phone"];

   $hash=password_hash($password,PASSWORD_DEFAULT);

   $sql="INSERT INTO register (user_name,password,email,phone)  VALUES ('$user_name','$hash','$email','$phone')";


   try {
    mysqli_query($conn,$sql);
    echo "User is now Registered!";

   } catch (mysqli_sql_exception) {
    echo "That user name is Alerady taken!";
   }
  
   mysqli_close($conn);

 }



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>DIAMI COMPANY LIMITED</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap-5.3.0-dist/css/bootstrap.min.css">
  <script src="bootstrap-5.3.0-dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="delivery.css">
    <link rel="stylesheet" href="register.css">
</head>

<body>
  
  <div class="container-fluid"></div>
    <div class="container-fluid">
        <div class="row">
            <!-- Left Side with Navigation Bar -->
            <nav class="col-lg-2 col-md-4 col-sm-12 bg-dark text-bg-primary">
                <h4>ADMIN PANNEL</h4>
                <ul class="nav flex-column">
                    <!-- Dropdown Menu -->
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="showContent('content1')">REGISTRATION</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="showContent('content2')">USERS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="showContent('content3')">INVOICE NOTE</a>
                    </li>
                  
                   <!-- Content 5 Subcategories -->
                   <li class="nav-item">
                    <a class="nav-link" href="#" onclick="toggleContent('content5')">REPORT</a>
                    <ul id="content5" class="nav flex-column ms-4" style="display: none;">
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="showContent('content5-sub1')"><i>daily</i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="showContent('content5-sub2')"><i>weekly</i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="showContent('content5-sub3')"><i>monthily</i></a>
                        </li>
                    </ul>
                </li>
                    </li>
                     <!-- Content 6 -->
                     <li class="nav-item">
                        <a class="btn btn-danger" href="logout.php" >Logout</a>
                    </li>
                    
                    <!-- Add more links for the left side as needed -->
                </ul>
            </nav>

            <!-- Right Side to Display Content -->
            <main class="col-lg-10 col-md-9 col-sm-14" style="min-height: 100vh; background-color: rgb(235, 233, 217);">
                <!-- Content 1 -->
                <section id="content1" class="content" style="display: none;">
                <div class="container1">
                    <div class="container2">
                        <div class="container3">
                            <form action="admin.php" method="post">
                                    <h2> USER REGISTRATION</h2>
                                <div>
                                    <strong><label>Username:</label><br></strong>
                                    <input type="name" placeholder="Enter Your first-name" size="40" name="user_name" required>
                                </div>
                                <div>
                                    <strong><label for="E-mail">E-mail:</label><br></strong>
                                    <input type="email" placeholder="E-mail" size="40" name="email" required>
                                </div>
                                <div>
                                    <strong><label for="Phone number">phone number:</label><br></strong>
                                    <input type="phone-number" placeholder="phone number" size="40" name="phone" required>
                                </div>
                                <div>
                                    <strong><label for="password">Password:</label><br></strong>
                                    <input type="password" placeholder="Password" size="40" name="password" required>
                                </div>
                                <input type="submit" name="submit" value="Submit" required>
                            </form>
                           </div>
                    </div>
                </div>
                </section>

                <!-- Content 2 -->
                <section id="content2" class="content" style="display: none;">
                    <div class="container-fluid mt-3 x">
                        <Table class="table">
                            <Thead>
                              <tr>
                                <th>Username</th>
                                <th>E-mail</th>
                                <th>Phone number</th>
                                <th>Reg_date</th>
                              </tr>
                            </Thead>

              <tbody>
                  <?php
                     include("connection.php");            
                             
                     $sql= "SELECT * FROM register ";

                     $result = mysqli_query($conn, $sql);

                 if(mysqli_num_rows($result)>0) {
                    while($row = mysqli_fetch_assoc($result)){
                        echo '<tr>';
                        echo '<td>' . $row['user_name'] . '</td>';
                        echo '<td>' . $row['email'] . '</td>';
                        echo '<td>' . $row['phone'] . '</td>';
                        echo '<td>' . $row['reg_date'] . '</td>';              
                        echo '</tr>';
                    }
                }
                mysqli_close($conn);

                ?>
                            </tbody>
                           </Table>
                    </div>
                </section>
                <!--content 3-->
                <section id="content3" class="content" style="display: none;">
                    <div class="container-fluid mt-3">
                        <Table class="table">
                            <Thead>
                              <tr>
                                <th>CLIENT_NAME</th>
                                <th>ISSUE DATE</th>
                                <th>AMMOUNT</th>
                                <th>INVOICE No.</th>
                                <th>STATUS</th>
                                <th>ACTIONS</th>
                              </tr>
                            </Thead>
                            <tbody>
                    <?php

                     include("connection.php");            
                             
                     $sql= "SELECT * FROM invoice";

                     $result = mysqli_query($conn, $sql);


                     if (mysqli_num_rows($result) > 0) {
                      while ($row = mysqli_fetch_assoc($result)) {
                          echo '<tr>';
                          echo '<td>' . $row['client_name'] . '</td>';
                          echo '<td>' . $row['invoice_date'] . '</td>';
                          echo '<td>' . $row['total_amount'] . '</td>';
                          echo '<td>' . $row['invoice_no'] . '</td>';
                          echo '<td>' . $row['invoice_status'] . '</td>';
                          echo '<td>';
                          echo '<form method="post" action="update_status.php" onsubmit="return confirmUpdate();">'; // Change action accordingly
                          echo '<input type="hidden" name="invoice_id" value="' . $row['invoice_id'] . '">';
                          echo '<button type="submit" class="btn btn-primary" name="update_status">Edit</button>';
                          echo '</form>';
                          echo '</td>';
                          echo '</tr>';
                      }
                  }
                  
                mysqli_close($conn);

                ?>
                            </tbody>
                           </Table>
                    </div>
                </section>
          
                <script> 
                   function confirmUpdate() {
                     return confirm("Are you sure you want to update the status to 'paid'?"); // Display confirmation dialog
                    }
               </script>

                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
                
        
                 <!--content 5-->
                
                <!-- Content 5 - Subcategory 1 -->
                <section id="content5-sub1" class="content" style="display: none;">
                    <div class="container mt-3">
                        <h1 style="text-align: center;">DAILY REPORT</h1>
                        <table class="table">
                          <thead>
                            <tr class="table-active">
                              <th class="text-primary">INVOICE NO.</th>
                              <th class="text-primary">NAME</th>
                              <th class="text-primary">DATE</th>
                              <th class="text-primary">AMMOUNT </th>
                              <th class="text-primary">STATUS</th>
                             </tr>
                          </thead>
                          <tbody id="tableBody">
<?php

include("connection.php");

 $sql= "SELECT * FROM invoice WHERE DATE(invoice_date) = CURDATE() ";

$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) > 0) {
 while ($row = mysqli_fetch_assoc($result)) {
     echo '<tr>';
     echo '<td>' . $row['invoice_no'] . '</td>';
     echo '<td>' . $row['client_name'] . '</td>';
     echo '<td>' . $row['invoice_date'] . '</td>';
     echo '<td>' . $row['total_amount'] . '</td>';
     echo '<td>' . $row['invoice_status'] . '</td>';
     echo '</tr>';
 }
}

 mysqli_close($conn);
?>
                            </tr>
                          </tbody>

                        

                        </table>
                        <a class="btn btn-primary" href="report.php" >Print</a>
                    </div>
                </section>

                <!-- Content 5 - Subcategory 2 -->
                <section id="content5-sub2" class="content" style="display: none;">
                    <div class="container mt-3">
                        <h1 style="text-align: center;">WEEKLY REPORT</h1>
                        <table class="table">
                          <thead>
                            <tr class="table-active">
                              <th class="text-primary">INVOICE NO.</th>
                              <th class="text-primary">NAME</th>
                              <th class="text-primary">DATE</th>
                              <th class="text-primary">AMMOUNT </th>
                              <th class="text-primary">STATUS</th>
                             </tr>
                          </thead>
                          <tbody id="tableBody">
                          <?php

include("connection.php");

// $sql= "SELECT * FROM invoice WHERE invoice_date >= CURDATE() - INTERVAL 7 DAY";
$sql= "SELECT * FROM invoice WHERE invoice_date <= CURDATE() - INTERVAL 7 DAY";

$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) > 0) {
 while ($row = mysqli_fetch_assoc($result)) {
     echo '<tr>';
     echo '<td>' . $row['invoice_no'] . '</td>';
     echo '<td>' . $row['client_name'] . '</td>';
     echo '<td>' . $row['invoice_date'] . '</td>';
     echo '<td>' . $row['total_amount'] . '</td>';
     echo '<td>' . $row['invoice_status'] . '</td>';
     echo '</tr>';
 }
}

 mysqli_close($conn);
?>
                          </tbody>
                        </table>
                        <a class="btn btn-primary" href="report2.php" >Print</a>
                    </div>
                </section>

                <!-- Content 5 - Subcategory 3 -->
                <section id="content5-sub3" class="content" style="display: none;">
                    <div class="container mt-3">
                        <h1 style="text-align: center;">MONTHILY REPORT</h1>
                        <table class="table">
                          <thead>
                            <tr class="table-active">
                            <th class="text-primary">INVOICE NO.</th>
                              <th class="text-primary">NAME</th>
                              <th class="text-primary">DATE</th>
                              <th class="text-primary">AMMOUNT </th>
                              <th class="text-primary">STATUS</th>
                             </tr>
                          </thead>
                          <tbody id="tableBody">
                          <?php

include("connection.php");

$sql= "SELECT * FROM invoice WHERE invoice_date <= CURDATE() - INTERVAL 30 DAY";


$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) > 0) {
 while ($row = mysqli_fetch_assoc($result)) {
     echo '<tr>';
     echo '<td>' . $row['invoice_no'] . '</td>';
     echo '<td>' . $row['client_name'] . '</td>';
     echo '<td>' . $row['invoice_date'] . '</td>';
     echo '<td>' . $row['total_amount'] . '</td>';
     echo '<td>' . $row['invoice_status'] . '</td>';
     echo '</tr>';
 }
}

 mysqli_close($conn);
?>
                          </tbody>
                        </table>
                        <a class="btn btn-primary" href="report3.php" >Print</a>
                    </div>
                </section>
                <!--content 6-->
                <section id="content1" class="content" style="display: none;">
                    <h2>Logout</h2>
                    <p>Click the "Logout" button to perform logout functionality.</p>
            </main>
        </div>
    </div>

    <!-- Link to Bootstrap 5 JS bundle -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
    <script>
 document.addEventListener("DOMContentLoaded", function () {
      showContent("content1"); // Display the invoice section by default
    });


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
    </script>
</body>

</html>
