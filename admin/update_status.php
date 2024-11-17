<?php
include('../config/db_connection.php'); // Include database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['order_id'], $_POST['status'])) {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    // Update the order status in the database
    $sql = "UPDATE orders SET status = ? WHERE order_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $status, $order_id);
    
    if ($stmt->execute()) {
        header('Location: admin_orders.php'); // Redirect back to the order management page
        exit;
    } else {
        echo "Error updating order status: " . $conn->error;
    }
}
?>
