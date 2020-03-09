<?php
require_once "Template/header.php";
?>


<style type="text/css">
    td {
        text-align: center;
    }
</style>


<div class="container">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <p class="h2">Sales Report</p>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="row">
                <div class="col-xs-4">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    <label for="date1">Start Date <span class="fas fa-angle-double-left"></span></label>
                    <input type="date" class="form-control" id="date1" name="date1" placeholder="From" required style="margin-left:16px;width:185px;" max="2999-12-31">
                </div>
                <div class="col-xs-4">
                    <label for="date2">&nbsp&nbsp&nbsp&nbsp&nbsp<span class="fas fa-angle-double-right"></span> End Date</label>
                    <input type="date" class="form-control" id="date2" name="date2" placeholder="To" style="margin-left:16px;width:185px;" required max="2999-12-31">
                </div>
            </div> <br>
            <div class="form-group">
                <label><b>Course</b></label>
                <select class="form-control">
                    <option disabled selected hidden>Select Course</option>
                </select>
            </div>    
            <div class="form-group">    
                <label><b>Schedule</b></label>
                <select class="form-control">
                    <option disabled selected hidden>Select Schedule</option>
                </select>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
             <h6><b>Payment Status</b></h6>
             <div class="custom-control custom-checkbox mr-sm-2">
                <input type="checkbox" class="custom-control-input" id="partial">
                <label class="custom-control-label" for="partial">Partial</label>
            </div>   
            <div class="custom-control custom-checkbox mr-sm-2">
                <input type="checkbox" class="custom-control-input" id="full">
                <label class="custom-control-label" for="full">Full</label>
            </div> <br>
            <div>
                <label><b>Branch</b></label>
                <select class="form-control">
                    <option disabled selected hidden>Select Branch</option>
                </select>
            </div>
        </div> 
        
    </div>    
</div>        

    <div align="center">
        <button type="submit" id="loadClassList" class="btn btn-primary"><i class="fas fa-eraser"></i> Clear Selection</button>
        <button type="submit" id="loadClassList" class="btn btn-success"><i class="fas fa-spinner"></i> Load Class List</button>
        <button type="submit" id="export" class="btn btn-dark"><i class="fas fa-print"></i> Export/Print</button>
    </div>


<div class="container">
    <div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
        <table id="tbl_sales" class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th style="white-space:nowrap;">Date Paid</th>
                    <th style="white-space:nowrap;">Student Name</th>
                    <th style="white-space:nowrap;">Company Name</th>
                    <th style="white-space:nowrap;">Course Enrolled</th>
                    <th style="white-space:nowrap;">Start Date</th>
                    <th style="white-space:nowrap;">End Date</th>
                    <th style="white-space:nowrap;">MOP</th>
                    <th style="white-space:nowrap;">Course Amount</th>
                    <th style="white-space:nowrap;">Amount Paid</th>
                    <th style="white-space:nowrap;">Payment Status</th>
                    <th style="white-space:nowrap;">Approved By</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>2020-03-01</td>
                    <td>Aries Valenzuela Macandili</td>
                    <td>Simplex Internet Philippines</td>
                    <td>Ethical Hacking with Penetration Testing</td>
                    <td>2020-03-21</td>
                    <td>2020-03-22</td>
                    <td>Cheque</td>
                    <td>P 3,000</td>
                    <td>P 3,000</td>
                    <td>Full</td>
                    <td>Aubrey Arbiol</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>


<?php
require_once "template/scripts.php";
?>

<script src="/Nexus/dashboard/admin/js/dashboard.salesReport.js"></script>

<?php
require_once "template/footer.php";
?>
