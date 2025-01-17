<?php
require_once "Template/header.php";
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.1/css/lightbox.min.css">

<div class="container">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h2><span class="fas fa-times-circle"></span> Rejected Payments</h2>
	</div>

	<div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
		<table id="tbl_students" style="width:100%" class="table table-striped table-bordered table-hover table-responsive-sm">
			<thead></thead>
			<tbody></tbody>
		</table>
	</div>
</div>

<div class="modal fade" id="viewDetailsModal" role="dialog" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-xl viewDetailsModal">
		<div class="modal-content">
			<div class="modal-header">
				<h5 align="center"></span>Training Details</h5>
			</div>
			<div class="modal-body">
				<div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
					<table id="tbl_trainingDetails" style="width:100%" class="table table-striped table-bordered table-hover table-responsive-sm">
						<thead></thead>
						<tbody></tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="viewPaymentModal" role="dialog" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-lg viewPaymentModal">
		<div class="modal-content">
			<div class="modal-header">
				<h5 align="center">View Payment History</h5>
			</div>
			<div class="modal-body">
				<div style="border: 3px solid #d5d5d5;padding-top:5px;padding-left:5px;padding-right:5px;padding-bottom:0;border-radius: 4px 4px;margin-bottom:5px;">
					<b>Training Details:</b>
					<div class="form-group row" style="margin-left:15px;">
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
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="messageStudent" role="dialog">
	<div class="modal-dialog modal-lg messageStudent">
		<div class="modal-content">
			<div class="modal-header" style="background-color: #A2C710;">
				<h5 align="center">Message Student</h5>
			</div>
			<div class="modal-body">
				<div class="alert alert-danger error-msg" role="alert" style="display: none;"></div>
				<div class="form-group">
					<label for="subjectQuote"><span class="fas fa-envelope"></span> Subject</label>
					<input type="text" class="form-control" id="subjectQuote" name="subjectQuote" placeholder="Subject" autofocus maxlength="30">
				</div>
				<div class="form-group">
					<label for=quoteMessage><span class="fas fa-envelope-open-text"></span> Message</label>
					<textarea class="form-control" id="emailMsg" name="emailMsg" rows="7" placeholder="Type your message here."></textarea>
				</div>
				<div class="custom-file">
					<input type="file" class="custom-file-input" id="customFile">
					<label class="custom-file-label" for="customFile">Upload File</label>
				</div>
			</div>
			<div class="d-flex justify-content-center">
				<div class="spinner-border spinner" role="status" style="display:none;">
					<span class="sr-only">Loading...</span>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success">Send</button>
				<button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
			</div>
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

<script src="/Nexus/dashboard/js/admin/dashboard.rejectedPayments.js"></script>

<?php
require_once "template/footer.php";
?>