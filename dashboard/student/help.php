<?php
require_once "template/studentHeader.php";
?>

<style>
    html {
        scroll-behavior: smooth;
    }

    #top {
      display: none;
      position: fixed;
      bottom: 20px;
      right: 30px;
      z-index: 1;
      border: none;
      outline: none;
      background-color: #605ca8;
      color: white;
      cursor: pointer;
      padding: 10px;
      border-radius: 10px;
      font-size: 15px;
    }

    #top:hover {
      background-color: #555;
</style>

<div class="container">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2>Help</h2>
</div>

     <button onclick="topFunction()" id="top">Back to top</button> 

<div>
    <ol>
        <li><a href="#help1">Where can I view the available course and schedules?</a></li>
        <li><a href="#help2">How do I request for a quotation?</a></li>
        <li><a href="#help3">How to enroll?</a></li>
        <li><a href="#help4">Where can I view my reservations?</a></li>
        <li><a href="#help5">What are the payment modes?</a></li>
        <li><a href="#help6">Do you accept installments?</a></li>
        <li><a href="#help7">How do I pay for my reservation?</a></li>
        <li><a href="#help8">Can I reschedule my training?</a></li>
        <li><a href="#help9">Do you acknowledge refunds?</a></li>
        <li><a href="#help10">How do I update my personal information?</a></li>
    </ol>
</div>

