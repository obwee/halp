<?php
require_once "template/header.php";
?>

<div class="container">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<p class="h2">Sent Quotations</p>
	</div>
	<div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
		<div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
			<div align="right">
			</div>
			<table id="quotationSenders" style="width:100%" class="table table-striped table-bordered table-hover">
				<thead></thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
</div>

<div class="modal fade" id="viewQuoteModal" tabindex="-1" role="dialog">
	<div class="modal-dialog viewQuoteModal">
		<div class="modal-content">
			<div class="modal-header" style="background-color: #A2C710;">
				<h5 align="center">View Quotation</h5>
			</div>
			<div class="modal-body">
				<div class="quoteBody">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<!--Get Quote Modal-->

<div class="modal fade" id="editQuoteModal" role="dialog">
	<div class="modal-dialog editQuoteModal">
		<div class="modal-content">
			<div class="modal-header" style="background-color: #A2C710;">
				<h5 align="center">Edit Quotation Request</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post" id="quotationForm">
					<div class="form-group">
						<label for="quoteCourse"><span class="fas fa-book"></span> Course</label>
						<select class="form-control">

						</select>
					</div>
					<div class="form-group">
						<label for="scheduleType"><span class="fas fa-calendar-week"></span> Schedule </label>
						<select class="form-control">

						</select>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-success" data-toggle="modal" data-target="#sendRequestModal">Update</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="sendRequestModal" role="dialog">
	<div class="modal-dialog modal-lg sendRequestModal">
		<div class="modal-content">
			<div class="modal-header" style="background-color: #A2C710;">
				<h5 align="center"><span class="glyphicon glyphicon-plane"></span>Send Updated Quotation Request</h5>
			</div>

			<div class="modal-body">
				<div class="form-group">
					<label for="subjectQuote"><span class="fas fa-envelope"></span> Subject</label>
					<input type="text" class="form-control" id="subjectQuote" name="subjectQuote" placeholder="Subject" autofocus maxlength="30">
				</div>
				<div class="form-group">
					<label for=quoteMessage><span class="fas fa-envelope-open-text"></span> Message</label>
					<textarea class="form-control" id="emailMsg" name="emailMsg" rows="7" placeholder="Type your message here."></textarea>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success">Send</button>
				<button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="viewRequestModal" role="dialog" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-xl viewRequestModal">
		<div class="modal-content">
			<div class="modal-header">
				<h5 align="center"></span>Quotation Requests</h5>
			</div>
			<div class="modal-body">

				<div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
					<!-- <div align="right">
						<button type="button" id="insertNewQuoteRequest" data-toggle="modal" data-target="#insertNewRequestModal" class="btn btn-info">Insert Request</button>
					</div> -->
					<br><br>
					<table id="quotationRequests" style="width:100%" class="table table-striped table-bordered table-hover table-responsive-sm">
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

<div class="modal fade" id="viewDetailsModal" role="dialog" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-dialog-centered modal-xl viewDetailsModal">
		<div class="modal-content">
			<div class="modal-header">
				<h5 align="center"></span>Quotation Details</h5>
			</div>
			<div class="modal-body">
				<div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
					<br><br>
					<table id="quotationDetails" style="width:100%" class="table table-striped table-bordered table-hover table-responsive-sm">
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

<?php
require_once "template/scripts.php";
?>

<script src="/Nexus/dashboard/js/admin/dashboard.sentQuotations.js"></script>

<?php
require_once "template/footer.php";
?>