<?php
include('../config/db_connection.php'); // Include database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['order_id']) && !empty($_POST['order_id'])) {
        $order_id = intval($_POST['order_id']); // Sanitize input

        $conn->begin_transaction();

        try {
            // Delete related items first
            $deleteItemsSql = "DELETE FROM order_items WHERE order_id = ?";
            $stmtItems = $conn->prepare($deleteItemsSql);
            $stmtItems->bind_param("i", $order_id);
            $stmtItems->execute();

            // Delete the order
            $deleteOrderSql = "DELETE FROM orders WHERE order_id = ?";
            $stmtOrder = $conn->prepare($deleteOrderSql);
            $stmtOrder->bind_param("i", $order_id);
            $stmtOrder->execute();

            $conn->commit();

            $_SESSION['success'] = "Order #$order_id deleted successfully.";
        } catch (Exception $e) {
            $conn->rollback();
            $_SESSION['error'] = "Failed to delete order: " . $e->getMessage();
        }

        $stmtItems->close();
        $stmtOrder->close();
        $conn->close();
    } else {
        $_SESSION['error'] = "Invalid order ID.";
    }
}

header("Location: admin_orders.php");
exit();
