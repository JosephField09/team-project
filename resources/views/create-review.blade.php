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
        document.addEventListener('DOMContentLoaded', function() {
            const stars = document.querySelectorAll('.star');
            const ratingInput = document.getElementById('rating');

            // Update stars based on the current selected rating
            function updateStars(rating) {
                stars.forEach(star => {
                    if (parseInt(star.getAttribute('data-value')) <= rating) {
                        star.classList.add('selected');
                    } else {
                        star.classList.remove('selected');
                    }
                });
            }

            stars.forEach(star => {
                // When a star is clicked, update the rating value and selected classes
                star.addEventListener('click', function() {
                    const rating = parseInt(this.getAttribute('data-value'));
                    ratingInput.value = rating;
                    updateStars(rating);
                });

                // When hovering, add the hover class to all stars up to the hovered star
                star.addEventListener('mouseover', function() {
                    const hoverRating = parseInt(this.getAttribute('data-value'));
                    stars.forEach(s => {
                        if (parseInt(s.getAttribute('data-value')) <= hoverRating) {
                            s.classList.add('hover');
                        } else {
                            s.classList.remove('hover');
                        }
                    });
                });

                // When the user moves the mouse, remove the hover effect
                star.addEventListener('mouseout', function() {
                    stars.forEach(s => {
                        s.classList.remove('hover');
                    });
                    updateStars(parseInt(ratingInput.value));
                });
            });
        });
    </script>
</head>

<body>
    <main>
        <!-- Header Section -->
        @include('layouts.navbar')

        <!-- Create a Review Section -->
        <section>
            <!-- If user is logged in-->
            @auth
                <div class="create-review">
                    <form class="review-form" action="{{ route('reviews.add', $id) }}" method="POST">
                        @csrf
                        @if ($id === "0")
                            <h3>Write Us a Review</h3>
                        @else
                            <h3>Write A Review for {{ \App\Models\Product::find($id)->name }}</h3>
                        @endif

                        <!-- Stars Section -->
                        <div class="stars">
                            <input type="hidden" name="rating" id="rating" value="0">
                            <i class="bx bxs-star star" data-value="1"></i>
                            <i class="bx bxs-star star" data-value="2"></i>
                            <i class="bx bxs-star star" data-value="3"></i>
                            <i class="bx bxs-star star" data-value="4"></i>
                            <i class="bx bxs-star star" data-value="5"></i>
                        </div>

                        <!-- Review title section -->
                        <div class="review-title">
                            <input type="text" class="input-field" name="title" id="title" placeholder="Enter title" required>
                        </div>
                        <!-- Review message section -->
                        <div class="review-message">
                            <textarea name="message" class="input-field" id="message" rows="7" placeholder="Enter message" required></textarea>
                        </div>
                        <button type="submit">Publish Review +</button>
                    </form>
                </div>
            @else
                <!-- If user is not logged in-->
                <div class="cant-post-review">
                    <h3>You must be logged in to create a review.</h3>
                    <a class="login" href="{{ route('login') }}">Login</a>
                </div>
            @endauth
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