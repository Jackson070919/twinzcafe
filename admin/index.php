
<?php    

// Include your database connection file
include('partails/menu.php'); // Ensure this file contains the DB connection setup

// Check if the database connection is successful
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Fetch total orders
$totalOrdersQuery = "SELECT COUNT(*) AS total FROM orders";
$totalOrdersResult = mysqli_query($conn, $totalOrdersQuery);
$totalOrders = ($totalOrdersResult && mysqli_num_rows($totalOrdersResult) > 0) ? mysqli_fetch_assoc($totalOrdersResult)['total'] : 0;

// Fetch total reservations
$totalReservationsQuery = "SELECT COUNT(*) AS total FROM reservations";
$totalReservationsResult = mysqli_query($conn, $totalReservationsQuery);
$totalReservations = ($totalReservationsResult && mysqli_num_rows($totalReservationsResult) > 0) ? mysqli_fetch_assoc($totalReservationsResult)['total'] : 0;

// Fetch total menu items
$totalMenuItemsQuery = "SELECT COUNT(*) AS total FROM menu_items";
$totalMenuItemsResult = mysqli_query($conn, $totalMenuItemsQuery);
$totalMenuItems = ($totalMenuItemsResult && mysqli_num_rows($totalMenuItemsResult) > 0) ? mysqli_fetch_assoc($totalMenuItemsResult)['total'] : 0;

// Fetch data for Orders by Status chart
$ordersStatusQuery = "SELECT status, COUNT(*) AS count FROM orders GROUP BY status";
$ordersStatusResult = mysqli_query($conn, $ordersStatusQuery);
if (!$ordersStatusResult) {
    die("Query Failed: " . mysqli_error($conn));
}
$ordersStatusData = mysqli_fetch_all($ordersStatusResult, MYSQLI_ASSOC);

// Fetch data for Reservations Over Time chart
$reservationsTimeQuery = "SELECT DATE(reservation_date) AS date, COUNT(*) AS count FROM reservations WHERE reservation_date >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) GROUP BY DATE(reservation_date)";
$reservationsTimeResult = mysqli_query($conn, $reservationsTimeQuery);
if (!$reservationsTimeResult) {
    die("Query Failed: " . mysqli_error($conn));
}
$reservationsTimeData = mysqli_fetch_all($reservationsTimeResult, MYSQLI_ASSOC);

// Fetch data for Menu Items Popularity chart
$menuPopularityQuery = "SELECT menu_items.name, COUNT(order_items.menu_item_id) AS count FROM order_items JOIN menu_items ON order_items.menu_item_id = menu_items.id GROUP BY order_items.menu_item_id ORDER BY count DESC LIMIT 5";
$menuPopularityResult = mysqli_query($conn, $menuPopularityQuery);
if (!$menuPopularityResult) {
    die("Query Failed: " . mysqli_error($conn));
}
$menuPopularityData = mysqli_fetch_all($menuPopularityResult, MYSQLI_ASSOC);

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="path/to/bootstrap.min.css"> <!-- Update with your actual Bootstrap path -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Chart.js CDN -->
    <style>
        .dashboard-card {
            border: 1px solid #e3e3e3;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
            text-align: center;
        }
        .chart-container {
            margin-top: 40px;
            width: 80%;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center">Admin Dashboard</h2>

    <?php if (isset($_SESSION['login'])): ?>
        <div class="alert alert-success text-center">
            <?php echo $_SESSION['login']; unset($_SESSION['login']); ?>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-4">
            <div class="dashboard-card">
                <h3>Total Orders</h3>
                <p><?php echo $totalOrders; ?></p>
                <a href="admin_orders.php" class="btn btn-primary">Manage Orders</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="dashboard-card">
                <h3>Total Reservations</h3>
                <p><?php echo $totalReservations; ?></p>
                <a href="admin_reservations.php" class="btn btn-primary">Manage Reservations</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="dashboard-card">
                <h3>Total Menu Items</h3>
                <p><?php echo $totalMenuItems; ?></p>
                <a href="admin_menu-items.php" class="btn btn-primary">Manage Menu</a>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="chart-container">
        <h4>Orders by Status</h4>
        <canvas id="ordersStatusChart"></canvas>
    </div>

    <div class="chart-container">
        <h4>Reservations Over Time</h4>
        <canvas id="reservationsTimeChart"></canvas>
    </div>

    <div class="chart-container">
        <h4>Menu Items Popularity</h4>
        <canvas id="menuPopularityChart"></canvas>
    </div>
</div>

<?php include('partails/footer.php'); ?> <!-- Admin Footer -->

<script>
    // Data for Orders by Status chart
    const ordersStatusData = <?php echo json_encode($ordersStatusData); ?>;
    const ordersStatusLabels = ordersStatusData.map(data => data.status);
    const ordersStatusCounts = ordersStatusData.map(data => data.count);

    // Orders by Status Chart
    const ordersStatusCtx = document.getElementById('ordersStatusChart').getContext('2d');
    new Chart(ordersStatusCtx, {
        type: 'doughnut',
        data: {
            labels: ordersStatusLabels,
            datasets: [{
                label: 'Orders by Status',
                data: ordersStatusCounts,
                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0'],
            }]
        },
    });

    // Data for Reservations Over Time chart
    const reservationsTimeData = <?php echo json_encode($reservationsTimeData); ?>;
    const reservationsTimeLabels = reservationsTimeData.map(data => data.date);
    const reservationsTimeCounts = reservationsTimeData.map(data => data.count);

    // Reservations Over Time Chart
    const reservationsTimeCtx = document.getElementById('reservationsTimeChart').getContext('2d');
    new Chart(reservationsTimeCtx, {
        type: 'line',
        data: {
            labels: reservationsTimeLabels,
            datasets: [{
                label: 'Reservations Over Last 7 Days',
                data: reservationsTimeCounts,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
                fill: true,
            }]
        },
    });

    // Data for Menu Items Popularity chart
    const menuPopularityData = <?php echo json_encode($menuPopularityData); ?>;
    const menuPopularityLabels = menuPopularityData.map(data => data.name);
    const menuPopularityCounts = menuPopularityData.map(data => data.count);

    // Menu Items Popularity Chart
    const menuPopularityCtx = document.getElementById('menuPopularityChart').getContext('2d');
    new Chart(menuPopularityCtx, {
        type: 'bar',
        data: {
            labels: menuPopularityLabels,
            datasets: [{
                label: 'Top 5 Menu Items',
                data: menuPopularityCounts,
                backgroundColor: 'rgba(255, 159, 64, 0.2)',
                borderColor: 'rgba(255, 159, 64, 1)',
                borderWidth: 1,
            }]
        },
    });
</script>

</body>
</html>
