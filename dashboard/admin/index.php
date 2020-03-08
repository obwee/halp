<?php
require_once "template/header.php";
?>

<style>
    #chartData {
        width: 100%;
        height: 500px;
    }
</style>

<div class="container">

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <p class="h2">Dashboard</p>
    </div>

    <div class="container row justify-content-center">
        <div class="col-sm-2 pl-4">
            <!--   Analytics -->
            <p class="h4 ml-n2">Analytics</p><br>

            <div class="row">
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
            </div>

            <div class="row">
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
                </a>
            </div>

            <div class="row">
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
                </a>
            </div>

            <div class="row">
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
                </a>
            </div>
        </div>

        <div class="col-sm-1"></div>

        <div class="col-sm-9">
            <div class="container mt-2">
                <div id="chartData"></div>
            </div>
        </div>

    </div>

    <!-- Table -->
    <br><br>
    <div class="container">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-2 mb-3 border-bottom">
            <p class="h4">Upcoming Trainings (Reminder)</p>
        </div>
        <div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
            <table id="tbl_upcoming" style="width:100%" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th style="white-space:nowrap;">Course Code</th>
                        <th style="white-space:nowrap;">Schedule</th>
                        <th style="white-space:nowrap;">No. of Students</th>
                        <th style="white-space:nowrap;">Instructor</th>
                        <th style="white-space:nowrap;">Venue</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>EH</td>
                        <td>Feb 21 - 22, 2020</td>
                        <td>12</td>
                        <td>Richard Reblando</td>
                        <td>Morayta</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <p class="h4">Ongoing Trainings (Reminder)</p>
        </div>
        <div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
            <table id="tbl_ongoing" style="width:100%" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th style="white-space:nowrap;">Course Code</th>
                        <th style="white-space:nowrap;">Schedule</th>
                        <th style="white-space:nowrap;">No. of Students</th>
                        <th style="white-space:nowrap;">Instructor</th>
                        <th style="white-space:nowrap;">Venue</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>EH</td>
                        <td>March 21 - 22, 2020</td>
                        <td>12</td>
                        <td>Richard Reblando</td>
                        <td>Morayta</td>
                    </tr>
                    <tr>
                        <td>20410</td>
                        <td>March 21 - 23, 2020</td>
                        <td>6</td>
                        <td>Mark Sampayan</td>
                        <td>Makati</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
require_once "template/scripts.php";
?>

<!-- Amcharts Resources (for Dashboard only) -->
<script src="/Nexus/dashboard/js/amcharts_4.9.4/core.js"></script>
<script src="/Nexus/dashboard/js/amcharts_4.9.4/charts.js"></script>
<script src="/Nexus/dashboard/js/amcharts_4.9.4/themes/animated.js"></script>
<script src="/Nexus/dashboard/js/amcharts_4.9.4/themes/kelly.js"></script>
<script src="/Nexus/dashboard/js/amcharts_4.9.4/themes/material.js"></script>
<script src="/Nexus/dashboard/js/admin/dashboard.chart.js"></script>

<script src="/Nexus/dashboard/js/admin/dashboard.index.js"></script>

<?php
require_once "template/footer.php";
?>