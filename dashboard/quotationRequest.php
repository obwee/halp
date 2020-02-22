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
			<p class="h2">Quotation Requests</p>

		</div>

		<div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
			<div align="right">
				<button type="button" id="addNewQuoteRequest" data-toggle="modal" data-target="#addQuoteModal" class="btn btn-info btn-lg">Add a Request</button>
				<br><br>
			</div>
			<table id="tbl_quotations" style="width:100%" class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th style="white-space:nowrap;">Date Requested</th>
						<th style="white-space:nowrap;">Student Name</th>
						<th style="white-space:nowrap;">Company Name</th>
						<th style="white-space:nowrap;">E-mail Address</th>
						<th style="white-space:nowrap;">Contact No.</th>
						<th style="white-space:nowrap;">Course</th>
						<th style="white-space:nowrap;">Schedule</th>
						<th style="white-space:nowrap;">Actions</th>
					</tr>
				</thead>
					<tr>
						<td>2020-Feb-21</td>
						<td>Aries V. Macandili</td>
						<td>Simplex Chuchu</td>
						<td>skkagawadaries@gmail.com</td>
						<td>09222222222</td>
						<td>Ethical Hacking with Penetration Testing</td>
						<td></td>
						<td><button class="btn btn-dark" data-toggle="modal" data-target="#addQuoteModal">View</button></td>
					</tr>
			</table>
		</div>
	</div>

	<div class="container">
		<div class="modal fade" id="addQuoteModal" role="dialog" data-backdrop="static" data-keyboard="false" style="z-index: 2000;">
			<div class="modal-dialog vertical-align-center">
				<div class="modal-content">
					<div class="modal-header" id="book_Animation" style="padding:10px 10px;">
						<h5 align="center"><span class="glyphicon glyphicon-plane"></span>Add a Booking Request</h5>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<div id="alert_message_book"></div>
					</div>
					<div class="modal-body" style="padding:30px 50px;">
						<form method="post" id="addBookForm">
							<div id="clientDiv">
								<div class="form-group">
									<label for="fname"><span class="fas fa-user-circle"></span> First Name</label>
									<input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" maxlength="25"autofocus required>
								</div>
								<div class="form-group">
									<label for="mname"><span class="fas fa-user-circle"></span> Middle Name</label>
									<input type="text" class="form-control" id="mname" name="mname" placeholder="Middle Name" maxlength="25">
								</div>
								<div class="form-group">
									<label for="lname"><span class="fas fa-user-circle"></span> Last Name</label>
									<input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" maxlength="25" required>
								</div>
								<div class="form-group">
									<label for="phoneNum"><span class="fas fa-mobile-alt"></span> Phone Number</label>
									<input type="text" class="form-control" id="phoneNum" name="phoneNum" placeholder="Phone Number" minlength = "7" maxlength = "12" required>
								</div>
								<div class="form-group">
									<label for="telNum"><span class="fas fa-phone"></span> Telephone Number (Optional)</label>
									<input type="text" class="form-control" id="telNum" name="telNum" placeholder="Telephone Number" minlength = "7" maxlength = "7">
								</div>
								<div class="form-group">
									<label for="emailAdd"><span class="fas fa-envelope"></span> E-mail</label>
									<input type="email" class="form-control" id="emailAdd" name="emailAdd" placeholder="E-mail"  maxlength="50" required>
								</div>
							</div>
							<div class="form-group">
								<label for="tour_packageType"><span class="fas fa-plane-departure"></span> Type of Flight</label>
								<select class="form-control" id="tour_packageType" name="tour_packageType" required>
									<option value="" selected disabled hidden>Select Flight Type</option>
									<option>Individual</option>
									<option>Corporate</option>
									<option>Deluxe</option>
								</select>
							</div>
							<div class="form-group">
								<label for="numPax"><span class="fas fa-list-ol"></span> Number of Persons</label>
								<input type="text" class="form-control" id="numPax" name="numPax" placeholder="No. of Persons"  maxlength="3" required>
							</div>
							<div class="form-group">
								<label for="packageDeals"><span class="fas fa-cube"></span> Package Inclusions</label>
								<div class="form-check">
									<div class="row">
										<div class='col-md-5 offset-md-1'>
											<input class="form-check-input" type="checkbox" value="4" id="checkboxTransportation" name="checkbox[]"><label class="form-check-label">Transportation</label><br>
											<input class="form-check-input" type="checkbox" value="1" id="checkboxAccommodation" name="checkbox[]"><label class="form-check-label">Accommodation</label><br>
										</div>
										<div class='col-md-5'>
											<input class="form-check-input" type="checkbox" value="3" id="checkboxTours" name="checkbox[]"><label class="form-check-label">Tours</label><br>
											<input class="form-check-input" type="checkbox" value="2" id="checkboxAll" name="checkbox[]"><label class="form-check-label">All-in-One</label><br>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="origin"><span class="fas fa-location-arrow"></span> Origin</label>
								<input type="text" class="form-control origin" id="origin" name="origin" placeholder="Origin"  maxlength="50" required autocomplete="off">
								<div id="originList"></div>
							</div>
							<div class="form-group">
								<label for="tour_Destination" id="tour_DestinationLabel"><span class="fas fa-globe-asia"></span> Destination</label>
								<input type="text" class="form-control tour_Destination" id="tour_Destination" name="tour_Destination[]" placeholder="Destination" maxlength="25" autocomplete="off" required>
								<div id="destinationList"></div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-xs">&nbsp&nbsp&nbsp&nbsp
										<label for="tour_fromDate"><span class="fas fa-angle-double-left"></span> From</label>
										<input type="date" class="form-control tour_fromDate" id="tour_fromDate" name="tour_fromDate[]" placeholder="From" required style="margin-left:16px;width:185px;" max="2999-12-31">
									</div>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
									<div class="col-xs">
										<label for="tour_toDate"><span class="fas fa-angle-double-right"></span> To</label>
										<input type="date" class="form-control tour_toDate" id="tour_toDate" name="tour_toDate[]" placeholder="To" required max="2999-12-31">
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-xs">&nbsp&nbsp&nbsp&nbsp
										<label for="tour_numDays"><span class="fas fa-sun"></span> No. of Days</label>
										<input type="number" class="form-control tour_numDays" id="tour_numDays" name="tour_numDays[]" placeholder="No. of Days" required readonly="true" style="margin-left:16px;width:185px;">
									</div>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
									<div class="col-xs">
										<label for="tour_numNights"><span class="fas fa-moon"></span> No. of Nights</label>
                  <!-- <select class="form-control tour_numNights" id="tour_numNights" name="tour_numNights[]" style="width:190px;" required readonly='true'>
                    <option value="" selected disabled hidden>No. of Nights</option>
                </select> -->
                <input type="number" class="form-control tour_numNights" id="tour_numNights" name="tour_numNights[]" placeholder="No. of Nights" required readonly="true" style="margin-left:16px;width:185px;">
            </div>
        </div>
    </div>
    <div id="newTour"></div>
    <div class="form-group text-center">
    	<button type="button" id="deleteTour" class="btn btn-warning">Delete Tour</button>
    </div>
    <div class="form-group text-center">
    	<button type="button" id="addAnotherTour" class="btn btn-info">Add Another Tour</button>
    </div>
    <div class="form-group">
    	<label for="tour_message"><span class="fas fa-comments"></span> Message (Optional)</label>
    	<textarea class="form-control" id="tour_message" name="tour_message" rows="7" placeholder="Type your additional request here."></textarea>
    </div>
    <div class="form-group text-center">
    	<label class="form-check-label" style="font-size:13px"></label>
    	<input class="form-check-input" type="checkbox" value="2" id="checkboxCorrect" name="checkboxCorrect" required />I hereby declare that the details furnished above are true and correct to the best of my knowledge and belief and I undertake to inform you of any changes therein, immediately.
    </div>
    <br>
    <div class="form-row text-center">
    	<div class="col">
    		<input type="submit" name="book_submitButton" id="book_submitButton" class="btn btn-success form-control" value="Submit" />
    	</div>
    	<div class="col">
    		<button type="button" class="btn btn-primary form-control" id="book_closeButton" data-dismiss="modal">Close</button>
    		<input type="hidden" name="operation" class="operation" id="operation">
    		<input type="hidden" name="clientID" class="clientID" id="clientID">
    	</div>
    </div>
</form>
</div>
</div>
</div>
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
			$('#tbl_quotations').DataTable();

		} );	
		    
	</script>


		
	</body>
</html>


	<?php
	require_once "Template/footer.php";
	?>