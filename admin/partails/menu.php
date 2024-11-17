<?php
// Include database connection
include('../config/db_connection.php');
include 'login-check.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap CSS and Font Awesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style type="text/css">
        /* Main Content Styling */
        .main-content {
            margin: 20px;
        }

        /* Table Styling */
        .tbl-full {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 18px;
            text-align: left;
        }

        .tbl-full th, .tbl-full td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }

        .tbl-full th {
            background-color: #007bff;
            color: white;
        }

        /* Button Styling */
        .btn-primary, .btn-secondary, .btn-danger {
            padding: 10px 15px;
            border: none;
            color: white;
            text-decoration: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .btn-primary {
            background-color: #007bff; /* Bootstrap primary color */
        }

        .btn-secondary {
            background-color: #6c757d; /* Bootstrap secondary color */
        }

        .btn-danger {
            background-color: #dc3545; /* Bootstrap danger color */
        }

        /* Hover Effects for Buttons */
        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        /* Message Styling */
        .message {
            margin: 20px 0;
            padding: 10px;
            border-radius: 5px;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
        }

        .notification-badge {
            background-color: #ff3b3b;
            color: white;
            border-radius: 50%;
            padding: 3px 7px;
            font-size: 12px;
            position: relative;
            top: -5px;
            right: -10px;
        }

        /* Responsive Navbar adjustments */
        @media (max-width: 768px) {
            .navbar-nav {
                text-align: center;
            }

            .navbar-nav .nav-item {
                margin-bottom: 10px;
            }

            .navbar-brand {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 576px) {
            .main-content {
                padding: 15px;
            }

            .tbl-full th, .tbl-full td {
                font-size: 14px;
                padding: 8px;
            }
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Admin Panel</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_orders.php">Manage Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_contacts.php">manage contacts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_menu-items.php">Manage Menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_gallery.php">Manage Gallery</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_manage_users.php">Manage Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_reports.php">Reports</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>


<!-- Bootstrap and JavaScript -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.5/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
