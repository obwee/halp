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
     * init
     * Constructor-like method that will be invoked on document ready.
     */
    function init() {
        fetchSchedules();
        initializeCalendar();
        fetchCourses();
        fetchVenues();
        fetchInstructors();
        setDomEvents();
    }

    /**
     * initializeCalendar
     * Initializes the calendar to display it on the front-end.
     */
    function initializeCalendar() {
        oCalendar = new FullCalendar.Calendar(oCalendarEl, {
            plugins: ['interaction', 'dayGrid'],
            themeSystem: 'bootstrap',
            height: 550,
            events: aEvents,
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
        oCalendar.on('datesRender', function () {
            changeCalendarTitle();
        });

        oCalendar.on('eventRender', function (oInfo) {
            $(oInfo.el).tooltip({
                html: true,
                title: `Instructor: ${oInfo.event.extendedProps.instructor.name}<br>
                        Venue: ${oInfo.event.extendedProps.venue.name}<br>
                        Slots: ${oInfo.event.extendedProps.remainingSlots} / ${oInfo.event.extendedProps.numSlots}`
            });
        });

        oCalendar.on('eventClick', function (oInfo) {
            let sStartDate = moment(oInfo.event.start)
                .format('YYYY-MM-DD');

            let sEndDate = moment(oInfo.event.end)
                .subtract(1, 'days')
                .format('YYYY-MM-DD');

            let iCourseId = aCourses.find(oCourse => oCourse.courseCode === oInfo.event.title).id;
            let iVenueId = aVenues.find(oVenue => oVenue.venue === oInfo.event.extendedProps.venue.name).id;
            let iInstructorId = aInstructors.find(oInstructor => oInstructor.fullName === oInfo.event.extendedProps.instructor.name).id;
            console.log(iInstructorId)

            $('#editScheduleModal').find('.courseTitle').val(iCourseId);
            $('#editScheduleModal').find('.courseVenue').val(iVenueId);
            $('#editScheduleModal').find('.fromDate').val(sStartDate);
            $('#editScheduleModal').find('.toDate').val(sEndDate);
            $('#editScheduleModal').find('.numSlots').val(oInfo.event.extendedProps.numSlots);
            $('#editScheduleModal').find('.courseInstructor').val(iInstructorId);

            $('#editScheduleModal').modal('show');
        });

        oCalendar.on('select', function (oInfo) {
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
            Swal.fire({
                title: 'Move the schedule?',
                text: 'This will update the schedule dates.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
            }).then((bIsConfirm) => {
                if (bIsConfirm.value === true) {
                    executeUpdate(oInfo.event);
                } else {
                    oInfo.revert();
                }
            });
        });

        oCalendar.on('eventResize', (oInfo) => {
            Swal.fire({
                title: 'Update schedule?',
                text: 'This will update the schedule end date.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
            }).then((bIsConfirm) => {
                if (bIsConfirm.value === true) {
                    executeUpdate(oInfo.event);
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

        $('#addScheduleBtn').click(function () {
            let oFormData = $('#addScheduleForm').serializeArray();
            let oData = {};

            $(oFormData).each(function (iKey, oVal) {
                oData[oVal.name] = oVal.value;
            });

            initializeCalendar();
            $('#addScheduleModal').modal('hide');
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
                aEvents = oResponse;
            }
        });
    }

    /**
     * fetchCourses
     */
    async function fetchCourses() {
        await axios.get('/Nexus/utils/ajax.php?class=Courses&action=fetchAllCourses')
            .then((oResponse) => {
                aCourses = oResponse.data;
                populateCourseDropdown(aCourses);
            });
    }

    /**
     * fetchVenues
     */
    async function fetchVenues() {
        await axios.get('/Nexus/utils/ajax.php?class=Venue&action=fetchVenues')
            .then((oResponse) => {
                aVenues = oResponse.data;
                populateVenueDropdown(oResponse.data);
            });
    }

    /**
     * fetchInstructors
     */
    async function fetchInstructors() {
        await axios.get('/Nexus/utils/ajax.php?class=Users&action=fetchInstructors')
            .then((oResponse) => {
                aInstructors = oResponse.data;
                populateInstructorsDropdown(oResponse.data);
            });
    }

    /**
     * populateCourseDropdown
     */
    function populateCourseDropdown(aCourses) {
        let oCourseDropdown = $('select[name="courseTitle"]');
        oCourseDropdown.empty().append($('<option value="" selected disabled hidden>Select Course</option>'));

        $.each(aCourses, function (iKey, oCourse) {
            oCourseDropdown.append($('<option />').val(oCourse.id).text(`${oCourse.courseName} (${oCourse.courseCode})`));
        });
    }

    /**
     * populateVenueDropdown
     */
    function populateVenueDropdown(aVenues) {
        let oVenueDropdown = $('select[name="courseVenue"]');
        oVenueDropdown.empty().append($('<option value="" selected disabled hidden>Select Venue</option>'));

        $.each(aVenues, function (iKey, oVenue) {
            oVenueDropdown.append($('<option />').val(oVenue.id).text(`${oVenue.venue}`));
        });
    }

    /**
     * populateInstructorsDropdown
     */
    function populateInstructorsDropdown(aInstructors) {
        let oInstructorDropdown = $('select[name="courseInstructor"]');
        oInstructorDropdown.empty().append($('<option value="" selected disabled hidden>Select Instructor</option>'));

        $.each(aInstructors, function (iKey, oInstructor) {
            oInstructorDropdown.append($('<option />').val(oInstructor.id).text(`${oInstructor.fullName}`));
        });
    }

    /**
     * executeUpdate
     * @param {object} oCalendarData
     */
    function executeUpdate(oCalendarData) {
        let oData = {
            iScheduleId: parseInt(oCalendarData.id, 10),
            iInstructorId: parseInt(oCalendarData.extendedProps.instructor.id, 10),
            iVenueId: oCalendarData.extendedProps.venue.id,
            sStart: moment(oCalendarData.start).format('YYYY-MM-DD'),
            sEnd: moment(oCalendarData.end).subtract(1, 'days').format('YYYY-MM-DD'),
            iSlots: oCalendarData.extendedProps.numSlots
        };

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

                fetchSchedules();
                oCalendar.destroy();
                initializeCalendar();
            }
        });
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