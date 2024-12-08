<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags, title, CSS and JS -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
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
                    <a class="middle" href="{{ route('home') }}">Home</a>
                    <a class="middle option-selected" href="{{ route('products') }}">Products</a>
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

        <!-- Call to Action Section -->
        <section id="cta" style="background-image: url({{ asset('assets/AdobeStock_262772087.jpeg') }});" >
            <div class="cta-text">
                <p>Our Products</p>
                <h3>Discover the Perfect Fit</h3>
                <p>Explore a Wide Range of Products Tailored to Meet Your Needs</p>
            </div>
        </section>

        <!-- Shop Banner Section -->
        <section id="shop-banner">
            <h2>SHOP E-SPRESSO</h2>
            <div class="filter-buttons">
                <form action="{{ route('products') }}" method="GET" class="filter-form">
                    <div class="filter-group">   
                        <div class="category-wrapper">
                            <a href="{{ route('products', array_merge(request()->except('category'), ['category' => ''])) }}" 
                            class="category-button {{ request('category') == '' ? 'active' : '' }}"
                            style="background-image: url({{ asset('assets/favicon.png') }}); background-position: center; background-size: cover;" >
                            </a>
                            <div class="category-name">Shop All</div>
                        </div>
                        @foreach ($categories as $category)
                            <div class="category-wrapper">
                                <a href="{{ route('products.filter', array_merge(request()->except('category'), ['category' => $category->id])) }}" 
                                class="category-button {{ request('category') == $category->id ? 'active' : '' }}"
                                style="background-image: url('{{ asset('assets/' . $category->image) }}'); background-position: center; background-size: contain; background-repeat: no-repeat;">
                                </a>
                                <p>{{ $category->name }}</p>
                            </div>
                        @endforeach
                    </div>
                </form>    
            </div>

        </section>


        <!-- Products Section -->
        <section id="products">
            <div class="search-sort-filter">
                <!-- Search -->
                <div class="search">
                    <form action="{{ route('products.filter') }}#products" method="GET" class="filter-form">
                        <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Search by name or category...">
                    </form>
                </div>
                <div class="sort-filter">
                    <!-- Sort section -->
                    <form action="{{ route('products.filter') }}#products" method="GET" class="filter-form">
                        <div class="filter-group">
                            <select name="sort" id="sort" onchange="this.form.submit()">
                                <option value="" disabled selected>Sort by</option>
                                <option value="name">Name: A-Z</option>
                                <option value="name_desc">Name: Z-A</option>
                                <option value="price_asc">Price: Low to High</option>
                                <option value="price_desc">Price: High to Low</option>
                            </select>
                        </div>
                    </form>
                    <!-- Filter Dropdown -->
                    <div class="filter-container">
                        <button class="filter-button" onclick="toggleFilterDropdown()" type="button">
                            Filter <i class='bx bx-filter-alt'></i>
                        </button>
                        <div id="filter-dropdown" class="filter-dropdown hidden">
                            <form action="{{ route('products.filter') }}#products" method="GET" class="filter-form">
                                <!-- Filter by category -->
                                <div class="filter-group">
                                    <label for="category">Filter by:</label>
                                    <select name="category" id="category">
                                        <option value="">All Categories</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- Filter by minimum price -->
                                <div class="filter-group">
                                    <label for="min_price">Min Price:</label>
                                    <input type="number" name="min_price" id="min_price" min="0" value="{{ request('min_price') }}">
                                </div>
                                <!-- Filter by maximum price -->
                                <div class="filter-group">
                                    <label for="max_price">Max Price:</label>
                                    <input type="number" name="max_price" id="max_price" min="0" value="{{ request('max_price') }}">
                                </div>
                                <!-- Apply Filters Button -->
                                <button type="submit" class="apply-filter-button">Apply Filters</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Full products list -->
            <div class="products-grid">
                <!-- If no product matching request exist -->
                @if($products->isEmpty())
                    <p style="justify-self:center; margin: 10px;">No products found. Please adjust your filters.</p>
                @else
                    <!-- If products match -->
                    @php $displayedDrinks = []; @endphp
                    @foreach ($products as $data)
                        @if (!in_array($data->name, $displayedDrinks))
                            <div class="product-card">
                                <img src="{{ asset('assets/' . $data->image) }}" alt="Product Image">
                                <div class="product-row" style="display:inline-flex">
                                    <h3 class="product-title">{{ $data->name }}</h3>
                                    <p class="product-price">from <span>£{{ number_format($data->price, 2) }}</span></p>    
                                </div>
                                <p class="product-description">{{ $data->description }}</p>
                                <a href="{{ route('product-details', $data->id) }}" class="view-button">View</a>
                            </div>
                            @php $displayedDrinks[] = $data->name; @endphp
                        @endif
                    @endforeach
                @endif
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
                <p>Â© E-SPRESSO | All Rights Reserved</p>
            </div>
            </footer>
        </section>
    </main>
</body>