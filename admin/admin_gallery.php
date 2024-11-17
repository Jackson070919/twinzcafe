<?php
// Include database connection
include('partails/menu.php');

// Handle the file upload
if (isset($_POST['submit'])) {
    $description = $_POST['description'];
    $imagePath = '../image/gallery/' . basename($_FILES['image']['name']);
    
    // Move the uploaded file to the 'uploads' directory
    if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
        // Insert image data into the gallery table
        $query = "INSERT INTO gallery (image_path, description, created_at) VALUES ('$imagePath', '$description', NOW())";
        if (mysqli_query($conn, $query)) {
            echo "<div class='success'>Image uploaded successfully!</div>";
        } else {
            echo "Error uploading image: " . mysqli_error($conn);
        }
    } else {
        echo "<div class='error'>Error uploading file.</div>";
    }
}

// Handle image deletion
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $query = "DELETE FROM gallery WHERE id = $id";
    if (mysqli_query($conn, $query)) {
        echo "Image deleted successfully!";
    } else {
        echo "Error deleting image: " . mysqli_error($conn);
    }
}

// Fetch all images for the admin to manage
$query = "SELECT * FROM gallery ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Manage Gallery</title>
    <link rel="stylesheet" href="styles.css">
    <style type="text/css">
        /* General Styles */
        body, html {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .success{
            color: green;
        }
        .error{
            color: red;
        }

        .container {
            width: 90%;
            max-width: 600px;
            margin: 1em auto;
        }

        h1, h2 {
            text-align: center;
        }

        .form {
            display: flex;
            flex-direction: column;
            gap: 1em;
            width: 100%;
            background-color: #f9f9f9;
            padding: 1em;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .form label {
            font-weight: bold;
        }

        .form input[type="text"], .form input[type="file"] {
            width: 100%;
            padding: 0.5em;
            border-radius: 4px;
            border: 1px solid #ddd;
        }

        .btn {
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 0.5em 1em;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #218838;
        }

        /* Table Styles */
        table {
            width: 100%;
            max-width: 800px;
            margin: 1em auto;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 0.5em;
            text-align: center;
        }

        th {
            background-color: #f4f4f4;
            font-weight: bold;
        }

        img {
            max-width: 50px;
            height: auto;
        }


        /* Responsive Styles */
        @media (max-width: 768px) {
            .form, table {
                width: 100%;
            }

            table, th, td {
                font-size: 0.9em;
            }

            img {
                width: 80px;
            }
        }

        @media (max-width: 500px) {
            .container {
                padding: 0;
            }

            .form, table {
                width: 100%;
            }

            table, th, td {
                font-size: 0.8em;
            }

            .form input[type="text"], .form input[type="file"] {
                padding: 0.4em;
            }

            img {
                width: 70px;
            }

            /* Reduce padding for smaller screens */
            th, td {
                padding: 0.3em;
            }

            .btn {
                padding: 0.4em 0.8em;
                font-size: 0.9em;
            }
        }

        @media (max-width: 480px) {
            th, td {
                font-size: 0.8em;
                padding: 0.2em;
            }

            img {
                width: 60px;
            }

            .form input[type="text"], .form input[type="file"] {
                padding: 0.4em;
            }
        }
    </style>
</head>
<body>

    <h1>Manage Gallery</h1>
    <div class="container">

        <h2>Upload New Image</h2>
        <form class="form" action="admin_gallery.php" method="POST" enctype="multipart/form-data">
            <label for="image">Image: </label>
            <input type="file" name="image" id="image" required>
            
            <label for="description">Description: </label>
            <input type="text" name="description" id="description" required>
            
            <button class="btn" type="submit" name="submit">Upload Image</button>
        </form>
    </div>

    <h2>Manage Gallery</h2>
    <table>
        <thead>
            <tr>
                <th>Image</th>
                <th>Description</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td><img src='" . $row['image_path'] . "' alt='Gallery Image'></td>";
                echo "<td>" . htmlspecialchars($row['description']) . "</td>";
                echo "<td>" . $row['created_at'] . "</td>";
                echo "<td><a href='admin_gallery.php?delete=" . $row['id'] . "' class='btn'>Delete</a></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

</body>
</html>

<?php
include ('partails/footer.php');
// Close the connection
mysqli_close($conn);
?>
