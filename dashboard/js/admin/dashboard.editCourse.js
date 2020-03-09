var oEditCourse = (() => {

    let oTblCourses = $('#tbl_courses');

    let oColumns = {
        aCourses: [
            {
                title: 'Course Code', className: 'text-center', data: 'courseCode'
            },
            {
                title: 'Official Course Title', className: 'text-center', data: 'courseName'
            },
            {
                title: 'Details', className: 'text-center', data: 'courseDescription'
            },
            {
                title: 'Amount', className: 'text-center', data: 'coursePrice'
            },
            {
                title: 'Actions', className: 'text-center', render: (aData, oType, oRow) =>
                    `<button class="btn btn-warning btn-sm" data-toggle="modal" id="editRequest" data-id="${oRow.id}">
                        <i class="fa fa-pencil-alt"></i>
                    </button>
                    <button class="btn btn-danger btn-sm" data-toggle="modal" id="deleteRequest" data-id="${oRow.id}">
                        <i class="fa fa-trash"></i>
                    </button>`
            },
        ]
    };

    function init() {
        populateCoursesTable();
        setEvents();
    }

    function setEvents() {
        oForms.prepareDomEvents();
    
        $(document).on('submit', 'form', function(oEvent) {
            oEvent.preventDefault();

            // Create an object with key names of forms and its corresponding validation and request action as its value.
            let oInputForms = {
                '#addCourseForm': {
                    'validationMethod': oValidations.validateAddCourseInputs(),
                    'requestClass': 'Courses',
                    'requestAction': 'addCourse'
                }
            }

            // Get the form name being submitted.
            let formName = '#' + $(this).attr('id') + '';

            oForms.disableFormState(formName, true);

            // Invoke the resetInputBorders method inside oForms utils for that form.
            oForms.resetInputBorders(formName);

            // Validate the inputs of the submitted form and store the result inside validateInputs variable.
            let validateInputs = oInputForms[formName].validationMethod;

            // Get the request class of the form submitted.
            let requestClass = oInputForms[formName].requestClass;

            // Get the request action of the form submitted.
            let requestAction = oInputForms[formName].requestAction;

            // Check if input validation result is true.
            if (validateInputs.result === true) {
                // Extract form data.
                let formData = $(formName).serializeArray();

                let aSelectedCourses = [];
                let aSelectedSchedules = [];
                let aSelectedNumPax = [];

                // Get courses.
                $('select[name="quoteCourse[]"]:visible').each(function () {
                    aSelectedCourses.push($(this).val());
                });

                // Get schedules.
                $('select[name="quoteSchedule[]"]:visible').each(function () {
                    aSelectedSchedules.push($(this).val());
                });

                // Get numpax.
                $('input[name="numPax[]"]:visible').each(function () {
                    aSelectedNumPax.push($(this).val());
                });

                // Remove unnecessary data to be sent in AJAX request.
                formData = formData.filter(function (sFormKey) {
                    return sFormKey.name != 'quoteCourse[]' && sFormKey.name != 'quoteSchedule[]' && sFormKey.value !== '';
                });

                formData.push({ 'name': 'quoteCourses', 'value': aSelectedCourses });
                formData.push({ 'name': 'quoteSchedules', 'value': aSelectedSchedules });
                formData.push({ 'name': 'quoteNumPax', 'value': aSelectedNumPax });

                if (formName === '#editRequestForm') {
                    formData.push({ 'name': ':senderId', 'value': oEditIds.iSenderId });
                    formData.push({ 'name': ':userId', 'value': oEditIds.iUserId });
                    formData.push({ 'name': ':dateRequested', 'value': oEditIds.sDateRequested });
                }

                // Execute AJAX request.
                $.ajax({
                    url: `/Nexus/utils/ajax.php?class=${requestClass}&action=${requestAction}`,
                    type: 'post',
                    data: formData,
                    dataType: 'json',
                    success: function (response) {
                        if (response.result === true) {
                            $(formName).parents().find('div.modal').modal('hide');
                            populateSendersTable();
                            oLibraries.displayAlertMessage('success', response.msg);
                        } else {
                            oLibraries.displayErrorMessage(formName, response.msg, response.element);
                        }
                    },
                    error: function () {
                        oLibraries.displayAlertMessage('error', 'An error has occured. Please try again.');
                    }
                });
            } else { // This means that there's an error while validating inputs.
                oLibraries.displayErrorMessage(formName, validateInputs.msg, validateInputs.element);
            }
            oForms.disableFormState(formName, false);
        });
    }

    function populateCoursesTable() {
        let oAjax = {
            url: `/Nexus/utils/ajax.php?class=Courses&action=fetchAllCourses`,
            type: 'GET',
            dataType: 'JSON',
            dataSrc: function (oData) {
                return oData;
            },
            async: false
        };

        let aColumnDefs = [
            { orderable: false, targets: [2, 3, 4] }
        ];

        loadTable(oTblCourses.attr('id'), oAjax, oColumns.aCourses, aColumnDefs);
    }

    function loadTable(sTableName, oData, aColumns, aColumnDefs) {
        $(`#${sTableName} > tbody`).empty().parent().DataTable({
            destroy: true,
            deferRender: true,
            ajax: oData,
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

$(document).ready(function() {
    oEditCourse.initialize();
});
