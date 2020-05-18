<?php
require_once "Template/header.php";
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.1/css/lightbox.min.css">
<link rel="stylesheet" href="/Nexus/dashboard/css/typeahead.css">

<div class="container">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h2><i class="fas fa-university"></i> Enrollment</h2>
	</div>

	<form action="POST" id="filterForm">
		<div class="row" style="border-radius:8px 8px;padding-top:10px;padding-bottom:0;margin-bottom:0;margin-left:10px;margin-right:10px;border-width:2px;background-color:#fff;box-shadow:8px 8px #3c8dbc;">
			<div class="col-md-4">
				<div class="row">
					<div class="col-sm-4">
						<label><i class="fas fa-map-pin"></i><b> Venue</b></label><br>
						<div class="venue-tpl" hidden>
							<div class="form-check">
								<input class="form-check-input venue" name="venue[]" type="checkbox">
								<label class="form-check-label"></label>
							</div>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="paymentStatus">
							<label><i class="fas fa-money"></i><b> Payment</b></label><br>
							<div class="form-check">
								<input class="form-check-input paymentStatus" name="paymentStatus[]" type="checkbox" value="0">
								<label class="form-check-label">Unpaid/Payment Submitted</label>
							</div>
							<div class="form-check">
								<input class="form-check-input paymentStatus" name="paymentStatus[]" type="checkbox" value="1">
								<label class="form-check-label">Partial</label>
							</div>
							<div class="form-check">
								<input class="form-check-input paymentStatus" name="paymentStatus[]" type="checkbox" value="2">
								<label class="form-check-label">Full</label>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<label><i class="fas fa-book"></i><b> Course</b></label>
				<select class="form-control courseFilterDropdown" name="courseDropdown">
					<option value="" selected disabled hidden>Select Course</option>
				</select>&nbsp&nbsp
			</div>
			<div class="col-md-4">
				<label><i class="fas fa-calendar"></i><b> Schedule</b></label>
				<select class="form-control scheduleFilterDropdown" name="scheduleDropdown">
					<option value="" selected disabled hidden>Select Schedule</option>
				</select>
				<div class="form-group row">
					<label for="slot" class="col-sm-4 col-form-label"><i class="fas fa-users"></i><b> Slots</b></label>
					<div class="col-sm-8">
						<input type="text" disabled class="form-control-plaintext numSlots" value="N/A">
					</div>
				</div>
			</div>
		</div>
		<div align="center" style="margin-top:12px;margin-bottom:15px;">
			<button type="button" id="addWalkin" class="btn btn-primary" data-toggle="modal" data-target="#addWalkinModal"><i class="fas fa-walking"></i> &nbsp&nbsp&nbsp&nbspAdd Walk-in&nbsp&nbsp&nbsp&nbsp</button>
			<button type="button" id="clearSelection" class="btn btn-danger"><i class="fas fa-eraser"></i> Clear Selection</button>
			<button type="submit" id="loadClassList" class="btn btn-success">&nbsp&nbsp&nbsp&nbsp&nbsp<i class="fas fa-spinner"></i> Load List&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</button>
		</div>
	</form>

	<div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
		<table id="tbl_reservations" style="width:100%" class="table table-striped table-bordered table-hover table-responsive-sm">
			<thead></thead>
			<tbody></tbody>
		</table>
	</div>
</div>


