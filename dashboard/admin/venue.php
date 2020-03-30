<?php
require_once "Template/header.php";
?>

<div class="container">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <p class="h2"><i class="fas fa-map-marked-alt"></i> Venues</p>
    </div>
    <div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
        <div align="right">
            <button type="button" id="addNewBranch" data-toggle="modal" data-target="#addNewBranchModal" class="btn btn-info btn-lg"><i class="fas fa-plus"></i> Add New Branch</button>
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
            <div class="modal-header" style="background-color: #3c8dbc;">
                <h5 align="center" style="color:white;"><i class="fas fa-plus"></i> Add New Branch</h5>
            </div>
            <form id="addVenueForm" method="POST">
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
            <div class="modal-header" style="background-color: #3c8dbc;">
                <h5 align="center" style="color:white;"><i class="fas fa-edit"></i> Edit Venue</h5>
            </div>
            <form id="editVenueForm" method="POST">
                <div class="modal-body">
                    <div class="alert alert-danger error-msg" role="alert" style="display: none;"></div>
                    <input type="text" class="venueId" name="venueId" readonly hidden>
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

<div class="modal fade" id="changeVenueModal" role="dialog">
    <div class="modal-dialog modal-lg changeVenueModal">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #3c8dbc;">
                <h5 align="center" style="color:white;"><i class="fas fa-edit"></i> Update Venue</h5>
            </div>
            <form id="changeVenueForm" method="post">
                <div class="modal-body">
                    <input type="text" class="venueId" name="venueId" readonly hidden>
                    <div class="row">
                        <div class="col-sm-2">
                            <label for="venue" class="col-form-label"><i class="fas fa-map-marked-alt"></i> Venue</label>
                        </div>
                        <div class="col-sm-10">
                            <input type="text" class="form-control venue" readonly>
                        </div>
                        <div class="col-12 alert alert-danger error-msg" role="alert" style="display: none;"></div>
                    </div>
                    <div class="box mt-4" style="border:5px solid #3c8dbc;margin:5px 5px;padding:7px 7px ;overflow-y: scroll;height:250px;overflow-x: hidden;">
                        <div class="template" hidden>
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="courseCode" style="padding-left: 10px;"><i class="fas fa-book"></i> Course: <span></span></p>
                                    <p class="courseSchedule" style="padding-left: 10px;"><i class="fas fa-calendar-day"></i> Schedule: <span></span></p>
                                    <p class="courseInstructor" style="padding-left: 10px;"><i class="fas fa-map-marked-alt"></i> Instructor: <span></span></p>
                                </div>
                                <div class="col-sm-6 d-flex align-items-center">
                                    <select class="form-control venues" name="">
                                        <option selected hidden disabled>Select New Venue</option>
                                    </select>
                                </div>
                            </div>
                            <hr class="mt-0">
                        </div>
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