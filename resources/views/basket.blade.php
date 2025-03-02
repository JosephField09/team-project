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
    <script src="{{ asset('js/app.js') }}"></script>
</head>

<body>
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
                                                        <p style="align-self:center; justify-self: left; font-size:16px; color: black;">{{ $item->product->name }}</p>
                                                    </div>
                                                </td>
                                                <td style="text-transform: capitalize; color: var(--text-colour);">
                                                    <!-- Display the size. Could be from $item->product->size or $item->size, depending on how you store it. -->
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
            duration: 3000, // means for 3 seconds
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