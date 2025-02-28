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
                    <div id="product-nav" class="middle" style="display: contents;">
                        <a href="{{ route('products') }}">Products</a>
                        <div class="dropdown-content">
                            <div class="dropdown-arrow" style="width: 0; height: 0; border-left: 10px solid transparent; border-right: 10px solid transparent; border-bottom: 10px solid rgb(255,251,243); ;"></div>
                            <ul class="dropdown">
                                @php $displayedProducts = []; @endphp
                                @foreach ($categories as $category)
                                    <!-- Category Dropdown -->
                                    <li>
                                        <a href="{{ route('products.filter', ['category' => $category->id]) }}" class="category">
                                            {{ $category->name }}
                                        </a>
                                        <ul>
                                            @foreach ($category->products as $product)
                                                @if (!in_array($product->name, $displayedProducts))
                                                    <li>
                                                        <a href="{{ route('product-details', ['id' => $product->id]) }}" class="product">
                                                            {{ $product->name }}
                                                        </a>
                                                    </li>
                                                    @php $displayedProducts[] = $product->name; @endphp
                                                @endif
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <a class="middle" href="{{ route('about-us') }}">About Us</a>
                    <a class="middle" href="{{ route('contact-us') }}">Contact Us</a>
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
                            <select id="currency-selector" class="currency-selector">
                                <option value="GBP">£</option>
                                <option value="USD">$</option>
                                <option value="EUR">€</option>
                            </select>
                            <script src="{{ asset('js/currency.js') }}"></script>
                            <button id="toggleMode"><i class='bx bxs-moon'></i></button>
                            <script src="{{ asset('js/dark-mode.js') }}"></script>
                        <!-- If user is user -->
                        @elseif(Auth::user()->userType === 'user')
                            <div id="account-nav"  style="display: contents;">
                                <a class="account" href="{{ route('dashboard') }}">
                                    <i class='bx bx-user'></i>
                                </a>
                                <div class="account-dropdown-content">
                                    <div class="account-dropdown-arrow" style="width: 0; height: 0; border-left: 10px solid transparent; border-right: 10px solid transparent; border-bottom: 10px solid white ;"></div>
                                    <ul class="account-dropdown">
                                        <div class="button-row" style="display:inline-flex; border-bottom:1px solid gray; margin-bottom: 0px;">
                                            <i class='bx bx-user'><p style="font-size: 13px; display:inline-flex; transform: translateY(-5px);">{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}</p> </i>
                                        </div>
                                        <div class="button-row" style="display:inline-flex;">
                                            <a href="{{ route('dashboard') }}?tab=orders">
                                                <i class='bx bx-shopping-bag'></i>My Orders
                                            </a>
                                        </div>
                                        <div class="button-row" style="display:inline-flex;">
                                            <a href="{{ route('dashboard') }}?tab=account">
                                                <i class='bx bx-cog'></i>My Account
                                            </a>
                                        </div>
                                        <div class="button-row" style="display:inline-flex;">
                                            <a href="{{ route('dashboard') }}?tab=member">
                                                <i class='bx bx-reset'></i>My Membership
                                            </a>
                                        </div>
                                        <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <button type="submit" style="cursor:pointer; background:#fecc42;border:none;font-size: 10px;padding: 5px 10px;border-radius: 5px;width: 50%;display: flow;justify-self: center;margin-top: 5px;">Logout
                                                </button>
                                        </form>
                                    </ul>
                                </div>
                            </div>
                            <a class="basket" href="{{ route('basket') }}">
                                <i class='bx bx-basket'></i>
                                @if($basketCount > 0)
                                    <span class="basket-count">{{ $basketCount }}</span>
                                @endif
                            </a>
                            <select id="currency-selector" class="currency-selector">
                                <option value="GBP">£</option>
                                <option value="USD">$</option>
                                <option value="EUR">€</option>
                            </select>
                            <script src="{{ asset('js/currency.js') }}"></script>
                            <button id="toggleMode"><i class='bx bxs-moon'></i></button>
                            <script src="{{ asset('js/dark-mode.js') }}"></script>
                        @endif
                    <!-- If user is not logged in -->
                    @else
                        <a class="login" href="{{ route('login') }}">Login</a>
                        <p>|</p>
                        <a class="basket" href="{{ route('basket') }}">
                            <i class='bx bx-basket'></i>
                        </a>
                        <select id="currency-selector" class="currency-selector">
                            <option value="GBP">£</option>
                            <option value="USD">$</option>
                            <option value="EUR">€</option>
                        </select>
                        <script src="{{ asset('js/currency.js') }}"></script>
                        <button id="toggleMode"><i class='bx bxs-moon'></i></button>
                        <script src="{{ asset('js/dark-mode.js') }}"></script>
                    @endif
                </div>
            </nav>
        </section>

        <!-- Home Page Section -->
        <section id="home-cta" style="background-image: url({{ asset('assets/home-cta-bg.jpg') }});">
            <div class="home-cta-text">
                <h1 style="font-size: 2.8em; margin: 0; font-family: Modern">Start Your Day with the Best Coffee Experience</h1>
                <p>Indulge in the finest brews, crafted to ignite your senses and fuel your day. Your new, improved coffee journey begins here.</p>
                <div class="home-cta-buttons">
                    <a class="order-now" href= "{{route('products')}}">Order Now</a>
                    <a class="learn-more" href= "{{route('about-us')}}">Learn More</a>
                </div>
            </div>
        </section>

        <!-- Image Block Sections -->
        <section id="ImageBlocks" style="background-image: url({{ asset('assets/bg_with_beans.png') }}); background-size: cover;">
            <!-- Our story Section -->
            <div class="ourstory">
                <div class="side-img">
                    <img src= "{{ asset('assets/our_story_home.png') }}" alt="Coffee Beans Drying" class="bigimage"></img>
                </div>
                <div class="aboutustext">
                    <h3>About Us</h3>
                    <h2 class="header">Our Story, Your Coffee</h2>
                    <h2>Experience</h2>
                    <p>At E-spresso, we believe in more than just coffee - we create moments. From our handpicked beans to the perfect brew, each cup is crafted with love and care. Whether you're here for a quick pick-me-up or to enjoy a relaxing moment, we're dedicated to making every sip special. Join us in celebrating the art of coffee, brewed to perfection just for you.</p>
                    <div class="promise">
                        <img style="width: 10%;" src= "{{ asset('assets/check-mark.png') }}"></img>
                        <h4>Single-origin coffee beans</h4>
                    </div>
                    <div class="promise">
                        <img src= "{{ asset('assets/check-mark.png') }}"></img>
                        <h4>Expertly roasted for optimal flavour</h4>
                    </div>
                    <div class="promise">
                        <img src= "{{ asset('assets/check-mark.png') }}"></img>
                        <h4>Wide range of blends for every taste</h4>
                    </div>
                    <div class="promise">
                        <img src= "{{ asset('assets/check-mark.png') }}"></img>
                        <h4>High-quality, eco-friendly packaging</h4>
                    </div>
                    <a href="{{route('about-us')}}"><h4>Read More</h4></a>
                </div>
            </div>
        </section>

        <!-- Services Section -->
        <section id="services" style="text-align: center; background-image: url({{ asset('assets/dark_bg_with_beans.png') }}); background-size: cover;"">
            <h1>Our Delicious Services</h1>
            <p style="font-size: 1em; margin: 10px auto 0; width:56%; color: var(--text-colour);">
                <strong>We offer a variety of top range products, here are some of our most popular categories for you to browse.</strong>
            </p>
            <div class="services-section">
                <div class="service-card">
                    <div class="service-icon-circle">
                        <img src="{{ asset('assets/donut-icon.svg') }}">
                    </div>
                    <h3>Sweet Treats</h3>
                    <br>
                    <p>Enjoy our deliciously baked sweet treats, made from the finest ingredients — perfect for a delightful pick-me-up</p>
                    <br><br>
                    <a href="{{ route('products.filter', array_merge(request()->except('category'), ['category' => 5])) }}" class="view-range"> View Range</a>
                </div>
                <div class="service-card">
                    <div class="service-icon-circle">
                        <img style="width: 100%; height: 100%;" src="{{ asset('assets/bean-icon.svg') }}">
                    </div>
                    <h3>Different Beans</h3>
                    <br>
                    <p>Explore our selection of premium coffee beans sourced from around the world for the perfect brew.</p>
                    <br><br>
                    <a href="{{ route('products.filter', array_merge(request()->except('category'), ['category' => 3])) }}" class="view-range"> View Range</a>
                </div>
                <div class="service-card">
                    <div class="service-icon-circle">
                        <img src="{{ asset('assets/coffee-icon.svg') }}">
                    </div>
                    <h3>Hot Coffee</h3>
                    <br>
                    <p>Enjoy our freshly brewed hot coffee made from the finest beans, perfect for your morning boost.</p>
                    <br><br>
                    <a href="{{ route('products.filter', array_merge(request()->except('category'), ['category' => 1])) }}" class="view-range"> View Range</a>
                </div>
            </div>
            <div style="position: absolute;" class="floating-beans">
                <img style="justify-self: left;transform: translateX(-17vw) translateY(-2vh) rotate(1deg); width: 38vw;" src="{{ asset('assets/flipped_beans.png') }}">
            </div>
        </section>

        <!-- Best Sellers Section -->
        <section id="best-sellers">
            <h1>Best Sellers</h1>
            <p style="margin-top: 10px; max-width: 600px; margin-left: auto; margin-right: auto; color:gray;">
                Discover the most popular coffee that our customers just love. These highest sellers are crafted to perfection and are sure to delight your taste buds.
            </p>
            <div class="products-container">
                @foreach($bestSellers as $product)
                    <div class="product-card" style="background-color:white;">
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
            <a href="{{ route('products') }}" class="best-sellers-button">View All Products</a>
        </section>

        <!-- Coffee Fix Section -->
        <section id="coffee-fix">
            <div id="coffee-fix-container">
                <div id="coffee-text">
                    <h1>Need a Coffee Fix?</h1>
                    <p>Become a member today and enjoy exclusive access to freshly roasted coffee beans delivered right to your door.</p>
                    @if(Auth::check())
                        {{-- If the logged-in user is an admin --}}
                        @if(Auth::user()->userType === 'admin')
                            <a id="become-member-button" href="{{ route('admin.dashboard') }}">
                                Go to admin dashboard
                            </a>
                        @else
                            {{-- For any other authenticated user type (e.g., a regular user) --}}
                            <a id="become-member-button" href="{{ route('dashboard') }}?tab=member">
                                Subscribe
                            </a>
                        @endif
                    @else
                        {{-- If the user is not logged in at all --}}
                        <a id="become-member-button" href="{{ route('register') }}">
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
        <div style="height:10vh; background-color:var(--light-bg)"></div>

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