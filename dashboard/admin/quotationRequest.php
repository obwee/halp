<?php
require_once "template/header.php";
?>

<style type="text/css">
    td {
        height: 50px;
    }

    th {
        text-align: center;
    }
</style>

<div class="container">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <p class="h2">Quotation Requests</p>

    </div>

    <div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
        <div align="right">
            <button type="button" id="addNewQuoteRequest" data-toggle="modal" data-target="#getQuoteModal" class="btn btn-info btn-lg">Add a Request</button>
            <br><br>
        </div>
        <table id="quotationSenders" style="width:100%" class="table table-striped table-bordered table-hover table-responsive-sm">
            <thead></thead>
            <tbody></tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="getQuoteModal" role="dialog">
    <div class="modal-dialog getQuoteModal">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #A2C710;">
                <h5 align="center"><span class="glyphicon glyphicon-plane"></span>Add New Quotation Request</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="quotationForm">
                    <div class="alert alert-danger error-msg" role="alert" style="display: none;"></div>
                    <div class="form-group">
                        <label for="quoteFname"><span class="fas fa-user-circle"></span> First Name</label>
                        <input type="text" class="form-control quoteFname" name="quoteFname" placeholder="First Name" autofocus maxlength="30">
                    </div>
                    <div class="form-group">
                        <label for="quoteMname"><span class="fas fa-user-circle"></span> Middle Name</label>
                        <input type="text" class="form-control quoteMname" name="quoteMname" placeholder="Middle Name" autofocus maxlength="30">
                    </div>
                    <div class="form-group">
                        <label for="quoteLname"><span class="fas fa-user-circle"></span> Last Name</label>
                        <input type="text" class="form-control quoteLname" name="quoteLname" placeholder="Last Name" autofocus maxlength="30">
                    </div>
                    <div class="form-group">
                        <label for="quoteContactNum"><span class="fas fa-phone"></span> Contact Number</label>
                        <input type="text" class="form-control quoteContactNum" name="quoteContactNum" placeholder="Contact Number" autofocus maxlength="12">
                    </div>
                    <div class="form-group">
                        <label for="quoteEmail"><span class="fas fa-envelope"></span> E-mail Address</label>
                        <input type="email" class="form-control quoteEmail" name="quoteEmail" placeholder="E-mail Address" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label for="quoteCompanyName"><span class="far fa-building"></span> Company Name</label>
                        <div class="input-group">
                            <input type="text" class="form-control quoteCompanyName" placeholder="Company Name" name="quoteCompanyName" maxlength="50">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <input type="checkbox" name="quoteBillToCompany" class="quoteBillToCompany">&nbsp;Bill to Company?
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="courseAndScheduleDiv" style="display: none;">
                        <div class="form-group">
                            <label for="quoteCourse"><span class="fas fa-book"></span> Course</label>
                            <select class="form-control quoteCourse" name="quoteCourse[]"></select>
                        </div>
                        <div class="form-group">
                            <label for="quoteSchedule"><span class="fas fa-calendar-week"></span> Schedule</label>
                            <select class="form-control quoteSchedule" name="quoteSchedule[]" disabled>
                                <option value="" selected disabled hidden>Select Course First</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="numPax"><span class="fas fa-user-friends"></span> PAX</label>
                            <input type="number" class="form-control numPax" placeholder="Number of Persons" name="numPax[]" min="1" max="100" value="1">
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12 text-center" style="display: none;">
                                <button type="button" class="btn btn-warning deleteCourseBtn">&nbsp;&nbsp;&nbsp;Delete Course&nbsp;&nbsp;&nbsp;</button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12 text-center">
                            <button type="button" class="btn btn-primary addCourseBtn">Add New Course</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <p class="h6">To see available course and schedule, <a href="courses.php" target="_blank">Click here</a></p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="viewRequestModal" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl viewRequestModal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 align="center"></span>Quotation Requests</h5>
            </div>
            <div class="modal-body">

                <div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
                    <div align="right">
                        <button type="button" id="insertNewQuoteRequest" data-toggle="modal" data-target="#insertNewRequestModal" class="btn btn-info">Insert Request</button>
                    </div>
                    <br><br>
                    <table id="quotationRequests" style="width:100%" class="table table-striped table-bordered table-hover table-responsive-sm">
                        <thead></thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="viewDetailsModal" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-xl viewDetailsModal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 align="center"></span>Quotation Details</h5>
            </div>
            <div class="modal-body">
                <div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
                    <br><br>
                    <table id="quotationDetails" style="width:100%" class="table table-striped table-bordered table-hover table-responsive-sm">
                        <thead></thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="insertNewRequestModal" role="dialog">
    <div class="modal-dialog insertNewRequestModal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 align="center">Insert New Request</h5>
            </div>
            <form action="post" id="insertNewRequestForm">
                <div class="modal-body">
                    <div class="alert alert-danger error-msg" role="alert" style="display: none;"></div>
                    <div class="form-group" hidden>
                        <label for="quoteFname"><span class="fas fa-user-circle"></span> First Name</label>
                        <input type="text" class="form-control quoteFname" name="quoteFname" placeholder="First Name" autofocus maxlength="30">
                    </div>
                    <div class="form-group" hidden>
                        <label for="quoteMname"><span class="fas fa-user-circle"></span> Middle Name</label>
                        <input type="text" class="form-control quoteMname" name="quoteMname" placeholder="Middle Name" autofocus maxlength="30">
                    </div>
                    <div class="form-group" hidden>
                        <label for="quoteLname"><span class="fas fa-user-circle"></span> Last Name</label>
                        <input type="text" class="form-control quoteLname" name="quoteLname" placeholder="Last Name" autofocus maxlength="30">
                    </div>
                    <div class="form-group" hidden>
                        <label for="quoteContactNum"><span class="fas fa-phone"></span> Contact Number</label>
                        <input type="text" class="form-control quoteContactNum" name="quoteContactNum" placeholder="Contact Number" autofocus maxlength="12">
                    </div>
                    <div class="form-group" hidden>
                        <label for="quoteEmail"><span class="fas fa-envelope"></span> E-mail Address</label>
                        <input type="email" class="form-control quoteEmail" name="quoteEmail" placeholder="E-mail Address" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label for="quoteCompanyName"><span class="far fa-building"></span> Company Name</label>
                        <div class="input-group">
                            <input type="text" class="form-control quoteCompanyName" placeholder="Company Name" name="quoteCompanyName" maxlength="50">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <input type="checkbox" name="quoteBillToCompany" class="quoteBillToCompany">&nbsp;Bill to Company?
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="courseAndScheduleDiv-new" style="display: none;">
                        <div class="form-group">
                            <label for="quoteCourse"><span class="fas fa-book"></span> Course</label>
                            <select class="form-control quoteCourse" name="quoteCourse[]"></select>
                        </div>
                        <div class="form-group">
                            <label for="quoteSchedule"><span class="fas fa-calendar-week"></span> Schedule</label>
                            <select class="form-control quoteSchedule" name="quoteSchedule[]" disabled>
                                <option value="" selected disabled hidden>Select Course First</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="numPax"><span class="fas fa-user-friends"></span> PAX</label>
                            <input type="number" class="form-control numPax" placeholder="Number of Persons" name="numPax[]" min="1" max="100" value="1">
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12 text-center" style="display: none;">
                                <button type="button" class="btn btn-warning deleteCourseBtn">&nbsp;&nbsp;&nbsp;Delete Course&nbsp;&nbsp;&nbsp;</button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12 text-center">
                            <button type="button" class="btn btn-primary addCourseBtn">Add New Course</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <p class="h6">To see available course and schedule, <a href="courses.php" target="_blank">Click here</a></p>
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

