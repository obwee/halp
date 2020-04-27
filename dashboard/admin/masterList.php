<?php
require_once "Template/header.php";
?>

<div class="container">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2><span class="fas fa-clipboard-list"></span> Students Report</h2>
    </div>

    <form action="POST" id="filterForm">
        <div class="row" style="border-radius:8px 8px;padding-top:10px;padding-bottom:0;margin-bottom:0;margin-left:10px;margin-right:10px;border-width:2px;background-color:#fff;box-shadow:8px 8px #3c8dbc;">
            <div class="col-md-4">
                <div class="row">
                    <div class="col-sm-6">
                        <label><i class="fas fa-map-pin"></i><b> Venue</b></label><br>
                        <div class="venue-tpl" hidden>
                            <div class="form-check">
                                <input class="form-check-input venue" name="venue[]" type="checkbox">
                                <label class="form-check-label"></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="paymentStatus">
                            <label><i class="fas fa-money"></i><b> Payment</b></label><br>
                            <div class="form-check">
                                <input class="form-check-input paymentStatus" name="paymentStatus[]" type="checkbox" value="0">
                                <label class="form-check-label">Unpaid</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input paymentStatus" name="paymentStatus[]" type="checkbox" value="1">
                                <label class="form-check-label">Partial</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input paymentStatus" name="paymentStatus[]" type="checkbox" value="2">
                                <label class="form-check-label">Full</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <label><i class="fas fa-book"></i><b> Course</b></label>
                <select class="form-control courseFilterDropdown" name="courseDropdown">
                    <option value="" selected disabled hidden>Select Course</option>
                </select>&nbsp&nbsp
            </div>
            <div class="col-md-4">
                <label><i class="fas fa-calendar"></i><b> Schedule</b></label>
                <select class="form-control scheduleFilterDropdown" name="scheduleDropdown">
                    <option value="" selected disabled hidden>Select Schedule</option>
                </select>
                <div class="form-group row">
                    <label for="slot" class="col-sm-4 col-form-label"><i class="fas fa-users"></i><b> Slots</b></label>
                    <div class="col-sm-8">
                        <input type="text" disabled class="form-control-plaintext numSlots" value="N/A">
                    </div>
                </div>
            </div>
        </div>
        <div align="center" style="margin-top:12px;margin-bottom:15px;">
            <button type="button" id="clearSelection" class="btn btn-danger"><i class="fas fa-eraser"></i> Clear Selection</button>
            <button type="submit" id="loadClassList" class="btn btn-success">&nbsp&nbsp&nbsp&nbsp&nbsp<i class="fas fa-spinner"></i> Load List&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</button>
            <button type="submit" id="export" class="btn btn-dark"><i class="fas fa-print"></i> Export/Print</button>
        </div>
    </form>

<div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl" style="padding:8px 8px;">
    <table id="tbl_students" style="width:100%" class="table table-striped table-bordered table-hover table-responsive-sm">
        <thead>
            <tr>
                <th style="white-space:nowrap;">Student Name</th>
                <th style="white-space:nowrap;">E-mail Address</th>
                <th style="white-space:nowrap;">Contact Number</th>
                <th style="white-space:nowrap;">MOP</th>
                <th style="white-space:nowrap;">Date Paid</th>
                <th style="white-space:nowrap;">Amount Paid</th>
                <th style="white-space:nowrap;">Status</th>
                <th style="white-space:nowrap;">Balance</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Mark Sale</td>
                <td>marksale@gmail.com</td>
                <td>5841881</td>
                <td>BDO</td>
                <td>Feb 20, 2020</td>
                <td>10,000</td>
                <td>Partial</td>
                <td>10,000</td>
            </tr>
        </tbody>    
    </table>
</div>


<?php
require_once "template/scripts.php";
?>

<script src="/Nexus/dashboard/js/admin/dashboard.masterList.js"></script>


<?php
require_once "template/footer.php";
?>
