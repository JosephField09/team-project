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
    <link rel="stylesheet" href="{{ asset('css/tabletstyle.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/responsive.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {

            // Function to fetch filtered products via AJAX
            function fetchFilteredProducts() {
                // Gather filter input values
                let search = $('#search').val();
                let category = $('#category-select').val();
                let minPrice = $('#min-price').val();
                let maxPrice = $('#max-price').val();
                let sort = $('#sort-select').val();

                // Prepare the data for the GET request
                let data = {
                    search: search,
                    category: category,
                    min_price: minPrice,
                    max_price: maxPrice,
                    sort: sort
                };

                $.ajax({
                    url: "{{ route('products.filter') }}",
                    type: 'GET',
                    data: data,
                    success: function(response) {
                        if(response.status === 'success') {
                            // Replace the product grid HTML
                            $('#products-grid').html(response.html);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }

            // Fetch when any filter input changes
            $('#search, #category-select, #min-price, #max-price, #sort-select').on('change keyup', function() {
                fetchFilteredProducts();
            });

            // Fetch when category-button is clicked
            $(document).on('click', '.category-button', function(e) {
                e.preventDefault(); 

                // Get the category from data field
                let clickedCategoryId = $(this).data('category-id');

                // Update the #category-select's value to match the clicked link
                $('#category-select').val(clickedCategoryId);

                // Fetch with the updated category
                fetchFilteredProducts();
            });

        });
    </script>
</head>

<body>
    <main>
       <!-- Header Section -->
       @include('layouts.navbar')

        <!-- Call to Action Section -->
        <section id="cta" style="background-image: url({{ asset('assets/AdobeStock_262772087.jpg') }});" >
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
                <!-- We can remove the form if the plan is to do everything via AJAX -->
                <div class="filter-group">   
                    <!-- 'Shop All' (no category) -->
                    <div class="category-wrapper">
                        <!-- href="javascript:;" or "#" to prevent navigation -->
                        <a href="javascript:;" 
                        class="category-button"
                        data-category-id=""
                        style="background-image: url({{ asset('assets/favicon.png') }});
                                background-position: center;
                                background-size: cover;
                                background-repeat: no-repeat;
                                background-origin: content-box;" >
                        </a>
                        <div class="category-name">Shop All</div>
                    </div>

                    <!-- Create a tag for all categories -->
                    @foreach ($categories as $category)
                        <div class="category-wrapper">
                            <!-- Instead of linking to route('products.filter', ...), use a 'javascript:;' href -->
                            <a href="javascript:;" 
                            class="category-button"
                            data-category-id="{{ $category->id }}"
                            style="background-image: url('{{ asset('assets/' . $category->image) }}');
                                    background-position: center;
                                    background-size: contain;
                                    background-repeat: no-repeat;
                                    background-origin: content-box;">
                            </a>
                            <p>{{ $category->name }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Products Section -->
        <section id="products">
            <!-- Search sort and filter row -->
            <div class="search-sort-filter">
                <!-- Search -->
                <div class="search">
                    <input type="text" id="search" name="search" placeholder="Search products...">
                </div>
                <div class="sort-filter">
                    <!-- Sort section -->
                    <form action="{{ route('products.filter') }}#products" method="GET" class="filter-form">
                        <div class="filter-group">
                            <select name="sort" id="sort-select">
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
                            <!-- Filter by category -->
                            <div class="filter-group">
                                <label for="category">Filter</label>
                                <select name="category" id="category-select">
                                    <option value="">All Categories</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Filter by minimum price -->
                            <input type="number" id="min-price" name="min_price" placeholder="Min Price">
                            
                            <!-- Filter by maximum price -->
                            <input type="number" id="max-price" name="max_price" placeholder="Max Price">
                           
                        </div>
                    </div>
                </div>
            </div>
            
            <div id="products-grid" style="display: grid;  grid-template-columns: repeat(4, 1fr);  gap: 20px;   margin-bottom: 20px;">
                @include('layouts/_products-list', ['products' => $products])
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