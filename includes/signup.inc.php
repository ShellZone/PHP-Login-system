<?php
// Here we check whether the user got to this page by clicking the proper signup button.
if (isset($_POST['signup-submit'])) {

  // We include the connection script so we can use it later.
  // We don't have to close the MySQLi connection since it is done automatically, but it is a good habit to do so anyways since this will immediately return resources to PHP and MySQL, which can improve performance.
  require 'dbh.inc.php';

  // We grab all the data which we passed from the signup form so we can use it later.
  $username = $_POST['uid'];
  $email = $_POST['mail'];
  $password = $_POST['pwd'];
  $passwordRepeat = $_POST['pwd-repeat'];

  // Then we perform a bit of error handling to make sure we catch any errors made by the user. 

  // We check for any empty inputs. 
  if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {
    header("Location: ../signup.php?error=emptyfields&uid=".$username."&mail=".$email);
    exit();
  }
  // We check for an invalid username AND invalid e-mail.
  else if (!preg_match("/^[a-zA-Z0-9]*$/", $username) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../signup.php?error=invaliduidmail");
    exit();
  }
  // We check for an invalid username. In this case ONLY letters and numbers.
  else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
    header("Location: ../signup.php?error=invaliduid&mail=".$email);
    exit();
  }
  // We check for an invalid e-mail.
  else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../signup.php?error=invalidmail&uid=".$username);
    exit();
  }
  // We check if the repeated password is NOT the same.
  else if ($password !== $passwordRepeat) {
    header("Location: ../signup.php?error=passwordcheck&uid=".$username."&mail=".$email);
    exit();
  }
  else {

    // We also need to include another error handler here that checks whether or the username is already taken. 

    // First we create the statement that searches our database table to check for any identical usernames.
    $sql = "SELECT uidUsers FROM users WHERE uidUsers=?;";
    // We create a prepared statement.
    $stmt = mysqli_stmt_init($conn);
    // Then we prepare our SQL statement AND check if there are any errors with it.
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      // If there is an error we send the user back to the signup page.
      header("Location: ../signup.php?error=sqlerror");
      exit();
    }
    else {
      // Next we need to bind the type of parameters we expect to pass into the statement, and bind the data from the user.
      mysqli_stmt_bind_param($stmt, "s", $username);
      // Then we execute the prepared statement and send it to the database!
      mysqli_stmt_execute($stmt);
      // Then we store the result from the statement.
      mysqli_stmt_store_result($stmt);
      // Then we get the number of result we received from our statement. This tells us whether the username already exists or not!
      $resultCount = mysqli_stmt_num_rows($stmt);
      // Then we close the prepared statement!
      mysqli_stmt_close($stmt);
      // Here we check if the username exists.
      if ($resultCount > 0) {
        header("Location: ../signup.php?error=usertaken&mail=".$email);
        exit();
      }
      else {

        // Next thing we do is to prepare the SQL statement that will insert the users info into the database.

        $sql = "INSERT INTO users (uidUsers, emailUsers, pwdUsers) VALUES (?, ?, ?);";
        // Here we initialize a new statement using the connection from the dbh.inc.php file.
        $stmt = mysqli_stmt_init($conn);
        // Then we prepare our SQL statement AND check if there are any errors with it.
        if (!mysqli_stmt_prepare($stmt, $sql)) {
          // If there is an error we send the user back to the signup page.
          header("Location: ../signup.php?error=sqlerror");
          exit();
        }
        else {

          // If there is no error then we continue the script!

         //Hashing pwd

          $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

          // bind the type of parameters we expect to pass into the statement, and bind the data from the user.
          mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPwd);
          // Then we execute the prepared statement and send it to the database!
          
          mysqli_stmt_execute($stmt);
          
          header("Location: ../signup.php?signup=success");
          exit();

        }
      }
    }
  }
  // Then we close the prepared statement and the database connection!
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}
else {
    
  header("Location: ../signup.php");
  exit();
}
