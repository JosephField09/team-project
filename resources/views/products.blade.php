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
            <nav>
                <div class="navbar-left">
                    <a href="{{ route('home') }}"><img src="{{ asset('assets/E-spresso_logo.jpg') }}"></a>
               </div>
                <div class="navbar-middle">
                    <a class="middle" href="{{ route('home') }}">Home</a>
                    <a class="middle option-selected" href="{{ route('products') }}">Products</a>
                    <a class="middle" href="{{ route('about-us') }}">About Us</a>
                    <a class="middle" href="{{ route('blogs.index') }}">Blog</a>
                </div>
                <div class="navbar-right">
                    @auth
                        <a class="account" href="{{ route('dashboard') }}"><i class='bx bx-user'></i></a>
                        <a class="basket" href="/team-project/resources/views/basket.blade.php"><i class='bx bx-basket'></i></a>
                    @endauth
                    @guest
                        <a class="login" href="{{ route('login') }}">Login</a>
                        <p>|</p>
                        <a class="basket" href="/team-project/resources/views/basket.blade.php"><i class='bx bx-basket'></i></a>
                    @endguest
                </div>
            </nav>
        </section>

        <!-- Products Section -->
        <section id="products">
            <div class="container">
            <h1 class="products-header">Explore Our Products</h1>

            <!-- Hot Coffee Section -->
            <h2>Hot Coffee</h2>
            <div class="products-grid">
                <div class="product-card">
                    <img src="{{ asset('assets/favicon.png') }}" alt="Latte" class="product-image">
                    <h3 class="product-title">Latte</h3>
                    <p class="product-price">From £12</p>
                    <p class="product-description">Rich and creamy, perfect for a relaxing moment.</p>
                    <button class="view-button">View</button>
                </div>
                <div class="product-card">
                    <img src="{{ asset('assets/favicon.png') }}"alt="Cappuccino" class="product-image">
                    <h3 class="product-title">Cappuccino</h3>
                    <p class="product-price">From £12</p>
                    <p class="product-description">A classic brew with a perfect foam balance.</p>
                    <button class="view-button">View</button>
                </div>
                <div class="product-card">
                    <img src="{{ asset('assets/favicon.png') }}" alt="Americano" class="product-image">
                    <h3 class="product-title">Americano</h3>
                    <p class="product-price">From £10</p>
                    <p class="product-description">Simple and strong, a true coffee lover's choice.</p>
                    <button class="view-button">View</button>
                </div>
                <div class="product-card">
                    <img src="{{ asset('assets/favicon.png') }}" alt="Macchiato" class="product-image">
                    <h3 class="product-title">Espresso</h3>
                    <p class="product-price">From £13</p>
                    <p class="product-description">A shot of espresso with a rich flavour and caramel-like sweetness.</p>
                    <button class="view-button">View</button>
                </div>
                
                <div class="product-card">
                    <img src="{{ asset('assets/favicon.png') }}" alt="Flat White" class="product-image">
                    <h3 class="product-title">Flat White</h3>
                    <p class="product-price">From £13</p>
                    <p class="product-description">Expertly steamed milk poured over two shots of espresso.</p>
                    <button class="view-button">View</button>
                </div>
                
                <div class="product-card">
                    <img src="{{ asset('assets/favicon.png') }}" alt="Mocha" class="product-image">
                    <h3 class="product-title">Mocha</h3>
                    <p class="product-price">From £13</p>
                    <p class="product-description">Espresso topped with a dash of milk foam.</p>
                    <button class="view-button">View</button>
                
                </div>
        
                <div class="product-card">
                    <img src="{{ asset('assets/favicon.png') }}" alt="Hot Chocolate" class="product-image">
                    <h3 class="product-title">Hot Chocolate</h3>
                    <p class="product-price">From £13</p>
                    <p class="product-description">cocoa powder, sugar, and milk.</p>
                    <button class="view-button">View</button>
                </div>
                
                <div class="product-card">
                    <img src="{{ asset('assets/favicon.png') }}" alt="Cortado" class="product-image">
                    <h3 class="product-title">Cortado</h3>
                    <p class="product-price">From £13</p>
                    <p class="product-description">Two ristretto shots topped with warm, silky milk .</p>
                    <button class="view-button">View</button>
                </div>
                
                <div class="product-card">
                    <img src="{{ asset('assets/favicon.png') }}" alt="Tea" class="product-image">
                    <h3 class="product-title">Tea</h3>
                    <p class="product-price">From £13</p>
                    <p class="product-description">Normal English tea.</p>
                    <button class="view-button">View</button>
                </div>
            </div>

            <!-- Coffee Beans Section -->
            <h2>Coffee Beans</h2>
            <div class="products-grid">
                <div class="product-card">
                    <img src="{{ asset('assets/bag_kenyan.png') }}" alt="Kenyan Beans" class="product-image">
                    <h3 class="product-title">Kenyan Beans</h3>
                    <p class="product-price">£15</p>
                    <p class="product-description">Rich, bold, and full-bodied flavor.</p>
                    <button class="view-button">View</button>
                </div>
                <div class="product-card">
                    <img src="{{ asset('assets/bag_colombian.png') }}"  alt="Colombian Beans" class="product-image">
                    <h3 class="product-title">Colombian Beans</h3>
                    <p class="product-price">£14</p>
                    <p class="product-description">Smooth and balanced with a nutty flavor.</p>
                    <button class="view-button">View</button>
                </div>
                <div class="product-card">
                    <img src="{{ asset('assets/bag_brazilian.png') }}"  alt="Brazilian Beans" class="product-image">
                    <h3 class="product-title">Brazilian Beans</h3>
                    <p class="product-price">£13</p>
                    <p class="product-description">Sweet and chocolatey undertones.</p>
                    <button class="view-button">View</button>
                </div>
                <div class="product-card">
                    <img src="{{ asset('assets/bag_jamaican.png') }}" alt="Jamaican Beans" class="product-image">
                    <h3 class="product-title">Jamaican Beans</h3>
                    <p class="product-price">£18</p>
                    <p class="product-description">Exotic and robust flavor profile.</p>
                    <button class="view-button">View</button>
                </div>
                <div class="product-card">
                    <img src="{{ asset('assets/bag_ethiopian.png') }}"  alt="Ethiopian Beans" class="product-image">
                    <h3 class="product-title">Ethiopian Beans</h3>
                    <p class="product-price">£15</p>
                    <p class="product-description">cherry, grape, lime, green apple.</p>
                    <button class="view-button">View</button>
                </div>
            </div>

            <!-- Coffee Pods Section -->
            <h2>Coffee Pods</h2>
            <div class="products-grid">
                <div class="product-card">
                    <img src="{{ asset('assets/pod_latte.png') }}" alt="Latte Pods" class="product-image">
                    <h3 class="product-title">Latte Pods</h3>
                    <p class="product-price">£6 (12 pods)</p>
                    <p class="product-description">Convenient pods for a creamy latte.</p>
                    <button class="view-button">View</button>
                </div>
                <div class="product-card">
                    <img src="{{ asset('assets/pod_latte.png') }}" alt="Cappuccino Pods" class="product-image">
                    <h3 class="product-title">Cappuccino Pods</h3>
                    <p class="product-price">£6 (12 pods)</p>
                    <p class="product-description">Rich and foamy coffee pods.</p>
                    <button class="view-button">View</button>
                </div>
                <div class="product-card">
                    <img src="{{ asset('assets/pod_latte.png') }}" alt="Espresso Pods" class="product-image">
                    <h3 class="product-title">Espresso Pods</h3>
                    <p class="product-price">£5 (12 pods)</p>
                    <p class="product-description">Intense and aromatic espresso pods.</p>
                    <button class="view-button">View</button>
                </div>
                <div class="product-card">
                    <img src="{{ asset('assets/pod_americano.png') }}" alt="Americano Pods" class="product-image">
                    <h3 class="product-title">Americano Pods</h3>
                    <p class="product-price">£5 (12 pods)</p>
                    <p class="product-description">Brew a simple and bold Americano.</p>
                    <button class="view-button">View</button>
                </div>
            <div class="product-card">
                    <img src="{{ asset('assets/pod_hotchocolate.png') }}" alt="Hot Chocolate Pods" class="product-image">
                    <h3 class="product-title">Hotchocolate Pods</h3>
                    <p class="product-price">£6 (12 pods)</p>
                    <p class="product-description">Rich and chocolatey.</p>
                    <button class="view-button">View</button>
                </div>
                <div class="product-card">
                    <img src="{{ asset('assets/pod_latte.png') }}" alt="Mocha Pods" class="product-image">
                    <h3 class="product-title">Mocha Pods</h3>
                    <p class="product-price">£6 (12 pods)</p>
                    <p class="product-description">Indulgent and generous.</p>
                    <button class="view-button">View</button>
                </div>
                <div class="product-card">
                    <img src="{{ asset('assets/pod_macchiato.png') }}" alt="Macchiatote Pods" class="product-image">
                    <h3 class="product-title">Macchiato Pods</h3>
                    <p class="product-price">£6 (12 pods)</p>
                    <p class="product-description">Smooth and creamy.</p>
                    <button class="view-button">View</button>
                </div>
                <div class="product-card">
                    <img src="{{ asset('assets/pod_flatwhite.png') }}" alt="Flat White Pods" class="product-image">
                    <h3 class="product-title">Flat white Pods</h3>
                    <p class="product-price">£6 (12 pods)</p>
                    <p class="product-description">Velvety and smooth.</p>
                    <button class="view-button">View</button>
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
                <p class="desc">At E-spresso, we’re passionate about delivering the perfect coffee experience. 
                    From premium beans to convenient pods, we offer a selection to satisfy every coffee lover’s taste. 
                    Whether you’re a coffee connoisseur or just beginning your journey, 
                    Our store is your gateway to a world of rich flavors and aromatic delights.</p>
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