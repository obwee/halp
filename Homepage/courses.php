<?php

inlcude_once "utils/dbconnection.php";



?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<link href="https://fonts.googleapis.com/css?family=Bebas+Neue&display=swap" rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

	<title>Nexus IT Training Center</title>

</head>
<body>

	<div class="container"> 
		<div>
			<h2 style="font-family: sans-serif;">COURSE CALENDAR</h2>
		</div>
		<div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
			<table id="tbl_courses" style="width:100%" class="table table-striped table-bordered table-hover table-responsive-sm">
				<thead>
					<tr>
						<th style="white-space:nowrap;">Course Code</th>
                        <th style="white-space:nowrap;">Official Course Title</th>
                        <th style="white-space:nowrap;">Details</th>
						<th style="white-space:nowrap;">Venue</th>
						<th style="white-space:nowrap;">Schedule</th>
					</tr>
				</thead>	
				<tbody>
                    <tr>
                        <td>CCNAv4</td>
                        <td>Cisco Certified Network Associate v4</td>
                        <td>Implementing and Administering Cisco Solutions</td>
                        <td>
                        	<select class="form-control">
                        		<option>Makati</option>
                        		<option>Manila</option>
                        	</select>
                        </td>
                        <td></td>
                    </tr>
					
                </tbody>
			</table>
		</div>

<!--SCRIPTS--> 
<!--Font Awesome--> 
<script src="https://kit.fontawesome.com/be76a30cc4.js" crossorigin="anonymous"></script>
<!--jQuery--> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!--Bootstrap-->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!--Sweet Alert-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script src="js/homepage.js"></script>

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