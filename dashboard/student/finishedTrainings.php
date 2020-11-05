<?php
require_once "template/studentHeader.php";
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.1/css/lightbox.min.css">

<div class="container">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <p class="h2"><i class="fas fa-check-double"></i> Finished Trainings</p>
    </div>
    <div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
        <!-- <table id="tbl_fullPayment" style="width:100%" class="table table-striped table-bordered table-hover table-responsive-sm"> -->
        <table id="tbl_trainings" style="width:100%" class="table table-striped table-bordered table-hover table-responsive-sm">
            <thead></thead>
            <tbody></tbody>
        </table>
    </div>
</div>


<div class="modal fade" id="viewPaymentModal" role="dialog">
    <div class="modal-dialog modal-lg viewPaymentModal">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #605ca8;">
                <h5 align="center" style="color:white;">View Payment</h5>
            </div>
            <div class="modal-body">
                <div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
                    <table id="tbl_paymentDetails" style="width:100%" class="table table-striped table-bordered table-hover table-responsive-sm">
                        <thead>
                            <tr>
                                <td>Date Paid</td>
                                <td>Amount Paid</td>
                                <td>MOP</td>
                                <td>Actions</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>April 15, 2020</td>
                                <td>20,000</td>
                                <td>Cash</td>
                                <td>
                                    <button class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



<?php
require_once "template/scripts.php";
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.1/js/lightbox.min.js"></script>

<script src="/Nexus/utils/js/utils.Libraries.js"></script>
<script src="/Nexus/utils/js/utils.Validations.js"></script>
<script src="/Nexus/utils/js/utils.Forms.js"></script>

<!-- <script src="/Nexus/dashboard/js/student/student.fullPayment.js"></script> -->
<script src="/Nexus/dashboard/js/student/student.finishedTrainings.js"></script>

<?php
require_once "template/studentFooter.php";
?>