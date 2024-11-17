<?php include('config/db_connection.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Twinz Cafe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9f9;
            margin: 0;
            padding: 0;
        }
        header {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            transition: top 0.3s;
            margin-bottom: 10px;
        }
        
        .hero-section {
            background-image: url('image/uploads/9.jpg');
            background-size: cover;
            background-position: center;
            height: 400px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
        }
        .section-title {
            text-align: center;
            margin-bottom: 40px;
        }
        .menu-item, .drink-item {
            text-align: center;
            margin-bottom: 30px;
        }
        .menu-item img, .drink-item img {
            width: 100%;
            max-width: 250px;
            border-radius: 8px;
            margin-bottom: 15px;
        }
        .footer {
            background-color: #333;
            color: white;
            padding: 20px 0;
            text-align: center;
        }
        .mobile-nav {
            display: none;
        }
        .menu-button {
            display: none;
        }
        @media (max-width: 576px) {
            .menu-button {
                display: inline-block;
            }
            .nav.d-md-flex {
                display: none;
            }
            .mobile-nav {
                display: flex;
                flex-direction: column;
                background-color: #f9f9f9;
                position: absolute;
                top: 60px;
                right: 0;
                width: 100%;
                text-align: center;
                display: none; /* Initially hidden */
                z-index: 1000;
            }
            .close-btn {
                font-size: 24px;
                color: black;
                cursor: pointer;
                margin: 10px;
            }
        }
    </style>
</head>
<body>

<!-- Header -->
<header class="bg-dark py-3">
    <div class="container d-flex justify-content-between align-items-center">
        <h1 class="logo"style="color: white;">Twinz Cafe</h1>
        <nav class=".header">
            <i class="fas fa-bars menu-button" id="menuButton" style="cursor: pointer;"></i>
            <ul class="nav d-none d-md-flex">
                <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="menu.php" class="nav-link">Menu</a></li>
                <li class="nav-item"><a href="gallery.php" class="nav-link">Gallery</a></li>
                <li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
                <li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
                <li class="nav-item"><a href="reservation.php" class="nav-link"></a></li>
            </ul>
            <ul class="nav mobile-nav" id="mobileNav" style="display: none;">
                <li class="close-btn" id="closeBtn" style="cursor: pointer;">&times;</li>
                <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="menu.php" class="nav-link">Menu</a></li>
                <li class="nav-item"><a href="gallery.php" class="nav-link">Gallery</a></li>
                <li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
                <li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
                <li class="nav-item"><a href="reservation.php" class="nav-link"></a></li>
            </ul>
        </nav>
    </div>
</header>

<script>
    // Hide/show header on scroll
    let lastScrollTop = 0;
    const header = document.querySelector('header');

    window.addEventListener('scroll', function() {
        let currentScroll = window.pageYOffset || document.documentElement.scrollTop;

        if (currentScroll > lastScrollTop) {
            // User is scrolling down - hide header
            header.style.top = '-70px';
        } else {
            // User is scrolling up - show header
            header.style.top = '0';
        }

        lastScrollTop = currentScroll <= 0 ? 0 : currentScroll;
    });

    // Mobile menu toggle
    const menuButton = document.getElementById('menuButton');
    const closeBtn = document.getElementById('closeBtn');
    const mobileNav = document.getElementById('mobileNav');

    menuButton.addEventListener('click', () => {
        mobileNav.style.display = 'block';
    });

    closeBtn.addEventListener('click', () => {
        mobileNav.style.display = 'none';
    });
</script>

</body>
</html>
