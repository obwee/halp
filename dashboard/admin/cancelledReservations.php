<?php
require_once "template/header.php";

?>

<div class="container">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2><span class="fas fa-times"></span> Cancelled Reservations</h2>
    </div>


    <div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
        <h4>Cancellation Requests</h4>
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
                        <button class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#rescheduleModal"><i class="fas fa-eye"></i></button>
                    </td>
                </tr>
            </tbody>    
        </table>
    </div> 

        <br><br>

        <h4>Approved Requests</h4>
        <table id="tbl_approvedRequests" style="width:100%" class="table table-striped table-bordered table-hover table-responsive-sm">
                <thead>
                 <tr>
                    <th style="white-space:nowrap;">Date of Request</th>
                    <th style="white-space:nowrap;">Student Name</th>
                    <th style="white-space:nowrap;">Email-Address</th>
                    <th style="white-space:nowrap;">Phone</th>
                    <th style="white-space:nowrap;">Course</th>
                    <th style="white-space:nowrap;">Start Date</th>
                    <th style="white-space:nowrap;">End Date</th>
                    <th style="white-space:nowrap;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Mar 01, 2020</td>
                    <td>Aries Macandili</td>
                    <td>macandili.aries@gmail.com</td>
                    <td>5841881</td>
                    <td>20410</td>
                    <td>Mar 6 2020</td>
                    <td>Mar 9 2020</td>
                    <td>
                        <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#viewRequestModal"><i class="fas fa-eye"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>




   

<div class="modal fade" id="viewRequestModal" role="dialog">
    <div class="modal-dialog viewRequestModal">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #A2C710;">
                <h5 align="center">View Refund Request</h5>
            </div>
            <div class="modal-body" align="center">
                <div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
                    <table id="tbl_requests" style="width:100%" class="table table-striped table-bordered table-hover table-responsive-sm">
                        <thead>
                            <tr>
                                <th style="white-space:nowrap;">MOP</th>
                                <th style="white-space:nowrap;">Amount Paid</th>
                                <th style="white-space:nowrap;">Reason</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>BDO</td>
                                <td>10,000</td>
                                <td>Unavailable on reserved schedule.</td>
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

<script src="/Nexus/dashboard/js/admin/dashboard.cancelledReservations.js"></script>

<?php
require_once "template/footer.php";
?>