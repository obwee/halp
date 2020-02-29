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
                    <li><a href="courses.php" target="_blank">Courses</a></li>
                    <!--    <li class="dropdown">
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
                </li> -->

                    <li><a href="#services">Services</a></li>
                    <li><a href="" data-toggle="modal" data-target="#getQuoteModal">Get Quote</a></li>
                    <li><a href="" data-toggle="modal" data-target="#emailUsModal">Email Us</a></li>
                    <li><a href="#contact">Contact</a></li>
                    <li><a href="#faqs">FAQs</a></li>
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
                    <br>
                    <p class="lead">Providing trainings for IT professionals and beginners, Nexus continues to solidify its industry leadership position in producing quality training for the largest technologies and business trainings.</p>
                    <br>
                    <p class="lead">Nexus ITTC provides IT Training and offers bootcamps for Cisco, Microsoft, VMWare, Citrix and more. Nexus trains interested students in their chosen field to learn more and earn more through the advanced and innovative teaching process with the latest devices and certified instructors.</p>
                </div>
            </div>
        </div>
    </div>



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

    <div id="fixed"></div>

    <div class="padding" style="background-color: #edbb00;" id="faqs">
        <div class="faq-header">
            <h2 style="text-align: center;">FREQUENTLY ASKED QUESTIONS</h2>
        </div>
        <div class="container">
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true" style="width: 100%;">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <i class="fas fa-question-circle"></i> What are the available course and schedules?
                            </a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                            To view available course and schedule, click the <strong>COURSES</strong> tab on the navigation bar or <a href="courses.php" target="_blank">click this link.</a>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingTwo">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                <i class="fas fa-question-circle"></i> How do I request for an invoice or quotation?
                            </a>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                        <div class="panel-body">
                            <ul>
                                <li>Choose a course from the <strong>COURSES</strong> tab and select the <strong>GET QUOTE</strong> tab.</li>
                                <li>Make sure to fill in all details required and submit your request.</li>
                                <li>Invoice will be sent to your provided e-mail within the day.</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingThree">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                <i class="fas fa-question-circle"></i> How to enroll?
                            </a>
                        </h4>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                        <div class="panel-body">
                            <ul>
                                <li>Click the <strong>SIGN UP</strong> button and create an account.</li>
                                <li>Once signed in, click the <strong>Enrollment</strong> tab choose your desired course and schedule.</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingThree">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                <i class="fas fa-question-circle"></i> What are the payment modes?
                            </a>
                        </h4>
                    </div>
                    <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                        <div class="panel-body">
                            <ul>
                                <li><strong>CASH</strong></li>
                                <ul>
                                    Pay at any of our branches:
                                    <li><strong>MAKATI: </strong>Unit 2417 24th Floor Cityland 10 Tower 2 154 H.V. Dela Costa St Ayala North, Makati City</li>
                                    <li><strong>MANILA: </strong>Room 401 Dona Amparo Bldg Along Espana Boulevard corner Tolentino St Espana, Manila</li>
                                </ul>

                                <br>

                                <li><strong>BDO Bank Deposit / Online Bank Transfer</strong></li>
                                <br>
                                <ul>
                                    <li>Account Name: Nexus IT Training Center</li>
                                    <li>BDO Account Number: 002810078994</li>
                                </ul>

                                <br>
                                <li><strong>CHEQUE</strong></li>
                                <ul>
                                    <li>All cheque payments must be payable to <b>NEXUS IT TRAINING CENTER.</b></li>
                                </ul>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingFive">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                <i class="fas fa-question-circle"></i> Do you accept payment via installment basis?
                            </a>
                        </h4>
                    </div>
                    <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
                        <div class="panel-body">
                            <strong style="color: green;">YES!</strong> A <strong>50%</strong> reservation fee is required to secure your slot.
                            <br>
                            NOTE: All balance must be paid on or before the first day of training.
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingSix">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                <i class="fas fa-question-circle"></i> How do I pay for my reservation?
                            </a>
                        </h4>
                    </div>
                    <div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix">
                        <div class="panel-body">
                            Choose a payment mode. <br>
                            Once you have paid you reservation, upload a photo or a PDF copy of your payment to your account under the <strong>Enrollment</strong> tab together with the invoice. <br>

                            Make sure that you have read the terms and conditions and sign your invoice before proceeding to payment.
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingSeven">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                <i class="fas fa-question-circle"></i> Do you acknowledge refunds?
                            </a>
                        </h4>
                    </div>
                    <div id="collapseSeven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSeven">
                        <div class="panel-body">
                            Cancellation of reservations must be done <b>1 week</b> before the training starts. Please give us a week to process your refund. <br>

                            <strong style="color: red;">NO REFUND</strong> once the training has already started.
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingEight">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                <i class="fas fa-question-circle"></i> Do I need to bring my own laptop to class?
                            </a>
                        </h4>
                    </div>
                    <div id="collapseEight" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingEight">
                        <div class="panel-body">
                            Desktops, routers, switches and other devices are provided by the training center.
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>



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
                    <form method="post" id="quotationForm">
                        <div class="alert alert-danger error-msg" role="alert" style="display: none;"></div>
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
                            <input type="text" class="form-control" id="quoteContactNum" name="quoteContactNum" placeholder="Contact Number" autofocus maxlength="12">
                        </div>
                        <div class="form-group">
                            <label for="quoteEmail"><span class="fas fa-envelope"></span> E-mail Address</label>
                            <input type="email" class="form-control" id="quoteEmail" name="quoteEmail" placeholder="E-mail Address" maxlength="50">
                        </div>
                        <div class="form-group">
                            <label for="quoteCompanyName"><span class="far fa-building"></span> Company Name</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Company Name" name="quoteCompanyName" id="quoteCompanyName" maxlength="50" aria-describedby="basic-addon2">
                                <span class="input-group-addon" id="basic-addon2">
                                    <input type="checkbox" name="quoteBillToCompany" id="quoteBillToCompany"> Bill to Company?</span>
                            </div>
                        </div>
                        <div class="courseAndScheduleDiv" style="display: none;">
                            <div class="form-group">
                                <label for="quoteCourse"><span class="fas fa-book"></span> Course</label>
                                <select class="form-control quoteCourse" name="quoteCourse[]">
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="quoteSchedule"><span class="fas fa-calendar-week"></span> Schedule</label>
                                <select class="form-control quoteSchedule" name="quoteSchedule[]" disabled>
                                    <option value="" selected disabled hidden>Select Course First</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="numPax"><span class="fas fa-user-friends"></span> PAX</label>
                                <input type="number" class="form-control numPax" placeholder="Number of Persons" name="numPax[]" id="numPax" min="1" max="100" value="1">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12 text-center">
                                    <button type="button" class="btn btn-primary addCourseBtn">Add New Course</button>
                                </div>
                                <div class="col-sm-6 text-left" style="display: none;">
                                    <button type="button" class="btn btn-warning deleteCourseBtn">&nbsp;&nbsp;&nbsp;Delete Course&nbsp;&nbsp;&nbsp;</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <p class="h6">To see available course and schedule, <a href="courses.php" target="_blank">Click here</a></p>
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
        <div class="modal-dialog registerModal">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 style="font-size: 20px; text-align: center; font-family:sans-serif;">Registration</h5>
                </div>
                <form method="post" id="registrationForm">
                    <div class="modal-body" style="padding:30px 50px;">
                        <div class="alert alert-danger error-msg" role="alert" style="display: none;"></div>
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

            <div class="modal-content">
                <div class="modal-header" id="emailAnimation" style="padding:10px 10px;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 style="font-size: 20px; text-align: center; font-family:sans-serif;">Email Nexus ITTC</h5>
                </div>
                <form method="post" id="emailForm">
                    <div class="modal-body" style="padding:30px 50px;">
                        <div class="alert alert-danger error-msg" role="alert" style="display: none;"></div>
                        <div class="form-group">
                            <label for="emailFname"><span class="fas fa-user-circle"></span> First Name</label>
                            <input type="text" class="form-control" id="emailFname" name="emailFname" placeholder="First Name" autofocus maxlength="20">
                        </div>
                        <div class="form-group">
                            <label for="emailMname"><span class="fas fa-user-circle"></span> Middle Name</label>
                            <input type="text" class="form-control" id="emailMname" name="emailMname" placeholder="Middle Name" autofocus maxlength="20">
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
                            <label for="emailTitle"><span class="fas fa-envelope-open-text"></span> Email Title</label>
                            <input type="text" class="form-control" id="emailTitle" name="emailTitle" placeholder="Email Title" autofocus maxlength="20">
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

    <!--SCRIPTS-->
    <!--Font Awesome-->
    <script src="https://kit.fontawesome.com/be76a30cc4.js" crossorigin="anonymous"></script>
    <!--jQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!--Bootstrap-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!--Sweet Alert-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script src="js/homepage.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {

            $("a").click(function() {
                $("a").css("color", "");
                $(this).css("color", "#edbb00");
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