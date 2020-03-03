<?php
require_once "template/studentHeader.php";
?>


	<div class="container">
		<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
			<p class="h2">Payment</p>
		</div>
		<div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
			<div align="right">
				<button type="button" id="addNewBranch" data-toggle="modal" data-target="#enrollModal" class="btn btn-info btn-lg">Enroll</button>
				<br><br>
			</div>
			<table id="tbl_enrollment" style="width:100%" class="table table-striped table-bordered table-hover table-responsive-sm">
				<thead>
					<tr>
						<th style="white-space:nowrap;">Date Submitted</th>
                        <th style="white-space:nowrap;">Course</th>
                        <th style="white-space:nowrap;">Start Date</th>
                        <th style="white-space:nowrap;">End Date</th>
                        <th style="white-space:nowrap;">Venue</th>
						<th style="white-space:nowrap;">Actions</th>
					</tr>
                </thead>
				<tbody>
                    <tr>
                        <td>Mar 3, 2020</td>
                        <td>MCP 20410</td>
                        <td>Mar 8, 2020</td>
                        <td>Mar 10, 2020</td>
                        <td>Makati</td>
                        <td>
                            <button class="btn btn-dark btn-sm"><i class="fas fa-eye"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="enrollModal" role="dialog">
        <div class="modal-dialog enrollModal">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #A2C710;">
                    <h5 align="center">Enrollment</h5>
                </div>
                
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="firstName"><span class="fas fa-id-card"></span> First Name</label>
                            <input type="text" class="form-control" id="firstName" name="branch" placeholder="First Name" autofocus maxlength="20">
                        </div>
                        <div class="form-group">
                            <label for="middleName"><span class="fas fa-id-card"></span> Middle Name</label>
                            <input type="text" class="form-control" id="middleName" name="middleName" readonly>
                        </div>
                        <div class="form-group">
                            <label for="lastName"><span class="fas fa-id-card"></span> Last Name</label>
                            <input type="text" class="form-control" id="lastName" name="lastName" readonly>
                        </div>
                        <div class="form-group">
                            <label for="studentEmail"><span class="fas fa-envelope"></span> E-mail Address</label>
                            <input type="studentEmail" class="form-control" id="studentEmail" name="studentEmail" readonly>
                        </div>
                        <div class="form-group">
                            <label for="studentPhone"><span class="fas fa-phone"></span> Contact Number</label>
                            <input type="text" class="form-control" id="studentPhone" name="studentPhone" readonly>
                        </div>
                        <div class="form-group">
                            <label for="course"><span class="fas fa-book"></span> Course</label>
                            <select class="form-control">
                                <option selected disabled hidden>Select a course</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="schedule"><span class="fas fa-calendar-alt"></span> Schedule</label>
                            <select class="form-control">
                                <option selected disabled hidden>Select a schedule</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Enroll</button>
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="rescheduleModal" role="dialog">
        <div class="modal-dialog rescheduleModal">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #A2C710;">
                    <h5 align="center">Reschedule</h5>
                </div>
                
                <div class="modal-body">
                    <table id="tbl_instructors" style="width:100%" class="table table-striped table-bordered table-hover table-responsive-sm">
                        <thead>
                            <tr>
                                <th style="white-space:nowrap;">Course Code</th>
                                <th style="white-space:nowrap;">Start Date</th>
                                <th style="white-space:nowrap;">End Date</th>
                                <th style="white-space:nowrap;">Venue</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>20410D</td>
                                <td>Mar 5, 2020</td>
                                <td>Mar 8, 2020</td>
                                <td>Makati</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="form-group">
                        <label for="schedule"><span class="fas fa-calendar-alt"></span> New Schedule</label>
                        <select class="form-control">
                            <option disabled selected hidden>Select New Schedule</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="slots"><span class="fas fa-users"></span> Available Slots</label>
                        <input type="text" class="form-control" id="slots" name="slots" readonly>
                    </div>
                    <div class="form-group">
                        <label for="venue"><span class="fas fa-map"></span> Venue</label>
                        <input type="text" class="form-control" id="venue" name="venue" readonly>
                    </div>
                    <div class="form-group">
                        <label for="instructor"><span class="fas fa-chalkboard-teacher"></span> Instructor</label>
                        <input type="text" class="form-control" id="instructor" name="instructor" readonly>
                    </div>
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

<script src="js/studentDash.Enrollment.js"></script>

<?php
require_once "template/studentFooter.php";
?>