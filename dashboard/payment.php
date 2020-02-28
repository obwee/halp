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
			<h2><span class="fas fa-cash-register"></span> Payment</h2>
		</div>

		<div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
			<table id="tbl_students" style="width:100%" class="table table-striped table-bordered table-hover table-responsive-sm">
				<thead>
					<tr>
						<th style="white-space:nowrap;">Payment ID</th>
						<th style="white-space:nowrap;">Student Name</th>
						<th style="white-space:nowrap;">Course Code</th>
						<th style="white-space:nowrap;">Venue</th>
						<th style="white-space:nowrap;">Start Date</th>
						<th style="white-space:nowrap;">End Date</th>
						<th style="white-space:nowrap;">Actions</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>1</td>
						<td>Mark Sale</td>
						<td>20410D</td>
						<td>Makati</td>
						<td>Feb 28, 2020</td>
						<td>Feb 29, 2020</td>
						<td>
							<button class="btn btn-info btn-sm" data-toggle="modal" data-target="#viewPayment"><i class="fa fa-eye"></i></button>
							<button class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#messageStudent"><i class="fa fa-comments"></i></button>
						</td>
					</tr>
				</tbody>    
			</table>
		</div>
	</div>

	<div class="modal fade" id="viewPayment" role="dialog">
		<div class="modal-dialog modal-lg viewPayment">
			<div class="modal-content">
				<div class="modal-header">
					<h5 align="center">View Payment</h5>
				</div>

				<div class="modal-body">
					<div class="paymentImage" style="border-style:solid;border-width:2px;padding:50px 50px;">

					</div> <br>
					<div class="row" style="border-radius:10px 10px;border-style:solid;border-color:#d5d5d5;padding:10px 10px;margin-left:10px;margin-right:10px;border-width:2px;">
						<div class="col-sm-6">
							<div class="col-sm-6">
								<div class="paymentStatus"> 
									<label><i class="fas fa-money"></i><b> MOP</b></label>
									<br>
									<select class="form-control">
										<option value="" selected disabled hidden>Select MOP</option>
										<option>BDO</option>
										<option>Cash</option>
										<option>Cheque</option>
									</select>
								</div>	
							</div>
							<br><br>
							<div class="col-sm-6">
								<div class="paymentStatus"> 
									<label><i class="fas fa-money"></i><b> Payment</b></label>
									<br>
									<div class="custom-control custom-radio">
										<input type="radio" class="custom-control-input" id="partial" name="" value="">
										<label class="custom-control-label" for="partial">Partial</label>
									</div>
									<div class="custom-control custom-radio">
										<input type="radio" class="custom-control-input" id="full" name="" value="">
										<label class="custom-control-label" for="full">Full</label>
									</div>
								</div>	
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group"> 
								<label><i class="fas fa-calendar"></i><b> Date Paid</b></label>
								<input type="date" name="" class="form-control">
							</div>
							<div class="form-group">
								<label><i class="fas fa-calendar"></i><b> Amount Paid</b></label>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text">₱</span>
									</div>
									<input type="text" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<label><i class="fas fa-calendar"></i><b> Remaining Balance</b></label>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text">₱</span>
									</div>
									<input type="text" class="form-control" readonly>
								</div>
							</div>	
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<button type="submit" class="btn btn-success">Accept</button>
					<button type="submit" class="btn btn-danger">Reject</button>
					<button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="messageStudent" role="dialog">
		<div class="modal-dialog modal-lg messageStudent">
			<div class="modal-content">
				<div class="modal-header">
					<h5 align="center">Message Student</h5>
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