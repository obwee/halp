<?php
require_once "template/studentHeader.php";
?>


	<div class="container">
		<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
			<p class="h2"><i class="fas fa-check-double"></i> Fully Paid Reservations</p>
		</div>
		<div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
			<table id="tbl_fullPayment" style="width:100%" class="table table-striped table-bordered table-hover table-responsive-sm">
				<thead>
					<tr>
						<th style="white-space:nowrap;text-align:center;">Date Submitted</th>
                        <th style="white-space:nowrap;text-align:center;">Course</th>
                        <th style="white-space:nowrap;text-align:center;">Start Date</th>
                        <th style="white-space:nowrap;text-align:center;">End Date</th>
                        <th style="white-space:nowrap;text-align:center;">Venue</th>
						<th style="white-space:nowrap;text-align:center;">Actions</th>
					</tr>
                </thead>
				<tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td align="center">
                            <button class="btn btn-dark btn-sm" data-toggle="modal" data-target="#viewPaymentModal"><i class="fas fa-eye"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

 
    <div class="modal fade" id="viewPaymentModal" role="dialog">
        <div class="modal-dialog modal-lg viewPaymentModal">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #605ca8;">
                    <h5 align="center" style="color:white;">View Payment History</h5>
                </div>
                <div class="modal-body">
                        
                    <div style="border: 3px solid #d5d5d5;padding-top:5px;padding-left:5px;padding-right:5px;padding-bottom:0;border-radius: 4px 4px;margin-bottom:5px;">
                        <b>Training Details:</b>
                        <div class="form-group row" style="margin-left:15px;">
                            <label for="course" class="col-sm-3 col-form-label"><span class="fas fa-book"></span> <b>Course</b></label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" id="course" value="Ethical Hacking with Penetration Testing">
                            </div>

                            <label for="sched" class="col-sm-3 col-form-label"><span class="fas fa-calendar-alt"></span> <b>Schedule</b></label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" id="sched" value="April 29 - 30, 2020">
                            </div>

                            <label for="venue" class="col-sm-3 col-form-label"><span class="fas fa-map"></span> <b>Venue</b></label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" id="venue" value="Makati">
                            </div>

                            <label for="instructor" class="col-sm-3 col-form-label"><span class="fas fa-chalkboard-teacher"></span> <b>Instructor</b></label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" id="course" value="Richard Reblando">
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
                        <table id="tbl_paymentDetails" style="width:100%" class="table table-striped table-bordered table-hover table-responsive-sm">
                            <thead>
                                <tr style="white-space:nowrap;text-align:center;">
                                    <th>Date Paid</th>
                                    <th>MOP</th>
                                    <th>Training Fee</th>
                                    <th>Amount Paid</th>
                                    <th>Remaining Balance</th>
                                    <th>Payment Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="text-align: center;">
                                    <td>April 1, 2020</td>
                                    <td>BDO</td>
                                    <td>P3,000.00</td>
                                    <td>P3,000.00</td>
                                    <td>P0.00</td>
                                    <td>Fully Paid</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

   
<?php
require_once "template/scripts.php";
?>

<script src="/Nexus/dashboard/js/student/student.fullPayment.js"></script>

<?php
require_once "template/studentFooter.php";
?>