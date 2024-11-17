<?php include('partails-front/menu.php'); ?>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
        }
        .contact-section {
            padding: 50px 0;
            background-color: #fff;
            background-image: url(image/image1.jpg);
            background-size: cover;
        }
        .contact-section h2 {
            margin-bottom: 30px;
            font-size: 3.5rem;
            color: white;
        }
        .contact-form .form-control {
            margin-bottom: 15px;
        }
        .contact-info {
            background-color: #f7f7f7;
            padding: 50px 0;
            text-align: center;
        }
        .contact-info h4 {
            font-size: 1.8rem;
        }
        .contact-info p {
            font-size: 1.1rem;
            margin-bottom: 10px;
        }
        .map {
            height: 400px;
        }
        .footer {
            background-color: #333;
            color: white;
            padding: 20px 0;
            text-align: center;
        }
    </style>

    <!-- Contact Form Section -->
    <section class="contact-section">
        <div class="container">
            <h2 class="text-center" style="margin-top:100px;">Get in Touch</h2>
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8 col-12">
                    <form action="contact_process.php" method="POST">
                        <div class="mb-3">
                            <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                        </div>
                        <div class="mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Your Email" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="phone" class="form-control" placeholder="Phone Number (optional)">
                        </div>
                        <div class="mb-3">
                            <textarea name="message" class="form-control" rows="5" placeholder="Your Message" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

   <!-- Contact Information Section -->
    <section class="contact-info">
        <div class="container">
            <h4>Contact Information</h4>
            <p>123 Food Street, Gourmet City</p>
            <p>Phone: +256 705 897 437</p>
            <p>Email: info@restaurant.com</p>
            <p>Support Hours: Mon-Sat: 9am - 10pm</p>
        </div>
    </section>
    <!-- Google Map Integration (Optional) -->
    <section class="map">
        <div class="container-fluid">
            <!-- Bootstrap responsive embed -->
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1680.5914578470672!2d32.62664987385678!3d0.24693326412881453!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x177d954b4906b55b%3A0xd9ef630296d07696!2sTwinz%20cafe!5e1!3m2!1sen!2sug!4v1731167431011!5m2!1sen!2sug" 
                    width="100%" 
                    height="400" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </section>

<?php include('partails-front/footer.php'); ?>
