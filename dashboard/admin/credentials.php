<?php
require_once "template/header.php";
echo Session::get('LOA') !== 'Super Admin' ? "<script type='text/javascript'>window.history.back();</script>" : '';
?>

<div class="container">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <p class="h2">Credentials</p>
    </div>

    <div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
        <div class="float-right">
            <button type="button" id="editPersonalDetails" data-toggle="modal" data-target="#editPersonalDetailsModal" class="btn btn-primary"><i class="fas fa-user-edit"></i> Edit Personal Details</button>
            <button type="button" id="editOwnCredentials" data-toggle="modal" data-target="#editOwnCredentialsModal" class="btn btn-warning"><i class="fas fa-edit"></i> Edit Credentials</button>
            <button type="button" id="addNewAdmin" data-toggle="modal" data-target="#addNewAdminModal" class="btn btn-secondary"><i class="fas fa-plus-circle"></i> Add New Admin</button>
            <br><br>
        </div>
        <table id="tbl_admin" style="width:100%" class="table table-striped table-bordered table-hover table-responsive-sm">
            <thead></thead>
            <tbody></tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="editPersonalDetailsModal" role="dialog">
    <div class="modal-dialog editPersonalDetails">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #3c8dbc;">
                <h5 align="center" style="color:white;"><i class="fas fa-edit"></i> Edit Personal Details</h5>
            </div>
            <form id="editPersonalDetailsForm" method="post">
                <div class="modal-body">
                    <input type="text" class="adminId" name="adminId" readonly hidden>
                    <div class="alert alert-danger error-msg" role="alert" style="display: none;"></div>
                    <div class="form-group">
                        <label for="adminFirstName"><span class="fas fa-id-card"></span> First Name</label>
                        <input type="text" class="form-control adminFirstName" name="adminFirstName" placeholder="First Name" autofocus maxlength="20">
                    </div>
                    <div class="form-group">
                        <label for="adminMiddleName"><span class="fas fa-id-card"></span> Middle Name</label>
                        <input type="text" class="form-control adminMiddleName" name="adminMiddleName" placeholder="Middle Name" maxlength="20">
                    </div>
                    <div class="form-group">
                        <label for="adminLastName"><span class="fas fa-id-card"></span> Last Name</label>
                        <input type="text" class="form-control adminLastName" name="adminLastName" placeholder="Last Name" maxlength="20">
                    </div>
                    <div class="form-group">
                        <label for="adminEmail"><span class="fas fa-envelope"></span> E-mail Address</label>
                        <input type="email" class="form-control adminEmail" name="adminEmail" placeholder="E-mail Address" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label for="adminContact"><span class="fas fa-phone"></span> Contact Number</label>
                        <input type="text" class="form-control adminContact" name="adminContact" placeholder="Contact Number" maxlength="11">
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <div class="spinner-border spinner" role="status" style="display:none;">
                        <span class="sr-only">Loading...</span>
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

