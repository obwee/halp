<?php
require_once "Template/header.php";
?>

<div class="container">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<p class="h2">Reservations</p>
	</div>

	<div class="row" style="border-radius:8px 8px;padding:10px 10px;margin-left:10px;margin-right:10px;border-width:2px;background-color:#fff;box-shadow:8px 8px #3c8dbc;">
		<div class="col-md-4">
			<div class="row">
				<div class="col-sm-6">
					<div class="venue" >
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
			<label><i class="fas fa-users"></i><b> No. of Students Enrolled</b></label>
			<input class="form-control form-inline" type="text" name="slots" readonly placeholder="1/15">
		</div>			
	</div>

	<div align="center">
		<br>
		<button type="button" id="addWalkin" class="btn btn-primary" data-toggle="modal" data-target="#addWalkinModal"><i class="fas fa-walking"></i> &nbsp&nbspAdd Walk-in&nbsp&nbsp</button>
        <button type="submit" id="clear" class="btn btn-danger"><i class="fas fa-eraser"></i> Clear Selection</button>
        <button type="submit" id="loadClassList" class="btn btn-success"><i class="fas fa-spinner"></i> Load Class List</button>
    </div>

	<br>
	<div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
		<table id="tbl_reserved" style="width:100%" class="table table-striped table-bordered table-hover table-responsive-sm">
			<thead>
				<tr>
					<th style="white-space:nowrap;">Student Name</th>
					<th style="white-space:nowrap;">Course Code</th>
					<th style="white-space:nowrap;">Venue</th>
					<th style="white-space:nowrap;">Start Date</th>
					<th style="white-space:nowrap;">End Date</th>
					<th style="white-space:nowrap;">MOP</th>
					<th style="white-space:nowrap;">Date Paid</th>
					<th style="white-space:nowrap;">Amount Paid</th>
					<th style="white-space:nowrap;">Status</th>
					<th style="white-space:nowrap;">Balance</th>
					<th style="white-space:nowrap;">Actions</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td style="text-align: center;">Mark Sale</td>
					<td style="text-align: center;">20410D</td>
					<td style="text-align: center;">Makati</td>
					<td style="text-align: center;">Feb 28, 2020</td>
					<td style="text-align: center;">Feb 29, 2020</td>
					<td style="text-align: center;">BDO</td>
					<td style="text-align: center;">Feb 20, 2020</td>
					<td style="text-align: center;">10,000</td>
					<td style="text-align: center;">Partial</td>
					<td style="text-align: center;">10,000</td>
					<td style="text-align: center;">
						<button class="btn btn-secondary" data-toggle="modal" data-target="#rescheduleModal"><i class="fas fa-calendar-day"></i></button>
					</td>
				</tr>
			</tbody>    
		</table>
	</div>
</div>


<div class="modal fade" id="rescheduleModal" role="dialog">
    <div class="modal-dialog rescheduleModal">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #3c8dbc;">
                <h5 align="center" style="color:white;"><i class="fas fa-calendar-day"></i> Reschedule</h5>
            </div>
            <div class="modal-body">
                <form>
                	<div class="form-group">
	                    <label for="name"><span class="fas fa-user"></span> Name of Student</label>
	                    <input type="text" name="studName" class="form-control" readonly>
                	</div>
                	<div class="form-group">
	                    <label for="currentCourse"><span class="fas fa-book"></span> Current Course</label>
	                    <input type="text" name="studName" class="form-control" readonly>
                	</div>
                	<div class="form-group">
	                    <label for="currentSchedule"><span class="fas fa-calendar"></span> Current Schedule</label>
	                    <input type="text" name="studName" class="form-control" readonly>
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
    <div class="modal-dialog addWalkinModal">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #3c8dbc;">
                <h5 align="center" style="color:white;">Add Walk-in</h5>
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
                <button type="submit" class="btn btn-info" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<?php
require_once "template/scripts.php";
?>

<script src="/Nexus/dashboard/js/admin/dashboard.reservations.js"></script>

<?php
require_once "template/footer.php";
?>