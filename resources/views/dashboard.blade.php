<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags, title, CSS and JS -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard</title>
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

        <!-- Dashboard main section -->
        <section class="dashboard">
            <div class="dash-inner">
                <div class="dash-nav">
                    <div class="user">
                        <i class='bx bx-user'></i>
                        <div class="name+email">
                        @if(Auth::check()) 
                            <p>{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}</p> 
                            <p>{{ Auth::user()->email }}</p> 
                        @endif
                        </div>
                    </div>
                    <div class="dash-buttons">
                        <a id="dash-orders" class="option">
                            <i class='bx bx-shopping-bag'></i>My Orders
                        </a>
                        <a id="dash-account" class="option">
                            <i class='bx bx-cog'></i>My Account
                        </a>
                        <a id="dash-member" class="option">
                            <i class='bx bx-reset'></i>My Membership
                        </a>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="logout">
                                <i class='bx bx-exit'></i>Logout
                            </button>
                    </form>
                </div>
                <div class="dash-title-content">
                    <div class="title">
                        <!-- Titles -->
                        <div id="dash-ordersTitle" class="title-section">My Orders</div>
                        <div id="dash-accountTitle" class="title-section" style="display: none;">My Account</div>
                        <div id="dash-memberTitle" class="title-section" style="display: none;">My Membership</div>
                    </div>
                    <div class="content">
                        <!-- Content -->
                        <div id="dash-ordersContent" class="content-section" style="display: none;">
                            @if ($orders->isEmpty())
                                <p>You have not placed any orders yet.</p>
                            @else
                                <table class="orders-table">
                                    <thead>
                                        <tr>
                                            <th>Order</th>
                                            <th>Date Placed</th>
                                            <th>Status</th>
                                            <th>Total</th>
                                            <th>Items</th>
                                            <th>Return</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>{{ $order->id }}</td>
                                                <td>{{ $order->created_at->format('d M, Y') }}</td>
                                                <td>{{ $order->status }}</td>
                                                <td class="basket-price" data-gbp="{{ number_format($order->total_cost, 2) }}">£{{ number_format($order->total_cost, 2) }}</td>
                                                <td>
                                                    <ul style="list-style:none">
                                                        @foreach ($order->orderItems as $item)
                                                            <li>{{ $item->product->name }} (x{{ $item->quantity }})</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <form>
                                                        @csrf
                                                        @method('patch')
                                                        <button type="submit" class="delete" onclick="return confirm('Are you sure you want to return this order?')">
                                                            Return
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>

                        <!-- Account Content button -->
                        <div id="dash-accountContent" class="content-section" style="display: none;">
                            <div class="profile-info">
                                <h4>Profile Information</h4>
                                <section>
                                    <p>
                                        {{ __("Update your account's profile information and email address") }}
                                    </p>

                                    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                                        @csrf
                                    </form>

                                    <form method="post" action="{{ route('profile.update') }}">
                                        @csrf
                                        @method('patch')

                                        <!--First Name row -->
                                        <div>
                                            <x-input-label for="firstName" :value="__('First Name')" />
                                            <x-text-input id="firstName" name="firstName" type="text" class="input-field" :value="old('firstName', $user->firstName)" required autofocus autocomplete="given-name" />
                                            <x-input-error style="color: red; font-size:small; list-style:none;" :messages="$errors->get('firstName')" />
                                        </div>

                                        <!--Last Name row -->
                                        <div>
                                            <x-input-label for="lastName" :value="__('Last Name')" />
                                            <x-text-input id="lastName" name="lastName" type="text" class="input-field" :value="old('lastName', $user->lastName)" required autocomplete="family-name" />
                                            <x-input-error style="color: red; font-size:small; list-style:none;" :messages="$errors->get('lastName')" />
                                        </div>

                                        <!--Email row -->
                                        <div>
                                            <x-input-label for="email" :value="__('Email')" />
                                            <x-text-input id="email" name="email" type="email" class="input-field" :value="old('email', $user->email)" required autocomplete="email" />
                                            <x-input-error style="color: red; font-size:small; list-style:none;":messages="$errors->get('email')" />
                                        </div>

                                        <div class="flex items-center gap-4">
                                            <button class="save">{{ __('Save') }}</button>

                                            @if (session('status') === 'profile-updated')
                                                <p
                                                    x-data="{ show: true }"
                                                    x-show="show"
                                                    x-transition
                                                    x-init="setTimeout(() => show = false, 2000)"
                                                    style="color: green; margin-top:20px; margin-left: 10px"
                                                >{{ __('Updated Succesfully') }}</p>
                                            @endif
                                        </div>
                                    </form>
                                </section>

                            </div>
                            <!-- Edit password information -->
                            <div class="password-info">
                                <h4>Update Password</h4>
                                <p>
                                    {{ __("Update your account's password") }}
                                </p>

                                <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                                    @csrf
                                    @method('put')

                                    <!-- Current password row -->
                                    <div>
                                        <x-input-label :value="__('Current Password')" />
                                        <input type="password" class="input-field" name="current_password" required autocomplete="current-password">
                                        <x-input-error :messages="$errors->updatePassword->get('current_password')" style="color: red; font-size:small; list-style:none;"/>
                                    </div>

                                    <!-- New password row -->
                                    <div>
                                        <x-input-label for="update_password_password" :value="__('New Password')" />
                                        <input type="password" class="input-field" name="password" required autocomplete="new-password" />
                                        <x-input-error :messages="$errors->updatePassword->get('password')" style="color: red; font-size:small; list-style:none;"/>
                                    </div>

                                    <!-- Confirm new password row -->
                                    <div>
                                        <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
                                        <input type="password" class="input-field" name="password_confirmation" required autocomplete="new-password" />
                                        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" style="color: red; font-size:small; list-style:none;"/>
                                    </div>

                                    <div class="flex items-center gap-4">
                                        <button class="save">{{ __('Save') }}</button>

                                        @if (session('status') === 'password-updated')
                                            <p
                                                x-data="{ show: true }"
                                                x-show="show"
                                                x-transition
                                                x-init="setTimeout(() => show = false, 2000)"
                                                style="color: green; margin-top:20px; margin-left: 10px"
                                            >{{ __('Updated Succesfully') }}</p>
                                        @endif
                                    </div>
                                </form>
                            </div>

                            <!-- Delete profile section -->
                            <div class="delete-profile">
                                <form method="post" action="{{ route('profile.destroy') }}">
                                    @csrf
                                    @method('PATCH')

                                    <h4>{{ __('Delete your account') }} </h4>

                                    <p>{{ __('Once your account is deleted, all of its resources and data will be permanently deleted. 
                                        Please enter your password to confirm you would like to permanently delete your account.') }}</p>

                                    <input id="password" name="password" type="password" class="input-field" placeholder="{{ __('Password') }}"/>
                                    <x-input-error :messages="$errors->userDeletion->get('password')" style="color: red; font-size:small; list-style:none;"/>

                                    <div>
                                        <button class="delete" onclick="return confirm('Are you sure you want to delete this user?')">
                                            {{ __('Delete Account') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Subscribe/Unsubscribe member section -->
                        <div id="dash-memberContent" class="content-section">
                            @if (auth()->check() && auth()->user()->isSubscribed)
                                <h2>Welcome Back, Coffee Lover!</h2>
                                <p>You're already subscribed to our coffee subscription service. Fresh beans are on their way to you regularly—enjoy your hassle-free coffee experience!</p>
                                <h4>Your subscription is active at <span>£6.95 </span>a month</h4>
                                <form method="POST" action="{{ route('unsubscribe') }}">
                                    @csrf
                                    <button type="submit" class="subscribe">Unsubscribe</button>
                                </form>
                            @else
                                <h2>Getting deja brew?</h2>
                                <p>Finding yourself running out of beans and ordering often? With our subscription you you'll never have to make a last-minute dash again. Regular deliveries mean your beans are always fresh, and your cup is always full, without the hassle of reordering. It’s the coffee experience that just keeps on brewing, right to your door!"</p>
                                <h4>Subscribe now for only <span>£6.95 </span>a month</h4>
                                <form method="POST" action="{{ route('subscribe') }}">
                                    @csrf
                                    <button type="submit" class="subscribe">Subscribe</button>
                                </form>
                            @endif
                        </div>
                    </div>
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