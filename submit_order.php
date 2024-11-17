<?php
include('config/db_connection.php'); // Include your database connection

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer_name = $_POST['customer_name'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $payment_method = $_POST['payment_method'];
    $item_id = $_POST['item_id'];
    $item_name = $_POST['item_name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    // Insert order into the database
    $sql = "INSERT INTO orders (item_id, item_name, price, quantity, customer_name, address, contact, payment_method) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ississss", $item_id, $item_name, $price, $quantity, $customer_name, $address, $contact, $payment_method);

    if ($stmt->execute()) {
        // Order successful
        $_SESSION['order_success'] = "Order placed successfully!";
        header("Location: order_success.php"); // Redirect to a success page or back to menu
        exit();
    } else {
        // Order failed
        $_SESSION['order_error'] = "Failed to place order: " . mysqli_error($conn);
        header("Location: menu.php"); // Redirect back to the menu with error message
        exit();
    }

    $stmt->close();
}
$conn->close();
?>
