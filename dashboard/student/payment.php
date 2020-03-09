<?php
require_once "template/studentHeader.php";
?>


	<div class="container">
		<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
			<p class="h2">Payment</p>
		</div>
		<div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
			<table id="tbl_enrollment" style="width:100%" class="table table-striped table-bordered table-hover table-responsive-sm">
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
                <div class="modal-header" style="background-color: #A2C710;">
                    <h5 align="center">View Payment</h5>
                </div>
                
                <div class="modal-body">
                    
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


<?php
require_once "template/studentFooter.php";
?>