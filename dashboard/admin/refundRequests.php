<?php
require_once "template/header.php";
?>

<div class="container request">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h4><span class="fas fa-user-times"></span> Refund Requests</h4>
    </div>
</div>

<div class="container approved">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h4><span class="fas fa-user-times"></span> Approved Refunds</h4>
    </div>
</div>

<?php
require_once "template/scripts.php";
?>

<script src="/Nexus/utils/js/utils.Libraries.js"></script>
<script src="/Nexus/utils/js/utils.Validations.js"></script>
<script src="/Nexus/utils/js/utils.Forms.js"></script>

<script src="/Nexus/dashboard/js/admin/dashboard.refundRequests.js"></script>

<?php
require_once "template/footer.php";
?>