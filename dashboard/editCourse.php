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
			<p class="h2">Courses</p>

		</div>

		<div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
			<div align="right">
				<button type="button" id="addNewCourse" data-toggle="modal" data-target="#addCourseModal" class="btn btn-info btn-lg">Add New Course</button>
				<br><br>
			</div>
			<table id="tbl_courses" style="width:100%" class="table table-striped table-bordered table-hover table-responsive-sm">
				<thead>
					<tr>
						<th style="white-space:nowrap;">Course Code</th>
                        <th style="white-space:nowrap;">Official Course Title</th>
                        <th style="white-space:nowrap;">Details</th>
						<th style="white-space:nowrap;">Actions</th>
					</tr>
				<tbody>
                    <tr>
                        <td>CCNAv4</td>
                        <td>Cisco Certified Network Associate v4</td>
                        <td>Implementing and Administering Cisco Solutions</td>
                        <td>
                            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#editCourseModal"><i class="fas fa-pen"></i></button>
                            <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                        </td>
                    </tr>
					<tr>
                        <td>CCNP ENCORE</td>
                        <td>Cisco Certified Network Professional</td>
                        <td>Implementing and Operating Cisco Enterprise Network Core Technologies</td>
                        <td>
                            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#editCourseModal"><i class="fas fa-pen"></i></button>
                            <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>CCNP</td>
                        <td>Cisco Certified Network Professional</td>
                        <td>Implementing Cisco Enterprise Advanced Routing and Services</td>
                        <td>
                            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#editCourseModal"><i class="fas fa-pen"></i></button>
                            <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>MCSA2012</td>
                        <td>Microsoft Certified Solutions Associate in Windows Server 2012</td>
                        <td>20410D, 20411D, 20412D</td>
                        <td>
                            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#editCourseModal"><i class="fas fa-pen"></i></button>
                            <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>MCSA2016</td>
                        <td>Microsoft Certified Solutions Associate in Windows Server 2016</td>
                        <td>20740, 20741, 20742</td>
                        <td>
                            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#editCourseModal"><i class="fas fa-pen"></i></button>
                            <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>AZ-1003T00-A</td>
                        <td>Microsoft Certified Azure Administrator</td>
                        <td></td>
                        <td>
                            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#editCourseModal"><i class="fas fa-pen"></i></button>
                            <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>SAA-C02</td>
                        <td>AWS Certified Solutions Architect - Associate</td>
                        <td></td>
                        <td>
                            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#editCourseModal"><i class="fas fa-pen"></i></button>
                            <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>CWS-215</td>
                        <td>VMware vSPhere 6.7 ICM</td>
                        <td>Install, Configure and Manage</td>
                        <td>
                            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#editCourseModal"><i class="fas fa-pen"></i></button>
                            <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>EH</td>
                        <td>Ethical Hacking with Penetration Testing</td>
                        <td></td>
                        <td>
                            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#editCourseModal"><i class="fas fa-pen"></i></button>
                            <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>CysA+</td>
                        <td>Certified Cybersecurity Analyst+</td>
                        <td></td>
                        <td>
                            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#editCourseModal"><i class="fas fa-pen"></i></button>
                            <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                        </td>
                    </tr>
			</table>
		</div>
	</div>

    <div class="modal fade" id="addCourseModal" role="dialog">
        <div class="modal-dialog modal-lg vertical-align-center addCourseModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 align="center"><span class="glyphicon glyphicon-plane"></span>Add Course</h5>
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