<?php
require_once "template/header.php";
?>

<div class="container">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <p class="h4">Finished Trainings</p>
    </div>
    <div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
        <table id="tbl_finishedTrainings" style="width:100%" class="table table-striped table-bordered table-hover">
            <thead></thead>
            <tbody></tbody>
        </table>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="viewClassList" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Student List</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div style="border: 3px solid #d5d5d5;padding-top:5px;padding-left:5px;padding-right:5px;padding-bottom:0;border-radius: 4px 4px;margin-bottom:5px;">
                    <b>Training Details:</b>
                    <div class="form-group row" style="margin-left:15px;">
                        <label for="courseName" class="col-sm-3 col-form-label"><span class="fas fa-book"></span> <b>Course</b></label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control-plaintext" id="courseName">
                        </div>
                        <label for="schedule" class="col-sm-3 col-form-label"><span class="fas fa-calendar-alt"></span> <b>Schedule</b></label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control-plaintext" id="schedule">
                        </div>
                        <label for="venue" class="col-sm-3 col-form-label"><span class="fas fa-map"></span> <b>Venue</b></label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control-plaintext" id="venue">
                        </div>
                        <label for="instructor" class="col-sm-3 col-form-label"><span class="fas fa-chalkboard-teacher"></span> <b>Instructor</b></label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control-plaintext" id="instructor">
                        </div>
                    </div>
                </div>
                <div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
                    <table id="tbl_studentList" style="width:100%" class="table table-striped table-bordered table-hover">
                        <thead></thead>
                        <tbody></tbody>
                        <tfoot>
                            <tr>
                                <th>
                                <th>
                                <th>
                                <th>
                                <th>
                                <th>
                                <th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>

<div class="modal fade" id="clearBalanceModal" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md clearBalanceModal">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #3c8dbc;">
                <h5 align="center" style="color:white;"><i class="fas fa-check-double"></i> Clear Balance</h5>
            </div>
            <form action="POST" id="clearBalanceForm">
                <div class="modal-body">
                    <div class="alert alert-danger error-msg" role="alert" style="display: none;"></div>
                    <input type="hidden" name="paymentId" class="form-control paymentId">
                    <div class="form-group">
                        <label><i class="fas fa-money"></i><b> Proof of Payment</b></label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input paymentFile" name="paymentFile">
                            <label class="custom-file-label" for="customFile">Upload File</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-money"></i><b> MOP</b></label>
                        <select class="form-control modeOfPayment" name="modeOfPayment"></select>
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-money"></i><b> Amount Paid</b></label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">₱</span>
                            </div>
                            <input type="text" name="paymentAmount" class="form-control paymentAmount">
                        </div>
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-money"></i><b> Old Balance</b></label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">₱</span>
                            </div>
                            <input type="text" class="form-control oldBalance" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-money"></i><b> New Balance</b></label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">₱</span>
                            </div>
                            <input type="text" class="form-control newBalance" readonly>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <div class="spinner-border spinner" role="status" style="display:none;">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Accept</button>
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
require_once "template/scripts.php";
?>

<script src="/Nexus/utils/js/utils.Libraries.js"></script>
<script src="/Nexus/utils/js/utils.Validations.js"></script>
<script src="/Nexus/utils/js/utils.Forms.js"></script>

<script src="/Nexus/dashboard/js/admin/dashboard.finishedTrainings.js"></script>

<?php
require_once "template/footer.php";
?>