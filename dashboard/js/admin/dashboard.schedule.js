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
     * @var {object} aEvents
     * Holder of schedules per venue.
     */
    let aEvents = [];

    /**
     * init
     * Constructor method that will be invoked on document ready.
     */
    function init() {
        fetchSchedules();
        initializeCalendar();
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
                title: `Instructor: ${oInfo.event.extendedProps.instructorName}<br>
                        Venue: ${oInfo.event.extendedProps.venue.name}<br>
                        Slots: ${oInfo.event.extendedProps.remainingSlots} / ${oInfo.event.extendedProps.numSlots}`
            });
        });

        oCalendar.on('eventClick', function (oInfo) {
            $('#editScheduleModal').modal('show');
        });

        oCalendar.on('select', function (oInfo) {
            let sStartDate = oInfo.startStr;
            let sEndDate = moment(oInfo.endStr)
                .subtract(1, 'days')
                .format('YYYY-MM-DD');

            $('#addScheduleModal').find('#fromDate').val(sStartDate)
            $('#addScheduleModal').find('#toDate').val(sEndDate)
            $('#addScheduleModal').modal('show');
            // alert('selected ' + oInfo.startStr + ' to ' + oInfo.endStr);
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
                    prepareForUpdate(oInfo.event);
                    // oLibraries.displayAlertMessage('success', '123');
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
                    prepareForUpdate(oInfo.event);
                    // oLibraries.displayAlertMessage('success', '123');
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

            aEvents.push({
                title: oData.eventName,
                id: oData.id,
                start: oData.fromDate,
                end: moment(oData.toDate).add(1, 'days').format('YYYY-MM-DD'),
                extendedProps: {
                    instructorName: 'ABC'
                }
            });

            initializeCalendar();
            $('#addScheduleModal').modal('hide');
        });

    }

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

    function prepareForUpdate(oCalendarData) {
        let oData = {
            iScheduleId: parseInt(oCalendarData.id, 10),
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
                console.log(oResponse)
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