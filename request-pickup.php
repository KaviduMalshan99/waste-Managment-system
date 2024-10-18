<!DOCTYPE html>
<html lang="en">

<head>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> Request a Pickup </title>
    <!-- favicons Icons -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/favicons/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicons/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicons/favicon-16x16.png" />
    <link rel="manifest" href="assets/images/favicons/site.webmanifest" />
    <meta name="description" content="Wostin HTML Template For Business" />

    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&display=swap"
        rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@400;700&display=swap" rel="stylesheet">



    <link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/vendors/animate/animate.min.css" />
    <link rel="stylesheet" href="assets/vendors/animate/custom-animate.css" />
    <link rel="stylesheet" href="assets/vendors/fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="assets/vendors/jarallax/jarallax.css" />
    <link rel="stylesheet" href="assets/vendors/jquery-magnific-popup/jquery.magnific-popup.css" />
    <link rel="stylesheet" href="assets/vendors/nouislider/nouislider.min.css" />
    <link rel="stylesheet" href="assets/vendors/nouislider/nouislider.pips.css" />
    <link rel="stylesheet" href="assets/vendors/odometer/odometer.min.css" />
    <link rel="stylesheet" href="assets/vendors/swiper/swiper.min.css" />
    <link rel="stylesheet" href="assets/vendors/wostin-icons/style.css">
    <link rel="stylesheet" href="assets/vendors/tiny-slider/tiny-slider.min.css" />
    <link rel="stylesheet" href="assets/vendors/reey-font/stylesheet.css" />
    <link rel="stylesheet" href="assets/vendors/owl-carousel/owl.carousel.min.css" />
    <link rel="stylesheet" href="assets/vendors/owl-carousel/owl.theme.default.min.css" />
    <link rel="stylesheet" href="assets/vendors/bxslider/jquery.bxslider.css" />
    <link rel="stylesheet" href="assets/vendors/bootstrap-select/css/bootstrap-select.min.css" />
    <link rel="stylesheet" href="assets/vendors/vegas/vegas.min.css" />
    <link rel="stylesheet" href="assets/vendors/jquery-ui/jquery-ui.css" />
    <link rel="stylesheet" href="assets/vendors/timepicker/timePicker.css" />

    <!-- template styles -->
    <link rel="stylesheet" href="assets/css/wostin.css" />
    <link rel="stylesheet" href="assets/css/wostin-responsive.css" />
    <style>
        .custom-time-picker {
            width: 100%;

            padding: 17px 15px;
            border: 1px solid #ddd;
            background-color: #f5f0e9;
            color: #333;
            font-size: 16px;
            font-family: 'DM Sans', sans-serif;
            border:none;
            border-radius: 0px;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }

        .custom-time-picker::-webkit-calendar-picker-indicator {
            background-color: transparent;
            padding: 5px;
            cursor: pointer;
        }

        .custom-time-picker:focus {
            outline: none;
            border-color: #ff3c00;
        }
    </style>
</head>

