<?php

class Users extends BaseController
{
    /**
     * @var UsersModel $oModel
     * Class instance for Venue model.
     */
    private $oUsersModel;

    /**
     * Users constructor.
     * @param array $aPostVariables
     */
    public function __construct($aPostVariables)
    {
        // Store the $_POST variables inside $this->aParams variable.
        $this->aParams = $aPostVariables;
        // Instantiate the UsersModel class and store it inside $this->oVenueModel.
        $this->oUsersModel = new UsersModel();
    }

    /**
     * fetchInstructors
     * Fetch instructors from the database.
     */
    public function fetchInstructors()
    {
        $aInstructors = $this->oUsersModel->fetchInstructors();

        // Filter the data before returning to front-end.
        foreach ($aInstructors as $iKey => $aInstructor) {
            $aInstructors[$iKey]['fullName'] = $aInstructor['firstName'] . ' ' . $aInstructor['lastName'];
        }

        echo json_encode($aInstructors);
    }

    /**
     * addInstructor
     * Add an instructor to the database.
     */
    public function addInstructor()
    {
        $aValidationResult = Validations::validateInstructorInputs($this->aParams);
        if ($aValidationResult['result'] === true) {
            Utils::sanitizeData($this->aParams);

            // Perform insert.
            $iQuery = $this->oUsersModel->addInstructor($this->aParams);
    
            if ($iQuery > 0) {
                $aResult = array(
                    'bResult' => true,
                    'sMsg'    => 'Venue added!'
                );
            } else {
                $aResult = array(
                    'bResult' => false,
                    'sMsg'    => 'An error has occured.'
                );
            }
        }

        echo json_encode($aResult);
    }

    /**
     * updateInstructor
     * Fetch instructors from the database.
     */
    public function updateInstructor()
    {
        $aValidationResult = Validations::validateInstructorInputs($this->aParams);
        if ($aValidationResult['result'] === true) {
            // Declare an array with keys equivalent to that inside the database.
            $aDatabaseColumns = array(
                'instructorId'       => 'userId'
            );

            // Loop thru the POST data sent by AJAX for renaming.
            foreach ($aDatabaseColumns as $sKey => $mValue) {
                $this->aParams[$mValue] = $this->aParams[$sKey];
                unset($this->aParams[$sKey]);
            }

            Utils::sanitizeData($this->aParams);

            // Perform update.
            $iQuery = $this->oUsersModel->updateInstructor($this->aParams);

            if ($iQuery > 0) {
                $aResult = array(
                    'bResult' => true,
                    'sMsg'    => 'Instructor updated!'
                );
            } else {
                $aResult = array(
                    'bResult' => false,
                    'sMsg'    => 'An error has occured.'
                );
            }
        } else {
            $aResult = $aValidationResult;
        }

        echo json_encode($aResult);
    }

    
    /**
     * enableDisableInstructor
     * Mark an instructor as active/inactive from the database.
     */
    public function enableDisableInstructor()
    {
        $oData = array(
            'userId' => $this->aParams['instructorId'],
            'status' => ($this->aParams['instructorAction'] === 'enable') ? 'Active' : 'Inactive'
        );

        // Perform delete.
        $iQuery = $this->oUsersModel->enableDisableInstructor($oData);

        if ($iQuery > 0) {
            $aResult = array(
                'bResult' => true,
                'sMsg'    => 'Instructor '. $this->aParams['instructorAction'] .'d!'
            );
        } else {
            $aResult = array(
                'bResult' => false,
                'sMsg'    => 'An error has occured.'
            );
        }

        echo json_encode($aResult);
    }
}
