<?php
require_once "template/studentHeader.php";
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.1/css/lightbox.min.css">

<div class="container">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <p class="h2"><i class="fas fa-check-double"></i> Fully Paid Reservations</p>
    </div>
    <div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
        <table id="tbl_fullPayment" style="width:100%" class="table table-striped table-bordered table-hover table-responsive-sm">
            <thead></thead>
            <tbody></tbody>
        </table>
    </div>
</div>


<div class="modal fade" id="viewPaymentModal" role="dialog">
    <div class="modal-dialog modal-lg viewPaymentModal">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #605ca8;">
                <h5 align="center" style="color:white;">View Payment History</h5>
            </div>
            <div class="modal-body">

                <div style="border: 3px solid #d5d5d5;padding-top:5px;padding-left:5px;padding-right:5px;padding-bottom:0;border-radius: 4px 4px;margin-bottom:5px;">
                    <b>Training Details:</b>
                    <div class="form-group row" style="margin-left:15px;">
                        <label for="course" class="col-sm-3 col-form-label"><span class="fas fa-book"></span> <b>Course</b></label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control-plaintext" id="courseName">
                        </div>

                        <label for="sched" class="col-sm-3 col-form-label"><span class="fas fa-calendar-alt"></span> <b>Schedule</b></label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control-plaintext" id="schedule">
                        </div>

                        <label for="venue" class="col-sm-3 col-form-label"><span class="fas fa-map"></span> <b>Venue</b></label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control-plaintext" id="venue">
                        </div>
                        <label for="instructor" class="col-sm-3 col-form-label"><span class="fas fa-chalkboard-teacher"></span> <b>Instructor</b></label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control-plaintext" id="instructor">
                        </div>
                    </div>
                </div>

                <div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
                    <table id="tbl_paymentDetails" style="width:100%" class="table table-striped table-bordered table-hover table-responsive-sm">
                        <thead></thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="cancelReservationModal" role="dialog">
    <div class="modal-dialog cancelReservationModal">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #605ca8;">
                <h5 align="center" style="color:white;">Cancel Reservation</h5>
            </div>
            <form action="POST" id="cancelReservationForm">
                <div class="modal-body">
                    <input type="hidden" class="trainingId" name="trainingId">
                    <div class="alert alert-danger error-msg" role="alert" style="display: none;"></div>
                    <ul class="list-group mb-3">
                        <li class="list-group-item">
                            <span><i class="fas fa-exclamation-circle" style="color:red;"></i> To RESCHEDULE your training, please contact us immediately.</span>
                        </li>
                        <li class="list-group-item">
                            <span><i class="fas fa-exclamation-circle" style="color:red;"></i> Refunds requests should be submitted atleast three (3) days before your reserved schedule.</span>
                        </li>
                        <li class="list-group-item">
                            <span><i class="fas fa-exclamation-circle" style="color:red;"></i> Refunds are not allowed if the student decides to backout on the first day of class.</span>
                        </li>
                        <li class="list-group-item">
                            <span><i class="fas fa-exclamation-circle" style="color:red;"></i> Upon receiving your request, an admin will contact you regarding your refund.</span>
                        </li>
                        <li class="list-group-item">
                            <span><i class="fas fa-exclamation-circle" style="color:red;"></i> Please give us one (1) week to process your request.</span>
                        </li>
                    </ul>
                    <div class="form-group">
                        <label for="refundReason"><i class="fas fa-comments"></i> Refund reason:</label>
                        <textarea class="form-control refundReason" name="refundReason" rows="4"></textarea>
                    </div>
                    <div>
                        <div class="custom-control custom-checkbox mr-sm-2">
                            <input type="checkbox" class="custom-control-input agreementCheckbox" name="agreementCheckbox" id="customControlAutosizing">
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
                </div>
            </form>
        </div>
    </div>
</div>

<?php
require_once "template/scripts.php";
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.1/js/lightbox.min.js"></script>

<script src="/Nexus/utils/js/utils.Libraries.js"></script>
<script src="/Nexus/utils/js/utils.Validations.js"></script>
<script src="/Nexus/utils/js/utils.Forms.js"></script>

<script src="/Nexus/dashboard/js/student/student.fullPayment.js"></script>

<?php
require_once "template/studentFooter.php";
?>