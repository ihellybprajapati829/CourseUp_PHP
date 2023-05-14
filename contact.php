<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Online Learning & Course Management System</title>
    <link rel="shortcut icon" href="./img/favicon.png" type="image/x-icon">

    <!-- Vendor CSS -->
    <link href="./assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="./assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="./assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="./assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="./css/home.css" rel="stylesheet">
</head>

<body>

    <!-- Header -->
    <header id="header" class="header-scrolled fixed-top d-flex align-items-center">
        <div class="container d-flex justify-content-between align-items-center">

            <div class="logo">
                <h1 class="text-light"><img src="./img/White_Logo.png" alt="" srcset=""></h1>
            </div>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a href="./index.php">Home</a></li>
                    <li><a href="./about.php">About Us</a></li>
                    <li><a href="./courses.php">Courses</a></li>
                    <li><a href="./contact.php">Contact</a></li>
                    <li><a href="./login.php">Login / SignUp</a></li>
                </ul>
                <i class='bx bx-menu mobile-nav-toggle'></i>
            </nav>

        </div>
    </header><!-- End Header -->


    <br>
    <br>
    <!-- Contact Section -->
    <section class="contact" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="500">
        <div class="container">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <h2>Contact Us</h2>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="info-box" style="height:180px">
                                <i class="bx bx-map"></i>
                                <h3>Address</h3>
                                <p>Ahmedabad, Gujarat, India</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-box" style="height:180px">
                                <i class="bx bx-envelope"></i>
                                <h3>Email Us</h3>
                                <p>courseup@gmail.com</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-box" style="height:180px">
                                <i class="bx bx-phone-call"></i>
                                <h3>Call Us</h3>
                                <p>+91 9898989898</p>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-lg-6">
                    <form role="form" class="email-form">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                            </div>
                            <div class="col-md-6 form-group mt-3 mt-md-0">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
                        </div>
                        <div class="form-group mt-3">
                            <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
                        </div>
                        <br>
                        <div class="text-center"><button type="submit">Send Message</button></div>
                    </form>
                </div>

            </div>

        </div>
    </section><!-- End Contact Section -->

    <!-- Footer -->
    <footer id="footer" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="500">

        <div class="footer-top">
            <div class="container">
                <div class="row">

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Useful Links</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Our Services</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-contact">
                        <h4>Contact Us</h4>
                        <p>
                            <strong>Phone:</strong> +91 9898989898<br>
                            <strong>Email:</strong> courseup@gmail.com<br>
                        </p>

                    </div>

                    <div class="col-lg-3 col-md-6 footer-info">
                        <h3>Social Media</h3>
                        <div class="social-links mt-3">
                            <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                            <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                            <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                            <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong><span>CourseUp</span></strong>. All Rights Reserved.
            </div>
        </div>
    </footer><!-- End Footer -->

    <!-- Vendor JS-->
    <script src="./assets/vendor/aos/aos.js"></script>

    <!-- Custom JS -->
    <script src="./js/main.js"></script>
</body>

</html>