<?php
session_start();
include('config/db_connection.php'); // Database connection

// Check if there are items in the order
if (!isset($_SESSION['order_items']) || empty($_SESSION['order_items'])) {
    header('Location: menu.php'); // Redirect if no items in the order
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Process the order (similar to process-order.php)
    // Validate and insert order details
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Details - TWINZ CAFE</title>
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center">Customer Details</h2>
    <form action="process-order.php" method="POST">
        <div class="form-group">
            <label for="customer_name">Full Name:</label>
            <input type="text" name="customer_name" id="customer_name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="contact">Contact Number (10 digits):</label>
            <input type="text" name="contact" id="contact" class="form-control" pattern="\d{10}" required title="Please enter a 10-digit phone number.">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="address">Delivery Address:</label>
            <textarea name="address" id="address" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="payment_method">Payment Method:</label>
            <select name="payment_method" id="payment_method" class="form-control" required>
                <option value="cash_on_delivery">Cash on Delivery</option>
                <option value="mobile_money">Mobile Money</option>
                <option value="bank_transfer">Bank Transfer</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Submit Order</button>
    </form>
</div>

<!-- Include footer if needed -->
<?php include('partails-font/footer.php'); ?>
<script src="https://code.jquery.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