<body>
    <div class="preloader">
        <img class="preloader__image" width="60" src="assets/images/loader.png" alt="" />
    </div>
    <!-- /.preloader -->
    <div class="page-wrapper">
        <header class="main-header clearfix">
            <div class="main-header__inner clearfix">
                <div class="main-header__logo">
                    <a href="index.html"><img src="assets/images/resources/logo-1.png" alt=""></a>
                </div>
                <div class="main-menu__menu-box">
                    <div class="main-menu__menu-top">
                        <div class="main-menu__menu-top-left">
                            <p class="main-menu__menu-top-text">Welcome To Waste Disposal & Pickup Services.</p>
                            <div class="main-menu__menu-top-btn-box">
                                <a href="request-pickup.html" class="thm-btn main-menu__menu-top-btn">Request a
                                    Pickup</a>
                            </div>
                        </div>
                        <div class="main-menu__menu-top-right">
                            <ul class="list-unstyled main-menu__menu-top-address">
                                <li>
                                    <div class="icon">
                                        <span class="icon-email"></span>
                                    </div>
                                    <div class="text">
                                        <p><a href="mailto:needhelp@company.com">needhelp@waste.com</a></p>
                                    </div>
                                </li>
                                <li>
                                    <div class="icon">
                                        <span class="icon-clock"></span>
                                    </div>
                                    <div class="text">
                                        <p>Mon - Sat 8:00 - 6:30, Sunday - Off</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="main-menu__menu-bottom">
                        <nav class="main-menu clearfix">
                            <div class="main-menu__main-menu-box">
                                <a href="#" class="mobile-nav__toggler"><i class="fa fa-bars"></i></a>
                                <ul class="main-menu__list">
                                    <li class="dropdown">
                                        <a href="index.html">Home</a>
                                        <ul>
                                            <li>
                                                <a href="index.html">Home One</a>
                                            </li>
                                            <li><a href="index2.html">Home Two</a></li>
                                            <li><a href="index3.html">Home Three</a></li>
                                            <li class="dropdown">
                                                <a href="#">Header Styles</a>
                                                <ul>
                                                    <li><a href="index.html">Header One</a></li>
                                                    <li><a href="index2.html">Header Two</a></li>
                                                    <li><a href="index3.html">Header Three</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="about.html">About</a>
                                    </li>
                                    <li class="dropdown megamenu">
                                        <a href="services.html">Our Services</a>
                                        <ul>
                                            <li>
                                                <div class="service-tabs">
                                                    <div class="container">
                                                        <div class="service-tabs__inner tabs-box">
                                                            <div class="row">
                                                                <div class="col-md-6 col-lg-4">
                                                                    <ul class="tab-buttons service-tabs__links">
                                                                        <li data-tab="#service-1"
                                                                            class="tab-btn active-btn">
                                                                            <span>Zero Waste</span>
                                                                        </li>
                                                                        <li data-tab="#service-2" class="tab-btn">
                                                                            <span>Dumpster Rental</span>
                                                                        </li>
                                                                        <li data-tab="#service-3" class="tab-btn">
                                                                            <span>Portable Toilet</span>
                                                                        </li>
                                                                        <li data-tab="#service-4" class="tab-btn">
                                                                            <span>Recylcing Services</span>
                                                                        </li>
                                                                        <li data-tab="#service-5" class="tab-btn">
                                                                            <span>Residential Pickup</span>
                                                                        </li>
                                                                        <li data-tab="#service-6" class="tab-btn">
                                                                            <span>Business Pickup</span>
                                                                        </li>
                                                                    </ul>
                                                                </div><!-- /.col-md-6 -->
                                                                <div class="col-md-6 col-lg-8">
                                                                    <div class="tabs-content">
                                                                        <div class="tab active-tab animated fadeInUp"
                                                                            id="service-1">
                                                                            <div class="service-tabs__content">
                                                                                <div class="service-tabs__text">
                                                                                    <h3 class="service-tabs__title"><a
                                                                                            href="zero-waste.html">Zero
                                                                                            Waste
                                                                                            & Recycling
                                                                                            Pickup</a></h3>
                                                                                    <a class="service-tabs__btn"
                                                                                        href="zero-waste.html">
                                                                                        <i
                                                                                            class="fa fa-arrow-right"></i>
                                                                                        View
                                                                                        More
                                                                                    </a>
                                                                                    <!-- /.service-tabs__title -->
                                                                                </div><!-- /.service-tabs__text -->
                                                                                <div class="service-tabs__image">
                                                                                    <img src="assets/images/services/service-m-1-1.png"
                                                                                        alt="">
                                                                                </div><!-- /.service-tabs__image -->
                                                                            </div><!-- /.service-tabs__content -->
                                                                        </div>

                                                                        <div class="tab" id="service-2">
                                                                            <div class="service-tabs__content">
                                                                                <div class="service-tabs__text">
                                                                                    <h3 class="service-tabs__title"><a
                                                                                            href="dumpster-rental.html">Dumpster
                                                                                            Rental
                                                                                            & Recycling
                                                                                            Pickup</a></h3>
                                                                                    <a class="service-tabs__btn"
                                                                                        href="dumpster-rental.html">
                                                                                        <i
                                                                                            class="fa fa-arrow-right"></i>
                                                                                        View
                                                                                        More
                                                                                    </a>
                                                                                    <!-- /.service-tabs__title -->
                                                                                </div><!-- /.service-tabs__text -->
                                                                                <div class="service-tabs__image">
                                                                                    <img src="assets/images/services/service-m-1-2.png"
                                                                                        alt="">
                                                                                </div><!-- /.service-tabs__image -->
                                                                            </div><!-- /.service-tabs__content -->
                                                                        </div>

                                                                        <div class="tab" id="service-3">
                                                                            <div class="service-tabs__content">
                                                                                <div class="service-tabs__text">
                                                                                    <h3 class="service-tabs__title"><a
                                                                                            href="portable-toilet.html">Portable
                                                                                            Toilet
                                                                                            & Recycling
                                                                                            Pickup</a></h3>
                                                                                    <a class="service-tabs__btn"
                                                                                        href="portable-toilet.html">
                                                                                        <i
                                                                                            class="fa fa-arrow-right"></i>
                                                                                        View
                                                                                        More
                                                                                    </a>
                                                                                    <!-- /.service-tabs__title -->
                                                                                </div><!-- /.service-tabs__text -->
                                                                                <div class="service-tabs__image">
                                                                                    <img src="assets/images/services/service-m-1-3.png"
                                                                                        alt="">
                                                                                </div><!-- /.service-tabs__image -->
                                                                            </div><!-- /.service-tabs__content -->
                                                                        </div>

                                                                        <div class="tab" id="service-4">
                                                                            <div class="service-tabs__content">
                                                                                <div class="service-tabs__text">
                                                                                    <h3 class="service-tabs__title"><a
                                                                                            href="recylcing-services.html">Recylcing
                                                                                            Services
                                                                                            & Recycling
                                                                                            Pickup</a></h3>
                                                                                    <a class="service-tabs__btn"
                                                                                        href="recylcing-services.html">
                                                                                        <i
                                                                                            class="fa fa-arrow-right"></i>
                                                                                        View
                                                                                        More
                                                                                    </a>
                                                                                    <!-- /.service-tabs__title -->
                                                                                </div><!-- /.service-tabs__text -->
                                                                                <div class="service-tabs__image">
                                                                                    <img src="assets/images/services/service-m-1-4.png"
                                                                                        alt="">
                                                                                </div><!-- /.service-tabs__image -->
                                                                            </div><!-- /.service-tabs__content -->
                                                                        </div>

                                                                        <div class="tab" id="service-5">
                                                                            <div class="service-tabs__content">
                                                                                <div class="service-tabs__text">
                                                                                    <h3 class="service-tabs__title"><a
                                                                                            href="residential-pickup.html">Residential
                                                                                            Pickup
                                                                                            & Recycling
                                                                                            Pickup</a></h3>
                                                                                    <a class="service-tabs__btn"
                                                                                        href="residential-pickup.html">
                                                                                        <i
                                                                                            class="fa fa-arrow-right"></i>
                                                                                        View
                                                                                        More
                                                                                    </a>
                                                                                    <!-- /.service-tabs__title -->
                                                                                </div><!-- /.service-tabs__text -->
                                                                                <div class="service-tabs__image">
                                                                                    <img src="assets/images/services/service-m-1-5.png"
                                                                                        alt="">
                                                                                </div><!-- /.service-tabs__image -->
                                                                            </div><!-- /.service-tabs__content -->
                                                                        </div>

                                                                        <div class="tab" id="service-6">
                                                                            <div class="service-tabs__content">
                                                                                <div class="service-tabs__text">
                                                                                    <h3 class="service-tabs__title"><a
                                                                                            href="business-pickup.html">Business
                                                                                            Waste
                                                                                            & Recycling
                                                                                            Pickup</a></h3>
                                                                                    <a class="service-tabs__btn"
                                                                                        href="business-pickup.html">
                                                                                        <i
                                                                                            class="fa fa-arrow-right"></i>
                                                                                        View
                                                                                        More
                                                                                    </a>
                                                                                    <!-- /.service-tabs__title -->
                                                                                </div><!-- /.service-tabs__text -->
                                                                                <div class="service-tabs__image">
                                                                                    <img src="assets/images/services/service-m-1-6.png"
                                                                                        alt="">
                                                                                </div><!-- /.service-tabs__image -->
                                                                            </div><!-- /.service-tabs__content -->
                                                                        </div>
                                                                    </div><!-- /.tabs-content -->
                                                                </div><!-- /.col-md-6 -->
                                                            </div><!-- /.row -->
                                                        </div><!-- /.service-tabs__inner -->
                                                    </div><!-- /.container -->
                                                </div><!-- /.service-tabs -->
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#">Industries</a>
                                        <ul>
                                            <li><a href="industries.html">Industries</a></li>
                                            <li><a href="industries-carousel.html">Industries Carousel</a></li>
                                            <li><a href="industry-details.html">Industry Details</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#">Pages</a>
                                        <ul>
                                            <li><a href="projects.html">Projects</a></li>
                                            <li><a href="projects-carousel.html">Projects Carousel</a></li>
                                            <li><a href="project-details.html">Project Details</a></li>
                                            <li><a href="pricing.html">Pricing</a></li>
                                            <li><a href="request-pickup.html">Request A Pickup</a></li>
                                            <li><a href="staff.html">Staff</a></li>
                                            <li><a href="staff-carousel.html">Staff Carousel</a></li>
                                            <li><a href="staff-details.html">Staff Details</a></li>
                                            <li><a href="testimonials.html">Testimonials</a></li>
                                            <li><a href="testimonials-carousel.html">Testimonials Carousel</a></li>
                                            <li><a href="gallery.html">Gallery</a></li>
                                            <li><a href="faq.html">FAQs</a></li>
                                            <li><a href="404.html">404 Error</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#">News</a>
                                        <ul>
                                            <li><a href="news.html">News</a></li>
                                            <li><a href="news-carousel.html">News Carousel</a></li>
                                            <li><a href="news-sidebar.html">News Sidebar Right</a></li>
                                            <li><a href="news-sidebar-left.html">News Sidebar Left</a></li>
                                            <li><a href="news-details.html">News Details</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="contact.html">Contact</a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
                <div class="main-header__right">
                    <div class="main-header__right__call-icon">
                        <span class="icon-phone-ringing"></span>
                    </div>
                    <div class="main-header__right-call-number">
                        <p>Have Waste/Pickup?</p>
                        <h5><a href="tel:12463330088">+ 1- (246) 333-0088</a></h5>
                    </div>
                </div>
            </div>
        </header>

        <div class="stricky-header stricked-menu main-menu">
            <div class="sticky-header__content"></div><!-- /.sticky-header__content -->
        </div><!-- /.stricky-header -->

        <!--Page Header Start-->
        <section class="page-header">
            <div class="page-header-bg" style="background-image: url(req_bg.png)">
            </div>
            <div class="container">
                <div class="page-header__inner">
                    <h2>Request a Pickup</h2>
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="index.html">Home</a></li>
                        <li>Request a Pickup</li>
                    </ul>
                </div>
            </div>
        </section>
        <!--Page Header End-->

        <!--Request A Pickup Top Start-->
        <section class="request-a-pickup-top">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="request-a-pickup-top__inner">
                            <h2 class="request-a-pickup-top__title">Are you Interested in a Pickup?</h2>
                            <p class="request-a-pickup-top__text">Get tips and info on how to manage waste effectively
                                and reduce environmental impact. <br> Need more info? <a href="tel:12463330088">Call +
                                    1- (246) 333-0088</a> to speak with a Wostin expert.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Request A Pickup Top End-->

