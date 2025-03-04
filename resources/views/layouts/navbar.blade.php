<section id="header" style="width: 100vw; position: fixed; z-index: 1000;">
    <nav id="main">
        <!-- Left navbar section -->
        <div class="navbar-left">
            <a href="{{ route('home') }}"><img src="{{ asset('assets/E-spresso_logo.jpg') }}"></a>
        </div>
        <!-- Middle navbar section -->
        <div class="navbar-middle">
            <a class="middle option-selected" href="{{ route('home') }}">Home</a>
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
        <div class="hamburger">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
            <div class="sidebar">
                <a class="middle" href="{{ route('home') }}">Home</a>
                <a class="middle" href="{{ route('products') }}">Products</a>
                <a class="middle" href="{{ route('about-us') }}">About Us</a>
                <a class="middle" href="{{ route('contact-us') }}">Contact Us</a>
                <a class="middle" href="{{ route('blogs.index') }}">Blog</a>
                <!-- If user is logged in -->
                @if(Auth::check())
                    <!-- If user is admin -->
                    @if(Auth::user()->userType === 'admin')
                        <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="login" style="padding: 10px 52px;margin: 5% 0;" type="submit">Logout
                                </button>
                        </form>
                        <div class="sidebar-guest-icons">
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
                        </div>
                    <!-- If user is user -->
                    @elseif(Auth::user()->userType === 'user')
                        <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="login" style="padding: 10px 52px;margin: 5% 0;" type="submit">Logout
                                </button>
                        </form>
                        <div class="sidebar-guest-icons">
                            <a class="account" href="{{ route('dashboard') }}">
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
                        
                            
                        </div>
                    @endif
                <!-- If user is not logged in -->
                @else
                    <a style="padding: 10px 52px;margin: 5% 0;" class="login" href="{{ route('login') }}">Login</a>
                    <div class="sidebar-guest-icons">
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
                    </div>
                @endif
            </div>
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