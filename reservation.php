<?php include('partails-front/menu.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upcoming Booking Reservation</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Upcoming Booking Reservation</h3>
                    </div>
                    <div class="card-body">
                        <!-- User Information Section -->
                        <form>
                            <h5>User Information</h5>
                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter your full name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" placeholder="Enter your email" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="tel" class="form-control" id="phone" placeholder="Enter your phone number" required>
                            </div>

                            <!-- Reservation Details Section -->
                            <h5>Reservation Details</h5>
                            <div class="mb-3">
                                <label for="date" class="form-label">Reservation Date</label>
                                <input type="date" class="form-control" id="date" required>
                            </div>
                            <div class="mb-3">
                                <label for="time" class="form-label">Reservation Time</label>
                                <input type="time" class="form-control" id="time" required>
                            </div>
                            <div class="mb-3">
                                <label for="guests" class="form-label">Number of Guests</label>
                                <input type="number" class="form-control" id="guests" placeholder="Enter number of guests" min="1" required>
                            </div>

                            <!-- Confirmation Section -->
                            <div class="form-check mb-3">
                                <input type="checkbox" class="form-check-input" id="confirm" required>
                                <label class="form-check-label" for="confirm">I confirm the details are correct</label>
                            </div>
                            
                            <button type="submit" class="btn btn-primary w-100">Confirm Reservation</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies (for interactive components) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
</body>
</html>
