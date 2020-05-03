<?php

/**
 * Validations
 * Class library for validating input data.
 */
class Validations
{
    /**
     * @var array $aRegistrationRules
     * Array of rules for validating registration inputs sent by AJAX.
     */
    public static $aRegistrationRules = array(
        array(
            'sName'       => 'First name',
            'sElement'    => 'registrationFname',
            'sColumnName' => ':firstName',
            'iMinLength'  => 2,
            'iMaxLength'  => 30,
            'sPattern'    => '/^[a-zA-Z\s\.]+$/'
        ),
        array(
            'sName'       => 'Last name',
            'sElement'    => 'registrationLname',
            'sColumnName' => ':lastName',
            'iMinLength'  => 2,
            'iMaxLength'  => 30,
            'sPattern'    => '/^[a-zA-Z\s\.]+$/'
        ),
        array(
            'sName'       => 'Contact number',
            'sElement'    => 'registrationContactNum',
            'sColumnName' => ':contactNum',
            'iMinLength'  => 7,
            'iMaxLength'  => 12,
            'sPattern'    => '/^[0-9]+$/'
        ),
        array(
            'sName'       => 'Email address',
            'sElement'    => 'registrationEmail',
            'sColumnName' => ':email',
            'iMinLength'  => 4,
            'iMaxLength'  => 50,
            'sPattern'    => '/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD'
        ),
        array(
            'sName'       => 'Username',
            'sElement'    => 'registrationUsername',
            'sColumnName' => ':username',
            'iMinLength'  => 4,
            'iMaxLength'  => 15,
            'sPattern'    => '/^(?![0-9_])\w+$/'
        ),
        array(
            'sName'       => 'Password',
            'sElement'    => 'registrationPassword',
            'sColumnName' => ':password',
            'iMinLength'  => 4,
            'iMaxLength'  => 30,
            'sPattern'    => '/.+/'
        )
    );

    /**
     * @var array $aSendEmailRules
     * Array of rules for validating inputs for emailing sent by AJAX.
     */
    public static $aSendEmailRules = array(
        array(
            'sName'       => 'First name',
            'sElement'    => 'emailFname',
            'sColumnName' => ':firstName',
            'iMinLength'  => 2,
            'iMaxLength'  => 30,
            'sPattern'    => '/^[a-zA-Z\s\.]+$/'
        ),
        array(
            'sName'       => 'Last name',
            'sElement'    => 'emailLname',
            'sColumnName' => ':lastName',
            'iMinLength'  => 2,
            'iMaxLength'  => 30,
            'sPattern'    => '/^[a-zA-Z\s\.]+$/'
        ),
        array(
            'sName'       => 'Email address',
            'sElement'    => 'emailAddress',
            'sColumnName' => ':email',
            'iMinLength'  => 4,
            'iMaxLength'  => 50,
            'sPattern'    => '/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD'
        ),
        array(
            'sName'       => 'Email title',
            'sElement'    => 'emailTitle',
            'sColumnName' => ':title',
            'iMinLength'  => 4,
            'iMaxLength'  => 30,
            'sPattern'    => '/.+/'
        ),
        array(
            'sName'       => 'Email message',
            'sElement'    => 'emailMsg',
            'sColumnName' => ':message',
            'iMinLength'  => 4,
            'iMaxLength'  => 255,
            'sPattern'    => '/.+/'
        )
    );


    /**
     * @var array $aQuotationRules
     * Array of rules for validating quotation inputs sent by AJAX.
     */
    public static $aQuotationRules = array(
        array(
            'sName'       => 'First name',
            'sElement'    => 'quoteFname',
            'sColumnName' => ':firstName',
            'iMinLength'  => 2,
            'iMaxLength'  => 30,
            'sPattern'    => '/^[a-zA-Z\s\.]+$/'
        ),
        array(
            'sName'       => 'Last name',
            'sElement'    => 'quoteLname',
            'sColumnName' => ':lastName',
            'iMinLength'  => 2,
            'iMaxLength'  => 30,
            'sPattern'    => '/^[a-zA-Z\s\.]+$/'
        ),
        array(
            'sName'       => 'Contact number',
            'sElement'    => 'quoteContactNum',
            'sColumnName' => ':contactNum',
            'iMinLength'  => 7,
            'iMaxLength'  => 12,
            'sPattern'    => '/^[0-9]+$/'
        ),
        array(
            'sName'       => 'Email address',
            'sElement'    => 'quoteEmail',
            'sColumnName' => ':email',
            'iMinLength'  => 4,
            'iMaxLength'  => 50,
            'sPattern'    => '/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD'
        ),
        array(
            'sName'       => 'Course',
            'sElement'    => 'quoteCourses',
            'sColumnName' => ':quoteCourses',
            'iMinLength'  => 0,
            'iMaxLength'  => PHP_INT_MAX,
            'sPattern'    => '/.+/'
        )
    );

    /**
     * @var array $aQuoteToEditRules
     * Array of rules for validating quotation inputs sent by AJAX for alteration.
     */
    public static $aQuoteToEditRules = array(
        array(
            'sName'       => 'Course',
            'sElement'    => 'quoteCourses',
            'sColumnName' => ':quoteCourses',
            'iMinLength'  => 0,
            'iMaxLength'  => PHP_INT_MAX,
            'sPattern'    => '/.+/'
        )
    );

