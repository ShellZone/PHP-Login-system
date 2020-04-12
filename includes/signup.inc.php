<?php
// checks if user got here via clicking signup button on form
if (isset($_POST['signup-submit'])) {

   require 'dbh.inc.php';
    

   $username = $_POST['uid'];
   $email = $_POST['mail'];
   $password = $_POST['pwd'];
   $passwordRepeat = $_POST['pwd-repeat'];

   // Checks Empty Fields
   // Sends back to signup page

    if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {
        header("Location: ../signup.php?error=emptyfields&uid=".$username."&mail=".$email);
        exit();
        }
        // Checks if email is of the right format
        elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)){
            header("Location: ../signup.php?error=invalidmailuid");
            exit();
        }
        elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: ../signup.php?error=invalidmail&uid=".$username);
        }
        elseif (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
            header("Location: ../signup.php?error=invalidmail&mail=".$email);
            exit();
        }
        //Checks Password RePeated
        elseif($password !== $passwordRepeat){
            header("Location: ../signup.php?error=passwordcheck&uid=".$username."&mail=".$email);
            exit();
        }
        else {
          
            $sql = "SELECT uidusers FROM users WHERE uidUsers=?";
            // creates a prepared statement
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)){
                header("Location: ../signup.php?error=sqlerror");
                exit();
            }
            else {
               mysqli_stmt_bind_param($stmt, "s", $username); 
               mysqli_stmt_execute($stmt);
               // BELOW fetch ifo from DB
               mysqli_stmt_store_result($stmt);
               $resultCheck = mysqli_stmt_num_rows($stmt);
               if($resultCheck > 0){
                header("Location: ../signup.php?error=usertaken&mail=".$email);
                exit();
               }
               else {
                   // Insert into DB with placeholders 
                $sql = "INSERT INTO users (uidUsers, emailUsers, pwdUsers) VALUES (?, ?, ?)";
                //initialize connection
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)){
                    header("Location: ../signup.php?error=sqlerror");
                    exit();
                }  else {
                    // hashing password for added security
                       $hashedPwd = password_hash($password, PASSWORD_DEFAULT);


                    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPwd); 
                    mysqli_stmt_execute($stmt);
                    header("Location: ../signup.php?signup=success");
                    exit();
                }
            
            }
            }

        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
} else {
    header("Location: ../signup.php");
    exit();
}