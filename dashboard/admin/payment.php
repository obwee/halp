<?php
require_once "Template/header.php";
?>

	<div class="container">
		<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
			<h2><span class="fas fa-cash-register"></span> Payment</h2>
		</div>

		<div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
			<table id="tbl_payment" style="width:100%" class="table table-striped table-bordered table-hover table-responsive-sm">
				<thead>
					<tr>
						<th style="white-space:nowrap;text-align:center;">Transaction ID</th>
						<th style="white-space:nowrap;text-align:center;">Student Name</th>
						<th style="white-space:nowrap;text-align:center;">Course Code</th>
						<th style="white-space:nowrap;text-align:center;">Venue</th>
						<th style="white-space:nowrap;text-align:center;">Start Date</th>
						<th style="white-space:nowrap;text-align:center;">End Date</th>
						<th style="white-space:nowrap;text-align:center;">Actions</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td style="text-align:center;">1</td>
						<td style="text-align:center;">Mark Sale</td>
						<td style="text-align:center;">20410D</td>
						<td style="text-align:center;">Makati</td>
						<td style="text-align:center;">Feb 28, 2020</td>
						<td style="text-align:center;">Feb 29, 2020</td>
						<td style="text-align:center;">
							<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#viewPayment"><i class="fa fa-eye"></i></button>
						</td>
					</tr>
				</tbody>    
			</table>
		</div>
	</div>

	<div class="modal fade" id="viewPayment" role="dialog">
		<div class="modal-dialog modal-xl viewPayment">
			<div class="modal-content">
				<div class="modal-header" style="background-color: #3c8dbc;">
					<h5 align="center" style="color:white;"><i class="fas fa-eye"></i> View Payment</h5>
				</div>

				<div class="modal-body">
					<div class="row">
						<div class="col-sm-6">
							<div class="paymentImage" style="border-style:solid;border-width:1px;width:100%;height:100%;">
							</div>
						</div>
						<div class="row" style="border-radius:10px 10px;border-style:solid;border-color:#d5d5d5;padding:10px 10px;width:50%;border-width:2px;">
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
									<label><i class="fas fa-money"></i><b> Amount Paid</b></label>
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text">₱</span>
										</div>
										<input type="text" class="form-control">
									</div>
								</div>
								<div class="form-group">
									<label><i class="fas fa-money"></i><b> Remaining Balance</b></label>
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
				<div class="modal-header" style="background-color: #A2C710;">
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
					<div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFile">
                        <label class="custom-file-label" for="customFile">Upload File</label>
                    </div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-success">Send</button>
					<button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
				</div>
			</div>
		</div>
	</div>

<?php
require_once "template/scripts.php";
?>

<script src="/Nexus/dashboard/js/admin/dashboard.payment.js"></script>

<?php
require_once "template/footer.php";
?>