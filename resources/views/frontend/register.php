<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags, title, CSS and JS -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="icon" type="image/jpg" href="/team-project/public/assets/E-spresso_logo.jpg">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="/team-project/resources/css/style.css" >
    <script src="/team-project/resources/js/app.js"></script>
</head>

<body>
    <main>
        <!-- Header Section -->
        <section id="header">
            <nav>
                <div class="navbar-left">
                    <a href="/team-project/resources/views/frontend/index.php"><img src="/team-project/public/assets/E-spresso_logo.jpg"></a>
               </div>
                <div class="navbar-middle">
                    <a class="middle" href="/team-project/resources/views/frontend/index.php">Home</a>
                    <a class="middle" href="/team-project/resources/views/frontend/products.php">Products</a>
                    <a class="middle" href="/team-project/resources/views/frontend/about-us.php">About Us</a>
                    <a class="middle" href="/team-project/resources/views/frontend/blog.php">Blog</a>
                </div>
                <div class="navbar-right">
                    <a class="login" href="/mobile/">Login</a>
                    <p>|</p>
                    <a class="basket" href="/team-project/resources/views/frontend/basket.php"><i class='bx bx-basket'></i></a>
                </div>
            </nav>
        </section>

        <!-- Register form and php section -->
        <section class="main">
            <div class="form-box">
                <div class="form-inner">
                    <form id="register" class="input-group" action="register.php" method="post">
                        <input type="text" class="input-field" name="username" placeholder="Username" required>
                        <input type="password" class="input-field" name="password" placeholder="Password" required><br>
                        <input type="password" class="input-field" name="confirmpassword" placeholder="Confirm Password" required><br>
                        <button type="submit" class="submit-btn" value="Register">Register</button>
                        <input type="hidden" name="register" value="true"/>

                        <!-- PHP code to check if the registration form has been submitted -->
                        <?php 
                            $registerSubmitted = isset($_POST['register']);
                        ?>

                        <?php if ($registerSubmitted): ?>
                            <?php if (isset($_POST['register'])): // Form Validation: Check if the register form has been submitted?>
                                <?php
                                // Connect to the database
                                require_once('connectdb.php');
                                
                                // Prepare the form input
                                $username = isset($_POST['username']) ? $_POST['username'] : false;
                                $password = isset($_POST['password']) ? $_POST['password'] : false;
                                $confirmpassword = isset($_POST['confirmpassword']) ? $_POST['confirmpassword'] : false;

                                // Check if username already exists
                                $stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
                                $stmt->execute([$username]);
                                
                                // Form Validation: check all fields have bene inputed
                                if (!$username || !$password ||!$confirmpassword) {
                                    echo "Please fill in all the fields.";
                                }
                                // Authorisation and form validation: Check if the username already exists in the database
                                else if ($stmt->rowCount() > 0) {
                                    $confirmpassword = '';
                                    echo "<p style='color:red; transform:translateY(-10px);'>Username already exists </p>";
                                }
                                else {
                                    // Form Validation: Check if passwords do not match
                                    if ($password !== $confirmpassword) {
                                        echo "<p style='color:red; transform:translateY(-10px);'>Passwords do not match </p>";	
                                    }else{
                                        try {
                                            // Authentication and Authorisation: Hash the password and register the user by inserting their info into the users table
                                            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                                            
                                            // Register user by inserting the user info into the users table
                                            $stmt = $db->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
                                            $stmt->execute([$username, $hashedPassword]);
                                            
                                            // Check if the registration was successful before switching to login tab
                                            if ($stmt->rowCount() > 0) {
                                                echo "<script>window.onload = function() { setSuccess(); }</script>";
                                            } 
                                        } catch (PDOException $ex) {
                                            echo "Sorry, a database error occurred! <br>";
                                            echo "Error details: <em>" . $ex->getMessage() . "</em>";
                                        }
                                    }
                                }
                                ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </section>
        <!-- Footer Section -->
        <section id="footer">
            <footer class="top">
            <div class="logo-desc-soc">
                <div class="logo">
                    <a href="/team-project/resources/views/frontend/index.php"><img src="/team-project/public/assets/E-spresso_logo.jpg"></a>
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
                    <li><a href="/team-project/resources/views/frontend/index.php">Home</a></li>
                    <li><a href="/team-project/resources/views/frontend/products.php">Products</a></li>
                    <li><a href="/team-project/resources/views/frontend/about-us.php">About Us </a></li>
                    <li><a href="/team-project/resources/views/frontend/blog.php">Blog</a></li>
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