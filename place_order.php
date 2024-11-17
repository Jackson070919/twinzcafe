<?php
include('config/db_connection.php'); // Include database configuration

// Check if order data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_name = $_POST['customer_name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $payment_method = $_POST['payment_method'];
    $mobile_number = isset($_POST['mobile_number']) ? $_POST['mobile_number'] : null;

    // Calculate total order amount
    $total = 0;
    foreach ($_SESSION['order'] as $item) {
        $total += $item['price'] * $item['quantity'];
    }

    // Insert order data into the 'orders' table
    $sql = "INSERT INTO orders (customer_name, phone, address, payment_method, mobile_number, total) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Check if statement preparation succeeded
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("sssssd", $customer_name, $phone, $address, $payment_method, $mobile_number, $total);

    if ($stmt->execute()) {
        // Get the inserted order ID
        $order_id = $stmt->insert_id;

        // Insert each item into the 'order_items' table
        foreach ($_SESSION['order'] as $item) {
            $item_name = $item['item_name'];
            $quantity = $item['quantity'];
            $price = $item['price'];

            $sql_item = "INSERT INTO order_items (order_id, product_name, quantity, price) VALUES (?, ?, ?, ?)";
            $stmt_item = $conn->prepare($sql_item);

            // Check if statement preparation for order_items succeeded
            if (!$stmt_item) {
                die("Error preparing statement for order items: " . $conn->error);
            }

            $stmt_item->bind_param("isid", $order_id, $item_name, $quantity, $price);
            $stmt_item->execute();
        }

        // Clear the order session
        unset($_SESSION['order']);

        // Redirect to a success page
        header("Location: order_success.php?order_id=$order_id");
        exit;
    } else {
        echo "Error executing statement: " . $stmt->error;
    }
}
?>
