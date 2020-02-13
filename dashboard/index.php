<?php
require_once "Template/header.php";
?>

<div class="container">

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <p class="h2">Dashboard</p>
    </div>

    <!--   Analytics -->
    <h4>Analytics</h4><br>
    <div class='row'>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="#">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fas fa-mail-bulk"></i></span>
                    <div class="info-box-content" style="text-align:center;">
                        <span class="info-box-text">No. of Quotation<br>Requests</span>
                        <span class="info-box-number emailed">
                            <!-- <small>%</small> --></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </a>
            <!-- /.info-box -->
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="#">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fas fa-check"></i></span>
                    <div class="info-box-content" style="text-align:center;">
                        <span class="info-box-text">No. of Partially<br>Paid Students</span>
                        <span class="info-box-number approved">
                            <!-- <small>%</small> --></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="#">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fas fa-check-double"></i></span>
                    <div class="info-box-content" style="text-align:center;">
                        <span class="info-box-text">No. of Fully Paid<br>Students</span>
                        <span class="info-box-number finished">
                            <!-- <small>%</small> --></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="#">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fas fa-times"></i></span>
                    <div class="info-box-content" style="text-align:center;">
                        <span class="info-box-text">No. of Unpaid<br>Students</span>
                        <span class="info-box-number cancelled">
                            <!-- <small>%</small> --></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
        </div>

    </div>

    <!--   Table -->
    <br><br>
    <div class="container">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <p class="h4">Partially Paid Students (Reminder)</p>
        </div>
        <div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
            <table id="tbl_clients" style="width:100%" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th style="white-space:nowrap;">Student Name</th>
                        <th style="white-space:nowrap;">Company Name</th>
                        <th style="white-space:nowrap;">E-mail Address</th>
                        <th style="white-space:nowrap;">Contact No.</th>
                        <th style="white-space:nowrap;">Course</th>
                        <th style="white-space:nowrap;">Schedule</th>
                        <th style="white-space:nowrap;">Payment</th>
                        <th style="white-space:nowrap;">Actions&nbsp&nbsp&nbsp</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th style="white-space:nowrap;">Student Name</th>
                        <th style="white-space:nowrap;">Company Name</th>
                        <th style="white-space:nowrap;">E-mail Address</th>
                        <th style="white-space:nowrap;">Contact No.</th>
                        <th style="white-space:nowrap;">Course</th>
                        <th style="white-space:nowrap;">Schedule</th>
                        <th style="white-space:nowrap;">Payment</th>
                        <th style="white-space:nowrap;">Actions&nbsp&nbsp&nbsp</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div id="fullyPaidModal" class="modal fade modal-wide" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="padding:10px 10px;">
                    <h5 align="center"><span class="glyphicon glyphicon-plane"></span> Fully Paid Students (Details)</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" style="padding:30px 50px;">
                    <div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
                        <table id="tbl_tours" style="width:100%" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="white-space:nowrap;">Student Name</th>
                                    <th style="white-space:nowrap;">Company Name</th>
                                    <th style="white-space:nowrap;">Course</th>
                                    <th style="white-space:nowrap;">Schedule</th>
                                    <th style="white-space:nowrap;">MOP</th>
                                    <th style="white-space:nowrap;">Course Amount</th>
                                    <th style="white-space:nowrap;">Payment Amount</th>
                                    <th style="white-space:nowrap;">Payment Status</th>
                                    <th style="white-space:nowrap;">Approved By</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-wide selectSupplierModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" style="padding:10px 10px;">
                    <h5 class="modal-title" id="header5"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="padding:30px 50px;">
                    <div id="bookDetails"></div>
                    <div align="right">
                        <button type='button' id='addSupplier' class='btn btn-primary addSupplier' data-toggle="modal" data-target="#addSupplierModal">aaa</button>
                        <!-- <button type="button" id="changeSupplierBtn" class="btn btn-info btn-lg changeSupplierBtn">Change Supplier</button> -->
                        <br><br>
                    </div>
                    <div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
                        <table id="tbl_suppliers" style="width:100%;" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="white-space:nowrap;">Partner ID</th>
                                    <th style="white-space:nowrap;">First Name</th>
                                    <th style="white-space:nowrap;">Middle Name</th>
                                    <th style="white-space:nowrap;">Last Name</th>
                                    <th style="white-space:nowrap;">Company Name</th>
                                    <th style="white-space:nowrap;">Contact Person</th>
                                    <th style="white-space:nowrap;">Email Address</th>
                                    <th style="white-space:nowrap;">Contact Number</th>
                                    <th style="white-space:nowrap;">Category</th>
                                    <th style="white-space:nowrap;">Actions</th> <!-- Edit -->
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="form-row">
                        <input type="hidden" name="user_id" id="user_id" />
                        <input type="hidden" name="operation" id="operation" />
                        <div class="col-*">
                            <button type="button" class="btn btn-primary form-control cancelAddSupplier" id="cancelAddSupplier">Cancel</button>
                        </div>
                        <div class="col-*">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="modal fade" id="editTourModal" role="dialog" style="z-index:2000;">
            <div class="modal-dialog vertical-align-center">
                <div class="modal-content">
                    <div class="modal-header" style="padding:10px 10px;">
                        <h5 align="center"><span class="glyphicon glyphicon-plane"></span>Edit Tour Details</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form method="post" id="editTourForm" enctype="multipart/form-data">
                        <div class="modal-body" style="padding:30px 50px;">
                            <div class="form-group">
                                <label for="tour_Destination"><span class="fas fa-globe-asia"></span> Destination</label>
                                <input type="text" class="form-control tour_DestinationEdit" id="tour_DestinationEdit" name="tour_DestinationEdit" placeholder="Destination" maxlength="25" autocomplete="off" required>
                                <div id="destinationListEdit"></div>
                            </div>
                            <div class="form-group">
                                <label for="tour_packageType"><span class="fas fa-plane-departure"></span> Type of Flight</label>
                                <select class="form-control tour_packageType" id="tour_packageType" name="tour_packageType" required>
                                    <option value="" selected disabled hidden>Select Flight Type</option>
                                    <option>Individual</option>
                                    <option>Corporate</option>
                                    <option>Deluxe</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="numPax"><span class="fas fa-list-ol"></span> Number of Persons</label>
                                <input type="text" class="form-control numPax" id="numPax" name="numPax" placeholder="PAX" required maxlength="3">
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs">&nbsp&nbsp&nbsp&nbsp
                                        <label for="tour_fromDate"><span class="fas fa-angle-double-left"></span> From</label>
                                        <input type="date" class="form-control tour_fromDateEdit" id="tour_fromDateEdit" name="tour_fromDateEdit" placeholder="From" required style="margin-left:16px;width:185px;" max="2999-12-31">
                                    </div>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                    <div class="col-xs">
                                        <label for="tour_toDate"><span class="fas fa-angle-double-right"></span> To</label>
                                        <input type="date" class="form-control tour_toDateEdit" id="tour_toDateEdit" name="tour_toDateEdit" placeholder="To" required max="2999-12-31">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs">&nbsp&nbsp&nbsp&nbsp
                                        <label for="tour_numDays"><span class="fas fa-sun"></span> No. of Days</label>
                                        <input type="number" class="form-control tour_numDaysEdit" id="tour_numDaysEdit" name="tour_numDaysEdit" placeholder="No. of Days" required readonly="true" style="margin-left:16px;width:185px;">
                                    </div>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                    <div class="col-xs">
                                        <label for="tour_numNights"><span class="fas fa-moon"></span> No. of Nights</label>
                                        <select class="form-control tour_numNightsEdit" id="tour_numNightsEdit" name="tour_numNightsEdit" style="width:190px;" required>
                                            <option value="" selected disabled hidden>No. of Nights</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <input type="hidden" name="operation1" id="operation1" />
                                <input type="hidden" name="tourID" id="tourID" />
                                <input type="hidden" name="clientID" class="clientID" id="clientID" />
                                <input type="hidden" name="ctr" id="ctr" />
                                <div class="col">
                                    <input type="submit" name="action1" id="action1" class="btn btn-success form-control" value="Update" />
                                </div>
                                <div class="col">
                                    <button type="button" class="btn btn-primary form-control closeTourEdit" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-wide1" id="viewQuotationImageModal" role="dialog" style="z-index: 2000;">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" style="padding:10px 10px;">
                    <h5 class="modal-title">View Quotation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="quotationImageForm" method='POST'>
                    <div class="modal-body" style="padding:30px 50px;">
                        <div class="fileUpload">
                            <div class="form-group">
                                <label for="quotationImage"><span class="fas fa-upload"></span> Upload Image</label><br>
                                <input type="file" name="quotationImage" id="quotationImage" />
                            </div>
                            <div class="form-group">
                                <label for="quotationPrice"><span class="fas fa-money-bill-alt"></span> Quotation Price</label>
                                <input type="text" class="form-control quotationPrice" id="quotationPrice" name="quotationPrice" placeholder="Quotation Price" required maxlength="50">
                            </div>
                        </div>
                        <div class="form-group viewImage">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-row">
                            <input type="hidden" name="supplier_ID_quotationImage" id="supplier_ID_quotationImage" />
                            <input type="hidden" name="booking_ID_quotationImage" id="booking_ID_quotationImage" />
                            <input type="submit" name="uploadImage" id="uploadImage" class="btn btn-success" value="Submit" />
                            <button type="button" class="btn btn-light closeViewImage" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade modal-wide paymentDetailsModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" style="padding:10px 10px;">
                    <h5 class="modal-title" id="header6">Payment Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="padding:30px 50px;">
                    <div id="bookDetails1"></div>
                    <div align="right">
                        <button type='button' id='addPayment' class='btn btn-primary addPayment' data-toggle="modal" data-target="#addPaymentModal">Add Payment</button>
                        <!-- <button type="button" id="changeSupplierBtn" class="btn btn-info btn-lg changeSupplierBtn">Change Supplier</button> -->
                        <br><br>
                    </div>
                    <div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
                        <table id="tbl_billing" style="width:100%;" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="white-space:nowrap;">Billing ID</th>
                                    <th style="white-space:nowrap;">Student ID</th>
                                    <th style="white-space:nowrap;">Payment Date</th>
                                    <th style="white-space:nowrap;">Student Name</th>
                                    <th style="white-space:nowrap;">Course Amount</th>
                                    <th style="white-space:nowrap;">Payment Amount</th>
                                    <th style="white-space:nowrap;">Remaining Balance</th>
                                    <th style="white-space:nowrap;">Payment Status</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="form-row">
                        <input type="hidden" name="user_id" id="user_id" />
                        <input type="hidden" name="operation" id="operation" />
                        <!--          <div class="col-*">
            <button type="button" class="btn btn-primary form-control cancelAddSupplier" id="cancelAddSupplier">Cancel</button>
          </div> -->
                        <div class="col-*">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addPaymentModal" role="dialog" style="z-index:2000;">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" style="padding:10px 10px;">
                    <h5 class="modal-title" id='header7'>Add Payment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="padding:30px 50px;">
                    <form id="paymentForm" method="POST">
                        <div class="form-group">
                            <label for="mop"><span class="fas fa-globe-asia"></span> Mode of Payment</label>
                            <select class="form-control mop" id="mop" name="mop" required>
                                <option value="" selected disabled hidden>Select MOP </option>
                                   <!-- <?php //echo fetchMOP($connection); ?> -->
                            </select>
                        </div>
                        <div id="creditCardDiv" style='display:none;'>
                            <div class="form-group">
                                <label for="cardNumber" id='cardNumberLabel'><span class="fas fa-credit-card"></span> Card Number</label>
                                <input type="text" class="form-control cardNumber" id="cardNumber" name="cardNumber" placeholder="Card Number">
                            </div>
                        </div>
                        <div id="chequeDiv" style='display:none;'>
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="chequeNumber" id='chequeNumberLabel'><span class="fas fa-money-check-alt"></span> Cheque Number</label>
                                    <input type="text" class="form-control chequeNumber" id="chequeNumber" name="chequeNumber" placeholder="Card Number">
                                </div>
                                <label for="chequeBank" id='chequeBankLabel'><span class="fas fa-university"></span> Bank</label>
                                <input type="text" class="form-control chequeBank" id="chequeBank" name="chequeBank" placeholder="Bank">
                            </div>
                            <div class="form-group">
                                <label for="bankAddress" id='bankAddressLabel'><span class="fas fa-map-marked-alt"></span> Bank Main Address</label>
                                <input type="text" class="form-control bankAddress" id="bankAddress" name="bankAddress" placeholder="Bank Main Address">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tourAmount"><span class="fas fa-money-bill-wave"></span> Tour Amount</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">₱</span>
                                </div>
                                <input type="text" class="form-control tourAmount" id="tourAmount" name="tourAmount" placeholder="Tour Amount" maxlength="11" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="remainingBalance"><span class="fas fa-money-bill"></span> Last Payment Amount</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">₱</span>
                                </div>
                                <input type="text" class="form-control remainingBalance" id="remainingBalance" name="remainingBalance" placeholder="Last Payment Amount" maxlength="11" required readonly="true">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="paymentAmount"><span class="fas fa-money-bill-wave"></span> Payment Amount</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">₱</span>
                                </div>
                                <input type="text" class="form-control paymentAmount" id="paymentAmount" name="paymentAmount" placeholder="Payment Amount" maxlength="11" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="remBal"><span class="fas fa-money-bill"></span> Remaining Balance</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">₱</span>
                                </div>
                                <input type="text" class="form-control remBal" id="remBal" name="remBal" placeholder="Remaining Balance" maxlength="11" required readonly="true">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for='paymentStatus'><span class='fas fa-spinner'></span> Status</label>
                            <input type="text" class="form-control paymentStatus" id="paymentStatus" name="paymentStatus" placeholder="Payment Status" maxlength="11" required readonly="true">
                        </div>
                        <input type="hidden" class="form-control lastPaymentAmount" id="lastPaymentAmount" name="lastPaymentAmount">
                        <input type="hidden" class="form-control tourAmount1" id="tourAmount1" name="tourAmount1">
                        <input type="hidden" class="form-control paymentAmount1" id="paymentAmount1" name="paymentAmount1">
                        <input type="hidden" class="form-control remBal1" id="remBal1" name="remBal1">
                    </form>
                </div>
                <div class="modal-footer">
                    <div class="form-row">
                        <input type="hidden" name="user_id" id="user_id" class="user_id" />
                        <input type="hidden" name="operation3" id="operation3" class="operation3" />
                        <input type="submit" name="moveToApprovedBookings" id="moveToApprovedBookings" class="btn btn-success moveToApprovedBookings" value="Approve" />
                        <button type="button" class="btn btn-light closeApproveModal" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?php
require_once "Template/footer.php";
?>