<!--Request A Pickup Start-->
<section class="request-a-pickup">
    <div class="container">
        <div class="request-a-pickup__tab-box tabs-box">
            <ul class="tab-buttons clearfix list-unstyled">
                <li data-tab="#bagster" class="tab-btn"><span>Bagster</span></li>
                <li data-tab="#containers" class="tab-btn active-btn"><span>Containers</span></li>
                <li data-tab="#dumpster" class="tab-btn"><span>Dumpster</span></li>
            </ul>
            <div class="tabs-content">
                <!-- Bagster Tab -->
                <div class="tab" id="bagster">
                    <div class="request-a-pickup__tab-content">
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="request-a-pickup__tab-content-img">
                                    <img src="2.png" alt="">
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="request-a-pickup__tab-content-form-box">
                                    <form action="submit_pickup.php" method="POST" class="request-a-pickup__tab-content-form">
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <div class="request-a-pickup__tab-content-input-box">
                                                    <select class="selectpicker" aria-label="Default select example" name="waste_type_bagster">
                                                        <option selected>Select Waste Type</option>
                                                        <option value="1">32 Gallon</option>
                                                        <option value="2">64 Gallon</option>
                                                        <option value="3">96 Gallon</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="request-a-pickup__tab-content-input-box">
                                                    <input type="text" placeholder="First Name" name="first_name_bagster">
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="request-a-pickup__tab-content-input-box">
                                                    <input type="text" placeholder="Last Name" name="last_name_bagster">
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="request-a-pickup__tab-content-input-box">
                                                    <input type="text" placeholder="Company Name (If Applicable)" name="company_name_bagster">
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="request-a-pickup__tab-content-input-box">
                                                    <input type="text" placeholder="Street Address" name="address_bagster">
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="request-a-pickup__tab-content-input-box">
                                                    <input type="text" placeholder="Post Code" name="post_code_bagster">
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="request-a-pickup__tab-content-input-box request-a-pickup__tab-content-brief-box">
                                                    <textarea placeholder="Brief description of waste to be removed" name="description_bagster"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="request-a-pickup__tab-content-input-box">
                                                    <input type="email" placeholder="Email Address" name="email_bagster">
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="request-a-pickup__tab-content-input-box">
                                                    <input type="text" placeholder="Subject" name="subject_bagster">
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="request-a-pickup__tab-content-input-box">
                                                    <input type="text" placeholder="Pick Up Date" name="date_bagster" id="datepicker_bagster">
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="request-a-pickup__tab-content-input-box">
                                                    <input type="time" class="custom-time-picker" placeholder="Pick Up Time" name="time_bagster">
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <h4>Choose Your Location</h4>
                                            </div>
                                            <div class="col-xl-12" style="margin-bottom: 20px;">
                                                <div id="map-bagster" style="height: 400px; width: 100%; border: 1px solid #ddd;"></div>
                                                <input type="hidden" id="latitude-bagster" name="latitude_bagster">
                                                <input type="hidden" id="longitude-bagster" name="longitude_bagster">
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="request-a-pickup__tab-content-btn-box">
                                                    <button type="submit" class="thm-btn request-a-pickup__tab-content-btn">Order Now</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Containers Tab -->
                <div class="tab active-tab" id="containers">
                    <div class="request-a-pickup__tab-content">
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="request-a-pickup__tab-content-img">
                                    <img src="1.png" alt="">
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="request-a-pickup__tab-content-form-box">
                                    <form action="submit_pickup.php" method="POST" class="request-a-pickup__tab-content-form">
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <div class="request-a-pickup__tab-content-input-box">
                                                    <select class="selectpicker" aria-label="Default select example" name="waste_type_containers">
                                                        <option selected>Select Waste Type</option>
                                                        <option value="1">32 Gallon</option>
                                                        <option value="2">64 Gallon</option>
                                                        <option value="3">96 Gallon</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="request-a-pickup__tab-content-input-box">
                                                    <input type="text" placeholder="First Name" name="first_name_containers">
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="request-a-pickup__tab-content-input-box">
                                                    <input type="text" placeholder="Last Name" name="last_name_containers">
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="request-a-pickup__tab-content-input-box">
                                                    <input type="text" placeholder="Company Name (If Applicable)" name="company_name_containers">
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="request-a-pickup__tab-content-input-box">
                                                    <input type="text" placeholder="Street Address" name="address_containers">
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="request-a-pickup__tab-content-input-box">
                                                    <input type="text" placeholder="Post Code" name="post_code_containers">
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="request-a-pickup__tab-content-input-box request-a-pickup__tab-content-brief-box">
                                                    <textarea placeholder="Brief description of waste to be removed" name="description_containers"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="request-a-pickup__tab-content-input-box">
                                                    <input type="email" placeholder="Email Address" name="email_containers">
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="request-a-pickup__tab-content-input-box">
                                                    <input type="text" placeholder="Subject" name="subject_containers">
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="request-a-pickup__tab-content-input-box">
                                                    <input type="text" placeholder="Pick Up Date" name="date_containers" id="datepicker_containers">
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="request-a-pickup__tab-content-input-box">
                                                    <input type="time" class="custom-time-picker" placeholder="Pick Up Time" name="time_containers">
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <h4>Choose Your Location</h4>
                                            </div>
                                            <div class="col-xl-12" style="margin-bottom: 20px;">
                                                <div id="map-containers" style="height: 400px; width: 100%; border: 1px solid #ddd;"></div>
                                                <input type="hidden" id="latitude-containers" name="latitude_containers">
                                                <input type="hidden" id="longitude-containers" name="longitude_containers">
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="request-a-pickup__tab-content-btn-box">
                                                    <button type="submit" class="thm-btn request-a-pickup__tab-content-btn">Order Now</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Dumpster Tab -->
                <div class="tab" id="dumpster">
                    <div class="request-a-pickup__tab-content">
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="request-a-pickup__tab-content-img">
                                    <img src="3.png" alt="">
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="request-a-pickup__tab-content-form-box">
                                    <form action="submit_pickup.php" method="POST" class="request-a-pickup__tab-content-form">
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <div class="request-a-pickup__tab-content-input-box">
                                                    <select class="selectpicker" aria-label="Default select example" name="waste_type_dumpster">
                                                        <option selected>Select Waste Type</option>
                                                        <option value="1">32 Gallon</option>
                                                        <option value="2">64 Gallon</option>
                                                        <option value="3">96 Gallon</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="request-a-pickup__tab-content-input-box">
                                                    <input type="text" placeholder="First Name" name="first_name_dumpster">
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="request-a-pickup__tab-content-input-box">
                                                    <input type="text" placeholder="Last Name" name="last_name_dumpster">
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="request-a-pickup__tab-content-input-box">
                                                    <input type="text" placeholder="Company Name (If Applicable)" name="company_name_dumpster">
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="request-a-pickup__tab-content-input-box">
                                                    <input type="text" placeholder="Street Address" name="address_dumpster">
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="request-a-pickup__tab-content-input-box">
                                                    <input type="text" placeholder="Post Code" name="post_code_dumpster">
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="request-a-pickup__tab-content-input-box request-a-pickup__tab-content-brief-box">
                                                    <textarea placeholder="Brief description of waste to be removed" name="description_dumpster"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="request-a-pickup__tab-content-input-box">
                                                    <input type="email" placeholder="Email Address" name="email_dumpster">
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="request-a-pickup__tab-content-input-box">
                                                    <input type="text" placeholder="Subject" name="subject_dumpster">
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="request-a-pickup__tab-content-input-box">
                                                    <input type="text" placeholder="Pick Up Date" name="date_dumpster" id="datepicker_dumpster">
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="request-a-pickup__tab-content-input-box">
                                                    <input type="time" class="custom-time-picker" placeholder="Pick Up Time" name="time_dumpster">
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <h4>Choose Your Location</h4>
                                            </div>
                                            <div class="col-xl-12" style="margin-bottom: 20px;">
                                                <div id="map-dumpster" style="height: 400px; width: 100%; border: 1px solid #ddd;"></div>
                                                <input type="hidden" id="latitude-dumpster" name="latitude_dumpster">
                                                <input type="hidden" id="longitude-dumpster" name="longitude_dumpster">
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="request-a-pickup__tab-content-btn-box">
                                                    <button type="submit" class="thm-btn request-a-pickup__tab-content-btn">Order Now</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<!--Request A Pickup End-->

