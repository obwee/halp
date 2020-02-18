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
					<h4>CCNP and CCIE Enterprise Core</h4>
					<h4>Exam Code: 350 - 401</h4>

					<p>Duration: 5 days</p>
					<p>Time: 9:00 AM - 5:00 PM</p>
				</div>
				<hr>
				<div class="schedule">
					<h4>Available Schedule</h4>
					<select>
						<option>CCNP & CCIE Schedule</option>
					</select>
				</div>
				<hr>
				<div class="inclusions">
					<h4>Inclusions</h4>
					<ul>
						<li>1 year unlimited sit in</li>
						<li>E-books, installers, videos</li>
						<li>Certificate of Completion</li>
					</ul>
				</div>
			</div>
				<div class="col-sm-6">
				<div class="outline">
					<div class="outlineContent">
						<h4>Course Overview</h4>
						<p>Learn the latest version of CCNP and CCIE Encore with actual HANDS-ON LAB & "LEARN-BY-DOING" approach. Experience what Network Engineer does in their actual job by performing more than 20 network configurations.</p>
						<hr>
						<p style="font-weight: bold;">Part 1 Forwarding</p>
						<p>Packet Forwarding</p>
						<p style="font-weight: bold;">Part 2 Layer 2</p>
						<p>Spanning Tree Protocol</p>
						<p>Advanced STP Tuning</p>
						<p>Multiple Spanning Tree Protocol</p>
						<p>VLAN Trunks and EtherChannel Bundles</p>
						<p style="font-weight: bold;">Part 3 Routing</p>
						<p>IP Routing Essentials</p>
						<p>EIGRP</p>
						<p>OPSF</p>
						<p>Advanced OSPF</p>
						<p>OSPFv3</p>
						<p>BGP</p>
						<p>Advanced BGP</p>
						<p>Multicast</p>
						<p style="font-weight: bold;">Part 4 Services</p>
						<p>QoS</p>
						<p style="font-weight: bold;">Part 5 Overlay</p>
						<p>Overlay Tunnels</p>
						<p style="font-weight: bold;">Part 6 Wireless</p>
						<p>Wireless Signals and Modulations</p>
						<p>Wireless Infrastructure</p>
						<p>Understanding Wireless Roaming and Location Services</p>
						<p>Authenticating Wireless Clients</p>
						<p>Troubleshooting Wireless Connectivity</p>
						<p style="font-weight: bold;">Part 7 Architecture</p>
						<p>Enterprise Network Architecture</p>
						<p>Fabric Technologies</p>
						<p>Network Assurance</p>
						<p style="font-weight: bold;">Security</p>
						<p>Secure Network Access Control</p>
						<p>Network Device Access Control and Infrastructure Security</p>
						<p style="font-weight: bold;">SDN</p>
						<p>Virtualization</p>
						<p>Foundational Network Programmability Concepts</p>
						<p>Introduction to Automation Tools</p>
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