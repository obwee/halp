<?php
require_once "Template/studentHeader.php";
?>

<div class="container">

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <p class="h2">Dashboard</p>
    </div>

    <!--   Analytics -->
    <h4>Analytics</h4><br>

    <div class='row'>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="quotationRequest.php">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fas fa-mail-bulk"></i></span>
                    <div class="info-box-content" style="text-align:center;">
                        <span class="info-box-text">Trainings<br>Enrolled</span>
                        <span class="info-box-number emailed">
                            <!-- <small>%</small> --></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </a>
            <!-- /.info-box -->
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="paymentPartial.php">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fas fa-check"></i></span>
                    <div class="info-box-content" style="text-align:center;">
                        <span class="info-box-text">On-going<br>Trainings</span>
                        <span class="info-box-number approved">
                            <!-- <small>%</small> --></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="paymentFull.php">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fas fa-check-double"></i></span>
                    <div class="info-box-content" style="text-align:center;">
                        <span class="info-box-text">Finished<br>Trainings</span>
                        <span class="info-box-number finished">
                            <!-- <small>%</small> --></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="paymentPending.php">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fas fa-times"></i></span>
                    <div class="info-box-content" style="text-align:center;">
                        <span class="info-box-text">Pending<br>Payment</span>
                        <span class="info-box-number cancelled">
                            <!-- <small>%</small> --></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
        </div>

    </div>

</div>

<?php
require_once "template/scripts.php";
?>

<!-- <script src="js/studentDash.Enrollment.js"></script> -->

<?php
require_once "template/studentFooter.php";
?>