<?php
require_once "Template/header.php";
?>

<style>
    input[type=date]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        display: none;
    }
</style>

<form id="filterForm">
    <div class="container">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h2><span class="fas fa-money-check"></span> Sales Report</h2>
            <div class="alert alert-danger error-msg" role="alert" style="display: none;"></div>
        </div>

        <div class="row" style="background-color:white;padding:5px;margin:5px;border-radius:8px 8px;margin-bottom:10px;box-shadow:8px 8px #3c8dbc">
            <div class="col-sm-6">
                <div class="row dateFilter">
                    <div class="col-6">
                        <label for="date1"><span class="fas fa-angle-double-left"></span> Start Date</label>
                        <input type="date" class="form-control fromDate" name="fromDate" placeholder="From" max="2999-12-31">
                    </div>
                    <div class="col-6">
                        <label for="date2"><span class="fas fa-angle-double-right"></span> End Date</label>
                        <input type="date" class="form-control endDate" name="toDate" placeholder="To" max="2999-12-31">
                    </div>
                </div>
                <div class="form-group">
                    <label><i class="fas fa-map"></i><b> Branch</b></label>
                    <select class="form-control venueDropdown" name="venue">
                        <option disabled selected hidden>Select Branch</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label><i class="fas fa-book"></i><b> Course</b></label>
                    <select class="form-control courseDropdown" name="course">
                        <option disabled selected hidden>Select Course</option>
                    </select>
                    <label><i class="fas fa-calendar-alt"></i><b> Schedule</b></label>
                    <select class="form-control scheduleDropdown" name="schedule">
                        <option disabled selected hidden>Select Schedule</option>
                    </select>
                </div>
            </div>

        </div>
    </div>

    <div align="center" style="padding-top:5px;padding-bottom:5px;">
        <button type="button" id="loadClassList" class="btn btn-success"><i class="fas fa-spinner"></i> Load Class List</button>
        <button type="button" id="clearSelection" class="btn btn-primary"><i class="fas fa-eraser"></i> Clear Selection</button>
        <button type="button" id="printReport" class="btn btn-dark"><i class="fas fa-print"></i> Export/Print</button>
    </div>
</form>

<div class="container">
    <div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
        <table id="tbl_salesReport" class="table table-striped table-bordered table-hover">
            <thead></thead>
            <tbody></tbody>
            <tfoot>
                <th colspan="5"></th>
                <th></th>
                <th></th>
                <th></th>
            </tfoot>
        </table>
    </div>
</div>

<?php
require_once "template/scripts.php";
?>

<script src="/Nexus/utils/js/utils.Libraries.js"></script>
<script src="/Nexus/utils/js/utils.Validations.js"></script>
<script src="/Nexus/utils/js/utils.Forms.js"></script>

<script src="/Nexus/dashboard/js/admin/dashboard.salesReport.js"></script>

<?php
require_once "template/footer.php";
?>