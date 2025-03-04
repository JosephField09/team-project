<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags, title, CSS, and JS -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/favicon.png') }}">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tabletstyle.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/responsive.js') }}"></script>
</head>

<body>
    <main>
        <!-- Header Section -->
        @include('layouts.navbar')

        <!-- Contact Us Section -->
         <section id="ContactUs">
            <div class="side-img">
                <img src="{{ asset('assets/AdobeStock_1026464614.jpeg') }}"></img>
            </div>
            <div class="contact-us-form">
                <form id="contact-us">
                    <h1 id="contact-us-heading">Contact Us</h1>
                    <div class="first-and-last-name">
                        <div class="first-name">
                            <label for="fName">First Name</label>
                            <input id ="fName "type ="text" name="fName" placeholder="Enter Your First Name" class="input-field" require/>
                        </div>
                        <div class="last-name">
                            <label for="lName">Last Name</label>
                            <input id ="lName "type ="text" name="lName" placeholder="Enter Your Last Name" class="input-field" require/>
                        </div>
                    </div>
                    <div class="email-and-phone">
                        <div class="email">
                            <label for="email">Email</label>
                            <input id="email" type="email"  name="email" placeholder="Enter your Email" class="input-field" require>
                        </div>
                        <div class="phone">
                            <label for="phone">Phone</label>
                            <input id="phone" type="text" id="phone" name="phone" placeholder="Enter Your Phone number" class="input-field" require/>
                        </div>
                    </div>
                    <div class="message-to-send">
                        <label for="message">Message</label>
                        <textarea rows="5" cols="50" id="uMessage" name="uMessage" form="contactusform" class="input-field"
                        placeholder="Write Message Here..." require></textarea>
                    </div>
                    <p class="error-message" id="formError"></p>
                    <div class ="submit-form">
                        <button type="submit" id="submit-form-btn">Submit Now</button>
                    </div>
                </form>
                <script src="{{ asset('js/contact-us.js') }}" ></script>
            </div>
        </section>

        <!-- Footer Section -->
        <section id="footer">
            <footer class="top">
                <!-- Logo description and social links -->
                <div class="logo-desc-soc">
                    <div class="logo">
                        <a href="{{ route('home') }}"><img src="{{ asset('assets/E-spresso_logo.jpg') }}"></a>
                    </div>
                    <p class="desc">At E-spresso, we're passionate about delivering the perfect coffee experience. From premium beans to convenient pods, we offer a selection to satisfy every coffee lover’s taste. Whether you’re a coffee connoisseur or just beginning your journey, Our store is your gateway to a world of rich flavors and aromatic delights.</p>
                    <div class="socials">
                        <ul class="social-links">
                            <i class='bx bxl-facebook-circle'></i>
                            <i class='bx bxl-instagram-alt' ></i>
                            <i class='bx bxl-linkedin-square' ></i>
                            <i class='bx bxl-pinterest' ></i>
                        </ul>
                    </div>
                </div>
                <!-- Quick Links Section -->
                <div class="quick-links">
                    <h3>Quick Links</h3>
                    <ul class="links">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('products') }}">Products</a></li>
                        <li><a href="{{ route('about-us') }}">About Us </a></li>
                        <li><a href="{{ route('contact-us') }}">Contact Us </a></li>
                        <li><a href="{{ route('blog') }}">Blog</a></li>
                        <li><a class="login" href="{{ route('admin.register') }}">Admin Register</a></li>
                        <li><a href="{{ route('reviews.create', 0) }}">Review E-Spresso</a></li>
                    </ul>
                </div>
                <!-- Information Section -->
                <div class="information">
                    <h3>Information</h3>
                    <ul class="details">
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Terms & Conditions</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                    </ul>
                </div>
                <!-- Contact Information Section -->
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
            <!-- Lower footer section -->
            <footer class="bottom">
                <div class="footer">
                    <p>© E-SPRESSO | All Rights Reserved</p>
                </div>
            </footer>
        </section>
    </main>
</body>
</html>
