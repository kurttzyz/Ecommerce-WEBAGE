

<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo e(asset('landingpage/img/notes.png')); ?>" type="image/gif" sizes="16x16">
    <title>ConnectingNotes</title>
    <!-- CSS Files -->
    <link rel="stylesheet" href="<?php echo e(asset('landingpage/css/base-style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('landingpage/css/style.css')); ?>">
</head>
<style>
    .lesson-buttons .btn {
    font-size: 16px;
    padding: 10px 20px;
    margin: 5px;
    transition: all 0.3s ease;
    border-radius: 30px;
}

.lesson-buttons .btn:hover {
    background-color: #007bff;
    color: #fff;
    transform: scale(1.05);
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
}

</style>

<body>
    <!-- preloader -->
    <div class="ch-preloader-sec">
        <div id="ch-preloader">
            <div id="chp-top" class="mask">
                <div class="plane"></div>
            </div>
            <div id="chp-middle" class="mask">
                <div class="plane"></div>
            </div>
            <div id="chp-bottom" class="mask">
                <div class="plane"></div>
            </div>
            <p><i>LOADING...</i></p>

        </div>
    </div>
    <div class="ch-banner-sec">



        <header class="ch-header-sec">
            <div class="container-fluid">
                <div class="header-top py-2 text-white">

                    <div class="h-lang">
                        <span class="lang-text"></span>
                        <div class="">
                            <label class="lang-item">
                                <input type="radio" name="lang">

                            </label>
                            <label class="lang-item">
                                <input type="radio" name="lang">

                            </label>
                            <label class="lang-item">
                                <input type="radio" name="lang">

                            </label>
                        </div>
                    </div>
                </div>
                <div class="ch-header rounded-10 py-2 py-xl-0 bg-white px-3">
                    <a href="#" class="h-logo pe-3" style="display: flex; align-items: center;">
                        <img src="<?php echo e(asset('landingpage/img/notes3.png')); ?>" style="width:100px; margin-right: 5px;" alt="Logo">
                        <h1 style="color:Tomato;"> ConnectingNotes </h1>
                        
                    </a>

                    <div class="header-right">
                        <div class="h-menu-wrap d-none d-xl-block">
                            <ul class="h-menu">


                                </li>
                                <li>
                                    <a href="/">Home</a>
                                    <ul>
                                        <li><a href="#lessons">Courses/Lessons</a></li>
                                        <li><a href="#mentor">Mentors</a></li>
                                        <li><a href="<?php echo e(route('login')); ?>">Schedule/Book Session</a></li>
                                        <li><a href="#foot">Community/Forum</a></li>
                                        <li><a href="#foot">Resources</a></li>
                                        <li><a href="#about">About Us</a></li>
                                        <li><a href="#foot">Contact Us</a></li>
                                    </ul>
                                </li>

                            </ul>
                        </div>
                        <div class="menu-trigger d-xl-none">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <div class="h-btn d-none d-xl-block ms-xl-4">
                            <a href="<?php echo e(route('login')); ?>" class="btn btn-primary rounded-40">
                                Sign In
                            </a>
                            <a href="<?php echo e(route('register')); ?>" class="text-heading fw-semibold ms-3">
                                Sign Up
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mobile-menu-wrap d-xl-none">
                <div class="menu-close">
                    <i class="icofont-close-line"></i>
                </div>
                <div class="mobile-menu"></div>
                <div class="my-4">
                    <a href="/" class="btn btn-primary rounded-40 me-3">
                        Sign In
                    </a>
                    <a href="/" class="btn btn-primary rounded-40">
                        Sign Up
                    </a>
                </div>
            </div>
        </header>


        <div class="hero-banner-sec" >
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-5 d-none d-md-block">
                        <div class="hero-banner-img pe-md-5">
                            <img src="<?php echo e(asset('landingpage/img/notes2.png')); ?>" alt="note" class="opacity-20">
                        </div>

                    </div>
                    <div class="col-lg-6 col-md-7">
                        <div class="hero-banner-text pt-5">
                            <h2>Learn Music from Real Mentors, Anytime, Anywhere.</h2>

                            <p>ConnectingNotes is the ultimate destination for aspiring musicians and passionate mentors—a revolutionary platform
                            designed to transform how music is learned and taught. With its seamless one-on-one mentorship model, flexible
                            scheduling, and expertly curated learning resources, ConnectingNotes empowers learners of all levels to grow confidently
                            at their own pace. Whether you're a beginner picking up your first instrument or an experienced artist refining your
                            craft, ConnectingNotes connects you with professional mentors who guide, inspire, and elevate your musical journey.</p>
                            <a href="#" class="btn btn-success">
                                Discover More
                                <i class="icofont-long-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="token-info-sec" id="lessons">
    <div class="container">
        <div class="sec-title text-center" id="about" data-aos="fade-up">
            <h1 data-watermark="Lessons">
                <span>Courses</span> / Lessons
            </h1>
            <h2>Explore ConnectingNotes and Learn More</h2>
            <p>
                ConnectingNotes is an intelligent and collaborative note-taking platform designed to help individuals
                and teams capture, connect, and organize ideas seamlessly. Whether you're a student, professional, or
                creative
                thinker, our platform adapts to your needs and simplifies the learning experience.
            </p>
        </div>
        <div class="row align-items-center">
            <div class="col-lg-6 pb-4 pb-lg-0" data-aos="fade-right">
                <h3 class="mb-3">Why Choose ConnectingNotes?</h3>
                <ul class="list-unstyled">
                    <li> Real-time collaboration with teammates or classmates</li>
                    <li> Smart linking between notes for seamless organization</li>
                    <li> Search and filter your notes with intelligent suggestions</li>
                    <li> Cross-device sync — access anywhere, anytime</li>
                    <li> Clean and distraction-free writing interface</li>
                </ul>
                <p class="mt-3">
                    Join thousands of users already transforming the way they capture ideas and knowledge.
                    Start connecting your thoughts today with ConnectingNotes.
                </p>
                <div class="lesson-buttons">
                    <a href="#lesson1" class="btn btn-primary">Lesson 1: Introduction to Notes</a>
                    <a href="#lesson2" class="btn btn-primary">Lesson 2: Smart Linking</a>
                    <a href="#lesson3" class="btn btn-primary">Lesson 3: Organizing Ideas</a>
                </div>
            </div>
            <div class="col-lg-6" data-aos="zoom-in">
                <img src="<?php echo e(asset('landingpage/img/note4.jpg')); ?>" alt="ConnectingNotes interface"
                    style="width: 100%; opacity: 0.9; border-radius: 12px; box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);">
            </div>
        </div>
    </div>
