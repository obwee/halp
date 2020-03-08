<?php
require_once "Template/header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

    <style type="text/css">
        td {
            text-align: center;
        }

        select {
            width: 180px;
            text-align: center;
        }
    </style>

</head>
<body>

<div class="container">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <p class="h2">Trainings Report</p>
    </div>

    <div class="form-group">
        <div class="row justify-content-md-center">
            <div class="col-xs-4">&nbsp&nbsp&nbsp&nbsp
                <label for="date1"><span class="fas fa-angle-double-left"></span> Start Date</label>
                <input type="date" class="form-control" id="date1" name="date1" placeholder="From" required style="margin-left:16px;width:185px;" max="2999-12-31">
            </div>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            <div class="col-xs-4">
                <label for="date2">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<span class="fas fa-angle-double-right"></span> End Date</label>
                <input type="date" class="form-control" id="date2" name="date2" placeholder="To" required max="2999-12-31">&nbsp&nbsp
            </div>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
        </div>
    </div>
    <div class="row justify-content-md-center">
        <div class="col-md-4 col-xs-4">
            <select class="form-control">
               <option value="" selected disabled hidden>Select Venue</option>
               <option>Makati</option>
               <option>Manila</option>
            </select>
            <br>
            <input type="submit" name="loadSales" id="loadSales" class="btn btn-success form-control loadSales" value="Load Trainings">
        </div>
    </div>
</div>  
    
    <div class="container">

        <div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
            <div align="center">
                <br>
                <button type="button" id="addNewCourse" data-toggle="modal" data-target="#addCourseModal" class="btn btn-dark">Export/Print</button>
                <br><br>     
            </div>
            <br>



            <table id="tbl_trainings" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th style="white-space:nowrap;">Course Code</th>
                        <th style="white-space:nowrap;">Course Title</th>
                        <th style="white-space:nowrap;">Description</th>
                        <th style="white-space:nowrap;">Start Date</th>
                        <th style="white-space:nowrap;">End Date</th>
                        <th style="white-space:nowrap;">Venue</th>
                        <th style="text-align:center;">No. of Students Enrolled</th>
                        <th style="white-space:nowrap;">Course Fee</th>
                        <th style="white-space:nowrap;">Instructor</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>MCP 20410</td>
                        <td>Installing and Configuring Windows Server 2012</td>
                        <td>Microsoft Certified Professional</td>
                        <td>2020-03-25</td>
                        <td>2020-03-27</td>
                        <td>Makati</td>
                        <td>13</td>
                        <td>P 15,000</td>
                        <td>Mark Sampayan</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="viewQuoteModal" tabindex="-1" role="dialog">
        <div class="modal-dialog viewQuoteModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 align="center"><span class="glyphicon glyphicon-plane"></span>View Quotation</h5>
                </div>
                <div class="modal-body">
                    <div class="quoteBody">
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


<?php
require_once "template/scripts.php";
?>

<script src="admin/js/dashboard.trainingsReport.js"></script>

<?php
require_once "template/footer.php";
?>
