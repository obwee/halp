<?php
require_once "Template/header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

</head>
<body>
	<div class="container">
		<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
			<h2>Unpaid Reservations</h2>
		</div>

		<div class="row" style="border-radius:10px 10px;border-style:solid;border-color:#d5d5d5;padding:10px 10px;margin-left:10px;margin-right:10px;border-width:2px;">
			<div class="col-md-4">
				<div class="row">
					<div class="venue" style="padding-left:80px;">
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
			</div>
			<div class="col-md-4" style="padding-right: 50px;">
				<label><i class="fas fa-book"></i><b> Course</b></label>
				<select class="form-control">
					<option value="" selected disabled hidden>Select Course</option>
					<option>CCNAv4</option>
					<option>MCP</option>
				</select>&nbsp&nbsp
			</div>
			<div class="col-md-4" style="padding-right: 50px;">
				<label><i class="fas fa-calendar"></i><b> Schedule</b></label>
				<select class="form-control">
					<option value="" selected disabled hidden>Select Schedule</option>
				</select>&nbsp&nbsp
			</div>				
		</div>

		<br>
		<div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
			<table id="tbl_students" style="width:100%" class="table table-striped table-bordered table-hover table-responsive-sm">
				<thead>
					<tr>
                        <th style="white-space:nowrap;">Student Name</th>
                        <th style="white-space:nowrap;">Contact No.</th>
                        <th style="white-space:nowrap;">E-mail Address</th>
                        <th style="white-space:nowrap;">Course Code</th>
                        <th style="white-space:nowrap;">Venue</th>
                        <th style="white-space:nowrap;">Start Date</th>
                        <th style="white-space:nowrap;">End Date</th>
                        <th style="white-space:nowrap;">Balance</th>
					</tr>
                </thead>
				<tbody>
                    <tr>
                        <td>Mark Sale</td>
                        <td>5841881</td>
                        <td>marksale@gmail.com</td>
                        <td>20410D</td>
                        <td>Makati</td>
                        <td>Feb 28, 2020</td>
                        <td>Feb 29, 2020</td>
                        <td>10,000</td>
                    </tr>
                    <tr>
                        <td>Paula Digman</td>
                        <td>09956785590</td>
                        <td>pau.digman@yahoo.com</td>
                        <td>Makati</td>
                        <td>MCSA2016</td>
                        <td>Feb 23, 2020</td>
                        <td>Feb 25, 2020</td>
                        <td>22,000</td>
                    </tr>
                </tbody>    
			</table>
		</div>
	</div>


   
	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
		
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

	<script type="text/javascript">
		$(document).ready( function () {
			$('#tbl_students').DataTable()
		} );	
		    
	</script>


		
	</body>
</html>


	<?php
	require_once "Template/footer.php";
	?>