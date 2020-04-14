<?php
require_once "template/studentHeader.php";
?>


	<div class="container">
		<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
			<p class="h2"><i class="fas fa-check-double"></i> Fully Paid Reservations</p>
		</div>
		<div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
			<table id="tbl_fullPayment" style="width:100%" class="table table-striped table-bordered table-hover table-responsive-sm">
				<thead>
					<tr>
						<th style="white-space:nowrap;text-align:center;">Date Submitted</th>
                        <th style="white-space:nowrap;text-align:center;">Course</th>
                        <th style="white-space:nowrap;text-align:center;">Start Date</th>
                        <th style="white-space:nowrap;text-align:center;">End Date</th>
                        <th style="white-space:nowrap;text-align:center;">Venue</th>
						<th style="white-space:nowrap;text-align:center;">Actions</th>
					</tr>
                </thead>
				<tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td align="center">
                            <button class="btn btn-dark btn-sm" data-toggle="modal" data-target="#viewPaymentModal"><i class="fas fa-eye"></i></button>
                            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#rescheduleModal"><i style="color:white;" class="fas fa-calendar-times"></i></button>
                            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#refundModal"><i style="color:white;" class="fas fa-times-circle"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

 
    <div class="modal fade" id="viewPaymentModal" role="dialog">
        <div class="modal-dialog modal-lg viewPaymentModal">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #605ca8;">
                    <h5 align="center" style="color:white;">View Payment History</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color:white">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        
                    <div style="border: 3px solid #d5d5d5;padding-top:5px;padding-left:5px;padding-right:5px;padding-bottom:0;border-radius: 4px 4px;margin-bottom:5px;">
                        <b>Training Details:</b>
                        <div class="form-group row" style="margin-left:15px;">
                            <label for="course" class="col-sm-3 col-form-label"><span class="fas fa-book"></span> <b>Course</b></label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" id="course" value="Ethical Hacking with Penetration Testing">
                            </div>

                            <label for="sched" class="col-sm-3 col-form-label"><span class="fas fa-calendar-alt"></span> <b>Schedule</b></label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" id="sched" value="April 29 - 30, 2020">
                            </div>

                            <label for="venue" class="col-sm-3 col-form-label"><span class="fas fa-map"></span> <b>Venue</b></label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" id="venue" value="Makati">
                            </div>

                            <label for="instructor" class="col-sm-3 col-form-label"><span class="fas fa-chalkboard-teacher"></span> <b>Instructor</b></label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" id="course" value="Richard Reblando">
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
                        <table id="tbl_paymentDetails" style="width:100%" class="table table-striped table-bordered table-hover table-responsive-sm">
                            <thead>
                                <tr style="white-space:nowrap;text-align:center;">
                                    <th>Date Paid</th>
                                    <th>MOP</th>
                                    <th>Training Fee</th>
                                    <th>Amount Paid</th>
                                    <th>Remaining Balance</th>
                                    <th>Payment Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="text-align: center;">
                                    <td>April 1, 2020</td>
                                    <td>BDO</td>
                                    <td>P3,000.00</td>
                                    <td>P3,000.00</td>
                                    <td>P0.00</td>
                                    <td>Fully Paid</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="rescheduleModal" role="dialog" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered rescheduleModal">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #605ca8;">
                    <h5 align="center" style="color: white;"><i class="fas fa-calendar-day"></i> Reschedule Reservation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color:white">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>For rescheduling, please inform us atleast three (3) days before your scheduled training.</p>
                    <p>To reschedule your reservation, please contact us from 09:00AM - 05:00PM to assist you.</p>
                    <ul>
                        <li>Makati Branch: &nbsp&nbsp&nbsp+63 2 8362-3755</li>
                        <li>Manila Branch: &nbsp&nbsp&nbsp+63 2 8355-7759</li>
                    </ul>
                    <p>You can also message us through <a href="https://www.facebook.com/nxs88" target="_blank">facebook</a>.</p>

                    <p>To view the complete terms and conditions, click <a href="">here</a>.</p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

   <div class="modal fade" id="refundModal" role="dialog" data-backdrop="static">
        <div class="modal-dialog refundModal modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #605ca8;">
                    <h5 align="center" style="color:white;">Cancel Reservation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color:white">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger error-msg" role="alert" style="display: none;"></div>
                    <div style="border:1px solid #d5d5d5; padding:5px 5px;border-radius:3px 3px;text-align: justify">
                        <p><i class="fas fa-exclamation-circle" style="color:red;"></i> To RESCHEDULE your training, please contact us immediately.</p>
                        <p><i class="fas fa-exclamation-circle" style="color:red;"></i> Refunds requests should be submitted atleast three (3) days before your reserved schedule.</p>
                        <p><i class="fas fa-exclamation-circle" style="color:red;"></i> Refunds are not allowed if the student decides to backout on the first day of class.</p>
                        <p><i class="fas fa-exclamation-circle" style="color:red;"></i> Upon receiving your request, an admin will contact you regarding your refund.</p>
                        <p><i class="fas fa-exclamation-circle" style="color:red;"></i> Please give us one (1) week to process your request.</p>
                    </div>
                    <p>To view the complete terms and conditions, click <a href="">here</a>.</p>
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

<script src="/Nexus/dashboard/js/student/student.fullPayment.js"></script>

<?php
require_once "template/studentFooter.php";
?>