    /**
     * @var array $aAddUpdateCourseRules
     * Array of rules for validating course inputs sent by AJAX.
     */
    public static $aAddUpdateCourseRules = array(
        array(
            'sName'       => 'Course code',
            'sElement'    => 'courseCode',
            'sColumnName' => ':courseCode',
            'iMinLength'  => 2,
            'iMaxLength'  => 10,
            'sPattern'    => '/^[a-zA-Z0-9&\-\s\.]+$/'
        ),
        array(
            'sName'       => 'Course title',
            'sElement'    => 'courseTitle',
            'sColumnName' => ':courseName',
            'iMinLength'  => 2,
            'iMaxLength'  => 50,
            'sPattern'    => '/^[a-zA-Z0-9&\-\s\.]+$/'
        ),
        array(
            'sName'       => 'Course details',
            'sElement'    => 'courseDetails',
            'sColumnName' => ':courseDescription',
            'iMinLength'  => 0,
            'iMaxLength'  => 50,
            'sPattern'    => '/^[a-zA-Z0-9&\-\s\.]+$/'
        ),
    );

    public static $aScheduleRules = array(
        array(
            'sName'       => 'Schedule',
            'sElement'    => 'iScheduleId',
            'sPattern'    => '/^[0-9]+$/'
        ),
        array(
            'sName'       => 'Course title',
            'sElement'    => 'iCourseId',
            'sPattern'    => '/^[0-9]+$/'
        ),
        array(
            'sName'       => 'Venue',
            'sElement'    => 'iVenueId',
            'sPattern'    => '/^[0-9]+$/'
        ),
        array(
            'sName'       => 'Start date',
            'sElement'    => 'sStart',
            'sPattern'    => '/^\d{4}-\d{2}-\d{2}/'
        ),
        array(
            'sName'       => 'End date',
            'sElement'    => 'sEnd',
            'sPattern'    => '/^\d{4}-\d{2}-\d{2}/'
        ),
        array(
            'sName'       => 'Instructor name',
            'sElement'    => 'iInstructorId',
            'sPattern'    => '/^[0-9]+$/'
        )
    );

    public static $aInstructorRules = array(
        array(
            'sName'       => 'First name',
            'sElement'    => 'firstName',
            'iMinLength'  => 2,
            'iMaxLength'  => 30,
            'sPattern'    => '/^[a-zA-Z\s\.]+$/'
        ),
        array(
            'sName'       => 'Last name',
            'sElement'    => 'lastName',
            'iMinLength'  => 2,
            'iMaxLength'  => 30,
            'sPattern'    => '/^[a-zA-Z\s\.]+$/'
        ),
        array(
            'sName'       => 'Contact number',
            'sElement'    => 'contactNum',
            'iMinLength'  => 7,
            'iMaxLength'  => 12,
            'sPattern'    => '/^[0-9]+$/'
        ),
        array(
            'sName'       => 'Email address',
            'sElement'    => 'email',
            'iMinLength'  => 4,
            'iMaxLength'  => 50,
            'sPattern'    => '/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD'
        )
    );

    public static $aMessageInstructorRules = array(
        array(
            'sName'       => 'Email title',
            'sElement'    => 'title',
            'iMinLength'  => 2,
            'iMaxLength'  => 30,
            'sPattern'    => '/^[a-zA-Z\s\.]+$/'
        ),
        array(
            'sName'       => 'Email message',
            'sElement'    => 'msg',
            'iMinLength'  => 4,
            'iMaxLength'  => 255,
            'sPattern'    => '/.+/'
        )
    );

    /**
     * @var array $aEditAdminRules
     * Array of rules for validating admin inputs for editing sent by AJAX.
     */
    public static $aEditAdminRules = array(
        array(
            'sName'       => 'First name',
            'sElement'    => 'adminFirstName',
            'iMinLength'  => 2,
            'iMaxLength'  => 30,
            'sPattern'    => '/^[a-zA-Z\s\.]+$/'
        ),
        array(
            'sName'       => 'Last name',
            'sElement'    => 'adminLastName',
            'iMinLength'  => 2,
            'iMaxLength'  => 30,
            'sPattern'    => '/^[a-zA-Z\s\.]+$/'
        ),
        array(
            'sName'       => 'Contact number',
            'sElement'    => 'adminContact',
            'iMinLength'  => 7,
            'iMaxLength'  => 12,
            'sPattern'    => '/^[0-9]+$/'
        ),
        array(
            'sName'       => 'Email address',
            'sElement'    => 'adminEmail',
            'iMinLength'  => 4,
            'iMaxLength'  => 50,
            'sPattern'    => '/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD'
        ),
        array(
            'sName'       => 'Username',
            'sElement'    => 'adminUsername',
            'iMinLength'  => 4,
            'iMaxLength'  => 15,
            'sPattern'    => '/^(?![0-9_])\w+$/'
        )
    );

    /**
     * @var array $aEditAdminRules
     * Array of rules for validating admin inputs for editing sent by AJAX.
     */
    public static $aAddAdminRules = array(
        array(
            'sName'       => 'First name',
            'sElement'    => 'adminFirstName',
            'iMinLength'  => 2,
            'iMaxLength'  => 30,
            'sPattern'    => '/^[a-zA-Z\s\.]+$/'
        ),
        array(
            'sName'       => 'Last name',
            'sElement'    => 'adminLastName',
            'iMinLength'  => 2,
            'iMaxLength'  => 30,
            'sPattern'    => '/^[a-zA-Z\s\.]+$/'
        ),
        array(
            'sName'       => 'Contact number',
            'sElement'    => 'adminContact',
            'iMinLength'  => 7,
            'iMaxLength'  => 12,
            'sPattern'    => '/^[0-9]+$/'
        ),
        array(
            'sName'       => 'Email address',
            'sElement'    => 'adminEmail',
            'iMinLength'  => 4,
            'iMaxLength'  => 50,
            'sPattern'    => '/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD'
        ),
        array(
            'sName'       => 'Username',
            'sElement'    => 'adminUsername',
            'iMinLength'  => 4,
            'iMaxLength'  => 15,
            'sPattern'    => '/^(?![0-9_])\w+$/'
        ),
        array(
            'sName'       => 'Password',
            'sElement'    => 'adminPassword',
            'iMinLength'  => 4,
            'iMaxLength'  => 30,
            'sPattern'    => '/.+/'
        )
    );

