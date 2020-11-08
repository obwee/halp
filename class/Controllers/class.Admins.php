<?php

class Admins extends BaseController
{
    /**
     * @var AdminsModel $oAdminsModel
     * Class instance for Admin model.
     */
    private $oAdminsModel;

    /**
     * Admins constructor.
     * @param array $aPostVariables
     */
    public function __construct($aPostVariables)
    {
        // Store the $_POST variables inside $this->aParams variable.
        $this->aParams = $aPostVariables;
        // Instantiate the UsersModel class and store it inside $this->oVenueModel.
        $this->oAdminsModel = new AdminsModel();
        parent::__construct();
    }

    /**
     * fetchAdmins
     * Fetch admins from the database.
     */
    public function fetchAdmins()
    {
        $aAdmins = $this->oAdminsModel->fetchAdmins();

        // Filter the data before returning to front-end.
        foreach ($aAdmins as $iKey => $aAdmin) {
            $aAdmins[$iKey]['fullName'] = $aAdmin['firstName'] . ' ' . $aAdmin['lastName'];
        }

        echo json_encode($aAdmins);
    }

    /**
     * fetchOwnCredentials
     * Fetch credential of a super admin from the database.
     */
    public function fetchOwnCredentials()
    {
        $aAdmins = $this->oAdminsModel->fetchOwnCredentials(Session::get('username'));
        echo json_encode($aAdmins);
    }

    /**
     * fetchAdminCredentials
     * Fetch credentials of an admin from the database.
     */
    public function fetchAdminCredentials()
    {
        $aDetails = $this->oAdminsModel->fetchAdminCredentials(Session::get('username'));
        echo json_encode($aDetails);
    }

    /**
     * addAdmin
     * Add an instructor to the database.
     */
    public function addAdmin()
    {
        $aValidationResult = Validations::validateAddAdminInputs($this->aParams);
        if ($aValidationResult['bResult'] === true) {
            $aDatabaseColumns = array(
                'adminFirstName'  => ':firstName',
                'adminMiddleName' => ':middleName',
                'adminLastName'   => ':lastName',
                'adminPassword'   => ':password',
                'adminEmail'      => ':email',
                'adminContact'    => ':contactNum',
                'adminUsername'   => ':username'
            );

            Utils::renameKeys($this->aParams, $aDatabaseColumns);
            Utils::sanitizeData($this->aParams);

            if ($this->oStudentModel->checkUsernameIfTaken($this->aParams[':username']) > 0) {
                $aResult = array(
                    'bResult'  => false,
                    'sElement' => '.adminUsername',
                    'sMsg'     => 'Username already taken.'
                );
            } else {
                unset($this->aParams['adminConfirmPassword']);
                $this->aParams[':password'] = Utils::hashPassword($this->aParams[':password']);
                $this->aParams[':middleName'] = $this->aParams[':middleName'] ?? '';

                // Perform insert.
                $iQuery = $this->oAdminsModel->addAdmin($this->aParams);

                if ($iQuery > 0) {
                    $aResult = array(
                        'bResult' => true,
                        'sMsg'    => 'Admin added!'
                    );
                } else {
                    $aResult = array(
                        'bResult' => false,
                        'sMsg'    => 'An error has occured.'
                    );
                }
            }
        }

        echo json_encode($aResult);
    }

