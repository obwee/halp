<?php
require_once "template/studentHeader.php";
?>

<div class="container">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<p class="h3">Enrollment</p>
	</div>

    <div align="left">
    <button type="button" id="enroll" data-toggle="modal" data-target="#enrollModal" class="btn btn-info btn-lg">Enroll</button>    
    </div>

    <br>

	<div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
		<table id="tbl_enrollment" style="width:100%" class="table table-striped table-bordered table-hover table-responsive-sm">
			<thead>
				<tr>
					<th style="white-space:nowrap;text-align:center;">Course Code</th>
                    <th style="white-space:nowrap;text-align:center;">Start Date</th>
                    <th style="white-space:nowrap;text-align:center;">End Date</th>
                    <th style="white-space:nowrap;text-align:center;">Venue</th>
                    <th style="white-space:nowrap;text-align:center;">Instructor</th>
                    <th style="white-space:nowrap;text-align:center;">Payment Status</th>
					<th style="white-space:nowrap;text-align:center;">Actions</th>
				</tr>
            </thead>
			<tbody>
                <tr>
                    <td>20410D</td>
                    <td>Mar 5, 2020</td>
                    <td>Mar 8, 2020</td>
                    <td>Makati</td>
                    <td>Mark Sampayan</td>
                    <td>Unpaid</td>
                    <td style="text-align:center;">
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
                    <button type="submit" class="btn btn-success">Upload</button>
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="enrollModal" role="dialog">
        <div class="modal-dialog enrollModal">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #A2C710;">
                    <h5 align="center">Enrollment</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label><i class="fas fa-book"></i> Course</label>
                        <select class="form-control">
                            <option selected disabled hidden>Select Course</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-calendar-alt"></i> Schedule</label>
                        <select class="form-control">
                            <option selected disabled hidden>Select Schedule</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-map"></i> Venue</label>
                        <input type="text" name="venue" class="form-control">
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-users"></i> Available Slots</label>
                        <input type="text" name="slots" class="form-control">
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-chalkboard"></i> Instructor</label>
                        <input type="text" name="instructor" class="form-control">
                    </div>          
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Enroll</button>
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
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