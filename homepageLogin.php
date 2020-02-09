<?php

session_start();  
include("connection.php");

if(isset($_SESSION['username'])) {
    header("Location:../dashboard.php"); // redirects them to dashboard
    exit; // for good measure
  }
  else
  {
    if(isset($_POST["Username"]) && isset($_POST["Password"]))
    {
      $username = $_POST["Username"];
      $passwordStrip = $_POST["Password"];

      $username = stripslashes($username);
      $passwordStrip = stripslashes($passwordStrip);
      $salt = "jkldgfu923jkgd124as";
      $password = $passwordStrip . $salt;
      $password = sha1($password);


      $query = "SELECT * FROM tbl_users WHERE username = :username AND password = :password";  
      $statement = $connection->prepare($query);  
      $statement->execute(
       array(
         ':username'     =>     $username,
         ':password'     =>     $password
       )
     );

      $count = $statement->rowCount();
      if($count > 0)
      {
        $result = $statement->fetchAll();
        foreach ($result as $row) {
          $userID = $row[0];
          $fullName = $row[4];
          $userPosition = $row[7];
          $status = $row[10];
        }

        if($status == 'Disabled') {
          echo 'Account is disabled.<br>Please contact admin immediately.';
        }
        else {
          $_SESSION['userID'] = $userID;
          $_SESSION['fullName'] = $fullName;
          $_SESSION["username"] = $username;
          $_SESSION['loggedin'] = 1;
          $_SESSION['userPosition'] = $userPosition;
          echo 'Login';
        }
      }
      else {
        echo "Incorrect username and password!<br>Please try again.";
      }
    }
  }

?>