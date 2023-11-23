<?php

include("connection.php");
session_start();


if(isset($_POST["login"])){
    
    if(!empty($_POST["user_name"]) && !empty($_POST["password"]) ) {
            $user_name= $_POST["user_name"];
            $password= $_POST["password"];

            $sql= "SELECT * FROM register WHERE user_name ='$user_name' limit 1";
            $result = mysqli_query($conn, $sql);
            if($result){
				
                if($result && mysqli_num_rows($result) > 0){
				$user_data = mysqli_fetch_assoc($result);
                    
             if(password_verify($password, $user_data['password']))
             {
                $_SESSION["username"] = $_POST["user_name"];

                if( $user_data['id']==='1'){

                    header("Location: admin.php ");
                    die;
                }else{

                    header("Location: user_panel.php ");
                    die;
                }

            }
        }
           echo "<script>alert('Username or password is incorrect!!')</script>";  
      }else{
        echo"Enter username or password!";
          }
 }




}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container1">
        <div class="container2">
            <h1>Login</h1>
            <div class="container3">
                <form action="login.php" method="post">
                    <div>
                        <strong><label>User name:</label><br></strong>
                        <input type="text" placeholder="Enter Your Name" size="40" name="user_name" required>
                    </div>
                    
                    
                    <div>
                        <strong><label for="password">Password:</label><br></strong>
                        <input type="password" placeholder="Password" size="40" name="password" required>
                    </div>
              
                    <input type="submit" value="Login" name="login">
                </form>
               <a class="btn btn-primary" href="reset_password_process.php">Forgot  Password</a>
            </div>
        </div>
    </div>
</body>
</html>

<!-- 
XduhBkdyWB -->