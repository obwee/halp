<?php
require_once "Template/header.php";
?>

<div class="container">
    <div class="container" id='calendar'></div>
</div>

<div class="modal fade" id="addScheduleModal" role="dialog">
    <div class="modal-dialog addScheduleModal">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #3c8dbc;">
                <h5 align="center" style="color:white;"><span class="fas fa-calendar-alt"></span> Add Schedule</h5>
            </div>
            <form id="addScheduleForm" method="POST">
                <div class="modal-body">
                    <input type="text" class="courseId" name="courseId" readonly hidden>
                    <div class="alert alert-danger error-msg" role="alert" style="display: none;"></div>
                    <div class="form-group">
                        <label for="courseTitle"><span class="fas fa-book"></span> Select Course</label>
                        <select class="form-control courseTitle" name="courseTitle"></select>
                    </div>
                    <div class="form-group">
                        <label for="coursePrice"><span class="fas fa-money"></span> Course Price</label>
                        <input type="number" name="coursePrice" class="form-control coursePrice" placeholder="Course Price">
                    </div>
                    <div class="form-group">
                        <label for="courseVenue"><span class="fas fa-map"></span> Select Venue</label>
                        <select class="form-control courseVenue" name="courseVenue"></select>
                    </div>
                    <div class="form-inline" style="margin-left: 15px;">
                        <div class="col-xs-4">
                            <label for="fromDate"><span class="fas fa-angle-double-left"></span>Start Date</label>
                            <input type="text" class="form-control fromDate" name="fromDate" placeholder="From" required style="margin-left:16px;width:185px;" readonly>
                        </div>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                        <div class="col-xs-4">
                            <label for="toDate"><span class="fas fa-angle-double-right"></span>End Date</label>
                            <input type="text" class="form-control toDate" name="toDate" placeholder="To" required style="margin-left:16px;width:185px;" readonly>
                        </div>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="numSlots"><span class="fas fa-users"></span> No. of Students</label>
                        <input type="number" name="numSlots" class="form-control numSlots" min="1" max="100" value="1">
                    </div>
                    <div class="form-group">
                        <label for="courseInstructor"><span class="fas fa-chalkboard-teacher"></span> Instructor</label>
                        <select class="form-control courseInstructor" name="courseInstructor"></select>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Add</button>
                        <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                    </div>
            </form>
        </div>
    </div>
</div>
</div>

<div class="modal fade" id="editScheduleModal" role="dialog">
    <div class="modal-dialog editScheduleModal">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #3c8dbc;">
                <h5 align="center"><span class="fas fa-calendar-alt"></span> Edit Schedule</h5>
            </div>
            <form id="editScheduleForm" method="POST">
                <div class="modal-body">
                    <input type="text" class="scheduleId" name="scheduleId" readonly hidden>
                    <div class="alert alert-danger error-msg" role="alert" style="display: none;"></div>
                    <div class="form-group">
                        <label for="courseTitle"><span class="fas fa-book"></span> Select Course</label>
                        <select class="form-control courseTitle" name="courseTitle"></select>
                    </div>
                    <div class="form-group">
                        <label for="coursePrice"><span class="fas fa-money"></span> Course Price</label>
                        <input type="number" name="coursePrice" class="form-control coursePrice" placeholder="Course Price">
                    </div>
                    <div class="form-group">
                        <label for="courseVenue"><span class="fas fa-map"></span> Select Venue</label>
                        <select class="form-control courseVenue" name="courseVenue"></select>
                    </div>
                    <div class="form-inline" style="margin-left: 15px;">
                        <div class="col-xs-4">
                            <label for="fromDate"><span class="fas fa-angle-double-left"></span>Start Date</label>
                            <input type="text" class="form-control fromDate" name="fromDate" placeholder="From" required style="margin-left:16px;width:185px;" readonly>
                        </div>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                        <div class="col-xs-4">
                            <label for="toDate"><span class="fas fa-angle-double-right"></span>End Date</label>
                            <input type="text" class="form-control toDate" name="toDate" placeholder="To" required style="margin-left:16px;width:185px;" readonly>
                        </div>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="remainingSlots"><span class="fas fa-users"></span> Slots Remaining</label>
                        <input type="text" class="form-control remainingSlots" readonly>
                    </div>
                    <div class="form-group">
                        <label for="numSlots"><span class="fas fa-users"></span> No. of Students</label>
                        <input type="number" name="numSlots" class="form-control numSlots" min="1" max="100" value="1">
                    </div>
                    <div class="form-group">
                        <label for="courseInstructor"><span class="fas fa-chalkboard-teacher"></span> Instructor</label>
                        <select class="form-control courseInstructor" name="courseInstructor"></select>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Update</button>
                        <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                    </div>
            </form>
        </div>
    </div>
</div>
</div>

<?php
require_once "template/calendarCssAndScripts.php";
require_once "template/scripts.php";
?>

<script src="/Nexus/utils/js/utils.Libraries.js"></script>
<script src="/Nexus/utils/js/utils.Validations.js"></script>
<script src="/Nexus/utils/js/utils.Forms.js"></script>

<script src="/Nexus/dashboard/js/admin/dashboard.schedule.js"></script>

<?php
require_once "template/footer.php";
?>