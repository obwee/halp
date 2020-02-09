<?php 
require_once "template/header1.php";
include 'fetchDestinationsClientSide.php';
?>

<style type="text/css">
.modal.modal-wide .modal-dialog {
  width: 100%;
  max-width:1230px;
}

.modal.modal-wider .modal-dialog {
  width: 110%;
  max-width:1330px;
}

.modal-wide .modal-body {
  overflow-y: auto;
}
</style>

<div class="container">

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <p class="h2">Dashboard</p>
  </div>

  <!--   Analytics -->
  <h4>Analytics</h4><br>
  <div class='row'>

   <div class="col-md-3 col-sm-6 col-xs-12">
    <a href="bookingRequests.php">
      <div class="info-box">
        <span class="info-box-icon bg-aqua"><i class="fas fa-mail-bulk"></i></span>
        <div class="info-box-content" style="text-align:center;">
          <span class="info-box-text">No. of Booking<br>Requests</span>
          <span class="info-box-number emailed"><!-- <small>%</small> --></span>
        </div>
        <!-- /.info-box-content -->
      </div>
    </a>
    <!-- /.info-box -->
  </div>

  <!-- <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-red"><i class="fas fa-ellipsis-h"></i></span>

      <div class="info-box-content" style="text-align:center;" id='pending'>
        <span class="info-box-text">No. of Pending<br>Bookings</span>
        <span class="info-box-number pending"></span>
      </div>
    </div>
  </div> -->

  <div class="col-md-3 col-sm-6 col-xs-12">
    <a href="approvedBookings.php">
      <div class="info-box">
        <span class="info-box-icon bg-yellow"><i class="fas fa-check"></i></span>
        <div class="info-box-content" style="text-align:center;">
          <span class="info-box-text">No. of Approved<br>Requests</span>
          <span class="info-box-number approved"><!-- <small>%</small> --></span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </a>
  </div>

  <div class="col-md-3 col-sm-6 col-xs-12">
    <a href="finishedBookings.php">
      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="fas fa-check-double"></i></span>
        <div class="info-box-content" style="text-align:center;">
          <span class="info-box-text">No. of Finished<br>Requests</span>
          <span class="info-box-number finished"><!-- <small>%</small> --></span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </a>
  </div>

  <div class="col-md-3 col-sm-6 col-xs-12">
    <a href="cancelledBookings.php">
      <div class="info-box">
        <span class="info-box-icon bg-red"><i class="fas fa-times"></i></span>
        <div class="info-box-content" style="text-align:center;">
          <span class="info-box-text">No. of Cancelled<br>Requests</span>
          <span class="info-box-number cancelled"><!-- <small>%</small> --></span>
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
    <p class="h4">Partially Paid Booking Requests (Reminder)</p>
  </div>
  <div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
    <table id="tbl_clients" style="width:100%" class="table table-striped table-bordered table-hover">
      <thead>
        <tr>
          <th style="white-space:nowrap;">ID</th>
          <th style="white-space:nowrap;">Last Name</th>
          <th style="white-space:nowrap;">First Name</th>
          <th style="white-space:nowrap;">Middle Name</th>
          <th style="white-space:nowrap;">Client Name</th>
          <th style="white-space:nowrap;">E-mail Address</th>
          <th style="white-space:nowrap;">Phone No.</th>
          <th style="white-space:nowrap;">Tel. No.</th>
          <th style="white-space:nowrap;">Actions&nbsp&nbsp&nbsp</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th style="white-space:nowrap;">ID</th>
          <th style="white-space:nowrap;">Last Name</th>
          <th style="white-space:nowrap;">First Name</th>
          <th style="white-space:nowrap;">Middle Name</th>
          <th style="white-space:nowrap;">Client Name</th>
          <th style="white-space:nowrap;">E-mail Address</th>
          <th style="white-space:nowrap;">Phone No.</th>
          <th style="white-space:nowrap;">Tel. No.</th>
          <th style="white-space:nowrap;">Actions&nbsp&nbsp&nbsp</th>
        </tr>
      </tfoot>
    </table>
  </div>
