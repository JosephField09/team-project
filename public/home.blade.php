<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags, title, CSS and JS -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="icon" type="image/png" href="/team-project/public/assets/favicon.png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="/team-project/public/css/style.css" >
    <script src="/team-project/public/js/app.js"></script>
</head>

<body>
    <main>
        <!-- Header Section -->
        <section id="header">
            <nav>
                <div class="navbar-left">
                    <a href="/team-project/public/home.blade.php"><img src="/team-project/public/assets/E-spresso_logo.jpg"></a>
               </div>
                <div class="navbar-middle">
                    <a class="middle option-selected" href="/team-project/public/home.blade.php">Home</a>
                    <a class="middle" href="/team-project/resources/views/products.blade.php">Products</a>
                    <a class="middle" href="/team-project/resources/views/about-us.blade.php">About Us</a>
                    <a class="middle" href="/team-project/resources/views/blog.blade.php">Blog</a>
                </div>
                <div class="navbar-right">
                    <a class="login" href="/team-project/resources/views/frontend/login.php">Login</a>
                    <p>|</p>
                    <a class="basket" href="/team-project/resources/views/basket.blade.php"><i class='bx bx-basket'></i></a>
                </div>
            </nav>
        </section>

        <!-- Footer Section -->
        <section id="footer">
            <footer class="top">
            <div class="logo-desc-soc">
                <div class="logo">
                    <a href="/team-project/public/home.blade.php"><img src="/team-project/public/assets/E-spresso_logo.jpg"></a>
                </div>
                <p class="desc">At E-spresso, we’re passionate about delivering the perfect coffee experience. From premium beans to convenient pods, we offer a selection to satisfy every coffee lover’s taste. Whether you’re a coffee connoisseur or just beginning your journey, Our store is your gateway to a world of rich flavors and aromatic delights.</p>
                <div class="socials">
                    <ul class="social-links">
                        <i class='bx bxl-facebook-circle'></i>
                        <i class='bx bxl-instagram-alt' ></i>
                        <i class='bx bxl-linkedin-square' ></i>
                        <i class='bx bxl-pinterest' ></i>
                    </ul>
                </div>
            </div>
            <div class="quick-links">
                <h3>Quick Links</h3>
                <ul class="links">
                    <li><a href="/team-project/public/home.blade.php">Home</a></li>
                    <li><a href="/team-project/resources/views/products.blade.php">Products</a></li>
                    <li><a href="/team-project/resources/views/about-us.blade.php">About Us </a></li>
                    <li><a href="/team-project/resources/views/blog.blade.php">Blog</a></li>
                </ul>
            </div>

            <div class="information">
                <h3>Information</h3>
                <ul class="details">
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Terms & Conditions</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                </ul>
            </div>

            <div class="contact-information">
                <h3>Contact Info</h3>
                <ul class="info">
                    <li>
                        <i class="bx bx-phone"></i
                        ><a href="tel:+44 1234 567890">+44 1234 567890</a>
                    </li>
                    <li>
                        <i class="bx bx-envelope"></i
                        ><a href="mailto:espressoadmin@gmail.com" :
                        >espressoadmin@gmail.com</a
                        >
                    </li>
                    <li>
                        <i class="bx bx-building"></i>
                        <a href="https://maps.app.goo.gl/acBvLWsSNhHqHQcG7">Aston University, Aston St, Birmingham B4 7ET</a>
                    </li>
                </ul>
            </div>
            </footer>
            <footer class="bottom">
            <div class="footer">
                <p>© E-SPRESSO | All Rights Reserved</p>
            </div>
            </footer>
        </section>
    </main>
</body>