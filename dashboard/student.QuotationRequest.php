<?php
require_once "template/studentHeader.php";
?>


<div class="container">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <p class="h2">Quotations</p>

    </div>

    <div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
        <div align="right">
            <button type="button" id="addNewQuoteRequest" data-toggle="modal" data-target="#addQuoteModal" class="btn btn-info btn-lg">Add a Request</button>
            <br><br>
        </div>
        <table id="tbl_quotations" style="width:100%" class="table table-striped table-bordered table-hover table-responsive-sm">
            <thead>
                <tr>
                    <th style="white-space:nowrap;">Date Requested</th>
                    <th style="white-space:nowrap;">Course</th>
                    <th style="white-space:nowrap;">PAX</th>
                    <th style="white-space:nowrap;">Start Date</th>
                    <th style="white-space:nowrap;">End Date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Mar 01, 2020</td>
                    <td>20410D</td>
                    <td>1</td>
                    <td>Mar 05, 2020</td>
                    <td>Mar 08, 2020</td>
                </tr>
            </tbody>

        </table>
    </div>
</div>

<div class="modal fade" id="addQuoteModal" role="dialog">
    <div class="modal-dialog addQuoteModal">
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
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <button type="button" class="btn btn-primary addCourseBtn">Add New Course</button>
                            </div>
                            <div class="col-sm-6 text-left" style="display: none;">
                                <button type="button" class="btn btn-warning deleteCourseBtn">&nbsp;&nbsp;&nbsp;Delete Course&nbsp;&nbsp;&nbsp;</button>
                            </div>
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


<?php
require_once "template/scripts.php";
?>

<script src="js/studentDash.QuotationRequests.js"></script>

<?php
require_once "template/studentFooter.php";
?>