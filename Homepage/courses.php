<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "nexus";

$con = new mysqli($host, $username, $password, $database);

if($con->connect_error){
	echo $con->connect_error;
}

$sql = "SELECT * FROM tbl_courses";
$courses = $con->query($sql) or die ($con->error);
$aCourses = $courses->fetch_assoc();


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
			<h3 style="font-family: 'Bebas Neue', cursive;font-size:50px;text-align:center;">NEXUS IT TRAINING CENTER</h3>
			<h3 style="font-family: 'Bebas Neue', cursive;font-size:40px;text-align:center;">COURSES OFFERED</h3>
			
			<div class="col-sm-12" align="center">
				<a href="https://www.tiny.cc/erihez" target="_blank" style="text-decoration:none;font-size:20px;">View Course Outline |</a>
				<a href="calendar.php" target="_blank" style="text-decoration:none;font-size:20px;">View Course Calendar</a>
			</div>
		</div>
		<div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
			<table id="tbl_courses" style="width:100%" class="table table-striped table-bordered table-hover table-responsive-sm">
				<thead>
					<tr>
						<th style="white-space:nowrap;">Course Code</th>
                        <th style="white-space:nowrap;">Official Course Title</th>
                        <th style="white-space:nowrap;">Details</th>
						<th style="white-space:nowrap;">Price</th>
					</tr>
				</thead>	
				<tbody>
					<?php do{ ?>
					<tr>
						<td><?php echo $aCourses['examCode'];?></td>
						<td><?php echo $aCourses['courseName'];?></td>
						<td><?php echo $aCourses['courseDescription'];?></td>
						<td><?php echo $aCourses['coursePrice'];?></td>
					</tr>
				<?php }while($aCourses = $courses->fetch_assoc())?>
                </tbody>
			</table>

			<p style="text-align:center;font-size:18px;">**All prices are subject to change without prior notice.</p>
			<p style="text-align:center;font-size:18px;">**All prices are TAX inclusive.</p>
		</div>

<!--SCRIPTS--> 
<!--Font Awesome--> 
<script src="https://kit.fontawesome.com/be76a30cc4.js" crossorigin="anonymous"></script>
<!--jQuery--> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!--Bootstrap-->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


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