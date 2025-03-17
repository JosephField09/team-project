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
    <link rel="stylesheet" href="{{ asset('css/tabletstyle.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/responsive.js') }}"></script>
</head>

<body class="product-details-page">
    <main>
        <!-- Header Section -->
        @include('layouts.navbar')

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
                                    <i class="bx bxs-star" style="color:#fecc42; font-size: 18px;"></i>
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
                    <form id="add-to-basket-form" data-url="{{ route('basket.add', $data->id) }}" method="POST">
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
                        <button type="submit" id="add-to-basket-btn" class="add-to-basket" style="margin-top: 30px;" @if($data->stock == 0) disabled @endif>
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
                    $products = \App\Models\Product::inRandomOrder()->limit(3)->get();
                @endphp

                @foreach($products as $product)
                    <div class="product-card">
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
                    <p class="desc">At E-spresso, we're passionate about delivering the perfect coffee experience. From premium beans to convenient pods, we offer a selection to satisfy every coffee lover's taste. Whether you're a coffee connoisseur or just beginning your journey, Our store is your gateway to a world of rich flavors and aromatic delights.</p>
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
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script> 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function () {
            $("#add-to-basket-form").on("submit", function (e) {
                e.preventDefault(); //

                let form = $(this); 
                let url = form.data("url"); //
                let quantity = $("#quantity").val(); 

                $.ajax({
                    url: url, 
                    type: "POST", 
                    data: {
                        _token: "{{csrf_token()}}", //
                        quantity: quantity 
                    }, 
                    headers: {
                        'X-CSRF-TOKEN': "{{csrf_token()}}"
                    },
                    success: function (response) {
                        if (response.message) {
                            //
                            Toastify({
                                text: response.message,
                                duration: 2000,
                                close: false, 
                                gravity: "top",
                                position: "center",
                                offset: {
                                    x: 0,
                                    y: 80
                                },
                                style: {
                                    background: "green",
                                    color: "white",
                                    padding: "12px 20px",
                                    borderRadius: "5px",
                                    fontSize: "14px",
                                    zIndex: 9999, 
                                    position: "fixed",
                                    top: "0", 
                                    left: "43%",
                                    transform: "translateY(50%)",
                                    boxShadow: "0px 4px 10px rgba(0,0,0,0.1)",
                                    transition:"0.5s"
                                }
                            }).showToast(); 

                            //
                            let basketCountElement = $(".basket-count"); 

                            //
                            if (basketCountElement.length) {
                                basketCountElement.text(response.basketCount);
                            } else {
                                //
                                $(".basket").append(`
                                <span class= "basket-count">${response.basketCount}</span>
                                `);
                            }
                        }
                    }
                });
            });
        });
    </script>
</body>