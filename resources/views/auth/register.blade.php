<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags, title, CSS and JS -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/favicon.png') }}">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tabletstyle.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/responsive.js') }}"></script>
</head>

<body>
    <main>
        <!-- Header Section -->
        @include('layouts.navbar')

        <!-- Register form and php section -->
        <section class="main">
            <div class="form-box">
            <h1>Register</h1>
                <div class="form-inner">
                    <form id="register" class="input-group" action="{{ route('register') }}" method="post">
                        @csrf
                        <!-- Name row -->
                        <div class="form-row">
                            <input type="text" class="input-field" name="firstName" placeholder="First Name" value="{{ old('firstName') }}" required>
                            <input type="text" class="input-field" name="lastName" placeholder="Last Name" value="{{ old('lastName') }}" required>
                        </div>

                        <!-- Email and phone number row -->
                        <div class="form-row">
                            <input type="email" class="input-field" name="email" placeholder="Email" value="{{ old('email') }}" required>
                            <input type="tel" class="input-field" name="phone" placeholder="Phone Number" value="{{ old('phone') }}" required>
                        </div>

                        <!-- Password row -->
                        <div class="form-row">
                            <input type="password" class="input-field" name="password" placeholder="Password" required>
                            <input type="password" class="input-field" name="password_confirmation" placeholder="Confirm Password" required>
                        </div>

                        <!-- If email is already registered -->
                        @if ($errors->has('email'))
                            <p class="error-message" style="color: red; margin-top: 10px;">
                            {{ __('This email is already registered. Please log in or use a different email.') }}
                            </p>
                        @endif

                        <!-- If password does not match -->
                        @if ($errors->has('password') && $errors->first('password') == 'The password field confirmation does not match.')
                            <p class="error-message" style="color: red; margin-top: 10px;">
                                The passwords do not match, please try again
                            </p>
                        @elseif ($errors->has('password'))
                            <p class="error-message" style="color: red; margin-top: 10px;">
                                {{ $errors->first('password') }}
                            </p>
                        @endif

                        <button type="submit" class="submit-btn">Register</button>
                    </form>
                    <p>Have an account? <a href="{{ route('login') }}">Login here</a></p>
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