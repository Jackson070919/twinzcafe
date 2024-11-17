<?php


// Set the session timeout duration (in seconds)
$timeout_duration = 1800; // 30 minutes

// Check if the user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

// Check for session expiration
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout_duration) {
    // If the session has expired, log the user out
    session_unset();  // Clear session data
    session_destroy();  // Destroy the session
    header("Location: login.php?message=session_expired");
    exit();
}

// Update the last activity time
$_SESSION['last_activity'] = time();
?>