    /**
     * @var array $aSuperAdminDetailsRules
     * Array of rules for validating admin inputs for editing details sent by AJAX.
     */
    public static $aSuperAdminDetailsRules = array(
        array(
            'sName'       => 'First name',
            'sElement'    => 'adminFirstName',
            'iMinLength'  => 2,
            'iMaxLength'  => 30,
            'sPattern'    => '/^[a-zA-Z\s\.]+$/'
        ),
        array(
            'sName'       => 'Last name',
            'sElement'    => 'adminLastName',
            'iMinLength'  => 2,
            'iMaxLength'  => 30,
            'sPattern'    => '/^[a-zA-Z\s\.]+$/'
        ),
        array(
            'sName'       => 'Contact number',
            'sElement'    => 'adminContact',
            'iMinLength'  => 7,
            'iMaxLength'  => 12,
            'sPattern'    => '/^[0-9]+$/'
        ),
        array(
            'sName'       => 'Email address',
            'sElement'    => 'adminEmail',
            'iMinLength'  => 4,
            'iMaxLength'  => 50,
            'sPattern'    => '/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD'
        )
    );

    /**
     * @var array $aSuperAdminCredentialsRules
     * Array of rules for validating admin inputs for editing credentials sent by AJAX.
     */
    public static $aSuperAdminCredentialsRules = array(
        array(
            'sName'       => 'Username',
            'sElement'    => 'adminUsername',
            'iMinLength'  => 4,
            'iMaxLength'  => 15,
            'sPattern'    => '/^(?![0-9_])\w+$/'
        ),
        array(
            'sName'       => 'Password',
            'sElement'    => 'adminPassword',
            'iMinLength'  => 4,
            'iMaxLength'  => 30,
            'sPattern'    => '/.+/'
        )
    );

    public static $aResetPasswordIdRules = array(
        array(
            'sName'       => 'Admin',
            'sElement'    => 'adminId',
            'sPattern'    => '/^[0-9]+$/'
        )
    );

    /**
     * @var array $aPaymentModeRules
     * Array of rules for validating admin inputs for adding/editing payment mode sent by AJAX.
     */
    public static $aPaymentModeRules = array(
        array(
            'sName'       => 'Payment mode',
            'sElement'    => 'paymentMode',
            'iMinLength'  => 2,
            'iMaxLength'  => 20,
            'sPattern'    => '/^[a-zA-Z\s\.\-]+$/'
        )
    );

    /**
     * @var array $aApprovePaymentRules
     * Array of rules for validating payments inputs for approval sent by AJAX.
     */
    public static $aApprovePaymentRules = array(
        array(
            'sName'       => 'Mode of payment',
            'sElement'    => 'modeOfPayment',
            'iMinLength'  => 1,
            'iMaxLength'  => PHP_INT_MAX,
            'sPattern'    => '/^[0-9]+$/'
        ),
        array(
            'sName'       => 'Payment amount',
            'sElement'    => 'paymentAmount',
            'iMinLength'  => 1,
            'iMaxLength'  => PHP_INT_MAX,
            'sPattern'    => '/^[0-9]+$/'
        )
    );

    /**
     * validateRegistrationInputs
     * Method for validating registration inputs sent by AJAX.
     * @param array $aParams
     * @return array $aValidationResult
     */
    public static function validateRegistrationInputs($aParams)
    {
        // Add rules for optional fields if filled-up.
        if (strlen(trim($aParams['registrationMname'])) !== 0) {
            array_splice(self::$aRegistrationRules, 1, 0, array(
                array(
                    'sName'       => 'Middle name',
                    'sElement'    => 'registrationMname',
                    'sColumnName' => ':middleName',
                    'iMinLength'  => 2,
                    'iMaxLength'  => 30,
                    'sPattern'    => '/^[a-zA-Z\s\.]+$/'
                )
            ));
        }
        if (strlen(trim($aParams['registrationCompanyName'])) !== 0) {
            array_splice(self::$aRegistrationRules, 4, 0, array(
                array(
                    'sName'       => 'Company name',
                    'sElement'    => 'registrationCompanyName',
                    'sColumnName' => ':companyName',
                    'iMinLength'  => 4,
                    'iMaxLength'  => 50,
                    'sPattern'    => '/^[a-zA-Z0-9\s\.]+$/'
                )
            ));
        }

        // Loop thru each inputRules and if there are rules violated, return false and the error message.
        $aValidationResult = self::loopThruRulesForErrors($aParams, self::$aRegistrationRules, '#');

        // Check if passwords are equal.
        if ($aValidationResult['bResult'] === true && ($aParams['registrationPassword'] !== $aParams['registrationConfirmPassword'])) {
            $aValidationResult = array(
                'bResult'  => false,
                'sElement' => '#registrationPassword, #registrationConfirmPassword',
                'sMsg'     => 'Passwords do not match.'
            );
        }

        // Return the result of the validation.
        return $aValidationResult;
    }

