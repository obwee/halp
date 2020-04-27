<?php
require_once "template/header.php";
?>

<div class="container">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <p class="h4">Class List</p>
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
                    <th style="white-space:nowrap;">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>EH</td>
                    <td>March 21 - 22, 2020</td>
                    <td>12</td>
                    <td>Richard Reblando</td>
                    <td>Morayta</td>
                    <td>
                        <button class="btn btn-sm btn-primary fas fa-eye" data-toggle="modal" data-target="#viewClassList"></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="viewClassList" data-backdrop="static">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
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
        <table id="tbl_ongoing" style="width:100%" class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th style="white-space:nowrap;">Name of Student</th>
                    <th style="white-space:nowrap;">Email Address</th>
                    <th style="white-space:nowrap;">Contact Number</th>
                    <th style="white-space:nowrap;">Date Paid</th>
                    <th style="white-space:nowrap;">Amount Paid</th>
                    <th style="white-space:nowrap;">Balance</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>

<?php
require_once "template/scripts.php";
?>

<script src="/Nexus/dashboard/js/admin/dashboard.ongoingSched.js"></script>

<?php
require_once "template/footer.php";
?>