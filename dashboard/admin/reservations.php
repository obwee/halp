<?php
require_once "Template/header.php";
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.1/css/lightbox.min.css">

<div class="container">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h2><i class="fas fa-university"></i> Enrollment</h2>
	</div>

	<div class="row" style="border-radius:8px 8px;padding-top:10px;padding-bottom:0;margin-bottom:0;margin-left:10px;margin-right:10px;border-width:2px;background-color:#fff;box-shadow:8px 8px #3c8dbc;">
		<div class="col-md-4">
			<div class="row">
				<div class="col-sm-6">
					<div class="venue">
						<label><i class="fas fa-map-pin"></i><b> Venue</b></label><br>
						<div class="custom-control custom-checkbox mr-sm-2">
							<input type="checkbox" class="custom-control-input" id="makati">
							<label class="custom-control-label" for="makati">Makati</label>
						</div>
						<div class="custom-control custom-checkbox mr-sm-2">
							<input type="checkbox" class="custom-control-input" id="manila">
							<label class="custom-control-label" for="manila">Manila</label>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="paymentStatus">
						<label><i class="fas fa-money"></i><b> Payment</b></label><br>
						<div class="custom-control custom-checkbox mr-sm-2">
							<input type="checkbox" class="custom-control-input" id="partial">
							<label class="custom-control-label" for="partial">Partial</label>
						</div>
						<div class="custom-control custom-checkbox mr-sm-2">
							<input type="checkbox" class="custom-control-input" id="full">
							<label class="custom-control-label" for="full">Full</label>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<label><i class="fas fa-book"></i><b> Course</b></label>
			<select class="form-control">
				<option value="" selected disabled hidden>Select Course</option>
			</select>&nbsp&nbsp
		</div>
		<div class="col-md-4">
			<label><i class="fas fa-calendar"></i><b> Schedule</b></label>
			<select class="form-control">
				<option value="" selected disabled hidden>Select Schedule</option>
			</select>
			<div class="form-group row">
				<label for="slot" class="col-sm-4 col-form-label"><i class="fas fa-users"></i><b> Slots</b></label>
				<div class="col-sm-8">
					<input type="text" readonly class="form-control-plaintext" id="slot" value="10/15">
				</div>
			</div>
		</div>
	</div>

	<div align="center" style="margin-top:12px;margin-bottom:15px;">
		<button type="button" id="addWalkin" class="btn btn-primary" data-toggle="modal" data-target="#addWalkinModal"><i class="fas fa-walking"></i> &nbsp&nbsp&nbsp&nbspAdd Walk-in&nbsp&nbsp&nbsp&nbsp</button>
		<button type="submit" id="clear" class="btn btn-danger"><i class="fas fa-eraser"></i> Clear Selection</button>
		<button type="submit" id="loadClassList" class="btn btn-success"><i class="fas fa-spinner"></i> Load Class List&nbsp</button>
	</div>

	<div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
		<table id="tbl_reservations" style="width:100%" class="table table-striped table-bordered table-hover table-responsive-sm">
			<thead></thead>
			<tbody></tbody>
		</table>
	</div>
</div>


<div class="modal fade" id="rescheduleModal" role="dialog">
	<div class="modal-dialog modal-dialog-centered rescheduleModal">
		<div class="modal-content">
			<div class="modal-header" style="background-color: #3c8dbc;">
				<h5 align="center" style="color:white;"><i class="fas fa-calendar-day"></i> Reschedule</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" style="color:white">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form>
					<div class="form-group row">
						<label for="studName" class="col-sm-4 col-form-label"><i class="fas fa-user"></i> Name:</label>
						<div class="col-sm-8">
							<input type="text" readonly class="form-control-plaintext" id="studName" value="Mark Sale">
						</div>

						<label for="course" class="col-sm-4 col-form-label"><i class="fas fa-book"></i> Course:</label>
						<div class="col-sm-8">
							<input type="text" readonly class="form-control-plaintext" id="course" value="Ethical Hanking with Pen Test">
						</div>

						<label for="schedule" class="col-sm-4 col-form-label"><i class="fas fa-calendar-day"></i> Schedule:</label>
						<div class="col-sm-8">
							<input type="text" readonly class="form-control-plaintext" id="schedule" value="April 29 - 30, 2020">
						</div>
					</div>
					<div style="border:2px solid #d5d5d5;border-top:5px solid #3c8dbc; padding:10px;">
						<div class="form-group">
							<label for="course"><span class="fas fa-book"></span> New Course</label>
							<select class="form-control">
								<option value="" selected disabled hidden>Select New Course</option>
							</select>
						</div>
						<div class="form-group">
							<label for="schedule"><span class="fas fa-calendar"></span> New Schedule</label>
							<select class="form-control">
								<option value="" selected disabled hidden>Select New Schedule</option>
							</select>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-success">Update</button>
				<button type="submit" class="btn btn-info" data-dismiss="modal">Cancel</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="addWalkinModal" role="dialog">
	<div class="modal-dialog modal-dialog-centered addWalkinModal">
		<div class="modal-content">
			<div class="modal-header" style="background-color: #3c8dbc;">
				<h5 align="center" style="color:white;"><i class="fas fa-walking"></i> Add Walk-in</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" style="color:white">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form>
					<div class="form-group">
						<label for="sname"><span class="fas fa-user"></span> Student Name</label>
						<input type="text" name="sname" class="form-control">
					</div>
					<div class="form-group">
						<label for="courseCode"><span class="fas fa-book"></span> Course</label>
						<select class="form-control">
							<option value="" selected disabled hidden>Select Course</option>
						</select>
					</div>
					<div class="form-group">
						<label for="schedule"><span class="fas fa-calendar-alt"></span> Schedule</label>
						<select class="form-control">
							<option value="" selected disabled hidden>Select Schedule</option>
						</select>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-success">Add</button>
				<button type="submit" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
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

<script src="/Nexus/dashboard/js/admin/dashboard.reservations.js"></script>

<?php
require_once "template/footer.php";
?>