    /**
     * validateEmailInputs
     * Method for validating email-sending inputs sent by AJAX.
     * @param array $aParams
     * @return array $aValidationResult
     */
    public static function validateEmailInputs($aParams)
    {
        // Add rules for optional fields if filled-up.
        if (strlen(trim($aParams['emailMname'])) !== 0) {
            array_splice(self::$aSendEmailRules, 1, 0, array(
                array(
                    'sName'       => 'Middle name',
                    'sElement'    => 'emailMname',
                    'sColumnName' => ':middleName',
                    'iMinLength'  => 2,
                    'iMaxLength'  => 30,
                    'sPattern'    => '/^[a-zA-Z\s\.]+$/'
                )
            ));
        }

        // Loop thru each inputRules and if there are rules violated, return false and the error message.
        $aValidationResult = self::loopThruRulesForErrors($aParams, self::$aSendEmailRules, '#');

        // Return the result of the validation.
        return $aValidationResult;
    }

    /**
     * validateQuotationInputs
     * Method for validating quotation inputs sent by AJAX.
     * @param array $aParams
     * @return array $aValidationResult
     */
    public static function validateQuotationInputs($aParams)
    {
        // Add rules for optional fields if filled-up.
        if (empty($aParams['quoteMname']) === false) {
            array_splice(self::$aQuotationRules, 1, 0, array(
                array(
                    'sName'       => 'Middle name',
                    'sElement'    => 'quoteMname',
                    'sColumnName' => ':middleName',
                    'iMinLength'  => 2,
                    'iMaxLength'  => 30,
                    'sPattern'    => '/^[a-zA-Z\s\.]+$/'
                )
            ));
        }
        if (empty($aParams['quoteCompanyName']) === false) {
            array_splice(self::$aQuotationRules, 2, 0, array(
                array(
                    'sName'       => 'Company name',
                    'sElement'    => 'quoteCompanyName',
                    'sColumnName' => ':companyName',
                    'iMinLength'  => 4,
                    'iMaxLength'  => 50,
                    'sPattern'    => '/^[a-zA-Z0-9\s\.]+$/'
                )
            ));
        }

        // Loop thru each inputRules and if there are rules violated, return false and the error message.
        $aValidationResult = self::loopThruRulesForErrors($aParams, self::$aQuotationRules, '.');

        if ($aValidationResult['bResult'] === true) {
            if (empty($aParams['quoteBillToCompany']) === false) {
                array_push(self::$aQuotationRules, array(
                    'sElement'    => 'quoteBillToCompany',
                    'sColumnName' => ':quoteBillToCompany'
                ));

                if ($aParams['quoteBillToCompany'] === 1 && empty($aParams['quoteCompanyName']) === true) {
                    return array(
                        'bResult'  =>  false,
                        'sElement' =>  '.quoteCompanyName',
                        'sMsg'     => 'Please specify company name if billing to company.'
                    );
                }
            }

            $sNumPaxRegex = '/^(?!-\d+|0)\d+$/';

            foreach ($aParams['numPax'] as $iNumPax) {
                if ($iNumPax < 1 || $iNumPax > 100 || !preg_match($sNumPaxRegex, $iNumPax)) {
                    return array(
                        'bResult'  =>  false,
                        'sElement' =>  '.numPax',
                        'sMsg'     => 'Invalid value for number of persons.'
                    );
                }
            }
        }

        if (empty($aParams['quoteSchedules']) === false) {
            array_push(self::$aQuotationRules, array(
                'sElement'    => 'quoteSchedules',
                'sColumnName' => ':quoteSchedules'
            ));
        }

        array_push(self::$aQuotationRules, array(
            'sElement'    => 'quoteNumPax',
            'sColumnName' => ':quoteNumPax'
        ));

        // Return the result of the validation.
        return $aValidationResult;
    }

    /**
     * validateQuotationInputsForEdit
     * Method for validating quotation inputs sent by AJAX.
     * @param array $aParams
     * @return array $aValidationResult
     */
    public static function validateQuotationInputsForEdit($aParams)
    {
        if (empty($aParams['quoteCompanyName']) === false) {
            array_splice(self::$aQuoteToEditRules, 2, 0, array(
                array(
                    'sName'       => 'Company name',
                    'sElement'    => 'quoteCompanyName',
                    'sColumnName' => ':companyName',
                    'iMinLength'  => 4,
                    'iMaxLength'  => 50,
                    'sPattern'    => '/^[a-zA-Z0-9\s\.]+$/'
                )
            ));
        }

        // Loop thru each inputRules and if there are rules violated, return false and the error message.
        $aValidationResult = self::loopThruRulesForErrors($aParams, self::$aQuoteToEditRules, '.');

        if (empty($aParams['quoteBillToCompany']) === false) {
            array_push(self::$aQuoteToEditRules, array(
                'sElement'    => 'quoteBillToCompany',
                'sColumnName' => ':quoteBillToCompany'
            ));

            if ($aParams['quoteBillToCompany'] === 1 && empty($aParams['quoteCompanyName']) === true) {
                return array(
                    'bResult'  =>  false,
                    'sElement' =>  '#quoteCompanyName',
                    'sMsg'     => 'Please specify company name if billing to company.'
                );
            }
        }

        $sNumPaxRegex = '/^(?!-\d+|0)\d+$/';

        foreach ($aParams['numPax'] as $iNumPax) {
            if ($iNumPax < 1 || $iNumPax > 100 || !preg_match($sNumPaxRegex, $iNumPax)) {
                return array(
                    'bResult'  =>  false,
                    'sElement' =>  '#numPax',
                    'sMsg'     => 'Invalid value for number of persons.'
                );
            }
        }

        if (empty($aParams['quoteSchedules']) === false) {
            array_push(self::$aQuoteToEditRules, array(
                'sElement'    => 'quoteSchedules',
                'sColumnName' => ':quoteSchedules'
            ));
        }

        array_push(self::$aQuoteToEditRules, array(
            'sElement'    => 'quoteNumPax',
            'sColumnName' => ':quoteNumPax'
        ));

        // Return the result of the validation.
        return $aValidationResult;
    }