<div>
    <div id="help1" style="background-color:white;padding:8px 8px;border-radius:16px 16px;margin-bottom:5px;">
        <h5>Where can I view the available course and schedule?</h5>
        <p style="margin-left: 15px;">To view the available course and schedules, click the following links:</p>
            <ul>
                <li><a href="/Nexus/homepage/courses.php" target="_blank">Courses Offered</a></li>
                <li><a href="/Nexus/homepage/calendar.php" target="_blank">Course Calendar</a></li>
            </ul> 
        <p style="margin-left: 15px;">Stay updated for new promos. Follow us on our <a href="https://www.facebook.com/nxs88" target="_blank">facebook</a> page.</p>
    </div>

    <div id="help2" style="background-color:white;padding:8px 8px;border-radius:16px 16px;margin-bottom:5px;">
        <h5>How do I request for a quotation?</h5>
        <ul>
            <li>Select the <i class="fas fa-mail-bulk"></i> Quotation Requests tab.</li>
            <li>On the Quotation Requests Page, click the Add A Request button on the upper-right corner of the page.</li>
            <li>Fill in the required fields and click submit.</li>
            <li>Quotations will be sent to your e-mail within the day.</li>
        </ul>
    </div>

    <div id="help3" style="background-color:white;padding:8px 8px;border-radius:16px 16px;margin-bottom:5px;">
        <h5>How to enroll?</h5>
        <ol>
            <li>Select the <i class="fas fa-university"></i> Enrollment tab.</li>
            <li>On the Enrollment Page, click the Enroll button on the upper-right corner of the page.</li>
            <li>Select your desired course and schedule.</li>
            <li>You can view the Venue, Price, Available Slots and Instructor upon selecting a course and schedule.</li>
            <li>Click the Submit button once done.</li>
        </ol>
    </div>

    <div id="help4" style="background-color:white;padding:8px 8px;border-radius:16px 16px;margin-bottom:5px;">
        <h5>Where can I view my reservations?</h5>
        <ul>
            <li>Select the <i class="fas fa-university"></i> Enrollment tab to view UNPAID and PARTIALLY PAID reservations.</li>
            <li>Select the <i class="fas fa-users-cog"></i> Reservations tab to view FULLY PAID and CANCELLED reservations.</li>
            <li>Click the <i class="fas-fa-view"></i> View button to view the payment history for each reservation.</li>
        </ul>
    </div>

    <div id="help5" style="background-color:white;padding:8px 8px;border-radius:16px 16px;margin-bottom:5px;">
        <h5>What are the payment modes??</h5>
        <ul>
            <li><b>CASH</b></li>
            Pay at any of our branches:
            <ul>
                <li><b>MAKATI:</b> Unit 2417 24th Floor Cityland 10 Tower 2 154 H.V Dela Costa St. Ayala North, Makati City</li>
                <li><b>MANILA:</b> Room 401 Dona Amparo Bldg along Espana Boulevard corner Tolentino St., Espana, Manila</li>
            </ul>
            <li><b>BDO Deposit / BDO Online Bank Transfer</b></li>
            <ul>
                <li>Account Name: Nexus IT Training Center</li>
                <li>BDO Account Number: 002810078994</li>
            </ul>
            <li><b>CHEQUE</b></li>
            <ul>
                <li>All cheque payments must be payable to <b>NEXUS IT TRAINING CENTER</b>.</li>
            </ul>
        </ul>
    </div>

    <div id="help6" style="background-color:white;padding:8px 8px;border-radius:16px 16px;margin-bottom:5px;">
        <h5>Do you accept installments?</h5>
        <ul>
            <li>YES! A 50% downpayment is required to secure your slot.</li>
            <li>Balance must ba paid on or before the first day of training.</li>
        </ul>
    </div>

    <div id="help7" style="background-color:white;padding:8px 8px;border-radius:16px 16px;margin-bottom:5px;">
        <h5>How do I pay for my reservation?</h5>
        <ol>
            <li>Select the <i class="fas fa-university"></i> Enrollment tab.</li>
            <li>Select which reserved course you want to pay for in the Reserved Trainings table.</li>
            <li>Click the <button class="btn btn-sm btn-success"><i class="fas fa-hand-holding-usd"></i></button> Payment button.</li>
            <li>In the Payment window, select Add Payment.</li>
            <li>Upload a photo or a PDF file of your proof of payment.</li>
            <li>Click submit.</li>
            <li>Please wait for the confirmation of your slot through your e-mail.</li>
        </ol>
    </div>

    <div id="help8" style="background-color:white;padding:8px 8px;border-radius:16px 16px;margin-bottom:5px;">
        <h5>Can I reschedule my training?</h5>
        <ul>
            <li>Yes. Rescheduling of reervations should be done at least three (3) days prior the reserved schedule.</li>
            <li>Please contact us immediately to assist you if you wish to reschedule your reservations.</li>
            <ul>
                <li>MAKATI: +63 2 8362-3755</li>
                <li>MANILA: +63 2 8355-7759</li>
            </ul>
            <li>You can also message us through <a href="https://www.facebook.com/nxs88" target="_blank">facebook</a>.</li>
        </ul>
    </div>

    <div id="help9" style="background-color:white;padding:8px 8px;border-radius:16px 16px;margin-bottom:5px;">
        <h5>Do you acknowledge refunds?</h5>
        <ul>
            <li>Refund requests should be submitted at least three (3) days before your reserved schedule.</li>
            <li>NO REFUND if the student decides to backout on the first day of training.</li>
            <li>Submitting a refund request does not guarantee that the request will be accepted. Processing of refunds is subject to the discretion of the admins.</li>
            <li>Please give us one (1) week to process your request once accepted.</li>
        </ul>

        <div class="row">
            <div class="col-sm-6">
                <ol>
                    for <b>PARTIALLY PAID</b> reservations:
                    <li>Select the <i class="fas fa-university"></i> Enrollment tab.</li>
                    <li>Choose which reservation you want to cancel.</li>
                    <li>Click the <button class="btn btn-sm btn-danger"><i class="fas fa-times-circle"></i></button> Cancel button.</li>
                    <li>A Cancel Reservation window will appear, please read the terms and conditions.</li>
                    <li>State the reason for your request.</li>
                    <li>Click submit.</li>
                </ol>
            </div>
            <div class="col-sm-6">
                <ol>
                    For <b>FULLY PAID</b> reservations:
                    <li>Select the <i class="fas fa-check-double"></i> Fully Paid Reservations under the <i class="fas fa-users-cog"></i> Reservations Tab.</li>
                    <li>In the Fully Paid Reservations Page, select which course you want to cancel.</li>
                    <li>Click the <button class="btn btn-sm btn-danger"><i class="fas fa-times-circle"></i></button> Cancel button.</li>
                    <li>A Cancel Reservation window will appear, please read the terms and conditions.</li>
                    <li>State the reason for your request.</li>
                    <li>Click submit.</li>
                </ol>
            </div>
        </div>
    </div>
        
    <div id="help10" style="background-color:white;padding:8px 8px;border-radius:16px 16px;margin-bottom:5px;">
        <h5>How do I update my personal information?</h5>
        <ol>
            <li>Select the <i class="fas fa-user-edit"></i> Profile tab.</li>
            <li>Click the Edit button.</li>
            <li>Update your personal information.</li>
            <li>Click the Update button to save changes. </li>
        </ol>
    </div>
</div>




 
<script>
    //Get the button:
    mybutton = document.getElementById("top");

    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function() {scrollFunction()};

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
    }

    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
        document.body.scrollTop = 0; // For Safari
        document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
    } 
</script>   
<?php
require_once "template/scripts.php";
?>


<?php
require_once "template/studentFooter.php";
?>