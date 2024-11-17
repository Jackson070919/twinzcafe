<?php
// Start the session to retrieve order details
session_start();

// Include the database connection if needed
include('db_connection.php');

// Check if the order items are in the session
if (!isset($_SESSION['order_items'])) {
    // Redirect to the menu page if there are no items
    header("Location: menu.php");
    exit();
}

// Retrieve the order items from the session
$order_items = $_SESSION['order_items'];

// Calculate the grand total
$grand_total = 0;
foreach ($order_items as $item) {
    $grand_total += $item['price'] * $item['quantity'];
}

// Clear the order items from the session after confirmation
unset($_SESSION['order_items']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <link rel="stylesheet" href="path/to/bootstrap.min.css"> <!-- Update with your Bootstrap path -->
</head>
<body>
    <?php include('partails-font/menu.php'); ?>

    <section class="confirmation py-5">
        <div class="container">
            <h2 class="text-center mb-4">Order Confirmation</h2>
            <div class="alert alert-success text-center">
                <strong>Thank you for your order!</strong> Your order has been placed successfully.
            </div>

            <h4>Your Order Summary:</h4>
            <div class="row">
                <?php foreach ($order_items as $item): ?>
                    <div class="col-6 col-md-4 food-item">
                        <img src="image/uploads/<?php echo htmlspecialchars($item['image_url']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" class="img-fluid">
                        <h5><?php echo htmlspecialchars($item['name']); ?></h5>
                        <p>Shs. <?php echo htmlspecialchars($item['price']); ?></p>
                        <p>Quantity: <?php echo htmlspecialchars($item['quantity']); ?></p>
                        <p>Total: Shs. <?php echo htmlspecialchars($item['price'] * $item['quantity']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>

            <h3 class="text-right mt-4">Grand Total: 
                <?php echo "Shs. " . htmlspecialchars($grand_total); ?>
            </h3>

            <div class="text-center mt-4">
                <button class="btn btn-primary" onclick="window.print()">Print Order</button>
                <a href="menu.php" class="btn btn-success">Continue Ordering</a>
            </div>
        </div>
    </section>

    <?php include('partails-font/footer.php'); ?>
</body>
</html>