</div>



<div class="token-info-sec">
    <div class="container">
        <div class="sec-title text-center" id="about" data-aos="fade-up">
            <h1 data-watermark="ConnectingNotes">
                <span>About</span> Us
            </h1>
            <h2>Get to know ConnectingNotes</h2>
            <p>
                ConnectingNotes is an intelligent and collaborative note-taking platform designed to help individuals
                and teams
                capture, connect, and organize ideas seamlessly. Whether you're a student, professional, or creative
                thinker,
                our platform adapts to your needs.
            </p>
        </div>
        <div class="row align-items-center">
            <div class="col-lg-6 pb-4 pb-lg-0" data-aos="fade-right">
                <h3 class="mb-3">Why Choose ConnectingNotes?</h3>
                <ul class="list-unstyled">
                    <li> Real-time collaboration with teammates or classmates</li>
                    <li> Smart linking between notes for seamless organization</li>
                    <li> Search and filter your notes with intelligent suggestions</li>
                    <li> Cross-device sync — access anywhere, anytime</li>
                    <li> Clean and distraction-free writing interface</li>
                </ul>
                <p class="mt-3">
                    Join thousands of users already transforming the way they capture ideas and knowledge.
                    Start connecting your thoughts today with ConnectingNotes.
                </p>
            </div>
            <div class="col-lg-6" data-aos="zoom-in">
                <img src="<?php echo e(asset('landingpage/img/logo.png')); ?>" alt="ConnectingNotes interface"
                    style="width: 100%; opacity: 0.9; border-radius: 12px; box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);">
            </div>
        </div>
    </div>
