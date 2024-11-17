<?php
// Include database connection
include('partails/menu.php'); // Ensure this file contains the $conn variable for the database connection

// Fetch chef data from the database
$sql = "SELECT * FROM chefs";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Chef Photos</title>
    <link rel="stylesheet" href="path/to/bootstrap.min.css"> <!-- Bootstrap or custom CSS -->
</head>
<body>

    <div class="container mt-5">
        <h2>Chef Photos</h2>

        <!-- Add actions (e.g., delete, edit) -->
        <a href="upload_chef.php" class="btn btn-success btn-md">Add photo</a>
        <br />
        <br />

        <!-- Display message for upload success or error -->
        <?php if (isset($_GET['message'])): ?>
            <div class="alert alert-info"><?php echo htmlspecialchars($_GET['message']); ?></div>
        <?php endif; ?>

        <!-- Display chef photos in a table -->
        <?php if ($result->num_rows > 0): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Photo</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['description']); ?></td>
                            <td>
                                <!-- Display the photo -->
                                <img src="<?php echo $row['photo_path']; ?>" alt="Chef Photo" width="100">
                            </td>
                            <td>
                                <!-- Add actions (e.g., delete, edit) -->
                                <a href="delete_chef.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No chef photos found in the database.</p>
        <?php endif; ?>
    </div>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
