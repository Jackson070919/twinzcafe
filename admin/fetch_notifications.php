<?php
include('config/db_connection.php'); // Include your database connection configuration

// Set the appropriate content type for JSON response
header('Content-Type: application/json');

// Fetch the latest order ID
$sql = "SELECT MAX(order_id) AS last_order_id FROM orders";
$result = $conn->query($sql);

// Initialize the response
$response = ["last_order_id" => 0];

if ($result && $row = $result->fetch_assoc()) {
    $response["last_order_id"] = (int)$row["last_order_id"];
}

// Output the response in JSON format
echo json_encode($response);
?>