    /**
     * validateScheduleInputs
     * Method for validating schedule inputs sent by AJAX.
     * @param string $sAction = 'Update'
     * @param array $aParams
     * @return array $aValidationResult
     */
    public static function validateScheduleInputs($aParams, $sAction = 'Update')
    {
        // Prepare the validation result.
        $aValidationResult = array(
            'bResult' => true
        );

        if ($sAction === 'Insert') {
            // Remove the rule for iScheduleId.
            unset(self::$aScheduleRules[0]);
        }

        // Loop thru each inputRules and if there are rules violated, return false and the error message.
        foreach (self::$aScheduleRules as $aInputRule) {
            $sInput = trim($aParams[$aInputRule['sElement']]);

            if (!preg_match($aInputRule['sPattern'], $sInput)) {
                $aValidationResult = array(
                    'bResult'  => false,
                    'sElement' => '.' . $aInputRule['sElement'],
                    'sMsg'     => $aInputRule['sName'] . ' input is invalid.'
                );
                break;
            }
        }

        $sNumSlotsRegex = '/^(?!-\d+|0)\d+$/';

        if ($aParams['iSlots'] < 1 || $aParams['iSlots'] > 100 || !preg_match($sNumSlotsRegex, $aParams['iSlots'])) {
            return array(
                'bResult'  =>  false,
                'sElement' =>  '.numSlots',
                'sMsg'     => 'Invalid value for number of slots.'
            );
        }

        $sCoursePriceRegex = '/^(?!-\d+|0)\d+$/';

        if ($aParams['iCoursePrice'] < 1 || !preg_match($sCoursePriceRegex, $aParams['iCoursePrice'])) {
            return array(
                'bResult'  =>  false,
                'sElement' =>  '.coursePrice',
                'sMsg'     => 'Invalid value for course price.'
            );
        }

        // Return the result of the validation.
        return $aValidationResult;
    }

    /**
     * validateInstructorInputs
     * Method for validating instruction inputs sent by AJAX.
     * @param array $aParams
     * @return array $aValidationResult
     */
    public static function validateInstructorInputs($aParams)
    {
        // Add rules for optional fields if filled-up.
        if (isset($aParams['instructorId']) === true && strlen(trim($aParams['instructorId'])) !== 0) {
            array_splice(self::$aInstructorRules, 1, 0, array(
                array(
                    'sName'       => 'Instructor',
                    'sElement'    => 'instructorId',
                    'iMinLength'  => 0,
                    'iMaxLength'  => PHP_INT_MAX,
                    'sPattern'    => '/^[0-9]+$/'
                ),
            ));
        }
        if (strlen(trim($aParams['middleName'])) !== 0) {
            array_splice(self::$aInstructorRules, 1, 0, array(
                array(
                    'sName'       => 'Middle name',
                    'sElement'    => 'middleName',
                    'iMinLength'  => 2,
                    'iMaxLength'  => 30,
                    'sPattern'    => '/^[a-zA-Z\s\.]+$/'
                )
            ));
        }
        if (strlen(trim($aParams['certificationTitle'])) !== 0) {
            array_splice(self::$aInstructorRules, 1, 0, array(
                array(
                    'sName'       => 'Certification title',
                    'sElement'    => 'certificationTitle',
                    'iMinLength'  => 2,
                    'iMaxLength'  => 30,
                    'sPattern'    => '/^[a-zA-Z0-9,\-\s]+$/'
                )
            ));
        }

        // Loop thru each inputRules and if there are rules violated, return false and the error message.
        $aValidationResult = self::loopThruRulesForErrors($aParams, self::$aInstructorRules, '.');

        // Return the result of the validation.
        return $aValidationResult;
    }

    /**
     * validateChangeInstructorInputs
     * Method for validating instruction inputs to be changed sent by AJAX.
     * @param array $aParams
     * @return array $aValidationResult
     */
    public static function validateChangeInstructorInputs($aParams)
    {
        foreach ($aParams['courseInstructors'] as $iScheduleId => $iInstructorId) {
            // Check if the values are not a digit.
            if (!preg_match('/^[\d]/', $iScheduleId)) {
                return array(
                    'bResult'  => false,
                    'sElement' => '.courseInstructors',
                    'sMsg'     => 'Invalid instructor.'
                );
            }
            if (!preg_match('/^[\d]/', $iInstructorId)) {
                return array(
                    'bResult'  => false,
                    'sElement' => '.courseInstructors',
                    'sMsg'     => 'Invalid instructor.'
                );
            }
        }

        return array(
            'bResult' => true
        );
    }

