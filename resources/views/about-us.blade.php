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
                    <a class="middle" href="{{ route('home') }}">Home</a>
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
                    <a class="middle option-selected" href="{{ route('about-us') }}">About Us</a>
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
                        <button id="toggleMode"><i class='bx bxs-moon'></i></button>
                        <script src="{{ asset('js/dark-mode.js') }}"></script>
                    @endif
                </div>
            </nav>
        </section>

        <!-- Image Block Sections -->
        <section id="ImageBlocks">
            <!-- Our story Section -->
            <div class="ourstory">
                <div class="side-img">
                    <img src="{{ asset('assets/AdobeStock_835212991.jpeg') }}" alt="Woman picking coffee beans" ></img>
                </div>
                <div class="aboutustext">
                    <h3>About Us</h3>
                    <h2>Our Story, Your Coffee Experience</h2>
                    <p>At E-Spresso, we believe in more than just coffee - we create moments. From our handpicked beans to the perfect brew,
                        each cup is crafted with love and care. Whether you're here for a quick pick-me-up or to enjoy a relaxing moment, we're
                        dedicated to making every sip special. Join us in celebrating the art of coffee, brewed to perfection just for you.
                    </p>
                    <div class="promise">
                        <img src="{{ asset('assets/check-mark.png') }}" style="width: 10%;"></img>
                        <h4>Single-origin coffee beans</h4>
                    </div>
                    <div class="promise">
                        <img src="{{ asset('assets/check-mark.png') }}" ></img>
                        <h4>Expertly roasted for optimal flavor</h4>
                    </div>
                    <div class="promise">
                        <img src="{{ asset('assets/check-mark.png') }}"></img>
                        <h4>Wide range of blends for every taste</h4>
                    </div>
                    <div class="promise">
                        <img src="{{ asset('assets/check-mark.png') }}"></img>
                        <h4>High-quality, eco-friendly packaging</h4>
                    </div>
                    <a class="contact-us"href="#contact-us"><h4>Contact us</h4></a>
                </div>
            </div>

            <div id="our-history">
                <h2 class="header">Our History</h2>
                <div class="our-history-container">
                <div class="timeline" style="--items: 3">
                    <ul>
                    <li style="--index: 1">
                        <h3>2020</h3>
                        <h2>From Quarantine to Caffeine</h2>
                        <p>
                        In the midst of lockdown, when stepping outside was nearly impossible where coffee cravings collided with closed shops and stay-at-home orders, 
                        E-spresso was born to keep coffee lovers fueled at home. 
                        </p>
                    </li>
                    <li style="--index: 2">
                        <h3>2023</h3>
                        <h2>Brewing Success</h2>
                        <p>
                        As the world returned to pre-covid ways, our commitment to delivering fresh, ethically sourced coffee right to your door only grew stronger. 
                        What started as a lockdown necessity became a trusted favorite, leading to soaring demand, new product offerings, and expanded delivery networks.
                        </p>
                    </li>
                    <li style="--index: 3">
                        <h3>2025</h3>
                        <h2>A Latte to Come</h2>
                        <p>
                        As we look to the future, we’re expanding globally, 
                        deepening our commitment to sustainable sourcing, and embracing new brewing innovations. 
                        Driven by our passion for exceptional coffee, we aim to connect communities and fuel dreams—one cup at a time.
                        </p>
                    </li>
                    </ul>
                </div>
                </div>
            </div>

            <!-- Our mission Section -->
            <div class="ourmission">
                <div class="aboutustext">
                        <h2>Our Mission</h2>
                        <p>At E-Spresso, we strive to create a warm and inviting space where coffee lovers can gather, connect, and share meaningful moments 
                            and enjoy the finest brews. We are committed to delivering exceptional experiences.
                            
                        </p>
                        <div class="missions">
                            <ul>
                                <li><p><span class="missionheader">Quality First:</span> We source the best beans from around the world to ensure every sip is a delight</p></li>
                                <li><p><span class="missionheader">Sustainability:</span> We priotitise eco-friendly practices to support a healthier planet.</p></li>
                                <li><p><span class="missionheader">Community Connection:</span> We aim to be more than just a coffee shop by fostering meaningful relationships with our customers</p></li>
                                <li><p><span class="missionheader">Continuos Innovation:</span> From classic blends to unique creations, we strive to keep our menu exciting and fresh.</p></li>
                            </ul>
                        </div>
                </div>
                <div class="side-img">
                    <img style="margin-left: 10px; justify-self: center; display: block;" src="{{ asset('assets/AdobeStock_814649831.jpeg') }}"></img>
                </div>
            </div>
            
            <!-- Our vision Section -->
            <div class="ourvision">
                <div class="side-img">
                    <img src="{{ asset('assets/AdobeStock_859686298.jpeg') }}" class="bigimage"></img>
                </div>    
                <div class="aboutustext">
                    <h2>Our Vision</h2>
                    <p>At E-Spresso, we strive to create a world where coffee inspires connections, fules creativity, and promotes sustainability. 
                    Our goal is to redefine the coffee experience and make a positive impact on both our community and the environment.
                    </p>
                    <div class="missions">
                        <ul>
                            <li><p><span class="missionheader">Connecting People:</span> Bringing communities together through coffee.</p></li>
                            <li><p><span class="missionheader">Sustainability:</span> Prioritising eco-friendly practices for a better planet.</p></li>
                            <li><p><span class="missionheader">Quality:</span>  Serving the finest coffee with care and precision.</p></li>
                            <li><p><span class="missionheader">Innovation:</span> Continuosly evolving to offer unique experiences</p></li>
                        </ul>
                    </div>
                    <a class="contact-us" href="{{ route('products') }}"><h4>Discover Our Product</h4></a>
                </div>
            </div>
        </section>

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