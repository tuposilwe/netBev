<?php
function checkUserAuthentication() {
    session_start();

    // Check if the user is not logged in (not set)
    if (!isset($_SESSION['username'])) {
        // You can customize the alert message or redirect as needed
        echo "<script>alert('Please log in to access this page.'); window.location.href = 'login.php';</script>";
        exit();
    }
}
?>
