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
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/responsive.js') }}"></script>
</head>

<body>
    <main>
        <!-- Admin Dashboard Main Container -->
        <section class="admin-main"> 
            <div id="admin-nav-container">
                <div id="admin-nav">
                    <div class="admin-logo"><a href="{{ route('home') }}"><img src="{{ asset('assets/E-spresso_logo.jpg') }}"></a></div>
                    <div class="admin-user">
                        <i style="color: white; font-size: 32px; align-content: center;" class='bx bx-user'></i>
                        <div class="name">
                        @if(Auth::check()) 
                            <p style="color: white; font-size: 15px; margin-bottom: 1%;">{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}</p> 
                            <p style=" font-size: 10px;">Admin</p> 
                        @endif
                        </div>
                    </div>
                    <!-- Admin Buttons -->
                    <div class="admin-buttons">
                        <h4>Analytics</h4>
                        <div class="admin-buttons-all">
                            <a href="{{ route('admin.dashboard', ['tab' => 'home']) }}" id="admin-home" class="choice"><i class='bx bx-home'></i>Dashboard</a>
                            <a href="{{ route('admin.dashboard', ['tab' => 'allOrders']) }}" id="admin-allOrders" class="choice"><i class='bx bx-shopping-bag'></i>Manage Orders</a>
                            <a href="{{ route('admin.dashboard', ['tab' => 'allUsers']) }}" id="admin-allUsers" class="choice"><i class='bx bx-user'></i>Manage Users</a>
                            <a href="{{ route('admin.dashboard', ['tab' => 'allCategories']) }}" id="admin-allCategories" class="choice"><i class='bx bx-category'></i>Categories</a>
                            <a href="{{ route('admin.dashboard', ['tab' => 'allProducts']) }}" id="admin-allProducts" class="choice"><i class='bx bx-coffee'></i>Products</a>
                            <a href="{{ route('admin.dashboard', ['tab' => 'settings']) }}" id="admin-settings" class="choice"><i class='bx bx-cog'></i>Settings</a>
                        </div>
                    </div>
                    <div class="navbar-buttons">
                        <h4>Pages</h4>
                        <div class="navbar-buttons-all">
                            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}"><i class='bx bx-home'></i>Home</a>
                            <a href="{{ route('products') }}" class="{{ request()->routeIs('products') ? 'active' : '' }}"><i class='bx bx-coffee'></i>Products</a>
                            <a href="{{ route('about-us') }}" class="{{ request()->routeIs('about-us') ? 'active' : '' }}"><i class='bx bx-info-circle'></i>About Us</a>
                            <a href="{{ route('contact-us') }}" class="{{ request()->routeIs('contact-us') ? 'active' : '' }}"><i class='bx bx-envelope'></i>Contact Us</a>
                            <a href="{{ route('blogs.index') }}" class="{{ request()->routeIs('blogs.index') ? 'active' : '' }}"><i class='bx bx-chat'></i>Blog</a>
                        </div>
                    </div>
                    <div></div>
                    <div class="admin-logout">
                        <form method="POST" action="{{ route('logout') }}" style="justify-self: center;">
                            @csrf
                            <button type="submit" class="admin-log">
                                <i class='bx bx-exit'></i>Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>            
            <div class="admin-all">
                <div class="admin-horizontal-nav">
                    <div class="admin-hamburger">
                        <div class="bar"></div>
                        <div class="bar"></div>
                        <div class="bar"></div>
                    </div>
                    <div class="admin-nav-middle">
                        <a href="{{ route('home') }}"><img src="{{ asset('assets/E-spresso_logo.jpg') }}"></a>
                    </div>
                </div>
                <!-- Admin titles and Content container -->
                <div class="admin-titles-content">
                    <!-- Admin Titles container -->
                    <div class="admin-titles">
                        <p id="admin-homeTitle" class="adminTitle" style="display: none;">Dashboard</p>
                        <p id="admin-allOrdersTitle" class="adminTitle" style="display: none;">Manage Orders</p>
                        <p id="admin-allUsersTitle" class="adminTitle" style="display: none;">Manage Users</p>
                        <p id="admin-allCategoriesTitle" class="adminTitle" style="display: none;">Categories</p>
                        <p id="admin-allProductsTitle" class="adminTitle" style="display: none;">Products</p>
                        <p id="admin-settingsTitle" class="adminTitle" style="display: none;">Settings</p>
                    </div>
                    <!-- Admin Content container -->
                    <div class="admin-content">
                        <!-- Home Content container -->
                        <div id="admin-homeContent" class="admin-section" style="display:none;">
                            <div id="quick-stats">
                                <div class="stat-card">
                                    <div class="stat-info">
                                        <h3>{{ $totalOrders }}</h3>
                                        <p>Total Orders</p>
                                    </div>
                                    <div class="stat-icon">
                                        <i class='bx bx-shopping-bag'></i>
                                    </div>
                                </div>
                                <div class="stat-card">
                                    <div class="stat-info">
                                        <h3 class="price" data-gbp="{{ number_format($totalRevenue, 2) }}">£{{ number_format($totalRevenue, 2) }}</h3>
                                        <p>Revenue</p>
                                    </div>
                                    <div class="stat-icon">
                                        <i class='bx bx-trending-up'></i>
                                    </div>
                                </div>
                                <div class="stat-card">
                                    <div class="stat-info">
                                        <h3>{{ $totalUsers }}</h3>
                                        <p>Total Users</p>
                                    </div>
                                    <div class="stat-icon">
                                        <i class='bx bx-group'></i>
                                    </div>
                                </div>
                                <div class="stat-card">
                                    <div class="stat-info">
                                        <h3 class="avg-order" data-gbp="{{ number_format($averageOrderValue, 2) }}">£{{ number_format($averageOrderValue, 2) }}</h3>
                                        <p>Average Order Value</p>
                                    </div>
                                    <div class="stat-icon">
                                        <i class='bx bx-credit-card'></i>
                                    </div>
                                </div>
                            </div>
                            <div id="main-stats">
                                <div id="main-card">
                                    <h3>Best Selling Products</h3>
                                    <table class="best-selling" 
                                        style="transform:translateY(-20%); 
                                            position:relative; 
                                            top: 15%; 
                                            text-align: left;
                                            width:100%;">
                                        <thead>
                                            <tr style="color: var(--primary-colour);">
                                                <th>Product Name</th>
                                                <th>Size</th>
                                                <th>Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($bestSellers as $seller)
                                                <tr style=" color: var(--text-colour); border-bottom: 1px solid var(--dark-bg); font-size:13px;">
                                                    <td>{{ $seller->name }}</td>
                                                    <td style="text-transform: capitalize;">{{ $seller->size }}</td>
                                                    <td>{{ $seller->total_sold }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="2" 
                                                        style="text-align: center; font-style: italic; padding:10px;">
                                                        No products found.
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div id="main-card">
                                    <h3>Items Low in Stock</h3>
                                    <table class="best-selling" 
                                        style="transform:translateY(-7%); 
                                            top: 15%; 
                                            text-align: left;
                                            width:100%;">
                                        <thead>
                                            <tr style="color: var(--primary-colour);">
                                                <th>Product Name</th>
                                                <th>Stock</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($lowStockProducts as $product)
                                                <tr style=" color: var(--text-colour); border-bottom: 1px solid var(--dark-bg); font-size:13px;">
                                                    <td>{{ $product->name }}</td>
                                                    <td>{{ $product->stock }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="2" 
                                                        style="text-align: center; font-style: italic; padding:10px;">
                                                        No products are low in stock.
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- Order Content container -->
                        <div id="admin-allOrdersContent" class="admin-section" style="display: none;">
                            <form action="{{ url('orders') }}" method="get" style="width: 50%">
                                @csrf
                                <div class="form-row" style="margin-top: 3%;">
                                    <input class="input-field" 
                                        type="text" 
                                        name="search" 
                                        value="{{ request('search') }}" 
                                        placeholder="Search by Order #, First name or Email" />
                                    <input type="hidden" name="tab" value="allOrders" />
                                    <button class="add-cat" type="submit">Search</button>
                                </div>
                            </form>

                            <table class="table" 
                                style="transform:translateY(-20%); 
                                        position:relative; 
                                        top: 15%; 
                                        padding: 3% 1% 1% 1%; 
                                        text-align: center;">
                                <thead>
                                    <tr style="background-color: var(--secondary-colour); color: var(--primary-colour);">
                                        <th>Order #</th>
                                        <th>Placed By</th>
                                        <th>Date Placed</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                        <th>Items</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($orders as $order)
                                        <tr style="background-color: var(--light-bg); border-bottom: 1px solid var(--dark-bg);">
                                            <td>{{ $order->id }}</td>
                                            <td>
                                                {{ $order->user->firstName }} {{ $order->user->lastName }} ({{ $order->user->email }})
                                            </td>
                                            <td>{{ $order->created_at->format('d M, Y') }}</td>
                                            <td>
                                                <form action="{{ route('orders.update', $order->id) }}" method="POST" class="status-form">
                                                    @csrf
                                                    @method('PUT')
                                                    <select name="status" style="background-color: transparent; border: none;" class="status-select"
                                                            onchange="this.form.submit()" {{ in_array($order->status, ['Returned', 'Cancelled']) ? 'disabled' : '' }}>
                                                        @if($order->status == 'Paid')
                                                            <option value="Paid" selected>Paid</option>
                                                            <option value="Processed/Shipped">Processed/Shipped</option>
                                                            <option value="Cancelled">Cancelled</option>
                                                        @elseif($order->status == 'Processed/Shipped')
                                                            <option value="Processed/Shipped" selected>Processed/Shipped</option>
                                                            <option value="Returned">Returned</option>
                                                        @elseif($order->status == 'Returned')
                                                            <option value="Returned" selected>Returned</option>
                                                        @elseif($order->status == 'Cancelled')
                                                            <option value="Cancelled" selected>Cancelled</option>
                                                        @endif
                                                    </select>
                                                </form>
                                            </td>
                                            <td>£{{ number_format($order->total_cost, 2) }}</td>
                                            <td>
                                                <ul style="list-style:none; padding: 0;">
                                                    @foreach ($order->orderItems as $item)
                                                        <li>{{ $item->product->name }} (x{{ $item->quantity }})</li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" 
                                                style="text-align: center; font-style: italic; padding:10px;">
                                                No orders found.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- User Content container -->
                        <div id="admin-allUsersContent" class="admin-section" style="display: none;">
                            <div class="add-user">
                                <h4>Add a User</h4>
                                <form action="{{ route('profile.add') }}" method="post">
                                    @csrf
                                    <!-- First Name row -->
                                    <div class="form-row" style="display:grid; align-items:center;">
                                        <label>First Name:</label>
                                        <input class ="input-field" type="text" name="firstName" placeholder="Enter a first name" required>
                                    </div>
                                    <!-- Last Name row -->
                                    <div class="form-row" style="display:grid; align-items:center;">
                                        <label>Last Name:</label>
                                        <input class ="input-field" type="text" name="lastName" placeholder="Enter a last name" required>
                                    </div>
                                    <div class="form-row" style="display:grid; align-items:center;">
                                        <label>Password:</label>
                                        <input class="input-field" type="password" name="password" placeholder="Enter Password" required>
                                    </div>
                                    <!-- Email row -->
                                    <div class="form-row" style="display:grid; align-items:center;">
                                        <label>Email:</label>
                                        <input class ="input-field" type="email" name="email" placeholder="Enter an email" required>
                                    </div>
                                    <!-- Phone row -->
                                    <div class="form-row" style="display:grid; align-items:center;">
                                        <label>Phone:</label>
                                        <input class ="input-field" type="text" name="phone" placeholder="Enter a phone" required>
                                    </div>
                                    <!-- User Type row -->
                                    <div class="form-row" style="display:grid; align-items:center;">
                                        <label>User Type:</label>
                                        <select name="userType" class="input-field" required>
                                            <option value="user">User</option>
                                            <option value="admin">Admin</option>
                                        </select>
                                    </div>

                                    <div>
                                        <input class="add-cat" type="submit" value="Add User" style="margin-left:0;">
                                        @if (session('status') === 'user-not-added')
                                            <p 
                                                x-data="{ show: true }"
                                                x-show="show"
                                                x-transition
                                                x-init="setTimeout(() => show = false, 2000)"
                                                style="color: red; margin-top:10px; display:inline; margin-left:8px;"
                                            >{{ __('User Not Added - This email is already in use') }}</p>
                                        @elseif (session('status') === 'user-added')
                                            <p 
                                                x-data="{ show: true }"
                                                x-show="show"
                                                x-transition
                                                x-init="setTimeout(() => show = false, 2000)"
                                                style="color: green; margin-top:10px; display:inline; margin-left:8px;"
                                            >{{ __('User Added Succesfully') }}</p>
                                        @endif
                                        @error('password')
                                            <p style="color: red; margin-top:10px; display:inline; margin-left:8px;">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </form>
                            </div>
                            <div class="edit-user">
                                <h4>Edit Users</h4>
                                <form action="{{ url('users')}}" method="get" style="width: 70%">
                                    @csrf
                                    <div class="form-row" style="margin-top: 3%;">
                                        <input class="input-field" type="text" name="search" value="{{ request('search') }}" placeholder="Search by First Name or Email"/>
                                        <input type="hidden" name="tab" value="allUsers" />
                                        <button class="add-cat" type="submit">Search</button>
                                    </div>
                                </form>
                                <table class="table" style="padding: 3% 1% 1% 1%; width:100%; text-align:center;">
                                    <thead>
                                        <tr style="background-color: var(--secondary-colour); color: var(--primary-colour);">
                                            <th>#</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Edit</th>
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
                                                <a style="color: black;" href="{{ route('users.edit', $user->id) }}" class="edit-btn"><i class='bx bx-edit'></i></a>
                                            </td>
                                            <td>
                                                <form action="{{ route('profile.destroyOther', $user->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('patch')
                                                    <button type="submit" class="delete-btn" onclick="return confirm('Are you sure you want to delete this user?')">
                                                        <i class='bx bx-trash'></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="7" style="text-align: center; font-style: italic; padding:10px;">No users found.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div>
                                    {{ $users->links('pagination::bootstrap-4') }}
                                </div>
                            </div>
                        </div>
                        <div id="admin-allCategoriesContent" class="admin-section" style="display: none;">
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

                                <table class="table" style="top: 15%; padding: 2%; width:100%; text-align:center;">
                                    <thead>
                                        <tr style="background-color: var(--secondary-colour); color: var(--primary-colour);">
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($allcategories as $category)
                                            <tr style="background-color: var(--light-bg); border-bottom: 1px solid var(--dark-bg);">
                                                <td>{{ $category->id }}</td>
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
                                    {{ $allcategories->links('pagination::bootstrap-4') }}
                                </div>
                            </div>
                        </div>
                        <!-- Categories and Products container -->
                        <div id="admin-allProductsContent" class="admin-section" style="display: none;">
                            <!-- Products section -->
                            <div class="products">
                                <h4>Add a Product</h4>
                                <form action="{{ route('add_product') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <!-- Name row -->
                                    <div class="form-row" style="display:grid; align-items:center;">
                                        <label>Product Name:</label>
                                        <input class ="input-field" type="text" name="name" placeholder="Enter a Name" required>
                                    </div>

                                    <!-- Image row -->
                                    <div class="form-row" style="display:grid; align-items:center;">
                                        <label>Product Image:</label>
                                        <input class ="input-field" type="file" name="image"required></input>
                                    </div>
                                    
                                    <!-- Description row -->
                                    <div class="form-row" style="display:grid; align-items:center;">
                                        <label>Product Description:</label>
                                        <textarea class ="input-field" type="text" name="description" placeholder="Enter a Description" required></textarea>
                                    </div>
                                    
                                    <!-- Price row -->
                                    <div class="form-row" style="display:grid; align-items:center;">
                                        <label>Price:</label>
                                        <input type="number" class ="input-field" name="price" min="0" value="0" placeholder="0.00" step="0.01" style="color: gray;" required>
                                    </div>

                                    <!-- Size row -->
                                    <div class="form-row" style="display:grid; align-items:center;">
                                        <label>Size:</label>
                                        <select style="color: gray;" id="size" class ="input-field" name="size" required>
                                        <option style="color: black;"  value="" disabled selected>Select a Size</option>
                                            <option style="color: black;" value="small">Small</option>
                                            <option style="color: black;" value="medium">Medium</option>
                                            <option style="color: black;" value="large">Large</option>
                                            <option style="color: black;" value="one-size">One-Size</option>
                                        </select>
                                    </div>
                                    
                                    <!-- Quantity row -->
                                    <div class="form-row" style="display:grid; align-items:center;">
                                        <label>Quantity:</label>
                                        <input type="number" class ="input-field"  name="stock" min="0" step="1" placeholder="0" required>                            
                                    </div>
                                    
                                    <!-- Category row -->
                                    <div class="form-row" style="display:grid; align-items:center;">
                                        <label for="category_id">Category:</label>
                                        <select id="category_id" class ="input-field" name="category_id" style="color: gray;" required>
                                        <option value="" disabled selected>Select a Category</option>
                                            @foreach($categories as $category)
                                                <option style="color: black;" value="{{ $category->id }}">{{ $category->name }}</option>
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
                            <div class="edit-products">
                                <h4>Edit Products</h4>
                                <form action="{{url('search')}}" method="get" style="width: 60%">
                                    @csrf
                                    <div class="form-row" style="margin-top: 3%;">
                                        <input class="input-field" type="text" name="search" value="{{ request('search') }}" placeholder="Search by Name or Category"/>
                                        <input type="hidden" name="tab" value="allProducts" />
                                        <button class="add-cat" type="submit">Search</button>
                                    </div>
                                </form>
                                <table class="table" style="position:relative; width:100%; text-align:center;">
                                    <thead>
                                        <tr style="background-color: var(--secondary-colour); color: var(--primary-colour);">
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Size</th>
                                            <th>Price</th>
                                            <th>Stock</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($allproducts as $product)
                                            <tr style="background-color: var(--light-bg); border-bottom: 1px solid var(--dark-bg);">
                                                <td>{{ $product->id }}</td>
                                                <td>{{ $product->name }}</td>
                                                <td style="font-size: 10px;">{{ $product->description }}</td>
                                                <td style="text-transform: capitalize;">{{ $product->size }}</td>
                                                <td>{{ $product->price }}</td>
                                                <td>{{ $product->stock }}</td>
                                                <td>
                                                    <a style="color: black;" href="{{ route('product.edit', $product->id) }}" class="edit-btn"><i class='bx bx-edit'></i></a>
                                                </td>
                                                <td>
                                                    <form action="{{ route('product.delete', $product->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('patch')
                                                        <button type="submit" class="delete-btn" onclick="return confirm('Are you sure you want to delete this category?')">
                                                            <i style="color: red;" class='bx bx-trash'></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <!-- Make sure colspan covers all columns in your table -->
                                                <td colspan="8" style="text-align: center; font-style: italic; padding:10px;">
                                                    No products found.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                @if (session('status') === 'product-edited')
                                    <p
                                        x-data="{ show: true }"
                                        x-show="show"
                                        x-transition
                                        x-init="setTimeout(() => show = false, 2000)"
                                        style="color: green; margin-top:20px; margin-left: 10px"
                                    >{{ __('Updated Succesfully') }}</p>
                                @endif

                                <!-- Use $allproducts for pagination, since that's the variable in your table -->
                                <div style="margin-top: 20px">
                                    {{ $allproducts->links('pagination::bootstrap-4') }}
                                </div>
                            </div>
                        </div>



                        <!-- Settings section -->
                        <div id="admin-settingsContent" class="admin-section" style="display: none;">
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
                                    <p>
                                        {{ __("Update your account's password.") }}
                                    </p>
                                    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
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
                </div>
            </div>
        </section>
    </main>
</body>