<div class="modal fade" id="editOwnCredentialsModal" role="dialog">
    <div class="modal-dialog editOwnCredentials">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #3c8dbc;">
                <h5 align="center" style="color:white;"><i class="fas fa-edit"></i> Edit Own Credentials</h5>
            </div>
            <form id="editOwnCredentialsForm" method="post">
                <div class="modal-body">
                    <input type="text" class="adminId" name="adminId" readonly hidden>
                    <div class="alert alert-danger error-msg" role="alert" style="display: none;"></div>
                    <div class="form-group">
                        <label for="adminUsername"><span class="fas fa-user-tag"></span> Username</label>
                        <input type="text" class="form-control adminUsername" name="adminUsername" placeholder="Username" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label for="adminPassword"><span class="fas fa-lock"></span> Password</label>
                        <input type="password" class="form-control adminPassword" name="adminPassword" placeholder="Password" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label for="adminConfirmPassword"><span class="fas fa-lock"></span> Confirm Password</label>
                        <input type="password" class="form-control adminConfirmPassword" name="adminConfirmPassword" placeholder="Confirm Password" maxlength="50">
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <div class="spinner-border spinner" role="status" style="display:none;">
                        <span class="sr-only">Loading...</span>
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
                    <div class="alert alert-danger error-msg" role="alert" style="display: none;"></div>
                    <div class="form-group">
                        <label for="adminFirstName"><span class="fas fa-id-card"></span> First Name</label>
                        <input type="text" class="form-control adminFirstName" name="adminFirstName" placeholder="First Name" autofocus maxlength="20">
                    </div>
                    <div class="form-group">
                        <label for="adminMiddleName"><span class="fas fa-id-card"></span> Middle Name</label>
                        <input type="text" class="form-control adminMiddleName" name="adminMiddleName" placeholder="Middle Name" maxlength="20">
                    </div>
                    <div class="form-group">
                        <label for="adminLastName"><span class="fas fa-id-card"></span> Last Name</label>
                        <input type="text" class="form-control adminLastName" name="adminLastName" placeholder="Last Name" maxlength="20">
                    </div>
                    <div class="form-group">
                        <label for="adminEmail"><span class="fas fa-envelope"></span> E-mail Address</label>
                        <input type="email" class="form-control adminEmail" name="adminEmail" placeholder="E-mail Address" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label for="adminContact"><span class="fas fa-phone"></span> Contact Number</label>
                        <input type="text" class="form-control adminContact" name="adminContact" placeholder="Contact Number" maxlength="11">
                    </div>
                    <div class="form-group">
                        <label for="adminUsername"><span class="fas fa-user-tag"></span> Username</label>
                        <input type="text" class="form-control adminUsername" name="adminUsername" placeholder="Username" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label for="adminPassword"><span class="fas fa-lock"></span> Password</label>
                        <input type="password" class="form-control adminPassword" name="adminPassword" placeholder="Password" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label for="adminConfirmPassword"><span class="fas fa-lock"></span> Confirm Password</label>
                        <input type="password" class="form-control adminConfirmPassword" name="adminConfirmPassword" placeholder="Confirm Password" maxlength="50">
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <div class="spinner-border spinner" role="status" style="display:none;">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Add</button>
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editAdminModal" role="dialog">
    <div class="modal-dialog editAdmin">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #3c8dbc;">
                <h5 align="center" style="color:white;"><i class="fas fa-plus"></i> Edit Admin Credentials</h5>
            </div>
            <form id="editAdminForm" method="post">
                <div class="modal-body">
                    <input type="text" class="adminId" name="adminId" readonly hidden>
                    <div class="alert alert-danger error-msg" role="alert" style="display: none;"></div>
                    <div class="form-group">
                        <label for="adminFirstName"><span class="fas fa-id-card"></span> First Name</label>
                        <input type="text" class="form-control adminFirstName" name="adminFirstName" placeholder="First Name" autofocus maxlength="20">
                    </div>
                    <div class="form-group">
                        <label for="adminMiddleName"><span class="fas fa-id-card"></span> Middle Name</label>
                        <input type="text" class="form-control adminMiddleName" name="adminMiddleName" placeholder="Middle Name" maxlength="20">
                    </div>
                    <div class="form-group">
                        <label for="adminLastName"><span class="fas fa-id-card"></span> Last Name</label>
                        <input type="text" class="form-control adminLastName" name="adminLastName" placeholder="Last Name" maxlength="20">
                    </div>
                    <div class="form-group">
                        <label for="adminEmail"><span class="fas fa-envelope"></span> E-mail Address</label>
                        <input type="email" class="form-control adminEmail" name="adminEmail" placeholder="E-mail Address" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label for="adminContact"><span class="fas fa-phone"></span> Contact Number</label>
                        <input type="text" class="form-control adminContact" name="adminContact" placeholder="Contact Number" maxlength="11">
                    </div>
                    <div class="form-group">
                        <label for="adminUsername"><span class="fas fa-user-tag"></span> Username</label>
                        <input type="text" class="form-control adminUsername" name="adminUsername" placeholder="Username" maxlength="50">
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <div class="spinner-border spinner" role="status" style="display:none;">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Update</button>
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
require_once "template/scripts.php";
?>

<script src="/Nexus/utils/js/utils.Libraries.js"></script>
<script src="/Nexus/utils/js/utils.Validations.js"></script>
<script src="/Nexus/utils/js/utils.Forms.js"></script>

<script src="/Nexus/dashboard/js/admin/dashboard.credentials.js"></script>

<?php
require_once "template/footer.php";
?>