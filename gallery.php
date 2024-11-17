<?php
// Include database connection
include('partails-front/menu.php');

// Fetch images from the gallery table
$query = "SELECT * FROM gallery ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>
    <link rel="stylesheet" href="styles.css">
    <style type="text/css">
        /* Global styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        h1 {
            text-align: center;
            font-size: 3.4em;
            margin: 20px 0;
        }

        .gallery {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
            padding: 0 10px;
        }

        .gallery-item {
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            cursor: pointer;
        }

        .gallery-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        /* Modal styles */
        .modal {
            display: none; /* Hidden by default */
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            max-width: 80%;
            max-height: 80%;
        }

        .modal img {
            width: 100%;
            height: auto;
        }

        .close {
            position: absolute;
            top: 20px;
            right: 30px;
            color: white;
            font-size: 2em;
            cursor: pointer;
        }

        /* Mobile first design (smaller screens) */
        @media (max-width: 767px) {
            .gallery-item {
                width: 48%;
            }

            .gallery-item img {
                height: 250px;
            }

            h1 {
                font-size: 2em;
            }
        }

        /* Tablet and larger screens */
        @media (min-width: 768px) and (max-width: 1024px) {
            .gallery-item {
                width: 48%;
            }

            .gallery-item img {
                height: 250px;
            }
        }

        /* Desktop screens */
        @media (min-width: 1025px) {
            .gallery-item {
                width: 23%;
            }

            .gallery-item img {
                height: 300px;
            }

            h1 {
                font-size: 3.4em;
            }
        }
    </style>
</head>
<body>
    <h1 class="text-center" style="margin-top: 200px;">Gallery</h1>
    <br />

    <div class="gallery">
        <?php
        // Loop through each image and display it
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <div class="gallery-item" onclick="openModal('<?php echo str_replace('../', '', $row['image_path']); ?>', '<?php echo htmlspecialchars($row['description']); ?>')">
                <img src="<?php echo str_replace('../', '', $row['image_path']); ?>" alt="<?php echo htmlspecialchars($row['description']); ?>" class="img-fluid card-img-top">
            </div>
        <?php
        }
        ?>
    </div>

    <!-- Modal to display full-size image -->
    <div id="imageModal" class="modal">
        <span class="close" onclick="closeModal()">&times;</span>
        <div class="modal-content">
            <img id="modalImage" src="" alt="">
        </div>
    </div>

    <script>
        // Function to open the modal
        function openModal(imageSrc, altText) {
            document.getElementById("modalImage").src = imageSrc;
            document.getElementById("modalImage").alt = altText;
            document.getElementById("imageModal").style.display = "flex";
        }

        // Function to close the modal
        function closeModal() {
            document.getElementById("imageModal").style.display = "none";
        }
    </script>

    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-3904279551176821"
     crossorigin="anonymous"></script>

</body>
</html>

<?php
include ('partails-front/footer.php');
// Close the connection
mysqli_close($conn);
?>
