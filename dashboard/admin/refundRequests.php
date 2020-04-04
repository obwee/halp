<?php
require_once "template/header.php";

?>

<div class="container">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2><span class="fas fa-user-times"></span> Refund Requests</h2>
    </div>


    <div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
        <table id="tbl_requests" style="width:100%" class="table table-striped table-bordered table-hover table-responsive-sm">
            <thead>
                <tr>
                    <th style="white-space:nowrap;text-align: center;">Date Requested</th>
                    <th style="white-space:nowrap;text-align: center;">Student Name</th>
                    <th style="white-space:nowrap;text-align: center;">Course</th>
                    <th style="white-space:nowrap;text-align: center;">Start Date</th>
                    <th style="white-space:nowrap;text-align: center;">End Date</th>
                    <th style="white-space:nowrap;text-align: center;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align: center;">Apr 2, 2020</td>
                    <td style="text-align: center;">Britney Spears</td>
                    <td style="text-align: center;">EH</td>
                    <td style="text-align: center;">Feb 28, 2020</td>
                    <td style="text-align: center;">Feb 29, 2020</td>
                    <td style="text-align: center;">
                        <button class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#viewRequestModal"><i class="fas fa-eye"></i></button>
                    </td>
                </tr>
            </tbody>    
        </table>
    </div> 

    <div class="modal fade" id="viewRequestModal" role="dialog">
        <div class="modal-dialog viewRequestModal modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #3c8dbc;">
                    <h5 align="center" style="color:white;">View Refund Request</h5>
                </div>
                <div class="modal-body">
                    <div>
                        <div class="form-group row">
                            <label for="studentName" class="col-sm-3 col-form-label"><i class="fas fa-user"></i> Student Name&nbsp&nbsp&nbsp:</label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" id="studentName" value="Aries Macandili">
                            </div>

                            <label for="email" class="col-sm-3 col-form-label"><i class="fas fa-envelope"></i> E-mail&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" id="email" value="ariestikibuts@gmail.com">
                            </div>

                            <label for="contact" class="col-sm-3 col-form-label"><i class="fas fa-phone"></i> Contact No.&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" id="email" value="09161616161">
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
                    <table id="tbl_requests" style="width:100%" class="table table-striped table-bordered table-hover table-responsive-sm">
                        <thead>
                            <tr>
                                <th style="white-space:nowrap;text-align:center;">Date Paid</th>
                                <th style="white-space:nowrap;text-align:center;">MOP</th>
                                <th style="white-space:nowrap;text-align:center;">Amount Paid</th>
                                <th style="white-space:nowrap;text-align:center;">Reason</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="text-align:center;">April 1, 2020</td>
                                <td style="text-align:center;">BDO</td>
                                <td style="text-align:center;">10,000</td>
                                <td style="text-align:center;">Unavailable on reserved schedule.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Approve</button>
                <button type="submit" class="btn btn-danger"> Reject</button>
                <button type="submit" class="btn btn-info" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>


<?php
require_once "template/scripts.php";
?>

<script src="/Nexus/dashboard/js/admin/dashboard.refundRequests.js"></script>

<?php
require_once "template/footer.php";
?>