<script>
        $(function() {
        // Initialize the date pickers for all sections
        $("#datepicker_bagster").datepicker({
            dateFormat: "yy-mm-dd",
            minDate: 0 // Ensures that past dates cannot be selected
        });
        $("#datepicker_containers").datepicker({
            dateFormat: "yy-mm-dd",
            minDate: 0
        });
        $("#datepicker_dumpster").datepicker({
            dateFormat: "yy-mm-dd",
            minDate: 0
        });
    });
    function initMap() {
        // Default location (example: Colombo, Sri Lanka)
        var defaultLocation = { lat: 6.9271, lng: 79.8612 };

        // Initialize the map for each section
        var mapBagster = new google.maps.Map(document.getElementById('map-bagster'), {
            zoom: 12,
            center: defaultLocation
        });
        var mapContainers = new google.maps.Map(document.getElementById('map-containers'), {
            zoom: 12,
            center: defaultLocation
        });
        var mapDumpster = new google.maps.Map(document.getElementById('map-dumpster'), {
            zoom: 12,
            center: defaultLocation
        });

        // Create markers for each section
        var markerBagster = new google.maps.Marker({
            position: defaultLocation,
            map: mapBagster,
            draggable: true
        });
        var markerContainers = new google.maps.Marker({
            position: defaultLocation,
            map: mapContainers,
            draggable: true
        });
        var markerDumpster = new google.maps.Marker({
            position: defaultLocation,
            map: mapDumpster,
            draggable: true
        });

        // Event listeners to update hidden input fields with selected coordinates
        google.maps.event.addListener(mapBagster, 'click', function(event) {
            var clickedLocation = event.latLng;
            markerBagster.setPosition(clickedLocation);
            document.getElementById('latitude-bagster').value = clickedLocation.lat();
            document.getElementById('longitude-bagster').value = clickedLocation.lng();
        });

        google.maps.event.addListener(mapContainers, 'click', function(event) {
            var clickedLocation = event.latLng;
            markerContainers.setPosition(clickedLocation);
            document.getElementById('latitude-containers').value = clickedLocation.lat();
            document.getElementById('longitude-containers').value = clickedLocation.lng();
        });

        google.maps.event.addListener(mapDumpster, 'click', function(event) {
            var clickedLocation = event.latLng;
            markerDumpster.setPosition(clickedLocation);
            document.getElementById('latitude-dumpster').value = clickedLocation.lat();
            document.getElementById('longitude-dumpster').value = clickedLocation.lng();
        });
    }
