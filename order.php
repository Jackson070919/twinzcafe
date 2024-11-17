<?php
// Start the session and include the database connection

include('partails-front/menu.php');

// Fetch the selected item information based on the passed item ID
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item_id = $_POST['item_id'];
    $item_name = $_POST['item_name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    // Store the selected item in session
    $_SESSION['order'][] = [
        'item_id' => $item_id,
        'item_name' => $item_name,
        'price' => $price,
        'quantity' => $quantity,
    ];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order - TWINZ CAFE</title>
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: Arial, sans-serif; }
        h2
        .order-summary { max-width: 800px; margin: auto; }
        .order-summary h2{margin-top: 100px;}
        .order-item { padding: 15px; border-bottom: 1px solid #ddd; display: flex; justify-content: space-between; align-items: center; }
        .order-item h4 { margin-bottom: 0; font-size: 1rem; }
        .order-item p { margin: 0; font-size: 0.9rem; }
        .btn-remove { background-color: #ff4c4c; color: #fff; border: none; padding: 5px 10px; cursor: pointer; }
        .btn-update { margin-top: 10px; }
        .form-group label { font-weight: bold; font-size: 0.9rem; }
        .form-group input, .form-group select, .form-group textarea { font-size: 0.9rem; }
        
        /* Responsive Styles */
        @media (max-width: 576px) {
            .order-summary { padding: 15px; width: 100%; }
            .order-item { flex-direction: column; align-items: flex-start; text-align: left; }
            .order-item h4, .order-item p { font-size: 0.9rem; }
            .order-item form { width: 100%; display: flex; justify-content: space-between; margin-top: 10px; }
            .form-group label, .btn-update { font-size: 0.85rem; }
            .btn-update, .btn-remove { width: 48%; }
        }
    </style>
</head>
<body>

<div class="container my-5 order-summary">
    <h2 class="text-center mb-4" style="margin-top: 50px;">Your Order Summary</h2>

    <!-- Check if there are items in the order session -->
    <?php if (empty($_SESSION['order'])): ?>
        <p class="text-center">No order to be processed.</p>
    <?php else: ?>
    
    <!-- Order Items List -->
    <?php
    $total = 0;
    foreach ($_SESSION['order'] as $index => $item) {
        $subtotal = $item['price'] * $item['quantity'];
        $total += $subtotal;
    ?>
        <div class="order-item">
            <div>
                <h4><?php echo htmlspecialchars($item['item_name']); ?></h4>
                <p>Price: Shs.<?php echo number_format($item['price'], 2); ?> | Quantity: <?php echo $item['quantity']; ?></p>
                <p>Subtotal: Shs.<?php echo number_format($subtotal, 2); ?></p>
            </div>
            <!-- Update Quantity Form -->
            <form action="update_order.php" method="POST" class="d-inline">
                <input type="hidden" name="index" value="<?php echo $index; ?>">
                <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1" style="width: 50px;">
                <button type="submit" class="btn btn-success btn-update">Update</button>
            </form>
            <!-- Remove Item Button -->
            <form action="remove_item.php" method="POST" class="d-inline">
                <input type="hidden" name="index" value="<?php echo $index; ?>">
                <button type="submit" class="btn btn-remove">Remove</button>
            </form>
        </div>
    <?php } ?>
    <div class="text-right mt-4"><strong>Total: Shs.<?php echo number_format($total, 2); ?></strong></div>
    <div> <a href="menu.php" class="btn btn-primary">add items</a></div>

    <!-- Order Form for Customer Details -->
    <form action="place_order.php" method="POST" class="mt-4">
        <div class="form-group">
            <label for="customer_name">Full Name:</label>
            <input type="text" class="form-control" id="customer_name" name="customer_name" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone Number:</label>
            <input type="text" class="form-control" id="phone" name="phone" required pattern="^(075|070|078|076|077)\d{7}$" title="Phone number must start with 075, 070, 078, 076, or 077 and be exactly 10 digits.">
        </div>

        <div class="form-group">
            <label for="address">Address:</label>
            <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
        </div>

       <div class="form-group">
            <label for="payment_method">Payment Method:</label>
            <select class="form-control" id="payment_method" name="payment_method" required>
                <option value="">Select a payment method</option>
                <option value="cash">Cash on Delivery</option>
                <option value="mobile">Mobile Money</option>
                <option value="visa">Visa Card</option>
                <option value="bank">Bank Transfer</option>
                <option value="absa">ABSA Payment</option>
            </select>
        </div>

        <!-- Conditional inputs for each payment method -->
        <div class="form-group" id="mobile_payment" style="display: none;">
            <label for="mobile_number">Mobile Money Number:</label>
            <input type="text" class="form-control" id="mobile_number" name="mobile_number" pattern="^(075|070|078|076|077)\d{7}$" placeholder="e.g., 0751234567">
        </div>

        <div class="form-group" id="visa_payment" style="display: none;">
            <label for="card_number">Visa Card Number:</label>
            <input type="text" class="form-control" id="card_number" name="card_number" pattern="\d{16}" placeholder="16-digit card number">
            <label for="expiry_date">Expiry Date:</label>
            <input type="text" class="form-control" id="expiry_date" name="expiry_date" placeholder="MM/YY">
            <label for="cvv">CVV:</label>
            <input type="text" class="form-control" id="cvv" name="cvv" pattern="\d{3}" placeholder="3-digit CVV">
        </div>

        <div class="form-group" id="bank_payment" style="display: none;">
            <label for="bank_account">Bank Account Number:</label>
            <input type="text" class="form-control" id="bank_account" name="bank_account" placeholder="Your bank account number">
        </div>

        <div class="form-group" id="absa_payment" style="display: none;">
            <label for="absa_reference">ABSA Payment Reference:</label>
            <input type="text" class="form-control" id="absa_reference" name="absa_reference" placeholder="ABSA payment reference">
        </div>

        <button type="submit" class="btn btn-primary mt-3">Place Order</button>
    </form>
    <?php endif; ?> <!-- Close the conditional check -->
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    // Show specific input fields based on selected payment method
    document.getElementById('payment_method').addEventListener('change', function () {
        document.getElementById('mobile_payment').style.display = (this.value === 'mobile') ? 'block' : 'none';
        document.getElementById('visa_payment').style.display = (this.value === 'visa') ? 'block' : 'none';
        document.getElementById('bank_payment').style.display = (this.value === 'bank') ? 'block' : 'none';
        document.getElementById('absa_payment').style.display = (this.value === 'absa') ? 'block' : 'none';
    });
</script>

<?php include('partails-front/footer.php'); ?>
</body>
</html>
