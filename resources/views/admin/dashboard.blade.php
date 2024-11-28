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
    <script src="{{ asset('js/app.js') }}"></script>
</head>

<body>
    <main>
        <!-- Header Section -->
        <section id="header">
            <nav>
                <div class="navbar-left">
                    <a href="{{ route('home') }}"><img src="{{ asset('assets/E-spresso_logo.jpg') }}"></a>
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
                            <a class="basket" href="/team-project/resources/views/basket.blade.php">
                                <i class='bx bx-basket'></i>
                            </a>
                        @elseif(Auth::user()->userType === 'user')
                            <!-- User Dashboard and Basket -->
                            <a class="account" href="{{ route('dashboard') }}">
                                <i class='bx bx-user'></i>
                            </a>
                            <a class="basket" href="/team-project/resources/views/basket.blade.php">
                                <i class='bx bx-basket'></i>
                            </a>
                        @endif
                    @else
                        <!-- Guest: Login and Basket -->
                        <a class="login" href="{{ route('login') }}">Login</a>
                        <p>|</p>
                        <a class="basket" href="/team-project/resources/views/basket.blade.php">
                            <i class='bx bx-basket'></i>
                        </a>
                    @endif
                </div>
            </nav>
        </section>

        <!-- Admin Dashboard Main Container -->
        <section class="admin-main"> 
            <div id="admin-nav">
                <div class="admin-user">
                    <i style="color: white;" class='bx bx-user'></i>
                    <div class="name">
                    @if(Auth::check()) 
                        <p>{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}</p> 
                    @endif
                    </div>
                </div>
                <div class="admin-buttons">
                    <a id="home" class="choice">Home</a>
                    <a id="allOrders" class="choice">Manage Orders</a>
                    <a id="allUsers" class="choice">Manage Users</a>
                    <a id="allProducts" class="choice">Categories and Products</a>
                    <a id="settings" class="choice" >Settings</a>
                </div>

                <div class="admin-logout">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="admin-log">
                            <i class='bx bx-exit'></i>Logout
                        </button>
                    </form>
                </div>
            </div>

            <div class="admin-content">
                <div id="homeContent" class="admin-section" style="display:none;">
                    <p>This is the main dashboard screen</p>
                </div>
                <div id="allOrdersContent" class="admin-section" style="display: none;">
                    <p>All orders will appear here.</p>
                </div>
                <div id="allUsersContent" class="admin-section" style="display: none;">
                    <h1>Admin Dashboard</h1>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->firstName }}</td>
                                        <td>{{ $user->lastName }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                </div>
                <div id="allProductsContent" class="admin-section" style="display: none;">
                    <p>All Products will appear here.</p>
                </div>
                <div id="settingsContent" class="admin-section" style="display: none;">
                    <div class="profile-info">
                            <h4>Profile Information</h4>
                            <section>
                                <p>
                                    {{ __("Update your account's profile information and email address.") }}
                                </p>

                                <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                                    @csrf
                                </form>

                                <form method="post" action="{{ route('profile.updateAdmin') }}">
                                    @csrf
                                    @method('patch')

                                    <div>
                                        <x-input-label for="firstName" :value="__('First Name')" />
                                        <x-text-input id="firstName" name="firstName" type="text" class="input-field" :value="old('firstName', $user->firstName)" required autofocus autocomplete="given-name" />
                                        <x-input-error style="color: red; font-size:small; list-style:none;" :messages="$errors->get('firstName')" />
                                    </div>

                                    <div>
                                        <x-input-label for="lastName" :value="__('Last Name')" />
                                        <x-text-input id="lastName" name="lastName" type="text" class="input-field" :value="old('lastName', $user->lastName)" required autocomplete="family-name" />
                                        <x-input-error style="color: red; font-size:small; list-style:none;" :messages="$errors->get('lastName')" />
                                    </div>

                                    <div>
                                        <x-input-label for="email" :value="__('Email')" />
                                        <x-text-input id="email" name="email" type="email" class="input-field" :value="old('email', default: $user->email)" required autocomplete="email" />
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
                        <div class="password-info">
                            <h4>Update Password</h4>
                            <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                                @csrf
                                @method('put')

                                <div>
                                    <x-input-label :value="__('Current Password')" />
                                    <input type="password" class="input-field" name="current_password" required autocomplete="current-password">
                                    <x-input-error :messages="$errors->updatePassword->get('current_password')" style="color: red; font-size:small; list-style:none;"/>
                                </div>

                                <div>
                                    <x-input-label for="update_password_password" :value="__('New Password')" />
                                    <input type="password" class="input-field" name="password" required autocomplete="new-password" />
                                    <x-input-error :messages="$errors->updatePassword->get('password')" style="color: red; font-size:small; list-style:none;"/>
                                </div>

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
                                    <button class="delete">
                                        {{ __('Delete Account') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
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