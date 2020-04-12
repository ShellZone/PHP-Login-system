<?php
// Here we check whether the user got to this page by clicking the proper login button.
if (isset($_POST['login-submit'])) {

  // We include the connection script so we can use it later.

  require 'dbh.inc.php';

  // We grab all the data which we passed from the signup form 
  $mailuid = $_POST['mailuid'];
  $password = $_POST['pwd'];

  // Then we perform a bit of error handling to make sure we catch any errors made by the user. 

  if (empty($mailuid) || empty($password)) {
    header("Location: ../index.php?error=emptyfields&mailuid=".$mailuid);
    exit();
  }
  else {

    //get the password from the user in the database  and then we need to de-hash it and check if it matches the password the user typed into the login form.

    // We will connect to the database using prepared statements 
    $sql = "SELECT * FROM users WHERE uidUsers=? OR emailUsers=?;";
    // Here we initialize a new statement using the connection from the dbh.inc.php file.
    $stmt = mysqli_stmt_init($conn);
    // Then we prepare our SQL statement AND check if there are any errors with it.
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      // If there is an error we send the user back to the signup page.
      header("Location: ../index.php?error=sqlerror");
      exit();
    }
    else {

      // If there is no error then we continue the script!

      // Next we need to bind the type of parameters we expect to pass into the statement, and bind the data from the user.
      mysqli_stmt_bind_param($stmt, "ss", $mailuid, $mailuid);
      // Then we execute the prepared statement and send it to the database!
      mysqli_stmt_execute($stmt);
      // And we get the result from the statement.
      $result = mysqli_stmt_get_result($stmt);
      // Then we store the result into a variable.
      if ($row = mysqli_fetch_assoc($result)) {
        // Then we match the password from the database with the password the user submitted. The result is returned as a boolean.
        $pwdCheck = password_verify($password, $row['pwdUsers']);
        // If they don't match then we create an error message!
        if ($pwdCheck == false) {
          // If there is an error we send the user back to the signup page.
          header("Location: ../index.php?error=wrongpwd");
          exit();
        }
        // Then if they DO match, then we know it is the correct user that is trying to log in!
        else if ($pwdCheck == true) {

          // Next we need to create session variables based on the users information from the database. 

          session_start();
          // And NOW we create the session variables.
          $_SESSION['id'] = $row['idUsers'];
          $_SESSION['uid'] = $row['uidUsers'];
          $_SESSION['email'] = $row['emailUsers'];
          // Now the user is registered 
          header("Location: ../index.php?login=success");
          exit();
        }
      }
      else {
        header("Location: ../index.php?login=wronguidpwd");
        exit();
      }
    }
  }
  // Then we close the prepared statement and the database connection!
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}
else {
  // If the user tries to access this page an inproper way, we send them back to the signup page.
  header("Location: ../signup.php");
  exit();
}