    /**
     * validateMessageInstructorInputs
     * Method for validating instruction inputs to be changed sent by AJAX.
     * @param array $aParams
     * @return array $aValidationResult
     */
    public static function validateMessageInstructorInputs($aParams)
    {
        // Loop thru each inputRules and if there are rules violated, return false and the error message.
        $aValidationResult = self::loopThruRulesForErrors($aParams, self::$aMessageInstructorRules, '.');

        if ($aValidationResult['bResult'] === true && $aParams['file']['size'] !== 0) {
            $aValidationResult = self::validateFileForMessagingInstructor($aParams['file']);
        }

        // Return the result of the validation.
        return $aValidationResult;
    }

    /**
     * validateEditAdminInputs
     * Validates the inputs for editing admin details.
     * @param array $aFile (The file object.)
     * @return array $aValidationResult (Result of the validation.)
     */
    public static function validateEditAdminInputs($aParams)
    {
        // Add rules for optional fields if filled-up.
        if (strlen(trim($aParams['adminMiddleName'])) !== 0) {
            array_splice(self::$aEditAdminRules, 1, 0, array(
                array(
                    'sName'       => 'Middle name',
                    'sElement'    => 'adminMiddleName',
                    'iMinLength'  => 2,
                    'iMaxLength'  => 30,
                    'sPattern'    => '/^[a-zA-Z\s\.]+$/'
                )
            ));
        }

        // Loop thru each inputRules and if there are rules violated, return false and the error message.
        $aValidationResult = self::loopThruRulesForErrors($aParams, self::$aEditAdminRules, '.');

        // Return the result of the validation.
        return $aValidationResult;
    }

    /**
     * validateAddAdminInputs
     * Validates the inputs for adding a new admin.
     * @param array $aParams
     * @return array $aValidationResult (Result of the validation.)
     */
    public static function validateAddAdminInputs($aParams)
    {
        // Add rules for optional fields if filled-up.
        if (strlen(trim($aParams['adminMiddleName'])) !== 0) {
            array_splice(self::$aAddAdminRules, 1, 0, array(
                array(
                    'sName'       => 'Middle name',
                    'sElement'    => 'adminMiddleName',
                    'iMinLength'  => 2,
                    'iMaxLength'  => 30,
                    'sPattern'    => '/^[a-zA-Z\s\.]+$/'
                )
            ));
        }

        // Loop thru each inputRules and if there are rules violated, return false and the error message.
        $aValidationResult = self::loopThruRulesForErrors($aParams, self::$aAddAdminRules, '.');

        // Check if passwords are equal.
        if ($aValidationResult['bResult'] === true && ($aParams['adminPassword'] !== $aParams['adminConfirmPassword'])) {
            $aValidationResult = array(
                'bResult'  => false,
                'sElement' => '.adminPassword, .adminConfirmPassword',
                'sMsg'     => 'Passwords do not match.'
            );
        }

        // Return the result of the validation.
        return $aValidationResult;
    }

    /**
     * validateSuperAdminDetails
     * Validates the inputs for updating super admin details.
     * @param array $aParams
     * @return array $aValidationResult (Result of the validation.)
     */
    public static function validateSuperAdminDetails($aParams)
    {
        // Add rules for optional fields if filled-up.
        if (strlen(trim($aParams['adminMiddleName'])) !== 0) {
            array_splice(self::$aSuperAdminDetailsRules, 1, 0, array(
                array(
                    'sName'       => 'Middle name',
                    'sElement'    => 'adminMiddleName',
                    'iMinLength'  => 2,
                    'iMaxLength'  => 30,
                    'sPattern'    => '/^[a-zA-Z\s\.]+$/'
                )
            ));
        }

        // Loop thru each inputRules and if there are rules violated, return false and the error message.
        $aValidationResult = self::loopThruRulesForErrors($aParams, self::$aSuperAdminDetailsRules, '.');

        // Return the result of the validation.
        return $aValidationResult;
    }

    /**
     * validateSuperAdminCredentials
     * Validates the inputs for adding a new admin.
     * @param array $aParams
     * @return array $aFileValidation (Result of the validation.)
     */
    public static function validateSuperAdminCredentials($aParams)
    {
        // Loop thru each inputRules and if there are rules violated, return false and the error message.
        $aValidationResult = self::loopThruRulesForErrors($aParams, self::$aSuperAdminCredentialsRules, '.');

        // Check if passwords are equal.
        if ($aValidationResult['bResult'] === true && ($aParams['adminPassword'] !== $aParams['adminConfirmPassword'])) {
            $aValidationResult = array(
                'bResult'  => false,
                'sElement' => '.adminPassword, .adminConfirmPassword',
                'sMsg'     => 'Passwords do not match.'
            );
        }

        // Return the result of the validation.
        return $aValidationResult;
    }

    /**
     * validateResetPasswordId
     * Validates the id for resetting password of an admin.
     * @param array $aParams
     * @return array $aValidationResult (Result of the validation.)
     */
    public static function validateResetPasswordId($aParams)
    {
        $aValidationResult = array(
            'bResult' => true
        );

        // Loop thru each inputRules and if there are rules violated, return false and the error message.
        foreach (self::$aResetPasswordIdRules as $aInputRule) {
            $sInput = trim($aParams[$aInputRule['sElement']]);
            if (!preg_match($aInputRule['sPattern'], $sInput)) {
                $aValidationResult = array(
                    'bResult'  => false,
                    'sMsg'     => $aInputRule['sName'] . ' input is invalid.'
                );
                break;
            }
        }

        return $aValidationResult;
    }

