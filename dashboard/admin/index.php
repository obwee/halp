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
            <p class="h4 ml-n2">Analytics</p><br>

            <div class="row">
                <a href="#">
                    <div class="info-box">
                        <span class="info-box-icon bg-aqua"><i class="fas fa-mail-bulk"></i></span>
                        <div class="info-box-content" style="text-align:center;width:140px;">
                            <span class="info-box-text">No. of Quotation<br>Requests</span>
                            <span class="info-box-number emailed"></span>
                        </div>
                    </div>
                </a>
            </div>

            <div class="row">
                <a href="#">
                    <div class="info-box">
                        <span class="info-box-icon bg-yellow"><i class="fas fa-check"></i></span>
                        <div class="info-box-content" style="text-align:center;width:140px;">
                            <span class="info-box-text">No. of Partially<br>Paid Students</span>
                            <span class="info-box-number approved"></span>
                        </div>
                    </div>
                </a>
            </div>

            <div class="row">
                <a href="#">
                    <div class="info-box">
                        <span class="info-box-icon bg-green"><i class="fas fa-check-double"></i></span>
                        <div class="info-box-content" style="text-align:center;width:140px;">
                            <span class="info-box-text">No. of Fully Paid<br>Students</span>
                            <span class="info-box-number finished"></span>
                        </div>
                    </div>
                </a>
            </div>

            <div class="row">
                <a href="#">
                    <div class="info-box">
                        <span class="info-box-icon bg-maroon"><i class="fas fa-times"></i></span>
                        <div class="info-box-content" style="text-align:center;width:140px;">
                            <span class="info-box-text">No. of Unpaid<br>Students</span>
                            <span class="info-box-number cancelled"></span>
                        </div>
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
</div>
</div>

<?php
require_once "template/scripts.php";
require_once "template/amchartScripts.php"
?>

<script src="/Nexus/dashboard/js/admin/dashboard.chart.js"></script>
<script src="/Nexus/dashboard/js/admin/dashboard.index.js"></script>

<?php
require_once "template/footer.php";
?>