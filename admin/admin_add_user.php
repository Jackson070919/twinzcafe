<?php
ob_start();  // Start output buffering

include('partails/menu.php'); // Ensure DB connection is included


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $fullName = $_POST['full_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $role = $_POST['role'];
    $status = $_POST['status'];

    // Insert the new user into the database
    $insertQuery = "INSERT INTO users (full_name, email, password, role, status) VALUES ('$fullName', '$email', '$password', '$role', '$status')";
    $insertResult = mysqli_query($conn, $insertQuery);

    if ($insertResult) {
        $_SESSION['message'] = 'User added successfully.';
        header("Location: admin_manage_users.php"); // Redirect to manage users page
        exit();
    } else {
        $_SESSION['message'] = 'Failed to add user.';
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
    <title>Add New User</title>
    <link rel="stylesheet" href="path/to/bootstrap.min.css"> <!-- Update with your actual Bootstrap path -->
    <style>
        /* Custom CSS to ensure the form is centered and responsive */
        body {
            background-color: #f8f9fa;
            padding: 20px;
        }
        .container {
            max-width: 600px; /* Limit the container width */
            margin-top: 30px;
        }
        .form-label {
            font-weight: bold;
        }
        .btn-primary {
            width: 100%; /* Full width button */
        }
        @media (max-width: 576px) {
            /* Make form fields stack nicely on mobile */
            .container {
                max-width: 100%;
                padding-left: 15px;
                padding-right: 15px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center">Add New User</h2>

    <!-- Display success or error message -->
    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-info text-center">
            <?php echo $_SESSION['message']; unset($_SESSION['message']); ?>
        </div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label for="full_name" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="full_name" name="full_name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select class="form-control" id="role" name="role" required>
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-control" id="status" name="status" required>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Add User</button>
    </form>
</div>

<?php include('partails/footer.php'); ?> <!-- Admin Footer -->

<script src="path/to/bootstrap.bundle.min.js"></script> <!-- Update with your Bootstrap path -->

</body>
</html>
<?php
include 'partails/footer.php';
ob_end_flush();  // End output buffering and flush output
?>
