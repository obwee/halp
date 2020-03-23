<?php
require_once "Template/header.php";
?>

<div class="container">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <p class="h2">Instructors</p>
    </div>

    <div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
        <div align="right">
            <button type="button" id="addNewBranch" data-toggle="modal" data-target="#addNewInstructorModal" class="btn btn-info btn-lg">Add New Instructor</button>
            <br><br>
        </div>
        <table id="tbl_instructors" style="width:100%" class="table table-striped table-bordered table-hover table-responsive-sm">
            <thead></thead>
            <tbody></tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="addNewInstructorModal" role="dialog">
    <div class="modal-dialog addNewInstructorModal">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #A2C710;">
                <h5 align="center">Add New Instructor</h5>
            </div>
            <form method="POST" id="addInstructorForm">
                <div class="modal-body">
                    <div class="alert alert-danger error-msg" role="alert" style="display: none;"></div>
                    <div class="form-group">
                        <label for="firstName"><span class="fas fa-id-card"></span> First Name</label>
                        <input type="text" class="form-control firstName" name="firstName" placeholder="First Name" autofocus maxlength="20">
                    </div>
                    <div class="form-group">
                        <label for="middleName"><span class="fas fa-id-card"></span> Middle Name</label>
                        <input type="text" class="form-control middleName" name="middleName" placeholder="Middle Name" maxlength="20">
                    </div>
                    <div class="form-group">
                        <label for="lastName"><span class="fas fa-id-card"></span> Last Name</label>
                        <input type="text" class="form-control lastName" name="lastName" placeholder="Last Name" maxlength="20">
                    </div>
                    <div class="form-group">
                        <label for="email"><span class="fas fa-envelope"></span> E-mail Address</label>
                        <input type="email" class="form-control email" name="email" placeholder="E-mail Address" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label for="contactNum"><span class="fas fa-phone"></span> Contact Number</label>
                        <input type="text" class="form-control contactNum" name="contactNum" placeholder="Contact Number" maxlength="11">
                    </div>
                    <div class="form-group">
                        <label for="certificationTitle"><span class="fas fa-certificate"></span> Certification Title</label>
                        <input type="text" class="form-control certificationTitle" name="certificationTitle" placeholder="Vendor Certification" maxlength="50">
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

<div class="modal fade" id="editInstructorModal" role="dialog">
    <div class="modal-dialog editInstructorModal">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #A2C710;">
                <h5 align="center">Edit Instructor</h5>
            </div>
            <form method="POST" id="editInstructorForm">
                <div class="modal-body">
                    <input type="text" class="instructorId" name="instructorId" readonly hidden>
                    <div class="alert alert-danger error-msg" role="alert" style="display: none;"></div>
                    <div class="form-group">
                        <label for="firstName"><span class="fas fa-id-card"></span> First Name</label>
                        <input type="text" class="form-control firstName" name="firstName" placeholder="First Name" autofocus maxlength="20">
                    </div>
                    <div class="form-group">
                        <label for="middleName"><span class="fas fa-id-card"></span> Middle Name</label>
                        <input type="text" class="form-control middleName" name="middleName" placeholder="Middle Name" maxlength="20">
                    </div>
                    <div class="form-group">
                        <label for="lastName"><span class="fas fa-id-card"></span> Last Name</label>
                        <input type="text" class="form-control lastName" name="lastName" placeholder="Last Name" maxlength="20">
                    </div>
                    <div class="form-group">
                        <label for="email"><span class="fas fa-envelope"></span> E-mail Address</label>
                        <input type="email" class="form-control email" name="email" placeholder="E-mail Address" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label for="contactNum"><span class="fas fa-phone"></span> Contact Number</label>
                        <input type="text" class="form-control contactNum" name="contactNum" placeholder="Contact Number" maxlength="11">
                    </div>
                    <div class="form-group">
                        <label for="certificationTitle"><span class="fas fa-certificate"></span> Certification Title</label>
                        <input type="text" class="form-control certificationTitle" name="certificationTitle" placeholder="Vendor Certification" maxlength="50">
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

<div class="modal fade" id="messageInstructorModal" role="dialog">
    <div class="modal-dialog modal-lg messageInstructorModal">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #A2C710;">
                <h5 align="center">Send a Message</h5>
            </div>
            <form action="POST" id="messageInstructorForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title"><span class="fas fa-envelope"></span> Subject</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Subject" autofocus maxlength="30">
                    </div>
                    <div class="form-group">
                        <label for='msg'><span class="fas fa-envelope-open-text"></span> Message</label>
                        <textarea class="form-control" id="msg" name="msg" rows="10" placeholder="Type your message here."></textarea>
                    </div>
                    <div class="custom-file">
                        <label class="custom-file-label" for="file">Upload File</label>
                        <input type="file" class="file" id="file">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success">Send</button>
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

<script src="/Nexus/dashboard/js/admin/dashboard.instructors.js"></script>

<?php
require_once "template/footer.php";
?>