</div>  

<div id="tourDetailsModal" class="modal fade modal-wide" tabindex="-1" role="dialog"  data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header" style="padding:10px 10px;">
        <h5 align="center"><span class="glyphicon glyphicon-plane"></span> Partially Paid Requests Booking (Details)</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body" style="padding:30px 50px;">
        <div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
          <table id="tbl_tours" style="width:100%" class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th style="white-space:nowrap;">Request Date</th>
                <th style="white-space:nowrap;">Booking ID</th>
                <th style="white-space:nowrap;">Client ID</th>
                <th style="white-space:nowrap;">PAX</th>
                <th style="white-space:nowrap;">Origin</th>
                <th style="white-space:nowrap;">Destination</th>
                <th style="white-space:nowrap;">Flight Type</th>
                <th style="white-space:nowrap;">From</th>
                <th style="white-space:nowrap;">To</th>
                <th style="white-space:nowrap;">No. of Days</th>
                <th style="white-space:nowrap;">No. of Nights</th>
                <th style="white-space:nowrap;">Tour Status</th>
                <th style="white-space:nowrap;">MOP</th>
                <th style="white-space:nowrap;">Tour Amount</th>
                <th style="white-space:nowrap;">Payment Amount</th>
                <th style="white-space:nowrap;">Payment Status</th>
                <th style="white-space:nowrap;">Passport Number</th>
                <th style="white-space:nowrap;">Passport Expiry</th>
                <th style="white-space:nowrap;">Approved By</th>
                <th style="white-space:nowrap;">Start Date</th>
                <th style="white-space:nowrap;">End Date</th>
                <th style="white-space:nowrap;">Checker</th>
                <th style="white-space:nowrap;">Reason for Cancellation</th>
                <th style="white-space:nowrap;">Actions</th>
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
          <button type='button' id='addSupplier' class='btn btn-primary addSupplier' data-toggle="modal" data-target="#addSupplierModal">Add Partner</button>
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

