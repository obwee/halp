<?php
require_once "Template/header.php";
?>

<div class="container">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <p class="h2">Schedules</p>

    </div>

    <div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
        <div align="right">
            <button type="button" id="addNewCourse" data-toggle="modal" data-target="#addScheduleModal" class="btn btn-info btn-lg">Add New Schedule</button>
            <br><br>
        </div>
        <table id="tbl_courses" style="width:100%" class="table table-striped table-bordered table-hover table-responsive-sm">
            <thead>
                <tr>
                    <th style="white-space:nowrap;">Official Course Title</th>
                    <th style="white-space:nowrap;">Official Course Title</th>
                    <th style="white-space:nowrap;">Start</th>
                    <th style="white-space:nowrap;">End</th>
                    <th style="white-space:nowrap;">Venue</th>
                    <th style="white-space:nowrap;">No. of Students</th>
                    <th style="white-space:nowrap;">Instructor</th>
                    <th style="white-space:nowrap;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>CCNAv4</td>
                    <td>Cisco Certified Network Associate V4: Implementing and Administering Cisco Solutions</td>
                    <td>Mar 5, 2020</td>
                    <td>Mar 10, 2020</td>
                    <td>Manila</td>
                    <td>15</td>
                    <td>Christopher Buenaventura</td>
                    <td>
                        <button type="button" id="editSchedule" data-toggle="modal" data-target="#editScheduleModal" class="btn btn-info btn-sm"><i class="fas fa-pen"></i></button>
                        <button type="submit" id="deleteSchedule" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="addScheduleModal" role="dialog">
    <div class="modal-dialog addScheduleModal">
        <div class="modal-content" >
            <div class="modal-header" style="background-color: #A2C710;">
                <h5 align="center"><span class="fas fa-calendar"></span> Add New Schedule</h5>
            </div>

            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="courseTitle"><span class="fas fa-book"></span> Select Course</label>
                        <select class="form-control">

                        </select>
                    </div>
                    <div class="form-inline" style="margin-left: 15px;">
                        <div class="col-xs-4">
                            <label for="date1"><span class="fas fa-angle-double-left"></span>Start Date</label>
                            <input type="date" class="form-control" id="date1" name="date1" placeholder="From" required style="margin-left:16px;width:185px;" max="2999-12-31">
                        </div>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                        <div class="col-xs-4">
                            <label for="date2"><span class="fas fa-angle-double-right"></span>End Date</label>
                            <input type="date" class="form-control" id="date2" name="date2" placeholder="To" required style="margin-left:16px;width:185px;" max="2999-12-31">
                        </div>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="courseVenue"><span class="fas fa-map"></span> Select Venue</label>
                        <select class="form-control">
                            <option>Makati</option>
                            <option>Manila</option>
                        </select>
                    </div>
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
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Add</button>
                <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
            </div>
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
                        <select class="form-control">

                        </select>
                    </div>
                    <div class="form-inline" style="margin-left: 15px;">
                        <div class="col-xs-4">
                            <label for="date1"><span class="fas fa-angle-double-left"></span>Start Date</label>
                            <input type="date" class="form-control" id="date1" name="date1" placeholder="From" required style="margin-left:16px;width:185px;" max="2999-12-31">
                        </div>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                        <div class="col-xs-4">
                            <label for="date2"><span class="fas fa-angle-double-right"></span>End Date</label>
                            <input type="date" class="form-control" id="date2" name="date2" placeholder="To" required style="margin-left:16px;width:185px;" max="2999-12-31">
                        </div>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="courseVenue"><span class="fas fa-map"></span> Select Venue</label>
                        <select class="form-control">
                            <option>Makati</option>
                            <option>Manila</option>
                        </select>
                    </div>
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

    <?php
    require_once "template/scripts.php";
    ?>

    <script src="admin/js/dashboard.schedule.js"></script>

    <?php
    require_once "template/footer.php";
    ?>