    /**
     * updateAdmin
     * Updates the details of an admin performed by a super admin.
     */
    public function updateAdmin()
    {
        $aValidationResult = Validations::validateEditAdminInputs($this->aParams);
        if ($aValidationResult['bResult'] === true) {
            $aDatabaseColumns = array(
                'adminId'         => ':userId',
                'adminFirstName'  => ':firstName',
                'adminMiddleName' => ':middleName',
                'adminLastName'   => ':lastName',
                'adminEmail'      => ':email',
                'adminContact'    => ':contactNum',
                'adminUsername'   => ':username'
            );

            Utils::renameKeys($this->aParams, $aDatabaseColumns);
            Utils::sanitizeData($this->aParams);

            if ($this->oAdminsModel->checkIfUsernameTakenBeforeUpdate($this->aParams[':username'], $this->aParams[':userId']) > 0) {
                $aResult = array(
                    'bResult'  => false,
                    'sElement' => '.adminUsername',
                    'sMsg'     => 'Username already taken.'
                );
            } else {
                // Perform update.
                $iQuery = $this->oAdminsModel->updateAdmin($this->aParams);

                if ($iQuery > 0) {
                    $aResult = array(
                        'bResult' => true,
                        'sMsg'    => 'Admin updated!'
                    );
                } else {
                    $aResult = array(
                        'bResult' => false,
                        'sMsg'    => 'An error has occured.'
                    );
                }
            }
        } else {
            $aResult = $aValidationResult;
        }

        echo json_encode($aResult);
    }

