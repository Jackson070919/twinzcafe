<?php
include('../config/db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category = $_POST['category'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image_url = ""; // Initialize empty image URL

    // Handle featured field
    $is_featured = ($_POST['featured'] == 'Yes') ? 1 : 0;  // Map Yes to 1, No to 0

    // Handle file upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "../image/uploads/"; // Folder for uploaded images
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check file type (allow only jpg, png, gif)
        $allowed_types = ["jpg", "jpeg", "png", "gif"];
        if (in_array($imageFileType, $allowed_types)) {
            // Move uploaded file to target directory
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $image_url = $target_file; // Store path to the image in the database
            } else {
                echo "Sorry, there was an error uploading your file.";
                exit;
            }
        } else {
            echo "Only JPG, JPEG, PNG & GIF files are allowed.";
            exit;
        }
    }

    // Insert data into the database
    $sql = "INSERT INTO menu_items (category, name, description, price, image_url, is_featured)
            VALUES ('$category', '$name', '$description', '$price', '$image_url', '$is_featured')";

    if ($conn->query($sql) === TRUE) {
        header("Location: admin_menu-items.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Menu Item</title>
    <style>
        /* Basic reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            height: auto;
            background-color: #f9f9f9;
        }

        /* Form container */
        .form {
            background-color: #fff;
            padding: 10%;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 50%;
            margin-right: 300px;
        }

        /* Form elements styling */
        h2 {
            margin-top: 20px;
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            font-weight: bold;
            color: #555;
            margin-bottom: 8px;
        }

        input[type="text"],
        textarea,
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        textarea {
            resize: vertical;
            min-height: 80px;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        /* Responsive design */
        @media (max-width: 500px) {
            form {
                padding: 15px;
            }

            h2 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>

    <h2>Add New Menu Item</h2>

    <form class="form" method="POST" enctype="multipart/form-data">
        <label>Category:</label><br>
        <input type="text" name="category" required><br>
        <label>Name:</label><br>
        <input type="text" name="name" required><br>
        
        <!-- Featured radio buttons -->
        <label>Featured:</label><br>
        <input type="radio" name="featured" value="Yes" required> Yes
        <input type="radio" name="featured" value="No" required> No
        <br><br>
        
        <label>Description:</label><br>
        <textarea name="description" required></textarea><br>
        
        <label>Price:</label><br>
        <input type="text" name="price" required><br>
        
        <label>Image Upload:</label><br>
        <input type="file" name="image" required><br>
        
        <button type="submit">Add Item</button>
    </form>

</body>
</html>
