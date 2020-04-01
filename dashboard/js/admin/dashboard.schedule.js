/**
 * CALENDAR
 * Revealing module for Full Calendar JS functionalities.
 */
let CALENDAR = (function () {
    /**
     * @var {object} oCalendar
     * The calendar object instance holder.
     */
    let oCalendar = {};

    /**
     * @var {object} oCalendarEl
     * The calendar DOM element selector.
     */
    let oCalendarEl = $('#calendar')[0];

    /**
     * @var {array} aEvents
     * Holder of schedules per venue.
     */
    let aEvents = [];

    /**
     * @var {array} aCourses
     * Holder of courses.
     */
    let aCourses = [];

    /**
     * @var {array} aVenues
     * Holder of venues.
     */
    let aVenues = [];

    /**
     * @var {array} aInstructors
     * Holder of instructors.
     */
    let aInstructors = [];

    /**
     * @var {string} sDefaultDate
     * The current month view of the calendar.
     */
    let sDefaultDate = moment().format('YYYY-MM-DD');

    /**
     * init
     * Constructor-like method that will be invoked on document ready.
     */
    function init() {
        fetchSchedules();
        initializeCalendar(sDefaultDate);
        fetchCourses();
        fetchVenues();
        fetchInstructors();
        setDomEvents();
    }

    /**
     * initializeCalendar
     * Initializes the calendar to display it on the front-end.
     * @param {string} sDefaultDate
     */
    function initializeCalendar(sDefaultDate) {
        oCalendar = new FullCalendar.Calendar(oCalendarEl, {
            plugins: ['interaction', 'dayGrid'],
            themeSystem: 'bootstrap',
            height: 550,
            events: aEvents,
            defaultDate: sDefaultDate,
            header: {
                left: 'title',
                right: 'prev, today, next',
            },
            selectable: true,
            editable: true,
            handleWindowResize: true,
            eventDurationEditable: true,
            selectOverlap: true,
            eventTextColor: 'white'
        });

        prepareCalendarEvents();
        oCalendar.render();
    }

    /**
     * changeCalendarTitle
     * Changes the calendar title.
     */
    function changeCalendarTitle() {
        $('.fc-left > h2').prepend('Schedules for ');
    }

    /**
     * prepareCalendarEvents
     * Prepares the calendar-related events.
     */
    function prepareCalendarEvents() {
        oCalendar.on('datesRender', function (oInfo) {
            changeCalendarTitle();
            let [sMonthName, iYear] = oInfo.view.title.split(' ');
            iMonth = moment().month(sMonthName).format("MM");
            sDefaultDate = [iYear, iMonth, '01'].join('-');
        });

        oCalendar.on('eventRender', function (oInfo) {
            $(oInfo.el).tooltip({
                html: true,
                title: `Instructor: ${oInfo.event.extendedProps.instructor.name}<br>
                        Venue: ${oInfo.event.extendedProps.venue.name}<br>
                        Slots: ${oInfo.event.extendedProps.remainingSlots} / ${oInfo.event.extendedProps.numSlots}<br>
                        Price: P${new Number(oInfo.event.extendedProps.coursePrice).toLocaleString('en-US')}`
                        
            });
        });

        oCalendar.on('eventClick', function (oInfo) {
            if (moment(oInfo.event.end) < moment()) {
                removeTooltip();
                return false;
            }
            Swal.fire({
                title: 'What do you want to do?',
                text: "Select an action for the selected schedule.",
                icon: 'warning',
                showCancelButton: true,
                cancelButtonText: 'Disable',
                confirmButtonText: 'Update',
                confirmButtonColor: '#0069d9',
                cancelButtonColor: '#c82333',
                allowOutsideClick: false,
                allowEscapeKey: false,
                footer: '<button class="btn btn-secondary" id="cancelEventClick">Cancel</button>',
                reverseButtons: true
            }).then((oResult) => {
                if (oResult.value === true) {
                    // If selected option is 'Update'.
                    openEditScheduleModal(oInfo.event);
                } else {
                    // If selected option is 'Disable'.
                    executeDisable(parseInt(oInfo.event.id, 10));
                }
            });
        });

        oCalendar.on('select', function (oInfo) {
            if (moment(oInfo.start) < moment()) {
                removeTooltip();
                return false;
            }
            $('.fc-highlight').css('background', 'red');
            let sStartDate = oInfo.startStr;
            let sEndDate = moment(oInfo.endStr)
                .subtract(1, 'days')
                .format('YYYY-MM-DD');

            $('#addScheduleModal').find('.fromDate').val(sStartDate);
            $('#addScheduleModal').find('.toDate').val(sEndDate);
            $('#addScheduleModal').modal('show');
        });

        oCalendar.on('eventDrop', (oInfo) => {
            if (moment(oInfo.oldEvent.end) < moment() || moment(oInfo.event.start) < moment()) {
                removeTooltip();
                oInfo.revert();
                return false;
            }
            Swal.fire({
                title: 'Move the schedule?',
                text: 'This will update the schedule dates.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
            }).then((bIsConfirm) => {
                if (bIsConfirm.value === true) {
                    executeUpdate(prepareCalendarData(oInfo.event));
                } else {
                    oInfo.revert();
                }
            });
        });

        oCalendar.on('eventResize', (oInfo) => {
            if (moment(oInfo.event.end) < moment()) {
                removeTooltip();
                oInfo.revert();
                return false;
            }
            Swal.fire({
                title: 'Update schedule?',
                text: 'This will update the schedule end date.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
            }).then((bIsConfirm) => {
                if (bIsConfirm.value === true) {
                    executeUpdate(prepareCalendarData(oInfo.event));
                } else {
                    oInfo.revert();
                }
            });
        });

    }

    /**
     * setDomEvents
     * Prepares the DOM-related events.
     */
    function setDomEvents() {

        oForms.prepareDomEvents();

        $('.modal').on('hidden.bs.modal', function () {
            let sFormName = `#${$(this).find('form').attr('id')}`;
            $(sFormName)[0].reset();
            $('.error-msg').css('display', 'none').html('');
        });

        $(document).on('click', '#cancelEventClick', () => {
            // Hide the Swal modal by removing it.
            $('.swal2-container').remove();
        });

        $(document).on('submit', 'form', function (oEvent) {
            oEvent.preventDefault();
            const sFormName = `#${$(this).attr('id')}`;

            // Disable the form.
            oForms.disableFormState(sFormName, true);

            // Invoke the resetInputBorders method inside oForms utils for that form.
            oForms.resetInputBorders(sFormName);

            // Create an object with key names of forms and its corresponding validation and request action as its value.
            const oInputForms = {
                '#addScheduleForm': {
                    'validationMethod': oValidations.validateScheduleInputs(sFormName),
                    'requestClass': 'Schedules',
                    'requestAction': 'addSchedule',
                    'alertTitle': 'Add schedule?',
                    'alertText': 'This will insert a new schedule.'
                },
                '#editScheduleForm': {
                    'validationMethod': oValidations.validateScheduleInputs(sFormName),
                    'requestClass': 'Schedules',
                    'requestAction': 'updateSchedule',
                    'alertTitle': 'Update schedule?',
                    'alertText': 'This will update the schedule details.'
                }
            }

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

                    // Validate the inputs of the submitted form and store the result inside validateInputs variable.
                    let oValidateInputs = oInputForms[sFormName].validationMethod;

                    // Get the request class of the form submitted.
                    let sRequestClass = oInputForms[sFormName].requestClass;

                    // Get the request action of the form submitted.
                    let sRequestAction = oInputForms[sFormName].requestAction;

                    // Check if input validation result is true.
                    if (oValidateInputs.result === true) {
                        const oFormData = $(sFormName).serializeArray();
                        (sFormName === '#addScheduleForm')
                            ? executeInsert(prepareScheduleData(oFormData), sRequestClass, sRequestAction)
                            : executeUpdate(prepareScheduleData(oFormData));
                    } else {
                        oLibraries.displayErrorMessage(sFormName, oValidateInputs.msg, oValidateInputs.element);
                    }
                }
            });
            // Enable the form.
            oForms.disableFormState(sFormName, false);
        });
    }

    /**
     * fetchSchedules
     */
    function fetchSchedules() {
        $.ajax({
            url: '/Nexus/utils/ajax.php?class=Schedules&action=fetchSchedules',
            type: 'GET',
            dataType: 'json',
            async: false,
            success: function (oResponse) {
                aEvents = oResponse.filter(oEvent => oEvent.extendedProps.status == 'Active');
            }
        });
    }

    /**
     * fetchCourses
     */
    async function fetchCourses() {
        await axios.get('/Nexus/utils/ajax.php?class=Courses&action=fetchAllCourses')
            .then((oResponse) => {
                aCourses = oResponse.data.filter((oCourse) => oCourse.status === 'Active');
                populateCourseDropdown(aCourses);
            });
    }

    /**
     * fetchVenues
     */
    async function fetchVenues() {
        await axios.get('/Nexus/utils/ajax.php?class=Venue&action=fetchVenues')
            .then((oResponse) => {
                aVenues = oResponse.data.filter((oVenue) => oVenue.status === 'Active');
                populateVenueDropdown(aVenues);
            });
    }

    /**
     * fetchInstructors
     */
    async function fetchInstructors() {
        await axios.get('/Nexus/utils/ajax.php?class=Instructors&action=fetchInstructors')
            .then((oResponse) => {
                aInstructors = oResponse.data.filter(oInstructor => oInstructor.status === 'Active');
                populateInstructorsDropdown(aInstructors);
            });
    }

    /**
     * populateCourseDropdown
     */
    function populateCourseDropdown(aCourses) {
        let oCourseDropdown = $('select[name="courseTitle"]');
        oCourseDropdown.empty().append($('<option value="" disabled selected hidden>Select Course</option>'));

        $.each(aCourses, function (iKey, oCourse) {
            oCourseDropdown.append($('<option />').val(oCourse.id).text(`${oCourse.courseName} (${oCourse.courseCode})`));
        });
    }

    /**
     * populateVenueDropdown
     */
    function populateVenueDropdown(aVenues) {
        let oVenueDropdown = $('select[name="courseVenue"]');
        oVenueDropdown.empty().append($('<option value="" disabled selected hidden>Select Venue</option>'));

        $.each(aVenues, function (iKey, oVenue) {
            oVenueDropdown.append($('<option />').val(oVenue.id).text(`${oVenue.venue}`));
        });
    }

    /**
     * populateInstructorsDropdown
     */
    function populateInstructorsDropdown(aInstructors) {
        let oInstructorDropdown = $('select[name="courseInstructor"]');
        oInstructorDropdown.empty().append($('<option value="" disabled selected hidden>Select Instructor</option>'));

        $.each(aInstructors, function (iKey, oInstructor) {
            oInstructorDropdown.append($('<option />').val(oInstructor.id).text(`${oInstructor.fullName}`));
        });
    }

    /**
     * openEditScheduleModal
     * @param {object} oData 
     */
    function openEditScheduleModal(oData) {
        let sStartDate = moment(oData.start)
            .format('YYYY-MM-DD');

        let sEndDate = moment(oData.end)
            .subtract(1, 'days')
            .format('YYYY-MM-DD');

        let iCourseId = aCourses.find(oCourse => oCourse.courseCode === oData.title).id;
        let iVenueId = aVenues.find(oVenue => oVenue.venue === oData.extendedProps.venue.name).id;
        let iInstructorId = aInstructors.find(oInstructor => oInstructor.fullName === oData.extendedProps.instructor.name).id;

        $('#editScheduleModal').find('.scheduleId').val(oData.id);
        $('#editScheduleModal').find('.courseTitle').val(iCourseId);
        $('#editScheduleModal').find('.courseVenue').val(iVenueId);
        $('#editScheduleModal').find('.fromDate').val(sStartDate);
        $('#editScheduleModal').find('.toDate').val(sEndDate);
        $('#editScheduleModal').find('.numSlots').val(oData.extendedProps.numSlots);
        $('#editScheduleModal').find('.coursePrice').val(oData.extendedProps.coursePrice);
        $('#editScheduleModal').find('.remainingSlots').val(oData.extendedProps.remainingSlots);
        $('#editScheduleModal').find('.courseInstructor').val(iInstructorId);

        $('#editScheduleModal').modal('show');
    }

    /**
     * prepareCalendarData
     * @param {object} oData
     */
    function prepareCalendarData(oData) {
        return {
            iScheduleId: parseInt(oData.id, 10),
            iInstructorId: parseInt(oData.extendedProps.instructor.id, 10),
            iVenueId: oData.extendedProps.venue.id,
            iCourseId: oData.extendedProps.courseId,
            sStart: moment(oData.start).format('YYYY-MM-DD'),
            sEnd: moment(oData.end).subtract(1, 'days').format('YYYY-MM-DD'),
            iSlots: oData.extendedProps.numSlots
        };
    }

    /**
     * prepareScheduleData
     * Renames the keys.
     * @param {array} aData
     * @param {return} aData
     */
    function prepareScheduleData(aData) {
        const aParams = [
            { scheduleId: 'iScheduleId' },
            { courseTitle: 'iCourseId' },
            { coursePrice: 'iCoursePrice' },
            { courseVenue: 'iVenueId' },
            { fromDate: 'sStart' },
            { toDate: 'sEnd' },
            { numSlots: 'iSlots' },
            { courseInstructor: 'iInstructorId' }
        ];

        $.each(aParams, function (mKey, oParam) {
            let sNewKey = aParams[mKey][aData[mKey].name];
            aData[mKey].name = sNewKey;
        });

        return aData;
    }

    /**
     * executeUpdate
     * @param {object} oData
     */
    function executeUpdate(oData) {
        // Execute AJAX for update.
        $.ajax({
            url: '/Nexus/utils/ajax.php?class=Schedules&action=updateSchedule',
            type: 'POST',
            data: oData,
            dataType: 'json',
            success: function (oResponse) {
                oLibraries.displayAlertMessage(
                    (oResponse.bResult === true) ? 'success' : 'error', oResponse.sMsg
                );
                reinitializeDisplay();
            }
        });
    }

    /**
     * executeInsert
     * @param {object} oData
     * @param {string} sRequestClass
     * @param {string} sRequestAction
     */
    function executeInsert(oData, sRequestClass, sRequestAction) {
        // Execute AJAX for insert.
        $.ajax({
            url: `/Nexus/utils/ajax.php?class=${sRequestClass}&action=${sRequestAction}`,
            type: 'POST',
            data: oData,
            dataType: 'json',
            success: function (oResponse) {
                oLibraries.displayAlertMessage(
                    (oResponse.bResult === true) ? 'success' : 'error', oResponse.sMsg
                );
                reinitializeDisplay();
            }
        });
    }

    /**
     * executeDisable
     * @param {int} iScheduleId
     */
    function executeDisable(iScheduleId) {
        axios.post('/Nexus/utils/ajax.php?class=Schedules&action=disableSchedule', {
            iScheduleId
        })
            .then((oResponse) => {
                oLibraries.displayAlertMessage(
                    (oResponse.data.bResult === true) ? 'success' : 'error', oResponse.data.sMsg
                );
                reinitializeDisplay();
            });
    }

    /**
     * reinitializeDisplay
     * Re-initializes the calendar data and closes any open tooltip/modal.
     */
    function reinitializeDisplay() {
        removeTooltip();
        fetchSchedules();
        oCalendar.destroy();
        initializeCalendar(sDefaultDate);
        $('.modal').modal('hide');
    }

    /**
     * removeTooltip
     */
    function removeTooltip() {
        $('.tooltip').remove();
    }

    /**
     * Return public pointers.
     */
    return {
        initialize: init
    };

})();

$(() => {
    CALENDAR.initialize();
});