</script>


        <!--Site Footer Start-->
        <footer class="site-footer">
            <div class="site-footer-bg" style="background-image: url(assets/images/backgrounds/site-footer-bg.jpg);">
            </div>
            <div class="site-footer__top">
                <div class="container">
                    <div class="site-footer__top-inner">
                        <div class="site-footer__top-logo">
                            <a href="index.html"><img src="assets/images/resources/footer-logo.png" alt=""></a>
                        </div>
                        <div class="site-footer__top-right">
                            <p class="site-footer__top-right-text">Waste Disposal Management & Pickup Services</p>
                            <div class="site-footer__social">
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-facebook"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                                <a href="#"><i class="fab fa-pinterest-p"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="site-footer__middle">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="100ms">
                            <div class="footer-widget__column footer-widget__about">
                                <h3 class="footer-widget__title">About</h3>
                                <div class="footer-widget__about-text-box">
                                    <p class="footer-widget__about-text">Lorem ipsum dolor sited ame etur adi pisicing
                                        elit tempor labore.</p>
                                </div>
                                <form class="footer-widget__newsletter-form">
                                    <div class="footer-widget__newsletter-input-box">
                                        <input type="email" placeholder="Email Address" name="email">
                                        <button type="submit" class="footer-widget__newsletter-btn"><i
                                                class="far fa-paper-plane"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="200ms">
                            <div class="footer-widget__column footer-widget__links clearfix">
                                <h3 class="footer-widget__title">Links</h3>
                                <ul class="footer-widget__links-list list-unstyled clearfix">
                                    <li><a href="about.html">About</a></li>
                                    <li><a href="request-pickup.html">Request Pickup</a></li>
                                    <li><a href="about.html">Management</a></li>
                                    <li><a href="services.html">Start Service</a></li>
                                    <li><a href="contact.html">Contact</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="300ms">
                            <div class="footer-widget__column footer-widget__services clearfix">
                                <h3 class="footer-widget__title">Services</h3>
                                <ul class="footer-widget__services-list list-unstyled clearfix">
                                    <li><a href="dumpster-rental.html">Dumpster Rentals</a></li>
                                    <li><a href="about.html">Bulk Trash Pickup</a></li>
                                    <li><a href="about.html">Waste Removal</a></li>
                                    <li><a href="zero-waste.html">Zero Waste</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="400ms">
                            <div class="footer-widget__column footer-widget__contact clearfix">
                                <h3 class="footer-widget__title">Contact</h3>
                                <p class="footer-widget__contact-text">880 Broklyn Road Street, New Town DC 5002, New
                                    York. USA</p>
                                <div class="footer-widget__contact-info">
                                    <div class="footer-widget__contact-icon">
                                        <span class="icon-contact"></span>
                                    </div>
                                    <div class="footer-widget__contact-content">
                                        <p class="footer-widget__contact-mail-phone">
                                            <a href="mailto:needhelp@wostin.com"
                                                class="footer-widget__contact-mail">needhelp@wostin.com</a>
                                            <a href="tel:2463330088" class="footer-widget__contact-phone">+ 1- (246)
                                                333-0088</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="site-footer__bottom">
                <div class="site-footer-bottom-shape"
                    style="background-image: url(assets/images/shapes/site-footer-bottom-shape.png);"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="site-footer__bottom-inner">
                                <p class="site-footer__bottom-text">© Copyright 2022 by <a href="#">Layerdrops.com</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!--Site Footer End-->


    </div><!-- /.page-wrapper -->


    <div class="mobile-nav__wrapper">
        <div class="mobile-nav__overlay mobile-nav__toggler"></div>
        <!-- /.mobile-nav__overlay -->
        <div class="mobile-nav__content">
            <span class="mobile-nav__close mobile-nav__toggler"><i class="fa fa-times"></i></span>

            <div class="logo-box">
                <a href="index.html" aria-label="logo image"><img src="assets/images/resources/footer-logo.png"
                        width="155" alt="" /></a>
            </div>
            <!-- /.logo-box -->
            <div class="mobile-nav__container"></div>
            <!-- /.mobile-nav__container -->

            <ul class="mobile-nav__contact list-unstyled">
                <li>
                    <i class="fa fa-envelope"></i>
                    <a href="mailto:needhelp@packageName__.com">needhelp@wostin.com</a>
                </li>
                <li>
                    <i class="fa fa-phone-alt"></i>
                    <a href="tel:666-888-0000">666 888 0000</a>
                </li>
            </ul><!-- /.mobile-nav__contact -->
            <div class="mobile-nav__top">
                <div class="mobile-nav__social">
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-facebook-square"></a>
                    <a href="#" class="fab fa-pinterest-p"></a>
                    <a href="#" class="fab fa-instagram"></a>
                </div><!-- /.mobile-nav__social -->
            </div><!-- /.mobile-nav__top -->



        </div>
        <!-- /.mobile-nav__content -->
    </div>
    <!-- /.mobile-nav__wrapper -->

    <div class="search-popup">
        <div class="search-popup__overlay search-toggler"></div>
        <!-- /.search-popup__overlay -->
        <div class="search-popup__content">
            <form action="#">
                <label for="search" class="sr-only">search here</label><!-- /.sr-only -->
                <input type="text" id="search" placeholder="Search Here..." />
                <button type="submit" aria-label="search submit" class="thm-btn">
                    <i class="icon-magnifying-glass"></i>
                </button>
            </form>
        </div>
        <!-- /.search-popup__content -->
    </div>
    <!-- /.search-popup -->

    <a href="#" data-target="html" class="scroll-to-target scroll-to-top"><i class="fa fa-angle-up"></i></a>


    <script src="assets/vendors/jquery/jquery-3.6.0.min.js"></script>
    <script src="assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendors/jarallax/jarallax.min.js"></script>
    <script src="assets/vendors/jquery-ajaxchimp/jquery.ajaxchimp.min.js"></script>
    <script src="assets/vendors/jquery-appear/jquery.appear.min.js"></script>
    <script src="assets/vendors/jquery-circle-progress/jquery.circle-progress.min.js"></script>
    <script src="assets/vendors/jquery-magnific-popup/jquery.magnific-popup.min.js"></script>
    <script src="assets/vendors/jquery-validate/jquery.validate.min.js"></script>
    <script src="assets/vendors/nouislider/nouislider.min.js"></script>
    <script src="assets/vendors/odometer/odometer.min.js"></script>
    <script src="assets/vendors/swiper/swiper.min.js"></script>
    <script src="assets/vendors/tiny-slider/tiny-slider.min.js"></script>
    <script src="assets/vendors/wnumb/wNumb.min.js"></script>
    <script src="assets/vendors/wow/wow.js"></script>
    <script src="assets/vendors/isotope/isotope.js"></script>
    <script src="assets/vendors/countdown/countdown.min.js"></script>
    <script src="assets/vendors/owl-carousel/owl.carousel.min.js"></script>
    <script src="assets/vendors/bxslider/jquery.bxslider.min.js"></script>
    <script src="assets/vendors/bootstrap-select/js/bootstrap-select.min.js"></script>
    <script src="assets/vendors/vegas/vegas.min.js"></script>
    <script src="assets/vendors/jquery-ui/jquery-ui.js"></script>
    <script src="assets/vendors/timepicker/timePicker.js"></script>




    <!-- template js -->
    <script src="assets/js/wostin.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBPIwUI69LTcLrwSOX8yWKqbopfZcGHJnk&callback=initMap"></script>

</body>

</html>