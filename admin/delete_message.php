<?php

include'../config/db_connection.php';// Include the database connection
include'../login-check.php';

// Delete message
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $stmt = $conn->prepare("DELETE FROM contacts WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

header("Location: admin_contacts.php");
exit;
?>