    /**
     * validatePaymentModeInputs
     * Validates the inputs for adding/updating payment mode.
     * @param array $aParams
     * @return array $aValidationResult (Result of the validation.)
     */
    public static function validatePaymentModeInputs($aParams)
    {
        // Add rules for optional fields if filled-up.
        if (isset($aParams['methodId']) === true) {
            array_splice(self::$aPaymentModeRules, 1, 0, array(
                array(
                    'sName'       => 'Payment method',
                    'sElement'    => 'methodId',
                    'iMinLength'  => 1,
                    'iMaxLength'  => PHP_INT_MAX,
                    'sPattern'    => '/^[\d]+$/'
                )
            ));
        }

        // Loop thru each inputRules and if there are rules violated, return false and the error message.
        return self::loopThruRulesForErrors($aParams, self::$aPaymentModeRules, '.');;
    }

    /**
     * validateChangeVenueInputs
     * Method for validating venue inputs to be changed sent by AJAX.
     * @param array $aParams
     * @return array $aValidationResult
     */
    public static function validateChangeVenueInputs($aParams)
    {
        foreach ($aParams['venues'] as $iScheduleId => $iVenueId) {
            // Check if the values are not a digit.
            if (!preg_match('/^[\d]/', $iScheduleId)) {
                return array(
                    'bResult'  => false,
                    'sElement' => '.venues',
                    'sMsg'     => 'Invalid instructor.'
                );
            }
            if (!preg_match('/^[\d]/', $iVenueId)) {
                return array(
                    'bResult'  => false,
                    'sElement' => '.venues',
                    'sMsg'     => 'Invalid instructor.'
                );
            }
        }

        return array(
            'bResult' => true
        );
    }

    /**
     * validateChangeCourseInputs
     * Method for validating course inputs to be changed sent by AJAX.
     * @param array $aParams
     * @return array $aValidationResult
     */
    public static function validateChangeCourseInputs($aParams)
    {
        foreach ($aParams['courses'] as $iScheduleId => $iCourseId) {
            // Check if the values are not a digit.
            if (!preg_match('/^[\d]/', $iScheduleId)) {
                return array(
                    'bResult'  => false,
                    'sElement' => '.venues',
                    'sMsg'     => 'Invalid course.'
                );
            }
            if (!preg_match('/^[\d]/', $iCourseId)) {
                return array(
                    'bResult'  => false,
                    'sElement' => '.venues',
                    'sMsg'     => 'Invalid course.'
                );
            }
        }

        return array(
            'bResult' => true
        );
    }

    /**
     * validateEnrollmentInputs
     * Method for validating enrollment inputs sent by AJAX.
     * @param array $aParams
     * @return array $aValidationResult
     */
    public static function validateEnrollmentInputs($aParams)
    {
        // Check if the values are not a digit.
        if (!preg_match('/^[\d]/', $aParams['courses'])) {
            return array(
                'bResult'  => false,
                'sElement' => '.courses',
                'sMsg'     => 'Invalid course.'
            );
        }
        if (!preg_match('/^[\d]/', $aParams['schedules'])) {
            return array(
                'bResult'  => false,
                'sElement' => '.schedules',
                'sMsg'     => 'Invalid schedule.'
            );
        }

        return array(
            'bResult' => true
        );
    }

    /**
     * validateFileForMessagingInstructor
     * Validates the file uploaded for messaging instructor.
     * @param array $aFile (The file object.)
     * @return array $aFileValidation (Result of the validation.)
     */
    private static function validateFileForMessagingInstructor($aFile)
    {
        $aFileValidation = array(
            'bResult' => true
        );

        if ($aFile['type'] !== 'application/pdf') {
            $aFileValidation = array(
                'bResult'  => false,
                'sElement' => '.file',
                'sMsg'     => 'File must be PDF.'
            );
        }
        if ($aFile['size'] > 10485760) {
            $aFileValidation = array(
                'bResult'  => false,
                'sElement' => '.file',
                'sMsg'     => 'File must not exceed 10 MB.'
            );
        }

        return $aFileValidation;
    }

    /**
     * validateFileForPayment
     * Method for validating file input for payment sent by AJAX.
     * @param array $aFile
     * @return array $aFileValidation
     */
    public static function validateFileForPayment($aFile)
    {
        $aFileValidation = array(
            'bResult' => true
        );

        $aAcceptedMimeTypes = array(
            'image/jpeg',
            'image/png'
        );

        if (in_array($aFile['type'], $aAcceptedMimeTypes) === false) {
            $aFileValidation = array(
                'bResult'  => false,
                'sElement' => '.file',
                'sMsg'     => 'File must be JPEG/JPG, or PNG.'
            );
        }
        if ($aFile['size'] > 10485760) {
            $aFileValidation = array(
                'bResult'  => false,
                'sElement' => '.file',
                'sMsg'     => 'File must not exceed 10 MB.'
            );
        }

        return $aFileValidation;
    }

    /**
     * validateWalkInInputs
     * Method for validating walk-in inputs sent by AJAX.
     * @param array $aParams
     * @return array $aValidationResult
     */
    public static function validateWalkInInputs($aParams)
    {

        $aProperties = array(
            'studentId'        => array(
                'sName'               => 'student name',
                'sClass'              => '.studentId',
                'sElementToHighlight' => '.studentName'
            ),
            'courseDropdown'   => array(
                'sName'               => 'course',
                'sClass'              => '.courseDropdown',
                'sElementToHighlight' => '.courseDropdown'
            ),
            'scheduleDropdown' => array(
                'sName'               => 'schedule',
                'sClass'              => '.scheduleDropdown',
                'sElementToHighlight' => '.scheduleDropdown'
            )
        );

        foreach ($aParams as $sParam) {
            // Check if the values are not a digit.
            if (!preg_match('/^[\d]/', $sParam)) {
                return array(
                    'bResult'  => false,
                    'sElement' => $aProperties[$sParam]['sElementToHighlight'],
                    'sMsg'     => 'Invalid ' . $aProperties[$sParam]['sName'] . '.'
                );
            }
        }

        return array('bResult' => true);
    }

