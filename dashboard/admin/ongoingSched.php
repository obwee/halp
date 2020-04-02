<?php
require_once "template/header.php";
?>

<div class="container">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <p class="h4">Ongoing Trainings (Reminder)</p>
        </div>
        <div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
            <table id="tbl_ongoing" style="width:100%" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th style="white-space:nowrap;">Course Code</th>
                        <th style="white-space:nowrap;">Schedule</th>
                        <th style="white-space:nowrap;">No. of Students</th>
                        <th style="white-space:nowrap;">Instructor</th>
                        <th style="white-space:nowrap;">Venue</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>EH</td>
                        <td>March 21 - 22, 2020</td>
                        <td>12</td>
                        <td>Richard Reblando</td>
                        <td>Morayta</td>
                    </tr>
                    <tr>
                        <td>20410</td>
                        <td>March 21 - 23, 2020</td>
                        <td>6</td>
                        <td>Mark Sampayan</td>
                        <td>Makati</td>
                    </tr>
                </tbody>
            </table>
        </div>
</div>

<?php
require_once "template/scripts.php";
?>


<?php
require_once "template/footer.php";
?>