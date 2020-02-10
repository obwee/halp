<?php
session_start();

// This is where the AJAX will go. Since data sent are named as 'username' and 'password',
// It will be $_POST['username'] and $_POST['password'].

// Check first if username and password are really sent via AJAX request.
if (isset($_POST['username']) === true && isset($_POST['password']) === true) {
    include("../connection.php");

    // Store the POST variables into newly declared variables.
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Declare the query.
    $statement = $connection->prepare("
        SELECT * FROM tbl_users
        WHERE username = :username AND password = :password
    ");
 
    // Execute the query and store inside $queryResult variable.
    $statement->execute(
        array(
            ':username' => $username,
            ':password' => $password
        )
    );

    // Get the count of rows from the result of the executed query above.
    $count = $statement->rowCount();

    // If $count > 0, meaning if there is an existing data inside the db with a user and pass equal to that
    // sent from the AJAX request...
    if ($count > 0) {
        // Set the session variables here.
        $_SESSION['username'] = $username;
        $_SESSION['isLoggedIn'] = true;

    	// Prepare the result to be sent back to the AJAX request.
    	$result = array(
    		'result' => true,
    		'msg'	 => 'Success!'
    	);
    } else { // Meaning, no records inside database.
		$result = array(
    		'result' => false,
    		'msg'	 => 'An error has occurred. Please check your credentials and try again.'
    	);
    }

    // Return the response in JSON format since dataType declared inside the AJAX request is JSON.
    echo json_encode($result);
}

?>