<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="course.css">
    <link rel="stylesheet" type="text/css" href="css/animate.css-master/animate.css">
    <!--==============================================================================================-->
    <link href="https://fonts.googleapis.com/css?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:800&display=swap" rel="stylesheet">

        <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/be76a30cc4.js" crossorigin="anonymous"></script>
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script src="js/homepage.js"></script>

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
                    <li><a href="../welcome.php">Home</a></li>
                    <!--====================================================================================-->
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown">Courses<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-header">Cisco</li>
                            <li class="dd-content"><a href="ccnav4.php">CCNA v4 200-301</a></li>
                            <li class="dd-content"><a href="encore.php">CCNP & CCIE Enterprise Core</a></li>
                            <li class="dd-content"><a href="#">CCNP - Implementing Cisco Enterprise Advanced Routing and Services (ENARSI)</a></li>

                            <li class="dropdown-header">Microsoft</li>
                            <li class="dd-content"><a href="mcp.php">20410 MCP in Windows Server 2012</a></li>
                            <li class="dd-content"><a href="mcsa2012.php">MCSA 2012</a></li>
                            <li class="dd-content"><a href="#">MCSA 2016</a></li>
                            <li class="dd-content"><a href="azure.php">Azure Administrator</a></li>

                            <li class="dropdown-header">Amazon Web Services</li>
                            <li class="dd-content"><a href="#">AWS Solutions Architect</a></li>

                            <li class="dropdown-header">VMWare</li>
                            <li class="dd-content"><a href="vmware.php">VMWare vSphere 6.0 ICM</a></li>

                            <li class="dropdown-header">Cybersecurity</li>
                            <li class="dd-content"><a href="eh.php">Ethical Hacking and Penetration Testing</a></li>
                            <li class="dd-content"><a href="cysA.php">Cybersecurity Analyst+</a></li>
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
                        <div class="alert alert-danger error-msg" role="alert" style="display: none;"></div>
                        <form method="post" id="quotationForm">

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
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Submit</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!--Email Us Modal-->
        <div class="modal fade" id="emailUsModal" role="dialog">
            <div class="modal-dialog loginModal">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header" id="emailAnimation" style="padding:10px 10px;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h5 style="font-size: 20px; text-align: center; font-family:sans-serif;">Email Nexus ITTC</h5>
                    </div>
                    <div class="alert alert-danger error-msg" role="alert" style="display: none;"></div>
                    <form method="post" id="emailForm">
                        <div class="modal-body" style="padding:30px 50px;">
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
</body>
</html>