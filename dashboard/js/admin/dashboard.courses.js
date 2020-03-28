var oCourses = (() => {

    let oTblCourses = $('#tbl_courses');
    
    let aCourses = [];

    let oColumns = {
        aCourses: [
            {
                title: 'Course Code', className: 'text-center', data: 'courseCode'
            },
            {
                title: 'Official Course Title', className: 'text-center', data: 'courseName'
            },
            {
                title: 'Details', className: 'text-center', render: (aData, oType, oRow) =>
                    (oRow.courseDescription === '') ? '' : oRow.courseDescription
            },
            {
                title: 'Amount', className: 'text-center', render: (aData, oType, oRow) =>
                    'P' + parseInt(oRow.coursePrice, 10).toLocaleString()
            },
            {
                title: 'Actions', className: 'text-center', render: (aData, oType, oRow) =>
                    `<button class="btn btn-warning btn-sm" data-toggle="modal" id="editCourse" data-id="${oRow.id}">
                        <i class="fa fa-pencil-alt"></i>
                    </button>
                    <button class="btn btn-danger btn-sm" data-toggle="modal" id="deleteCourse" data-id="${oRow.id}">
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

        $(document).on('click', '#editCourse', function() {
            let iCourseId = $(this).attr('data-id');

            // Get the course by filtering the fetched courses using the course ID.
            let oCourse = aCourses.filter((aCourse) => {
                return aCourse.id == iCourseId
            })[0];

            // Populate the fields with its corresponding data from the table.
            $('.courseId').val(oCourse.id);
            $('.courseCode').val(oCourse.courseCode);
            $('.courseTitle').val(oCourse.courseName);
            $('.courseDetails').val((oCourse.courseDescription === '-') ? '' : oCourse.courseDescription);
            $('.courseAmount').val(oCourse.coursePrice);

            $('#editCourseModal').modal('show');
        });

        $(document).on('click', '#deleteCourse', function() {
            Swal.fire({
                title: 'Delete the course?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((bResult) => {
                if (bResult.value === true) {
                    let oDetails = {
                        iCourseId: $(this).attr('data-id')
                    };
                    oLibraries.displayAlertMessage('success', deleteCourse(oDetails));
                    populateCoursesTable();
                }
            });
        });
    
        $(document).on('submit', 'form', function(oEvent) {
            oEvent.preventDefault();

            // Get the form name being submitted.
            let sFormId = '#' + $(this).attr('id') + '';

            // Create an object with key names of forms and its corresponding validation and request action as its value.
            let oInputForms = {
                '#addCourseForm': {
                    'validationMethod': oValidations.validateAddUpdateCourseInputs(sFormId),
                    'requestClass': 'Courses',
                    'requestAction': 'addCourse'
                },
                '#editCourseForm': {
                    'validationMethod': oValidations.validateAddUpdateCourseInputs(sFormId),
                    'requestClass': 'Courses',
                    'requestAction': 'updateCourse'
                }
            }

            oForms.disableFormState(sFormId, true);

            // Invoke the resetInputBorders method inside oForms utils for that form.
            oForms.resetInputBorders(sFormId);

            // Validate the inputs of the submitted form and store the result inside validateInputs variable.
            let validateInputs = oInputForms[sFormId].validationMethod;

            // Get the request class of the form submitted.
            let requestClass = oInputForms[sFormId].requestClass;

            // Get the request action of the form submitted.
            let requestAction = oInputForms[sFormId].requestAction;

            // Check if input validation result is true.
            if (validateInputs.result === true) {
                // Extract form data.
                let aFormData = $(sFormId).serializeArray();

                // Execute AJAX request.
                $.ajax({
                    url: `/Nexus/utils/ajax.php?class=${requestClass}&action=${requestAction}`,
                    type: 'post',
                    data: aFormData,
                    dataType: 'json',
                    success: function (oResponse) {
                        if (oResponse.bResult === true) {
                            $(sFormId).parents().find('div.modal').modal('hide');
                            populateCoursesTable();
                            oLibraries.displayAlertMessage('success', oResponse.sMsg);
                        } else {
                            oLibraries.displayErrorMessage(sFormId, oResponse.sMsg, oResponse.sElement);
                        }
                    },
                    error: function () {
                        oLibraries.displayAlertMessage('error', 'An error has occured. Please try again.');
                    }
                });
            } else { // This means that there's an error while validating inputs.
                oLibraries.displayErrorMessage(sFormId, validateInputs.msg, validateInputs.element);
            }
            oForms.disableFormState(sFormId, false);
        });
    }

    function deleteCourse(oData) {
        $.ajax({
            url: '/Nexus/utils/ajax.php?class=Courses&action=deleteCourse',
            type: 'POST',
            data: oData,
            dataType: 'json',
            success: function (oResponse) {
                return oResponse.sMsg;
            }
        });
    }

    function populateCoursesTable() {
        let oAjax = {
            url: `/Nexus/utils/ajax.php?class=Courses&action=fetchAllCourses`,
            type: 'GET',
            dataType: 'JSON',
            dataSrc: function (oData) {
                aCourses = oData;
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
    oCourses.initialize();
});
