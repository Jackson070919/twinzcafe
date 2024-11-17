
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - Twinz Cafe</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>

        .faq-container {
            padding: 30px;
            background-color: #f9f9f9;
        }
        .faq-title {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
        }
        .faq-section {
            margin-top: 30px;
        }
        .faq-section h3 {
            font-size: 1.25rem;
            font-weight: bold;
            color: #007bff;
            cursor: pointer;
        }
        .faq-answer {
            padding: 10px 15px;
            margin-top: 5px;
            background-color: #e9ecef;
            border-radius: 5px;
            display: none;
        }
        /* Styling for navigation */
        .nav-link {
            font-size: 1.1rem;
            color: #333;
        }
        .nav-link:hover {
            color: #007bff;
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
                        <a class="nav-link" href="FAQ.php">FAQ</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- FAQ Content -->
    <div class="container faq-container">
        <h1 class="faq-title">Frequently Asked Questions</h1>

        <div class="faq-section">
            <h3 onclick="toggleAnswer('faq1')">1. What are your opening hours?</h3>
            <div id="faq1" class="faq-answer">
                <p>We are open from Monday to Saturday, 9:00 AM to 10:00 PM. We are closed on Sundays.</p>
            </div>
        </div>

        <div class="faq-section">
            <h3 onclick="toggleAnswer('faq2')">2. Do you offer home delivery?</h3>
            <div id="faq2" class="faq-answer">
                <p>Yes, we offer home delivery services within the city. Delivery charges may apply depending on the location.</p>
            </div>
        </div>

        <div class="faq-section">
            <h3 onclick="toggleAnswer('faq3')">3. How can I make a reservation?</h3>
            <div id="faq3" class="faq-answer">
                <p>You can make a reservation by calling us at +256 740417681 or by using our online reservation system on the website.</p>
            </div>
        </div>

        <div class="faq-section">
            <h3 onclick="toggleAnswer('faq4')">4. Do you have vegetarian and vegan options?</h3>
            <div id="faq4" class="faq-answer">
                <p>Yes, we have a variety of vegetarian and vegan options available on our menu. Just ask our staff for recommendations!</p>
            </div>
        </div>

        <div class="faq-section">
            <h3 onclick="toggleAnswer('faq5')">5. Are pets allowed in the cafe?</h3>
            <div id="faq5" class="faq-answer">
                <p>Unfortunately, we do not allow pets inside the cafe, but service animals are welcome.</p>
            </div>
        </div>

        <div class="faq-section">
            <h3 onclick="toggleAnswer('faq6')">6. What payment methods do you accept?</h3>
            <div id="faq6" class="faq-answer">
                <p>We accept cash, major credit cards, and mobile payments. Please check with our staff for more details.</p>
            </div>
        </div>

        <div class="faq-section">
            <h3 onclick="toggleAnswer('faq7')">7. Do you offer catering services?</h3>
            <div id="faq7" class="faq-answer">
                <p>Yes, we offer catering services for events. Please contact us to discuss options and availability.</p>
            </div>
        </div>
    </div>

    <script>
        function toggleAnswer(id) {
            const answer = document.getElementById(id);
            if (answer.style.display === "none" || answer.style.display === "") {
                answer.style.display = "block";
            } else {
                answer.style.display = "none";
            }
        }
    </script>

    <!-- Include Footer -->
    <?php include('partails-front/footer.php'); ?>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
