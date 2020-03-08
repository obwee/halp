<?php
require_once "template/header.php";
?>

<div class="container">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<p class="h2">Payment</p>

	</div>

	<div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
		<div align="right">
			<button type="button" id="addNewCourse" data-toggle="modal" data-target="#addScheduleModal" class="btn btn-info btn-lg">Add New Payment</button>
			<br><br>
		</div>
		<table id="tbl_courses" style="width:100%" class="table table-striped table-bordered table-hover table-responsive-sm">
			<thead>
				<tr>
					<th style="white-space:nowrap;">Student Name</th>
					<th style="white-space:nowrap;">Course Code</th>
					<th style="white-space:nowrap;">Start Date</th>
					<th style="white-space:nowrap;">End Date</th>
					<th style="white-space:nowrap;">MOP</th>
					<th style="white-space:nowrap;">Date Paid</th>
					<th style="white-space:nowrap;">Status</th>
					<th style="white-space:nowrap;">Actions</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Aubrey Arbiol</td>
					<td>20410D</td>
					<td>Feb 28, 2020</td>
					<td>Feb 29, 2020</td>
					<td>BDO Bank Deposit</td>
					<td>Feb 20, 2020</td>
					<td>Partial</td>
					<td></td>
				</tr>
				<tr>
					<td>Paula Digman</td>
					<td>MCSA2016</td>
					<td>Feb 23, 2020</td>
					<td>Feb 25, 2020</td>
					<td></td>
					<td></td>
					<td>Unpaid</td>
					<td></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>

<?php
require_once "template/scripts.php";
?>

<script src="/Nexus/dashboard/admin/js/dashboard.paidStudents.js"></script>

<?php
require_once "template/footer.php";
?>