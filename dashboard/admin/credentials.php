<?php
require_once "template/header.php";
echo Session::get('LOA') !== 'Super Admin' ? "<script type='text/javascript'>window.history.back();</script>" : '';
?>

<div class="container">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <p class="h2">Credentials</p>
    </div>

    <div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
        <div align="right">
            <button type="button" id="addNewBranch" data-toggle="modal" data-target="#editCredentialsModal" class="btn btn-primary"><i class="fas fa-edit"></i> Edit My Credentials</button>
            <button type="button" id="addNewBranch" data-toggle="modal" data-target="#addNewAdminModal" class="btn btn-secondary"><i class="fas fa-plus"></i> Add New Admin</button>
            <br><br>
        </div>
        <table id="tbl_admin" style="width:100%" class="table table-striped table-bordered table-hover table-responsive-sm">
            <thead>
                <tr>
                    <th style="white-space:nowrap;">Full Name</th>
                    <th style="white-space:nowrap;">Username</th>
                    <th style="white-space:nowrap;">Account Type</th>
                    <th style="white-space:nowrap;">E-mail Address</th>
                    <th style="white-space:nowrap;">Contact Number</th>
                    <th style="white-space:nowrap;">Actions</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="editCredentialsModal" role="dialog">
    <div class="modal-dialog editCredentials">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #3c8dbc;">
                <h5 align="center" style="color:white;"><i class="fas fa-edit"></i> Edit Credentials</h5>
            </div>
            <form id="editCredentialsForm" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="firstName"><span class="fas fa-id-card"></span> First Name</label>
                        <input type="text" class="form-control" id="firstName" name="firstname" placeholder="First Name" autofocus maxlength="20">
                    </div>
                    <div class="form-group">
                        <label for="middleName"><span class="fas fa-id-card"></span> Middle Name</label>
                        <input type="text" class="form-control" id="middleName" name="middleName" placeholder="Middle Name" maxlength="20">
                    </div>
                    <div class="form-group">
                        <label for="lastName"><span class="fas fa-id-card"></span> Last Name</label>
                        <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last Name" maxlength="20">
                    </div>
                    <div class="form-group">
                        <label for="adminEmail"><span class="fas fa-envelope"></span> E-mail Address</label>
                        <input type="email" class="form-control" id="adminEmail" name="adminEmail" placeholder="E-mail Address" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label for="adminContact"><span class="fas fa-phone"></span> Contact Number</label>
                        <input type="text" class="form-control" id="adminContact" name="adminContact" placeholder="Contact Number" maxlength="11">
                    </div>
                    <div class="form-group">
                        <label for="adminUsername"><span class="fas fa-users"></span> Username</label>
                        <input type="text" class="form-control" id="instructorUsername" name="adminUsername" placeholder="Username" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label for="adminPassword"><span class="fas fa-lock"></span> Password</label>
                        <input type="password" class="form-control" id="adminPassword" name="adminPassword" placeholder="Password" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label for="adminPassword"><span class="fas fa-lock"></span> Confirm Password</label>
                        <input type="password" class="form-control" id="adminPassword" name="adminPassword" placeholder="Password" maxlength="50">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="submit" class="btn btn-success">Update</button>
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="addNewAdminModal" role="dialog">
    <div class="modal-dialog addNewAdmin">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #3c8dbc;">
                <h5 align="center" style="color:white;"><i class="fas fa-plus"></i> Add New Admin</h5>
            </div>
            <form id="addNewAdminForm" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="firstName"><span class="fas fa-id-card"></span> First Name</label>
                        <input type="text" class="form-control" id="firstName" name="branch" placeholder="First Name" autofocus maxlength="20">
                    </div>
                    <div class="form-group">
                        <label for="middleName"><span class="fas fa-id-card"></span> Middle Name</label>
                        <input type="text" class="form-control" id="middleName" name="middleName" placeholder="Middle Name" maxlength="20">
                    </div>
                    <div class="form-group">
                        <label for="lastName"><span class="fas fa-id-card"></span> Last Name</label>
                        <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last Name" maxlength="20">
                    </div>
                    <div class="form-group">
                        <label for="adminEmail"><span class="fas fa-envelope"></span> E-mail Address</label>
                        <input type="email" class="form-control" id="adminEmail" name="adminEmail" placeholder="E-mail Address" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label for="adminContact"><span class="fas fa-phone"></span> Contact Number</label>
                        <input type="text" class="form-control" id="adminContact" name="adminContact" placeholder="Contact Number" maxlength="11">
                    </div>
                    <div class="form-group">
                        <label for="adminUsername"><span class="fas fa-users"></span> Username</label>
                        <input type="text" class="form-control" id="instructorUsername" name="instructorUsername" placeholder="Username" maxlength="50">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success">Add</button>
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
require_once "template/scripts.php";
?>

<script src="/Nexus/dashboard/js/admin/dashboard.credentials.js"></script>

<?php
require_once "template/footer.php";
?>