</div>



    <div class="countdown-sec" id="mentor">
        <div class="container">
            <div class="w600 mx-auto sec-title text-center text-white" data-aos="fade-up">
                <h1>MENTORSHIP PROGRAM</h1>

            </div>

            <div class="col-12 mt-5">
                <div class="call-to-action" data-aos="fade-up">
                    <div class="cta-left">
                        <h4>Join Today & Learn on ConnectingNotes</h4>

                    </div>
                    <div class="cta-right">
                        <a href="<?php echo e(route('login')); ?>" target="_blank" class="btn btn-primary">
                            Start Learning
                            <i class="icofont-long-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>


    <div class="roadmap-sec pt-5 pt-lg-0">


    </div>

    <div class="counter-sec py-100">
        <div class="container">
            <div class="counter">
                <div class="counter-img text-center" data-aos="zoom-in">

                </div>
                <div class="counter-wrap">
                    <div class="row text-center">
                        <div class="col-lg-3 col-sm-6 py-3">
                            <div class="counter-item" data-aos="fade-up">
                                <h2>
                                    <span class="counter-value" data-count="165567">0</span>
                                </h2>
                                <p>Daily Batch User</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 py-3">
                            <div class="counter-item" data-aos="fade-up" data-aos-delay="100">
                                <h2>
                                    <span class="counter-value" data-count="0.759">0</span>
                                </h2>
                                <p>Average Rate</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 py-3">
                            <div class="counter-item" data-aos="fade-up" data-aos-delay="200">
                                <h2>
                                    <span class="counter-value" data-count="5.87">0</span>
                                </h2>
                                <p>Total Batches</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 py-3">
                            <div class="counter-item" data-aos="fade-up" data-aos-delay="300">
                                <h2>
                                    <span class="counter-value" data-count="70">0</span>%
                                </h2>
                                <p>Success Rate</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-secondary-gradient">
        <div class="footer-sec pt-50" id="foot">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 py-4">
                        <div class="footer-widget">
                            <a href="/" class="footer-logo mb-4">
                                <img src="<?php echo e(asset('landingpage/img/logo.png')); ?>" style="width:auto" alt="">
                            </a>

                            <div class="social-icons">
                                <a href="#">
                                    <i class="icofont-facebook"></i>
                                </a>
                                <a href="#">
                                    <i class="icofont-twitter"></i>
                                </a>
                                <a href="#">
                                    <i class="icofont-instagram"></i>
                                </a>
                                <a href="#">
                                    <i class="icofont-youtube-play"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 py-4">
                        <div class="footer-widget">
                            <h4 class="footer-widget-title text-black">Sitemap</h4>
                            <ul class="footer-widget-menu column-2">
                                <li><a href="<?php echo e(route('login')); ?>">Courses/Lessons</a></li>
                                <li><a href="<?php echo e(route('login')); ?>">Mentors</a></li>
                                <li><a href="<?php echo e(route('login')); ?>">Schedule/Book Session</a></li>
                                <li><a href="<?php echo e(route('login')); ?>">Resources</a></li>
                                <li><a href="/">About Us</a></li>
                                <li><a href="/">Contact Us</a></li>

                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-6 py-4">
                        <div class="footer-widget">
                            <h4 class="footer-widget-title text-black">Link</h4>
                            <ul class="footer-widget-menu mb-4">
                                <li><a href="<?php echo e(route('contract')); ?>">Contract and Agreement</a></li>
                                <li><a href="<?php echo e(route('policy')); ?>">Privacy Policy</a></li>
                                <li><a href="<?php echo e('login'); ?>">Become A Mentor</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 py-4 col-md-6">
                        <div class="footer-widget">
                            <h4 class="footer-widget-title">Newsletter</h4>
                            <p>Subscribe our newsletter for get Update</p>
                            <div class="newsletter-widget mb-4">
                                <input type="email" placeholder="Enter your email address">
                                <input type="submit" value="Send">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="copyright-sec border-top border-white">
            <div class="container">
                <div class="copyright-inner text-center d-block">
                    <p>Copyright © 2025 ConnectingNotes. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="landingpage/js/1-jquery-3.3.1.min.js"></script>
    <script src="landingpage/js/app.min.js"></script>
    <script src="landingpage/js/scripts.js"></script>
</body>

</html><?php /**PATH C:\music\resources\views/welcome.blade.php ENDPATH**/ ?>