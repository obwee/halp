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
            <button type="button" id="addNewQuoteRequest" data-toggle="modal" data-target="#addQuoteModal" class="btn btn-info btn-lg">Add a Request</button>
            <br><br>
        </div>
        <table id="tbl_quotations" style="width:100%" class="table table-striped table-bordered table-hover table-responsive-sm">
            <thead>
                <tr>
                    <th style="white-space:nowrap;">Student Name</th>
                    <th style="white-space:nowrap;">Email Address</th>
                    <th style="white-space:nowrap;">Contact No.</th>
                    <th style="white-space:nowrap;">Company Name</th>
                    <th style="white-space:nowrap;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Aries Valenzuela Macandili</td>
                    <td>macandili.aries@gmail.com</td>
                    <td>09161111111</td>
                    <td>Simplex Internet Ph</td>
                    <td style="text-align: center;">
                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#viewRequestModal"><i class="fa fa-eye"></i></button>
                    </td>
                </tr>
                <tr>
                    <td>Aubrey Albano Arbiol</td>
                    <td>angelikaaubreyarbiol@gmail.com</td>
                    <td>09162222222</td>
                    <td>djkkjjkdgkja</td>
                    <td style="text-align: center;">
                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#viewRequestModal"><i class="fa fa-eye"></i></button>
                    </td>
                </tr>
            </tbody>

        </table>
    </div>
</div>

<!--Get Quote Modal-->
<div class="modal fade" id="addQuoteModal" role="dialog">
    <div class="modal-dialog addQuoteModal">
        <div class="modal-content">
            <div class="modal-header">
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
                        <input type="text" class="form-control" id="quoteFname" name="quoteFname" placeholder="First Name" autofocus maxlength="30">
                    </div>
                    <div class="form-group">
                        <label for="quoteMname"><span class="fas fa-user-circle"></span> Middle Name</label>
                        <input type="text" class="form-control" id="quoteMname" name="quoteMname" placeholder="Middle Name" autofocus maxlength="30">
                    </div>
                    <div class="form-group">
                        <label for="quoteLname"><span class="fas fa-user-circle"></span> Last Name</label>
                        <input type="text" class="form-control" id="quoteLname" name="quoteLname" placeholder="Last Name" autofocus maxlength="30">
                    </div>
                    <div class="form-group">
                        <label for="quoteContactNum"><span class="fas fa-user-circle"></span> Contact Number</label>
                        <input type="text" class="form-control" id="quoteContactNum" name="quoteContactNum" placeholder="Contact Number" autofocus maxlength="13">
                    </div>
                    <div class="form-group">
                        <label for="quoteEmail"><span class="fas fa-envelope"></span> E-mail Address</label>
                        <input type="email" class="form-control" id="quoteEmail" name="quoteEmail" placeholder="E-mail Address" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label for="quoteCompanyName"><span class="far fa-building"></span> Company Name</label>
                        <input type="text" class="form-control" id="quoteCompanyName" name="quoteCompanyName" placeholder="Company Name" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label for="billToCompany"><input type="checkbox" name="billToCompany"> Bill to Company?</labe>
                    </div>
                    <div class="form-group">
                        <label for="quoteCourse"><span class="fas fa-book"></span> Course</label>
                        <select class="form-control">

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="scheduleType"><span class="fas fa-calendar-week"></span> Schedule Type</label>
                        <select class="form-control">

                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Add</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="viewRequestModal" role="dialog">
    <div class="modal-dialog modal-xl viewRequestModal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 align="center"></span>Quotation Request Details</h5>
            </div>
            <div class="modal-body">

                <div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
                    <div align="right">
                        <button type="button" id="insertNewQuoteRequest" data-toggle="modal" data-target="#insertNewRequestModal" class="btn btn-info">Insert Request</button>
                    </div>
                    <br><br>
                    <table id="tbl_quotationDetails" style="width:100%" class="table table-striped table-bordered table-hover table-responsive-sm">
                        <thead>
                            <tr>
                                <th style="white-space:nowrap;">Course Code</th>
                                <th style="white-space:nowrap;">Course Title</th>
                                <th style="white-space:nowrap;">Start Date</th>
                                <th style="white-space:nowrap;">End Date</th>
                                <th style="white-space:nowrap;">Bill to Company</th>
                                <th style="white-space:nowrap;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="text-align: center;">CCNAv4</td>
                                <td style="text-align: center;">Cisco Certified Associate Version 4</td>
                                <td style="text-align: center;">Mar 1, 2020</td>
                                <td style="text-align: center;">Mar 5, 2020</td>
                                <td style="text-align: center;">Yes</td>
                                <td>
                                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#editRequestModal"><i class="fa fa-pen"></i></button>
                                    <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#sendRequestModal">Send</button>
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

            <div class="modal-body">
                <div class="form-group">
                    <label for="course"><span class="fas fa-book"></span> Course</label>
                    <select class="form-control">

                    </select>
                </div>
                <div class="form-group">
                    <label for="schedule"><span class="fas fa-calendar-week"></span> Schedule</label>
                    <select class="form-control">

                    </select>
                </div>
                <div class="form-group">
                    <label for="billToCompany"><input type="checkbox" name="billToCompany"> Bill to Company?</labe>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success">Add</button>
                <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editRequestModal" role="dialog">
    <div class="modal-dialog editRequestModal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 align="center">Edit Request Details</h5>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label for="course"><span class="fas fa-book"></span> Course</label>
                    <select class="form-control">

                    </select>
                </div>
                <div class="form-group">
                    <label for="schedule"><span class="fas fa-calendar-week"></span> Schedule</label>
                    <select class="form-control">

                    </select>
                </div>
                <div class="form-group">
                    <label for="billToCompany"><input type="checkbox" name="billToCompany"> Bill to Company?</labe>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Update</button>
                <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
            </div>
        </div>
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
                    <input type="text" class="form-control" id="subjectQuote" name="subjectQuote" placeholder="Subject" autofocus maxlength="30">
                </div>
                <div class="form-group">
                    <label for=quoteMessage><span class="fas fa-envelope-open-text"></span> Message</label>
                    <textarea class="form-control" id="emailMsg" name="emailMsg" rows="7" placeholder="Type your message here."></textarea>
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

<script src="js/dashboard.quotationRequest.js"></script>

<?php
require_once "template/footer.php";
?>