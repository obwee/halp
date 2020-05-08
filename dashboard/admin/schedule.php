<?php
require_once "Template/header.php";
?>

<div class="container">
    <div class="container" id='calendar'></div>
</div>

<div class="modal fade" id="addScheduleModal" role="dialog" data-backdrop="static">
    <div class="modal-dialog addScheduleModal">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #3c8dbc;">
                <h5 align="center" style="color:white;"><span class="fas fa-calendar-alt"></span> Add Schedule</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color:white">&times;</span>
                </button>
            </div>
            <form id="addScheduleForm" method="POST">
                <div class="modal-body" style="padding: 30px 30px;">
                    <input type="text" class="courseId" name="courseId" readonly hidden>
                    <div class="alert alert-danger error-msg" role="alert" style="display: none;"></div>
                    <div class="form-group row">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-book"></i></span>
                            </div>
                            <select class="form-control courseTitle" name="courseTitle" placeholder="Select Course" ></select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-usd"></i></span>
                            </div>
                            <input type="number" name="coursePrice" class="form-control coursePrice" placeholder="Course Price">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-map-pin"></i></span>
                            </div>
                            <select class="form-control courseVenue" name="courseVenue"></select>
                        </div>
                    </div>
                    <div class="form-inline mb-3" style="margin-left: 8px;">
                        <div class="col-xs-4">
                            <label for="fromDate">Start Date <span class="fas fa-angle-double-left"></span></label>
                            <input type="text" class="form-control fromDate" name="fromDate" placeholder="From" required style="margin-left:13px;width:185px;" readonly>
                        </div>&nbsp&nbsp
                        <div class="col-xs-4">
                            <label for="toDate"><span class="fas fa-angle-double-right"></span> End Date</label>
                            <input type="text" class="form-control toDate" name="toDate" placeholder="To" required style="margin-left:22px;width:185px;" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-users"></i></span>
                            </div>
                            <input type="number" name="numSlots" class="form-control numSlots" min="1" max="100" value="1" placeholder="No. of Students">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-chalkboard-teacher"></i></span>
                            </div>
                            <select class="form-control courseInstructor" name="courseInstructor"></select>
                        </div>
                    </div>                    
                    <div id="recurrenceDiv">
                        <div class="form-group">
                            <label for="recurrence"><span class="fas fa-calendar"></span> Recurrence</label>
                            <div class="form-check ml-2">
                                <input class="form-check-input recurrence" type="radio" name="recurrence" value="" checked>
                                <label class="form-check-label">None</label>
                            </div>
                            <div class="form-check ml-2">
                                <input class="form-check-input recurrence" type="radio" name="recurrence" value="weekly">
                                <label class="form-check-label">Weekly</label>
                            </div>
                        </div>
                        <div class="form-group" hidden>
                            <label for="numRepetitions"><span class="fas fa-clock"></span> No. of Repetitions</label>
                            <input type="number" name="numRepetitions" class="form-control numRepetitions" min="1" max="5" value="1" disabled>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">&nbsp&nbsp&nbspAdd&nbsp&nbsp&nbsp&nbsp</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
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
                <h5 align="center" style="color:white;"><span class="fas fa-edit"></span> Edit Schedule</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color:white">&times;</span>
                </button>
            </div>
            <form id="editScheduleForm" method="POST">
                <div class="modal-body" style="padding:30px 30px;">
                    <input type="text" class="scheduleId" name="scheduleId" readonly hidden>
                    <div class="alert alert-danger error-msg" role="alert" style="display: none;"></div>
                    <div class="form-group row">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-book"></i></span>
                            </div>
                            <select class="form-control courseTitle" name="courseTitle"></select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-usd"></i></span>
                            </div>
                            <input type="number" name="coursePrice" class="form-control coursePrice" placeholder="Course Price">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-map-pin"></i></span>
                            </div>
                            <select class="form-control courseVenue" name="courseVenue"></select>
                        </div>
                    </div>
                    <div class="form-inline" style="margin-left: 8px;">
                        <div class="col-xs-4">
                            <label for="fromDate">Start Date <span class="fas fa-angle-double-left"></span></label>
                            <input type="text" class="form-control fromDate" name="fromDate" placeholder="From" required style="margin-left:13px;width:185px;" readonly>
                        </div>&nbsp&nbsp
                        <div class="col-xs-4">
                            <label for="toDate"><span class="fas fa-angle-double-right"></span> End Date</label>
                            <input type="text" class="form-control toDate" name="toDate" placeholder="To" required style="margin-left:22px;width:185px;" readonly>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="remainingSlots"><span class="fas fa-users"></span> Slots Remaining</label>
                                <input type="text" class="form-control remainingSlots" readonly>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="numSlots"><span class="fas fa-users"></span> New No. of Students</label>
                                <input type="number" name="numSlots" class="form-control numSlots" min="1" max="100" value="1">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-chalkboard-teacher"></i></span>
                            </div>
                            <select class="form-control courseInstructor" name="courseInstructor"></select>
                        </div>
                    </div>
                    <div id="recurrenceDiv">
                        <div class="form-group">
                            <label for="recurrence"><span class="fas fa-calendar"></span> Recurrence</label>
                            <div class="form-check ml-2">
                                <input class="form-check-input recurrence" type="radio" name="recurrence" value="none" checked>
                                <label class="form-check-label">None</label>
                            </div>
                            <div class="form-check ml-2">
                                <input class="form-check-input recurrence" type="radio" name="recurrence" value="weekly">
                                <label class="form-check-label">Weekly</label>
                            </div>
                        </div>
                        <div class="form-group" hidden>
                            <label for="numRepetitions"><span class="fas fa-clock"></span> No. of Days</label>
                            <input type="number" name="numRepetitions" class="form-control numRepetitions" min="2" max="5" value="2" disabled>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Update</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
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