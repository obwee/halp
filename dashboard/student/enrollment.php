<?php
require_once "template/studentHeader.php";
?>

<div class="container">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <p class="h3">Enrollment</p>
    </div>

    <div align="right">
        <button type="button" id="enrollBtn" class="btn btn-primary btn-lg">Enroll</button>
    </div>

    <br>

    <div class="container">
        <div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
            <table id="tbl_enrollment" style="width:100%" class="table table-striped table-bordered table-hover table-responsive-sm">
                <thead></thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="paymentModal" role="dialog">
        <div class="modal-dialog modal-lg paymentModal">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #605ca8;">
                    <h5 align="center" style="color: white;">Upload Payment</h5>
                </div>
                <div class="modal-body">
                    <div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
                        <table id="tbl_enrollment" style="width:100%" class="table table-striped table-bordered table-hover table-responsive-sm">
                            <thead>
                                <tr>
                                    <th style="white-space:nowrap;">Course Code</th>
                                    <th style="white-space:nowrap;">Start Date</th>
                                    <th style="white-space:nowrap;">End Date</th>
                                    <th style="white-space:nowrap;">Venue</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFile">
                        <label class="custom-file-label" for="customFile">Upload File</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Upload</button>
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="enrollModal" role="dialog">
        <div class="modal-dialog enrollModal">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #605ca8;">
                    <h5 align="center" style="color:white;">Enrollment</h5>
                </div>
                <form action="POST" id="enrollForm">
                    <div class="modal-body">
                        <div class="alert alert-danger error-msg" role="alert" style="display: none;"></div>
                        <div class="form-group">
                            <label><i class="fas fa-book"></i> Course</label>
                            <select class="form-control courses" name="courses">
                                <option selected disabled hidden>Select Course</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label><i class="fas fa-calendar-alt"></i> Schedule</label>
                            <select class="form-control schedules" name="schedules">
                                <option selected disabled hidden>Select Schedule</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label><i class="fas fa-map"></i> Venue</label>
                            <input type="text" class="form-control venue" readonly>
                        </div>
                        <div class="form-group">
                            <label><i class="fas fa-money"></i> Price</label>
                            <input type="text" class="form-control price" readonly>
                        </div>
                        <div class="form-group">
                            <label><i class="fas fa-users"></i> Available Slots</label>
                            <input type="text" class="form-control slots" readonly>
                        </div>
                        <div class="form-group">
                            <label><i class="fas fa-chalkboard"></i> Instructor</label>
                            <input type="text" class="form-control instructor" readonly>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="spinner-border spinner" role="status" style="display:none;">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Enroll</button>
                        <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="cancelModal" role="dialog">
        <div class="modal-dialog cancelModal">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #605ca8;">
                    <h5 align="center" style="color:white;">Cancel Reservation</h5>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="alert alert-danger error-msg" role="alert" style="display: none;"></div>
                        <div style="border:1px solid #d5d5d5; padding:5px 5px;border-radius:3px 3px;text-align: justify">
                            <p><i class="fas fa-exclamation-circle" style="color:red;"></i> To RESCHEDULE your training, please contact us immediately.</p>
                            <p><i class="fas fa-exclamation-circle" style="color:red;"></i> Refunds requests should be submitted atleast three (3) days before your reserved schedule.</p>
                            <p><i class="fas fa-exclamation-circle" style="color:red;"></i> Refunds are not allowed if the student decides to backout on the first day of class.</p>
                            <p><i class="fas fa-exclamation-circle" style="color:red;"></i> Upon receiving your request, an admin will contact you regarding your refund.</p>
                            <p><i class="fas fa-exclamation-circle" style="color:red;"></i> Please give us one (1) week to process your request.</p>
                        </div> <br>
                        <div class="form-group">
                            <label for="refundReason"><i class="fas fa-comments"></i> Refund reason:</label>
                            <textarea class="form-control" id="refundReason" rows="4"></textarea>
                        </div>
                        <div>
                        <div class="custom-control custom-checkbox mr-sm-2">
                            <input type="checkbox" class="custom-control-input" id="customControlAutosizing">
                            <label class="custom-control-label" for="customControlAutosizing" style="text-align:justify;">I have read, understood and agreed to the terms and conditions stated above. I understand that submitting this request does not guarantee the request to be accepted and processed immediately.</label>
                        </div>
                    </div>

                <div class="d-flex justify-content-center">
                    <div class="spinner-border spinner" role="status" style="display:none;">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Submit</button>
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                </div>
            </form>
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

<script src="/Nexus/dashboard/js/student/student.enrollment.js"></script>

<?php
require_once "template/studentFooter.php";
?>