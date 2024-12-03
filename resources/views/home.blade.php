<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags, title, CSS and JS -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/favicon.png') }}">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
</head>

<body>
    <main>
        <!-- Header Section -->
        <section id="header">
            <nav id="main">
                <div class="navbar-left">
                    <a href="{{ route('home') }}"><img src="{{ asset('assets/E-spresso_logo.jpg') }}"></a>
               </div>
                <div class="navbar-middle">
                    <a class="middle option-selected" href="{{ route('home') }}">Home</a>
                    <a class="middle" href="{{ route('products') }}">Products</a>
                    <a class="middle" href="{{ route('about-us') }}">About Us</a>
                    <a class="middle" href="{{ route('blogs.index') }}">Blog</a>
                </div>
                <div class="navbar-right">
                    @if(Auth::check())
                        @if(Auth::user()->userType === 'admin')
                            <!-- Admin Dashboard and Basket -->
                            <a class="account" href="{{ route('admin.dashboard') }}">
                                <i class='bx bx-user'></i>
                            </a>
                            <a class="basket" href="{{route('basket')}}">
                                <i class='bx bx-basket'></i>
                            </a>
                        @elseif(Auth::user()->userType === 'user')
                            <!-- User Dashboard and Basket -->
                            <a class="account" href="{{ route('dashboard') }}">
                                <i class='bx bx-user'></i> 
                            </a>
                            <a class="basket" href="{{route('basket')}}">
                                <i class='bx bx-basket'></i>
                            </a>
                        @endif
                    @else
                        <!-- Guest: Login and Basket -->
                        <a class="login" href="{{ route('login') }}">Login</a>
                        <p>|</p>
                        <a class="basket" href="{{route('basket')}}">
                            <i class='bx bx-basket'></i>
                        </a>
                    @endif
                </div>
            </nav>
        </section>

        <!-- Home Page Section -->
        <section id="home" style="background-color: black; color: white; display: flex; align-items: center; justify-content: center; padding: 20px;">
            <div style="flex: 1; padding-right: 1px; padding-left: 160px; text-align: left;">
                <h1 style="font-size: 2.8em; margin: 0; font-family: Modern">Start Your Day with the</h1>
                <h1 style="font-size: 2.8em; margin: 0; font-family: Modern">Best Coffee Experience</h1>
                <br>
                <p>Indulge in the finest brews, crafted to ignite your senses and</p>
                <p>fuel your day. Your new and improved coffee journey begins here.</p>
                <br><br><br>
                <div style="margin-top: 20px;">
                    <a href= "{{route('products')}}" style="background-color: rgb(254, 204, 66); color: black; padding: 10px 20px; text-decoration: none; margin-right: 10px; font-weight: bold;">Order Now</a>
                    <a href= "{{route('about-us')}}" style="background-color: black; color: white; padding: 10px 20px; text-decoration: none; border: 0.25px solid white;">Learn More</a>
                </div>
                <br><br>
            </div>
            <div style="flex: 1; display: flex; justify-content: left;">
                <img src="{{ asset('assets/steaming_coffee.jpeg') }}" alt="Steaming Coffee" style="width: 100%; height: auto; max-width: none;">
            </div>
        </section>

        <!-- Image Block Sections -->
        <section id="ImageBlocks">
            <!-- Our story Section -->
            <div class="ourstory">
                <img src= "{{ asset('assets/AdobeStock_723458248.jpeg') }}" alt="Woman picking coffee beans" 
                class="bigimage" style="float: left;"></img>
                <div class="aboutustext">
                    <h3>About Us</h3>
                    <h1 class="header">Our Mission is to Make Your Mornings Easier</h1>
                    <p>At E-Spresso, we believe in more than just coffee - we create moments. From our handpicked beans to the perfect brew,
                        each cup is crafted with love and care. Whether you're here for a quick pick-me-up or to enjoy a relaxing moment, we're
                        dedicated to making every sip special. Join us in celebrating the art of coffee, brewed to perfection just for you.
                    </p>
                    <div class="promise">
                        <img src= "{{ asset('assets/check-mark.png') }}" height="15px" width="15px"></img>
                        <h4>Single-origin coffee beans</h4>
                    </div>
                    <div class="promise">
                        <img src= "{{ asset('assets/check-mark.png') }}" height="15px" width="15px"></img>
                        <h4>Expertly roasted for optimal flavor</h4>
                    </div>
                    <div class="promise">
                        <img src= "{{ asset('assets/check-mark.png') }}" height="15px" width="15px"></img>
                        <h4>Wide range of blends for every taste</h4>
                    </div>
                    <div class="promise">
                        <img src= "{{ asset('assets/check-mark.png') }}" height="15px" width="15px"></img>
                        <h4>High-quality, eco-friendly packaging</h4>
                    </div>
                    <a href="{{route('about-us')}}"><h4>Read More</h4></a>
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
                    <li><a class="login" href="{{ route('admin.register') }}">Register as Admin</a></li>

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