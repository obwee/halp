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
    }


  </style>

<div class="container">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"  style="padding-bottom: 10px;">
        <h2>Terms and Conditions</h2>
    </div>

    <button onclick="topFunction()" id="top"><i class="fas fa-arrow-alt-circle-up"></i></button> 


    <div>
        <ul class="list-group">
            <li class="list-group-item">NEXUS ITTC reserves the right to change schedules, instructors or even cancel a class if the need arises.</li>
            <li class="list-group-item">All schedule and fees are subject to change without prior notice.</li>
            <li class="list-group-item">Rescheduling of reservations should be done at least three (3) days prior the reserved schedule.</li>
            <li class="list-group-item">To reschedule, contact NEXUS ITTC at least three (3) days prior the reserved schedule.</li>
            <li class="list-group-item">Minimum of five (5) students to commence a class</li>
            <li class="list-group-item">Refunds are not allowed if the student decides to backout on the first day of class.</li>
            <li class="list-group-item">Refund requests should be submitted at least three (3) days prior the reserved schedule.</li>
            <li class="list-group-item">Submitting a refund request does not guarantee that the request will be accepted. Processing of refund requests are subject to the discretion of the administrators.</li>
            <li class="list-group-item">Walk-ins are accepted depending on the availability of slots.</li>
            <li class="list-group-item">Upon uploading a proof of payment, please wait for the confirmation of your slot via email.</li>
            <li class="list-group-item">Desktops, routers and switches will be provided for each student.</li>
            <li class="list-group-item">All trainings are inclusive of e-books, training manuals, reviewers and certificate of completion.</li>
            <li class="list-group-item">Students who wish to enroll must be at least a high school graduate.</li>
        </ul>
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