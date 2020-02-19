<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/animate.css-master/animate.css">
    <!--==============================================================================================-->
    <link href="https://fonts.googleapis.com/css?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:800&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/be76a30cc4.js" crossorigin="anonymous"></script>

    <title>Nexus IT Training Center</title>

</head>

<body>

    <?php
    include_once "welcomeHeader.php"
    ?>

  <!-- <nav class="navbar navbar-default navbar-fixed-top" role="navigation" id="nav">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-main">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand">NEXUS ITTC</a>
        </div>

        <div class="navbar-collapse collapse" id="navbar-collapse-main">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#">Home</a></li>
                <li><a href="#about">About</a></li>

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown">Courses<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-header">Cisco</li>
                        <li class="dd-content"><a href="courses/ccnav4.php" target="_blank">CCNA v4 200-301</a></li>
                        <li class="dd-content"><a href="courses/encore.php" target="_blank">CCNP & CCIE Enterprise Core</a></li>
                        <li class="dd-content"><a href="#" target="_blank">CCNP - Implementing Cisco Enterprise Advanced Routing and Services (ENARSI)</a></li>

                        <li class="dropdown-header">Microsoft</li>
                        <li class="dd-content"><a href="courses/mcp.php" target="_blank">20410 MCP in Windows Server 2012</a></li>
                        <li class="dd-content"><a href="courses/mcsa2012.php" target="_blank">MCSA 2012</a></li>
                        <li class="dd-content"><a href="#" target="_blank">MCSA 2016</a></li>
                        <li class="dd-content"><a href="courses/azure.php" target="_blank">Azure Administrator</a></li>

                        <li class="dropdown-header">Amazon Web Services</li>
                        <li class="dd-content"><a href="courses/aws.php" target="_blank">AWS Solutions Architect</a></li>

                        <li class="dropdown-header">VMWare</li>
                        <li class="dd-content"><a href="courses/vmware.php" target="_blank">VMWare vSphere 6.0 ICM</a></li>

                        <li class="dropdown-header">Cybersecurity</li>
                        <li class="dd-content"><a href="courses/eh.php" target="_blank">Ethical Hacking and Penetration Testing</a></li>
                        <li class="dd-content"><a href="courses/cysA.php" target="_blank">Cybersecurity Analyst+</a></li>
                    </ul>
                </li>

                <li><a href="#services">Services</a></li>
                <li><a href="" data-toggle="modal" data-target="#getQuoteModal">Get Quote</a></li>
                <li><a href="" data-toggle="modal" data-target="#emailUsModal">Email Us</a></li>
                <li><a href="#contact">Contact</a></li>
                <li><a href="#faqs">FAQs</a></li>
            </ul>
        </div>
    </div>
</nav> -->

<!--Carousel-->

<div id="my-slider" class="carousel slide" data-ride="carousel">

    <ol class="carousel-indicators">
        <li data-target="#my-slider" data-slide-to="0" class="active"></li>
        <li data-target="#my-slider" data-slide-to="1"></li>
        <li data-target="#my-slider" data-moda-to="2"></li>
        <li data-target="#my-slider" data-slide-to="3"></li>
    </ol>

    <div class="carousel-inner" role="listbox">
        <div class="item active">
            <img class="carousel-img" src="../resource/img/homepage/Networks3.jpg" alt="s4" />
            <div class="carousel-caption">
                <h2 class="animated fadeIn" style="animation-delay: 1s">Learn. Get <span>Certified.</span></h2>
                <h3 class="animated fadeIn" style="animation-delay: 1s">Advance your <span>IT</span> career with us.</h3>
                <a class="signup-btn animated fadeIn" style="animation-delay: 1s" href="#" data-toggle="modal" data-target="#registerModal">Sign Up</a>
                <a class="signin-btn animated fadeIn" style="animation-delay: 1s" href="../Login/" target="_blank">Sign In</a>
            </div>
        </div>
        <div class="item">
            <img class="carousel-img" src="../resource/img/homepage/Networks.jpg" alt="s3" />
            <div class="carousel-caption">
                <h2 class="animated fadeIn" style="animation-delay: 1s">Learn. Get <span>Certified.</span></h2>
                <h3 class="animated fadeIn" style="animation-delay: 1s">Advance your <span>IT</span> career with us.</h3>
                <a class="signup-btn animated fadeIn" style="animation-delay: 1s" href="#" data-toggle="modal" data-target="#registerModal">Sign Up</a>
                <a class="signin-btn animated fadeIn" style="animation-delay: 1s" href="../Login/" target="_blank">Sign In</a>
            </div>
        </div>
        <div class="item">
            <img class="carousel-img" src="../resource/img/homepage/Servers3.jpg" alt="net" />
            <div class="carousel-caption">
                <h2 class="animated fadeIn" style="animation-delay: 1s">Learn. Get <span>Certified.</span></h2>
                <h3 class="animated fadeIn" style="animation-delay: 1s">Advance your <span>IT</span> career with us.</h3>
                <a class="signup-btn animated fadeIn" style="animation-delay: 1s" href="#" data-toggle="modal" data-target="#registerModal">Sign Up</a>
                <a class="signin-btn animated fadeIn" style="animation-delay: 1s" href="../Login/" target="_blank">Sign In</a>
            </div>
        </div>
        <div class="item">
            <img class="carousel-img" src="../resource/img/homepage/Networks2.jpg" alt="net2" />
            <div class="carousel-caption">
                <h2 class="animated fadeIn" style="animation-delay: 1s">Learn. Get <span>Certified.</span></h2>
                <h3 class="animated fadeIn" style="animation-delay: 1s">Advance your <span>IT</span> career with us.</h3>
                <a class="signup-btn animated fadeIn" style="animation-delay: 1s" href="#" data-toggle="modal" data-target="#registerModal">Sign Up</a>
                <a class="signin-btn animated fadeIn" style="animation-delay: 1s" href="../Login/" target="_blank">Sign In</a>
            </div>
        </div>
    </div>
        <!--   <a class="left carousel-control" href="#my-slider" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#my-slider" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a> -->
    </div>

    <!--About-->

    <div class="padding" id="about">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <img class="about-img" src="../resource/img/homepage/Nexus-Logo.png">
                </div>
                <div class="col-sm-6 text-center about-text">
                    <h2 class="about" style="padding-top: 40px">About Us</h2>
                    <br>
                    <p class="lead">Providing trainings for IT professionals and beginners, Nexus continues to solidify its industry leadership position in producing quality training for the largest technologies and business trainings.</p>
                    <br>
                    <p class="lead">Nexus ITTC provides IT Training and offers bootcamps for Cisco, Microsoft, VMWare, Citrix and more. Nexus trains interested students in their chosen field to learn more and earn more through the advanced and innovative teaching process with the latest devices and certified instructors.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="fixed"></div>

    <!--Services-->
