<?php
include('../config/db_connection.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "User deleted successfully.";
    } else {
        echo "Failed to delete user.";
    }
}
?>
