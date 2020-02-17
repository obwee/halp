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
					<h4>Cisco Certified Network Associate Version 4</h4>
					<h5>Implementing and Administering Cisco Solutions</h5>
					<h4>Exam Code: 200 - 301</h4>

					<p>Duration: 5 days</p>
					<p>Time: 9:00 AM - 5:00 PM</p>
				</div>
				<hr>
				<div class="schedule">
					<h4>Available Schedule</h4>
					<select>
						<option>CCNA v4 Schedule</option>
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
						<p>Learn the latest version of CCNA with actual HANDS-ON LAB & "LEARN-BY-DOING" approach. Experience what Network Engineer does in their actual job by performing more than 20 network configurations.</p>
						<hr>
						<p style="font-weight: bold;">1.0 Network Fundamentals</p>
						<p>Network components</p>
						<p>Network topology architectures</p>
						<p>Compare physical interface and cabling types</p>
						<p>Identify interface and cable issues (collisions, errors, mismatch duplex and/or speed</p>
						<p>Compare TCP to UDP</p>
						<p>Configure and cerify IPv4 addressing and subnetting</p>
						<p>Describe the need for private IPv4 addressing</p>
						<p>Configure and verify IPv6 addressing and prefix</p>
						<p>Compare IPv6 address types</p>
						<p>Verify IP parameters for Client OS (Windows, Mac OS, Linux)</p>
						<p>Describe wireless principles</p>
						<p>Explain virtualization fundamentals</p>
						<p>Describe switching concepts</p>
						<hr>
						<p style="font-weight: bold;">2.0 Network Access 20%</p>
						<p>VLAN</p>
						<p>Cisco Doscovery Protocol and LLDP</p>
						<p>Etherchannel</p>
						<p>Spanning Tree Protocol</p>
						<p>Compare Cisco Wireless Architecture and AP Modes</p>
						<p>Infrastructure connections of WLAN components</p>
						<p>AP and WLC management access connections</p>
						<p>Configure components of WLAN access for client connectivity</p>
						<hr>
						<p style="font-weight: bold;">3.0 IP Connectivity 25%</p>
						<p>Routing</p>
						<p>Determine how long a router makes a forwarding decision by default</p>
						<p>IPv4 and IPv6 Static Routing</p>
						<p>Single area OSPFv2</p>
						<p>Firt hop redundanct protocol</p>
						<hr>
						<p style="font-weight: bold;">4.0 IP Services 10%</p>
						<p>Network Address Translation</p>
						<p>NTP client and server mode</p>
						<p>DHCP and DNS</p>
						<p>SNMP</p>
						<p>Syslog</p>
						<p>DHCP client and relay</p>
						<p>QoS</p>
						<p>SSH</p>
						<p>TFTP/FTP</p>
						<hr>
						<p style="font-weight: bold;">5.0 Security Fundamentals</p>
						<p>Key Security Concepts</p>
						<p>Security program elements</p>
						<p>Device access control using local passwords</p>
						<p>Security password policies elements</p>
						<p>Remote access and Site-to-site VPNs</p>
						<p>L2 Security Features</p>
						<p>Authentication, authorization, accounting concepts</p>
						<p>WPA, WPA2, WPA3</p>
						<p>WLAN usig WPA2 PSK</p>
						<hr>
						<p style="font-weight: bold;">6.0 Automation and Programmability 10%</p>
						<p>Impacts of automation in network management</p>
						<p>Traditional networks vs. Controller-based networks</p>
						<p>Contoller-based and software defined architectures</p>
						<p>REST-based APIs</p>
						<p>Puppet, Chef and Ansible</p>
						<p>Interpret JSON encoded data</p>
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