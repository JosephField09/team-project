<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags, title, CSS, and JS -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
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

        <!-- Contact Us Section -->
        <div id="contact-us-container">
            <div id="contact-start">
                <h1 class="out-of-view">Contact Us</h1>
                <p id="contact-desc" class="out-of-view">
                    <strong>Got a question, comment, or just want to chat about all things coffee? We'd love to hear from you! Reach out anytime, and our friendly team will get back to you as soon as possible</strong>
                </p>
                <div id="contact-cards">
                    <div class="contact-card out-of-view">
                        <i class='bx bx-envelope'></i>
                        <h2>Email Support</h2>
                        <p class="explain">Have a question about our coffee selections or need assistance with your order? Send us an email, and our dedicated team will respond promptly</p>
                        <p class="detail">espressoadmin@gmail.com</p>
                    </div>
                    <div class="contact-card out-of-view">
                        <i class='bx bx-phone'></i>
                        <h2>Call Us</h2>
                        <p class="explain">Prefer to chat? Give us a call and we'll happily guide you through our latest brews or answer any questions</p>
                        <p class="detail">+44 1234 567890</p>
                    </div>
                    <div class="contact-card out-of-view">
                        <i class='bx bx-buildings'></i>
                        <h2>Visit our Office</h2>
                        <p class="explain">We welcome in-person visits for a direct conversation. Our team will be pleased to assist you and provide an inside look at our offerings</p>
                        <p class="detail">Aston University, Aston St, Birmingham B4 7ET</p>
                    </div>
                </div>
            </div>
            <div id="contact-middle">
                <div class="contact-us-form">
                    <h1 id="contact-us-heading">Get in Touch</h1>
                        <h3>Ready to get started?</h3>
                        <p> Whether you have questions, need support or want to learn more about our services, our team is here to help. 
                            Fill out this form and a member of our team will contact you shortly</p>
                    <form id="contact-us">
                        <div class="first-and-last-name">
                            <div class="first-name">
                                <label for="fName">First Name</label>
                                <input id ="fName "type ="text" name="fName" placeholder="Enter Your First Name" class="input-field" require/>
                            </div>
                            <div class="last-name">
                                <label for="lName">Last Name</label>
                                <input id ="lName "type ="text" name="lName" placeholder="Enter Your Last Name" class="input-field" require/>
                            </div>
                        </div>
                        <div class="email-and-phone">
                            <div class="email">
                                <label for="email">Email</label>
                                <input id="email" type="email"  name="email" placeholder="Enter your Email" class="input-field" require>
                            </div>
                            <div class="phone">
                                <label for="phone">Phone</label>
                                <input id="phone" type="text" id="phone" name="phone" placeholder="Enter Your Phone number" class="input-field" require/>
                            </div>
                        </div>
                        <div class="message-to-send">
                            <label for="message">Message</label>
                            <textarea rows="5" cols="50" id="uMessage" name="uMessage" form="contactusform" class="input-field"
                            placeholder="Write Message Here..." require></textarea>
                        </div>
                        <p class="error-message" id="formError"></p>
                        <div class ="submit-form">
                            <button type="submit" id="submit-form-btn">Submit Now</button>
                        </div>
                    </form>
                    <script src="{{ asset('js/contact-us.js') }}" ></script>
                </div>
            </div>
            <div id="faq">
                <h2>FAQ</h2>
                <div class="faq-desc-qa">
                    <div>
                        <p>
                            Got a question on your mind? We've compiled answers to our most
                            common inquiries - from coffee origins and roasting methods to shipping and returns. If you don't find what you're looking for, feel free to reach out - we're always here to help!
                        </p>
                        <div class="form-row">
                            <input type="text" id="faq-email" placeholder="Enter your email address">
                            <button type="submit" id="submit-faq-btn">Ask a question</button>
                        </div>  
                        <script>
                            document.getElementById('submit-faq-btn').addEventListener('click', function() {
                                // Get the input field value
                                const userText = document.getElementById('faq-email').value.trim();
                                
                                const mailtoLink = `mailto:espressoadmin@gmail.com?subject=FAQ Question&body=${encodeURIComponent(userText)}`;

                                // Open the user's email app
                                window.location.href = mailtoLink;
                            });
                        </script>                      
                    </div>
                    <div id="qa">
                        <ul id="accordion">
                            <li>
                                <input type="radio" name="accordion" id="first">
                                <label for="first">How should I store my coffee beans?<span><i class='bx bx-chevron-down'></i></span></label>
                                <div class="qa-content">
                                    <p>Store them in an airtight container in a cool, dark place. Avoid direct sunlight, heat, and humidity, as these can degrade the quality of the beans. 
                                        We recommend keeping it in a pantry or cupboard to prevent exposure to moisture and unwanted odours. For the best taste, grind your beans just before brewing and use them within a few weeks of opening.</p>
                                </div>
                            </li>
                            <li>
                                <input type="radio" name="accordion" id="second" >
                                <label for="second">What are your shipping and delivery options?<span><i class='bx bx-chevron-down'></i></span></label>
                                <div class="qa-content">
                                    <p>We offer free shipping on all orders, making it easy to get your favorite coffee delivered straight to your door. Our standard delivery time is approximately three business days, so you can expect your order to arrive promptly. 
                                        If you have any special shipping requests, feel free to reach out to our team, and we'll do our best to accommodate them.</p>
                                </div>
                            </li>
                            <li>
                                <input type="radio" name="accordion" id="third" >
                                <label for="third">Do you offer a way to recurr orders?<span><i class='bx bx-chevron-down'></i></span></label>
                                <div class="qa-content">
                                    <p>Yes! We offer a subscription service that allows you to receive your favorite coffee on a recurring basis without the hassle of reordering. 
                                        You can customise your subscription based on how often you'd like to receive your coffee and
                                        you can manage, pause, or adjust your subscription at any time through your account.</p>
                                </div>
                            </li>
                            <li>
                                <input type="radio" name="accordion" id="fourth" >
                                <label for="fourth">What is your return policy?<span><i class='bx bx-chevron-down'></i></span></label>
                                <div class="qa-content">
                                    <p>We want you to be completely satisfied with your order. If for any reason you're not happy with your purchase, you can return the entire order for a full refund. 
                                        Note: We are unable to accept returns for individual products within an order — only full orders can be returned.</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div>
                </div>
            </div>
        </div>

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
</html>
