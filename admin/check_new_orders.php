<?php
include('config/db_connection.php');

$sql = "SELECT MAX(order_id) AS newOrderId FROM orders";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$newOrderId = $row['newOrderId'] ?? 0;

header('Content-Type: application/json');
echo json_encode(['newOrderId' => $newOrderId]);
