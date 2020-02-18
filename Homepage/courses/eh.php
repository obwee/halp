<!DOCTYPE html>
<html>
<head>
	<title>Nexus IT Training Center</title>

</head>

<body>

	<?php
	require 'Homepage/courses/courseHeader.php';
	?>

	<div class="padding">
		<div class="container">
			<div class="col-sm-6">
				<div class="trainingDetails">
					<h2>Training Details</h2>
				</div>
				<div class="content">
					<h4>Ethical Hacking with Penetration Testing</h4>

					<p>Duration: 2 days</p>
					<p>Time: 9:00 AM - 5:00 PM</p>
				</div>
				<hr>
				<div class="schedule">
					<h4>Available Schedule</h4>
					<select>
						<option>Ethical Hacking Schedule</option>
					</select>
				</div>
				<hr>
				<div class="inclusions">
					<h4>Inclusions</h4>
					<ul>
						<li>3 Hacking Servers</li>
						<li>E-books</li>
						<li>Certificate of Completion</li>
					</ul>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="outline">
					<div class="outlineContent">
						<h4>Course Overview</h4>
						<p>Test your network's vulnerabilities by and defend your network by learning and performing there 7 hacking attacks:</p>
						<ul>
							<li>Brute force password attack</li>
							<li>Ophcrack password attack using Armitage</li>
							<li>Different types of Social Engineering attack</li>
							<li>Cross-site scripting, SQL injection and Trojan attack</li>
							<li>Cloning the site using website attack vector</li>
							<li>Email harvesting using Metasploit Framework</li>
							<li>Reconnaissance using WIRESHARK, NMAP and NETSTAT</li>
						</ul>
					</div>
				</div>		
			</div>
		</div>

		<!--Get Quote Modal-->

		<div class="modal fade" id="getQuoteModal" tabindex="-1" role="dialog">
			<div class="modal-dialog getQuoteModal">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h5 style="font-size: 20px; text-align: center; font-family:sans-serif;">Get Quote</h5>
					</div>
					<div class="modal-body">
						<div class="alert alert-danger error-msg" role="alert" style="display: none;"></div>
						<form method="post" id="quotationForm">

							<div class="form-group">
								<label for="quoteFname"><span class="fas fa-user-circle"></span> First Name</label>
								<input type="text" class="form-control" id="quoteFname" name="quoteFname" placeholder="First Name" autofocus maxlength="30">
							</div>
							<div class="form-group">
								<label for="quoteMname"><span class="fas fa-user-circle"></span> Middle Name</label>
								<input type="text" class="form-control" id="quoteMname" name="quoteMname" placeholder="Middle Name" autofocus maxlength="30">
							</div>
							<div class="form-group">
								<label for="quoteLname"><span class="fas fa-user-circle"></span> Last Name</label>
								<input type="text" class="form-control" id="quoteLname" name="quoteLname" placeholder="Last Name" autofocus maxlength="30">
							</div>
							<div class="form-group">
								<label for="quoteContactNum"><span class="fas fa-user-circle"></span> Contact Number</label>
								<input type="text" class="form-control" id="quoteContactNum" name="quoteContactNum" placeholder="Contact Number" autofocus maxlength="13">
							</div>
							<div class="form-group">
								<label for="quoteEmail"><span class="fas fa-envelope"></span> E-mail Address</label>
								<input type="email" class="form-control" id="quoteEmail" name="quoteEmail" placeholder="E-mail Address" maxlength="50">
							</div>
							<div class="form-group">
								<label for="quoteCompanyName"><span class="far fa-building"></span> Company Name (if company sponsored)</label>
								<input type="text" class="form-control" id="quoteCompanyName" name="quoteCompanyName" placeholder="Company Name" maxlength="50">
							</div>
							<div class="form-group">
								<label for="quoteCourse"><span class="far fa-users-class"></span> Course</label>
								<input type="text" class="form-control" id="quoteCourse" name="quoteCourse" placeholder="Course" autofocus maxlength="50">
							</div>
							<div class="form-group">
								<label for="quoteSchedule"><span class="fas fa-calendar-week"></span> Schedule</label>
								<input type="text" class="form-control" id="quoteSchedule" name="quoteSchedule" placeholder="Schedule" autofocus maxlength="50">
							</div>
							<div class="form-group">
								<p class="h6">To see available course and schedule, <a href="">Click here</a></p>
							</div>
							<div class="modal-footer">
								<button type="submit" class="btn btn-success">Submit</button>
								<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

	</body>
	</html>