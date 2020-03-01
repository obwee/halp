var oForms = (() => {
    
    // Toggle disabled state of the form.
    function disableFormState(formName, state) {
        $(formName).find('div[class="modal-footer"] button').prop('disabled', state);
        $(formName).prop('disabled', state);
    }

    // Remove existing red borders on inputs.
    function resetInputBorders(formName) {
        $(formName).find('input').css('border', '1px solid #ccc');
    }

    // Clone courseAndScheduleDiv based on the count fetched from DB.
    function cloneDivElements(iCount) {
        for (let i = 1; i < iCount; i++) {
            let oCourseScheduleDiv = $('.courseAndScheduleDiv:last').clone();
            oCourseScheduleDiv.insertAfter('.courseAndScheduleDiv:last').css('display', 'none');
        }
    }

    // Populate the course dropdown select.
    function populateCourseDropdown(aCourses) {
        let oCourseDropdown = $('.courseAndScheduleDiv[style*="display: none"]').first().find('.quoteCourse');
        oCourseDropdown.parent().parent().css('display', 'block');
        oCourseDropdown.empty().append($('<option value="" selected disabled hidden>Select Course</option>'));

        $.each(aCourses, function (iKey, oCourse) {
            oCourseDropdown.append($('<option />').val(oCourse.courseId).text(oCourse.courseName));
        });
    }

    // Populate the schedule dropdown select.
    function populateCourseSchedule(iCourseId, bIsDeletePressed = false) {
        let oSchedule = $('.courseAndScheduleDiv[style*="display: block"]').last().find('.quoteSchedule');
        let iSelectedScheduleId = oSchedule.find('option:selected').val();

        let oFilteredCourse = aFilteredCoursesAndSchedules.filter(function (aCourse) {
            return aCourse.courseId == iCourseId;
        })[0];

        let aSchedules = oFilteredCourse.schedule;

        oSchedule
            .empty()
            .attr('disabled', false)
            .append($('<option value="" selected disabled hidden>Select Schedule</option>'));

        $.each(aSchedules, function (iKey, sSchedule) {
            oSchedule.append($('<option />').val(oFilteredCourse.scheduleId).text(sSchedule));
        });

        if (bIsDeletePressed === true) {
            oSchedule.val(iSelectedScheduleId);
        } else {
            oSchedule.find('option:eq(0)').prop('selected', true)
        }
    }

    // Return public pointers.
    return {
        disableFormState       : disableFormState,
        resetInputBorders      : resetInputBorders,
        cloneDivElements       : cloneDivElements,
        populateCourseDropdown : populateCourseDropdown,
        populateCourseSchedule : populateCourseSchedule
    }

})();