<?php
require_once "Template/header.php";
?>

<div class="container">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <p class="h2"><i class="fas fa-chalkboard-teacher"></i> Instructors</p>
    </div>

    <div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
        <div align="right">
            <button type="button" id="addNewBranch" data-toggle="modal" data-target="#addNewInstructorModal" class="btn btn-info btn-lg"><i class="fas fa-plus"></i> Add Instructor</button>
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
            <div class="modal-header" style="background-color: #3c8dbc;">
                <h5 align="center" style="color:white;"><i class="fas fa-plus"></i> Add Instructor</h5>
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

<div class="modal fade" id="editInstructorModal" role="dialog">
    <div class="modal-dialog editInstructorModal">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #3c8dbc;">
                <h5 align="center" style="color:white;"><i class="fas fa-edit"></i> Edit Instructor</h5>
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

<div class="modal fade" id="messageInstructorModal" role="dialog">
    <div class="modal-dialog modal-lg messageInstructorModal">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #3c8dbc;">
                <h5 align="center" style="color:white;"><i class="fas fa-comments"></i> Send a Message</h5>
            </div>
            <form action="POST" id="messageInstructorForm">
                <div class="modal-body">
                    <div class="alert alert-danger error-msg" role="alert" style="display: none;"></div>
                    <div class="form-group">
                        <label for="title"><span class="fas fa-envelope"></span> Subject</label>
                        <input type="text" class="form-control title" name="title" placeholder="Subject" autofocus maxlength="30">
                    </div>
                    <div class="form-group">
                        <label for='msg'><span class="fas fa-envelope-open-text"></span> Message</label>
                        <textarea class="form-control msg" name="msg" rows="10" placeholder="Type your message here."></textarea>
                    </div>
                    <div class="custom-file">
                        <label class="custom-file-label" for="file">Select File</label>
                        <input type="file" name="file" class="file" id="file">
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <div class="spinner-border spinner" role="status" style="display:none;">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Send</button>
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="changeInstructorModal" role="dialog">
    <div class="modal-dialog modal-lg changeInstructorModal">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #3c8dbc;">
                <h5 align="center" style="color:white;"><i class="fas fa-edit"></i> Update Instructor</h5>
            </div>
            <form id="changeInstructorForm" method="post">
                <div class="modal-body">
                    <input type="text" class="instructorId" name="instructorId" readonly hidden>
                    <div class="row">
                        <div class="col-sm-2">
                            <label for="instructorName" class="col-form-label"><i class="fas fa-chalkboard-teacher"></i> Instructor</label>
                        </div>
                        <div class="col-sm-10">
                            <input type="text" class="form-control instructorName" readonly>
                        </div>
                        <div class="col-12 alert alert-danger error-msg" role="alert" style="display: none;"></div>
                    </div>
                    <div class="box mt-4" style="border:5px solid #3c8dbc;margin:5px 5px;padding:7px 7px ;overflow-y: scroll;height:250px;overflow-x: hidden;">
                        <div class="template" hidden>
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="courseCode" style="padding-left: 10px;"><i class="fas fa-book"></i> Course: <span></span></p>
                                    <p class="courseSchedule" style="padding-left: 10px;"><i class="fas fa-calendar-day"></i> Schedule: <span></span></p>
                                    <p class="courseVenue" style="padding-left: 10px;"><i class="fas fa-map-marked-alt"></i> Venue: <span></span></p>
                                </div>
                                <div class="col-sm-6 d-flex align-items-center">
                                    <select class="form-control courseInstructors" name="">
                                        <option selected hidden disabled>Select New Instructor</option>
                                    </select>
                                </div>
                            </div>
                            <hr class="mt-0">
                        </div>
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

<script src="/Nexus/dashboard/js/admin/dashboard.instructors.js"></script>

<?php
require_once "template/footer.php";
?>