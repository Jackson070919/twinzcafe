<?php
ob_start();  // Start output buffering

include('partails/menu.php'); // Ensure DB connection is included


if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Fetch user data from the database
    $query = "SELECT * FROM users WHERE id = $userId";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Query Failed: " . mysqli_error($conn));
    }

    $user = mysqli_fetch_assoc($result);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $fullName = $_POST['full_name'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $status = $_POST['status'];

    // Update user data in the database
    $updateQuery = "UPDATE users SET full_name = '$fullName', email = '$email', role = '$role', status = '$status' WHERE id = $userId";
    $updateResult = mysqli_query($conn, $updateQuery);

    if ($updateResult) {
        $_SESSION['message'] = 'User updated successfully.';
        header("Location: admin_manage_users.php"); // Redirect to manage users page
        exit();
    } else {
        $_SESSION['message'] = 'Failed to update user.';
    }
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="path/to/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center">Edit User</h2>

    <!-- Display success or error message -->
    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-info text-center">
            <?php echo $_SESSION['message']; unset($_SESSION['message']); ?>
        </div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label for="full_name" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="full_name" name="full_name" value="<?php echo $user['full_name']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select class="form-control" id="role" name="role" required>
                <option value="admin" <?php if ($user['role'] == 'admin') echo 'selected'; ?>>Admin</option>
                <option value="user" <?php if ($user['role'] == 'user') echo 'selected'; ?>>User</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-control" id="status" name="status" required>
                <option value="active" <?php if ($user['status'] == 'active') echo 'selected'; ?>>Active</option>
                <option value="inactive" <?php if ($user['status'] == 'inactive') echo 'selected'; ?>>Inactive</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update User</button>
    </form>
</div>

<?php include('partails/footer.php'); ?>

</body>
</html>
<?php
ob_end_flush();  // End output buffering and flush output
?>