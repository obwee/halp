<?php
require_once "template/studentHeader.php";
?>

<div class="container">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <p class="h2">Frequently Asked Questions</p>
</div>

<div class="col-sm-6">
    <div class="accordion" id="accordionHelp">
        <div class="card">
            <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    How do I request for a quotation?
                    </button>
                </h2>
            </div>

            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionHelp">
                <div class="card-body">
                    <ol>
                        <li>Select QUOTATION REQUESTS under QUOTATIONS tab.</li>
                        <li>Click the Add a Request button.</li>
                        <li>Fill in all required details.</li>
                    </ol>
                    <p>Quotations will be sent to your email within the day.</p>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingTwo">
                <h2 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    How do I enroll?
                    </button>
                </h2>
            </div>
        
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionHelp">
                <div class="card-body">
                    <ol>
                      <li>Select ENROLLMENT under the REGISTRATION tab.</li>
                      <li>Select your desired course and schedule, click submit.</li>
                      <li>Enrolled courses can be seen on the bottom part of the page.</li>
                      <li>Upload a photo of your proof of payment thru the <button class="btn btn-sm btn-primary fas fa-hand-holding-usd"></button> Payment button in the Action column.</li>
                      <li>Once the payment has been approved, an approval will be sent to your email.</li>
                      <li>You can print your Registration Form by clicking the <button class="btn btn-sm btn-success fas fa-print"></button> Print button in the Action column. </li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingThree">
                <h2 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Where can I view my transactions?
                    </button>
                </h2>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionHelp">
            <div class="card-body">
                <ol>
                    <li>Uploaded proof of payment can be seen through the Payment page under the REGISTRATION tab.</li>
                    <li>Click the <button class="btn btn-sm btn-dark fas fa-eye"></button> View button to see the uploaded image.</li>
                </ol>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingFour">
                <h2 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    What are the payment modes?
                    </button>
                </h2>
            </div>
            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionHelp">
            <div class="card-body">
                <ul>
                    We accept:
                    <li><b>Cash</b></li>
                    <li><b>BDO Bank Deposit / BDO Online Bank Transfer</b></li>
                    BDO Account Details:
                    Account Name: Nexus IT Training Center
                    BDO Account Number: 002810078994
                    <li><b>Cheque</b></li>
                    All cheques must be payable to Nexus IT Training Center. <br>
                    Please give us at least three (3) days to process cheque payments.
                </ul>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingFive">
                <h2 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                    Do you accept installments?
                    </button>
                </h2>
            </div>
            <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionHelp">
            <div class="card-body">
                <ul>
                    <li>YES. We accept 50% downpayment as reservation.</li>
                    <li>Balance must be paid on or before the first day of training.</li>
                </ul>
            </div>
        </div>
      </div>
    </div>   
</div>


   
<?php
require_once "template/scripts.php";
?>


<?php
require_once "template/studentFooter.php";
?>