<?php
include('../config/db_connection.php'); // Include the database connection
include'../login-check.php';

// Update message status to 'read'
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $stmt = $conn->prepare("UPDATE contacts SET status = 'read' WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

header("Location: admin_contacts.php");
exit;
?>
