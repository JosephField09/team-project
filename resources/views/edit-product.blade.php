<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags, title, CSS and JS -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/favicon.png') }}">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/responsive.js') }}"></script>
    <style>
        #header{
            position: relative;
        }
    </style>
</head>


<body>
    <main>
        <!-- Header Section -->
        @include('layouts.navbar')

        <!-- Edit user section-->
        <section id="edit-user">
            <div id="edit-user-container">
                <h1>Edit Product</h1>

                @if (session('success'))
                    <p style="color: green;">{{ session('success') }}</p>
                @endif

                @if ($errors->any())
                    <ul style="color: red;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <label for="name">Name</label>
                    <input type="text" class="input-field" name="name" value="{{ old('name', $product->name) }}" required>
                    <div class="form-grid" style="gap: 5%;">
                        <div class="form-grid" style="grid-template-columns: 30% 70%; gap: 0;">
                            {{-- Display the currently stored image, if it exists --}}
                            @if($product->image)
                                <label for="description">Current Image</label>
                                <img src="{{ asset('assets/' . $product->image) }}" alt="Current Image" style="max-width: 80px; justify-self:center">
                            @endif
                            
                            <label for="image">Upload Image</label>
                            <input id="file-prompt" class ="input-field" type="file" name="image" value="{{ old('image', $product->image) }}">

                        </div>
                        <div >
                            <label for="description">Description</label>
                            <textarea 
                                style="height:73%;" 
                                class="input-field" 
                                name="description" 
                                required
                            >{{ old('description', $product->description) }}</textarea>
                        </div>
                    </div>

                    

                    <div class="form-grid">
                        <div class="form-row">
                            <label for="price">Price</label>
                            <input type="number" class="input-field" name="price" min="0" step="0.01" value="{{ old('price', $product->price) }}">
                        </div>
                        <div class="form-row">
                            <label for="size">Size:</label>
                            <select id="size" class="input-field" name="size" required>
                                <option value="" disabled>Select a Size</option>
                                <option value="small"    {{ old('size', $product->size) === 'small'    ? 'selected' : '' }}>Small</option>
                                <option value="medium"   {{ old('size', $product->size) === 'medium'   ? 'selected' : '' }}>Medium</option>
                                <option value="large"    {{ old('size', $product->size) === 'large'    ? 'selected' : '' }}>Large</option>
                                <option value="one-size" {{ old('size', $product->size) === 'one-size' ? 'selected' : '' }}>One-Size</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-grid">
                        <div class="form-row">
                            <label for="stock">Stock</label>
                            <input type="number" class="input-field" name="stock" min="0" step="1" value="{{ old('stock', $product->stock) }}" required>
                        </div>
                        <div class="form-row">
                            <label for="category_id">Category</label>
                            <select class="input-field" name="category_id" id="category_id" required>
                                <option value="" disabled selected>Select a Category</option>
                                @foreach($categories as $category)
                                    <option 
                                        value="{{ $category->id }}" 
                                        {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}
                                    >
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

    

                    <button class="add-cat" style="display: grid; justify-self: center;" type="submit">Update Product</button>
                    <p style="text-align: center;color:var(--text-colour)">Made a mistake? <a href="{{ route('admin.dashboard', ['tab' => 'allProducts']) }}" style="display: inline-block; margin-top: 10px; color: var(--secondary-colour); text-decoration: none;">Cancel</a></p>
                </form>
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
</body>
