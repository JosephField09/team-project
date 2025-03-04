<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags, title, CSS, and JS -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basket</title>
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

        <!-- Checkout Main Section -->
        <section id="checkout">
            <div class="checkout-main">
                <div class="checkout-form-section">
                    <h2>Checkout</h2>
                    <form action="{{ route('checkout.add') }}" method="POST" id ="checkout-Form">
                        @csrf
                        <div class="shipping">
                            <h3>Shipping</h3>
                            <hr width="90%" size="2"></hr>
                            <h4>Address: </h4>
                            <input id ="address "type ="text" name="address" placeholder="Enter Your Address" class="input-field" require/>
                            <h4>City: </h4>
                            <input id ="city "type ="text" name="city" placeholder="Enter Your City" class="input-field" require/>
                            <h4>Postcode: </h4>
                            <input id ="postcode "type ="text" name="postcode" placeholder="Enter Your Postcode" class="input-field" require/>
                        </div>
                        <div class="payment">
                            <h3>Payment</h3>
                            <hr width="90%" size="2"></hr>
                            <input id ="input "type ="text" name="cardno" placeholder="Card Number" class="input-field" require/>
                            <input id ="input "type ="text" name="cardholder" placeholder="Name On Card" class="input-field" require/>
                            <div class="small-numbers">
                                <input id ="input "type ="text" name="month" placeholder="MM" class="input-field" maxlength="2" require/>
                                <input id ="input "type ="text" name="year" placeholder="YY" class="input-field" maxlength="2" require/>
                                <input id ="input "type ="text" name="cvv" placeholder="CVV" class="input-field" maxlength="3" require/>
                            </div>
                        </div>
                        <button type="submit" class="place-order">Place Order</button>
                    </form>
                </div>
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