<div class="modal fade" id="rescheduleModal" role="dialog" data-backdrop="static">
	<div class="modal-dialog modal-dialog-centered rescheduleModal">
		<div class="modal-content">
			<div class="modal-header" style="background-color: #3c8dbc;">
				<h5 align="center" style="color:white;"><i class="fas fa-calendar-day"></i> Reschedule</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" style="color:white">&times;</span>
				</button>
			</div>
			<form method="POST" id="rescheduleForm">
				<div class="modal-body">
					<div class="alert alert-danger error-msg" role="alert" style="display: none;"></div>
					<div class="form-group row">
						<input type="text" id="studId" name="studentId" readonly hidden>
						<input type="text" id="trainingId" name="trainingId" readonly hidden>
						<label for="studName" class="col-sm-4 col-form-label"><i class="fas fa-user"></i> Name:</label>
						<div class="col-sm-8">
							<input type="text" readonly class="form-control-plaintext" id="studName">
						</div>
						<label for="course" class="col-sm-4 col-form-label"><i class="fas fa-book"></i> Course:</label>
						<div class="col-sm-8">
							<input type="text" readonly class="form-control-plaintext" id="course">
						</div>

						<label for="schedule" class="col-sm-4 col-form-label"><i class="fas fa-calendar-day"></i> Schedule:</label>
						<div class="col-sm-8">
							<input type="text" readonly class="form-control-plaintext" id="schedule">
						</div>
					</div>
					<div style="border:2px solid #d5d5d5;border-top:5px solid #3c8dbc; padding:10px;">
						<div class="form-group">
							<label for="course"><span class="fas fa-book"></span> New Course</label>
							<select name="course" class="form-control courseDropdownForReschedule">
								<option value="" selected disabled hidden>Select New Course</option>
							</select>
						</div>
						<div class="form-group">
							<label for="schedule"><span class="fas fa-calendar"></span> New Schedule</label>
							<select name="schedule" class="form-control scheduleDropdownForReschedule">
								<option value="" selected disabled hidden>Select New Schedule</option>
							</select>
						</div>
					</div>
				</div>
				<div class="d-flex justify-content-center">
					<div class="spinner-border spinner" role="status" style="display:none;">
						<span class="sr-only">Loading...</span>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success">Update</button>
					<button type="submit" class="btn btn-info" data-dismiss="modal">Cancel</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="addWalkinModal" role="dialog" data-backdrop="static">
	<div class="modal-dialog modal-dialog-centered addWalkinModal">
		<div class="modal-content">
			<div class="modal-header" style="background-color: #3c8dbc;">
				<h5 align="center" style="color:white;"><i class="fas fa-walking"></i> Add Walk-in</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" style="color:white">&times;</span>
				</button>
			</div>
			<form method="POST" id="addWalkInForm">
				<div class="modal-body">
					<input type="hidden" class="form-control studentId" name="studentId" readonly>
					<div class="alert alert-danger error-msg" role="alert" style="display: none;"></div>
					<div class="form-group studentSearch">
						<label for="studentName"><span class="fas fa-user"></span> Student Name</label>
						<div class="row">
							<div class="col-6">
								<input type="text" class="form-control typeahead studentName" placeholder="Enter Student Name">
							</div>
							<div class="col-6">
								<button type="button" class="btn btn-primary loadStudent">Load Student</button>
							</div>
						</div>
					</div>
					<div class="dropdowns">
						<div class="form-group">
							<label for="courseDropdown"><span class="fas fa-book"></span> Course</label>
							<select class="form-control courseDropdown" name="courseDropdown" disabled>
								<option value="" selected disabled hidden>Select Course</option>
							</select>
						</div>
						<div class="form-group">
							<label for="scheduleDropdown"><span class="fas fa-calendar-alt"></span> Schedule</label>
							<select class="form-control scheduleDropdown" name="scheduleDropdown" disabled>
								<option value="" selected disabled hidden>Select Schedule</option>
							</select>
						</div>
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
					<button type="submit" class="btn btn-success">Add</button>
					<button type="submit" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="viewPaymentModal" role="dialog">
	<div class="modal-dialog modal-lg viewPaymentModal">
		<div class="modal-content">
			<div class="modal-header" style="background-color: #3c8dbc;">
				<h5 align="center" style="color:white;">View Payment History</h5>
			</div>
			<div class="modal-body">
				<div style="border: 3px solid #d5d5d5;padding-top:5px;padding-left:5px;padding-right:5px;padding-bottom:0;border-radius: 4px 4px;margin-bottom:5px;">
					<b>Training Details:</b>
					<div class="form-group row" style="margin-left:15px;">
						<label for="studentName" class="col-sm-3 col-form-label"><span class="fas fa-book"></span> <b>Student</b></label>
						<div class="col-sm-9">
							<input type="text" readonly class="form-control-plaintext" id="studentName">
						</div>
						<label for="courseName" class="col-sm-3 col-form-label"><span class="fas fa-book"></span> <b>Course</b></label>
						<div class="col-sm-9">
							<input type="text" readonly class="form-control-plaintext" id="courseName">
						</div>
						<label for="schedule" class="col-sm-3 col-form-label"><span class="fas fa-calendar-alt"></span> <b>Schedule</b></label>
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
				<br>
				<div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
					<table id="tbl_paymentDetails" style="width:100%" class="table table-striped table-bordered table-hover table-responsive-sm">
						<thead></thead>
						<tbody></tbody>
						<tfoot>
							<tr>
								<th></th>
								<th></th>
								<th style="text-align:right" class="footerBalance"></th>
								<th></th>
								<th></th>
								<th></th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success addPayment">Add Payment</button>
				<button type="button" class="btn btn-success clearChange">Clear Change</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="approvePaymentModal" role="dialog" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-xl approvePaymentModal">
		<div class="modal-content">
			<div class="modal-header" style="background-color: #3c8dbc;">
				<h5 align="center" style="color:white;"><i class="fas fa-check-double"></i> Approve Payment</h5>
			</div>
			<form action="POST" id="approvePaymentForm">
				<div class="modal-body">
					<div class="alert alert-danger error-msg" role="alert" style="display: none;"></div>
					<input type="hidden" name="paymentId" class="form-control paymentId">
					<div class="row">
						<div class="col-6">
							<div class="paymentImage" style="border-style:solid;border-width:1px;height:100%;width:100%">
								<a href="" data-lightbox="payment-image">
									<img src="" style="width: 100%; height: 100%">
								</a>
							</div>
						</div>
						<div class="col-6" style="border-radius:10px 10px;border-style:solid;border-color:#d5d5d5;padding:10px 10px;width:50%;border-width:2px;">
							<div class="form-group">
								<label><i class="fas fa-money"></i><b> MOP</b></label>
								<select class="form-control modeOfPayment" name="modeOfPayment"></select>
							</div>
							<div class="form-group">
								<label><i class="fas fa-money"></i><b> Amount Paid</b></label>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text">₱</span>
									</div>
									<input type="text" name="paymentAmount" class="form-control paymentAmount">
								</div>
							</div>
							<div class="form-group">
								<label><i class="fas fa-money"></i><b> Old Balance</b></label>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text">₱</span>
									</div>
									<input type="text" class="form-control oldBalance" readonly>
								</div>
							</div>
							<div class="form-group">
								<label><i class="fas fa-money"></i><b> New Balance</b></label>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text">₱</span>
									</div>
									<input type="text" class="form-control newBalance" readonly>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="d-flex justify-content-center">
					<div class="spinner-border spinner" role="status" style="display:none;">
						<span class="sr-only">Loading...</span>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success">Accept</button>
					<button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="cancelReservationModal" role="dialog">
	<div class="modal-dialog cancelReservationModal">
		<div class="modal-content">
			<div class="modal-header" style="background-color: #3c8dbc;;">
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

