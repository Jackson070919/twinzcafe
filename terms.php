
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms of Service - Twinz Cafe</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>

        .terms-container {
            padding: 40px;
            background-color: #f9f9f9;
        }
        .terms-title {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
        }
        .terms-section h4 {
            font-size: 1.25rem;
            font-weight: bold;
            color: #007bff;
            margin-top: 20px;
        }
        .terms-section p {
            text-align: justify;
        }

        /* Ensure the terms container and sections are responsive */
        .terms-container {
            max-width: 900px;
            margin: 0 auto;
        }

        @media (max-width: 768px) {
            .terms-title {
                font-size: 1.6rem;
            }
            .terms-section h4 {
                font-size: 1.1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Twinz Cafe</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">home </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="terms.php">Terms of Service</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="privacy.php">Privacy Policy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="faq.php">FAQ</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Terms of Service Content -->
    <div class="container terms-container">
        <h1 class="terms-title">Terms of Service</h1>

        <div class="terms-section">
            <h4>1. Acceptance of Terms</h4>
            <p>By accessing and using Twinz Cafe’s website, you agree to be bound by these Terms of Service and all applicable laws and regulations. If you do not agree with any of these terms, you are prohibited from using or accessing this site.</p>
        </div>

        <div class="terms-section">
            <h4>2. Use of Website</h4>
            <p>You are permitted to use our website for lawful purposes only. You agree not to use the website in any way that could damage the website, restrict other users, or interfere with its functionality.</p>
        </div>

        <div class="terms-section">
            <h4>3. Menu and Pricing</h4>
            <p>All menu items and prices listed on this website are subject to change without prior notice. We strive to ensure accuracy in our pricing and menu descriptions; however, errors may occur. Please contact us for the latest information.</p>
        </div>

        <div class="terms-section">
            <h4>4. Privacy Policy</h4>
            <p>Your privacy is important to us. Please refer to our Privacy Policy, which outlines how we collect, use, and protect your information. By using our website, you consent to the practices described in our Privacy Policy.</p>
        </div>

        <div class="terms-section">
            <h4>5. Reservation and Cancellation Policy</h4>
            <p>We offer reservations as a courtesy to our customers. However, we reserve the right to cancel reservations due to unforeseen circumstances. Any cancellation made within 24 hours of the reservation time may be subject to a cancellation fee.</p>
        </div>

        <div class="terms-section">
            <h4>6. Liability Limitations</h4>
            <p>Twinz Cafe shall not be held liable for any damages arising from the use or inability to use the materials on our website. We make no warranties, expressed or implied, regarding the completeness, accuracy, or reliability of the content on our website.</p>
        </div>

        <div class="terms-section">
            <h4>7. Changes to Terms</h4>
            <p>We may update our Terms of Service at any time without prior notice. By using this website, you agree to be bound by the current version of these terms. We encourage you to review our terms periodically to stay informed of any changes.</p>
        </div>

        <div class="terms-section">
            <h4>8. Contact Information</h4>
            <p>If you have any questions about our Terms of Service, please contact us at info@twinzcafe.com or by phone at +256 740417681.</p>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Include Footer -->
    <?php include('partails-front/footer.php'); ?>
</body>
</html>
