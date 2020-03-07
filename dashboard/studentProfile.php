<?php
require_once "template/studentHeader.php";
?>


	<div class="container">
		<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
			<p class="h2">My Profile</p>
		</div>
        <div class="row">
            <div class="col-sm-6">
                <form>
                    <div class="form-group row">
                    <label for="firstName" class="col-sm-3 col-form-label"><span class="fas fa-user"></span> First Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="firstName">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="middleName" class="col-sm-3 col-form-label"><span class="fas fa-user"></span> Middle Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="middleName">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lastName" class="col-sm-3 col-form-label"><span class="fas fa-user"></span> Last Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="lastName">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="contact" class="col-sm-3 col-form-label"><span class="fas fa-mobile-alt"></span> Contact No.</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="contact">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label"><span class="fas fa-at"></span> E-mail</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" id="email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="company" class="col-sm-3 col-form-label"><span class="fas fa-building"></span> Company</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="company">
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-sm-6">
                <form>
                    <div class="credentials" style="border-style:solid;border-width:1px;border-color:#d5d5d5;padding:10px 10px;">
                        <div class="form-group row">
                            <label for="username" class="col-sm-4 col-form-label"><span class="fas fa-user"></span> Username</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="username">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-sm-4 col-form-label"><span class="fas fa-user-lock"></span> Password</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="confirmPassword" class="col-sm-4 col-form-label"><span class="fas fa-user-lock"></span> Confirm Password</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="confirmPassword">
                            </div>
                        </div>
                    </div> <br>
                    <div align="center">
                        <button type="submit" class="btn btn-dark">Edit</button>
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div> 


            
              
        

    
    

    <div class="modal fade" id="messageInstructorModal" role="dialog">
        <div class="modal-dialog modal-lg messageInstructorModal">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #A2C710;">
                    <h5 align="center">Send a Message</h5>
                </div>
                
                <div class="modal-body">
                    <div class="form-group">
                        <label for="subjectQuote"><span class="fas fa-envelope"></span> Subject</label>
                        <input type="text" class="form-control" id="subjectQuote" name="subjectQuote" placeholder="Subject" autofocus maxlength="30">
                    </div>
                    <div class="form-group">
                        <label for=quoteMessage><span class="fas fa-envelope-open-text"></span> Message</label>
                        <textarea class="form-control" id="emailMsg" name="emailMsg" rows="10" placeholder="Type your message here."></textarea>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFile">
                        <label class="custom-file-label" for="customFile">Upload File</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success">Send</button>
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

   
<?php
require_once "template/scripts.php";
?>

<script src="js/studentDash.Enrollment.js"></script>

<?php
require_once "template/studentFooter.php";
?>