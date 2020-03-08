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
            <thead>
                <tr>
                    <th style="white-space:nowrap;">Course Code</th>
                    <th style="white-space:nowrap;">Official Course Title</th>
                    <th style="white-space:nowrap;">Details</th>
                    <th style="white-space:nowrap;">Amount</th>
                    <th style="white-space:nowrap;">Actions</th>
                </tr>
            <tbody>
                <tr>
                    <td>CCNAv4</td>
                    <td>Cisco Certified Network Associate v4</td>
                    <td>Implementing and Administering Cisco Solutions</td>
                    <td>12,500</td>
                    <td>
                        <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#editCourseModal"><i class="fas fa-pen"></i></button>
                        <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                    </td>
                </tr>
        </table>
    </div>
</div>

    <div class="modal fade" id="addCourseModal" role="dialog">
        <div class="modal-dialog vertical-align-center addCourseModal">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #A2C710;">
                    <h5 align="center"><span class="glyphicon glyphicon-plane"></span>Add Course</h5>
                </div>
                
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="courseCode"><span class="fas fa-list-ul"></span> Course Code</label>
                            <input type="text" class="form-control" id="courseCode" name="courseCode" placeholder="Course Code" autofocus maxlength="15">
                        </div>
                        <div class="form-group">
                            <label for="courseTitle"><span class="fas fa-book"></span> Course Title</label>
                            <input type="text" class="form-control" id="courseTitle" name="courseCode" placeholder="Course Title" autofocus maxlength="50">
                        </div>
                        <div class="form-group">
                            <label for="courseDetails"><span class="fas fa-book-open"></span> Course Details</label>
                            <input type="text" class="form-control" id="courseCode" name="courseCode" placeholder="Course Details" autofocus maxlength="50">
                        </div>
                        <div class="form-group">
                            <label for="courseDetails"><span class="fas fa-money"></span> Amount</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">₱</span>
                                </div>
                                <input type="text" class="form-control">
                            </div>
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
</div>


    <div class="modal fade" id="editCourseModal" role="dialog">
        <div class="modal-dialog vertical-align-center editCourseModal">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #A2C710;">
                    <h5 align="center"><span class="glyphicon glyphicon-plane"></span>Edit Course</h5>
                </div>
                
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="courseCode"><span class="fas fa-list-ul"></span> Course Code</label>
                            <input type="text" class="form-control" id="courseCode" name="courseCode" placeholder="Course Code" autofocus maxlength="15">
                        </div>
                        <div class="form-group">
                            <label for="courseTitle"><span class="fas fa-book"></span> Course Title</label>
                            <input type="text" class="form-control" id="courseTitle" name="courseCode" placeholder="Course Title" autofocus maxlength="50">
                        </div>
                        <div class="form-group">
                            <label for="courseDetails"><span class="fas fa-book-open"></span> Course Details</label>
                            <input type="text" class="form-control" id="courseCode" name="courseCode" placeholder="Course Details" autofocus maxlength="50">
                        </div>
                        <div class="form-group">
                            <label for="courseDetails"><span class="fas fa-money"></span> Amount</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">₱</span>
                                </div>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Update</button>
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once "template/scripts.php";
?>

<script src="/Nexus/dashboard/admin/js/dashboard.editCourse.js"></script>

<?php
require_once "template/footer.php";
?>