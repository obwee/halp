<?php
require_once('utils/dbConnection.php');

/**
 * AdminsModel
 * Class for admin-related database functionalities.
 */
class AdminsModel
{
    /**
     * @var dbConnection $oConnection
     * Holder for dbConnection instance.
     */
    private $oConnection;

    /**
     * UsersModel constructor.
     */
    public function __construct()
    {
        $this->oConnection = new dbConnection();
    }

    /**
     * fetchAdmins
     * Queries the users table in getting all the admins.
     * @return array
     */
    public function fetchAdmins()
    {
        // Prepare a select query.
        $oStatement = $this->oConnection->prepare("
            SELECT
                tu.userId AS id, tu.firstName, tu.middleName, tu.lastName,
                tu.username, tu.contactNum, tu.email, tu.position, tu.status
            FROM tbl_users tu
            WHERE 1 = 1
                AND tu.position = 'Admin'
        ");

        // Execute the above statement.
        $oStatement->execute();

        // Return the number of rows returned by the executed query.
        return $oStatement->fetchAll();
    }

    /**
     * fetchOwnCredentials
     * Queries the users table in getting super admin credentials.
     * @param string $sUsername
     * @return array
     */
    public function fetchOwnCredentials($sUsername)
    {
        // Prepare a select query.
        $oStatement = $this->oConnection->prepare("
            SELECT
                tu.userId AS id, tu.firstName, tu.middleName, tu.lastName,
                tu.username, tu.contactNum, tu.email, tu.position
            FROM tbl_users tu
            WHERE 1 = 1
                AND tu.position = 'Super Admin'
                AND tu.username = ?
        ");

        // Execute the above statement.
        $oStatement->execute([$sUsername]);

        // Return the number of rows returned by the executed query.
        return $oStatement->fetch();
    }

    /**
     * checkUsernameIfTaken
     * Checks if the username is already taken.
     * @param string $sUsername
     * @return int
     */
    public function checkIfUsernameTakenBeforeUpdate($sUsername, $iUserId)
    {
        // Query the tbl_users for a username equal to $username.
        $statement = $this->oConnection->prepare("
            SELECT *
            FROM tbl_users
            WHERE 1 = 1
                AND username = :username
                AND userId  != :userId
        ");

        // Execute the above statement.
        $statement->execute(
            array(
                ':username' => $sUsername,
                ':userId'   => $iUserId
            )
        );

        // Return the number of rows returned by the executed query.
        return $statement->rowCount();
    }

    /**
     * addAdmin
     * Inserts a new record inside the users table.
     * @param array $aData
     * @return int
     */
    public function addAdmin($aData)
    {
        // Prepare an update query to the users table.
        $oStatement = $this->oConnection->prepare("
            INSERT INTO tbl_users
                (firstName, middleName, lastName, username, password, email, contactNum, position)
            VALUES
                (:firstName, :middleName, :lastName, :username, :password, :email, :contactNum, 'Admin')
        ");

        // Return the result of the execution of the above statement.
        return $oStatement->execute($aData);
    }

    /**
     * updateAdmin
     * Updates the admin details inside the users table.
     * @param array $aData
     * @return int
     */
    public function updateAdmin($aData)
    {
        // Prepare an update query to the users table.
        $oStatement = $this->oConnection->prepare("
            UPDATE tbl_users
            SET
                firstName  = :firstName,
                middleName = :middleName,
                lastName   = :lastName,
                email      = :email,
                contactNum = :contactNum,
                username   = :username
            WHERE userId = :userId
        ");

        // Return the result of the execution of the above statement.
        return $oStatement->execute($aData);
    }

    /**
     * updateSuperAdminDetails
     * Updates the super admin details inside the users table.
     * @param array $aData
     * @return int
     */
    public function updateSuperAdminDetails($aData)
    {
        // Prepare an update query to the users table.
        $oStatement = $this->oConnection->prepare("
            UPDATE tbl_users
            SET
                firstName  = :firstName,
                middleName = :middleName,
                lastName   = :lastName,
                email      = :email,
                contactNum = :contactNum
            WHERE userId = :userId
        ");

        // Return the result of the execution of the above statement.
        return $oStatement->execute($aData);
    }

    /**
     * updateSuperAdminCredentials
     * Updates the super admin credentials inside the users table.
     * @param array $aData
     * @return int
     */
    public function updateSuperAdminCredentials($aData)
    {
        // Prepare an update query to the users table.
        $oStatement = $this->oConnection->prepare("
            UPDATE tbl_users
            SET
                username = :username,
                password = :password
            WHERE userId = :userId
        ");

        // Return the result of the execution of the above statement.
        return $oStatement->execute($aData);
    }

    /**
     * enableDisableAdmin
     * Updates the admin status inside the users table.
     * @param array $aData
     * @return int
     */
    public function enableDisableAdmin($aData)
    {
        // Prepare an update query to the users table.
        $oStatement = $this->oConnection->prepare("
            UPDATE tbl_users
            SET status   = :status
            WHERE userId = :userId
        ");

        // Return the result of the execution of the above statement.
        return $oStatement->execute($aData);
    }

    /**
     * changePassword
     * Updates the admin password inside the users table.
     * @param int $iUserId
     * @param string $sPassword
     * @return int
     */
    public function changePassword($iUserId, $sPassword)
    {
        // Prepare an update query to the users table.
        $oStatement = $this->oConnection->prepare("
            UPDATE tbl_users
            SET password = ?
            WHERE userId = ?
        ");

        // Return the result of the execution of the above statement.
        return $oStatement->execute([$sPassword, $iUserId]);
    }

    public function fetchAdminsByInstructorIds($aInstructorIds)
    {
        $sPlaceHolders = str_repeat ('?, ',  count ($aInstructorIds) - 1) . '?';

        // Query the tbl_quotation_details.
        $statement = $this->oConnection->prepare("
            SELECT
                userId AS instructorId,
                CONCAT(firstName, ' ', lastName) AS instructorName
            FROM tbl_users
            WHERE userId IN ($sPlaceHolders)
        ");

        // Execute the above statement along with the needed where clauses.
        $statement->execute($aInstructorIds);

        // Return the result of the execution of the above statement.
        return $statement->fetchAll();
    }

    /**
     * fetchAdminCredentials
     * Queries the users table in getting admin credentials.
     * @param string $sUsername
     * @return array
     */
    public function fetchAdminCredentials($sUsername)
    {
        // Prepare a select query.
        $oStatement = $this->oConnection->prepare("
            SELECT
                tu.userId AS id, tu.firstName, tu.middleName, tu.lastName,
                tu.username, tu.contactNum, tu.email, tu.position
            FROM tbl_users tu
            WHERE 1 = 1
                AND tu.position = 'Admin'
                AND tu.username = ?
        ");

        // Execute the above statement.
        $oStatement->execute([$sUsername]);

        // Return the number of rows returned by the executed query.
        return $oStatement->fetch();
    }
}
