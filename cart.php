<?php
include('partails-font/menu.php');

// Initialize an empty message
$message = '';

if (!empty($_SESSION['cart'])) {
    // Calculate total price
    $total_price = 0;
    $order_items = [];
    foreach ($_SESSION['cart'] as $id => $item) {
        $total_price += $item['price'] * $item['quantity'];
        $order_items[] = [
            'name' => $item['name'],
            'quantity' => $item['quantity'],
            'price' => $item['price']
        ];
    }

    // Encode order items as JSON
    $order_items_json = json_encode($order_items);

    // Insert order into the database
    $customer_name = "John Doe"; // Replace with actual customer data if available
    $status = "Pending";

    $sql = "INSERT INTO orders (customer_name, order_items, total_price, status) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssis", $customer_name, $order_items_json, $total_price, $status);

    if ($stmt->execute()) {
        // Clear cart after successful checkout
        $_SESSION['cart'] = [];
        $message = "Order placed successfully!";
    } else {
        $message = "Error placing order.";
    }

    $stmt->close();
} else {
    $message = "Your cart is empty!";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cart</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center">Your Cart</h2>
        <form method="POST" action="cart.php">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($_SESSION['cart'])): ?>
                        <tr><td colspan="5" class="text-center">Your cart is empty!</td></tr>
                    <?php else: ?>
                        <?php $total = 0; ?>
                        <?php foreach ($_SESSION['cart'] as $id => $item): ?>
                            <?php $item_total = $item['price'] * $item['quantity']; ?>
                            <tr>
                                <td><?php echo htmlspecialchars($item['name']); ?></td>
                                <td>Shs. <?php echo $item['price']; ?></td>
                                <td>
                                    <input type="number" name="quantities[<?php echo $id; ?>]" value="<?php echo $item['quantity']; ?>" min="1" class="form-control">
                                </td>
                                <td>Shs. <?php echo $item_total; ?></td>
                                <td><a href="cart.php?action=delete&id=<?php echo $id; ?>" class="btn btn-danger btn-sm">Delete</a></td>
                            </tr>
                            <?php $total += $item_total; ?>
                        <?php endforeach; ?>
                        <tr>
                            <td colspan="3" class="text-right"><strong>Total:</strong></td>
                            <td>Shs. <?php echo $total; ?></td>
                            <td></td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <button type="submit" name="update_cart" class="btn btn-primary">Update Cart</button>
            <a href="checkout.php" class="btn btn-success">Checkout</a>
        </form>
    </div>
</body>
</html>
