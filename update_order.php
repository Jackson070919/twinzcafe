<?php
session_start();
if (isset($_POST['index']) && isset($_POST['quantity'])) {
    $index = $_POST['index'];
    $quantity = max(1, (int)$_POST['quantity']);
    $_SESSION['order'][$index]['quantity'] = $quantity;
}
header("Location: order.php");
exit;
?>
