<?php
include('partails/menu.php');

$query = "SELECT * FROM menu_items";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Menu</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        
        /* Container Styling */
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding-top: 30px;
        }

        /* Heading Styling */
        h1.text-center {
            text-align: center;
            margin-bottom: 30px;
        }

        /* Button Styling */
        .btn {
            padding: 8px 15px;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background-color: #007bff;
            color: #fff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: #fff;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .btn-danger {
            background-color: #dc3545;
            color: #fff;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            text-align: left;
            padding: 12px;
            border: 1px solid #ddd;
        }

        th {
            background-color: #337;
        }

        td img {
            max-width: 100px;
            border-radius: 8px;
        }

        /* Media Queries for Responsiveness */
        @media (max-width: 768px) {
            h1.text-center {
                font-size: 24px;
            }

            table {
                font-size: 14px;
                border: none;
            }

            th, td {
                padding: 8px;
            }

            td img {
                max-width: 60px;
            }

            .btn {
                font-size: 14px;
                padding: 6px 10px;
            }

            .btn-primary, .btn-secondary, .btn-danger {
                font-size: 14px;
                margin: 5px 0;
            }
        }

        @media (max-width: 480px) {
            th, td {
                font-size: 12px;
                padding: 6px;
            }

            table {
                font-size: 12px;
            }

            td img {
                max-width: 50px;
            }

            .btn {
                font-size: 12px;
                padding: 5px 8px;
            }

            .container {
                width: 95%;
            }
        }

    </style>
</head>
<body>

<div class="container">
    <h1 class="text-center">Manage Menu</h1>

    <div class="text-center mb-3">
        <a href="add-menu-item.php" class="btn btn-primary">Add New Item</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Category</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['category']); ?></td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['description']); ?></td>
                    <td>Shs.<?php echo number_format($row['price'], 2); ?></td>
                    <td><img src="<?php echo htmlspecialchars($row['image_url']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>"></td>
                    <td>
                        <a href="edit-menu-item.php?id=<?php echo $row['id']; ?>" class="btn btn-secondary">Edit</a> |
                        <a href="delete-menu-item.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>
