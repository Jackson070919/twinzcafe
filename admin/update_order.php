<?php
include('partails/menu.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $status = $_POST['status']; // e.g. 'completed', 'pending', 'cancelled'

    $sql = "UPDATE orders SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $id);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Order status updated successfully.";
    } else {
        $_SESSION['message'] = "Error updating order: " . mysqli_error($conn);
    }

    header("Location: admin_orders.php"); // Redirect back to orders page
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Order Status</title>
    <style>
         
         .container{
            width: 50%;
         }
        /* Form styling */
        form {
            width: ;
            display: flex;
            flex-direction: column;
        }

        select, button {
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
            border: 1px solid #ddd;
        }

        select {
            cursor: pointer;
            background-color: #fafafa;
        }

        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Update Order Status</h2>
    <form action="update_order.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
        <select name="status" required>
            <option value="pending">Pending</option>
            <option value="completed">Completed</option>
            <option value="cancelled">Cancelled</option>
        </select>
        <button type="submit">Update Status</button>
    </form>
</div>

</body>
</html>
