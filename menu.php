<?php
// Start session and include the database connection
include('partails-front/menu.php');

// Fetch menu items from the database
$sql = "SELECT * FROM menu_items";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu | Twinz Cafe</title>    <link rel="stylesheet" href="../css/style.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>

    .container{
        padding-top: 30px;
    }
    .menu-item {
        border: 1px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .menu-item:hover {
        transform: scale(1.05);
        box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
    }

    .menu-item img {
        max-height: 200px;
        object-fit: cover;
    }

    .card-body {
        padding: 1rem;
    }

    .price {
        font-size: 1.2em;
        font-weight: bold;
        color: #28a745;
    }

    .menu-heading, .menu-subheading {
        margin-bottom: 1rem;
        font-size: 1.1em;
    }

    .menu-heading {
        font-weight: bold;
    }

    </style>
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center" style="margin-top: 40px; font-size: 2.5em;">OUR MENU</h2>

    <!-- Page Heading -->
    <div class="menu-heading text-center">
        Order with us the favorite food for your family!
    </div>
    <div class="menu-subheading text-center">
        Discover our delicious offerings below and treat yourself and your loved ones.
    </div>

    <div class="row mt-4">
        <?php
        if (isset($result) && $result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                // Extract data with safe fallback values
                $id = $row['id'] ?? 0;
                $name = $row['name'] ?? 'Unknown Item';
                $price = $row['price'] ?? 0;
                $image_url = $row['image_url'] ?? '';
                ?>
                <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-4">
                    <div class="menu-item card h-100 text-center">
                        <?php if (!empty($image_url)) { ?>
                           <img src="<?php echo str_replace('../', '', $image_url); ?>" alt="<?php echo htmlspecialchars($name); ?>" class="img-fluid card-img-top">
                        <?php } else { ?>
                            <img src="images/default-item.jpg" 
                                 alt="Default Image" 
                                 class="img-fluid card-img-top">
                        <?php } ?>

                        <div class="card-body">
                            <h4 class="card-title"><?php echo htmlspecialchars($name); ?></h4>
                            <p class="price text-success">Shs. <?php echo number_format($price, 2); ?></p>

                            <!-- Order button form for each item -->
                            <form action="order.php" method="POST">
                                <input type="hidden" name="item_id" value="<?php echo $id; ?>">
                                <input type="hidden" name="item_name" value="<?php echo htmlspecialchars($name); ?>">
                                <input type="hidden" name="price" value="<?php echo $price; ?>">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="btn btn-success btn-sm">Order</button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<p class='text-center mt-4'>No menu items available.</p>";
        }
        ?>
    </div>
</div>


<?php include('partails-front/footer.php'); ?>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>

<?php
mysqli_close($conn);
?>
