<?php
require_once "Template/header.php";
?>

	<div class="container">
		<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
			<p class="h2">Edit Payment Mode</p>

		</div>

		<div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
			<div align="right">
				<button type="button" id="addNewBranch" data-toggle="modal" data-target="#addNewMOP" class="btn btn-info btn-lg">Add New MOP</button>
				<br><br>
			</div>
			<table id="tbl_instructors" style="width:100%" class="table table-striped table-bordered table-hover table-responsive-sm">
				<thead>
					<tr>
						<th style="white-space:nowrap;">Payment Mode</th>
						<th style="white-space:nowrap;">Actions</th>
					</tr>
                </thead>
				<tbody>
                    <tr>
                        <td>Cash</td>
                        <td>
                            <button class="btn btn-danger"><i class="fas fa-trash-alt"></i> Remove</button>
                        </td>
                    </tr>
                    <tr>
                        <td>BDO</td>
                        <td>
                            <button class="btn btn-danger"><i class="fas fa-trash-alt"></i> Remove</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Cheque</td>
                        <td>
                            <button class="btn btn-danger"><i class="fas fa-trash-alt"></i> Remove</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="addNewMOP" role="dialog">
        <div class="modal-dialog addNewInstructorModal">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #A2C710;">
                    <h5 align="center">Add New Mode of Payment</h5>
                </div>
                
                <div class="modal-body">
                        <div class="form-group">
                            <label for="firstName"><span class="fas fa-money"></span> Payment Mode</label>
                            <input type="text" class="form-control" id="paymentMode" name="paymentMode" placeholder="paymentMode" autofocus maxlength="20">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Add</button>
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="messageInstructorModal" role="dialog">
        <div class="modal-dialog modal-lg messageInstructorModal">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #A2C710;">
                    <h5 align="center">Send a Message</h5>
                </div>
                
                <div class="modal-body">
                    <div class="form-group">
                        <label for="subjectQuote"><span class="fas fa-envelope"></span> Subject</label>
                        <input type="text" class="form-control" id="subjectQuote" name="subjectQuote" placeholder="Subject" autofocus maxlength="30">
                    </div>
                    <div class="form-group">
                        <label for=quoteMessage><span class="fas fa-envelope-open-text"></span> Message</label>
                        <textarea class="form-control" id="emailMsg" name="emailMsg" rows="10" placeholder="Type your message here."></textarea>
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

<script src="js/dashboard.instructors.js"></script>

<?php
require_once "template/footer.php";
?>