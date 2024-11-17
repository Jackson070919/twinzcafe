<?php
ob_start();
include('partails/menu.php');
$id = $_GET['id'];

// Retrieve the current item data
$query = "SELECT * FROM menu_items WHERE id = $id";
$result = $conn->query($query);
$item = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category = $_POST['category'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Handle file upload if a new file is uploaded
    $image_url = $item['image_url']; // Keep current image URL as default
    if (isset($_FILES['image_url']) && $_FILES['image_url']['error'] == 0) {
        $target_dir = "../image/uploads/";
        $target_file = $target_dir . basename($_FILES["image_url"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Validate file type (only allow jpg, jpeg, png, gif)
        $allowed_types = ["jpg", "jpeg", "png", "gif"];
        if (in_array($imageFileType, $allowed_types)) {
            // Move uploaded file to target directory
            if (move_uploaded_file($_FILES["image_url"]["tmp_name"], $target_file)) {
                $image_url = $target_file; // Update image URL for database
            } else {
                echo "Sorry, there was an error uploading your file.";
                exit;
            }
        } else {
            echo "Only JPG, JPEG, PNG & GIF files are allowed.";
            exit;
        }
    }

    // Update the database with new values
    $sql = "UPDATE menu_items SET 
            category='$category', name='$name', description='$description', 
            price='$price', image_url='$image_url' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        header("Location: admin_menu-items.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Menu Item</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Full-page flexbox container */
        .full-page {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 0 20px;
        }

        .container {
            width: 100%;
            max-width: 600px; /* Max width for the form */
        }

        /* Responsive adjustments for mobile screens */
        @media (max-width: 768px) {
            .container {
                width: 90%;
            }
        }

        /* Further tweaks for very small screens */
        @media (max-width: 480px) {
            .container {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="full-page">
        <div class="container">
            <h2 class="text-center">Edit Menu Item</h2>
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="category">Category:</label>
                    <input type="text" class="form-control" name="category" value="<?php echo $item['category']; ?>" required>
                </div>

                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" name="name" value="<?php echo $item['name']; ?>" required>
                </div>

                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea class="form-control" name="description" rows="4" required><?php echo $item['description']; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="text" class="form-control" name="price" value="<?php echo $item['price']; ?>" required>
                </div>

                <div class="form-group">
                    <label for="image_url">Image Upload:</label>
                    <input type="file" class="form-control" name="image_url">
                </div>

                <button type="submit" class="btn btn-primary btn-block">Save Changes</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php 
// Send all the content to the browser and end buffering
ob_end_flush();
?>
