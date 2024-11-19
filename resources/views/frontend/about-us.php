<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags, title, CSS and JS -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="icon" type="image/jpg" href="/team-project/public/assets/favicon.png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="/team-project/resources/css/style.css" >
    <script src="/team-project/resources/js/app.js"></script>
</head>

<body>
    <main>
        <!-- Header Section -->
        <section id="header">
            <nav>
                <div class="navbar-left">
                    <a href="/team-project/resources/views/frontend/index.php"><img src="/team-project/public/assets/E-spresso_logo.jpg"></a>
               </div>
                <div class="navbar-middle">
                    <a class="middle" href="/team-project/resources/views/frontend/index.php">Home</a>
                    <a class="middle" href="/team-project/resources/views/frontend/products.php">Products</a>
                    <a class="middle option-selected" href="/team-project/resources/views/frontend/about-us.php">About Us</a>
                    <a class="middle" href="/team-project/resources/views/frontend/blog.php">Blog</a>
                </div>
                <div class="navbar-right">
                    <a class="login" href="/team-project/resources/views/frontend/login.php">Login</a>
                    <p>|</p>
                    <a class="basket" href="/team-project/resources/views/frontend/basket.php"><i class='bx bx-basket'></i></a>
                </div>
            </nav>
        </section>

        <!-- Image Block Sections -->
        <section id="ImageBlocks">
            <!-- Our story Section -->
            <div class="ourstory">
                <img src="\team-project\public\assets\AdobeStock_835212991.jpeg" alt="Woman picking coffee beans" width=200 hieght=300 style="float: left;"></img>
                <div class="aboutustext">
                    <h3>About Us</h3>
                    <h1 class="header">Our Story, Your Coffee Experience</h1>
                    <p>At E-Spresso, we believe in more than just coffee - we create moments. From our handpicked beans to the perfect brew,
                        each cup is crafted with love and care. Whether you're here for a quick pick-me-up or to enjoy a relaxing moment, we're
                        dedicated to making every sip special. Join us in celebrating the art of coffee, brewed to perfection just for you.
                    </p>
                    <div class="promise">
                        <img src="\team-project\public\assets\check-mark.png" height="15px" width="15px"></img>
                        <h4>Sustainably Sourced Beans</h4>
                    </div>
                    <div class="promise">
                        <img src="\team-project\public\assets\check-mark.png" height="15px" width="15px"></img>
                        <h4>Sustainably Sourced Beans</h4>
                    </div>
                    <div class="promise">
                        <img src="\team-project\public\assets\check-mark.png" height="15px" width="15px"></img>
                        <h4>Sustainably Sourced Beans</h4>
                    </div>
                    <div class="promise">
                        <img src="\team-project\public\assets\check-mark.png" height="15px" width="15px"></img>
                        <h4>Sustainably Sourced Beans</h4>
                    </div>
                    <button class="contact-us"><h4>Contact us</h4></button>
                </div>
            </div>
            <div class="ourmission">
                <div class="aboutustext">
                        <h1 class="header">Our Mission</h1>
                        <p>At E-Spresso, our mission is to create a welcoming space where coffe lovers can gather,
                            connect, and enjoy the finest brews. We are committed to delivering exceptional experiences, one cup at a time.
                        </p>
                        <div class="missions">
                            <ul>
                                <li><p><span class="missionheader">Quality First:</span> We source the best beans from around the world to ensure every sip is a delight</p></li>
                                <li><p><span class="missionheader">Sustainability:</span> We priotitize eco-friendly practices to support a healthier planet.</p></li>
                                <li><p><span class="missionheader">Community Connection:</span> We aim to be more than just a coffee shop by fostering meaningful relationships with our customers</p></li>
                                <li><p><span class="missionheader">Continuos Innovation:</span> From classic blends to unique creations, we strive to keep our menu exciting and fresh.</p></li>
                            </ul>
                        </div>
                        <a class="contact-us" href="/team-project/resources/views/frontend/products.php"><h4>Explore Our menu</h4></a>
                </div>
                <img src="/team-project/public/assets/AdobeStock_814649831.jpeg" width=500 height=500 style="float: right;"></img>
            </div>
            <div class="ourvision">
                <img src="/team-project/public/assets/AdobeStock_859686298.jpeg" width="500px"></img>
                <div class="aboutustext">
                    <h1 class="header">Our Vision</h1>
                    <p>At E-Spresso, we strive to create a world where coffee inspires connections, fules creativity, and promotes sustainability. 
                    Our goal is to redefine the coffee experience and make a positive impact on both our community and the environment.
                    </p>
                    <div class="missions">
                        <ul>
                            <li><p><span class="missionheader">Connecting People:</span> Bringing communities together through coffee.</p></li>
                            <li><p><span class="missionheader">Sustainability:</span> Prioritising eco-friendly practices for a better planet.</p></li>
                            <li><p><span class="missionheader">QUality:</span>  Serving the finest coffee with care and precision.</p></li>
                            <li><p><span class="missionheader">Innovation:</span> Continuosly evolving to offer unique experiences</p></li>
                        </ul>
                    </div>
                    <a class="contact-us" href="/team-project/resources/views/frontend/products.php"><h4>Discover Our Product</h4></a>
                </div>
            </div>
        </section>

        <!-- Footer Section -->
        <section id="footer">
            <footer class="top">
            <div class="logo-desc-soc">
                <div class="logo">
                    <a href="/team-project/resources/views/frontend/index.php"><img src="/team-project/public/assets/E-spresso_logo.jpg"></a>
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
                    <li><a href="/team-project/resources/views/frontend/index.php">Home</a></li>
                    <li><a href="/team-project/resources/views/frontend/products.php">Products</a></li>
                    <li><a href="/team-project/resources/views/frontend/about-us.php">About Us </a></li>
                    <li><a href="/team-project/resources/views/frontend/blog.php">Blog</a></li>
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