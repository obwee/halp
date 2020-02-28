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

    <style type="text/css">
        td {
            text-align: center;
        }

        select {
            width: 180px;
            text-align: center;
        }
    </style>

</head>
<body>

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

            <table id="tbl_tours" class="table table-striped table-bordered table-hover">
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
    			<div class="modal-header">
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
                <div class="modal-header">
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

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

	<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

	<script type="text/javascript">
		$(document).ready( function () {
			$('#tbl_tours').DataTable({
                "scrollX": true
            });

		} );	

	</script>



</body>
</html>


<?php
require_once "Template/footer.php";
?>