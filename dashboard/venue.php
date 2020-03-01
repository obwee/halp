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
				<thead>
					<tr>
						<th style="white-space:nowrap;">Branch</th>
                        <th style="white-space:nowrap;">Address</th>
                        <th style="white-space:nowrap;">Contact No</th>
						<th style="white-space:nowrap;">Actions</th>
					</tr>
                </thead>
				<tbody>
                    <tr>
                        <td>Makati</td>
                        <td>Unit 2417 H.V Dela Costa Street, Ayala Avenue, Makati City</td>
                        <td>+63 2 8362-3755</td>
                        <td>
                            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#editVenueModal"><i class="fas fa-pen"></i></button>
                            <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>Manila</td>
                        <td>Room 401, Dona Amparo Building, Espana Boulevard, Manila</td>
                        <td>+63 2 8355-7759</td>
                        <td>
                            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#editVenueModal"><i class="fas fa-pen"></i></button>
                            <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="addNewBranchModal" role="dialog">
        <div class="modal-dialog modal-lg addNewBranchModal">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #A2C710;">
                    <h5 align="center">Add New Branch</h5>
                </div>
                
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="branch"><span class="fas fa-map-pin"></span> Branch</label>
                            <input type="text" class="form-control" id="branch" name="branch" placeholder="Branch" autofocus maxlength="20">
                        </div>
                        <div class="form-group">
                            <label for="branchAddress"><span class="fas fa-map-signs"></span> Address</label>
                            <input type="text" class="form-control" id="branchAddress" name="branchAddress" placeholder="Address" autofocus maxlength="50">
                        </div>
                        <div class="form-group">
                            <label for="branchContact"><span class="fas fa-phone"></span> Contact Number</label>
                            <input type="text" class="form-control" id="branchContact" name="branchContact" placeholder="Contact Number" autofocus maxlength="50">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Add</button>
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editVenueModal" role="dialog">
        <div class="modal-dialog modal-lg editVenueModal">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #A2C710;">
                    <h5 align="center">Edit Venue</h5>
                </div>
                
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="branch"><span class="fas fa-map-pin"></span> Branch</label>
                            <input type="text" class="form-control" id="branch" name="branch" placeholder="Branch" readonly maxlength="20">
                        </div>
                        <div class="form-group">
                            <label for="branchAddress"><span class="fas fa-map-signs"></span> Address</label>
                            <input type="text" class="form-control" id="branchAddress" name="branchAddress" placeholder="Address" autofocus maxlength="50">
                        </div>
                        <div class="form-group">
                            <label for="branchContact"><span class="fas fa-phone"></span> Contact Number</label>
                            <input type="text" class="form-control" id="branchContact" name="branchContact" placeholder="Contact Number" autofocus maxlength="50">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Update</button>
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>


<?php
require_once "template/scripts.php";
?>


<?php
require_once "template/footer.php";
?>
