<?php
require_once "template/studentHeader.php";
?>


    <div class="container">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <p class="h2"><i class="fas fa-times"></i> Cancelled Reservations</p>
        </div>
        <div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
            <table id="tbl_partialPayment" style="width:100%" class="table table-striped table-bordered table-hover table-responsive-sm">
                <thead>
                    <tr>
                        <th style="white-space:nowrap;text-align:center;">Course</th>
                        <th style="white-space:nowrap;text-align:center;">Start Date</th>
                        <th style="white-space:nowrap;text-align:center;">End Date</th>
                        <th style="white-space:nowrap;text-align:center;">Venue</th>
                        <th style="white-space:nowrap;text-align:center;">Training Fee</th>
                        <th style="white-space:nowrap;text-align:center;">Amount Paid</th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="text-align: center;">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

 
    
   
<?php
require_once "template/scripts.php";
?>

<script src="/Nexus/dashboard/js/student/student.partialPayment.js"></script>

<?php
require_once "template/studentFooter.php";
?>