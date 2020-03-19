<?php

class Users extends BaseController
{
    /**
     * @var UsersModel $oModel
     * Class instance for Venue model.
     */
    private $oUsersModel;

    /**
     * Venue constructor.
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
     * Fetch venues from the database.
     */
    public function fetchInstructors()
    {
        $aInstructors = array();

        // Filter the data before returning to front-end.
        foreach($this->oUsersModel->fetchInstructors() as $iKey => $aInstructor) {
            $aInstructors[$iKey]['id'] = $aInstructor['userId'];
            $aInstructors[$iKey]['fullName'] = $aInstructor['firstName'] . ' ' . $aInstructor['lastName'];
        }

        echo json_encode($aInstructors);
    }
}
