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

    <title>Nexus IT Training Center</title>

</head>

<body>

    <nav class="navbar navbar-default navbar-fixed-top" role="navigation" id="nav">
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
                    <!--====================================================================================-->
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown">Courses<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-header">Cisco</li>
                            <li class="dd-content"><a href="#">CCNA v4 200-301</a></li>
                            <li class="dd-content"><a href="#">CCNP & CCIE Enterprise Core</a></li>
                            <li class="dd-content"><a href="#">CCNP - Implementing Cisco Enterprise Advanced Routing and Services (ENARSI)</a></li>

                            <li class="dropdown-header">Microsoft</li>
                            <li class="dd-content"><a href="#">20410 MCP in Windows Server 2012</a></li>
                            <li class="dd-content"><a href="#">MCSA 2012</a></li>
                            <li class="dd-content"><a href="#">MCSA 2016</a></li>
                            <li class="dd-content"><a href="#">Azure Administrator</a></li>

                            <li class="dropdown-header">Amazon Web Services</li>
                            <li class="dd-content"><a href="#">AWS Solutions Architect</a></li>

                            <li class="dropdown-header">VMWare</li>
                            <li class="dd-content"><a href="#">VMWare vSphere 6.0 ICM</a></li>

                            <li class="dropdown-header">Cybersecurity</li>
                            <li class="dd-content"><a href="#">Ethical Hacking and Penetration Testing</a></li>
                        </ul>
                    </li>
                    <!--====================================================================================-->
                    <li><a href="" data-toggle="modal" data-target="#getQuoteModal">Get Quote</a></li>
                    <li><a href="" data-toggle="modal" data-target="#emailUsModal">Email Us</a></li>
                    <li><a href="#contact">Contact</a></li>
                    <li><a href="#fucks">FAQs</a></li>
                </ul>
            </div>
        </div>
    </nav>

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
                    <br><br><br>
                    <p class="lead">Providing trainings for IT professionals and beginners, Nexus continues to solidify its industry leadership position in producing quality training for the largest technologies and business trainings.</p>
                    <br>
                    <p class="lead">Nexus ITTC provides IT Training and offers bootcamps for Cisco, Microsoft, VMWare, Citrix and more. Nexus trains interested students in their chosen field to learn more and earn more through the advanced and innovative teaching process with the latest devices and certified instructors.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="fixed"></div>

    <footer class="container-fluid text-center" id="contact">
        <div class="row">
            <h3>C O N N E C T</h3>
            <p>Contact us and we'll answer your inquiries immediately!</p>
            <div class="col-sm-6">
                <i class="icon fas fa-map-marked-alt"></i>
                <p>MAKATI BRANCH</p>
                <p>Unit 2417 Cityland 10 Tower 2, HV Dela Costa, Ayala Avenue, Makati City</p>
                <p>584-1881</p>
                <iframe class="makati" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3861.678658112453!2d121.01502201424155!3d14.560359689828074!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397c9096ec55555%3A0xaf0d621b7e9c77c1!2sCityland%2010%20Tower%202!5e0!3m2!1sen!2sph!4v1581604908686!5m2!1sen!2sph" width="500" height="200" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
            </div>
            <div class="col-sm-6">
                <i class="icon fas fa-map-marked-alt"></i>
                <p>MANILA BRANCH</p>
                <p>Unit 401 Dona Amparo Building, Espana Boulevard, Manila</p>
                <p>584-1881</p>
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

    <!--MODALS-->

    <!--Get Quote Modal-->
    <div class="modal fade" id="getQuoteModal" tabindex="-1" role="dialog">
        <div class="modal-dialog getQuoteModal">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 style="font-size: 20px; text-align: center; font-family:sans-serif;">Get Quote</h5>
                </div>
                <div class="modal-body">
                    <div class="error-msg" style="display: none;"></div>
                    <form method="post" id="quotationForm">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="quoteFname"><span class="fas fa-user-circle"></span> First Name</label>
                                <input type="text" class="form-control" id="quoteFname" name="quoteFname" placeholder="First Name" autofocus maxlength="30">
                            </div>
                            <div class="form-group">
                                <label for="quoteMname"><span class="fas fa-user-circle"></span> Middle Name</label>
                                <input type="text" class="form-control" id="quoteMname" name="quoteMname" placeholder="Middle Name" autofocus maxlength="30">
                            </div>
                            <div class="form-group">
                                <label for="quoteLname"><span class="fas fa-user-circle"></span> Last Name</label>
                                <input type="text" class="form-control" id="quoteLname" name="quoteLname" placeholder="Last Name" autofocus maxlength="30">
                            </div>
                            <div class="form-group">
                                <label for="quoteContactNum"><span class="fas fa-user-circle"></span> Contact Number</label>
                                <input type="text" class="form-control" id="quoteContactNum" name="quoteContactNum" placeholder="Contact Number" autofocus maxlength="13">
                            </div>
                            <div class="form-group">
                                <label for="quoteEmail"><span class="fas fa-envelope"></span> E-mail Address</label>
                                <input type="email" class="form-control" id="quoteEmail" name="quoteEmail" placeholder="E-mail Address" maxlength="50">
                            </div>
                            <div class="form-group">
                                <label for="quoteCompanyName"><span class="far fa-building"></span> Company Name (if company sponsored)</label>
                                <input type="text" class="form-control" id="quoteCompanyName" name="quoteCompanyName" placeholder="Company Name" maxlength="50">
                            </div>
                            <div class="form-group">
                                <label for="quoteCourse"><span class="far fa-users-class"></span> Course</label>
                                <input type="text" class="form-control" id="quoteCourse" name="quoteCourse" placeholder="Course" autofocus maxlength="50">
                            </div>
                            <div class="form-group">
                                <label for="quoteSchedule"><span class="fas fa-calendar-week"></span> Schedule</label>
                                <input type="text" class="form-control" id="quoteSchedule" name="quoteSchedule" placeholder="Schedule" autofocus maxlength="50">
                            </div>
                            <div class="form-group">
                                <p class="h6">To see available course and schedule, <a href="">Click here</a></p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Submit</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--Register Modal-->
    <div class="modal fade" id="registerModal" role="dialog">
        <div class="modal-dialog modal-lg registerModal">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="padding:10px 10px;">
                    <h5 class="registration" style="font-size: 20px">Registration</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="registrationForm">
                    <div class="modal-body" style="padding:30px 50px;">
                        <div class="error-msg" style="display: none;"></div>
                        <div class="form-group">
                            <label for="registrationFname"><span class="fas fa-user-circle"></span> First Name</label>
                            <input type="text" class="form-control" id="registrationFname" name="registrationFname" placeholder="First Name" autofocus maxlength="30" minlength="2">
                        </div>
                        <div class="form-group">
                            <label for="registrationMname"><span class="fas fa-user-circle"></span> Middle Name</label>
                            <input type="text" class="form-control" id="registrationMname" name="registrationMname" placeholder="Middle Name" autofocus maxlength="30" minlength="2">
                        </div>
                        <div class="form-group">
                            <label for="registrationLname"><span class="fas fa-user-circle"></span> Last Name</label>
                            <input type="text" class="form-control" id="registrationLname" name="registrationLname" placeholder="Last Name" autofocus maxlength="30" minlength="2">
                        </div>
                        <div class="form-group">
                            <label for="registrationContactNum"><span class="fas fa-envelope"></span> Contact Number</label>
                            <input type="text" class="form-control" id="registrationContactNum" name="registrationContactNum" placeholder="Contact Number" maxlength="13">
                        </div>
                        <div class="form-group">
                            <label for="registrationCompanyName"><span class="fas fa-building"></span> Company Name</label>
                            <input type="text" class="form-control" id="registrationCompanyName" name="registrationCompanyName" placeholder="Company Name" maxlength="50">
                        </div>
                        <div class="form-group">
                            <label for="registrationEmail"><span class="fas fa-envelope"></span> E-mail Address</label>
                            <input type="email" class="form-control" id="registrationEmail" name="registrationEmail" placeholder="E-mail Address" maxlength="50">
                        </div>
                        <div class="form-group">
                            <label for="registrationUsername"><span class="fas fa-users"></span> Username</label>
                            <input type="text" class="form-control" id="registrationUsername" name="registrationUsername" placeholder="Username" maxlength="15" minlength="4">
                        </div>
                        <div class="form-group">
                            <label for="registrationPassword"><span class="fas fa-lock"></span> Password</label>
                            <input type="password" class="form-control" id="registrationPassword" name="registrationPassword" placeholder="Password" maxlength="30">
                        </div>
                        <div class="form-group">
                            <label for="registrationConfirmPassword"><span class="fas fa-lock"></span> Confirm Password</label>
                            <input type="password" class="form-control" id="registrationConfirmPassword" name="registrationConfirmPassword" placeholder="Confirm Password" maxlength="30">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Register</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--Email Us Modal-->
    <div class="modal fade" id="emailUsModal" role="dialog">
        <div class="modal-dialog loginModal">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" id="emailAnimation" style="padding:10px 10px;">
                    <h5 style="font-size: 20px">Email Nexus ITTC</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="error-msg" style="display: none;"></div>
                <form method="post" id="emailForm">
                    <div class="modal-body" style="padding:30px 50px;">
                        <div class="form-group">
                            <label for="emailFname"><span class="fas fa-user-circle"></span> First Name</label>
                            <input type="text" class="form-control" id="emailFname" name="emailFname" placeholder="First Name" autofocus maxlength="20">
                        </div>
                        <div class="form-group">
                            <label for="emailMnname"><span class="fas fa-user-circle"></span> Middle Name</label>
                            <input type="text" class="form-control" id="emailMnname" name="emailMnname" placeholder="Middle Name" autofocus maxlength="20">
                        </div>
                        <div class="form-group">
                            <label for="emailLname"><span class="fas fa-user-circle"></span> Last Name</label>
                            <input type="text" class="form-control" id="emailLname" name="emailLname" placeholder="Last Name" autofocus maxlength="20">
                        </div>
                        <div class="form-group">
                            <label for="emailAddress"><span class="fas fa-envelope"></span> E-mail Address</label>
                            <input type="email" class="form-control" id="emailAddress" name="emailAddress" placeholder="E-mail Address" maxlength="50">
                        </div>
                        <div class="form-group">
                            <label for="emailMsg"><span class="fas fa-comments"></span> Message</label>
                            <textarea class="form-control" id="emailMsg" name="emailMsg" rows="7" placeholder="Type your message here."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- SCRIPTS -->

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/be76a30cc4.js" crossorigin="anonymous"></script>
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script src="js/homepage.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {

            $("a").click(function() {
                $("a").css("color", "");
                $(this).css("color", "#FFFFFF");
            });

            $(window).scroll(function() {
                var scroll = $(window).scrollTop();
                if (scroll > 20) {
                    $("#nav").css("background-color", "black", "opacity", "90%");
                } else {
                    $("#nav").css("background-color", "transparent");
                }
            });
        });
    </script>

</body>

</html>