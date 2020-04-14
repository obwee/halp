<?php
require_once "template/header.php";
?>

<div class="container">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2><span class="fas fa-user-times"></span> Refund Requests</h2>
    </div>


    <div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
        <table id="tbl_refunds" style="width:100%" class="table table-striped table-bordered table-hover table-responsive-sm">
            <thead></thead>
            <tbody></tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="viewDetailsModal" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl viewDetailsModal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 align="center"></span>Training Details</h5>
            </div>
            <div class="modal-body">
                <div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
                    <table id="tbl_trainingDetails" style="width:100%" class="table table-striped table-bordered table-hover table-responsive-sm">
                        <thead></thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="viewRequestModal" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg viewRequestModal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 align="center">Refund Request Details</h5>
            </div>
            <div class="modal-body">
                <div style="border: 3px solid #d5d5d5;padding-top:5px;padding-left:5px;padding-right:5px;padding-bottom:0;border-radius: 4px 4px;margin-bottom:5px;">
                    <b>Student Details:</b>
                    <div class="form-group row" style="margin-left:15px;">
                        <label for="studentName" class="col-sm-3 col-form-label"><i class="fas fa-user"></i> Student Name</label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control-plaintext" id="studentName">
                        </div>
                        <label for="email" class="col-sm-3 col-form-label"><i class="fas fa-envelope"></i> E-mail</label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control-plaintext" id="email">
                        </div>
                        <label for="contact" class="col-sm-3 col-form-label"><i class="fas fa-phone"></i> Contact No.</label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control-plaintext" id="contactNum">
                        </div>
                    </div>
                </div>
                <br>
                <div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
                    <table id="tbl_paymentDetails" style="width:100%" class="table table-striped table-bordered table-hover table-responsive-sm">
                        <thead></thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php
require_once "template/scripts.php";
?>

<script src="/Nexus/utils/js/utils.Libraries.js"></script>
<script src="/Nexus/utils/js/utils.Validations.js"></script>
<script src="/Nexus/utils/js/utils.Forms.js"></script>

<script src="/Nexus/dashboard/js/admin/dashboard.refundRequests.js"></script>

<?php
require_once "template/footer.php";
?>