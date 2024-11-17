<?php
$order_id = $_GET['order_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Success - TWINZ CAFE</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container text-center my-5">
    <h2>Thank you for your order!</h2>
    <p>Your order ID is: <strong><?php echo htmlspecialchars($order_id); ?></strong></p>
    <p>We will contact you shortly with more details.</p>
    <a href="menu.php" class="btn btn-primary mt-3">Return to Menu</a>
</div>
</body>
</html>
