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
    <!-- Course Section -->
    <section class="contact" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="500">
        <div class="container">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <h2>Courses</h2>
                </div>
            </div>
            <br>
            <div class="container">
                <?php
                    include './config.php';

                    $query = "SELECT * FROM `course`";
                    $query_run = mysqli_query($conn,$query);

                    if(mysqli_num_rows($query_run) > 0)
                    {
                    ?>
                        <div class="row">
                        <?php
                        while($row = mysqli_fetch_assoc($query_run))
                        {?>
                            <div class="col-md-3">
                            <div class="info-box">
                                <img src="<?php echo $row['image'] ?>" alt="" srcset="">
                                <h6><?php echo $row['name'] ?></h6>
                                <a href="./single_course.php?id=<?php echo $row['id']?>" style="font-size: 16px;">View</a>
                            </div>
                            </div>
                            <?php              
                        }?>
                        </div>
                        <?php 
                    } ?>
            </div>

        </div>
    </section><!-- End Course Section -->

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