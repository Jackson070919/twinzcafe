<?php
// Include database configuration
include('config/db_connection.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form inputs
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $message = htmlspecialchars($_POST['message']);
    
    // Insert into the database
    $sql = "INSERT INTO contacts (name, email, phone, message) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $email, $phone, $message);
    
    // Execute and check for success
    if ($stmt->execute()) {
        echo "<p>Thank you for reaching out. We’ll get back to you soon!</p>";
    } else {
        echo "<p>Something went wrong. Please try again later.</p>";
    }
    
    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