<div class="modal fade" id="editRequestModal" role="dialog">
    <div class="modal-dialog editRequestModal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 align="center">Edit Request Details</h5>
            </div>
            <form action="post" id="editRequestForm">
                <div class="modal-body">
                    <div class="alert alert-danger error-msg" role="alert" style="display: none;"></div>
                    <div class="form-group">
                        <label for="quoteCompanyName"><span class="far fa-building"></span> Company Name</label>
                        <div class="input-group">
                            <input type="text" class="form-control quoteCompanyName" placeholder="Company Name" name="quoteCompanyName" maxlength="50">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <input type="checkbox" name="quoteBillToCompany" class="quoteBillToCompany">&nbsp;Bill to Company?
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="template">
                        <div class="courseAndScheduleDiv-edit" style="display: none;">
                            <div class="form-group">
                                <label for="quoteCourse"><span class="fas fa-book"></span> Course</label>
                                <select class="form-control quoteCourse" name="quoteCourse[]"></select>
                            </div>
                            <div class="form-group">
                                <label for="quoteSchedule"><span class="fas fa-calendar-week"></span> Schedule</label>
                                <select class="form-control quoteSchedule" name="quoteSchedule[]">
                                    <option value="" selected disabled hidden>Select Course First</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="numPax"><span class="fas fa-user-friends"></span> PAX</label>
                                <input type="number" class="form-control numPax" placeholder="Number of Persons" name="numPax[]" min="1" max="100" value="1">
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12 text-center" style="display: none;">
                                    <button type="button" class="btn btn-warning deleteCourseBtn">&nbsp;&nbsp;&nbsp;Delete Course&nbsp;&nbsp;&nbsp;</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12 text-center">
                            <button type="button" class="btn btn-primary addCourseBtn">Add New Course</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <p class="h6">To see available course and schedule, <a href="courses.php" target="_blank">Click here</a></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Update</button>
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="sendRequestModal" role="dialog">
        <div class="modal-dialog modal-lg sendRequestModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 align="center"><span class="glyphicon glyphicon-plane"></span>Send Quotation Request</h5>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="subjectQuote"><span class="fas fa-envelope"></span> Subject</label>
                        <input type="text" class="form-control subjectQuote" name="subjectQuote" placeholder="Subject" autofocus maxlength="30">
                    </div>
                    <div class="form-group">
                        <label for=quoteMessage><span class="fas fa-envelope-open-text"></span> Message</label>
                        <textarea class="form-control emailMsg" name="emailMsg" rows="7" placeholder="Type your message here."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success">Send Quote</button>
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <?php
    require_once "template/scripts.php";
    ?>

    <script src="../utils/js/utils.Libraries.js"></script>
    <script src="../utils/js/utils.Validations.js"></script>
    <script src="../utils/js/utils.Forms.js"></script>

    <script src="admin/js/dashboard.quotationRequest.js"></script>

    <?php
    require_once "template/footer.php";
    ?>