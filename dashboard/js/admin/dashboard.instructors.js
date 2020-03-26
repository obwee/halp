/**
 * oInstructor
 * Revealing module for instructor-related functionalities.
 */
var oInstructor = (() => {

    /**
     * @var {object} oTblInstructor
     * The table.
     */
    let oTblInstructor = $('#tbl_instructors');

    /**
     * @var {object} oChangeInstructorModal
     * The modal for changing instructors.
     */
    let oChangeInstructorModal = $('#changeInstructorModal');

    /**
     * @var {object} oTemplate
     * Template holder for cloning elements.
     */
    let oTemplate = {};

    /**
     * @var {array} aInstructors
     * Holder of fetched intructors from the database.
     */
    let aInstructors = [];

    /**
     * @var {object} oInstructorDetails
     * Holder of selected instructor details.
     */
    let oInstructorDetails = {};

    /**
     * @var {object} oColumns
     * Holder of columns to be displayed by the datatable.
     */
    let oColumns = {
        aInstructor: [
            {
                title: 'Full Name', className: 'text-center no-sort', render: (aData, oType, oRow) =>
                    [oRow.firstName, oRow.middleName, oRow.lastName].join(' ')
            },
            {
                title: 'Contact No.', className: 'text-center no-sort', data: 'contactNum'
            },
            {
                title: 'Email Address', className: 'text-center no-sort', data: 'email'
            },
            {
                title: 'Certification Title', className: 'text-center no-sort', render: (aData, oType, oRow) =>
                    (oRow.certificationTitle === '') ? 'N/A' : oRow.certificationTitle
            },
            {
                title: 'Actions', className: 'text-center no-sort', render: (aData, oType, oRow) =>
                    `<button class="btn btn-primary btn-sm" data-toggle="modal" id="messageInstructor" data-id="${oRow.id}">
                        <i class="fa fa-envelope"></i>
                    </button>
                    <button class="btn btn-warning btn-sm" data-toggle="modal" id="editInstructor" data-id="${oRow.id}">
                        <i class="fa fa-pencil-alt"></i>
                    </button>
                    <button class="btn btn-${(oRow.status === 'Active') ? 'danger' : 'success'} btn-sm" data-toggle="modal" id="${(oRow.status === 'Active') ? 'disableInstructor' : 'enableInstructor'}" data-id="${oRow.id}">
                        <i class="fa fa-user${(oRow.status === 'Active') ? '-slash' : ''}"></i>
                    </button>`
            },
        ]
    };

    /**
     * init
     * Constructor-like method to be called on document ready.
     */
    function init() {
        fetchInstructors();
        setEvents();
    }

    /**
     * setEvents
     */
    function setEvents() {
        oForms.prepareDomEvents();

        $('.modal').on('hidden.bs.modal', function () {
            let sFormName = `#${$(this).find('form').attr('id')}`;
            $(sFormName)[0].reset();
            $(sFormName).find('.custom-file-label').text('Select File');
            $('.error-msg').css('display', 'none').html('');
        });

        $(document).on('click', '#editInstructor', function () {
            let iInstructorId = $(this).attr('data-id');
            let oInstructorData = aInstructors.filter(oInstructor => oInstructor.id == iInstructorId)[0];
            proceedToEditInstructor(oInstructorData);
        });

        $(document).on('click', '#messageInstructor', function () {
            oInstructorDetails = aInstructors.filter(oInstructor => oInstructor.id == $(this).attr('data-id'))[0];
            oInstructorDetails = {
                'fullName': oInstructorDetails.fullName,
                'email': oInstructorDetails.email
            }
            $('#messageInstructorModal').modal('show');
        });

        $(document).on('click', '#disableInstructor', function () {
            Swal.fire({
                title: 'Disable the instructor?',
                text: `This will mark the status of the instructor as 'Inactive'.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((bResult) => {
                if (bResult.value === true) {
                    const oDetails = {
                        'instructorId': parseInt($(this).attr('data-id'), 10),
                        'instructorAction': 'disable'
                    }
                    toggleEnableDisableInstructor(oDetails);
                }
            });
        });

        $(document).on('click', '#enableInstructor', function () {
            Swal.fire({
                title: 'Enable the instructor?',
                text: `This will mark the status of the instructor as 'Active'.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((bResult) => {
                if (bResult.value === true) {
                    const oDetails = {
                        'instructorId': parseInt($(this).attr('data-id'), 10),
                        'instructorAction': 'enable'
                    }
                    toggleEnableDisableInstructor(oDetails);
                }
            });
        });

        $(document).on('submit', 'form', function (oEvent) {
            oEvent.preventDefault();

            const sFormName = `#${$(this).attr('id')}`;

            // Disable the form.
            // oForms.disableFormState(sFormName, true);

            // Invoke the resetInputBorders method inside oForms utils for that form.
            oForms.resetInputBorders(sFormName);

            // Get form data.
            const oFormData = $(sFormName).serializeArray();

            // Create an object with key names of forms and its corresponding validation and request action as its value.
            const oInputForms = {
                '#addInstructorForm': {
                    'validationMethod': oValidations.validateInstructorInputs(sFormName),
                    'requestClass': 'Users',
                    'requestAction': 'addInstructor',
                    'alertTitle': 'Add instructor?',
                    'alertText': 'This will insert a new instructor.'
                },
                '#editInstructorForm': {
                    'validationMethod': oValidations.validateInstructorInputs(sFormName),
                    'requestClass': 'Users',
                    'requestAction': 'updateInstructor',
                    'alertTitle': 'Update instructor?',
                    'alertText': 'This will update the instructor details.'
                },
                '#changeInstructorForm': {
                    'validationMethod': oValidations.validateChangeInstructorInputs(sFormName, oFormData),
                    'requestClass': 'Users',
                    'requestAction': 'changeInstructors',
                    'alertTitle': 'Change instructors?',
                    'alertText': 'This will change the instructors of the schedules above.'
                },
                '#messageInstructorForm': {
                    'validationMethod': oValidations.validateMessageInstructorInputs(sFormName),
                    'requestClass': 'Users',
                    'requestAction': 'messageInstructor',
                    'alertTitle': 'Message instructor?',
                    'alertText': 'This will send a message to the selected instructor.'
                }
            }

            // Validate the inputs of the submitted form and store the result inside oValidateInputs variable.
            let oValidateInputs = oInputForms[sFormName].validationMethod;

            if (oValidateInputs.result === true) {
                Swal.fire({
                    title: oInputForms[sFormName].alertTitle,
                    text: oInputForms[sFormName].alertText,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                }).then((bIsConfirm) => {
                    if (bIsConfirm.value !== true) {
                        return false;
                    } else {
                        // Get the request class of the form submitted.
                        let sRequestClass = oInputForms[sFormName].requestClass;

                        // Get the request action of the form submitted.
                        let sRequestAction = oInputForms[sFormName].requestAction;

                        // Check if input validation result is true.
                        // const oFormData = $(sFormName).serializeArray();
                        const oFormData = new FormData($(sFormName)[0]);
                        // console.log(oFormData); return;
                        executeSubmit(oFormData, sRequestClass, sRequestAction);
                    }
                });
            } else {
                oLibraries.displayErrorMessage(sFormName, oValidateInputs.msg, oValidateInputs.element);
            }
            // Enable the form.
            oForms.disableFormState(sFormName, false);
        });

        $(document).on('click', '#deleteVenue', function () {
            Swal.fire({
                title: 'Delete the venue?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((bResult) => {
                if (bResult.value === true) {
                    const oVenueId = {
                        'venueId': parseInt($(this).attr('data-id'), 10)
                    }
                    executeDelete(oVenueId);
                }
            });
        });
    }

    /**
     * proceedToEditInstructor
     * @param {object} oDetails
     */
    function proceedToEditInstructor(oDetails) {
        $('#editInstructorModal').find('.instructorId').val(oDetails.id);
        $('#editInstructorModal').find('.firstName').val(oDetails.firstName);
        $('#editInstructorModal').find('.middleName').val(oDetails.middleName);
        $('#editInstructorModal').find('.lastName').val(oDetails.lastName);
        $('#editInstructorModal').find('.email').val(oDetails.email);
        $('#editInstructorModal').find('.contactNum').val(oDetails.contactNum);
        $('#editInstructorModal').find('.certificationTitle').val(oDetails.certificationTitle);
        $('#editInstructorModal').modal('show');
    }

    /**
     * proceedToChangeInstructor
     * @param {object} oDetails
     * @param {int} iInstructorId
     */
    function proceedToChangeInstructor(oDetails, iInstructorId) {
        oLibraries.displayAlertMessage('warning', 'Please update the instructors for the following schedules.');

        loadTemplate();

        $('.box')
            .empty()
            .find('div[class!="template"]')
            .remove();

        $.each(oDetails, (iKey, oVal) => {
            let oRow = oTemplate.clone().attr({
                'hidden': false,
                'class': 'clonedTpl',
            });

            oRow.find('.courseCode span').text(oVal.courseCode);
            oRow.find('.courseSchedule span').text(oVal.fromDate + ' - ' + oVal.toDate);
            oRow.find('.courseVenue span').text(oVal.venue);

            cloneInstructorDropdown(oRow.find('.courseInstructors'), oVal.scheduleId, iInstructorId);
            insertInstructorToBeDisabled($('.instructorName'), iInstructorId);

            $('.box').append(oRow);
        });

        $('.clonedTpl hr').last().remove();
        oChangeInstructorModal.modal('show');
    }

    /**
     * loadTemplate
     * Loads the template.
     */
    function loadTemplate() {
        if ($.isEmptyObject(oTemplate) === true) {
            oTemplate = $('.template').clone();
        }
    }

    /**
     * cloneInstructorDropdown
     * Clonses the instructor dropdown inside the template.
     */
    function cloneInstructorDropdown(oElement, iScheduleId, iInstructorId) {
        let aFilteredInstructors = aInstructors.filter((oInstructor) => {
            return oInstructor.id !== iInstructorId && oInstructor.status === 'Active';
        });

        oElement.empty().attr('name', `courseInstructors[${iScheduleId}]`).append($('<option selected disabled hidden>Select Instructor</option>'));
        $.each(aFilteredInstructors, (iKey, oVal) => {
            oElement.append($('<option />').val(oVal.id).text(`${oVal.fullName}`));
        });
    }

    /**
     * insertInstructorToBeDisabled
     * Inserts the name of the instructor to be disabled.
     */
    function insertInstructorToBeDisabled(oElement, iInstructorId) {
        let aInstructor = aInstructors.filter((oInstructor) => {
            return oInstructor.id === iInstructorId;
        })[0];

        oElement.val(aInstructor.firstName + ' ' + aInstructor.lastName);
    }

    /**
     * executeSubmit
     * @param {object} oFormData
     * @param {string} sRequestClass
     * @param {string} sRequestAction
     */
    function executeSubmit(oFormData, sRequestClass, sRequestAction) {
        for ([sName, mValue] of Object.entries(oInstructorDetails)) {
            oFormData.append(sName, mValue);
        }

        // Execute AJAX.
        $.ajax({
            url: `/Nexus/utils/ajax.php?class=${sRequestClass}&action=${sRequestAction}`,
            type: 'POST',
            data: oFormData,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function (oResponse) {
                // oLibraries.displayAlertMessage(
                //     (oResponse.bResult === true) ? 'success' : 'error', oResponse.sMsg
                // );
                // fetchInstructors();
                // $('.modal').modal('hide');
            }
        });
    }

    /**
     * toggleEnableDisableInstructor
     * @param {object} oInstructorData
     */
    function toggleEnableDisableInstructor(oInstructorData) {
        $.ajax({
            url: '/Nexus/utils/ajax.php?class=Users&action=enableDisableInstructor',
            type: 'POST',
            data: oInstructorData,
            dataType: 'json',
            success: function (oResponse) {
                if (oResponse.bResult === true) {
                    oLibraries.displayAlertMessage('success', oResponse.sMsg);
                    fetchInstructors();
                } else {
                    if (typeof (oResponse.aSchedules) !== 'undefined') {
                        oInstructorDetails = oInstructorData;
                        proceedToChangeInstructor(oResponse.aSchedules, oInstructorData.instructorId);
                        return;
                    }
                    oLibraries.displayAlertMessage('error', oResponse.sMsg);
                }
            }
        });
    }

    /**
     * fetchInstructors
     */
    function fetchInstructors() {
        let oAjax = {
            url: `/Nexus/utils/ajax.php?class=Users&action=fetchInstructors`,
            type: 'GET',
            dataType: 'JSON',
            dataSrc: function (oData) {
                aInstructors = oData;
                return aInstructors;
            },
            async: false
        };

        let aColumnDefs = [
            { targets: [1, 2, 3, 4], orderable: false }
        ];

        loadTable(oTblInstructor.attr('id'), oAjax, oColumns.aInstructor, aColumnDefs);
    }

    /**
     * loadTable
     * Loads the datatable.
     * @param {string} sTableName
     * @param {object} oData
     * @param {array} aColumns
     * @param {array} aColumnDefs
     */
    function loadTable(sTableName, oData, aColumns, aColumnDefs) {
        $(`#${sTableName} > tbody`).empty().parent().DataTable({
            destroy: true,
            deferRender: true,
            ajax: oData,
            responsive: true,
            pagingType: 'first_last_numbers',
            pageLength: 4,
            ordering: true,
            searching: true,
            lengthChange: true,
            lengthMenu: [[4, 8, 12, 16, 20, 24, -1], [4, 8, 12, 16, 20, 24, 'All']],
            info: true,
            columns: aColumns,
            columnDefs: aColumnDefs
        });
    }

    /**
     * Return public pointers.
     */
    return {
        initialize: init
    }

})();

$(() => {
    oInstructor.initialize();
});