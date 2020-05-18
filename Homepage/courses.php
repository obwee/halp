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
				<tbody></tbody>
			</table>

			<p style="text-align:center;font-size:18px;">**All prices are subject to change without prior notice.</p>
			<p style="text-align:center;font-size:18px;">**All prices are TAX inclusive.</p>
		</div>

<!--SCRIPTS--> 
<?php
require_once "template/scripts.php";
?>

<script>
var oCourses = (function() {

	function init() {
		getAvailableCoursesAndSchedules();
	};

    function getAvailableCoursesAndSchedules() {
        axios.get('/Nexus/utils/ajax.php?class=Forms&action=fetchHomepageData')
            .then(function (oResponse) {
				console.log(oResponse.data);
            });
    }

	return {
		initialize: init
	};

})();

$(document).ready(function() {
	oCourses.initialize();
});

</script>

</body>
</html>