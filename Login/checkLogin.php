<?php
session_start();

// This is where the AJAX will go. Since data sent are named as 'username' and 'password',
// It will be $_POST['username'] and $_POST['password'].

include("../connection.php");

// Store the POST variables into newly declared variables.
$username = $_POST['username'];
$password = $_POST['password'];

// Query the tbl_users for a username equal to $username.
$statement = $connection->prepare("
    SELECT * FROM tbl_users
    WHERE username = :username
");

// Execute the query statement.
$statement->execute(
    array(
        ':username' => $username
    )
);

// Get the count of rows from the result of the executed query above.
$count = $statement->rowCount();

// If $count > 0, there is an existing data inside the db with a username equal to that
// username sent from the AJAX request...
if ($count > 0) {

    // Get the result of the query, which is the password from the database.
    // The parameter inside fetchColumn is the index of the password field inside the database.
    // Note: Always count from 0.
    $passwordFromDatabase = $statement->fetchColumn(2);

    // Compare the password sent from the AJAX and the password from the database if equal.
    if ($password === $passwordFromDatabase) {
        // Set the session variables here.
        $_SESSION['username'] = $username;
        $_SESSION['isLoggedIn'] = true;

        // Prepare the result to be sent back to the AJAX request.
        $result = array(
            'result' => true,
            'msg'	 => 'Success!'
        );
    } else { // Password is incorrect.
        $result = array(
            'result' => false,
            'msg'	 => 'Password is incorrect.'
        );
    }

} else { // Else, no records inside database with the username sent using AJAX.
    $result = array(
        'result' => false,
        'msg'	 => 'Username does not exist.'
    );
}

// Return the response in JSON format since dataType declared inside the AJAX request is JSON.
echo json_encode($result);

?>