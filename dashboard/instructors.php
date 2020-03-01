<?php
require_once "Template/header.php";
?>

	<div class="container">
		<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
			<p class="h2">Instructors</p>

		</div>

		<div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
			<div align="right">
				<button type="button" id="addNewBranch" data-toggle="modal" data-target="#addNewInstructorModal" class="btn btn-info btn-lg">Add New Instructor</button>
				<br><br>
			</div>
			<table id="tbl_instructors" style="width:100%" class="table table-striped table-bordered table-hover table-responsive-sm">
				<thead>
					<tr>
						<th style="white-space:nowrap;">Instructor ID</th>
                        <th style="white-space:nowrap;">Full Name</th>
                        <th style="white-space:nowrap;">Contact No</th>
                        <th style="white-space:nowrap;">E-mail Address</th>
                        <th style="white-space:nowrap;">Vendor Certification</th>
						<th style="white-space:nowrap;">Actions</th>
					</tr>
                </thead>
				<tbody>
                    <tr>
                        <td>2020-01</td>
                        <td>Christopher I. Buenaventura</td>
                        <td>09955739974</td>
                        <td>cboz@live.com</td>
                        <td>MCSA2016, MCSA2012, CCNA, CVP, CCA-V</td>
                        <td>
                            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#messageInstructorModal"><i class="fas fa-comment-dots"></i></button>
                            <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>2020-02</td>
                        <td>Richard P. Reblando</td>
                        <td>09976548899</td>
                        <td>richardreblando@live.com</td>
                        <td></td>
                        <td>
                            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#messageInstructorModal"><i class="fas fa-comment-dots"></i></button>
                            <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="addNewInstructorModal" role="dialog">
        <div class="modal-dialog addNewInstructorModal">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #A2C710;">
                    <h5 align="center">Add New Instructor</h5>
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
                            <label for="instructorEmail"><span class="fas fa-envelope"></span> E-mail Address</label>
                            <input type="email" class="form-control" id="instructorEmail" name="instructorEmail" placeholder="E-mail Address" maxlength="50">
                        </div>
                        <div class="form-group">
                            <label for="instructorContact"><span class="fas fa-phone"></span> Contact Number</label>
                            <input type="text" class="form-control" id="instructorContact" name="instructorContact" placeholder="Contact Number" maxlength="11">
                        </div>
                        <div class="form-group">
                            <label for="instructorCertification"><span class="fas fa-certificate"></span> Vendor Certification</label>
                            <input type="text" class="form-control" id="instructorCertification" name="instructorCertification" placeholder="Vendor Certification" maxlength="50">
                        </div>
                        <div class="form-group">
                            <label for="instructorUsername"><span class="fas fa-users"></span> Username</label>
                            <input type="text" class="form-control" id="instructorUsername" name="instructorUsername" placeholder="Username" maxlength="50">
                        </div>
                        <div class="form-group">
                            <label for="instructorPassword"><span class="fas fa-lock"></span> Password</label>
                            <input type="password" class="form-control" id="instructorPassword" name="instructorPassword" placeholder="Password"  maxlength="50">
                        </div>
                    </form>
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