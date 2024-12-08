<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags, title, CSS and JS -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/favicon.png') }}">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/carousel.js') }}"></script>
</head>

<body>
    <main>
        <!-- Header Section -->
        <section id="header">
            <nav id="main">
                <!-- Left navbar section -->
                <div class="navbar-left">
                    <a href="{{ route('home') }}"><img src="{{ asset('assets/E-spresso_logo.jpg') }}"></a>
               </div>
               <!-- Middle navbar section -->
                <div class="navbar-middle">
                    <a class="middle option-selected" href="{{ route('home') }}">Home</a>
                    <a class="middle" href="{{ route('products') }}">Products</a>
                    <a class="middle" href="{{ route('about-us') }}">About Us</a>
                    <a class="middle" href="{{ route('blogs.index') }}">Blog</a>
                </div>
                <!-- Right navbar section -->
                <div class="navbar-right">
                    <!-- If user is logged in -->
                    @if(Auth::check())
                        <!-- If user is admin -->
                        @if(Auth::user()->userType === 'admin')
                            <a class="account" href="{{ route('admin.dashboard') }}">
                                <i class='bx bx-user'></i>
                            </a>
                            <a class="basket" href="{{ route('basket') }}">
                                <i class='bx bx-basket'></i>
                                @if($basketCount > 0)
                                    <span class="basket-count">{{ $basketCount }}</span>
                                @endif
                            </a>
                        <!-- If user is user -->
                        @elseif(Auth::user()->userType === 'user')
                            <a class="account" href="{{ route('dashboard') }}">
                                <i class='bx bx-user'></i>
                            </a>
                            <a class="basket" href="{{ route('basket') }}">
                                <i class='bx bx-basket'></i>
                                @if($basketCount > 0)
                                    <span class="basket-count">{{ $basketCount }}</span>
                                @endif
                            </a>
                        @endif
                    <!-- If user is not logged in -->
                    @else
                        <a class="login" href="{{ route('login') }}">Login</a>
                        <p>|</p>
                        <a class="basket" href="{{ route('basket') }}">
                            <i class='bx bx-basket'></i>
                        </a>
                    @endif
                </div>
            </nav>
        </section>

        <!-- Home Page Section -->
        <section id="home" style="background-color: black; color: white; display: flex; align-items: center; justify-content: center; padding: 20px;">
            <div style="flex: 1; padding-right: 1px; padding-left: 160px; text-align: left;">
                <br><br>
                <h1 style="font-size: 2.8em; margin: 0; font-family: Modern">Start Your Day with the</h1>
                <h1 style="font-size: 2.8em; margin: 0; font-family: Modern">Best Coffee Experience</h1>
                <br>
                <p>Indulge in the finest brews, crafted to ignite your senses and</p>
                <p>fuel your day. Your new, improved coffee journey begins here.</p>
                <br><br><br>
                <div style="margin-top: 20px">
                    <a href= "{{route('products')}}" style="background-color: rgb(254, 204, 66); color: black; padding: 10px 20px; text-decoration: none; margin-right: 10px; font-weight: bold;">Order Now</a>
                    <a href= "{{route('blog')}}" style="background-color: black; color: white; padding: 10px 20px; text-decoration: none; border: 0.25px solid white;">Learn More</a>
                </div>
                <br><br><br><br>
            </div>
            <div style="flex: 1; display: flex; justify-content: center; overflow: hidden; height: 350px;">
                <img src="{{ asset('assets/steaming_coffee.jpeg') }}" alt="Steaming Coffee" style="width: auto; height: 100%; object-fit: cover; padding-left: 0%; padding-right: 28%;">
            </div>
        </section>

        <!-- Image Block Sections -->
        <section id="ImageBlocks">
            <!-- Our story Section -->
            <div class="ourstory">
                <img src= "{{ asset('assets/coffee_drying.jpeg') }}" alt="Coffee Beans Drying" class="bigimage" style="float: left;"></img>
                <div class="aboutustext">
                    <h3>About Us</h3>
                    <h1 class="header">We Want to Make Your Mornings Easier</h1>
                    <p>Our team is composed of passionate individuals who bring diverse skills and experiences to the table, allowing us to exceed in energising you for the day ahead. We believe in sustainability and ethical practices, ensuring that our operations not only benefit our customers but also contribute positively to the community and the environment.</p>
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

        <!-- Services Section -->
        <section id="services" style="background-color: var(--dark-bg); padding: 40px 20px; text-align: center;">
            <br><br>
            <h1 style="font-size: 2.5em; margin: 0;">Our Delicious Services</h1>
            <p style="font-size: 1em; margin-top: 10px; max-width: 600px; margin-left: auto; margin-right: auto; color: gray;">
                <strong>We offer a variety of top range products, here are some of our most popular categories for you to browse.</strong>
            </p>
            <br><br><br>
            <div class="services-section">
                <div class="service-box">
                    <img src="{{ asset('assets/coffee_cup_symbol.jpeg') }}" alt="Hot Coffee" class="service-image">
                    <h2>Hot Coffee</h2>
                    <br>
                    <p>Enjoy our freshly brewed hot coffee made from the finest beans, perfect for your morning boost.</p>
                    <br><br>
                    <a href="{{ route('products') }}" class="view-range">View Range</a>
                </div>
                <div class="service-box">
                    <img src="{{ asset('assets/coffee_bean_symbol.png') }}" alt="Coffee Beans" class="service-image">
                    <h2>Coffee Beans</h2>
                    <br>
                    <p>Explore our selection of premium coffee beans sourced from around the world for the perfect brew.</p>
                    <br><br>
                    <a href="{{ route('products') }}" class="view-range">View Range</a>
                </div>
                <div class="service-box">
                    <img src="{{ asset('assets/coffee_pod_symbol.jpeg') }}" alt="Coffee Pods" class="service-image">
                    <h2>Coffee Pods</h2>
                    <br>
                    <p>Convenient and delicious, our coffee pods are designed for a quick and easy coffee experience.</p>
                    <br><br>
                    <a href="{{ route('products') }}" class="view-range">View Range</a>
                </div>
            </div><br><br>
        </section>

        <!-- Best Sellers Section -->
        <section id="best-sellers" style="background-color: white; padding: 40px 20px; text-align: center;">
            <br><br>
            <h1 style="font-size: 2.5em; margin: 0;">Best Sellers</h1>
            <p style="color: gray; margin-top: 10px; max-width: 600px; margin-left: auto; margin-right: auto;">
                Discover the most popular coffee that our customers just love. These highest sellers are crafted to perfection and are sure to delight your taste buds.
            </p><br><br><br>
            <div class="product-carousel" style="margin-top: 20px; display: flex; align-items: center; justify-content: center;">
                <button class="arrow left-arrow" style="background-color: transparent; border: none; cursor: pointer; font-size: 2em;">&#10094;</button>
                
                <div class="products-container">
                    @foreach ($bestSellers as $product)
                        <div class="product-box">
                            <img src="{{ asset('assets/' . $product->image) }}" alt="{{ $product->name }}">
                            <h3>{{ $product->name }}</h3>
                            <p class="product-price">{{ $product->price }}</p>
                            <p class="product-description">{{ $product->description }}</p>
                            <p class="star-rating">{{ str_repeat('★', $product->rating) }}{{ str_repeat('☆', 5 - $product->rating) }}</p>
                            <br><a href="{{ route('products') }}" class="view-button" style="background-color: rgb(254, 204, 66); color: black; padding: 10px 15px; text-decoration: none; border-radius: 5px;">View {{ $product->name }}</a>
                        </div>
                    @endforeach
                </div>
                
                <button class="arrow right-arrow" style="background-color: transparent; border: none; cursor: pointer; font-size: 2em;">&#10095;</button>
            </div>
            <br>
            <div style="margin-top: 20px;">
                <a href="{{ route('products') }}" class="best-sellers-button">View All Products</a>
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
                <!-- Quick Links Section -->
                <div class="quick-links">
                    <h3>Quick Links</h3>
                    <ul class="links">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('products') }}">Products</a></li>
                        <li><a href="{{ route('about-us') }}">About Us </a></li>
                        <li><a href="{{ route('blog') }}">Blog</a></li>
                        <li><a class="login" href="{{ route('admin.register') }}">Admin Register</a></li>

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