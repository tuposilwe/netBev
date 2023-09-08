<?php
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

        // Display the new password to the user (not recommended for security reasons)
        echo "Password reset successful! Your new password is: $newPassword. Please log in using the new password.";
    } else {
        // Display a banner message if email not found
        $message = "Email not found. Please check your email address and try again.";
        echo "<script type='text/javascript'>alert('$message');</script>";
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
?>




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
</html>



