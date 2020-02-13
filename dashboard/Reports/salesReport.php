<?php
include '../template/header.php';
?>

<div class="container">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<p class="h2">Student Master List</p>
	</div>

	<div class="form-group">
		<div class="row justify-content-md-center">
			<div class="col-xs-4">&nbsp&nbsp&nbsp&nbsp
				<label for="date1"><span class="fas fa-angle-double-left"></span> Start Date</label>
				<input type="date" class="form-control" id="date1" name="date1" placeholder="From" required style="margin-left:16px;width:185px;" max="2999-12-31">
			</div>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
			<div class="col-xs-4">
				<label for="date2"><span class="fas fa-angle-double-right"></span> End Date</label>
				<input type="date" class="form-control" id="date2" name="date2" placeholder="To" required max="2999-12-31">
			</div>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
			<!-- <div class="col-xs-4">
				<label for="tourStatus"><span class="fas fa-spinner"></span> Tour Status</label>
				<select class="form-control tourStatus" id="tourStatus" name="tourStatus" required>
					<option value="" selected disabled hidden>Select Tour Status</option>
					<option>E-mailed</option>
					<option>Approved</option>
					<option>Finished</option>
					<option>Cancelled</option>
				</select>
			</div> -->
		</div>
	</div>
	<div class="row justify-content-md-center">&nbsp&nbsp&nbsp&nbsp
		<div class="col-md-4 col-xs-4">
			<input type="submit" name="loadTours" id="loadTours" class="btn btn-success form-control loadTours" value="Generate Student List" />
		</div>
	</div>
	<br/><br/>

	<div class="container">
		<div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
			<table id="tbl_tours" class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th style="white-space:nowrap;">Student ID</th>
						<th style="white-space:nowrap;">First Name</th>
						<th style="white-space:nowrap;">Middle Name</th>
						<th style="white-space:nowrap;">Last Name</th>
						<th style="white-space:nowrap;">Email Address</th>
						<th style="white-space:nowrap;">Phone Number</th>
						<th style="white-space:nowrap;">Course</th>
						<th style="white-space:nowrap;">Schedule</th>
						<th style="white-space:nowrap;">Payment</th>
						<th>
							<select name="status" id="status" class="form-control status">
								<option value="" selected disabled hidden>Select Payment Status</option>
								<option value="All">All</option>
								<option value="Pending">Pending</option>
								<option value="Partial">Partial</option>
								<option value="Full">Full</option>
							</select>
						</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>

</div>

<style>
.dataTables_wrapper .dt-buttons {
	float:none;
	padding: 50;  
	text-align:center;
	left:31.9%;
}
</style>

<?php
include '../template/footer.php';
?>