<section class="padding" id="services">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">WHY NEXUS?</h2>
            </div>
        </div>
    </div>
    <div class="container services">
        <div class="row">
            <div class="col-lg-3 col-md-6 text-center">
                <div class="service-box mt-5 mx-auto">
                    <div class=" fastIcon">
                        <i class="fas fa-4x fa-smile text-primary mb-3 sr-icon-1 animated tada" style="animation-delay: 1s"></i>
                    </div>
                    <h3 class="mb-3">Satisfaction</h3>
                    <p class="text-muted mb-0">We bring 100% customer satisfaction!</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 text-center">
                <div class="service-box mt-5 mx-auto">
                    <div class=" fastIcon">
                        <i class="fas fa-4x fas fa-chalkboard-teacher text-primary mb-3 sr-icon-2 animated bounce" style="animation-delay: 1s"></i>
                    </div>
                    <h3 class="mb-3">Certified</h3>
                    <p class="text-muted mb-0">Instructors are certified in their fields!</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 text-center">
                <div class="service-box mt-5 mx-auto">
                    <div class=" fastIcon">
                        <i class="fas fa-4x fa-money-bill-alt text-primary mb-3 sr-icon-3 animated tada" style="animation-delay: 1s"></i>
                    </div>
                    <h3 class="mb-3">Value</h3>
                    <p class="text-muted mb-0">We give you the best promos!</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 text-center">
                <div class="service-box mt-5 mx-auto">
                    <div class=" fastIcon">
                        <i class="fas fa-4x fa-heart text-primary mb-3 sr-icon-4 animated bounce" style="animation-delay: 1s"></i>
                    </div>
                    <h3 class="mb-3">The Best</h3>
                    <p class="text-muted mb-0">That's why we give you the best IT training!</p>
                </div>
            </div>
        </div>
    </div>
</section>

<footer class="container-fluid text-center" id="contact">
    <div class="row">
        <h3>C O N N E C T</h3>
        <p>Contact us and we'll answer your inquiries immediately!</p>
        <div class="col-sm-6">
            <i class="icon fas fa-map-marked-alt"></i>
            <p>MAKATI BRANCH</p>
            <p>Unit 2417 Cityland 10 Tower 2, HV Dela Costa, Ayala Avenue, Makati City</p>
            <p>+63 2 8362-3755</p>
            <iframe class="makati" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3861.678658112453!2d121.01502201424155!3d14.560359689828074!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397c9096ec55555%3A0xaf0d621b7e9c77c1!2sCityland%2010%20Tower%202!5e0!3m2!1sen!2sph!4v1581604908686!5m2!1sen!2sph" width="500" height="200" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
        </div>
        <div class="col-sm-6">
            <i class="icon fas fa-map-marked-alt"></i>
            <p>MANILA BRANCH</p>
            <p>Unit 401 Dona Amparo Building, Espana Boulevard, Manila</p>
            <p>+63 2 8355-7759</p>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3860.8726048535877!2d120.98647931424222!3d14.606332189798794!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397c9ff6e6a7e19%3A0x89d69880ec46e9bb!2sDo%C3%B1a%20Amparo%20Building%2C%20Espa%C3%B1a%20Blvd%2C%20Sampaloc%2C%20Manila%2C%201008%20Metro%20Manila!5e0!3m2!1sen!2sph!4v1581605109709!5m2!1sen!2sph" width="500" height="200" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
        </div>
        <div class="col-sm-6">
            <a href="#" data-toggle="modal" data-target="#emailUsModal"><i class="icon fas fa-envelope-open-text"></i></a>
            <p>kdoz@live.com</p>
        </div>
        <div class="col-sm-6">
            <a href="https://facebook.com/nxs88" target="_blank"><i class="icon fab fa-facebook"></i></a>
            <p>Like us on Facebook</p>

            <p>Nexus I.T. Training Center</p>
        </div>
    </div>
</footer>

</body>
</html>