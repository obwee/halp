<?php
require_once "template/header.php";
echo Session::get('LOA') === 'Super Admin' ? "<script type='text/javascript'>window.history.back();</script>" : '';
?>

<div class="container">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <p class="h2">My Profile</p>
        <div class="alert alert-danger error-msg" role="alert" style="display: none;"></div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div style="background-color: white;border-radius:8px 8px;margin-left: 5px;margin-right:5px;padding:25px 25px;height: 375px;box-shadow: 8px 8px #3c8dbc;">
                    <h4 class="lead"><i class="fas fa-user-cog"></i> Personal Details</h4>
                    <form id="personalDetailsForm">
                        <div class="form-group row">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" class="form-control" id="middleName" name="middleName" placeholder="Middle Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                                </div>
                                <input type="text" class="form-control" id="contactNum" name="contactNum" placeholder="Contact Number">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-at"></i></span>
                                </div>
                                <input type="email" class="form-control" id="email" name="email" placeholder="E-mail Address">
                            </div>
                        </div>
                        <div class="text-center" style="margin-top:10px;">
                            <button type="submit" class="btn btn-success btn-sm">Update</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-sm-6">
                <div style="background-color: white;border-radius:8px 8px;margin-left: 5px;margin-right:5px;padding:25px 25px;height: 375px;box-shadow: 8px 8px #3c8dbc;">
                    <h4 class="lead"><i class="fas fa-user-shield"></i> Login Credentials</h4>
                    <form id="loginCredentialsForm">
                        <div class="form-group row">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                </div>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Old Password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                </div>
                                <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="New Password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                </div>
                                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm New Password">
                            </div>
                        </div>
                        <div class="text-center" style="margin-top:70px;">
                            <button type="submit" class="btn btn-success btn-sm">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once "template/scripts.php";
?>

<script src="/Nexus/utils/js/utils.Libraries.js"></script>
<script src="/Nexus/utils/js/utils.Validations.js"></script>
<script src="/Nexus/utils/js/utils.Forms.js"></script>

<script src="/Nexus/dashboard/js/admin/dashboard.profile.js"></script>

<?php
require_once "template/footer.php";
?>