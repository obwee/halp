<?php
require_once "template/header.php";
?>

<div class="container">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <p class="h4">Class List</p>
    </div>
    <div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
        <table id="tbl_classList" style="width:100%" class="table table-striped table-bordered table-hover">
            <thead></thead>
            <tbody></tbody>
        </table>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="viewClassList" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Class List</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div style="border: 3px solid #d5d5d5;padding-top:5px;padding-left:5px;padding-right:5px;padding-bottom:0;border-radius: 4px 4px;margin-bottom:5px;">
                    <b>Training Details:</b>
                    <div class="form-group row" style="margin-left:15px;">
                        <label for="courseName" class="col-sm-3 col-form-label"><span class="fas fa-book"></span> <b>Course</b></label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control-plaintext" id="courseName">
                        </div>
                        <label for="schedule" class="col-sm-3 col-form-label"><span class="fas fa-calendar-alt"></span> <b>Schedule</b></label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control-plaintext" id="schedule">
                        </div>
                        <label for="venue" class="col-sm-3 col-form-label"><span class="fas fa-map"></span> <b>Venue</b></label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control-plaintext" id="venue">
                        </div>
                        <label for="instructor" class="col-sm-3 col-form-label"><span class="fas fa-chalkboard-teacher"></span> <b>Instructor</b></label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control-plaintext" id="instructor">
                        </div>
                    </div>
                </div>
                <div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
                    <table id="tbl_studentList" style="width:100%" class="table table-striped table-bordered table-hover">
                        <thead></thead>
                        <tbody></tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4">
                                <th>
                                <th>
                                <th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>

<?php
require_once "template/scripts.php";
?>

<script src="/Nexus/dashboard/js/admin/dashboard.classList.js"></script>

<?php
require_once "template/footer.php";
?>