<!-- <div class="container">
  <div class="modal fade" id="editTourModal" role="dialog" style="z-index: 2000;">
    <div class="modal-dialog vertical-align-center">
      <div class="modal-content">
        <div class="modal-header" style="padding:10px 10px;">
          <h5 align="center"><span class="glyphicon glyphicon-plane"></span>Edit Tour Details</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <form method="post" id="editTourForm" enctype="multipart/form-data">
          <div class="modal-body" style="padding:30px 50px;">
            <div class="form-group">
              <label for="tour_DestinationEdit"><span class="fas fa-globe-asia"></span> Destination</label>
              <input type="text" class="form-control tour_DestinationEdit" id="tour_DestinationEdit" name="tour_DestinationEdit" placeholder="Destination" maxlength="25" autocomplete="off" required>
              <div id="destinationListEdit"></div>
            </div>
            <div class="form-group">
              <label for="tour_packageType"><span class="fas fa-plane-departure"></span> Type of Flight</label>
              <select class="form-control" id="tour_packageType" name="tour_packageType" required>
                <option value="" selected disabled hidden>Select Flight Type</option>
                <option>Individual</option>
                <option>Corporate</option>
                <option>Deluxe</option>
              </select>
            </div>
            <div class="form-group">
              <label for="numPax"><span class="fas fa-list-ol"></span> Number of Persons</label>
              <input type="number" class="form-control" id="numPax" name="numPax" placeholder="PAX" required>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-xs">&nbsp&nbsp&nbsp&nbsp
                  <label for="tour_fromDateEdit"><span class="fas fa-angle-double-left"></span> From</label>
                  <input type="date" class="form-control tour_fromDateEdit" id="tour_fromDateEdit" name="tour_fromDateEdit" placeholder="From" required style="margin-left:16px;width:185px;" max="2999-12-31">
                </div>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                <div class="col-xs">
                  <label for="tour_toDateEdit"><span class="fas fa-angle-double-right"></span> To</label>
                  <input type="date" class="form-control tour_toDateEdit" id="tour_toDateEdit" name="tour_toDateEdit" placeholder="To" required max="2999-12-31">
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-xs">&nbsp&nbsp&nbsp&nbsp
                  <label for="tour_numDaysEdit"><span class="fas fa-sun"></span> No. of Days</label>
                  <input type="number" class="form-control tour_numDaysEdit" id="tour_numDaysEdit" name="tour_numDaysEdit" placeholder="No. of Days" required readonly="true" style="margin-left:16px;width:185px;">
                </div>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                <div class="col-xs">
                  <label for="tour_numNightsEdit"><span class="fas fa-moon"></span> No. of Nights</label>
                  <select class="form-control tour_numNightsEdit" id="tour_numNightsEdit" name="tour_numNightsEdit" style="width:190px;" required>
                    <option value="" selected disabled hidden>No. of Nights</option>
                  </select>
                </div>
              </div><br>
              <div class="form-group">
                <label for="mop"><span class="fas fa-globe-asia"></span> Mode of Payment</label>
                <select class="form-control mop" id="mop" name="mop" required>
                  <option value="" selected disabled hidden>Select MOP </option>
                  <?php #echo fetchMOP($connection); ?>
                </select>
              </div>
              <div class="form-group">
                <label for="tourAmount"><span class="fas fa-money-bill-wave"></span> Tour Amount</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">₱</span>
                  </div>
                  <input type="text" class="form-control tourAmount" id="tourAmount" name="tourAmount" placeholder="Tour Amount" maxlength = "11" required>
                </div>
              </div>
              <div class="form-group">
                <label for="paymentAmount"><span class="fas fa-money-bill-alt"></span> Payment Amount</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">₱</span>
                  </div>
                  <input type="text" class="form-control paymentAmount" id="paymentAmount" name="paymentAmount" placeholder="Payment Amount" maxlength = "11" required>
                </div>
              </div>
              <div class="form-group">
                <label for='paymentStatus'><span class='fas fa-spinner'></span> Status</label>
                <input type="text" class="form-control paymentStatus" id="paymentStatus" name="paymentStatus" placeholder="Payment Status" maxlength = "11" required readonly="true">    
              </div>
            </div>
            <div class="form-row">
              <input type="hidden" name="user_id" id="user_id" />
              <input type="hidden" name="operation1" id="operation1" />
              <input type="hidden" name="tourID" id="tourID" />
              <input type="hidden" name="ctr" id="ctr" />
              <input type="hidden" name="mop1" id="mop1" />
              <input type="hidden" name="paymentStatus1" id="paymentStatus1" />
              <div class="col">
                <input type="submit" name="action" id="action" class="btn btn-success form-control" value="Update" />
              </div>
              <div class="col">
                <button type="button" class="btn btn-primary form-control closeEditTourForm" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div> -->

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
              <input type="text" class="form-control quotationPrice" id="quotationPrice" name="quotationPrice" placeholder="Quotation Price" required maxlength = "50">
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
                <th style="white-space:nowrap;">Booking ID</th>
                <th style="white-space:nowrap;">Payment Date</th>
                <th style="white-space:nowrap;">Client ID</th>
                <th style="white-space:nowrap;">Client Name</th>
                <th style="white-space:nowrap;">Tour Amount</th>
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
              <?php echo fetchMOP($connection); ?>
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
              <input type="text" class="form-control tourAmount" id="tourAmount" name="tourAmount" placeholder="Tour Amount" maxlength = "11" required>
            </div>
          </div>
          <div class="form-group">
            <label for="remainingBalance"><span class="fas fa-money-bill"></span> Last Payment Amount</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">₱</span>
              </div>
              <input type="text" class="form-control remainingBalance" id="remainingBalance" name="remainingBalance" placeholder="Last Payment Amount" maxlength = "11" required readonly="true">
            </div>
          </div>
          <div class="form-group">
            <label for="paymentAmount"><span class="fas fa-money-bill-wave"></span> Payment Amount</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">₱</span>
              </div>
              <input type="text" class="form-control paymentAmount" id="paymentAmount" name="paymentAmount" placeholder="Payment Amount" maxlength = "11" required>
            </div>
          </div>
          <div class="form-group">
            <label for="remBal"><span class="fas fa-money-bill"></span> Remaining Balance</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">₱</span>
              </div>
              <input type="text" class="form-control remBal" id="remBal" name="remBal" placeholder="Remaining Balance" maxlength = "11" required readonly="true">
            </div>
          </div>
          <div class="form-group">
            <label for='paymentStatus'><span class='fas fa-spinner'></span> Status</label>
            <input type="text" class="form-control paymentStatus" id="paymentStatus" name="paymentStatus" placeholder="Payment Status" maxlength = "11" required readonly="true">      
          </div>
          <input type="hidden" class="form-control lastPaymentAmount" id="lastPaymentAmount" name="lastPaymentAmount">
          <input type="hidden" class="form-control tourAmount1" id="tourAmount1" name="tourAmount1">
          <input type="hidden" class="form-control paymentAmount1" id="paymentAmount1" name="paymentAmount1">
          <input type="hidden" class="form-control remBal1" id="remBal1" name="remBal1">
        </form>
      </div>
      <div class="modal-footer">
        <div class="form-row">
          <input type="hidden" name="user_id" id="user_id" class="user_id"/>
          <input type="hidden" name="operation3" id="operation3" class="operation3"/>
          <input type="submit" name="moveToApprovedBookings" id="moveToApprovedBookings" class="btn btn-success moveToApprovedBookings" value="Approve" />
          <button type="button" class="btn btn-light closeApproveModal" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
