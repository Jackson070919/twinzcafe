<?php
include('../config/db_connection.php');
$id = $_GET['id'];
$sql = "DELETE FROM menu_items WHERE id = $id";
$conn->query($sql);
header("Location: admin_menu-items.php");
?>
