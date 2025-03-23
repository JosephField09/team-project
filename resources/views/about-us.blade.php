<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags, title, CSS and JS -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
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

        <!-- Image Block Sections -->
        <section id="ImageBlocks" style="padding: 10% 14.25% 5% 14.25%;">
            <!-- Our story Section -->
            <div class="ourstory">
                <div class="side-img out-of-view">
                    <img src= "{{ asset('assets/AdobeStock_835212991.jpeg') }}" alt="Coffee Beans Drying"></img>
                </div>
                <div class="aboutustext">
                    <h3 class="out-of-view">About Us</h3>
                    <h2 class="header out-of-view">Our Story, Your Coffee Experience</h2>
                    <p class="out-of-view">Our team is composed of passionate individuals who bring diverse skills and experiences to the table, allowing us to exceed in energising you for the day ahead. We believe in sustainability and ethical practices, ensuring that our operations not only benefit our customers but also contribute positively to the community and the environment.</p>
                    <div class="promise">
                        <img style="width: 10%;" class="first out-of-view" src= "{{ asset('assets/check-mark.png') }}"></img>
                        <h4 class="first out-of-view">Single-origin coffee beans</h4>
                    </div>
                    <div class="promise">
                        <img class="second out-of-view" src= "{{ asset('assets/check-mark.png') }}"></img>
                        <h4 class="second out-of-view">Expertly roasted for optimal flavour</h4>
                    </div>
                    <div class="promise">
                        <img class="third out-of-view" src= "{{ asset('assets/check-mark.png') }}"></img>
                        <h4 class="third out-of-view">Wide range of blends for every taste</h4>
                    </div>
                    <div class="promise"class="out-of-view">
                        <img class="fourth out-of-view" src= "{{ asset('assets/check-mark.png') }}"></img>
                        <h4 class="fourth out-of-view">High-quality, eco-friendly packaging</h4>
                    </div>
                </div>
            </div>

            <!-- Our history section-->
            <div id="our-history"> 
                <h2 class="header">Our History</h2>
                <div class="our-history-container">
                    <div class="timeline" style="--items: 3">
                        <ul class="out-of-view">
                            <!-- Timeline component 1 -->
                            <li class="out-of-view" style="--index: 1">
                                <h3 class="first out-of-view">2020</h3>
                                <h2 class="first out-of-view">From Quarantine to Caffeine</h2>
                                <p class="first out-of-view">
                                In the midst of lockdown, when stepping outside was nearly impossible where coffee cravings collided with closed shops and stay-at-home orders, 
                                E-spresso was born to keep coffee lovers fueled at home. 
                                </p>
                            </li>
                            <!-- Timeline component 2 -->
                            <li class="out-of-view" style="--index: 2">
                                <h3 class="second out-of-view">2023</h3>
                                <h2 class="second out-of-view">Brewing Success</h2>
                                <p class="second out-of-view">
                                As the world returned to pre-covid ways, our commitment to delivering fresh, ethically sourced coffee right to your door only grew stronger. 
                                What started as a lockdown necessity became a trusted favorite, leading to soaring demand, new product offerings, and expanded delivery networks.
                                </p>
                            </li>
                            <!-- Timeline component 3 -->
                            <li class="out-of-view" style="--index: 3">
                                <h3 class="third out-of-view">2025</h3>
                                <h2 class="third out-of-view">A Latte to Come</h2>
                                <p class="third out-of-view">
                                As we look to the future, we're expanding globally, 
                                deepening our commitment to sustainable sourcing, and embracing new brewing innovations. 
                                Driven by our passion for exceptional coffee, we aim to connect communities and fuel dreams—one cup at a time.
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>


            <!-- Our mission Section -->
            <div class="ourmission">
                <div class="aboutustext">
                        <h2 class="out-of-view">Our Mission</h2>
                        <p class="out-of-view">At E-Spresso, our mission is to redefine the coffee experience by blending tradition with modern craftsmanship. 
                            We are driven by a passion for excellence, creating a space where every cup tells a story. 
                            Our focus is not just on coffee but on the moments, the people, and the culture it inspires.
                            
                        </p>
                        <div class="missions">
                            <ul>
                                <li class="out-of-view"><p><span class="missionheader">Authenticity: </span>Honouring the rich heritage of coffee by preserving time-honored brewing techniques while embracing innovation</p></li>
                                <li class="out-of-view"><p><span class="missionheader">Well-being: </span>Creating a space that promotes relaxation, mindfulness, and enjoyment - one sip at a time</p></li>
                                <li class="out-of-view"><p><span class="missionheader">Cultural Appreciation: </span>Celebrating the global diversity of coffee, bringing flavours and traditions from around the world to our customers</p></li>
                                <li class="out-of-view"><p><span class="missionheader">Exceptional Service: </span> Beyond great coffee, we are committed to providing warmth, hospitality, and a personalized experience for every guest</p></li>
                            </ul>
                        </div>
                </div>
                <div class="side-img out-of-view">
                    <img style="margin-left: 10px; justify-self: center; display: block;" src="{{ asset('assets/AdobeStock_814649831.jpeg') }}"></img>
                </div>
            </div>
            
            <!-- Our vision Section -->
            <div class="ourvision">
                <div class="side-img out-of-view" >
                    <img src="{{ asset('assets/AdobeStock_859686298.jpeg') }}" class="bigimage"></img>
                </div>  
                <div class="our-vision-body"> 
                    <h2>Our Vision</h2>
                    <div class="our-vision-text">
                        <div class="connecting-people out-of-view">
                            <div class="i-container">
                                <i class='bx bxs-universal-access out-of-view' ></i>
                            </div>
                            <p><span class="missionheader">Connecting People</span></p>
                            <p>Aiming to be more than a coffee shop by creating meaningful relationships with our customers</p>
                        </div>
                        <div class="sustainability out-of-view">
                            <div class="i-container">
                                <i class='bx bxs-leaf out-of-view'></i>
                            </div>
                            <p><span class="missionheader">Sustainability</span></p>
                            <p>Prioritising eco-friendly practices to support a better planet.</p>
                        </div>
                        <div class="quality out-of-view">
                            <div class="i-container">
                                <i class='bx bxs-coffee-bean out-of-view'></i>
                            </div>
                            <p><span class="missionheader">Quality</span></p>
                            <p>Sourcing the best beans from around the world to serve the finest coffee with care and precision</p>
                        </div>
                        <div class="innovation out-of-view">
                            <div class="i-container">
                                <i class='bx bxs-brain out-of-view' ></i>
                            </div>
                            <p><span class="missionheader">Innovation</span></p>
                            <p>From classic blends to unique creations, we aim to continue evolving to offer unique experiences</p>
                        </div>
                    </div> 
                    <a class="contact-us out-of-view" href="{{ route('products') }}"><h4>Discover Our Products</h4></a>
                </div>
            </div>
        </section>

        <!-- Customer Testimonials Section -->
        <section id="customer-testimonials">
            <div class="testimonials-header">
                <h3>Testimonials</h3>
                <h2>What Our Customers Say About Us</h2>
            </div>
            <!-- Testimonials carousel -->
            <div class="testimonials-carousel">
                <div class="testimonials-track-wrapper">
                <div class="testimonials-track" id="testimonials-track">
                    @forelse($reviews as $review)
                    <!-- Testimonial -->
                    <div class="testimonial">
                    <div class="testimonial-content">
                        <!-- Testimonial users name, rating and generic picture -->
                        <div class="testimonial-user-info">
                            <div class="testimonial-pfp">
                                <i class='bx bx-user-circle'></i>
                            </div>
                            <div class="testimonial-details">
                                <h3 class="testimonial-name">{{$review->user->firstName}} {{$review->user->lastName}}</h3>
                                <h4 class="testimonial-rating">
                                {!! str_repeat("<i class='bx bxs-star' style='color:#fecc42'></i>", $review->rating) !!}
                                </h4>
                            </div>
                        </div>
                        <!-- Testimonial title and message -->
                        <div class="testimonial-main">
                            <h3 class="testimonial-title">{{$review->title}}</h3>
                            <p class="testimonial-message">{{$review->message}}</p>
                        </div>
                    </div>
                    </div>
                    @empty
                    <!-- If there are no testimonials -->
                    <div class="testimonial no-content">
                        <div class="testimonial-content no-content">
                            <h2>No testimonials available</h2>
                        </div>
                    </div>
                    @endforelse
                </div>
                </div>
                <script src="{{ asset('js/testimonials.js') }}"></script>
            </div>
            <!-- Dot navigation for testimonials -->
            <div class="testimonial-dots" id="testimonial-dots"></div>
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