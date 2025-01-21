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
                    <a class="middle" href="{{ route('about-us') }}">About Us</a>
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
                            <button id="toggleMode"><i class='bx bxs-moon'></i></button>
                            <script src="{{ asset('js/dark-mode.js') }}"></script>
                        <!-- If user is user -->
                        @elseif(Auth::user()->userType === 'user')
                            <a class="account" href="{{ route('dashboard') }}">
                                <i class='bx bx-user'></i>
                            </a>
                            <a class="basket" href="{{ route('basket') }}">
                                <i class='bx bx-basket'></i>
                                @if($basketCount > 0)
                                    <span class="basket-count">{{ $basketCount }}</span>
                                @endif
                            </a>
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
                        <button id="toggleMode"><i class='bx bxs-moon'></i></button>
                        <script src="{{ asset('js/dark-mode.js') }}"></script>
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
                <!-- Admin tab buttons -->
                <div class="admin-buttons">
                    <div class="admin-buttons">
                    <a href="{{ route('admin.dashboard', ['tab' => 'home']) }}" id="home" class="choice">Home</a>
                    <a href="{{ route('admin.dashboard', ['tab' => 'allOrders']) }}" id="allOrders" class="choice">Manage Orders</a>
                    <a href="{{ route('admin.dashboard', ['tab' => 'allUsers']) }}" id="allUsers" class="choice">Manage Users</a>
                    <a href="{{ route('admin.dashboard', ['tab' => 'allProducts']) }}" id="allProducts" class="choice">Categories and Products</a>
                    <a href="{{ route('admin.dashboard', ['tab' => 'settings']) }}" id="settings" class="choice">Settings</a>
                </div>
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

            <!-- Admin Content container -->
            <div class="admin-content">
                <!-- Home Content container -->
                <div id="homeContent" class="admin-section" style="display:none;">
                    <p>This is the main dashboard screen</p>
                </div>
                <!-- Order Content container -->
                <div id="allOrdersContent" class="admin-section" style="display: none;">
                    <p>All orders will appear here.</p>
                </div>
                <!-- User Content container -->
                <div id="allUsersContent" class="admin-section" style="display: none; text-align:center;">
                    <h2>Users List</h2>
                    <form action="{{ url('profile.search')}}" method="get" style="width: 50%">
                        @csrf
                        <div class="form-row">
                            <input class="input-field" type="text" name="search" value="{{ request('search') }}" placeholder="Search by First Name or Email"/>
                            <input type="hidden" name="tab" value="allUsers" />
                            <button class="add-cat" type="submit">Search</button>
                        </div>
                    </form>
                    <table class="table" style="transform:translateY(-20%); position:relative; top: 15%; padding: 5% 1% 1% 1%;">
                        <thead>
                            <tr style="background-color: var(--secondary-colour); color: var(--primary-colour);">
                                <th>#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                            <tr style="background-color: var(--light-bg); border-bottom: 1px solid var(--dark-bg);">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->firstName }}</td>
                                <td>{{ $user->lastName }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>
                                <form action="{{ route('profile.destroyOther', $user->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('patch')
                                    <button type="submit" class="delete-btn" onclick="return confirm('Are you sure you want to delete this user?')"><i class='bx bx-trash'></i></button>
                                </form>
                            </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="6" style="text-align: center; font-style: italic; padding:10px;">No users found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div>
                        {{ $users->links('pagination::bootstrap-4') }}
                    </div>
                </div>

                <!-- Categories and Products container -->
                <div id="allProductsContent" class="admin-section" style="display: none;">
                    <!-- Categories section -->
                    <div class="categories">
                        <h4>Add a Category</h4>
                        <form action="{{ url('category.add') }}" method="post">
                            @csrf
                            <div>
                                <input class ="input-field" type="text" name="category" placeholder="Enter a Category" required>
                                <input class="add-cat" type="submit" value="Add category">
                            </div>
                        </form>

                        <table class="table" style="transform:translateY(-40%); position:relative; top: 15%; padding: 5% 2% 5% 2%; width:100%; text-align:center;">
                            <thead>
                                <tr style="background-color: var(--secondary-colour); color: var(--primary-colour);">
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $category)
                                    <tr style="background-color: var(--light-bg); border-bottom: 1px solid var(--dark-bg);">
                                        <td>{{ $loop->iteration }}</td>
                                        <td style="padding:5px;" ondblclick="editCategoryName(this, '{{ $category->id }}')">
                                            <span class="category-name">{{ $category->name }}</span>
                                            <input type="text" class="edit-input" value="{{ $category->name }}" style="display: none; width: 100%;" 
                                                onblur="saveCategoryName(this, '{{ $category->id }}')"
                                                onkeydown="if(event.key === 'Enter') saveCategoryName(this, '{{ $category->id }}')">
                                        </td>
                                        <td style="text-align: center;">
                                            <i class="bx bx-edit" style="cursor: pointer;" 
                                            onclick="editCategoryName(this.closest('td').previousElementSibling, '{{ $category->id }}')"></i>
                                        </td>
                                        <td>
                                            <form action="{{ route('category.destroy', $category->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('patch')
                                                <button type="submit" class="delete-btn" onclick="return confirm('Are you sure you want to delete this category?')">
                                                    <i class='bx bx-trash'></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" style="text-align: center; font-style: italic; padding:10px;">No categories found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div style="margin-top: 20px">
                            {{ $categories->links('pagination::bootstrap-4') }}
                        </div>
                    </div>

                    <!-- Products section -->
                    <div class="products">
                        <h4>Add a Product</h4>
                        <form action="{{ route('add_product') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <!-- Name row -->
                            <div class="form-row" style="display:grid; grid-template-columns:1fr 4fr; align-items:center;">
                                <label>Product Name:</label>
                                <input class ="input-field" type="text" name="name" placeholder="Enter a Name" required>
                            </div>

                            <!-- Image row -->
                            <div class="form-row" style="display:grid; grid-template-columns:1fr 4fr; align-items:center;">
                                <label>Product Image:</label>
                                <input class ="input-field" type="file" name="image"required></input>
                            </div>
                            
                            <!-- Description row -->
                            <div class="form-row" style="display:grid; grid-template-columns:1fr 4fr; align-items:center;">
                                <label>Product Description:</label>
                                <textarea class ="input-field" type="text" name="description" placeholder="Enter a Description" required></textarea>
                            </div>
                            
                            <!-- Price row -->
                            <div class="form-row" style="display:grid; grid-template-columns:1fr 4fr; align-items:center;">
                                <label>Price:</label>
                                <input type="number" class ="input-field" name="price" min="0" value="0" placeholder="0.00" step="0.01" style="color: gray;" required>
                            </div>

                            <!-- Size row -->
                            <div class="form-row" style="display:grid; grid-template-columns:1fr 4fr; align-items:center;">
                                <label>Size:</label>
                                <select style="color: gray;" id="size" class ="input-field" name="size" required>
                                  <option value="" disabled selected>Select a Size</option>
                                    <option value="small">Small</option>
                                    <option value="medium">Medium</option>
                                    <option value="large">Large</option>
                                    <option value="one-size">One-Size</option>
                                </select>
                            </div>
                            
                            <!-- Quantity row -->
                            <div class="form-row" style="display:grid; grid-template-columns:1fr 4fr; align-items:center;">
                                <label>Quantity:</label>
                                <input type="number" class ="input-field"  name="stock" min="0" step="1" placeholder="0" required>                            
                            </div>
                            
                            <!-- Category row -->
                            <div class="form-row" style="display:grid; grid-template-columns:1fr 4fr; align-items:center;">
                                <label for="category_id">Category:</label>
                                <select id="category_id" class ="input-field" name="category_id" style="color: gray;" required>
                                  <option value="" disabled selected>Select a Category</option>
                                  @foreach($categories as $category)
                                       <option value="{{ $category->id }}">{{ $category->name }}</option>
                                  @endforeach
                                </select>
                            </div>

                            <div>
                                <input class="add-cat" type="submit"value="Add Product" style="margin-left:0;">
                                @if (session('status') === 'product-added')
                                    <p 
                                        x-data="{ show: true }"
                                        x-show="show"
                                        x-transition
                                        x-init="setTimeout(() => show = false, 2000)"
                                        style="color: green; margin-top:10px; display:inline; margin-left:8px;"
                                    >{{ __('Product Added Succesfully') }}</p>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Settings section -->
                <div id="settingsContent" class="admin-section" style="display: none;">

                    <!-- Profile information section -->
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
                                        <x-text-input id="firstName" name="firstName" type="text" class="input-field" :value="old('firstName', $admin->firstName)" required autofocus autocomplete="given-name" />
                                        <x-input-error style="color: red; font-size:small; list-style:none;" :messages="$errors->get('firstName')" />
                                    </div>

                                    <div>
                                        <x-input-label for="lastName" :value="__('Last Name')" />
                                        <x-text-input id="lastName" name="lastName" type="text" class="input-field" :value="old('lastName', $admin->lastName)" required autocomplete="family-name" />
                                        <x-input-error style="color: red; font-size:small; list-style:none;" :messages="$errors->get('lastName')" />
                                    </div>

                                    <div>
                                        <x-input-label for="email" :value="__('Email')" />
                                        <x-text-input id="email" name="email" type="email" class="input-field" :value="old('email', default: $admin->email)" required autocomplete="email" />
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

                        <!-- Update password section -->
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
                        <li><a href="{{ route('blog') }}">Blog</a></li>
                        <li><a class="login" href="{{ route('admin.register') }}">Admin Register</a></li>

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