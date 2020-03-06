<?php
require_once "template/studentHeader.php";
?>

<div class="container">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<p class="h3">Enrollment</p>
	</div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group row">
                <label for="course" class="col-sm-3 col-form-label">
                    <span class="fas fa-book"></span> Course
                </label>
                <div class="col-sm-9">
                    <select class="form-control" id="course">
                        <option selected disabled hidden>Select Course</option>
                    </select>
                </div>
                <div class="col-sm-9">
                   <input type="text" class="form-control-plaintext" id="courseDetails" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-3 col-form-label">
                    <span class="fas fa-map"></span> Venue
                </label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="branch" readonly>
                </div>
                <div class="col-sm-9">
                   <input type="text" class="form-control-plaintext" id="branchAddress" readonly>
                </div>
            </div>
        </div>
            
        <div class="col-sm-6">
            <div class="form-group row">
                <label for="schedule" class="col-sm-3 col-form-label">
                    <span class="fas fa-calendar-alt"></span> Schedule
                </label>
                <div class="col-sm-9">
                    <select class="form-control" id="schedule">
                        <option selected disabled hidden>Select Schedule</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="slots" class="col-sm-4 col-form-label">
                    <span class="fas fa-users"></span> Available Slots
                </label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="slots" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-3 col-form-label">
                    <span class="fas fa-chalkboard-teacher"></span> Instructor
                </label>
                <div class="col-sm-9">
                    <input type="text" class="form-control-plaintext" id="email" readonly>
                </div>
            </div>
        </div>
        <div class="col-sm-12" align="right">
            <button type="button" class="btn btn-success">Submit</button>
            <button type="button" class="btn btn-dark " data-dismiss="modal">&nbsp&nbspClear&nbsp&nbsp</button>
        </div>
    </div>

    <br>
	<div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
        <p class="h3 border-bottom">Enrolled Courses</p>
		<table id="tbl_enrollment" style="width:100%" class="table table-striped table-bordered table-hover table-responsive-sm">
			<thead>
				<tr>
					<th style="white-space:nowrap;">Course Code</th>
                    <th style="white-space:nowrap;">Start Date</th>
                    <th style="white-space:nowrap;">End Date</th>
                    <th style="white-space:nowrap;">Venue</th>
                    <th style="white-space:nowrap;">Instructor</th>
					<th style="white-space:nowrap;">Actions</th>
				</tr>
            </thead>
			<tbody>
                <tr>
                    <td>20410D</td>
                    <td>Mar 5, 2020</td>
                    <td>Mar 8, 2020</td>
                    <td>Makati</td>
                    <td>Mark Sampayan</td>
                    <td>
                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#paymentModal">
                            <i class="fas fa-hand-holding-usd"></i>
                        </button>
                        <button class="btn btn-success btn-sm">
                            <i class="fas fa-print"></i>
                        </button>
                        <button class="btn btn-danger btn-sm">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>


    <div class="modal fade" id="paymentModal" role="dialog">
        <div class="modal-dialog modal-lg paymentModal">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #A2C710;">
                    <h5 align="center">Upload Payment</h5>
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
                    <button type="submit" class="btn btn-success">Sumbit</button>
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>


                   
   
<?php
require_once "template/scripts.php";
?>

<script >
    $(document).ready(function() {
    $('#tbl_enrollment').DataTable();
});
</script>

<?php
require_once "template/studentFooter.php";
?>