<?php
include('config/db_connection.php'); // Include your database connection configuration

// Set the appropriate content type for JSON response
header('Content-Type: application/json');

// Query to retrieve unread notifications
$sql = "SELECT id, message FROM notifications WHERE read_status = 0 ORDER BY id DESC";
$result = $conn->query($sql);

$notifications = [];

// Fetch unread notifications
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $notifications[] = $row;
    }

    // Mark all fetched notifications as read
    $update_sql = "UPDATE notifications SET read_status = 1 WHERE read_status = 0";
    $conn->query($update_sql);
}

// Return unread notifications as JSON
echo json_encode($notifications);
?>
