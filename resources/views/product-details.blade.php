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

        <!-- Product Details Section -->
        <section class="product-details">
            <div class="product-container">
                <div class="product-image">
                    <img src="{{ asset('assets/' . $data->image) }}" alt="Product Image">
                </div>
                <!-- All product information -->
                <div class="product-info">
                    <h1>{{$data->name}}</h1>
                    <p class="price" data-gbp="{{ $data->price }}">£{{ $data->price }}</p>
                    <p class="description">{{$data->description}} 
                    </p>
                    <div class="rating-availability">
                        @if($data->reviews->count() > 0)
                            @php $average = round($data->averageRating()); @endphp
                            <p>
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $average)
                                    ⭐
                                @endif
                            @endfor
                            </p>
                        @else
                            <p>No reviews yet.</p>
                        @endif
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
                        <!-- Quantity button -->
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
                        <!-- Quantity button -->
                        <div class="quantity">
                            <input type="number" id="quantity" name="quantity" value="1" min="1" max="{{ $data->stock }}" />
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

        <!-- Product Reviews Section -->
        <section class="product-reviews">
            <a href="{{ route('reviews.create', $data->id) }}">Add a Review</a>

            @foreach($data->reviews as $review)
                <div class="review-body">
                    <h3 class="review-title">{{ $review->title }}</h3>
                    <h4 class="review-rating">{{ str_repeat('⭐', $review->rating)}}</h4>
                    <p class="review-message">{{ $review->message}}</p>
                    <p class="review-by">{{ $review->user->firstName }} {{ $review->user->lastName }}, {{$review->created_at->format('d M Y')}}</p>
                </div>
            @endforeach
        </section>

        <!-- Recommended Products Section -->
        <section class="recommended-products">
            <h2>Recommended Products</h2>
            <p style="margin-top: 10px; max-width: 600px; margin-left: auto; margin-right: auto;">
            <div class="products-container">
                @php
                    // Fetch the products by their IDs. 
                    // Preferably, you do this in the controller and pass as $products.
                    $products = \App\Models\Product::whereIn('id', [4, 28, 43])->get();
                @endphp

                @foreach($products as $product)
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
            <a href="{{ route('products') }}" class="best-sellers-button" style="justify-self:center; display:flex;" >View All Products</a>
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