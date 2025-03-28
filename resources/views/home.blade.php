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
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/responsive.js') }}"></script>
    <script>
    </script>
</head>

<body>
    <main>
        <!-- Header Section -->
        @include('layouts.navbar')

        <!-- Home Page Section -->
        <section id="home-cta" style="background-image: url({{ asset('assets/home-cta-bg.jpg') }});">
            <div class="home-cta-text">
                <h1 style="font-size: 2.8em; margin: 0; font-family: Modern" class="out-of-view">Start Your Day with the Best Coffee Experience</h1>
                <p class="out-of-view">Indulge in the finest brews, crafted to ignite your senses and fuel your day. Your new, improved coffee journey begins here.</p>
                <div class="home-cta-buttons out-of-view">
                    <a class="order-now" href= "{{route('products')}}">Order Now</a>
                    <a class="learn-more" href= "{{route('about-us')}}">Learn More</a>
                </div>
            </div>
        </section>

        <!-- Image Block Sections -->
        <section id="ImageBlocks" style="background-image: url({{ asset('assets/bg_with_beans.png') }}); background-size: cover;margin-top: 20px;margin-bottom: 50px;">
            <!-- Our story Section -->
            <div class="ourstory">
                <div class="side-img out-of-view">
                    <img src= "{{ asset('assets/our_story_home.png') }}" alt="Coffee Beans Drying" class="bigimage"></img>
                </div>
                <div class="aboutustext">
                    <h3 class="out-of-view">About Us</h3>
                    <h2 class="header out-of-view">Our Story, Your Coffee</h2>
                    <h2 class="out-of-view">Experience</h2>
                    <p class="out-of-view">At E-spresso, we believe in more than just coffee - we create moments. From our handpicked beans to the perfect brew, each cup is crafted with love and care. Whether you're here for a quick pick-me-up or to enjoy a relaxing moment, we're dedicated to making every sip special. Join us in celebrating the art of coffee, brewed to perfection just for you.</p>
                    <div class="promise">
                        <img style="width: 10%;" class="first out-of-view" src= "{{ asset('assets/check-mark.png') }}"></img>
                        <h4 class="first out-of-view">Single-origin coffee beans</h4>
                    </div>
                    <div class="promise">
                        <img class="second out-of-view" src= "{{ asset('assets/check-mark.png') }}"></img>
                        <h4 class="second out-of-view">Expertly roasted for optimal flavour</h4>
                    </div>
                    <div class="promise">
                        <img class="third out-of-view" src= "{{ asset('assets/check-mark.png') }}"></img>
                        <h4 class="third out-of-view">Wide range of blends for every taste</h4>
                    </div>
                    <div class="promise"class="out-of-view">
                        <img class="fourth out-of-view" src= "{{ asset('assets/check-mark.png') }}"></img>
                        <h4 class="fourth out-of-view">High-quality, eco-friendly packaging</h4>
                    </div>
                    <a class="out-of-view" href="{{route('about-us')}}"><h4>Read More</h4></a>
                </div>
            </div>
        </section>

        <!-- Services Section -->
        <section id="services" style="text-align: center; background-image: url({{ asset('assets/dark_bg_with_beans.png') }}); background-size: cover;"">
            <h1 class="out-of-view" >Our Delicious Services</h1>
            <p class="out-of-view" style="font-size: 1em; margin: 10px auto 0; width:56%; color: var(--text-colour);">
                <strong>We offer a variety of top range products, here are some of our most popular categories for you to browse.</strong>
            </p>
            <div class="services-section">
                <div class="service-card out-of-view">
                    <div class="service-icon-circle">
                        <img src="{{ asset('assets/coffee-icon.svg') }}">
                    </div>
                    <h3>Hot Coffee</h3>
                    <br>
                    <p>Enjoy our freshly brewed hot coffee made from the finest beans, perfect for your morning boost.</p>
                    <br><br>
                    <a href="{{ route('products.filter', array_merge(request()->except('category'), ['category' => 1])) }}" class="view-range"> View Range</a>
                </div>
                <div class="service-card out-of-view">
                    <div class="service-icon-circle">
                        <img style="width: 100%; height: 100%;" src="{{ asset('assets/bean-icon.svg') }}">
                    </div>
                    <h3>Different Beans</h3>
                    <br>
                    <p>Explore our selection of premium coffee beans sourced from around the world for the perfect brew.</p>
                    <br><br>
                    <a href="{{ route('products.filter', array_merge(request()->except('category'), ['category' => 3])) }}" class="view-range"> View Range</a>
                </div>
                <div class="service-card out-of-view">
                    <div class="service-icon-circle">
                        <img src="{{ asset('assets/donut-icon.svg') }}">
                    </div>
                    <h3>Sweet Treats</h3>
                    <br>
                    <p>Enjoy our deliciously baked sweet treats, made from the finest ingredients — perfect for a delightful pick-me-up</p>
                    <br><br>
                    <a href="{{ route('products.filter', array_merge(request()->except('category'), ['category' => 5])) }}" class="view-range"> View Range</a>
                </div>
            </div>
            <div style="position: absolute;" class="floating-beans">
                <img style="justify-self: left;transform: translateX(-17vw) translateY(-2vh) rotate(1deg); width: 38vw;" src="{{ asset('assets/flipped_beans.png') }}">
            </div>
        </section>

        <!-- Best Sellers Section -->
        <section id="best-sellers">
            <h1 class="out-of-view">Best Sellers</h1>
            <p class="best-description out-of-view">
                Discover the most popular coffee that our customers just love. These highest sellers are crafted to perfection and are sure to delight your taste buds.
            </p>
            <div class="products-container">
                @foreach($bestSellers as $product)
                    <div class="product-card out-of-view" style="background-color: white;">
                        <img src="{{ asset('assets/' . $product->image) }}" alt="Product Image">
                        <div class="product-row" style="display: inline-flex;">
                            <h3 class="product-title">{{ $product->name }}</h3>
                            <p class="product-price" data-gbp="{{ $product->price }}">from <span>£{{ number_format($product->price, 2) }}</span></p>
                        </div>
                        <p class="product-description">{{ $product->description }}</p>
                        <a href="{{ route('product-details', $product->id) }}" class="view-button">View</a>
                    </div>
                @endforeach
            </div>
            <a href="{{ route('products') }}" class="best-sellers-button out-of-view">View All Products</a>
        </section>

        <!-- Coffee Fix Section -->
        <section id="coffee-fix">
            <div id="coffee-fix-container">
                <div id="coffee-text">
                    <h1 class="out-of-view">Need a Coffee Fix?</h1>
                    <p class="out-of-view">Become a member today and enjoy exclusive access to freshly roasted coffee beans delivered right to your door.</p>
                    @if(Auth::check())
                        {{-- If the user is an admin --}}
                        @if(Auth::user()->userType === 'admin')
                            <a class="out-of-view" id="become-member-button" href="{{ route('admin.dashboard') }}">
                                Go to admin dashboard
                            </a>
                        @else
                            {{-- If the user is a regular user --}}
                            <a class="out-of-view" id="become-member-button" href="{{ route('dashboard') }}?tab=member">
                                Subscribe
                            </a>
                        @endif
                    @else
                        {{-- If the user isn't logged in  --}}
                        <a class="out-of-view" id="become-member-button" href="{{ route('register') }}">
                            Become a Member
                        </a>
                    @endif
                </div>
                <div id="bean-bags">
                    <img class="bag bag1" src="{{ asset('assets/single_bag_ethiopian.png') }}">
                    <img class="bag bag2" src="{{ asset('assets/single_bag_brazilian.png') }}">
                    <img class="bag bag3" src="{{ asset('assets/single_bag_kenyan.png') }}">
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
                        <li><a href="{{ route('contact-us') }}#faq">FAQ</a></li>
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