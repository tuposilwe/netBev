<?php
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

// require 'PHPMailer/PHPMailer.php';
// require 'PHPMailer/SMTP.php';
// require 'PHPMailer/Exception.php';

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require ('./vendor/autoload.php');

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

include("connection.php");

if (isset($_POST["submit"])) {
    $email = $_POST["email"];

    // Check if the email exists in the database
    $sql = "SELECT * FROM register WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Generate a new random password
        $newPassword = generateRandomString(10);

        // Hash the new password
        $hash = password_hash($newPassword, PASSWORD_DEFAULT);

        // Update the user's password with the new password
        $updateSql = "UPDATE register SET password = '$hash' WHERE email = '$email'";
        mysqli_query($conn, $updateSql);

        // Send the new password to the user's email
        sendNewPasswordEmail($email, $newPassword);

        echo "Password reset successful! Check your email for the new password.";
    } else {
        echo "<script>alert('Email not found. Please check your email address and try again.')</script> ";
    }

    mysqli_close($conn);
}

// Function to generate a random string for the new password
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

// Function to send the new password to the user's email
function sendNewPasswordEmail($email, $newPassword) {
    $mail = new PHPMailer(true);
    
    try {
        // Server settings
        $mail->SMTPDebug = 0; // 0 - Disable debugging, 1 - Output debug info, 2 - Debugging and connection status
        $mail->isSMTP();
        $mail->Host       = 'smtp.elasticemail.com'; // Replace with your SMTP server host
        $mail->SMTPAuth   = true;
        $mail->Username   = 'rudigermkondya@gmail.com'; // Replace with your SMTP username
        $mail->Password   = 'E5212DC1D11D986D95E4E8C56F26C47E93CF'; // Replace with your SMTP password
        $mail->SMTPSecure = 'tls'; // Use 'tls' or 'ssl' based on your server configuration
        $mail->Port       = 587; // Port number, typically 587 for TLS and 465 for SSL

        // Recipients
        $mail->setFrom('noreply@diami.co.tz/', 'www.diami.co.tz'); // Replace with your website name and email
        $mail->addAddress($email); // Receiver's email

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Password Reset';
        $mail->Body    = 'Your new password: ' . $newPassword;

        $mail->send();
    } catch (Exception $e) {
        echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>



<!-- 
<!DOCTYPE html>
<html>
<head>
    <title>Password Reset</title>
</head>
<body>
    <h2>Reset Password</h2>
    <form action="reset_password.php" method="post">
        <label>Email:</label>
        <input type="email" name="email" required>
        <input type="submit" name="submit" value="Reset Password">
    </form>
</body>
</html> -->


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
            <h1>FORGOT PASSWORD</h1>
            <div class="container3">
                <form action="reset_password_process.php" method="post">
                    
                    <div>
                        <strong><label for="E-mail">E-mail:</label><br></strong>
                        <input type="text" placeholder="E-mail" size="40" name="email">
                    </div>
                    <input type="submit" name="submit" value="Reset Password">
                </form>
               
            </div>
        </div>
    </div>
</body>
</html>

<!-- 8UhDQ2rqRf -->
<!-- CoiRDrtfNl -->