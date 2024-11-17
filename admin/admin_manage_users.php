<?php
// Start output buffering
ob_start();

// Include database connection
include('partails/menu.php');

// Add user
if (isset($_POST['add_user'])) {
    $username = $_POST['new_username'];
    $password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

    // Using prepared statements to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
        echo "<p>User added successfully!</p>";
    } else {
        echo "<p>Error: " . $conn->error . "</p>";
    }
}

// Delete user
if (isset($_POST['delete_user'])) {
    $user_id = $_POST['user_id'];

    // Prepared statement to prevent SQL injection
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        echo "<p>User deleted successfully!</p>";
    } else {
        echo "<p>Error: " . $conn->error . "</p>";
    }
}

// Get all users
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>

 <style type="text/css">
        /* General container styling */
.container {
    width: 80%;
    margin: 0 auto;
    padding: 20px;
    font-family: Arial, sans-serif;
}

h2 {
    color: #333;
}

a {
    color: #007bff;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

/* Form Styling */
form {
    margin-bottom: 20px;
}

label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

input[type="text"],
input[type="password"] {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

input[type="submit"] {
    padding: 10px 20px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #45a049;
}

/* Table Styling */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table, th, td {
    border: 1px solid #ddd;
}

th, td {
    padding: 10px;
    text-align: center;
}

th {
    background-color: #f254f2;
}

tr:nth-child(even) {
    background-color: #f9f9f9;
}

/* Success/Error message styling */
p {
    font-size: 16px;
    color: #333;
}

p.error {
    color: red;
}

p.success {
    color: green;
}

    </style>
</head>
<body>
    <div class="container">
        <p>Hello, <?php echo $_SESSION['username']; ?>! <a href="logout.php">Logout</a></p>

        <!-- Add User Form -->
        <h3>Add New User</h3>
        <form method="POST" action="admin_manage_users.php">
            <label for="new_username">Username:</label><br>
            <input type="text" id="new_username" name="new_username" required><br><br>
            <label for="new_password">Password:</label><br>
            <input type="password" id="new_password" name="new_password" required><br><br>
            <input type="submit" name="add_user" value="Add User">
        </form>

        <hr>

        <!-- List Users and Delete -->
        <h3>Manage Users</h3>
        <table class="user-table">
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Action</th>
            </tr>
            <?php while ($user = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $user['id']; ?></td>
                <td><?php echo $user['username']; ?></td>
                <td>
                    <form method="POST" action="admin.php">
                        <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                        <input type="submit" name="delete_user" value="Delete">
                    </form>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>

<?php
include 'partails/footer.php';
// Send all the content to the browser and end buffering
ob_end_flush();
?>
