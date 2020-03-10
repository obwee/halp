<?php
require_once "template/header.php";
?>

<div class="container">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <p class="h2">Courses</p>

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
            <div class="modal-header" style="background-color: #A2C710;">
                <h5 align="center"><span class="glyphicon glyphicon-plane"></span>Add Course</h5>
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
            <div class="modal-header" style="background-color: #A2C710;">
                <h5 align="center"><span class="glyphicon glyphicon-plane"></span>Edit Course</h5>
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