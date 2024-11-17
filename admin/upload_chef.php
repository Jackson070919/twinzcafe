<?php
// Include database connection
include('partails/menu.php'); // Ensure this file contains the $conn variable for the database connection

// Initialize message variable
$message = "";

// Check if the form was submitted
if (isset($_POST['upload'])) {
    // Get the data from the form
    $name = $_POST['name'];
    $description = $_POST['description'];
    $photo = $_FILES['photo'];

    // Check if photo upload is successful
    if ($photo['error'] == 0) {
        // Validate file type (only allow images)
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($photo['type'], $allowedTypes)) {
            $message = "Invalid file type. Only JPG, PNG, or GIF files are allowed.";
        } else {
            // Specify the directory where the photo will be uploaded
            $targetDir = "image/chefs/"; // Folder for chef photos (ensure this directory exists)
            // Get the file name and ensure it is safe
            $photoName = basename($photo['name']);
            $photoName = preg_replace("/[^a-zA-Z0-9\-_\.]/", "_", $photoName); // Replace unwanted characters
            // Set the target path
            $targetFile = $targetDir . $photoName;

            // Check if the file size is less than the limit (2 MB)
            $maxSize = 2 * 1024 * 1024; // 2 MB
            if ($photo['size'] > $maxSize) {
                $message = "File size exceeds the 2 MB limit.";
            } else {
                // Check if the directory exists, create it if it doesn't
                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0777, true); // Create the folder with permissions
                }

                // Move the uploaded photo to the target directory
                if (move_uploaded_file($photo['tmp_name'], $targetFile)) {
                    // Prepare the SQL statement to insert chef data into the database
                    $stmt = $conn->prepare("INSERT INTO chefs (name, photo_path, description) VALUES (?, ?, ?)");
                    $stmt->bind_param("sss", $name, $targetFile, $description);

                    if ($stmt->execute()) {
                        $message = "Chef photo uploaded successfully!";
                    } else {
                        $message = "Database error: " . $stmt->error;
                    }

                    $stmt->close();
                } else {
                    $message = "Failed to upload the photo.";
                }
            }
        }
    } else {
        $message = "Error with the photo file.";
    }
}

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Chef Photo</title>
    <link rel="stylesheet" href="path/to/bootstrap.min.css"> <!-- Bootstrap or custom CSS -->
    <style type="text/css">
        form .form-group{
            width: 50%;
            align-items: center;
            height: auto;
        }
    </style>
</head>
<body>

    <div class="container mt-5">
        <h2>Upload Chef Photo</h2>

        <!-- Display message -->
        <?php if ($message != ""): ?>
            <div class="alert alert-info"><?php echo $message; ?></div>
        <?php endif; ?>

        <!-- Form to upload chef photo -->
        <form action="upload_chef.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Chef's Name:</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" id="description" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="photo">Upload Photo:</label>
                <input type="file" name="photo" id="photo" class="form-control" required>
            </div>
            <button type="submit" name="upload" class="btn btn-primary mt-3">Upload Photo</button>
        </form>
    </div>

</body>
</html>
