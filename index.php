<?php 
include('partails-front/menu.php'); 

// Fetch only 3 featured dishes from the database
$sql = "SELECT * FROM menu_items WHERE is_featured = 1 LIMIT 3"; // Assuming 'is_featured' column indicates a featured dish
$menu_result = mysqli_query($conn, $sql);
?>
<style type="text/css">
    /* Container for slideshow */
.slideshow-container {
    position: relative;
    width: 100%;
    max-width: 100%;
    height: 70vh; /* Full viewport height */
    overflow: hidden;
}

/* Style each slide */
.slide {
    position: absolute;
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
    opacity: 0;
    transition: opacity 1s ease-in-out;
}

/* Text overlay styling */
.slide-text {
    position: absolute;
    bottom: 20%;
    left: 50%;
    transform: translateX(-50%);
    color: #fff;
    font-size: 1em;
    background: rgba(0, 0, 0, 0.5);
    padding: 10px 20px;
    border-radius: 5px;
}

/* Fade effect */
.fade {
    opacity: 0;
    transition: opacity 1s ease-in-out;
}

.slide.active {
    opacity: 1;
}
/* Set different background images for each slide */
.slide:nth-child(1) {
    background-image: url('image/image1.jpg'); /* Replace with your image URL */
}

.slide:nth-child(2) {
    background-image: url('image/image2.jpg'); /* Replace with your image URL */
}

.slide:nth-child(3) {
    background-image: url('image/image3.jpg'); /* Replace with your image URL */
}

</style>

<div class="slideshow-container">
    <div class="slide fade">
        <div class="slide-text">
        <h3> Welcome to Our Cafe</h3>
        <p>Where every cup tells a story, every bean is selected with care, and each sip warms the soul. </p>
    </div>
    </div>
    <div class="slide fade">
        <div class="slide-text">
            <h3>Enjoy Our Special Coffee</h3>
            <p>Indulge in the rich aroma and unique flavors of our specialty brews. Carefully crafted from the finest beans and roasted to perfection, each cup is a celebration of taste and quality.</p>
        </div>
    </div>
    <div class="slide fade">
        <div class="slide-text">
            <h3>Cozy Ambience Awaits</h3>
            <p>Step inside and feel the warmth of a space designed for comfort and connection. Soft lighting, cozy corners, and the gentle hum of good company—our café is a haven for relaxation and inspiration.</p>
        </div>
    </div>
</div>

    <!-- Featured Dishes Section -->
    <section class="featured-dishes py-5">
        <div class="container align-items-center">
            <h2 class="text-center mb-4">Featured Dishes</h2>
            <div class="row justify-content-center">
                <?php
                // Check if the query result exists and has rows
                if (isset($menu_result) && $menu_result && mysqli_num_rows($menu_result) > 0) {
                    while ($row = mysqli_fetch_assoc($menu_result)) {
                        // Safely extract data with fallback values
                        $id = $row['id'] ?? 0;
                        $name = $row['name'] ?? 'Unknown Dish';
                        $price = $row['price'] ?? 'N/A';
                        $image_url = $row['image_url'] ?? '';
                ?>
                    <div class="col-md-3 col-6 featured-dish mb-4">
                        <div class="dish-card">
                            <?php if (!empty($image_url)) { ?>
                                <img src="<?php echo str_replace('../', '', $image_url); ?>" alt="<?php echo htmlspecialchars($name); ?>" class="img-fluid dish-image" style="height: 50%;">
                            <?php } else { ?>
                                <div class="no-image text-center">Image not available</div>
                            <?php } ?>
                            <div class="overlay text-center">
                                <h4 class="dish-name"><?php echo htmlspecialchars($name); ?></h4>
                            </div>
                        </div>
                    </div>
                <?php 
                    } 
                } else {
                    echo "<p class='text-center'>No featured dishes found.</p>";
                }
                ?>
            </div> <!-- Closing div for row -->
        </div>
        <style type="text/css">
        .dish-card {
            position: relative;
            overflow: hidden;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        .dish-image {
            width: 100%;
            height: auto;
            max-height: 200px;
            object-fit: cover;
        }
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
        }
        .dish-card:hover .overlay {
            opacity: 1;
        }

    .no-image {
        width: 100%;
        height: 200px;
        display: flex;
        justify-content: center;
        align-items: center;
        background: #f7f7f7;
        color: #999;
        border: 1px dashed #ccc;
    }


        </style>
    </section>


<!-- Google AdSense Script -->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-3904279551176821"
     crossorigin="anonymous"></script>
     <!--ends Google AdSense Script -->

<div class="container my-5">
    <div class="row align-items-center">
        <!-- Text Content (Left) -->
        <div class="col-md-6">
            <h2 class="section-title">About Our Caf'e</h2>
            <p class="section-paragraph">
                Twinz Caf'e is a cozy and inviting dining spot known for its delicious selection of dishes that cater to a wide variety of tastes. Located in an accessible area, Twinz Caf'e prides itself on providing a delightful experience for customers, whether they’re stopping by for a quick meal or enjoying a leisurely coffee.
            </p>
            <p class="section-paragraph">
                Whether you're here for a quick bite, a leisurely brunch with friends, or a special celebration, our warm and inviting space is designed for every occasion. We pride ourselves on providing exceptional service, ensuring that every visit feels like a special experience.
            </p>
            <p class="section-paragraph">Join us at Twinz Caf'e and discover why we are a favorite among locals and visitors alike. We can’t wait to serve you!</p>
        </div>

        <!-- Image (Right) -->
        <div class="col-md-6">
            <img src="image/image4.jpg" alt="Company Image" class="img-fluid rounded shadow-sm">
        </div>
    </div>
    <style type="text/css">
        /* General container and text styling */
.container {
    max-width: 1200px;
}

.section-title {
    font-size: 2rem;
    font-weight: 700;
    color: #333;
    margin-bottom: 20px;
}

.section-paragraph {
    font-size: 1.1rem;
    color: #555;
    line-height: 1.8;
    margin-bottom: 15px;
}

/* Emphasis style for key phrases */
.section-paragraph strong {
    color: #ff5722; /* Accent color for highlights */
}

/* Shadow and border for image */
.img-fluid {
    border-radius: 10px;
    box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
}

/* Responsive improvements */
@media (max-width: 768px) {
    .section-title {
        font-size: 1.8rem;
    }

    .section-paragraph {
        font-size: 1rem;
    }
}

    </style>
</div>

<script type="text/javascript">
    let currentSlide = 0;
const slides = document.querySelectorAll('.slide');

function showSlides() {
    slides.forEach((slide, index) => {
        slide.style.opacity = "0";
        slide.classList.remove('active');
    });
    currentSlide = (currentSlide + 1) % slides.length;
    slides[currentSlide].style.opacity = "1";
    slides[currentSlide].classList.add('active');
}

// Change slide every 3 seconds
setInterval(showSlides, 3000);

// Initialize first slide
showSlides();

</script>

<!-- Footer Section -->
<?php include('partails-front/footer.php'); ?>
