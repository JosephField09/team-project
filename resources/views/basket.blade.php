<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags, title, CSS, and JS -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basket</title>
    <title>Basket</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/favicon.png') }}">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>

    <style>
        /* Custom Styles */
        .basket-image {
            width: 50px;
            height: auto;
        }
        .basket-summary {
            margin-top: 20px;
            font-weight: bold;
        }
        .remove_button {
            padding: 5px 10px;
            font-size: 14px;
        }
        .empty-basket {
            text-align: center;
            font-size: 18px;
        }
        .empty-basket a {
            text-decoration: none;
            color: #007bff;
        }
    </style>
</head>

<body>
    <main>
       <!-- Header Section -->
       <section id="header">
        <nav id="main">
                <div class="navbar-left">
                    <a href="{{ route('home') }}"><img src="{{ asset('assets/E-spresso_logo.jpg') }}" alt="Logo"></a>
                </div>
                <div class="navbar-middle">
                    <a class="middle" href="{{ route('home') }}">Home</a>
                    <a class="middle" href="{{ route('products') }}">Products</a>
                    <a class="middle" href="{{ route('about-us') }}">About Us</a>
                    <a class="middle" href="{{ route('blog') }}">Blog</a>
                </div>
                <div class="navbar-right">
                    @if(Auth::check())
                        @if(Auth::user()->userType === 'admin')
                            <!-- Admin Dashboard and Basket -->
                            <a class="account" href="{{ route('admin.dashboard') }}">
                                <i class='bx bx-user'></i>
                            </a>
                            <a class="basket" href="{{route('basket')}}">
                                <i class='bx bx-basket'></i>
                            </a>
                        @elseif(Auth::user()->userType === 'user')
                            <!-- User Dashboard and Basket -->
                            <a class="account" href="{{ route('dashboard') }}">
                                <i class='bx bx-user'></i> 
                            </a>
                            <a class="basket" href="{{route('basket')}}">
                                <i class='bx bx-basket'></i>
                            </a>
                        @endif
                    @else
                        <!-- Guest: Login and Basket -->
                        <a class="login" href="{{ route('login') }}">Login</a>
                        <p>|</p>
                        <a class="basket" href="{{route('basket')}}">
                            <i class='bx bx-basket'></i>
                        </a>
                    @endif
                </div>
            </nav>
        </section>

        <!-- Basket Section -->
        <section id="basket">
            <div class="container">
                <h1 class="basket-header">Your Basket</h1>

                <!-- When the basket is empty -->
                @if (empty($basket_Items) || $basket_Items->isEmpty())
                    <p class="empty-basket">
                        Your basket is empty. <a href="{{ route('products') }}">Please continue shopping</a>.
                    </p>
                @else
                    <!-- Basket Table -->
                    <div class="basket-table">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Looping through basket items -->
                                @foreach ($basket_Items as $item)
                                    <tr>
                                        <td>
                                            <div class="product-details">
                                                <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="basket-image">
                                                <span>{{ $item->product->name }}</span>
                                            </div>
                                        </td>
                                        <td>£{{ $item->product->price }}</td>
                                        <td>
                                            <input type="number" value="{{ $item->quantity }}" min="1" class="basket_quantity form-control">
                                        </td>
                                        <td>£{{ $item->product->price * $item->quantity }}</td>
                                        <td>
                                            <button class="remove_button btn btn-danger" data-id="{{ $item->id }}">Remove</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Basket Summary Section -->
                    <div class="basket-summary">
                        <h3>Total: £{{ $basket_Items->sum(fn($item) => $item->product->price * $item->quantity) }}</h3>
                        <a href="{{ route('checkout') }}" class="btn btn-primary">Proceed to Checkout</a>
                    </div>
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
                    <p>© E-SPRESSO | All Rights Reserved</p>
                </div>
            </footer>
        </section>
    </main>
</body>
</html>
