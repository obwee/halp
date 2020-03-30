<?php
require_once "template/header.php";
?>

<div class="container">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2><span class="fas fa-book"></span> Courses</h2>
    </div>

    <div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
        <div align="right">
            <button type="button" id="addNewCourse" data-toggle="modal" data-target="#addCourseModal" class="btn btn-info btn-lg">Add New Course</button>
            <br><br>
        </div>
        <table id="tbl_courses" style="width:100%" class="table table-striped table-bordered table-hover table-responsive-sm">
            <thead></thead>
            <tbody></tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="addCourseModal" role="dialog">
    <div class="modal-dialog vertical-align-center addCourseModal">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #3c8dbc;">
                <h5 align="center" style="color:white;"><i class="fas fa-book-open"></i> Add Course</h5>
            </div>
            <form id="addCourseForm">
                <div class="modal-body">
                    <div class="alert alert-danger error-msg" role="alert" style="display: none;"></div>
                    <div class="form-group">
                        <label for="courseCode"><span class="fas fa-list-ul"></span> Course Code</label>
                        <input type="text" class="form-control courseCode" name="courseCode" placeholder="Course Code" autofocus>
                    </div>
                    <div class="form-group">
                        <label for="courseTitle"><span class="fas fa-book"></span> Course Title</label>
                        <input type="text" class="form-control courseTitle" name="courseTitle" placeholder="Course Title" autofocus>
                    </div>
                    <div class="form-group">
                        <label for="courseDetails"><span class="fas fa-book-open"></span> Course Details</label>
                        <input type="text" class="form-control courseDetails" name="courseDetails" placeholder="Course Details" autofocus>
                    </div>
                    <div class="form-group">
                        <label for="courseAmount"><span class="fas fa-money"></span> Amount</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">₱</span>
                            </div>
                            <input type="text" class="form-control courseAmount" name="courseAmount" placeholder="Course Amount">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Add</button>
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editCourseModal" role="dialog">
    <div class="modal-dialog vertical-align-center editCourseModal">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #3c8dbc;">
                <h5 align="center" style="color:white;"><span class="fas fa-edit"></span> Edit Course</h5>
            </div>
            <form id="editCourseForm">
                <div class="modal-body">
                    <div class="alert alert-danger error-msg" role="alert" style="display: none;"></div>
                    <input type="text" class="courseId" name="courseId" hidden>
                    <div class="form-group">
                        <label for="courseCode"><span class="fas fa-list-ul"></span> Course Code</label>
                        <input type="text" class="form-control courseCode" name="courseCode" placeholder="Course Code" autofocus>
                    </div>
                    <div class="form-group">
                        <label for="courseTitle"><span class="fas fa-book"></span> Course Title</label>
                        <input type="text" class="form-control courseTitle" name="courseTitle" placeholder="Course Title" autofocus>
                    </div>
                    <div class="form-group">
                        <label for="courseDetails"><span class="fas fa-book-open"></span> Course Details</label>
                        <input type="text" class="form-control courseDetails" name="courseDetails" placeholder="Course Details" autofocus>
                    </div>
                    <div class="form-group">
                        <label for="courseAmount"><span class="fas fa-money"></span> Amount</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">₱</span>
                            </div>
                            <input type="text" class="form-control courseAmount" name="courseAmount" placeholder="Course Amount">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Update</button>
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="changeCourseModal" role="dialog">
    <div class="modal-dialog modal-lg changeCourseModal">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #3c8dbc;">
                <h5 align="center" style="color:white;"><i class="fas fa-edit"></i> Update Course</h5>
            </div>
            <form id="changeCourseForm" method="post">
                <div class="modal-body">
                    <input type="text" class="courseId" name="courseId" readonly hidden>
                    <div class="row">
                        <div class="col-sm-2">
                            <label for="courseName" class="col-form-label"><i class="fas fa-chalkboard-teacher"></i> Course</label>
                        </div>
                        <div class="col-sm-10">
                            <input type="text" class="form-control courseName" readonly>
                        </div>
                        <div class="col-12 alert alert-danger error-msg" role="alert" style="display: none;"></div>
                    </div>
                    <div class="box mt-4" style="border:5px solid #3c8dbc;margin:5px 5px;padding:7px 7px ;overflow-y: scroll;height:250px;overflow-x: hidden;">
                        <div class="template" hidden>
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="courseSchedule" style="padding-left: 10px;"><i class="fas fa-calendar"></i> Schedule: <span></span></p>
                                    <p class="courseInstructor" style="padding-left: 10px;"><i class="fas fa-user"></i> Instructor: <span></span></p>
                                    <p class="courseVenue" style="padding-left: 10px;"><i class="fas fa-map-marked-alt"></i> Venue: <span></span></p>
                                </div>
                                <div class="col-sm-6 d-flex align-items-center">
                                    <select class="form-control courses" name="">
                                        <option selected hidden disabled>Select New Course</option>
                                    </select>
                                </div>
                            </div>
                            <hr class="mt-0">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Update</button>
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
require_once "template/scripts.php";
?>

<script src="/Nexus/utils/js/utils.Libraries.js"></script>
<script src="/Nexus/utils/js/utils.Validations.js"></script>
<script src="/Nexus/utils/js/utils.Forms.js"></script>

<script src="/Nexus/dashboard/js/admin/dashboard.courses.js"></script>

<?php
require_once "template/footer.php";
?>