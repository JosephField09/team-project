<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags, title, CSS, and JS -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basket</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/favicon.png') }}">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/responsive.js') }}"></script>
</head>

<body>
    <main>
       <!-- Header Section -->
       @include('layouts.navbar')

        <!-- Basket Section -->
        <section id="basket">
            <div class="basket-main">
                <div class="basket-and-checkout">
                    <!-- When the basket is empty -->
                    @if (empty($basket_Items) || $basket_Items->isEmpty())
                        <div class="empty-basket">
                            <h1>Basket</h1>
                            <hr size="2"></hr>
                            <p>Your basket is empty. <a href="{{ route('products') }}">Please continue shopping</a>.</p>
                        </div>
                        <div class="basket-summary">
                            <h2>Summary</h2>
                            <hr width="90%" size="2"></hr>
                            <div class="costs">
                                <h4>Total Products:</h4>
                                <h4 class="basket-price" data-gbp="{{ 0 }}">£0</h4>
                            </div>
                            <div class="costs">
                                <h4>Shipping costs:</h4>
                                <h4>FREE</h4>
                            </div>
                            <hr style="transform: translateY(20px)" size="2"></hr>
                            <h4 class="total" data-gbp="{{ 0 }}">Total: £0</h3>
                            <button class="btn btn-primary" @if(empty($basket_Items) || $basket_Items->isEmpty()) disabled @endif>Checkout</button>
                        </div>
                    @else
                        <!-- Basket Table -->
                        <div class="items-in-basket">
                            <div class="basket-table">
                                <h1>Basket</h1>
                                <hr width="90%" size="2"></hr>
                                <table class="basket">
                                    <thead style=" border: none;border-bottom: 1px solid lightgray">
                                        <tr>
                                            <th style="width: 30%; text-align: left; padding-left: 2%;">Products</th>
                                            <th style="width: 20%;" >Size</th>
                                            <th style="width: 15%;">Quantity</th>
                                            <th style="width: 20%;">Total</th>
                                            <th style="width: 20%;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Looping through basket items -->
                                        @foreach ($basket_Items as $item)
                                            <tr>
                                                <td>
                                                    <div class="product-details">
                                                        <img src="{{ asset('assets/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="basket-image">
                                                        <p style="align-self:center; justify-self: left; font-size:16px;">{{ $item->product->name }}</p>
                                                    </div>
                                                </td>
                                                <td style="text-transform: capitalize;">
                                                    {{ $item->product->size ?? 'N/A' }}
                                                </td>
                                                <td>
                                                    <form action= "{{route('basket.update', $item->id)}}" method="POST">
                                                        @csrf 
                                                        <input style="width: 80%; text-align: center;" type="number" name="quantity" value="{{$item->quantity}}" min="1" class="basket_quantity form-control" onchange="this.form.submit()">
                                                    </form>
                                                </td>
                                                <td class="basket-price" data-gbp="{{ $item->product->price * $item->quantity }}">£{{ $item->product->price * $item->quantity }}</td>
                                                <td>
                                                    <form action="{{route('basket.remove', $item->id)}}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="remove_button btn btn-danger">Remove</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Basket Summary Section -->
                        <div class="basket-summary">
                            <h2>Summary</h2>
                            <hr size="2"></hr>
                            <div class="costs">
                                <h4>Total Products:</h4>
                                <h4 class="basket-price" data-gbp="{{ $basket_Items->sum(fn($item) => $item->product->price * $item->quantity) }}">£{{ $basket_Items->sum(fn($item) => $item->product->price * $item->quantity) }}</h4>
                            </div>
                            <div class="costs">
                                <h4>Shipping costs:</h4>
                                <h4>FREE</h4>
                            </div>
                            <hr style="transform: translateY(20px)" size="2"></hr>
                            <h4 class="total" data-gbp="{{ $basket_Items->sum(fn($item) => $item->product->price * $item->quantity) }}">Total: £{{ $basket_Items->sum(fn($item) => $item->product->price * $item->quantity) }}</h3>
                            <a href="{{ route('checkout') }}"> Checkout </a>
                        </div>
                    @endif
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
    <!-- Toastie Notification CSS link-->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    <!-- Toastie Notification JS-->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <script>
        @if(session('success'))
        Toastify({
            text: "{{session('success')}}",
            duration: 3000, // translates into 3 seconds in realtime
            close: false, 
            gravity: "top",
            position: "center", 
            backgroundColor: "green", 
        }).showToast(); 

        //Redirect back to homepage in 3 seconds 
        setTimeout(function() {
            window.location.href = "{{route('home')}}"; 
        }, 3000); 
        @endif 
    </script>
</body>
</html>