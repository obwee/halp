<?php
include_once 'utils/dbConnection.php';

// Validate first the data if true.
if (validateData() === true) {
    $connection = new dbConnection();

    // Store the POST variables into newly declared variables.
    $email = $_POST['email'];

    // Query the tbl_users for a username equal to $username.
    $statement = $connection->prepare("
        SELECT userId, email, CONCAT(firstName, ' ', lastName) AS fullName
        FROM tbl_users
        WHERE email = :email
    ");

    // Execute the query statement.
    $statement->execute(
        array(
            ':email' => $email
        )
    );

    // Get the user id.
    $details = $statement->fetch();

    // If details is not empty, there is an existing data inside the db with an email equal to that
    // sent from the AJAX request...
    if (empty($details) === false) {

        // Prepare an UPDATE query on the tbl_users for password reset.
        $statement = $connection->prepare("
            UPDATE tbl_users
            SET password = :password
            WHERE email = :email AND userId = :userId
        ");

        $newPassword = Utils::generateRandomString();

        // Execute the query statement.
        $query = $statement->execute(
            array(
                ':password' => Utils::hashPassword($newPassword),
                ':email'    => $email,
                ':userId'   => $details['userId']
            )
        );

        // Check if the UPDATE query succeeds.
        if ($query === true) {
            $result = array(
                'result' => true,
                'msg'    => 'Password reset success! Please check your email.'
            );

            $emailClass = new Email();
            $emailClass->addSingleRecipient($email, $details['fullName']);
            $emailClass->setTitle('Password Reset');
            $emailClass->setBody('Hello, ' . $details['fullName'] . '. Your new password is ' . $newPassword . '. Please change your password immediately.');
            $emailClass->send();
        } else {
            $result = array(
                'result' => false,
                'msg'    => 'An error has occured.'
            );
        }
    } else { // Else, no records inside database with the username sent using AJAX.
        $result = array(
            'result' => false,
            'msg'    => 'Email not found.'
        );
    }
} else {
    $result = validateData();
}

// Return the response in JSON format since dataType declared inside the AJAX request is JSON.
echo json_encode($result);

// This method validate data sent by AJAX.
function validateData()
{
    if ($_POST['email'] === '') {
        return array(
            'result' => false,
            'msg'    => 'Please enter an email.'
        );
    }

    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
        return array(
            'result' => false,
            'msg'    => 'Please enter a valid email.'
        );
      }

      return true;
}

?>