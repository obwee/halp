<?php
require_once "Template/header.php";
?>

<div class="container">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <p class="h2">Venues</p>
    </div>
    <div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
        <div align="right">
            <button type="button" id="addNewBranch" data-toggle="modal" data-target="#addNewBranchModal" class="btn btn-info btn-lg">Add New Branch</button>
            <br><br>
        </div>
        <table id="tbl_venue" style="width:100%" class="table table-striped table-bordered table-hover table-responsive-sm">
            <thead></thead>
            <tbody></tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="addNewBranchModal" role="dialog">
    <div class="modal-dialog modal-lg addNewBranchModal">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #A2C710;">
                <h5 align="center">Add New Branch</h5>
            </div>
            <form name="addVenueForm" method="POST">
                <div class="modal-body">
                    <div class="alert alert-danger error-msg" role="alert" style="display: none;"></div>
                    <div class="form-group">
                        <label for="branch"><span class="fas fa-map-pin"></span> Branch</label>
                        <input type="text" class="form-control branch" name="branch" placeholder="Branch" autofocus maxlength="20">
                    </div>
                    <div class="form-group">
                        <label for="branchAddress"><span class="fas fa-map-signs"></span> Address</label>
                        <input type="text" class="form-control branchAddress" name="branchAddress" placeholder="Address" autofocus maxlength="500">
                    </div>
                    <div class="form-group">
                        <label for="branchContact"><span class="fas fa-phone"></span> Contact Number</label>
                        <input type="text" class="form-control branchContact" name="branchContact" placeholder="Contact Number" autofocus maxlength="50">
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

<div class="modal fade" id="editVenueModal" role="dialog">
    <div class="modal-dialog modal-lg editVenueModal">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #A2C710;">
                <h5 align="center">Edit Venue</h5>
            </div>
            <form name="editVenueForm" method="POST">
                <div class="modal-body">
                    <div class="alert alert-danger error-msg" role="alert" style="display: none;"></div>
                    <div class="form-group">
                        <label for="branch"><span class="fas fa-map-pin"></span> Branch</label>
                        <input type="text" class="form-control branch" name="branch" placeholder="Branch" autofocus maxlength="20">
                    </div>
                    <div class="form-group">
                        <label for="branchAddress"><span class="fas fa-map-signs"></span> Address</label>
                        <input type="text" class="form-control branchAddress" name="branchAddress" placeholder="Address" autofocus maxlength="500">
                    </div>
                    <div class="form-group">
                        <label for="branchContact"><span class="fas fa-phone"></span> Contact Number</label>
                        <input type="text" class="form-control branchContact" name="branchContact" placeholder="Contact Number" autofocus maxlength="50">
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

<script src="/Nexus/dashboard/js/admin/dashboard.venue.js"></script>

<?php
require_once "template/footer.php";
?>