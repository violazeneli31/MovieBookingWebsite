<?php
session_start();
?>

<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Viola's Theatre - Contact Page">
    <meta name="keywords" content="Contact, Theatre, Viola">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - viola's Theater</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/all.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/elegant-icons.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/nice-select.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/slicknav.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .map-responsive iframe {
            height: 100%;
            min-height: 500px;
        }
        .contact.spad {
            padding-top: 40px;
            padding-bottom: 60px;
        }
    </style>
</head>

<body>
<?php include("header.php"); ?>

<section class="contact spad">
    <div class="container">
        <div class="row align-items-stretch">
            <!-- Map Embed -->
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="map-responsive shadow rounded h-100">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2994.721747823479!2d19.80527411563972!3d41.31211697927171!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1350310a36f8ea65%3A0x48f6cc3530ab9cbd!2sKomuna%20e%20Parisit%2C%20Tiran%C3%AB!5e0!3m2!1sen!2s!4v1620386049652!5m2!1sen!2s" width="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="col-lg-6 d-flex align-items-center">
                <div class="contact__text ps-lg-4">
                    <div class="section-title mb-4">
                        <span class="text-primary">We're Here for You</span>
                        <h2 class="fw-bold">Contact viola's Theater</h2>
                        <p>We’re always ready to assist. Reach out to us via phone, email or visit us at our location.</p>
                    </div>
                    <ul class="list-unstyled fs-5">
                        <li class="mb-3">
                            <i class="fas fa-map-marker-alt me-2 text-primary"></i>
                            Komuna e Parisit, Tirana, Albania
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-phone-alt me-2 text-primary"></i>
                            Mobile: <strong>+355 68 123 4567</strong>
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-phone me-2 text-primary"></i>
                            Landline: <strong>+355 4 223 4567</strong>
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-envelope me-2 text-primary"></i>
                            Email: <a href="mailto:info@violas-theatre.al" class="text-decoration-none">info@violas-theatre.al</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include("footer.php"); ?>

<!-- JS Scripts -->
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.nice-select.min.js"></script>
<script src="js/jquery.nicescroll.min.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/jquery.countdown.min.js"></script>
<script src="js/jquery.slicknav.js"></script>
<script src="js/mixitup.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>


