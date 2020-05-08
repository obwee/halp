    <?php
    require_once "template/studentHeader.php";
    ?>


    	<div class="container">
    		<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    			<p class="h2">My Profile</p>
    		</div>
            <div class="row">
                <div class="col-sm-6">
                <div style="background-color: white;border-radius:8px 8px;margin-left: 5px;margin-right:5px;padding:25px 25px;height: 420px;box-shadow: 8px 8px #605ca8;">
                    <h4 class="lead"><i class="fas fa-user-cog"></i> Personal Details</h4>
                    <form>
                        <div class="form-group row">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span> 
                                </div>
                                <input type="text" class="form-control" id="firstName" value="First Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span> 
                                </div>
                                <input type="text" class="form-control" id="middleName" value="Middle Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span> 
                                </div>
                                <input type="text" class="form-control" id="lastName" value="Last Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span> 
                                </div>
                                <input type="text" class="form-control" id="contactNo" value="Contact Number">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-at"></i></span> 
                                </div>
                                <input type="email" class="form-control" id="email" value="E-mail Address">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-building"></i></span> 
                                </div>
                                <input type="text" class="form-control" id="company" value="Company Name">
                            </div>
                        </div>
                         <div class="text-center" style="margin-top:10px;">
                            <button type="submit" class="btn btn-success btn-sm">Update</button>
                        </div>
                    </form>
                </div> 
            </div>
            
            <div class="col-sm-6">
                <div style="background-color: white;border-radius:8px 8px;margin-left: 5px;margin-right:5px;padding:25px 25px;height: 420px;box-shadow: 8px 8px #605ca8;">
                    <h4 class="lead"><i class="fas fa-user-shield"></i> Login Credentials</h4>
                    <form>
                        <div class="form-group row">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span> 
                                </div>
                                <input type="text" class="form-control" id="email" value="Username">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span> 
                                </div>
                                <input type="text" class="form-control" id="email" value="Old Password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span> 
                                </div>
                                <input type="text" class="form-control" id="email" value="New Password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span> 
                                </div>
                                <input type="text" class="form-control" id="email" value="Confirm New Password">
                            </div>
                        </div>
                        <div class="text-center" style="margin-top:120px;">
                            <button type="submit" class="btn btn-success btn-sm">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
                           

                <?php
                require_once "template/scripts.php";
                ?>

                <script src="student/js/studentDash.Enrollment.js"></script>


                <?php
                require_once "template/studentFooter.php";
                ?>