<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags, title, CSS and JS -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="VpYNhu8PDkoaZsSShkP139A7EV5FePg3hlAeekXX">
    <title>Dashboard</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/favicon.png') }}">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
    <style>
        .account i{
            margin-right: 20px;
        }
    </style>
</head>

<body>
    <main>
        <!-- Header Section -->
        <section id="header">
            <nav>
                <div class="navbar-left">
                    <a href="{{ route('home') }}"><img src="{{ asset('assets/E-spresso_logo.jpg') }}"></a>
                </div>
                <div class="navbar-middle">
                    <a class="middle" href="{{ route('home') }}">Home</a>
                    <a class="middle" href="{{ route('products') }}">Products</a>
                    <a class="middle" href="{{ route('about-us') }}">About Us</a>
                    <a class="middle" href="{{ route('blog') }}">Blog</a>
                </div>
                <div class="navbar-right">
                    <a class="account" href="{{ route('dashboard') }}"><i class='bx bx-user'></i></a>
                    <a class="basket" href="/team-project/resources/views/basket.blade.php"><i class='bx bx-basket'></i></a>
                </div>
            </nav>
        </section>

        <!-- Dashboard main section -->
        <section class="dashboard">
            <div class="dash-inner">
                <div class="dash-nav">
                    <div class="user">
                        <i class='bx bx-user'></i>
                        <div class="name+email">
                        @if(Auth::check()) 
                            <p>{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}</p> 
                            <p>{{ Auth::user()->email }}</p> 
                        @endif
                        </div>
                    </div>
                    <div class="dash-buttons">
                        <a id="orders" class="option" >
                            <i class='bx bx-shopping-bag'></i>My Orders
                        </a>
                        <a id="account" class="option" href="http://127.0.0.1:8000/profile" >
                            <i class='bx bx-cog'></i>My Account
                        </a>
                        <a id="member" class="option">
                            <i class='bx bx-reset'></i>My Membership
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="logout">
                                <i class='bx bx-exit'></i>Logout
                            </button>
                        </form>
                    </div>
                </div>
                <div class="dash-title-content">
                    <div class="title">
                        <!-- Titles -->
                        <div id="ordersTitle" class="title-section">My Orders</div>
                        <div id="accountTitle" class="title-section" style="display: none;">My Account</div>
                        <div id="memberTitle" class="title-section" style="display: none;">My Membership</div>
                    </div>
                    <div class="content">
                        <!-- Content -->
                        <div id="ordersContent" class="content-section" style="display: none;">
                            <p>Your orders will appear here.</p>
                        </div>
                        <div id="accountContent" class="content-section" style="display: none;">
                            <p>Your account details will appear here.</p>
                        </div>
                        <div id="memberContent" class="content-section" style="display: none;">
                            <h2>Getting deja brew?</h2>
                            <p>Finding yourself running out of beans and ordering often? With our subscription you you’ll never have to make a last-minute dash again. Regular deliveries mean your beans are always fresh, and your cup is always full, without the hassle of reordering. It’s the coffee experience that just keeps on brewing, right to your door!"</p>
                            <h4> Subscribe now for only <span>£6.95 </span>a month</h4>
                            <a class="subscribe">Subscribe</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Footer Section -->
        <section id="footer">
                    <footer class="top">
                    <div class="logo-desc-soc">
                        <div class="logo">
                            <a href="{{ route('home') }}"><img src="{{ asset('assets/E-spresso_logo.jpg') }}"></a>
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
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="{{ route('products') }}">Products</a></li>
                            <li><a href="{{ route('about-us') }}">About Us </a></li>
                            <li><a href="{{ route('blog') }}">Blog</a></li>
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