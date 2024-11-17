<?php
include('partails/menu.php'); // Include navigation/header

// Fetch all menu items
$menuItemsQuery = "SELECT id, category, name, description, price, image_url, is_featured FROM menu_items";
$menuItemsResult = $conn->query($menuItemsQuery);
$menuItems = $menuItemsResult->fetch_all(MYSQLI_ASSOC);

// Fetch all orders
$ordersQuery = "
    SELECT order_id, item_id, order_date, item_name, price, quantity, customer_name, address, phone, payment_method, 
           mobile_number, total, status 
    FROM orders
";
$ordersResult = $conn->query($ordersQuery);
$orders = $ordersResult->fetch_all(MYSQLI_ASSOC);

// Fetch all order items
$orderItemsQuery = "
    SELECT product_name, SUM(quantity) AS total_quantity 
    FROM order_items 
    GROUP BY product_name 
    ORDER BY total_quantity DESC
";
$orderItemsResult = $conn->query($orderItemsQuery);
$orderItemsData = $orderItemsResult->fetch_all(MYSQLI_ASSOC);

// Prepare data for charts
$orderStatusData = array_count_values(array_column($orders, 'status')); // Count of each order status
$salesTrendData = [];
foreach ($orders as $order) {
    $date = date('Y-m-d', strtotime($order['order_date']));
    $salesTrendData[$date] = ($salesTrendData[$date] ?? 0) + $order['total'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Report - Orders, Menu, Sales</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">Admin Report</h2>

    <!-- Menu Items Report Section -->
    <h4>Menu Items</h4>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Category</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Featured</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($menuItems as $item): ?>
                    <tr>
                        <td><?php echo $item['id']; ?></td>
                        <td><?php echo htmlspecialchars($item['category']); ?></td>
                        <td><?php echo htmlspecialchars($item['name']); ?></td>
                        <td><?php echo htmlspecialchars($item['description']); ?></td>
                        <td><?php echo "Shs." . number_format($item['price'], 2); ?></td>
                        <td><img src="<?php echo htmlspecialchars($item['image_url']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" width="50"></td>
                        <td><?php echo $item['is_featured'] ? 'Yes' : 'No'; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Orders Report Section -->
    <h4>Orders</h4>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Item ID</th>
                    <th>Order Date</th>
                    <th>Item Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Customer Name</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Payment Method</th>
                    <th>Mobile Number</th>
                    <th>Total</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?php echo $order['order_id']; ?></td>
                        <td><?php echo $order['item_id']; ?></td>
                        <td><?php echo htmlspecialchars($order['order_date']); ?></td>
                        <td><?php echo htmlspecialchars($order['item_name']); ?></td>
                        <td><?php echo "Shs." . number_format($order['price'], 2); ?></td>
                        <td><?php echo $order['quantity']; ?></td>
                        <td><?php echo htmlspecialchars($order['customer_name']); ?></td>
                        <td><?php echo htmlspecialchars($order['address']); ?></td>
                        <td><?php echo htmlspecialchars($order['phone']); ?></td>
                        <td><?php echo htmlspecialchars($order['payment_method']); ?></td>
                        <td><?php echo htmlspecialchars($order['mobile_number']); ?></td>
                        <td><?php echo "Shs." . number_format($order['total'], 2); ?></td>
                        <td><?php echo htmlspecialchars($order['status']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Sales Report Section -->
    <h4>Sales (Order Items)</h4>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Total Quantity Sold</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orderItemsData as $item): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                        <td><?php echo $item['total_quantity']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Charts Section -->
    <h4>Sales Charts</h4>
    <div class="row">
        <div class="col-md-6 mb-4">
            <canvas id="mostSoldChart"></canvas>
        </div>
        <div class="col-md-6 mb-4">
            <canvas id="orderStatusChart"></canvas>
        </div>
        <div class="col-12">
            <canvas id="salesTrendChart"></canvas>
        </div>
    </div>
</div>

<script>
    // Most Sold Items Chart
    const mostSoldCtx = document.getElementById('mostSoldChart').getContext('2d');
    new Chart(mostSoldCtx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode(array_column($orderItemsData, 'product_name')); ?>,
            datasets: [{
                label: 'Quantity Sold',
                data: <?php echo json_encode(array_column($orderItemsData, 'total_quantity')); ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        }
    });

    // Order Status Chart
    const orderStatusCtx = document.getElementById('orderStatusChart').getContext('2d');
    new Chart(orderStatusCtx, {
        type: 'pie',
        data: {
            labels: <?php echo json_encode(array_keys($orderStatusData)); ?>,
            datasets: [{
                label: 'Order Status',
                data: <?php echo json_encode(array_values($orderStatusData)); ?>,
                backgroundColor: ['rgba(75, 192, 192, 0.5)', 'rgba(255, 99, 132, 0.5)', 'rgba(255, 205, 86, 0.5)'],
                borderColor: ['rgba(75, 192, 192, 1)', 'rgba(255, 99, 132, 1)', 'rgba(255, 205, 86, 1)'],
                borderWidth: 1
            }]
        }
    });

    // Sales Trend Chart
    const salesTrendCtx = document.getElementById('salesTrendChart').getContext('2d');
    new Chart(salesTrendCtx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode(array_keys($salesTrendData)); ?>,
            datasets: [{
                label: 'Total Sales',
                data: <?php echo json_encode(array_values($salesTrendData)); ?>,
                backgroundColor: 'rgba(153, 102, 255, 0.5)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 1
            }]
        }
    });
</script>
</body>
</html>

<?php include ('partails/footer.php'); ?>
