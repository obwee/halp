var oEnrollment = (() => {

    let oTblEnrollment = $('#tbl_enrollment');

    let aEnrolledCourses = [];

    let aCoursesAvailable = [];

    let aInstructors = [];

    let oCourseDropdown = $('.courses');

    let oScheduleDropdown = $('.schedules');

    let oColumns = {
        aCourses: [
            {
                title: 'Course Code', className: 'text-center', data: 'courseCode'
            },
            {
                title: 'Schedule', className: 'text-center', render: (aData, oType, oRow) =>
                    oRow.fromDate + ' - ' + oRow.toDate
            },
            {
                title: 'Venue', className: 'text-center', data: 'venue'
            },
            {
                title: 'Instructor', className: 'text-center', data: 'instructorName'
            },
            {
                title: 'Amount', className: 'text-center', render: (aData, oType, oRow) =>
                    'P' + parseInt(oRow.coursePrice, 10).toLocaleString()
            },
            {
                title: 'Status', className: 'text-center', data: 'paymentStatus'
            },
            {
                title: 'Actions', className: 'text-center', render: (aData, oType, oRow) =>
                    `<button class="btn btn-success btn-sm" data-toggle="modal" id="payEnrolledSchedule" data-id="${oRow.trainingId}">
                        <i class="fa fa-hand-holding-usd"></i>
                    </button>
                    <button class="btn btn-primary btn-sm" data-toggle="modal" id="printRegiForm" data-id="${oRow.trainingId}">
                        <i class="fa fa-print"></i>
                    </button>
                    <button class="btn btn-danger btn-sm" data-toggle="modal" id="deleteEnrolledSchedule" data-id="${oRow.trainingId}">
                        <i class="fa fa-trash-alt"></i>
                    </button>`
            },
        ]
    };

    function init() {
        fetchCourses();
        setEvents();
    }

    function setEvents() {

        $('.modal').on('hidden.bs.modal', function () {
            let sFormId = `#${$(this).find('form').attr('id')}`;
            $(sFormId)[0].reset();
            $('.error-msg').css('display', 'none').html('');
        });

        $(document).on('click', '#payEnrolledSchedule', function () {
            $('#paymentModal').modal('show');
        });

        $(document).on('click', '#enrollBtn', function () {
            populateCourseDropdown();
            $('#enrollModal').modal('show');
        });

        $(document).on('change', '.courses', function () {
            populateScheduleDropdown($(this).val());
        });

        $(document).on('change', '.schedules', function () {
            populateRemainingInputs($(this).val());
        });

        $(document).on('submit', 'form', function (oEvent) {
            oEvent.preventDefault();

            const sFormId = `#${$(this).attr('id')}`;

            // Disable the form.
            // oForms.disableFormState(sFormId, true);

            // Invoke the resetInputBorders method inside oForms utils for that form.
            oForms.resetInputBorders(sFormId);

            const oInputForms = {
                '#addPaymentMethodForm': {
                    'validationMethod': oValidations.validatePaymentModeInputs(sFormId),
                    'requestClass': 'PaymentMethods',
                    'requestAction': 'addPaymentMethod',
                    'alertTitle': 'Add payment method?',
                    'alertText': 'This will insert a new payment method.'
                },
                '#editPaymentMethodForm': {
                    'validationMethod': oValidations.validatePaymentModeInputs(sFormId),
                    'requestClass': 'PaymentMethods',
                    'requestAction': 'updatePaymentMethod',
                    'alertTitle': 'Update payment method?',
                    'alertText': 'This will update the payment method.'
                }
            }

            // Validate the inputs of the submitted form and store the result inside oValidateInputs variable.
            let oValidateInputs = oInputForms[sFormId].validationMethod;

            if (oValidateInputs.result === true) {
                Swal.fire({
                    title: oInputForms[sFormId].alertTitle,
                    text: oInputForms[sFormId].alertText,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                }).then((bIsConfirm) => {
                    if (bIsConfirm.value === true) {
                        executeSubmit(sFormId, oInputForms[sFormId].requestClass, oInputForms[sFormId].requestAction);
                    }
                });
            } else {
                oLibraries.displayErrorMessage(sFormId, oValidateInputs.msg, oValidateInputs.element);
            }
            // Enable the form.
            oForms.disableFormState(sFormId, false);
        });

    }

    function populateCourseDropdown() {
        oCourseDropdown.empty().append($('<option selected disabled hidden>Select Course</option>'));

        $.each(aCoursesAvailable, function (iKey, oCourse) {
            oCourseDropdown.append($('<option />').val(oCourse.courseId).text(`${oCourse.courseName} (${oCourse.courseCode})`));
        });
    }

    function populateScheduleDropdown(iCourseId) {
        let oFilteredCourse = aCoursesAvailable.filter(oCourse => oCourse.courseId == iCourseId)[0];

        oScheduleDropdown.empty().append($('<option selected disabled hidden>Select Schedule</option>'));

        $.each(oFilteredCourse.schedules, function (iScheduleId, sScheduleDate) {
            oScheduleDropdown.append($('<option />').val(iScheduleId).text(sScheduleDate));
        });
    }

    function populateRemainingInputs(iScheduleId) {
        let oFilteredSchedule = aCoursesAvailable.filter(oCourse => oCourse.schedules[iScheduleId])[0];

        $('.price').val(`P${parseInt(oFilteredSchedule['prices'][iScheduleId], 10).toLocaleString()}`);
        $('.venue').val(oFilteredSchedule['venues'][iScheduleId]);
        $('.slots').val(oFilteredSchedule['slots'][iScheduleId]);

        let iInstructorId = oFilteredSchedule['instructors'][iScheduleId];
        let oInstructor = aInstructors.filter(oInstructor => oInstructor.id == iInstructorId)[0];

        $('.instructor').val(`${oInstructor.firstName} ${oInstructor.lastName}`);
    }

    function fetchCourses() {
        $.ajax({
            url: `/Nexus/utils/ajax.php?class=Courses&action=fetchCoursesToEnroll`,
            type: 'GET',
            dataType: 'json',
            success: function (oResponse) {
                aEnrolledCourses = oResponse.aEnrolledCourses;
                aCoursesAvailable = oResponse.aCoursesAvailable;
                aInstructors = oResponse.aInstructors;
                populateEnrollmentTable();
            },
            error: function () {
                oLibraries.displayAlertMessage('error', 'An error has occured. Please try again.');
            }
        });
    }

    function populateEnrollmentTable() {
        let aColumnDefs = [
            { orderable: false, targets: [2, 3, 4] }
        ];

        loadTable(oTblEnrollment.attr('id'), oColumns.aCourses, aColumnDefs);
    }

    function loadTable(sTableName, aColumns, aColumnDefs) {
        $(`#${sTableName} > tbody`).empty().parent().DataTable({
            destroy: true,
            deferRender: true,
            data: aEnrolledCourses,
            responsive: true,
            pagingType: 'first_last_numbers',
            pageLength: 4,
            ordering: true,
            order: [[1, 'asc']],
            searching: true,
            lengthChange: true,
            lengthMenu: [[4, 8, 12, 16, 20, 24, -1], [4, 8, 12, 16, 20, 24, 'All']],
            info: true,
            columns: aColumns,
            columnDefs: aColumnDefs
        });
    }

    return {
        initialize: init
    }

})();

$(() => {
    oEnrollment.initialize();
});
