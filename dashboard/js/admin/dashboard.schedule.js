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
            plugins: ['interaction', 'dayGrid', 'rrule'],
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
                        Price: P${new Number(oInfo.event.extendedProps.coursePrice).toLocaleString('en-US')}
                        ${(oInfo.event.extendedProps.isRecurring === true) ? '<br>' + oInfo.event.extendedProps.frequency : ''}`
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
                    proceedEditingSchedule(oInfo.event);
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

            if (sStartDate === sEndDate) {
                $('#recurrenceDiv').css('display', 'block').find('.recurrence').attr('disabled', false);
            }

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
                html: 'This will update the schedule dates.<br/>It is highly advised to inform the enrolees first, if any.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
            }).then((bIsConfirm) => {
                if (bIsConfirm.value === true) {
                    executeUpdate(prepareCalendarData(oInfo.event, true));
                } else {
                    oInfo.revert();
                }
            });
            removeTooltip();
        });

        oCalendar.on('eventResize', (oInfo) => {
            if (moment(oInfo.event.end) < moment() || oInfo.event.extendedProps.isRecurring === true) {
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
            removeTooltip();
        });

    }

    /**
     * setDomEvents
     * Prepares the DOM-related events.
     */
    function setDomEvents() {

        oForms.prepareDomEvents();

        $(document).on('change', '.recurrence', function () {
            let sFormId = $(this).closest('form');
            $(sFormId).find('.numRepetitions').attr('disabled', true).parent('.form-group').attr('hidden', true);
            $(sFormId).find('.toDate').val($(this).closest('form').find('.fromDate').val());

            if ($(this).val() === 'weekly') {
                $(sFormId).find('.numRepetitions').attr('disabled', false).val(2).parent('.form-group').attr('hidden', false);
                let sNewEndDate = moment($(sFormId).find('.fromDate').val()).add($(sFormId).find('.numRepetitions').val(), 'weeks').format('YYYY-MM-DD');
                $(sFormId).find('.toDate').val(sNewEndDate);
            }
        });

        $(document).on('input change', '.numRepetitions', function () {
            const sFormId = `#${$(this).closest('form').attr('id')}`;
            let sNewEndDate = moment($(sFormId).find('.fromDate').val()).add($(this).val(), 'weeks').format('YYYY-MM-DD');
            $(sFormId).find('.toDate').val(sNewEndDate);
        });

        $('.modal').on('hidden.bs.modal', function () {
            let sFormId = `#${$(this).find('form').attr('id')}`;
            $(sFormId)[0].reset();
            $(sFormId).find('#recurrenceDiv').css('display', 'none').find('input').attr('disabled', true);
            $(sFormId).find('.numRepetitions').parent('.form-group').attr('hidden', true);
            $(sFormId).find('.recurrence[value="none"]').attr('checked', true);
            $(sFormId).find('.error-msg').css('display', 'none').html('');
        });

        $(document).on('click', '#cancelEventClick', () => {
            // Hide the Swal modal by removing it.
            $('.swal2-container').remove();
        });

        $(document).on('submit', 'form', function (oEvent) {
            oEvent.preventDefault();
            const sFormId = `#${$(this).attr('id')}`;

            // Disable the form.
            oForms.disableFormState(sFormId, true);

            // Invoke the resetInputBorders method inside oForms utils for that form.
            oForms.resetInputBorders(sFormId);

            // Create an object with key names of forms and its corresponding validation and request action as its value.
            const oInputForms = {
                '#addScheduleForm': {
                    'validationMethod': oValidations.validateScheduleInputs(sFormId),
                    'requestClass': 'Schedules',
                    'requestAction': 'addSchedule',
                    'alertTitle': 'Add schedule?',
                    'alertText': 'This will insert a new schedule.'
                },
                '#editScheduleForm': {
                    'validationMethod': oValidations.validateScheduleInputs(sFormId),
                    'requestClass': 'Schedules',
                    'requestAction': 'updateSchedule',
                    'alertTitle': 'Update schedule?',
                    'alertText': 'This will update the schedule details.'
                }
            }

            Swal.fire({
                title: oInputForms[sFormId].alertTitle,
                text: oInputForms[sFormId].alertText,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
            }).then((bIsConfirm) => {
                if (bIsConfirm.value !== true) {
                    return false;
                } else {
                    // Validate the inputs of the submitted form and store the result inside validateInputs variable.
                    let oValidateInputs = oInputForms[sFormId].validationMethod;

                    // Get the request class of the form submitted.
                    let sRequestClass = oInputForms[sFormId].requestClass;

                    // Get the request action of the form submitted.
                    let sRequestAction = oInputForms[sFormId].requestAction;

                    // Check if input validation result is true.
                    if (oValidateInputs.result === true) {
                        const oFormData = $(sFormId).serializeArray();
                        (sFormId === '#addScheduleForm')
                            ? executeInsert(prepareScheduleData(oFormData, sFormId), sRequestClass, sRequestAction)
                            : executeUpdate(prepareScheduleData(oFormData, sFormId));
                    } else {
                        oLibraries.displayErrorMessage(sFormId, oValidateInputs.msg, oValidateInputs.element);
                    }
                }
            });
            // Enable the form.
            oForms.disableFormState(sFormId, false);
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
     * proceedEditingSchedule
     * @param {object} oData 
     */
    function proceedEditingSchedule(oData) {
        let iCourseId = aCourses.find(oCourse => oCourse.courseCode === oData.title).id;
        let iVenueId = aVenues.find(oVenue => oVenue.venue === oData.extendedProps.venue.name).id;
        let iInstructorId = aInstructors.find(oInstructor => oInstructor.fullName === oData.extendedProps.instructor.name).id;

        const sStartDate = moment(oData.start).format('YYYY-MM-DD');
        const sEndDate = moment(oData.end).subtract(1, 'days').format('YYYY-MM-DD');
        $('#editScheduleModal').find('.fromDate').val(sStartDate);
        $('#editScheduleModal').find('.toDate').val(sEndDate);

        // If event selected occurs only in one day, display recurrenceDiv.
        if (sStartDate === sEndDate) {
            $('#editScheduleModal').find('#recurrenceDiv').css('display', 'block').find('.recurrence').attr('disabled', false);
        }
        // If event is recurring, set recurring data.
        if (oData.extendedProps.isRecurring === true) {
            setDataForRecurringEvents(oData);
        }

        $('#editScheduleModal').find('.scheduleId').val(oData.id);
        $('#editScheduleModal').find('.courseTitle').val(iCourseId);
        $('#editScheduleModal').find('.courseVenue').val(iVenueId);
        $('#editScheduleModal').find('.numSlots').val(oData.extendedProps.numSlots);
        $('#editScheduleModal').find('.coursePrice').val(oData.extendedProps.coursePrice);
        $('#editScheduleModal').find('.remainingSlots').val(oData.extendedProps.remainingSlots);
        $('#editScheduleModal').find('.courseInstructor').val(iInstructorId);

        $('#editScheduleModal').modal('show');
    }

    function setDataForRecurringEvents(oData)
    {
        const sStartDate = moment(oData._def.recurringDef.typeData.origOptions.dtstart)
                .format('YYYY-MM-DD');

        const sEndDate = moment(oData._def.recurringDef.typeData.origOptions.until)
                .subtract(1, 'days')
                .format('YYYY-MM-DD');

        $('#editScheduleModal').find('.fromDate').val(sStartDate);
        $('#editScheduleModal').find('.toDate').val(sEndDate);

        $('#editScheduleModal')
            .find('#recurrenceDiv')
            .css('display', 'block')
            .find('.recurrence')
            .attr('disabled', false)
            .filter('[value="weekly"]')
            .attr('checked', true);
        $('#editScheduleModal')
            .find('.numRepetitions')
            .attr('disabled', false)
            .val(oData.extendedProps.frequency.match(/\d+/g).map(Number))
            .parent('.form-group')
            .attr('hidden', false);
    }

    /**
     * prepareCalendarData
     * @param {object} oData
     * @param {bool} bReschedule
     */
    function prepareCalendarData(oData, bReschedule = false) {
        const sFormDate = oData.start;
        const sEndDate = oData.end ?? moment(sFormDate).add(oData.extendedProps.frequency.match(/\d+/g).map(Number) - 1, 'weeks').add(1, 'days').format('YYYY-MM-DD');
        return {
            iScheduleId: parseInt(oData.id, 10),
            iInstructorId: parseInt(oData.extendedProps.instructor.id, 10),
            iVenueId: oData.extendedProps.venue.id,
            iCourseId: oData.extendedProps.courseId,
            iCoursePrice: oData.extendedProps.coursePrice,
            sStart: moment(sFormDate).format('YYYY-MM-DD') ,
            sEnd: moment(sEndDate).subtract(1, 'days').format('YYYY-MM-DD'),
            iSlots: oData.extendedProps.numSlots,
            iRemainingSlots: oData.extendedProps.remainingSlots,
            bReschedule: bReschedule
        };
    }

    /**
     * prepareScheduleData
     * Renames the keys.
     * @param {array} aData
     * @param {string} sFormId
     * @param {return} aData
     */
    function prepareScheduleData(aData, sFormId) {
        let aParams = [
            { scheduleId: 'iScheduleId' },
            { courseTitle: 'iCourseId' },
            { coursePrice: 'iCoursePrice' },
            { courseVenue: 'iVenueId' },
            { fromDate: 'sStart' },
            { toDate: 'sEnd' },
            { numSlots: 'iSlots' },
            { courseInstructor: 'iInstructorId' }
        ];

        if ($(sFormId).find('.recurrence').prop('disabled') === false) {
            aParams.push({ recurrence: 'iRecurrence' });
            if ($(sFormId).find('.recurrence:selected').val() === 'weekly') {
                aParams.push({ remainingSlots : 'iRemainingSlots' });
            }
        }

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