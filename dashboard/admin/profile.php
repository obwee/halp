<?php
require_once "template/header.php";
echo Session::get('LOA') === 'Super Admin' ? "<script type='text/javascript'>window.history.back();</script>" : '';
?>

<div class="container">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <p class="h2">My Profile</p>
    </div>
    <div class="row" style="background-color: white;border-radius:8px 8px;margin-left: 10px;margin-right:10px;padding-top:10px;">
        <div class="col-sm-6" style="padding-left:30px;padding-right:30px;">
            <form>
                <div class="form-group row">
                    <label for="firstName">First Name</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span> 
                        </div>
                        <input type="text" class="form-control" id="firstName">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="middleName">Middle Name</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span> 
                        </div>
                        <input type="text" class="form-control" id="middleName">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="lastName">Last Name</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span> 
                        </div>
                        <input type="text" class="form-control" id="lastName">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="contactNo">Contact Number</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span> 
                        </div>
                        <input type="text" class="form-control" id="contactNo">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email">E-mail Address</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-at"></i></span> 
                        </div>
                        <input type="email" class="form-control" id="email">
                    </div>
                </div>
            </form>
        </div>

        <div class="col-sm-6" style="padding-left:30px;padding-right:30px;">
            <form>
                <div class="form-group row">
                    <label for="username">Username</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span> 
                        </div>
                        <input type="text" class="form-control" id="username">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password">Password</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user-lock"></i></span> 
                        </div>
                        <input type="password" class="form-control" id="password">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password">Confirm Password</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span> 
                        </div>
                        <input type="password" class="form-control" id="password">
                    </div>
                </div>
                </div> <br>
            </form>
        </div>
    </div>

    <div class="text-center" style="margin-top:10px;">
        <button type="submit" class="btn btn-dark">&nbsp&nbsp&nbsp&nbspEdit&nbsp&nbsp&nbsp</button>
        <button type="submit" class="btn btn-success">Update</button>
    </div>
</div>

<?php
require_once "template/scripts.php";
?>

<script src="student/js/studentDash.Enrollment.js"></script>

<?php
require_once "template/studentFooter.php";
?>