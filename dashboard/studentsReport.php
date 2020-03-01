<?php
require_once "Template/header.php";
?>

    <style type="text/css">
        td {
            text-align: center;
        }

        select {
            width: 180px;
            text-align: center;
        }
    </style>

<div class="container">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <p class="h2">Students Report</p>
    </div>
    
	<div class="container">
		<div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
			<div align="center">
                <br>
                <button type="button" id="print" class="btn btn-dark">Export/Print</button>
                <br><br>     
            </div>

            <br>

            <table id="tbl_students" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th style="white-space:nowrap;">Student ID</th>
                        <th style="white-space:nowrap;">Student Name</th>
                        <th style="white-space:nowrap;">E-mail Address</th>
                        <th style="white-space:nowrap;">Contact Number</th>
                        <th style="white-space:nowrap;">Address</th>
                        <th style="white-space:nowrap;">Username</th>
                        <th style="white-space:nowrap;">Age</th>
                        <th style="white-space:nowrap;">Company Name</th>                        
                        <th style="white-space:nowrap;">Company Address</th>
                        <th style="white-space:nowrap;">Work</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>2020-030101</td>
                        <td>Aries Valenzuela Macandili</td>
                        <td>macandili.aries@gmail.com</td>
                        <td>09222222222</td>
                        <td>Hulo, Mandaluyong</td>
                        <td>aries</td>
                        <td>25</td>
                        <td>Simplex Internet Philippines</td>
                        <td>Ortigas, Pasig City</td>
                        <td>Web Developer</td>
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




<?php
require_once "template/scripts.php";
?>

<script src="js/dashboard.studentsReport.js"></script>

<?php
require_once "template/footer.php";
?>
