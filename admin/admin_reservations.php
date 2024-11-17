<?php
include('partails/menu.php'); // Include your menu

// Initialize message for delete confirmation
$message = "";

// Delete reservation process
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM reservations WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        $message = "Reservation deleted successfully!";
    } else {
        $message = "Error: " . $stmt->error;
    }
    
    $stmt->close();
}

// SQL to fetch all reservations without filtering
$sql = "SELECT * FROM reservations ORDER BY created_at DESC";
$reservations = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Manage Reservations</title>
    <link rel="stylesheet" href="path/to/bootstrap.min.css"> <!-- Update with your Bootstrap path -->
</head>
<body>
<section class="admin-reservations py-5">
    <div class="container">
        <h2 class="text-center mb-4">Manage Reservations</h2>

        <!-- Message display -->
        <?php if ($message): ?>
            <div class="alert alert-info"><?php echo $message; ?></div>
        <?php endif; ?>

        <!-- Reservation Table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer Name</th>
                    <th>Reservation Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($reservations) > 0) {
                    while ($row = mysqli_fetch_assoc($reservations)) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . htmlspecialchars($row['customer_name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['reservation_date']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                        echo '<td>
                                <a href="admin_reservations.php?delete=' . $row['id'] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete this reservation?\');">Delete</a>
                                <a href="update_status.php?id=' . $row['id'] . '" class="btn btn-primary btn-sm">Update Status</a>
                            </td>';
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>No reservations found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</section>

<?php include('partails/footer.php'); ?> <!-- Include your footer -->
</body>
</html>

<?php
$conn->close(); // Close the database connection
?>
