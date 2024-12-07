<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags, title, CSS and JS -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/favicon.png') }}">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
</head>

<body class="product-details-page">
    <main>
        <!-- Header Section -->
        <section id="header">
            <nav id="main">
                <div class="navbar-left">
                    <a href="{{ route('home') }}"><img src="{{ asset('assets/E-spresso_logo.jpg') }}"></a>
               </div>
                <div class="navbar-middle">
                    <a class="middle" href="{{ route('home') }}">Home</a>
                    <a class="middle" href="{{ route('products') }}">Products</a>
                    <a class="middle" href="{{ route('about-us') }}">About Us</a>
                    <a class="middle" href="{{ route('blogs.index') }}">Blog</a>
                </div>
                <div class="navbar-right">
                    @if(Auth::check())
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

        <!-- Product Details Section -->
        <section class="product-details">
            <div class="product-container">
                <div class="product-image">
                    <img src="{{ asset('assets/' . $data->image) }}" alt="Product Image">
                </div>
                <div class="product-info">
                    <h1>{{$data->name}}</h1>
                    <p class="price">{{$data->price}}</p>
                    <p class="description">{{$data->description}} 
                    </p>
                    <div class="rating-availability">
                        <p class="rating">⭐⭐⭐⭐⭐ (124)</p>
                        <p class="availability 
                            @if($data->stock == 0) availability-none 
                            @elseif($data->stock < 10) availability-low 
                            @else availability-full 
                            @endif">
                            @if($data->stock == 0)
                                Out of Stock
                            @elseif($data->stock < 10)
                                Low in Stock
                            @else
                                In Stock
                            @endif
                        </p>
                    </div>
                    <form action="{{ route('basket.add', $data->id) }}" method="POST">
                        @csrf
                        <div class="size-options">
                            <p>Size:</p>
                            <div class="size-row">
                                <div class="size-options">
                                    @foreach($relatedProducts as $relatedProduct)
                                        <a href="{{ route('product-details', $relatedProduct->id) }}" 
                                        class="size @if($relatedProduct->size == $data->size) selected @endif">
                                            {{ ucfirst($relatedProduct->size) }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="quantity">
                            <button type="button" class="quantity-btn" id="decrease">−</button>
                            <input type="number" id="quantity" name="quantity" value="1" min="1" max="{{ $data->stock }}" />
                            <button type="button" class="quantity-btn" id="increase">+</button>
                        </div>
                        <button 
                            style="margin-top: 30px;"
                            class="add-to-basket" 
                            @if($data->stock == 0) disabled @endif>
                            Add to Basket
                        </button>
                    </form>
                </div>
            </div>
        </section>

        <!-- Recommended Products Section -->
        <section class="recommended-products">
            <h2>Recommended Products</h2>
            <div class="products-grid">
                <div class="product-card">
                    <img src="{{ asset('assets/cappuccino.png') }}" alt="Cappuccino">
                    <h3>Cappuccino</h3>
                    <p class="price">Price: £12</p>
                    <p class="description">Bold and foamy with the perfect balance of espresso and milk.</p>
                    <p class="rating">⭐⭐⭐⭐⭐ (124)</p>
                    <button class="view-button">View Product</button>
                </div>
                <div class="product-card">
                    <img src="{{ asset('assets/americano.png') }}" alt="Americano">
                    <h3>Americano</h3>
                    <p class="price">Price: £12</p>
                    <p class="description">Classic black coffee brewed to perfection.</p>
                    <p class="rating">⭐⭐⭐⭐⭐ (124)</p>
                    <button class="view-button">View Product</button>
                </div>
                <div class="product-card">
                    <img src="{{ asset('assets/hotchocolate.png') }}" alt="Hot Chocolate">
                    <h3>Hot Chocolate</h3>
                    <p class="price">Price: £12</p>
                    <p class="description">A luxurious blend of rich cocoa, sugar, and creamy milk. Perfect for cold days or as a comforting treat any time.</p>
                    <p class="rating">⭐⭐⭐⭐⭐ (124)</p>
                    <button class="view-button">View Product</button>
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