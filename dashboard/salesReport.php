<?php
require_once "Template/header.php";
?>


    <style type="text/css">
        td {
            text-align: center;
        }
    </style>


<div class="container">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <p class="h2">Sales Report</p>
    </div>

    <div class="form-group">
        <div class="row justify-content-md-center">
            <div class="col-xs-4">&nbsp&nbsp&nbsp&nbsp
                <label for="date1"><span class="fas fa-angle-double-left"></span> Start Date</label>
                <input type="date" class="form-control" id="date1" name="date1" placeholder="From" required style="margin-left:16px;width:185px;" max="2999-12-31">
            </div>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            <div class="col-xs-4">
                <label for="date2">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<span class="fas fa-angle-double-right"></span> End Date</label>
                <input type="date" class="form-control" id="date2" name="date2" placeholder="To" required max="2999-12-31">&nbsp&nbsp
            </div>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
        </div>
    </div>
    <div class="row justify-content-md-center">
        <div class="col-md-4 col-xs-4">
            <input type="submit" name="loadSales" id="loadSales" class="btn btn-success form-control loadSales" value="Load Sales">
        </div>
    </div>
</div>
    
	<div class="container">
		<div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
			<div align="center">
                <br>
                <button type="button" id="addNewCourse" data-toggle="modal" data-target="#addCourseModal" class="btn btn-dark">Export/Print</button>
                <br><br>     
            </div>
            <div class="filter" style="border-style:solid;border-width:1px;padding:5px 5px;border-color:#d5d5d5;border-radius:15px 15px;margin-left: 150px;margin-right: 150px">
                
                <div class="row"> 
                    <div class="paymentStatus col" style="padding-left:90px;">
                        <h6><b>Payment Status</b></h6>   
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                            <label class="form-check-label" for="inlineCheckbox1">Full</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                            <label class="form-check-label" for="inlineCheckbox2">Partial</label>
                        </div>
                    </div>
                    <div class="modeOfPayment col">
                        <h6><b>Mode of Payment</b></h6>   
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                            <label class="form-check-label" for="inlineCheckbox1">BDO</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                            <label class="form-check-label" for="inlineCheckbox2">Cash</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                            <label class="form-check-label" for="inlineCheckbox2">Cheque</label>
                        </div>
                    </div>  
                </div>
            </div>

            <br>

            <table id="tbl_sales" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th style="white-space:nowrap;">Date Paid</th>
                        <th style="white-space:nowrap;">Student Name</th>
                        <th style="white-space:nowrap;">Company Name</th>
                        <th style="white-space:nowrap;">Course Enrolled</th>
                        <th style="white-space:nowrap;">Start Date</th>
                        <th style="white-space:nowrap;">End Date</th>
                        <th style="white-space:nowrap;">MOP</th>
                        <th style="white-space:nowrap;">Course Amount</th>
                        <th style="white-space:nowrap;">Amount Paid</th>
                        <th style="white-space:nowrap;">Payment Status</th>
                        <th style="white-space:nowrap;">Approved By</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>2020-03-01</td>
                        <td>Aries Valenzuela Macandili</td>
                        <td>Simplex Internet Philippines</td>
                        <td>Ethical Hacking with Penetration Testing</td>
                        <td>2020-03-21</td>
                        <td>2020-03-22</td>
                        <td>Cheque</td>
                        <td>P 3,000</td>
                        <td>P 3,000</td>
                        <td>Full</td>
                        <td>Aubrey Arbiol</td>
                    </tr>
                </tbody>
            </table>
		</div>
	</div>

	<div class="modal fade" id="viewQuoteModal" tabindex="-1" role="dialog">
    	<div class="modal-dialog viewQuoteModal">
    		<div class="modal-content">
    			<div class="modal-header" style="background-color: #A2C710;">
    				<h5 align="center"><span class="glyphicon glyphicon-plane"></span>View Quotation</h5>
    			</div>
    			<div class="modal-body">
    				<div class="quoteBody">
    					
    				</div>
    			</div>
    			<div class="modal-footer">
    				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
    			</div>
    		</div>
    	</div>
    </div>

    <!--Get Quote Modal-->

    <div class="modal fade" id="editQuoteModal" role="dialog">
        <div class="modal-dialog editQuoteModal">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #A2C710;">
                	<h5 align="center"><span class="glyphicon glyphicon-plane"></span>Edit Quotation Request</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" id="quotationForm">
                        <div class="form-group">
                            <label for="quoteCourse"><span class="fas fa-book"></span> Course</label>
                            <select class="form-control">
                            	
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="scheduleType"><span class="fas fa-calendar-week"></span> Schedule </label>
                            <select class="form-control">
                            	
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#sendRequestModal">Update</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="sendRequestModal" role="dialog">
    	<div class="modal-dialog modal-lg sendRequestModal">
    		<div class="modal-content">
    			<div class="modal-header">
    				<h5 align="center"><span class="glyphicon glyphicon-plane"></span>Send Updated Quotation Request</h5>
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



<?php
require_once "template/scripts.php";
?>

<script src="js/dashboard.salesReport.js"></script>

<?php
require_once "template/footer.php";
?>
