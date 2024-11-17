<?php
include('partails/menu.php'); // Include database configuration and connection

// Fetch orders and related items
$sql = "
    SELECT o.order_id, o.customer_name, o.phone, o.address, o.payment_method, o.total, o.status, 
           oi.product_name, oi.quantity, oi.price 
    FROM orders o
    JOIN order_items oi ON o.order_id = oi.order_id
    ORDER BY o.order_id DESC
";
$result = $conn->query($sql);
$rows = $result->fetch_all(MYSQLI_ASSOC);

// Get the latest order ID for tracking new orders
$latestOrderId = !empty($rows) ? $rows[0]['order_id'] : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Order Management</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .order-container { max-width: 1000px; margin: 20px auto; }
        .order-header { font-size: 24px; font-weight: bold; }
        .order-table th, .order-table td { padding: 10px; }
        .status-select { min-width: 120px; }
    </style>
</head>
<body>

<div class="container order-container">
    <h2 class="text-center order-header">Order Management</h2>
    <div class="table-responsive">
        <table class="table table-bordered order-table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Payment Method</th>
                    <th>Total Amount</th>
                    <th>Status</th>
                    <th>Items</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($rows) > 0): ?>
                    <?php
                    $currentOrderId = null;
                    foreach ($rows as $index => $row):
                        if ($row['order_id'] !== $currentOrderId):
                            if ($currentOrderId !== null) {
                                echo '</ul></td><td>
                                    <form action="delete_order.php" method="POST" onsubmit="return confirmDelete()">
                                        <input type="hidden" name="order_id" value="' . htmlspecialchars($currentOrderId) . '">
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td></tr>';
                            }
                            $currentOrderId = $row['order_id'];
                            ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['order_id']); ?></td>
                                <td><?php echo htmlspecialchars($row['customer_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['phone']); ?></td>
                                <td><?php echo htmlspecialchars($row['address']); ?></td>
                                <td><?php echo htmlspecialchars($row['payment_method']); ?></td>
                                <td><?php echo "Shs." . number_format($row['total'], 2); ?></td>
                                <td>
                                    <form action="update_status.php" method="POST">
                                        <input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>">
                                        <select name="status" class="form-control status-select" onchange="this.form.submit()">
                                            <option value="Pending" <?php if ($row['status'] == 'Pending') echo 'selected'; ?>>Pending</option>
                                            <option value="Confirmed" <?php if ($row['status'] == 'Confirmed') echo 'selected'; ?>>Confirmed</option>
                                            <option value="Completed" <?php if ($row['status'] == 'Completed') echo 'selected'; ?>>Completed</option>
                                        </select>
                                    </form>
                                </td>
                                <td><ul>
                        <?php endif; ?>
                            <li><?php echo htmlspecialchars($row['product_name']); ?> - 
                                <?php echo htmlspecialchars($row['quantity']); ?> x 
                                <?php echo "Shs." . number_format($row['price'], 2); ?>
                            </li>
                        <?php if ($index === array_key_last($rows)): ?>
                                </ul></td>
                                <td>
                                    <form action="delete_order.php" method="POST" onsubmit="return confirmDelete()">
                                        <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($row['order_id']); ?>">
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="9" class="text-center">No orders found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    let latestOrderId = <?php echo $latestOrderId; ?>; // Track the latest order ID

    function checkForNewOrders() {
        fetch('check_new_orders.php')
            .then(response => response.json())
            .then(data => {
                if (data.newOrderId > latestOrderId) {
                    latestOrderId = data.newOrderId;
                    alert(`New Order Received!\nOrder ID: ${latestOrderId}`);
                }
            })
            .catch(error => console.error('Error checking for new orders:', error));
    }

    // Poll the server every 10 seconds
    setInterval(checkForNewOrders, 10000);

    function confirmDelete() {
        return confirm('Are you sure you want to delete this order? This action cannot be undone.');
    }
</script>

</body>
</html>
