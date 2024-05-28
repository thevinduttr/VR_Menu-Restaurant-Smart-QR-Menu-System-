<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>VR Menu</title>

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <!--<link href="lib/animate/animate.min.css" rel="stylesheet">-->
        <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
        <link href="lib/owlcarousel/owl.carousel.min.css" rel="stylesheet">

        <!-- bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <!-- bootstrap -->

        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet">
    </head>

    <body>

        <!-- Navbar start -->
        <div class="container-fluid nav-bar">
            <div class="container">
                <nav class="navbar navbar-light navbar-expand-lg py-4">
                    <a href="index.html" class="navbar-brand">
                        <img src="img/logo.png" style="width: 25%;">
                    </a>
                    <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                        <span class="fa fa-bars text-primary"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <div class="navbar-nav mx-auto">
                            <a href="index.html" class="nav-item nav-link active">Home</a>
                            <a href="#aboutus" class="nav-item nav-link">About</a>
                            <a href="#features" class="nav-item nav-link">Features</a>
                            <a href="#pricing" class="nav-item nav-link">Pricing</a>
                            <a href="#contact" class="nav-item nav-link">Contact</a>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="registration_page.php" class="btn btn-danger me-md-2" type="button">Register</a>
                            <a href="login_page.php" class="btn btn-primary" type="button">Sign In</a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!-- Navbar End -->


        <!-- Modal Search Start -->
        <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex align-items-center">
                        <div class="input-group w-75 mx-auto d-flex">
                            <input type="search" class="form-control bg-transparent p-3" placeholder="keywords" aria-describedby="search-icon-1">
                            <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Search End -->


        <!-- Hero Start -->
        <div class="container-fluid py-6 my-6 mt-0">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-7 col-md-12">
                        <p class="display-1 mb-4 animated bounceInDown">Create <span class="text-success">VR</span> Menu, Say Good Bye to Old Traditional Menu Card</p>
                    </div>
                    <div class="col-lg-5 col-md-12">
                        <img src="img/first.png" class="img-fluid rounded animated zoomIn" alt="">
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero End -->


        <!-- About -->
        <div class="container-fluid py-6" id="aboutus">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-5 wow bounceInUp" data-wow-delay="0.1s">
                        <img src="img/about.png" class="img-fluid rounded" alt="">
                    </div>
                    <div class="col-lg-7 wow bounceInUp" data-wow-delay="0.3s">
                        <p class="display-5 mb-4">Make Your Business Smart With Our VR Menu</p>
                        <p class="mb-4">With the Smart Menu Administration Application, you have the power to easily create and manage your food and beverage menus. There is no limit to the number of menus, categories and items you can handle. Besides, you can give your menus a unique touch by customizing them with different themes, colors and designs.Unlike some other restaurant QR codes that only display a PDF menu, our QR Code Digital Menu allows customers to access your restaurant's menu and place orders through an online ordering system.
                            <br><br>
                            This is a perfect solution for restaurants such as coffee shops, food trucks, bakeries, and restaurants in food courts.</p>
                        <div class="row g-4 text-dark mb-5">
                            <div class="col-sm-6">
                                <i class="fas fa-share text-primary me-2"></i>Eco Friendly
                            </div>
                            <div class="col-sm-6">
                                <i class="fas fa-share text-primary me-2"></i>24/7 Customer Support
                            </div>
                            <div class="col-sm-6">
                                <i class="fas fa-share text-primary me-2"></i>Easy Customization Options
                            </div>
                            <div class="col-sm-6">
                                <i class="fas fa-share text-primary me-2"></i>Cloud-based centralized application
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->


        <!-- Fact Start-->
        <div class="container-fluid faqt py-6">
            <div class="container">
                <div class="row g-4 align-items-center">
                    <div class="col-lg-7">
                       <div class="row g-4">
                            <div class="col-sm-4 wow bounceInUp" data-wow-delay="0.3s">
                                <div class="faqt-item bg-primary rounded p-4 text-center">
                                    <i class="fas fa-users fa-4x mb-4 text-white"></i>
                                    <p class="display-4 fw-bold" data-toggle="counter-up">589</p>
                                    <p class="text-dark text-uppercase fw-bold mb-0">QR Users</p>
                                </div>
                            </div>
                            <div class="col-sm-4 wow bounceInUp" data-wow-delay="0.5s">
                                <div class="faqt-item bg-primary rounded p-4 text-center">
                                    <i class="fas fa-users-cog fa-4x mb-4 text-white"></i>
                                    <p class="display-4 fw-bold" data-toggle="counter-up">57</p>
                                    <p class="text-dark text-uppercase fw-bold mb-0">Restaurants</p>
                                </div>
                            </div>
                            <div class="col-sm-4 wow bounceInUp" data-wow-delay="0.7s">
                                <div class="faqt-item bg-primary rounded p-4 text-center">
                                    <i class="fas fa-check fa-4x mb-4 text-white"></i>
                                    <p class="display-4 fw-bold" data-toggle="counter-up">16</p>
                                    <p class="text-dark text-uppercase fw-bold mb-0">Admin Accounts</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 wow bounceInUp" data-wow-delay="0.1s">
                        <div class="video">
                            <button type="button" class="btn btn-play" data-bs-toggle="modal" data-src="https://youtu.be/nUb05KdCZ2c?si=opFdslWEKiuZZ0xU" data-bs-target="#videoModal">
                                <span></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Video -->
        <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Youtube Video</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- 16:9 aspect ratio -->
                        <div class="ratio ratio-16x9">
                            <iframe class="embed-responsive-item" src="" id="video" allowfullscreen allowscriptaccess="always"
                                allow="autoplay"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fact End -->


        <!-- Service Start -->
        <div class="container-fluid service py-6" id="features">
            <div class="container">
                <div class="text-center wow bounceInUp" data-wow-delay="0.1s">
                    <small class="d-inline-block fw-bold text-dark text-uppercase bg-light border border-primary rounded-pill px-4 py-1 mb-3">Features</small>
                    <p class="display-5 mb-5">What We Offer</p>
                </div>
                <div class="row g-4">
                    <div class="col-lg-3 col-md-6 col-sm-12 wow bounceInUp" data-wow-delay="0.1s">
                        <div class="bg-light rounded service-item">
                            <div class="service-content d-flex align-items-center justify-content-center p-4">
                                <div class="service-content-icon text-center">
                                    <i class="fas fa-id-card fa-7x text-primary mb-4"></i>
                                    <h4 class="mb-3">Create Admin Panel</h4>
                                    <p class="mb-4">Make your admin Account to handle your menu easly</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 wow bounceInUp" data-wow-delay="0.3s">
                        <div class="bg-light rounded service-item">
                            <div class="service-content d-flex align-items-center justify-content-center p-4">
                                <div class="service-content-icon text-center">
                                    <i class="fas fa-qrcode fa-7x text-primary mb-4"></i>
                                    <h4 class="mb-3">Get Unique QR Code</h4>
                                    <p class="mb-4">With a simple scan of a QR code, your customers can access your restaurant's food menu</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 wow bounceInUp" data-wow-delay="0.5s">
                        <div class="bg-light rounded service-item">
                            <div class="service-content d-flex align-items-center justify-content-center p-4">
                                <div class="service-content-icon text-center">
                                    <i class="fas fa-share-alt fa-7x text-primary mb-4"></i>
                                    <h4 class="mb-3">Share anywhere</h4>
                                    <p class="mb-4">Share on social media platforms, in front of your restaurant or wherever you want</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 wow bounceInUp" data-wow-delay="0.7s">
                        <div class="bg-light rounded service-item">
                            <div class="service-content d-flex align-items-center justify-content-center p-4">
                                <div class="service-content-icon text-center">
                                    <i class="fas fa-user fa-7x text-primary mb-4"></i>
                                    <h4 class="mb-3">Customer Convenience</h4>
                                    <p class="mb-4">Contrary to popular belief, ipsum is not simply random.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 wow bounceInUp" data-wow-delay="0.1s">
                        <div class="bg-light rounded service-item">
                            <div class="service-content d-flex align-items-center justify-content-center p-4">
                                <div class="service-content-icon text-center">
                                    <i class="fas fa-leaf fa-7x text-primary mb-4"></i>
                                    <h4 class="mb-3">Eco-Friendly</h4>
                                    <p class="mb-4">A paper less method and it will reduce the cost of printing materials.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 wow bounceInUp" data-wow-delay="0.3s">
                        <div class="bg-light rounded service-item">
                            <div class="service-content d-flex align-items-center justify-content-center p-4">
                                <div class="service-content-icon text-center">
                                    <i class="fas fa-utensils fa-7x text-primary mb-4"></i>
                                    <h4 class="mb-3">Smart Experience</h4>
                                    <p class="mb-4">Give customers a great smart experience ordering their food without using old paper menus</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 wow bounceInUp" data-wow-delay="0.5s">
                        <div class="bg-light rounded service-item">
                            <div class="service-content d-flex align-items-center justify-content-center p-4">
                                <div class="service-content-icon text-center">
                                    <i class="fas fa-mobile fa-7x text-primary mb-4"></i>
                                    <h4 class="mb-3">Support to Mobile</h4>
                                    <p class="mb-4">Easy to handle menu admin panel using your mobile phone</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Service End -->


        <!-- Pricing Start -->
        <div class="container-fluid team py-6" id="pricing">
            <div class="container">
                <div class="text-center wow bounceInUp" data-wow-delay="0.1s">
                    <small class="d-inline-block fw-bold text-dark text-uppercase bg-light border border-primary rounded-pill px-4 py-1 mb-3">Pricing</small>
                    <p class="display-5 mb-5">Pricing and Packages</p>
                </div>
                <div class="row g-4">
                    <div class="col-lg-3 col-md-6 wow bounceInUp" data-wow-delay="0.7s">
                        <div class="team-item rounded">
                            <div class="team-content text-center py-3 bg-dark rounded-bottom">
                                <p class="text-success">1 Month</p>
                                <h2 class="text-danger">FREE</h2>
                                <p class="text-white mt-5 mb-0">
                                    10 QR Stickers <br><br> 
                                    Initial data upload <br><br>
                                    24/7 Support<br><br>
                                    Unlimited content<br><br></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 wow bounceInUp" data-wow-delay="0.7s">
                        <div class="team-item rounded">
                            <div class="team-content text-center py-3 bg-dark rounded-bottom">
                                <p class="text-success">3 Months</p>
                                <h2 class="text-danger">FREE </h2>
                                <p class="text-white mt-5 mb-0">
                                    20 QR Stickers <br><br> 
                                    Initial data upload <br><br>
                                    24/7 Support<br><br>
                                    Unlimited content<br><br></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 wow bounceInUp" data-wow-delay="0.7s">
                        <div class="team-item rounded">
                            <div class="team-content text-center py-3 bg-dark rounded-bottom">
                                <p class="text-success">6 Months</h4>
                                <h2 class="text-danger">FREE</h5>
                                <p class="text-white mt-5 mb-0">
                                    30 QR Stickers <br><br> 
                                    Initial data upload <br><br>
                                    24/7 Support<br><br>
                                    Unlimited content<br><br></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 wow bounceInUp" data-wow-delay="0.7s">
                        <div class="team-item rounded">
                            <div class="team-content text-center py-3 bg-dark rounded-bottom">
                                <p class="text-success">12 Months</h4>
                                <h2 class="text-danger">FREE</h5>
                                <p class="text-white mt-5 mb-0">
                                    Unlimited QR Stickers <br><br> 
                                    Initial data upload <br><br>
                                    24/7 Support<br><br>
                                    Unlimited content<br><br></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
        <!-- Pricing End -->


        <!-- Contact Us Start -->
        <div class="container-fluid contact py-6 wow bounceInUp" data-wow-delay="0.1s" id="contact">
            <div class="container">
                <div class="row g-0">
                    <div class="col-1">
                        <img src="img/background-site.jpg" class="img-fluid h-100 w-100 rounded-start" style="object-fit: cover; opacity: 0.7;" alt="">
                    </div>
                    <div class="col-10">
                        <div class="border-bottom border-top border-primary bg-light py-5 px-4">
                            <div class="text-center">
                                <small class="d-inline-block fw-bold text-dark text-uppercase bg-light border border-primary rounded-pill px-4 py-1 mb-3">Contact Us</small>
                                <h4 class="display-5 mb-5">Do you want any other Services or have any question ?<br>Please contact us</h4>
                            </div>
                            <div class="row g-4 form">
                                <div class="col-12 text-center">
                                    <h1>vrmenu@gmail.com</h1>
                                    <h1>072 369 7777</h1>
                                    <br>
                                    <br>
                                    <a href="registration_page.php" class="btn btn-danger px-5 py-3 rounded-pill mb-3" type="button">Register Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-1">
                        <img src="img/background-site.jpg" class="img-fluid h-100 w-100 rounded-end" style="object-fit: cover; opacity: 0.7;" alt="">
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact Us End -->

        <!-- Testimonial Start -->
        <div class="container-fluid py-6" id="reviews">
            <div class="container">
                <div class="text-center wow bounceInUp" data-wow-delay="0.1s">
                    <small class="d-inline-block fw-bold text-dark text-uppercase bg-light border border-primary rounded-pill px-4 py-1 mb-3">Testimonial</small>
                    <p class="display-5 mb-5">What Our Customers says!</p>
                </div>
                <div class="owl-carousel owl-theme testimonial-carousel testimonial-carousel-1 mb-4 wow bounceInUp" data-wow-delay="0.1s">
                    <div class="testimonial-item rounded bg-light">
                        <div class="d-flex mb-3">
                            <div class="position-absolute" style="top: 15px; right: 20px;">
                                <i class="fa fa-quote-right fa-2x"></i>
                            </div>
                            <div class="ps-3 my-auto">
                                <h4 class="mb-0">Sajeev Rajendran</h4>
                                <p class="m-0">Restaurant owner</p>
                            </div>
                        </div>
                        <div class="testimonial-content">
                            <div class="d-flex">
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                            </div>
                            <p class="fs-5 m-0 pt-3">Great cutomer support from beginning to end of the process. The team are really informed and go the extra mile at every stage. I would recommend this service unreservedly.</p>
                        </div>
                    </div>
                    <div class="testimonial-item rounded bg-light">
                        <div class="d-flex mb-3">
                            <div class="position-absolute" style="top: 15px; right: 20px;">
                                <i class="fa fa-quote-right fa-2x"></i>
                            </div>
                            <div class="ps-3 my-auto">
                                <h4 class="mb-0">Ravin Kumarasiri</h4>
                                <p class="m-0">Manager</p>
                            </div>
                        </div>
                        <div class="testimonial-content">
                            <div class="d-flex">
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                            </div>
                            <p class="fs-5 m-0 pt-3">I spoke with the vr menu team. They are very helpful and answered all my questions regarding my restaurant menu. They believed they had my best interest at heart and Give the best service for our restaurant.</p>
                        </div>
                    </div>
                    <div class="testimonial-item rounded bg-light">
                        <div class="d-flex mb-3">
                            <div class="position-absolute" style="top: 15px; right: 20px;">
                                <i class="fa fa-quote-right fa-2x"></i>
                            </div>
                            <div class="ps-3 my-auto">
                                <h4 class="mb-0">Munzir Akmeem</h4>
                                <p class="m-0">Restaurant Owner</p>
                            </div>
                        </div>
                        <div class="testimonial-content">
                            <div class="d-flex">
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                            </div>
                            <p class="fs-5 m-0 pt-3">Great Service and Great Experience</p>
                        </div>
                    </div>
                    <div class="testimonial-item rounded bg-light">
                        <div class="d-flex mb-3">
                            <div class="position-absolute" style="top: 15px; right: 20px;">
                                <i class="fa fa-quote-right fa-2x"></i>
                            </div>
                            <div class="ps-3 my-auto">
                                <h4 class="mb-0">Nilishani Siriwardhana</h4>
                                <p class="m-0">Restaurant Owner</p>
                            </div>
                        </div>
                        <div class="testimonial-content">
                            <div class="d-flex">
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                            </div>
                            <p class="fs-5 m-0 pt-3">Thank you for your service and it gone our hotel to next level</p>
                        </div>
                    </div>
                    <div class="testimonial-item rounded bg-light">
                        <div class="d-flex mb-3">
                            <div class="position-absolute" style="top: 15px; right: 20px;">
                                <i class="fa fa-quote-right fa-2x"></i>
                            </div>
                            <div class="ps-3 my-auto">
                                <h4 class="mb-0">Rajika Abesiriwardhana</h4>
                                <p class="m-0">Manager</p>
                            </div>
                        </div>
                        <div class="testimonial-content">
                            <div class="d-flex">
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                            </div>
                            <p class="fs-5 m-0 pt-3">Best Improvemnt for our restaurant</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Testimonial End -->

        <!-- Footer Start -->
        <div class="container-fluid footer py-6 my-6 mb-0 bg-light wow bounceInUp" data-wow-delay="0.1s">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="footer-item">
                            <img src="img/logo.png" style="width: 95%;">
                            <div class="footer-icon d-flex mb-3">
                                <a class="btn btn-primary btn-sm-square me-2 rounded-circle" href=""><i class="fab fa-twitter"></i></a>
                                <a href="#" class="btn btn-primary btn-sm-square me-2 rounded-circle"><i class="fab fa-instagram"></i></a>
                                <a href="#" class="btn btn-primary btn-sm-square rounded-circle"><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="footer-item">
                            <h4 class="mb-4 text-start">Special Links</h4>
                            <div class="d-flex flex-column align-items-start">
                                <a class="text-body mb-3" href="registration_page.php"><i class="fa fa-check text-primary me-2"></i>Register</a>
                                <a class="text-body mb-3" href="login_page.php"><i class="fa fa-check text-primary me-2"></i>Login</a>
                                <a class="text-body mb-3" href=""><i class="fa fa-check text-primary me-2"></i>About us</a>
                                <a class="text-body mb-3" href=""><i class="fa fa-check text-primary me-2"></i>Services</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="footer-item">
                            <h4 class="mb-4 text-start">Contact Us</h4>
                            <div class="d-flex flex-column align-items-start">
                                <p><i class="fa fa-map-marker-alt text-primary me-2"></i> 123 Street, Colombo, Sri Lanka</p>
                                <p><i class="fa fa-phone-alt text-primary me-2"></i> (+94) 72 369 7777</p>
                                <p><i class="fas fa-envelope text-primary me-2"></i> info@vrmenu.com</p>
                                <p><i class="fa fa-clock text-primary me-2"></i> 24/7 Hours Service</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->


        <!-- Copyright Start -->
        <div class="container-fluid copyright bg-dark py-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        <span class="text-light"><a href="https://nexcodia.com/"><i class="fas fa-copyright text-light me-2"></i>NextCodia Software Solution</a>, All right reserved.</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Copyright End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-md-square btn-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>   

        
        <!-- JavaScript Libraries -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="lib/wow/wow.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/waypoints/waypoints.min.js"></script>
        <script src="lib/counterup/counterup.min.js"></script>
        <script src="lib/lightbox/js/lightbox.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

        <!-- Template Javascript -->
        <script src="js/main.js"></script>
    </body>
</html>