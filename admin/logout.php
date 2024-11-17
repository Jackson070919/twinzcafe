<?php
session_start(); // Start the session

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Store a logout message in the session to show on login page
session_start(); // Restart session to set message
$_SESSION['message'] = "You have successfully logged out.";

// Redirect to the login page
header("Location: login.php");
exit; // Ensure no further code is executed
?>
