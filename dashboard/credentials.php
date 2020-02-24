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
			<p class="h2">Credentials</p>

		</div>

		<div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
			<div align="right">
                <button type="button" id="addNewBranch" data-toggle="modal" data-target="#editCredentialsModal" class="btn btn-info">Edit My Credentials</button>
				<button type="button" id="addNewBranch" data-toggle="modal" data-target="#addNewAdmin" class="btn btn-info">Add New Admin</button>
				<br><br>
			</div>
			<table id="tbl_users" style="width:100%" class="table table-striped table-bordered table-hover table-responsive-sm">
				<thead>
					<tr>
                        <th style="white-space:nowrap;">Full Name</th>
                        <th style="white-space:nowrap;">Username</th>
                        <th style="white-space:nowrap;">Account Type</th>
                        <th style="white-space:nowrap;">E-mail Address</th>
                        <th style="white-space:nowrap;">Contact Number</th>
						<th style="white-space:nowrap;">Actions</th>
					</tr>
                </thead>
				<tbody>
                    <tr>
                        <td>Angelika Aubrey Arbiol</td>
                        <td>aarbiol</td>
                        <td>Admin</td>
                        <td>angelikaaubreyarbiol@gmail.com</td>
                        <td>09261759759 </td>
                        <td>
                            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#editAdminCredentialsModal"><i class="fas fa-pen"></i></button>
                            <button class="btn btn-dark btn-sm" data-toggle="modal" data-target="#resetPasswordModal"><i class="fas fa-undo"></i></button>
                            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#disableAccountModal"><i class="fas fa-times"></i></button>
                        </td>
                    </tr>
                
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="resetPasswordModal" role="dialog">
        <div class="modal-dialog addNewAdmin">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #A2C710;">
                    <h5 align="center">Reset Password</h5>
                </div>
                
                <div class="modal-body" align="center">
                    Are you sure you want to reset the password for <p><strong>Angelika Aubrey Arbiol</strong></p>?
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Yes</button>
                    <button type="submit" class="btn btn-info" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="disableAccountModal" role="dialog">
        <div class="modal-dialog disableAccount">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #A2C710;">
                    <h5 align="center">Reset Password</h5>
                </div>
                
                <div class="modal-body" align="center">
                    Are you sure you want to disable the account of <p><strong>Angelika Aubrey Arbiol</strong></p>?
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Yes</button>
                    <button type="submit" class="btn btn-info" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="editCredentialsModal" role="dialog">
        <div class="modal-dialog editCredentials">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #A2C710;">
                    <h5 align="center">Edit Super Admin Credentials</h5>
                </div>
                
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="firstName"><span class="fas fa-id-card"></span> First Name</label>
                            <input type="text" class="form-control" id="firstName" name="branch" placeholder="First Name" autofocus maxlength="20">
                        </div>
                        <div class="form-group">
                            <label for="middleName"><span class="fas fa-id-card"></span> Middle Name</label>
                            <input type="text" class="form-control" id="middleName" name="middleName" placeholder="Middle Name" maxlength="20">
                        </div>
                        <div class="form-group">
                            <label for="lastName"><span class="fas fa-id-card"></span> Last Name</label>
                            <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last Name"  maxlength="20">
                        </div>
                        <div class="form-group">
                            <label for="adminEmail"><span class="fas fa-envelope"></span> E-mail Address</label>
                            <input type="email" class="form-control" id="adminEmail" name="adminEmail" placeholder="E-mail Address" maxlength="50">
                        </div>
                        <div class="form-group">
                            <label for="adminContact"><span class="fas fa-phone"></span> Contact Number</label>
                            <input type="text" class="form-control" id="adminContact" name="adminContact" placeholder="Contact Number" maxlength="11">
                        </div>
                        <div class="form-group">
                            <label for="adminUsername"><span class="fas fa-users"></span> Username</label>
                            <input type="text" class="form-control" id="instructorUsername" name="instructorUsername" placeholder="Username" maxlength="50">
                        </div>
                        <div class="form-group">
                            <label for="adminPassword"><span class="fas fa-lock"></span> Password</label>
                            <input type="password" class="form-control" id="adminPassword" name="adminPassword" placeholder="Password"  maxlength="50">
                        </div>
                        <div class="form-group">
                            <label for="adminPassword"><span class="fas fa-lock"></span> Confirm Password</label>
                            <input type="password" class="form-control" id="adminPassword" name="adminPassword" placeholder="Password"  maxlength="50">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Update</button>
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editAdminCredentialsModal" role="dialog">
        <div class="modal-dialog editAdminCredentials">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #A2C710;">
                    <h5 align="center">Edit Admin Credentials</h5>
                </div>
                
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="firstName"><span class="fas fa-id-card"></span> First Name</label>
                            <input type="text" class="form-control" id="firstName" name="branch" placeholder="First Name" autofocus maxlength="20">
                        </div>
                        <div class="form-group">
                            <label for="middleName"><span class="fas fa-id-card"></span> Middle Name</label>
                            <input type="text" class="form-control" id="middleName" name="middleName" placeholder="Middle Name" maxlength="20">
                        </div>
                        <div class="form-group">
                            <label for="lastName"><span class="fas fa-id-card"></span> Last Name</label>
                            <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last Name"  maxlength="20">
                        </div>
                        <div class="form-group">
                            <label for="adminEmail"><span class="fas fa-envelope"></span> E-mail Address</label>
                            <input type="email" class="form-control" id="adminEmail" name="adminEmail" placeholder="E-mail Address" maxlength="50">
                        </div>
                        <div class="form-group">
                            <label for="adminContact"><span class="fas fa-phone"></span> Contact Number</label>
                            <input type="text" class="form-control" id="adminContact" name="adminContact" placeholder="Contact Number" maxlength="11">
                        </div>
                        <div class="form-group">
                            <label for="adminUsername"><span class="fas fa-users"></span> Username</label>
                            <input type="text" class="form-control" id="instructorUsername" name="instructorUsername" placeholder="Username" maxlength="50">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Update</button>
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="messageInstructorModal" role="dialog">
        <div class="modal-dialog modal-lg messageInstructorModal">
            <div class="modal-content">
                <div class="modal-header">
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
                    <button class="btn btn-dark btn-sm">Upload File</button>
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
			$('#tbl_users').DataTable();
	
		} );	
		    
	</script>


		
	</body>
</html>


	<?php
	require_once "Template/footer.php";
	?>