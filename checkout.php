<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate contact number
    $contact = $_POST['contact'];
    if (!preg_match('/^\d{10}$/', $contact)) {
        $error = "Contact number must be exactly 10 digits.";
    } else {
        // Process order, e.g., save to database
        $_SESSION['cart'] = []; // Clear the cart after submission
        header('Location: success.php'); // Redirect to a success page
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center">Checkout</h2>
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" name="address" id="address" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="contact">Contact Number</label>
                <input type="text" name="contact" id="contact" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit Order</button>
        </form>
    </div>
</body>
</html>