    /**
     * updateSuperAdminDetails
     * Updates the details of a super admin from the database.
     */
    public function updateSuperAdminDetails()
    {
        $aValidationResult = Validations::validateSuperAdminDetails($this->aParams);
        if ($aValidationResult['bResult'] === true) {
            $aDatabaseColumns = array(
                'adminId'         => ':userId',
                'adminFirstName'  => ':firstName',
                'adminMiddleName' => ':middleName',
                'adminLastName'   => ':lastName',
                'adminEmail'      => ':email',
                'adminContact'    => ':contactNum'
            );

            Utils::renameKeys($this->aParams, $aDatabaseColumns);
            Utils::sanitizeData($this->aParams);

            // Perform update.
            $iQuery = $this->oAdminsModel->updateSuperAdminDetails($this->aParams);

            if ($iQuery > 0) {
                Session::set('fullName', $this->aParams[':firstName'] . ' ' . $this->aParams[':lastName']);
                $aResult = array(
                    'bResult' => true,
                    'sMsg'    => 'Personal details updated!'
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
     * updateSuperAdminCredentials
     * Updates the details of a super admin from the database.
     */
    public function updateSuperAdminCredentials()
    {
        $aValidationResult = Validations::validateSuperAdminCredentials($this->aParams);
        if ($aValidationResult['bResult'] === true) {
            $aDatabaseColumns = array(
                'adminId'       => ':userId',
                'adminUsername' => ':username',
                'adminPassword' => ':password'
            );

            Utils::renameKeys($this->aParams, $aDatabaseColumns);
            Utils::sanitizeData($this->aParams);

            if ($this->oAdminsModel->checkIfUsernameTakenBeforeUpdate($this->aParams[':username'], $this->aParams[':userId']) > 0) {
                $aResult = array(
                    'bResult'  => false,
                    'sElement' => '.adminUsername',
                    'sMsg'     => 'Username already taken.'
                );
            } else {
                unset($this->aParams['adminConfirmPassword']);

                // Perform update.
                $this->aParams[':password'] = Utils::hashPassword($this->aParams[':password']);
                $iQuery = $this->oAdminsModel->updateSuperAdminCredentials($this->aParams);

                if ($iQuery > 0) {
                    Session::set('username', $this->aParams[':username']);
                    $aResult = array(
                        'bResult' => true,
                        'sMsg'    => 'Login credentials updated!'
                    );
                } else {
                    $aResult = array(
                        'bResult' => false,
                        'sMsg'    => 'An error has occured.'
                    );
                }
            }
        } else {
            $aResult = $aValidationResult;
        }

        echo json_encode($aResult);
    }

    /**
     * enableDisableAdmin
     * Mark an adimn as active/inactive from the database.
     */
    public function enableDisableAdmin()
    {
        $aData = array(
            'userId' => $this->aParams['adminId'],
            'status' => ($this->aParams['adminAction'] === 'enable') ? 'Active' : 'Inactive'
        );

        // Perform enabling/disabling.
        $iQuery = $this->oAdminsModel->enableDisableAdmin($aData);

        if ($iQuery > 0) {
            $aResult = array(
                'bResult' => true,
                'sMsg'    => 'Admin ' . $this->aParams['adminAction'] . 'd!'
            );
        } else {
            $aResult = array(
                'bResult' => false,
                'sMsg'    => 'An error has occured.'
            );
        }

        echo json_encode($aResult);
    }

    /**
     * resetPassword
     * Resets the password of an admin.
     */
    public function resetPassword()
    {
        $aValidationResult = Validations::validateResetPasswordId($this->aParams);

        if ($aValidationResult['bResult'] === true) {
            Utils::sanitizeData($this->aParams);
            $this->aParams['adminPassword'] = Utils::generateRandomString();
            $sNewPassword = Utils::hashPassword($this->aParams['adminPassword']);

            // Perform update on password field and check the return.
            if ($this->oAdminsModel->changePassword($this->aParams['adminId'], $sNewPassword) > 0 && $this->processSendingEmailForPasswordReset($this->aParams) === 1) {
                $aResult = array(
                    'bResult' => true,
                    'sMsg'    => 'Password reset success!'
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

    public function updateProfileDetails()
    {
        $aValidationResult = Validations::validateUpdateProfileDetails($this->aParams);

        if ($aValidationResult['bResult'] === true) {
            Utils::sanitizeData($this->aParams);
            $this->aParams['username'] = Session::get('username');

            if ($this->oAdminsModel->updateAdminProfileDetails($this->aParams) > 0) {
                $aResult = array(
                    'bResult' => true,
                    'sMsg'    => 'Profile details updated!'
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

    public function updateLoginCredentials()
    {
        $aValidationResult = Validations::validateUpdateLoginCredentials($this->aParams);

        if ($aValidationResult['bResult'] === false) {
            echo json_encode($aValidationResult);
            exit();
        }

        Utils::sanitizeData($this->aParams);

        if ($this->oAdminsModel->checkIfUsernameTakenBeforeUpdate($this->aParams['username'], $this->getUserId()) > 0) {
            echo json_encode(array(
                'bResult'  => false,
                'sElement' => '.username',
                'sMsg'     => 'Username already taken.'
            ));
            exit();
        }

        $sPasswordEntered = Utils::hashPassword($this->aParams['password']);
        $sOldPassword = $this->oStudentModel->getPassword($this->aParams['username'], $sPasswordEntered);

        if ($sPasswordEntered !== $sOldPassword) {
            echo json_encode(array(
                'bResult'  => false,
                'sElement' => '.password',
                'sMsg'     => 'Old password incorrect'
            ));
            exit();
        }

        $aParams = array(
            'userId'   => $this->getUserId(),
            'username' => $this->aParams['username'],
            'password' => Utils::hashPassword($this->aParams['newPassword'])
        );

        if ($this->oAdminsModel->updateLoginCredentials($aParams) > 0) {
            $aResult = array(
                'bResult' => true,
                'sMsg'    => 'Login credentials updated!'
            );
        } else {
            $aResult = array(
                'bResult' => false,
                'sMsg'    => 'An error has occured.'
            );
        }

        echo json_encode($aResult);
    }

    /**
     * processSendingEmailForPasswordReset
     * Sends an email to an admin for resetting password.
     * @param array $aAdminDetails
     */
    private function processSendingEmailForPasswordReset($aAdminDetails)
    {
        $oMail = new Email();
        $oMail->addSingleRecipient($aAdminDetails['adminEmail'], $aAdminDetails['adminFullName']);
        $oMail->setTitle('Password Reset');
        $oMail->setBody('Hello, ' . $aAdminDetails['adminFullName'] . '. Your new password is ' . $aAdminDetails['adminPassword'] . '. Please change your password immediately.');
        return $oMail->send();
    }
}
