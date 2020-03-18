<?php
require_once "Template/header.php";
?>

<div class="container">
    <div class="container" id='calendar'></div>
</div>

<div class="modal fade" id="addScheduleModal" tabindex="-1" role="dialog" aria-labelledby="addScheduleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #A2C710;">
                <h5 class="modal-title" id="addScheduleModalLabel">New Schedule</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addScheduleForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="eventName" class="col-form-label">Course Name:</label>
                        <input type="text" class="form-control" name="eventName" id="eventName">
                    </div>
                    <div class="form-group row">
                        <div class="col-6">
                            <label for="fromDate" class="col-form-label">From:</label>
                            <input type="text" class="form-control" name="fromDate" id="fromDate" readonly>
                        </div>
                        <div class="col-6">
                            <label for="toDate" class="col-form-label">To:</label>
                            <input type="text" class="form-control" name="toDate" id="toDate" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Instructor:</label>
                        <input type="text" class="form-control" name="instructorName" id="instructorName"></input>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="addScheduleBtn">Add Schedule</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editScheduleModal" role="dialog">
    <div class="modal-dialog editScheduleModal">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #A2C710;">
                <h5 align="center"><span class="fas fa-calendar"></span> Edit Schedule</h5>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="courseTitle"><span class="fas fa-book"></span> Select Course</label>
                        <select class="form-control"></select>
                    </div>
                    <div class="form-group">
                        <label for="courseVenue"><span class="fas fa-map"></span> Select Venue</label>
                        <select class="form-control">
                            <option>Makati</option>
                            <option>Manila</option>
                        </select>
                    </div>
                    <div class="form-inline" style="margin-left: 15px;">
                        <div class="col-xs-4">
                            <label for="date1"><span class="fas fa-angle-double-left"></span>Start Date</label>
                            <input type="text" class="form-control" id="fromDate" name="fromDate" placeholder="From" required style="margin-left:16px;width:185px;" readonly>
                        </div>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                        <div class="col-xs-4">
                            <label for="date2"><span class="fas fa-angle-double-right"></span>End Date</label>
                            <input type="text" class="form-control" id="toDate" name="toDate" placeholder="To" required style="margin-left:16px;width:185px;" readonly>
                        </div>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="courseVenue"><span class="fas fa-users"></span> No. of Students</label>
                        <input type="text" name="noOfStudents" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="courseInstructor"><span class="fas fa-chalkboard-teacher"></span> Instructor</label>
                        <select class="form-control">
                            <option>Christopher Buenaventura</option>
                            <option>Richard Reblando</option>
                            <option>Judith Salvidar</option>
                            <option>Mark Sampayan</option>
                        </select>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Update</button>
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                </div>
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