    public static function validateIdParams($aParams)
    {
        foreach ($aParams as $mValue) {
            if (is_array($mValue) === true) {
                foreach ($mValue as $iValue) {
                    if (!preg_match('/^[\d]/', $iValue)) {
                        return array(
                            'bResult' => false,
                            'sMsg'    => 'Invalid search filters.'
                        );
                    }
                }
                continue;
            }
            if (!preg_match('/^[\d]/', $mValue)) {
                return array(
                    'bResult' => false,
                    'sMsg'    => 'Invalid search filters.'
                );
            }
        }
        return array('bResult' => true);
    }

    public static function validateIdsForReschedule($aParams)
    {
        $aProperties = array(
            'studentId'  => array(
                'sName'               => 'student',
                'sElementToHighlight' => '#studName'
            ),
            'trainingId'  => array(
                'sName'               => 'training',
                'sElementToHighlight' => '#schedule'
            ),
            'courseId'   => array(
                'sName'               => 'course',
                'sElementToHighlight' => '.courseDropdownForReschedule'
            ),
            'scheduleId' => array(
                'sName'               => 'schedule',
                'sElementToHighlight' => '.courseDropdownForReschedule'
            )
        );

        foreach ($aParams as $sKey => $iValue) {
            if (!preg_match('/^[\d]/', $iValue)) {
                return array(
                    'bResult'  => false,
                    'sElement' => $aProperties[$sKey]['sElementToHighlight'],
                    'sMsg'     => 'Invalid ' . $aProperties[$sKey]['sName'] . '.'
                );
            }
        }
        return array('bResult' => true);
    }

    /**
     * validateApprovePaymentInputs
     * Validates the payment inputs before approval sent by AJAX.
     * @param array $aParams
     * @return array $aFileValidation
     */
    public static function validateApprovePaymentInputs($aParams)
    {
        return self::loopThruRulesForErrors($aParams, self::$aApprovePaymentRules, '.');;
    }

    /**
     * validateSalesReportFilters
     * Validates the inputs before filtering sales report.
     * @param array $aParams
     * @return array $aValidation
     */
    public static function validateSalesReportFilters($aParams)
    {
        if (empty($aParams['fromDate']) === false && empty($aParams['toDate']) === false) {
            if ($aParams['fromDate'] > $aParams['toDate']) {
                return array(
                    'bResult'  => false,
                    'sElement' => '.fromDate, .endDate',
                    'sMsg'     => 'Start date must not be greater than the end date.'
                );
            }
        }

        $aValidationResult = array(
            'bResult' => true
        );

        $aProperties = array(
            'courseId'   => array(
                'sName'               => 'course',
                'sElementToHighlight' => '.courseDropdown'
            ),
            'scheduleId' => array(
                'sName'               => 'schedule',
                'sElementToHighlight' => '.courseDropdown'
            ),
            'venueId'  => array(
                'sName'               => 'venue',
                'sElementToHighlight' => '.venueDropdown'
            )
        );

        foreach ($aParams as $sKey => $iValue) {
            if (!preg_match('/^[\d]/', $iValue)) {
                $aValidationResult = array(
                    'bResult'  => false,
                    'sElement' => $aProperties[$sKey]['sElementToHighlight'],
                    'sMsg'     => 'Invalid ' . $aProperties[$sKey]['sName'] . '.'
                );
                break;
            }
        }

        return $aValidationResult;
    }

    /**
     * loopThruRulesForErrors
     * @param array $aInputRules (Array of rules.)
     * @param string $sSelector (jQuery selector.)
     * @return array $aValidationResult (Result of the validation.)
     */
    private static function loopThruRulesForErrors($aData, $aInputRules, $sSelector)
    {
        $aValidationResult = array(
            'bResult' => true
        );

        foreach ($aInputRules as $aInputRule) {
            $sInput = trim($aData[$aInputRule['sElement']]);

            if (strlen($sInput) < $aInputRule['iMinLength']) {
                $aValidationResult = array(
                    'bResult'  => false,
                    'sElement' => $sSelector . $aInputRule['sElement'],
                    'sMsg'     => $aInputRule['sName'] . ' must be minimum of ' . $aInputRule['iMinLength'] . ' characters.'
                );
                break;
            }
            if (strlen($sInput) > $aInputRule['iMaxLength']) {
                $aValidationResult = array(
                    'bResult'  => false,
                    'sElement' => $sSelector . $aInputRule['sElement'],
                    'sMsg'     => $aInputRule['sName'] . ' must be maximum of ' . $aInputRule['iMaxLength'] . ' characters.'
                );
                break;
            }
            if (!preg_match($aInputRule['sPattern'], $sInput)) {
                $aValidationResult = array(
                    'bResult'  => false,
                    'sElement' => $sSelector . $aInputRule['sElement'],
                    'sMsg'     => $aInputRule['sName'] . ' input is invalid.'
                );
                break;
            }
        }

        return $aValidationResult;
    }
}
