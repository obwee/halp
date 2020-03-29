<?php
require_once "Template/header.php";
?>

<div class="container">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <p class="h2">Payment Mode</p>
    </div>
    <div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
        <div align="right">
            <button type="button" id="addNewBranch" data-toggle="modal" data-target="#addPaymentMethodModal" class="btn btn-info btn-lg">Add New MOP</button>
            <br><br>
        </div>
        <table id="tbl_mop" style="width:100%" class="table table-striped table-bordered table-hover table-responsive-sm">
            <thead></thead>
            <tbody></tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="addPaymentMethodModal" role="dialog">
    <div class="modal-dialog addPaymentMethod">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #A2C710;">
                <h5 align="center">Add Mode of Payment</h5>
            </div>
            <form action="POST" id="addPaymentMethodForm">
                <div class="modal-body">
                    <div class="alert alert-danger error-msg" role="alert" style="display: none;"></div>
                    <div class="form-group">
                        <label for="firstName"><span class="fas fa-money"></span> Payment Mode</label>
                        <input type="text" class="form-control paymentMode" name="paymentMode" placeholder="Payment Mode" autofocus maxlength="20">
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <div class="spinner-border spinner" role="status" style="display:none;">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Add</button>
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editPaymentMethodModal" role="dialog">
    <div class="modal-dialog editPaymentMethod">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #A2C710;">
                <h5 align="center">Update Mode of Payment</h5>
            </div>
            <form action="POST" id="editPaymentMethodForm">
                <div class="modal-body">
                    <input type="text" class="methodId" name="methodId" readonly hidden>
                    <div class="alert alert-danger error-msg" role="alert" style="display: none;"></div>
                    <div class="form-group">
                        <label for="firstName"><span class="fas fa-money"></span> Payment Mode</label>
                        <input type="text" class="form-control paymentMode" name="paymentMode" placeholder="Payment Mode" autofocus maxlength="20">
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <div class="spinner-border spinner" role="status" style="display:none;">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Update</button>
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

<script src="/Nexus/dashboard/js/admin/dashboard.payment.js"></script>

<?php
require_once "template/footer.php";
?>