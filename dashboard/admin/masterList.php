<?php
require_once "Template/header.php";
?>

<div class="container">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <p class="h2">Master List</p>
    </div>

    <div class="row" style="border-radius:8px 8px;background-color:white;padding:10px 10px;margin-left:10px;margin-right:10px;border-width:2px;">
        <div class="col-sm-4">
            <div class="venue" >
                <label><i class="fas fa-map-pin"></i><b> Venue</b></label><br>
                <div class="custom-control custom-checkbox mr-sm-2">
                    <input type="checkbox" class="custom-control-input" id="makati">
                    <label class="custom-control-label" for="makati">Makati</label>
                </div>   
                <div class="custom-control custom-checkbox mr-sm-2">
                    <input type="checkbox" class="custom-control-input" id="manila">
                    <label class="custom-control-label" for="manila">Manila</label>
                </div>
            </div>  
        </div>
        <div class="col-sm-4">
            <label><i class="fas fa-book"></i><b> Course</b></label>
            <select class="form-control">
                <option value="" selected disabled hidden>Select Course</option>
                <option>CCNAv4</option>
                <option>MCP</option>
            </select>&nbsp&nbsp
        </div>
        <div class="col-md-4">
            <label><i class="fas fa-calendar"></i><b> Schedule</b></label>
            <select class="form-control">
                <option value="" selected disabled hidden>Select Schedule</option>
            </select>&nbsp&nbsp
        </div> 
    </div>
</div> <br>
                     

<div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
    <table id="tbl_students" style="width:100%" class="table table-striped table-bordered table-hover table-responsive-sm">
        <div align="center">
            <button type="submit" id="loadClassList" class="btn btn-primary"><i class="fas fa-eraser"></i> Clear Selection</button>
            <button type="submit" id="loadClassList" class="btn btn-success"><i class="fas fa-spinner"></i> Load Class List</button>
            <button type="submit" id="export" class="btn btn-dark"><i class="fas fa-print"></i> Export/Print</button>
        </div>
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
