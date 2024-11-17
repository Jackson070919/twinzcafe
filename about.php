<?php include('partails-front/menu.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | Twinz Cafe</title>
    <link rel="stylesheet" href="styles.css">
    <style type="text/css">
        /* General Styles */
        body, html {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        /* Banner Section */
        .banner {
            position: relative;
            width: 100%;
            height: 400px;
            overflow: hidden;
        }

        .banner img{
            width: 100%;
            height: 70vh;
        }

        .banner-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: brightness(70%);
        }

        .banner-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #fff;
            text-align: center;
        }

        .banner-text h1 {
            font-size: 2.5em;
            margin: 0;
        }

        .banner-text p {
            font-size: 1.2em;
            margin: 0.5em 0 0;
        }

        /* About Section */
        .about-section {
            padding: 2em;
            background-color: #f4f4f4;
        }

        .about-section .container {
            max-width: 800px;
            margin: auto;
            text-align: center;
        }

        .about-section h2 {
            font-size: 2em;
            margin-bottom: 1em;
        }

        .about-section p {
            font-size: 1em;
            line-height: 1.6;
            color: #555;
        }

        /* Chefs Section */
        .chefs-section {
            padding: 2em;
            background-color: #fff;
        }

        .chefs-section .container {
            max-width: 1000px;
            margin: auto;
            text-align: center;
        }

        .chefs-section h2 {
            font-size: 2em;
            margin-bottom: 1em;
        }

        .chef-profile {
            display: inline-block;
            width: 200px;
            margin: 1em;
            text-align: center;
        }

        .chef-photo {
            width: 100%;
            border-radius: 50%;
            height: 200px;
            object-fit: cover;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .chef-name {
            font-size: 1.2em;
            font-weight: bold;
            margin-top: 0.5em;
        }

        .chef-bio {
            font-size: 0.9em;
            color: #555;
        }

    </style>
</head>
<body>

<!-- Banner Section -->
<section class="banner">
    <img src="image/gallery/black_coffee.jpeg" alt="Welcome to Twinz Cafe" class="banner-image">
    <div class="banner-text">
        <h1>Welcome to Twinz Cafe</h1>
        <p>Where every cup tells a story</p>
    </div>
</section>

<!-- About Section -->
<section class="about-section">
    <div class="container">
        <h2>Our Story</h2>
        <p>At Twinz Cafe, we believe in the magic of bringing people together over coffee. Founded by twin siblings with a shared passion for delicious brews and cozy atmospheres, our cafe is a warm, welcoming space where everyone feels at home. Each cup we serve tells a story of dedication, quality, and love for coffee.</p>

        <p>Whether you're here for a quick espresso or a leisurely brunch with friends, Twinz Cafe is your escape from the hustle and bustle, a place to relax and savor life's simple pleasures. Join us for a taste of our signature blends, delightful pastries, and a unique experience crafted just for you.</p>
    </div>
</section>

<!-- profiles   Section -->
  <div class="profile-container">

    <img src="image/yvone.jpg" alt="Profile Picture" class="profile-picture">
    <p class="profile-description">Welcome to Twins Cafe! We’re two sisters who turned a love for coffee and community into a cozy corner where everyone is welcome. Enjoy our story, our flavors, and become part of our family!</p>
    <style type="text/css">
        .profile-container {
            text-align: center; /* Centers the content */
            padding: 30px;
        }

        .profile-picture {
            width: 350px; /* Size of the profile picture */
            height: 350px;
            border-radius: 50%; /* Makes the image circular */
            object-fit: cover;
            background-color: transparent; /* Removes background if any */
        }

        .profile-description {
            margin-top: 15px;
            font-size: 1.1em;
            color: #333; /* Adjust text color as needed */
            max-width: 600px; /* Optional: Limits width of text for readability */
            margin: 0 auto;
        }

    </style>
</div>


</body>
</html>
<?php include('partails-front/footer.php'); ?>
