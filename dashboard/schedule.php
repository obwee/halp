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
			<p class="h2">Schedules</p>

		</div>

		<div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
			<div align="right">
				<button type="button" id="addNewCourse" data-toggle="modal" data-target="#addScheduleModal" class="btn btn-info btn-lg">Add New Schedule</button>
				<br><br>
			</div>
			<table id="tbl_courses" style="width:100%" class="table table-striped table-bordered table-hover table-responsive-sm">
				<thead>
					<tr>
                        <th style="white-space:nowrap;">Official Course Title</th>
                        <th style="white-space:nowrap;">Start</th>
                        <th style="white-space:nowrap;">End</th>
                        <th style="white-space:nowrap;">Venue</th>
                        <th style="white-space:nowrap;">Instructor</th>
						<th style="white-space:nowrap;">Actions</th>
					</tr>
				<tbody>
                    <tr>
                        <td>Cisco Certified Network Associate V4: Implementing and Administering Cisco Solutions</td>
                        <td>Mar 5, 2020</td>
                        <td>Mar 10, 2020</td>
                        <td>Manila</td>
                        <td>Christopher Buenaventura</td>
                        <td>
                            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#editCourseModal"><i class="fas fa-pen"></i></button>
                            <button class="btn btn-danger  btn-sm"><i class="fas fa-trash-alt"></i></button>
                        </td>
                    </tr>
					<tr>
                        <td>Ethical Hacking with Penetration Testing</td>
                        <td>Mar 29, 2020</td>
                        <td>Mar 30, 2020</td>
                        <td>Manila</td>
                        <td>Richard Reblando</td>
                        <td>
                            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#editCourseModal"><i class="fas fa-pen"></i></button>
                            <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>Cisco Certified Network Associate V4: Implementing and Administering Cisco Solutions</td>
                        <td>May 1, 2020</td>
                        <td>May 5, 2020</td>
                        <td>Makati</td>
                        <td>Christopher Buenaventura</td>
                        <td>
                            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#editCourseModal"><i class="fas fa-pen"></i></button>
                            <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                        </td>
                    </tr>
			</table>
		</div>
	</div>

    <div class="modal fade" id="addScheduleModal" role="dialog">
        <div class="modal-dialog modal-lg vertical-align-center addCourseModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 align="center"><span class="fas fa-calendar"></span> Add New Schedule</h5>
                </div>
                
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="courseTitle"><span class="fas fa-users"></span> Select Course</label>
                            <select class="form-control">
                                
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-4">
                                <label for="date1"><span class="fas fa-angle-double-left"></span>Start Date</label>
                                <input type="date" class="form-control" id="date1" name="date1" placeholder="From" required style="margin-left:16px;width:185px;" max="2999-12-31">
                            </div>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                            <div class="col-xs-4">
                                <label for="date2"><span class="fas fa-angle-double-right"></span>End Date</label>
                                <input type="date" class="form-control" id="date2" name="date2" placeholder="To" required style="margin-left:16px;width:185px;" max="2999-12-31">
                            </div>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                        </div>
                        <div class="form-group">
                            <label for="courseVenue"><span class="fas fa-map"></span> Select Venue</label>
                            <select class="form-control">
                                <option>Makati</option>
                                <option>Manila</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="courseInstructor"><span class="fas fa-users"></span> Instructor</label>
                            <select class="form-control">
                                
                            </select>
                        </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Add</button>
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editCourseModal" role="dialog">
        <div class="modal-dialog modal-lg vertical-align-center editCourseModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 align="center"><span class="glyphicon glyphicon-plane"></span>Edit Course</h5>
                </div>
                
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="courseCode">Course Code</label>
                            <input type="test" class="form-control" id="courseCode" name="courseCode" placeholder="Course Code" autofocus maxlength="15">
                        </div>
                        <div class="form-group">
                            <label for="courseTitle"><span class="fas fa-users"></span> Course Title</label>
                            <input type="test" class="form-control" id="courseCode" name="courseCode" placeholder="Course Title" autofocus maxlength="50">
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

    

   
	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
		
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

	<script type="text/javascript">
		$(document).ready( function () {
			$('#tbl_courses').DataTable();
	
		} );	
		    
	</script>


		
	</body>
</html>


	<?php
	require_once "Template/footer.php";
	?>