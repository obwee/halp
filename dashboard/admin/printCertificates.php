<?php
require_once "template/header.php";
require_once "template/scripts.php";
?>

<script src="/Nexus/utils/js/utils.Libraries.js"></script>

<script>
    var oPrintCerts = (() => {
        function init() {
            checkParameterPassed();
        }

        function checkParameterPassed() {
            const oSearchParams = new URLSearchParams(window.location.search);
            if (oSearchParams.has('iScheduleId') === true && /^[\d]+$/g.test(oSearchParams.get('iScheduleId')) === true) {
                return fireSwal(oSearchParams.get('iScheduleId'));
            }
            oLibraries.displayAlertMessage('error', 'Invalid approach.', () => close());
        }

        function fireSwal(iScheduleId) {
            Swal.fire({
                title: 'Sending certificates...',
                icon: 'info',
                showConfirmButton: 'false',
                showLoaderOnConfirm: 'true',
                onOpen: () => {
                    Swal.clickConfirm();
                },
                preConfirm: () => {
                    return sendCertificates(iScheduleId);
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((oResponse) => {
                oLibraries.displayAlertMessage((oResponse.value.bResult === true) ? 'success' : 'error', oResponse.value.sMsg, () => close());
            });
        }

        function sendCertificates(iScheduleId) {
            return axios.post(`/Nexus/utils/ajax.php?class=Reports&action=sendCertificates`, {
                    iScheduleId
                })
                .then(function(oResponse) {
                    return oResponse.data;
                })
                .catch(function(oError) {
                    return oError;
                });
        }

        return {
            initialize: init
        }
    })();

    $(() => {
        oPrintCerts.initialize();
    });
</script>

<?php
require_once "template/footer.php";
?>