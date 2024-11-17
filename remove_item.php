<?php
session_start();
if (isset($_POST['index'])) {
    $index = $_POST['index'];
    unset($_SESSION['order'][$index]);
    $_SESSION['order'] = array_values($_SESSION['order']); // Re-index array
}
header("Location: order.php");
exit;
?>