</div>

<style type="text/css">
.modal.modal-wide1 .modal-dialog {
  width: 40%;
  max-width:1230px;
}
</style>

</div>

<?php 
require_once "template/footer1.php";
?>

<script>
  $(document).ready(function () {

    $(document).on('focusout', '.paymentAmount', function() {
      var paymentAmount = accounting.formatNumber($('.paymentAmount').val(), 2, ",", ".");
      $('.paymentAmount').val(paymentAmount);
    })

    $(document).on('keydown keyup focus', '.paymentAmount', function(e) {
      $('.paymentAmount1').val($(this).val());
      var diff = Number($('.paymentAmount1').val()) - Number($('.lastPaymentAmount').val());
      var diff1 = Number($('.lastPaymentAmount').val()) - Number($('.paymentAmount1').val());
      if(diff >= 0) {
        $('.paymentStatus').val('Fully Paid');
        $('.paymentAmount1').val($('.tourAmount1').val());
        $('.paymentAmount').val($('.tourAmount1').val());
        $('.remBal').val(accounting.formatNumber('0', 2, ",", "."));
        $('.remBal1').val('0');
      }
      else {
        $('.paymentStatus').val('Partially Paid');     
        $('.remBal').val(accounting.formatNumber(diff1, 2, ",", "."));
        $('.remBal1').val(diff1);
      }
    });  

    $(document).on('click', '#addPayment', function() {
      $('#addPaymentModal').modal('show');
      $('#header7').text('Add Payment for Request ID '+tourID);
      $('#paymentForm')[0].reset();

      $.ajax({
        url:"AJAX/getTourAmount.php",  
        method:"POST",  
        data:{booking_ID:tourID},  
        success:function(data)  
        {
          $('#tourAmount1').val(data);            
          var tourAmount = accounting.formatNumber(data, 2, ",", ".");
          $('#tourAmount').val(tourAmount).attr('readonly', true);  
        }
      });
      $.ajax({
        url:"AJAX/getRemainingBalance.php",  
        method:"POST",  
        data:{booking_ID:tourID},  
        success:function(data)  
        {
          var remainingBalance = accounting.formatNumber(data, 2, ",", ".");
          $('#remainingBalance').val(remainingBalance).attr('readonly', true);  
          $('#lastPaymentAmount').val(data)   
        }
      });

      $('.operation3').val('addPayment');
      var operation = $('.operation3').val();

      $(document).on('click', '#moveToApprovedBookings', function(e) {
        e.preventDefault();
        var paymentStatus = $('#paymentStatus').val();
        var mop = $('#mop option:selected').text();
        var paymentStatusVal = $('#paymentStatus option:selected').val();
        var mopVal = $('#mop option:selected').val();
        var paymentAmount = $('#paymentAmount').val();
        var remainingBalance = $('#lastPaymentAmount').val();
        var tourAmount = $('#tourAmount1').val();
        var cardNumber = $('#cardNumber').val();
        var remBal = $('#remBal1').val();

        if(paymentStatusVal != '' && mopVal != '' && paymentAmount != '') {
          if(e.handled !== true) {
            $(this).prop('disabled', true);
            $('.closeApproveModal').prop('disabled', true);
            $.ajax({
              url:"AJAX/approveRequest.php",
              method:'POST',
              data:{
                paymentStatus:paymentStatus,
                mop:mop,
                booking_ID:tourID, 
                operation:operation, 
                paymentAmount:paymentAmount,
                remainingBalance:remainingBalance,
                tourAmount:tourAmount,
                cardNumber:cardNumber,
                remBal:remBal
              },
              success:function(data) {
                alert(data);
                e.handled = true;
                $('#mop').prop('selectedIndex',0);
                $('#paymentAmount').val('');
                $('#paymentStatus').prop('selectedIndex',0);
                /*$("[data-dismiss=modal]").trigger({ type: "click" });*/
                $('#paymentForm')[0].reset();
                $('#addPaymentModal').modal('hide');
                $('#tbl_billing').DataTable().ajax.reload();
                $('#tbl_tours').DataTable().ajax.reload();
                e.handled = true;
                $('#moveToApprovedBookings').prop('disabled', false);
                $('.closeApproveModal').prop('disabled', false);
              }       
            });
          }
        }
        else {
          alert('Please fill the necessary fields.');
          $('#moveToApprovedBookings').prop('disabled', false);
          $('.closeApproveModal').prop('disabled', false);
        }
        e.handled = true;
      });
    })
    

    $('#tour_packageType').change(function() {
      packageType = $('#tour_packageType option:selected').text();
      if(packageType == 'Individual') {
        $('#numPax').val('1');
        $('#numPax').attr('readonly', true);        
      }
      else {
        $('#numPax').val('');
        $('#numPax').attr('readonly', false);
      }
    });

    var operation = "Partially Paid";
    var status = "Approved";

    function loadAnalytics() {
      $.ajax({
        url: 'AJAX/analyticsData.php',
        method: 'GET',
        dataType: 'json',
        success:function(data) {
          $('.emailed').text(data.emailed);
          $('.pending').text(data.pending);
          $('.approved').text(data.approved);
          $('.finished').text(data.finished);
          $('.cancelled').text(data.cancelled);
        }        
      });
    }

    /*function loadBookings() {
      $.ajax({
        url: 'AJAX/loadBookings.php',
        method: 'POST',
        //dataType: 'json',
        success:function(data) {
          $('.emailed').text(data.emailed);
          $('.pending').text(data.pending);
          $('.approved').text(data.approved);
          $('.finished').text(data.finished);
          $('.cancelled').text(data.cancelled);
        }        
      });
    }
    */
    loadAnalytics();

    setInterval(function(){
      loadAnalytics();
    }, 5000);

    var dataTable1 = $('#tbl_clients').DataTable({
      "responsive":true,
      "processing":true,
      "serverSide":true,
      "order": [],
      "ajax":{
        url:"AJAX/fetchClientsForDashboard.php",
        type:"POST",
        data:{operation:operation},
      },
      "columnDefs":[
      {
        "targets":[0,1,2,3],
        "visible":false
      },
      {
        'targets': [8],
        "orderable": false
      }
      ],
      "language": {
        "search": "Search Client Name:"
      }
    });

    function loadTourDetails(client_ID, status, paymentStatus){
      var dataTable2 = $('#tbl_tours').DataTable( {
        "responsive":true,
        "processing":true,
        "serverSide":true,
        "destroy":true,
        "ajax":{
          url:"AJAX/fetchTourDetails.php",
          data : {
            client_ID : client_ID,
            status:status,
            paymentStatus:paymentStatus
          },
          type:"POST"
        },
        "columnDefs":[
        { responsivePriority: 1, targets: -1 },
        { responsivePriority: 2, targets: 12 },
        {
          "targets":[0,2,11,15,16,17,19,20,21,22],
          "visible":false
        },
        {
          'targets': [23],
          "orderable": false
        }
        /*{ 
          'width': '100%',
          'targets': [12]
        }*/
        ],
        "language": {
          "search": "Search Destination:"
        },
        fixedColumns: true
      });
    }

    $(document).on('click', '.view', function() {
      paymentStatus = 'Partially Paid';
      client_ID = $(this).attr('id');
      $('#tbl_tours').DataTable().destroy();
      loadTourDetails(client_ID, status, paymentStatus);
      $('#tourDetailsModal').modal('show');
    });  

/*    function editTourDetails(user_id, desti) {
      $.ajax({
        url:"AJAX/fetchTourDetails.php",
        method:"POST",
        data:{
          user_id:user_id,
          desti:desti
        },
        dataType:"json",
        success:function(data)
        {
          $('#editTourForm')[0].reset();
          $('#editTourModal').modal('show');
          $.each(data, (index,elem)=> {
            $('#numPax').val(elem.numPax);
            $('#tour_DestinationEdit').val(elem.tour_Destination);
            $('#tour_packageType').val(elem.tour_packageType);
            $('#tour_fromDateEdit').val(elem.tour_fromDate);
            $('#tour_toDateEdit').val(elem.tour_toDate);
            $('#tour_numDaysEdit').val(elem.tour_numDays);
            $('#ctr').val(elem.ctr);
            var tour_numNightsPlus1 = JSON.parse(elem.tour_numNights) + 1;
            $('#tour_numNightsEdit').append('<option value='+elem.tour_numNights+' selected>'+elem.tour_numNights+'</option><option value='+tour_numNightsPlus1+'>'+tour_numNightsPlus1+'</option>');
            $('#mop option:selected').text(elem.mop).val(elem.mop);
            $('#passportNum').val(elem.passportNum);
            $('#passportExpiry').val(elem.passportExpiry).attr('min', elem.passportExpiry);
            $('#paymentAmount').val(elem.paymentAmount);
            $('#tourAmount').val(elem.tourAmount).prop('readonly', true);
            //$('#paymentStatus option:selected').text(elem.paymentStatus).val(elem.paymentStatus);
            $('#paymentStatus1').val(elem.paymentStatus);
            $('#paymentStatus').val($('#paymentStatus1').val())
            $('#mop1').val(elem.mop);

          });
          $('#operation1').val('editTour');
          var ctr = $('#ctr').val();
          $.ajax({
            url:"AJAX/deleteOtherDestinationsWhileEditing.php",
            type:'POST',
            data:{ctr:ctr},
            success:function(data)
            {
              //alert...
            }
          });
        }
      });
    }*/

    function editTourDetails(user_id, desti) {
      $.ajax({
        url:"AJAX/fetchTourDetails.php",
        method:"POST",
        data:{
          user_id:user_id,
          desti:desti
        },
        dataType:"json",
        success:function(data)
        {
          $('#editTourForm')[0].reset();
          $('#editTourModal').modal('show');
          $.each(data, (index,elem)=> {
            $('#numPax').val(elem.numPax);
            $('#tour_DestinationEdit').val(elem.tour_Destination);
            $('#tour_packageType').val(elem.tour_packageType);
            $('#tour_fromDateEdit').val(elem.tour_fromDate);
            $('#tour_toDateEdit').val(elem.tour_toDate);
            $('#tour_numDaysEdit').val(elem.tour_numDays);
            $('#ctr').val(elem.ctr);
            var tour_numNightsPlus1 = JSON.parse(elem.tour_numNights) + 1;
            $('#tour_numNightsEdit').append('<option value='+elem.tour_numNights+' selected>'+elem.tour_numNights+'</option><option value='+tour_numNightsPlus1+'>'+tour_numNightsPlus1+'</option>');
          });
          $('#operation1').val('editTour');
          var ctr = $('#ctr').val();
          $.ajax({
            url:"AJAX/deleteOtherDestinationsWhileEditing.php",
            type:'POST',
            data:{ctr:ctr},
            success:function(data)
            {
              //alert...
            }
          });
        }
      });
    }

    function fetchPaymentDetails() {
      var dataTable4 = $('#tbl_billing').DataTable({
        "responsive":true,
        "processing":true,
        "destroy": true,
        "serverSide":true,
        "filter":false,
        "ajax":{
          url:"AJAX/fetchPaymentDetails.php",
          type:"POST",
          data: {booking_ID:tourID}
        },
        "columnDefs":[
        {
          "targets":[0,1,3,4],
          "visible":false
        },
        /*{
          'targets': [8],
          "orderable": false
        }*/
        ],
        "language": {
          "search": "Search Payment Amount:"
        }
      });
    }

    $(document).on('click', '.paymentDetails', function() {
      tourID = $(this).attr('id');
      fetchPaymentDetails();
      $('.paymentDetailsModal').modal('show');
      loadBookDetails();

      $('.paymentDetailsModal').on('shown.bs.modal', function() {
        $.ajax({
          url:"AJAX/getRemainingBalance.php",  
          method:"POST",  
          data:{booking_ID:tourID},  
          success:function(data)  
          {
            if(data == 0) {
              $('#addPayment').css('display', 'none');
            }
            else {
              $('#addPayment').css('display', 'block');             
            }
          }
        });     
        $(this).focus();
        $('#header6').text('Payment Details for Request ID '+tourID);
      });
    });

    $(document).on('click', '.editTour', function() {
      var user_id = $(this).attr("id"); //booking_ID
      var desti = $(this).attr("name"); //desti
      //var type = "Pending";
      editTourDetails(user_id, desti);
    });

    $(document).on('keydown keyup', '#paymentAmount', function(e) {
      var diff = Number($('#paymentAmount').val()) - Number($('#tourAmount').val());
      if(diff >= 0) {
        $('#paymentStatus').val('Fully Paid');
        $('#paymentAmount').val($('#tourAmount').val())
        //e.preventDefault()
      }
      else {
        $('#paymentStatus').val('Partially Paid');     
      }
    });

    $(document).on('change', '#mop', function () {
      $('#mop1').val($('#mop option:selected').text());
    });

    $(document).on('submit', '#editTourForm', function(event) {
      event.preventDefault();
      client_ID = $('.view').attr('id');
      var numPax = $('#numPax').val();
      var tour_Destination = $('.tour_DestinationEdit').val();
      var tour_fromDate = $('.tour_fromDateEdit').val();
      var tour_toDate = $('.tour_toDateEdit').val();
      var tour_numDays = $('.tour_numDaysEdit').val();
      var tour_numNights = $('.tour_numNightsEdit').val();
      var tour_packageType = $('.tour_packageType').val();

      if(numPax != 0)
      {
        $.ajax({
          url:"AJAX/updateEmail.php",
          method:'POST',
          data:new FormData(this),
          contentType:false,
          processData:false,
          success:function(data)
          {
            alert(data);
            $('#editTourForm')[0].reset();
            $('#editTourModal').modal('hide');
            $('#tbl_tours').DataTable().ajax.reload();
            $('#tbl_clients').DataTable().ajax.reload();
          }
        });
      }
      else
      {
        alert('Number of persons must not be zero.')
      }
    });

    function loadBookDetails() {
      $.ajax({
        url:"AJAX/loadBookDetails.php",
        method:"POST",
        data:{tourID:tourID},
        dataType:"json",
        success:function(data)
        {
          $('#bookDetails').html(data);
          $('#bookDetails1').html(data);
        }
      });
    }

    function loadSuppliers(booking_ID, operation) {
      var dataTable3 = $('#tbl_suppliers').DataTable({
        "responsive":true,
        "processing":true,
        "serverSide":true,
        "order" : [],
        "ajax" : {
          url:"AJAX/fetchSuppliersForApproved.php",
          type:"POST",
          data:{booking_ID:booking_ID, operation:operation}
        },
        "columnDefs":[
        {
          "targets":[0,1,2,3],
          "visible":false
        }
        ],
        "language": {
          "search": "Search Company Name:"
        }
      });
    }

    $(document).on('click', '.viewQuotationImage', function() {
      $('#viewQuotationImageModal').modal('show');

      supplierID = $(this).attr('id');
      $('#supplier_ID_quotationImage').val(supplierID);
      $('#booking_ID_quotationImage').val(tourID);

      $('#viewQuotationImageModal').on('shown.bs.modal', function(e) {
        e.preventDefault();

        if(e.handled !== true) {
          $.ajax({
            url:"AJAX/check_ifHasImage.php",
            method:"POST",
            data:{supplierID:supplierID, tourID:tourID},
            success:function(data)
            {
              if(data == ";Empty") {
                $('.fileUpload').css('display', 'block');
                $('#uploadImage').css('display', 'block');
                $('.closeViewImage').css('display', 'block');
                $('.viewImage').css('display', 'none');
                $('#viewQuotationImageModal h5').text('Add Quotation')
                e.handled == true;
              }
              else {
                $.ajax({
                  url:"AJAX/viewImage.php",
                  method:"POST",
                  data:{supplierID:supplierID, tourID:tourID},
                  success:function(data)
                  {
                    $('.fileUpload').css('display', 'none');
                    $('.viewImage').css('display', 'block');
                    $('#viewQuotationImageModal h5').text('View Quotation')
                    $('#uploadImage').css('display', 'none');
                    $('.closeViewImage').css('display', 'none');
                    $('.viewImage').html(data);
                    e.handled == true;
                  }
                })
              }
            }
          })
        }
      });
    });

    $(document).on('click', '.viewSupplier', function() {
      $('#addSupplier').hide();
      $('#cancelAddSupplier').hide();
      $('#tbl_suppliers').DataTable().destroy();
      $('.selectSupplierModal').attr('id', $(this).attr('id'));
      tourID = $(this).attr('id');
      //var selectSupplier = $('.selectSupplierModal').attr('id');
      operation = 'selectSupplier';
      var booking_ID = tourID;
      loadSuppliers(booking_ID, operation);     
      $('.selectSupplierModal').modal('show');

      $('.selectSupplierModal').on('shown.bs.modal', function() {
        $(this).focus();
        loadBookDetails();
        $('#header5').text('Partner for Tour ID '+tourID);
      });

    });

  });
</script>