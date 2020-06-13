var oSchedules = (() => {

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

    function init() {
        fetchSchedules();
    }

    function fetchSchedules() {
        $.ajax({
            url: '/Nexus/utils/ajax.php?class=Schedules&action=fetchSchedules',
            type: 'GET',
            dataType: 'json',
            async: false,
            success: function (oResponse) {
                aEvents = oResponse.filter(oEvent => oEvent.extendedProps.status == 'Active');
                initializeCalendar(aEvents);
            }
        });
    }

    /**
     * initializeCalendar
     * Initializes the calendar to display it on the front-end.
     * @param {array} aEvents
     */
    function initializeCalendar(aEvents) {
        oCalendar = new FullCalendar.Calendar(oCalendarEl, {
            plugins: ['interaction', 'dayGrid', 'rrule'],
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
    }

    /**
     * Return public pointers.
     */
    return {
        initialize: init
    }
})();

$(() => {
    oSchedules.initialize();
});