<div class="modal fade" id="addPaymentModal" role="dialog" data-backdrop="static">
	<div class="modal-dialog addPaymentModal modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header" style="background-color: #3c8dbc;">
				<h5 align="center" style="color: white;">Upload Payment</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" style="color:white">&times;</span>
				</button>
			</div>
			<form action="POST" id="addPaymentForm">
				<div class="modal-body">
					<div>
						<ol>
							<li>We accept CASH, BDO DEPOSIT, BDO BANK TRANSFER and CHEQUE payments.</li>
							<li>Pay the training fee by depositing at any BDO branch.</li>
							<ul>
								<li>Account Name: Nexus IT Training Center</li>
								<li>BDO Account Number: 002810078994</li>
							</ul>
							<li>Upload a picture of the proof of payment below.</li>
						</ol>
					</div>
					<div class="alert alert-danger error-msg" role="alert" style="display: none;"></div>
					<div class="custom-file">
						<input type="file" class="custom-file-input paymentFile" name="paymentFile">
						<label class="custom-file-label" for="customFile">Upload File</label>
					</div>
				</div>
				<div class="d-flex justify-content-center">
					<div class="spinner-border spinner" role="status" style="display:none;">
						<span class="sr-only">Loading...</span>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success">Upload</button>
					<button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
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

<script src="https://twitter.github.io/typeahead.js/releases/latest/typeahead.bundle.js"></script>
<script src="/Nexus/dashboard/js/admin/dashboard.enrollment.js"></script>

<?php
require_once "template/footer.php";
?>