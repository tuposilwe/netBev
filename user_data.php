<?php 
 include("connection.php");
 session_start();

// $user_name= $_SESSION["username"];

//  $sql= "SELECT * FROM register WHERE user_name ='$user_name' limit 1";
//  $result = mysqli_query($conn, $sql);

//  if(mysqli_num_rows($result)>0){
//     $row=mysqli_fetch_assoc($result);
//     echo $row["user_name"] . "</br>";
//     echo $row["phone"] . "</br>";
//     echo $row["reg_date"] . "</br>"; 
//     echo $row["password"] . "</br>";
//     echo $row["email"] . "</br>";
//     echo $row["id"] . "</br>";
//  }

//  invoice
//  $sql= "SELECT invoice_no FROM invoice WHERE invoice_no=( SELECT MAX(invoice_no) FROM invoice )";
//  $result = mysqli_query($conn, $sql);

//  if(mysqli_num_rows($result)>0){
//     $row=mysqli_fetch_assoc($result);
//     echo $row["invoice_no"] . "</br>";
//  }



 $sql= "SELECT * FROM invoice WHERE invoice_no =( SELECT MAX(invoice_no) FROM invoice ) limit 1";
 $result = mysqli_query($conn, $sql);

 if(mysqli_num_rows($result)>0){
    $row=mysqli_fetch_assoc($result);
    $lenght=count($row)/5;
    echo $lenght."</br>";

    echo $row["invoice_no"] . "</br>";
    echo $row["client_name"] . "</br>";
    echo $row["address"] . "</br>";
    echo $row["telephone"] . "</br>"; 
    echo $row["location"] . "</br>";
    echo $row["contact_person"] . "</br>";
    echo $row["invoice_date"] . "</br>";

   //  $date= date("D M d Y");
    $date= date("Y-m-d H:i:s");
    $daydiff= floor((abs(strtotime($date) -strtotime($row["invoice_date"])))/(60*60*24));

    print("date diff is: ".$daydiff."</br>");
    print("date: ".$date."</br>");

 }


//  $sql= "SELECT * FROM invoice WHERE DATE(invoice_date) = CURDATE() ";

 $sql= "SELECT * FROM invoice WHERE invoice_date >= CURDATE() - INTERVAL 7 DAY";

 $result = mysqli_query($conn, $sql);


 if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
      echo '<tr>';
      echo '<td>' . $row['client_name'] . '</td>';
      echo '<td>' . $row['invoice_date'] . '</td>';
      echo '<td>' . $row['total_amount'] . '</td>';
      echo '<td>' . $row['invoice_no'] . '</td>';
      echo '<td>' . $row['invoice_status'] . '</td>';

      echo '</tr>';
  }
}

  mysqli_close($conn);
?>